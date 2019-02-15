<?php

$app->get('/change-password', $authenticated(), function () use($app) {
	$app->render('auth/password/change.php');
})->name('password.change');

$app->post('/change-password', $authenticated(), function () use($app) {
	$request = $app->request;

	$passwordOld 		= $app->request->post('password_old');
	$password   		= $app->request->post('password');
	$passwordConfirm    = $app->request->post('password_confirm');

	$v = $app->validation;

	$v->validate([
		'password_old'		=>	[$passwordOld, 'required|matchesCurrentPassword'],
		'password'			=>	[$password, 'required|min(6)'],
		'password_confirm'	=>	[$passwordConfirm, 'required|matches(password)']
	]);
	
	if ($v->passes()) {
		//$app->auth is the current user
		$user = $app->auth;
		$user->update([
			'password'	=>	$app->hash->password($password)
		]);
		//send an email for success
		$app->mail->send('email/auth/password/change.php', [], function($message) use($user) {
		$message->to($user->email);
		$message->subject('password changed');
	});
		//flash a global message
		$app->flash('global', 'password changed successfully');
		$app->response->redirect($app->urlFor('home'));
	}
	else 
	{
		//send an email for security reason
		$user = $app->auth;
		
		$app->mail->send('email/auth/password/breach.php', [], function($message) use($user) {
		$message->to($user->email);
		$message->subject('password change attempted');
	});
}
	$app->render('auth/password/change.php', [
		'errors'	=>	$v->errors()
	]);
})->name('password.change.post');