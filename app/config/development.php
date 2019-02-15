<?php
//return array
return [
	'app'=>[
		'url'			=>		'http://localhost',
		'hash'=>[//password hashing algo
		'algo'			=> 		PASSWORD_BCRYPT,
		'cost'			=>		10
		]
	],
	'db'=>[//database settup
		'driver'		=>		'mysql',
		'host'			=>		'localhost',
		'name'			=>		'site',
		'username'		=>		'root',
		'password'		=>		'',
		'charset'		=>		'utf8',
		'collation'		=>		'utf8_unicode_ci',
		'prefix'		=>		''
	],
	'auth'	=>	[
		'session' 		=> 'user_id',
		'remember'		=>	'user_r'
	],
	'mail'				=>[//auth
		'smtp_auth'		=>		true,
		'smtp_secure'	=>		'tls',
		'host'			=>		'smtp.gmail.com',
		'username'		=>		'iec2017029@iiita.ac.in',
		'password'		=>		'',//fill afterwards
		'port'			=>		587,
		'html'			=>		true
	],
	'twig'=> [//twig debugging
		'debug'			=>		true,
	],
	'csrf'=>[
		'key'		=>		'csrf_token'
	]
];