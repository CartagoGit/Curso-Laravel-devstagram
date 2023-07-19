<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'username',
		'path'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}

	public function likes(): HasMany
	{
		return $this->hasMany(Like::class);
	}

	public function followers(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'followers', 'user_followed_id', 'user_follower_id');
	}
	// {
	// 	return $this->hasMany(Follower::class, 'user_followed_id');
	// }


	public function followed(): BelongsToMany
	{
		// return $this->hasMany(Follower::class, 'user_follower_id');
		return $this->belongsToMany(User::class, 'followers', 'user_follower_id', 'user_followed_id');
	}

	public function isFollowedBy(User $follower): bool
	{
		//* Asi antes porque buscabamos en la tabla de Followers, pero al hacer el belongs to many, lo que busca es un usuario con dicho id
		// return $this->followers->contains('user_follower_id', $follower->id);
		return $this->followers->contains($follower->id);
	}

	public function isFollowing(User $followed): bool
	{

		//* Asi antes porque buscabamos en la tabla de Followers, pero al hacer el belongs to many, lo que busca es un usuario con dicho id
		// return $this->followed->contains('user_followed_id', $followed->id);
		return $this->followed->contains($followed->id);
	}

	public function numberOfFollowers(): int
	{
		return $this->followers->count();
	}

	public function numberOfFollowed(): int
	{
		return $this->followed->count();
	}
}
