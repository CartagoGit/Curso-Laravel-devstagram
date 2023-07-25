<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class LikePost extends Component

{


	public  $liked; //* Post or Comment

	public $kindLike; //* post | comment

	public bool $isLikedByUser;


	public function render()
	{
		// $this->isLikedByUser =  $this->liked->checkUserLiked(auth()->user());
		return view('livewire.like-post');
	}

	public function mount($liked)
	{
		$this->isLikedByUser =  $liked->checkUserLiked(auth()->user());
	}

	public function clickLike()
	{
		$this->isLikedByUser ? $this->_removeLike() : $this->_doLike();
		$this->isLikedByUser =  $this->liked->checkUserLiked(auth()->user());
	}

	private function _doLike()
	{

		$data = $this->_getKindForeignModel();
		$foreign = $data['foreign'];
		$user = $data['user'];

		$foreignHasLike = $foreign->likes()->where('user_id', $user->id)->exists();

		if ($foreignHasLike) {
			$this->destroy(request());
			return;
		}
		//* Podemos acceder a ello ya que post y comment tienen hasMany(Like::class) entonces laravel
		//* asocia directamente el id del post o comment con el id del post_id o comment_id de la tabla likes
		$foreign->likes()->create([
			'user_id' => $user->id,
			// 'post_id' => $foreign->id
		]);
	}

	private function _removeLike()
	{
		$data = $this->_getKindForeignModel();
		$foreign = $data['foreign'];
		$user = $data['user'];

		$foreign->likes()->where('user_id', $user->id)->delete();
	}

	private function _getKindForeignModel()
	{
		$kindLike = $this->kindLike;
		if (!$kindLike) {
			dd('No request with var kindLike => "post" or "comment"');
		}
		$foreign = $kindLike == 'post' ? Post::find(json_decode($this->liked)->id) : Comment::find(json_decode($this->liked)->id);
		$user = auth()->user();
		if (!$user) {
			return;
		}
		$user = User::find($user->id);
		return ['user' => $user, 'foreign' => $foreign];
	}
}
