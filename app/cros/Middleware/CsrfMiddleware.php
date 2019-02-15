<?php

namespace cros\Middleware;
//use Exception;//this removes \from throw \Exception
use Slim\Middleware;

/**
* CSRF PROTECTION
*/
class CsrfMiddleware extends Middleware
{	
	protected $key;

	public function call()
	{
		$this->key = $this->app->config->get('csrf.key');

		$this->app->hook('slim.before', [$this, 'check']);//attaching a hook

		$this->next->call();
	}	

	public function check()
	{
		//echo 'CSRF ka chutiya kata';
		### first set the key in this session ###
		if (!isset($_SESSION[$this->key])) {
			$_SESSION[$this->key] = $this->app->hash->hash(
				$this->app->randomlib->generateString(128)
			);
		}
		//echo $_SESSION[$this->key];
		$token = $_SESSION[$this->key];

		if (in_array($this->app->request()->getMethod(), ['POST','PUT','DELETE'])) {#getmethod checks which type of method it is??? 
			### if this is the case we will pull out the submitted token from the form
			$submittedToken = $this->app->request()->post($this->key) ?: '';//check if the key is available if its not available set it to empty string
			##Now we need to check that token submitted through the form matches
			if (!$this->app->hash->hashCheck($token, $submittedToken)) {
				die('CSRF token mismatch');
				//or
				//throw new \Exception('CSRF token mismatch');
			}
		}
		$this->app->view()->appendData([
			'csrf_key'		=>	$this->key,
			'csrf_token'  	=>	$token
		]);
	}
}