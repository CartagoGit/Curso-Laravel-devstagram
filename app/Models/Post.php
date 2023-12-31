<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'title',
		'description',
		'image',
	];

	public function user()
	{
		return $this->belongsTo(User::class)->select(['name', 'username', 'path']);
		// return $this->belongsTo(User::class)->select(['name', 'username']);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function checkUserLiked(User $user)
	{
		// return $this->likes()->contains('user_id', $user->id);
		return $this->likes()->where('user_id', $user->id)->exists();
	}
}
