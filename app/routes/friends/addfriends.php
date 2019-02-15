<?php

$app->get('/addfriend/:username', $authenticated(), function($username) use ($app) {
	$user = $app->user->where('username', $username)->first();
	if (!$user) {
		$app->flash('global', 'user cannot be found.');
		$app->notFound();
	}
	//error a user cannot send friend request to himself
	//still a error
	//fix it
	if ($user->id == $app->auth->id) {
		$app->flash('global', 'not a valid');
		$app->response->redirect($app->urlFor('home'));
	}

	if ($user->hasFriendRequestPending($app->auth) || $app->auth->hasFriendRequestPending($user)) {
		$app->flash('global', 'request already pending.');
		$app->response->redirect($app->urlFor('home'));
	}

	if ($user->isFriendWith($app->auth)) {
		$app->flash('global', 'is already dost ');
		$app->response->redirect($app->urlFor('home'));
	}

	else {
		$user->addfriend($app->auth);
		$app->flash('global', 'friend added');
		$app->response->redirect($app->urlFor('home'));
	}


})->name('addfriends');

/*$app->post('/addfriend/:username', $authenticated(), function($username) use ($app) {
	
	$user = $app->user->where('username', $username)->first();

	if(!$user)
	{
		$app->flash('global', 'user cannot be found.');
		$app->response->redirect($app->urlFor('home'));
	}

})->name('addfriends.post');*/