<?php

$app->get('/Timeline', $authenticated(), function() use($app) {

	$posts = $app->post->where('user_id',$app->auth->id)->where('parent_id', NULL)->get();//can use desc here also
	$comments = $app->post->whereNotNull('parent_id')->get();
	$users = $app->user->where('active', true)->get();
	//render the view
	$app->render('/forum/forum.php',[
		'posts'		=> $posts,
		'users'		=> $users,
		'comments'	=> $comments
	]);
})->name('forum.post');

$app->post('/Timeline', $authenticated(), function() use($app) {


	$request	=	$app->request;
       
	$post =	$request->post('post');

	//validate
	$v = $app->validation;

	$v->validate([
		'post'	=>	[$post,'required']
	]);

	if ($v->passes()) {
		$app->post->create([
		'user_id'		=>	$app->auth['id'],
		'post'			=>	$post,
		'post_username'	=>	$app->auth['username']
	]);
	/*echo($app->auth['id']) ;
	die();*/
	$app->flash('global','posted');
	$app->response->redirect($app->urlFor('home'));
	}
	else{
		//flash an error
		//redirect the user
	}

})->name('post.post');