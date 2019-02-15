<?php

$app->get('/password-reset', $guest(), function() use($app){

	//till now anyone can open password reset page
	$request 			= $app->request();

	$email 				= $request->get('email');
	$identifier 		= $request->get('identifier');

	$hashedIdentifier 	= $app->hash->hash($identifier);

	$user 				= $app->user->where('email', $email)->first();


	//match the hash or redirect
	if (!$user) {
		$app->response->redirect($app->urlFor('home'));
	}

	//if hash doesn't exist in database
	if(!$user->recover_hash) {
		$app->response->redirect($app->urlFor('home'));
	}

	//if hash doesn't match
	if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
		$app->response->redirect($app->urlFor('home'));
	}

	$app->render('auth/password/reset.php', [
		'email'			=>	$user->email,
		'identifier'	=>	$identifier
	]);

})->name('password.reset');

$app->post('/password-reset', $guest(), function() use ($app) {
	/*Get requests*/
	//till now anyone can open password reset page
	$request 			= $app->request();

	$email 				= $request->get('email');
	$identifier 		= $request->get('identifier');

	//post requests
	$password 			= $request->post('password');
	$passwordConfirm 	= $request->post('password_confirm');

	$hashedIdentifier 	= $app->hash->hash($identifier);

	$user 				= $app->user->where('email', $email)->first();


	//match the hash or redirect
	if (!$user) {
		$app->response->redirect($app->urlFor('home'));
	}

	//if hash doesn't exist in database
	if(!$user->recover_hash) {
		$app->response->redirect($app->urlFor('home'));
	}

	//if hash doesn't match
	if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)) {
		$app->response->redirect($app->urlFor('home'));
	}

	//validation

	$v = $app->validation;

	$v->validate([
		'password'			=> [$password,'required|min(6)'],
		'password_confirm'	=> [$passwordConfirm, 'required|matches(password)']
	]);

	if($v->passes()) {
		$user->update([
			'password'		=>	$app->hash->password($password),
			'recover_hash'	=>	null
		]);

		$app->flash('global', 'your password has been reset successfully :)');
		$app->response->redirect($app->urlFor('home'));
	}
	
	//if any error show in the view
	$app->render('auth/password/reset.php', [
		'errors'		=>	$v->errors(),
		'email'			=>	$user->email,
		'identifier'	=>	$identifier
	]);

})->name('password.reset.post');