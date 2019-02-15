<?php
$app->get('/comment', $authenticated(), function() use ($app) {
	$app->render('forum/forum.php');
});
$app->post('/comment', $authenticated(), function() use ($app) {

	$request	=	$app->request;
       
	$comment =	$request->post('comment');
	$testid  =  $request->post('testid');

	//validate
	$v = $app->validation;

	$v->validate([
		'comment'	=>	[$comment,'required']
	]);

	if ($v->passes()) {
		$app->post->create([
		'user_id'		=>	$app->auth['id'],
		'post'			=>	$comment,
		'post_username'	=>	$app->auth['username'],
		'parent_id'		=>	$testid
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

})->name('comment.post');