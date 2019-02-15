<?php

namespace cros\user;

use Illuminate\Database\Eloquent\Model as Eloquent;

class user extends Eloquent
{
	protected $table = 'users';//this is the name of table

	protected $fillable = [
		'email',
		'username',
		'password',
		'first_name',
		'last_name',
		'active',
		'active_hash',
		'recover_hash',
		'remember_identifier',
		'remember_token',
	];

	//updating user model

	public function getFullName()
	{
		if (!$this->first_name || !$this->last_name) {
			return null;
		}

		return "{$this->first_name} {$this->last_name}"; 
	}

	public function getFullNameOrUsername()
	{
		return $this->getFullName() ?: $this->username;#?: this means if $this->getFullName() exists output thihs otherWise output $this->username
	}

	public function activateAccount()
	{
		$this->update([
			'active'		=>	true,
			'active_hash'	=>	null
		]);
	}

	public function getAvatarUrl($options = [])
	{
		$size = isset($options['size']) ? $options['size']: 80;
		return 'https://s.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=identicon';
	}

	public function updateRememberCredentials($identifier, $token)
	{
		$this->update([
			'remember_identifier'	=>	$identifier,
			'remember_token'		=>	$token
		]);
	}

	public function removeRememberCredentials()
	{
		$this->updateRememberCredentials(null,null);
	}

	public function hasPermission($permission)
	{
		return (bool) $this->permissions->{$permission};
	}

	public function isAdmin()
	{
		return $this->hasPermission('is_admin');
	}

	public function permissions()
	{
		return $this->hasOne('cros\User\userPermission', 'user_id');##userid is the foreign key//hasOne because user has one set of permissions
	}

	public function postbelongsto()
	{
		return $this->hasOne('cros\User\postdb', 'user_id');
	}

	public function friendsOfMine()
	{
		return $this->belongsToMany('cros\User\User', 'friends_table','user_id','friend_id');
	}

	public function friendOf()
	{
		return $this->belongsToMany('cros\User\User','friends_table','friend_id','user_id');
	}

	public function friends()
	{
		return $this->friendsOfMine()->wherePivot('status',true)->get()->merge($this->friendOf()->wherePivot('status',true)->get());
	}

	public function friendRequests()
	{
		return $this->friendsOfMine()->wherePivot('status',false)->get();
	}

	public function friendRequestsPending()
	{
		return $this->friendOf()->wherePivot('status',false)->get();
	}

	public function hasFriendRequestPending(User $user)
	{
		return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
	}

	public function hasFriendRequestRecieved(User $user)
	{
		return (bool) $this->friendRequests()->where('id', $user->id)->count();
	}

	public function addFriend(User $user)
	{
		$this->friendOf()->attach($user->id);
	}

	public function acceptFriendRequest(User $user)
	{
		$this->friendRequests()->where('id',$user->id)->first()->pivot->update([
			'status'	=> 	true
		]);
	}

	public function isFriendWith(User $user)
	{
		return (bool) $this->friends()->where('id', $user->id)->count();
	}

}

//garbage methods

/*public function getfriendsName()
	{
		$x = $this->belongsTo('cros\User\frienddb','friend_id');
		return $x->username;
	}


	public function user()
	{
    	return $this->belongsTo('users');
	}

	public function fri()
	{
    	return $this->hasMany('friends_table');
	}


	protected $variable = users::with('fri')->find(1);

	public function getfriendsName()
	{
		return $variable;
	}
	*/