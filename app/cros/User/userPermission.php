<?php

namespace cros\user;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* this is 2'nd table we are connecting both and with elequot so no innerJoin shit lol lol lol 
*/
class userPermission extends Eloquent
{
	protected $table = 'users_permissions';

	protected $fillable = [
		'is_admin'
	];

	public static $defaults = [
		'is_admin'	=>	false
	];
}