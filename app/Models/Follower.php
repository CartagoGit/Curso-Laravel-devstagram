<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Follower extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_followed_id',
		'user_follower_id',
	];

	public function userFollowed()
	{
		return $this->belongsTo(User::class, 'user_followed_id');
	}

	public function userFollower()
	{
		return $this->belongsTo(User::class, 'user_follower_id');
	}
}
