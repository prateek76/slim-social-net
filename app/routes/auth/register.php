<?php

use cros\User\userPermission;

$app->get('/register', $guest(),function() use ($app) {
	$app->render('auth/register.php');
})->name('register');

$app->post('/register', $guest(),function() use($app) {
	//echo 'Form posted.';

	$request = $app->request;

	$email 				= 		$request->post('email');
	$username 			= 		$request->post('username');
	$password 			=	 	$request->post('password');
	$passwordConfirm 	= 		$request->post('password_confirm');

	$v	=	$app->validation;

	$v->validate([
		'email'				=>	[$email,'required|email|uniqueEmail'],
		'username'  		=>	[$username,'required|alnumDash|max(20)|uniqueUsername'],
		'password'			=>	[$password,'required|min(6)'],
		'password_confirm'	=>	[$passwordConfirm,'required|matches(password)'],
	]);

	if ($v->passes()) {

		$identifier = $app->randomlib->generateString(128);

		$user = $app->user->create([
		'email'			=>	$email,
		'username'		=>	$username,
		'password'		=>	$app->hash->password($password),
		'active'		=>	false,
		'active_hash'	=>	$app->hash->hash($identifier)
	]);

	### User Permissions after creating user ###
		$user->permissions()->create(userPermission::$defaults);//we can manually do false in is admin but we have defined a constant so using scopeResolution(::)##and user permission i s namespaced

		//die($identifier);

	//send an email here
	$app->mail->send('email/auth/registered.php',['user' => $user, 'identifier' => $identifier], function($message) use($user) {
		$message->to($user->email);
		$message->subject('Thanks for registering');
	});


	$app->flash('global', 'You have been registered.');
	$app->response->redirect($app->urlFor('home'));
	}

	$app -> render('auth/register.php',[
		'errors'	=>	$v->errors(),
		'request'	=>	$request,
	]);

})->name('register.post');