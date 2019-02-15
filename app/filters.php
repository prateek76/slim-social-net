<?php
#konsa routes access karne dena hai aur kon sa nahi
$authenticationCheck = function($required) use ($app) {#required is a boolean
	return function() use ($required, $app) {
		//echo "string";
		if ((!$app->auth && $required) || ($app->auth && !$required)) {
			$app->redirect($app->urlFor('home'));
		}
	};
};

#authenticated middleware
$authenticated = function() use($authenticationCheck) {
	return $authenticationCheck(true);
};

#guest middleware
$guest = function() use($authenticationCheck) {
	return $authenticationCheck(false);
};
#admin middleware
$admin = function() use($app)
{
	return function() use($app) {
		if (!$app->auth || !$app->auth->isAdmin()) {
			$app->flash('global', 'You are not an admin.');
			$app->redirect($app->urlFor('home'));
		}
	};
};
