<?php

$app->get('/u/:username', function($username) use($app) {
	
	$user = $app->user->where('username', $username)->first();
	$users = $app->user->where('active', true)->get();
	if (!$user) {
		$app->notFound();
	}

	$app->render('user/profile.php',[
		'user'	=>	$user,
		'users'	=>	$users	//user model passed into view
	]);

})->name('user.profile');