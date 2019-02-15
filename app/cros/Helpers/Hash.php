<?php

namespace cros\Helpers;

class Hash
{
	protected $config;

	public function __construct($config)
	{
		$this->config = $config;

		//var_dump($this->config);
	}

	public function password($password)
	{
		return password_hash(
			$password,
			$this->config->get('app.hash.algo'),
			['cost' => $this->config->get('app.hash.cost')]
		);
	}

	public function passwordCheck($password, $hash)
	{
		return password_verify($password, $hash);
	}
	###random string hashing###
	public function hash($input)
	{
		return hash('sha256', $input);
	}
	###unhash AND check###
	public function hashCheck($know, $user)
	{
		return hash_equals($know, $user);#bool hash_equals ( string $known_string , string $user_string )
	}
}