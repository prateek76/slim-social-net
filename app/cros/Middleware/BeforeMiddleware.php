<?php

namespace cros\Middleware;

use Slim\Middleware;

class BeforeMiddleware extends Middleware
{
	
	public function call()
	{
		//echo "string";
		$this->app->hook('slim.before',[$this,'run']);

		$this->next->call();//running next call
	}

	public function run()
	{
		if (isset($_SESSION[$this->app->config->get('auth.session')])) {
			$this->app->auth = $this->app->user->where('id',$_SESSION[$this->app->config->get('auth.session')])->first();#grabing first record
		}

		#check if cookie is set
		$this->checkRememberMe();

		######## 	appending data to view for removing register and login options for specific users ########
		$this->app->view()->appendData([//this checks if user is signedIn in all views
			'auth'		=>	$this->app->auth, ##this value is false if user is ot signed in and an object if user is signed in
											  ##this 'auth' is used in navigation page using twig we are appending data to view
			'base_url'	=>	$this->app->config->get('app.url')
		]);
	}
	//login if remembered me is checked by the user
	protected function checkRememberMe()
	{
		if ($this->app->getCookie($this->app->config->get('auth.remember')) && !$this->app->auth) {
			//echo 'cookieSet';
			$data = $this->app->getCookie($this->app->config->get('auth.remember'));
			$credentials = explode('___',$data);

			if (empty(trim($data)) || count($credentials) !== 2) {
				$this->app->response->redirect($this->app->urlFor('home'));
			} else {
				$identifier = $credentials[0];
				$token		= $this->app->hash->hash($credentials[1]);

				$user = $this->app->user
						->where('remember_identifier', $identifier)
						->first();

				if ($user) {
					if ($this->app->hash->hashCheck($token, $user->remember_token)) {
						//if it matches log the user in
						$_SESSION[$this->app->config->get('auth.session')] = $user->id;
						$this->app->auth = $this->app->user->where('id', $user->id)->first();
					} else {
						//remove the remember credentials
						$user->removeRememberCredentials();
					}
				}

			}
		}
	}
}