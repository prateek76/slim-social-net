<?php

namespace cros\validation;

/**
* Validator
*/
use Violin\Violin;

use cros\User\User;
use cros\Helpers\hash;

class Validator extends Violin
{
	protected $user;
	protected $auth;
	protected $hash;

	public function __construct(User $user, Hash $hash, $auth = null)//passing user model??
	{
		$this->user = $user;
		$this->hash = $hash;
		$this->auth = $auth;

		$this->addFieldMessages([
			'email'	=>	[
				'uniqueEmail'	=>	'Ese correo electrónico ya existe'
			],
			'username'	=>	[
				'uniqueUsername'	=> 'Ese nombre de usuario ya está en uso'
			]
		]);

		//password change wala rule
		$this->addRuleMessages([
			'matchesCurrentPassword'	=>	'Eso no coincide con su contraseña actual'
		]);
	}

	public function validate_uniqueEmail($value,$input,$args)
	{
		//if value exists in database return false
		$user = $this->user->where('email',$value);//part of query builder within elequent

		/*if ($user->count()) {
			return false;
		}
	
		return true;*/

		##checking if whe user edit profile the current email let it be submitted
		if($this->auth && $this->auth->email === $value) {//authenticated and email matches
			return true;
		}

		return ! (bool) $user->count();//cast to bool
	}
	public function validate_uniqueUsername($value,$input,$args)
	{
		return !(bool) $this->user->where('username',$value)->count();
	}

	public function validate_matchesCurrentPassword($value,$input,$args)
	{
		if ($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) {
			return true;
		}
		//or we will return error everyTime
		return false;
	}
}