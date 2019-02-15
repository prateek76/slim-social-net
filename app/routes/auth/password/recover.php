<?php

$app->get('/recover-password', $guest(), function() use($app){
	$app->render('/auth/password/recover.php');
})->name('password.recover');

$app->post('/recover-password', $guest(), function() use($app){
	$request 	= $app->request;

	$email 		= $request->post('email');

	$v 			= $app->validation;

	$v->validate([
		'email'		=>	[$email, 'required|email'],
	]);

	if ($v->passes()) {
		$user = $app->user->where('email', $email)->first();


		if (!$user) {
			//flash an error message
			$app->flash('global', 'could not find that user.');
			$app->response->redirect($app->urlFor('password.recover'));
		} else {
			$identifier = $app->randomlib->generateString(128);

			//update table and put recover hash
			$user->update([
				'recover_hash'	=>	$app->hash->hash($identifier)
			]);
			//send an email
			$app->mail->send('email/auth/password/recover.php', ['user' => $user, 'identifier' => $identifier], function($message) use($user){
				$message->to($user->email);
				$message->subject('Reset your password');
			});
			//flash a message
			$app->flash('global', 'recovery link send');
			//redirect to home
			$app->response->redirect($app->urlFor('home'));
		}

	}

	$app->render('auth/password/recover.php', [
		'errors'	=>	$v->errors(),
		'request'	=>	$request
	]);

})->name('password.recover.post');