<?php

use Carbon\Carbon;//date-time library of php

$app->get('/login', $guest(), function() use($app) {
	$app->render('auth/login.php');
})->name('login');

$app->post('/login', $guest(), function() use($app){
	
	$request	=	$app->request;

	$identifier =	$request->post('identifier');
	$password	=	$request->post('password');
	$remember	=	$request->post('remember');

	$v = $app->validation;

	$v->validate([
		'identifier'	=>	[$identifier,'required'],
		'password'		=>	[$password,'required']
	]);

	if ($v->passes()) {
		//log in the user
		/*$user	=	$app->user
				->where('active', true)
				->where('username',$identifier)
				->orWhere('email',$identifier)
				->first();*///this is wrong fatal error
		$user	=	$app->user//dont use orWhere
				->where('active', true)
				->where(function($query) use($identifier) {
					return $query->where('email', $identifier)
								 ->orWhere('username', $identifier);
				})->first();

		if ($user && $app->hash->passwordCheck($password,$user->password)) {	
			$_SESSION[$app->config->get('auth.session')] = $user->id;
			//check if rememerMe is an option
			if ($remember === 'on') {
				$rememberIdentifier = $app->randomlib->generateString(128);
				$rememberToken = $app->randomlib->generateString(128);
				//Update database table
				$user->updateRememberCredentials(
					$rememberIdentifier,
					$app->hash->hash($rememberToken)
				);
				//setTheCookieAndDon'tDareToEat lol lol lol
				$app->setCookie(//carbon is date time library for php
					$app->config->get('auth.remember'),
					"{$rememberIdentifier}___{$rememberToken}",
					Carbon::parse('+1 week')->timestamp
				);
			}

			$app->flash('global','log in Successfull');
			$app->response->redirect($app->urlFor('login'));

			//$app->response->redirect($app->urlFor('home'));

		} else {
			$app->flash('global','|log in error|');
			$app->response->redirect($app->urlFor('login'));

			//$app->response->redirect($app->urlFor('home'));
		}		
	}

	$app->render('auth/login.php', [
		'errors'	=>	$v->errors(),
		'request'	=>	$request
	]);

})->name('login.post');