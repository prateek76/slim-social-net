<?php

$app->get('/users', function() use($app){
	$users = $app->user->where('active', true)->get();//using get() because more than one user
	//render the view
	$app->render('user/all.php', [
		'users'	=> $users//sending array(of all users)
	]);
})->name('users.all');