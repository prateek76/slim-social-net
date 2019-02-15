<?php

$app->get('/uf/friends', $authenticated(), function() use ($app) {

	$users = $app->user->where('active', true)->get();

	$app->render('friends/showfriend.php',[
		'users'	=>	$users	//user model passed into view
	]);
})->name('friends.con');