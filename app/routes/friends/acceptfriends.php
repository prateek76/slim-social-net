<?php

$app->get('/accept/:username', $authenticated(), function($username) use ($app) {
	$user = $app->user->where('username', $username)->first();
	if (!$user) {
		$app->flash('global', 'user cannot be found.');
		$app->notFound();
	}

	if (!$user->hasFriendRequestRecieved($app->auth)) {
		$app->response->redirect($app->urlFor('home'));
	}

	else{
		$user->acceptFriendRequest($app->auth);
		$app->flash('global', 'accepted');
		$app->response->redirect($app->urlFor('home'));
	}


})->name('friend.accept');