<?php
//first route
$app->get('/', function() use($app) {
	$posts = $app->post->where('parent_id', NULL)->get();
	$users = $app->user->where('active', true)->get();
	$comments = $app->post->whereNotNull('parent_id')->get();
	//render the view
	$app->render('home.php',[
		'posts'	=> $posts,
		'users'	=> $users,
		'comments'	=> $comments
	]);
})->name('home');//route name is now home

$app->get('/flash', function() use($app) {
	$app->flash('global','You have registered!');
	$app->response->redirect($app->urlFor('home'));
});