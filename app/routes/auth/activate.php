<?php

$app->get('/activate', $guest(),function() use($app){

	$request 			=	$app->request;//request obj

	$email 				= 	$request->get('email');
	$identifier 		= 	$request->get('identifier');

	//die($identifier);

	//hash the identifier
	$hashedIdentifier 	= 	$app->hash->hash($identifier);

	$user				=	$app->user->where('email',$email)
								  	  ->where('active',false)
								  	  ->first();

	if(!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier))
	#user can't be found or the hash doesn't matches
	{
		#if that happens show unauthorized error or error message
		$app->flash('global','Chutia Kaat Gaya');
		$app->response->redirect($app->urlFor('home'));
	} else {
		$user->activateAccount();
		$app->flash('global','Activate ho gaya');
		$app->response->redirect($app->urlFor('home'));
	}

})->name('activate');