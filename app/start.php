<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;

use cros\User\User;
use cros\User\postdb;
use cros\User\frienddb;
use cros\Mail\Mailer; 
use cros\Helpers\Hash;
use cros\validation\validator; 

use cros\Middleware\BeforeMiddleware;
use cros\Middleware\CsrfMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');					//error will be shown now for dev purpose

define('INC_ROOT',dirname(__DIR__));				//dir path name make easy to include file with less path names

//echo INC_ROOT;

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([#3 configuration options
	'mode'				=>	file_get_contents(INC_ROOT . '/mode.php'),
	'view'				=> 	new Twig(),
	'templates.path'	=>	INC_ROOT . '/app/views'	#here template was giving error
]);
/**
* attaching middleware to slim
*/
//$app->add(new cros\Middleware\BeforeMiddleware);#not using this instead use below one by mention it in use ""
$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);

//echo $app->config('mode');

$app->configureMode($app->config('mode'),function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/development.php");
});													//same as $app.configureMode(//passingdynamically here fileData and a callback function)

//var_dump($app->config);

//echo $app->config->get('db.host');

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

//$user = new \cros\User\User;

$app->container->set('user', function() {
	return new User;								//now we have this user model inside slim container 
});

$app->container->set('post', function() {
	return new postdb;
});

$app->container->set('friend', function() {
	return new frienddb;
});

$app->container->singleton('hash', function() use($app){	//dependency injection (singlton means it don't have to change)
	return new Hash($app->config);
});

$app->container->singleton('validation', function() use($app){
	return new Validator($app->user, $app->hash, $app->auth);
});

$app->container->singleton('mail', function() use($app){
	//making custom use of php mailer
	$mailer	= new PHPMailer(true);
	//down two are very important new add!!
	$mailer->isSMTP();
	$mailer->SMTPOptions = array(
    'ssl' => array(
        	'verify_peer' => false,
        	'verify_peer_name' => false,
        	'allow_self_signed' => true
    	)
	);
	$mailer->SMTPDebug = 2;
	$mailer->Host 			=	$app->config->get('mail.host');
	$mailer->SMTPAuth 		=	$app->config->get('mail.smtp_auth');
	$mailer->SMTPSecure 	=	$app->config->get('mail.smtp_secure');
	$mailer->Port 			=	$app->config->get('mail.port');
	$mailer->Username 		=	$app->config->get('mail.username');
	$mailer->Password 		=	$app->config->get('mail.password');

	$mailer->isHTML($app->config->get('mail.html'));

	return new Mailer($app->view, $mailer);
});

$app->container->singleton('randomlib', function(){
	$factory = new RandomLib;
	return $factory->getMediumStrengthGenerator();
});

//var_dump($app->user);

$app->get('/', function() use($app) {#rendering slim view
	$app->render('home.php');
});

$view = $app->view();

$view->parserOptions = [
	'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [//sytax mistake was giving error
	new TwigExtension
];

$hash = $app->hash;

//echo $app->hash->password('prateek');














//test route
/*
$app->get('/test/:name', function($name) {
	echo "this is a test route {$name}.";
});
*/