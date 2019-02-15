<?php

namespace cros\user;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* posts db connection
*/
class frienddb extends Eloquent
{
	
	protected $table = 'friends_table';

	protected $fillable = [
		'user_id',
		'friend_id',
		'status',
	];

	public $timestamps = false;
}

