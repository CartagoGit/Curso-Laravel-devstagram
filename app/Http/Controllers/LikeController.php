<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	//

	public function store()
	{
		$typeLike = request()->typeLike;
		if (!$typeLike) {
			dd('No request with var typeLike => "post" or "comment"');
		}
		// $foreign = json_decode(request()->foreign);
		$foreign = $typeLike == 'post' ? Post::find(json_decode(request()->foreign)->id) : Comment::find(json_decode(request()->foreign)->id);
		$user = auth()->user();
		if (!$user) {
			return back();
		}

		$user = User::find($user->id);
		$foreignHasLike = $foreign->likes()->where('user_id', $user->id)->exists();

		if ($foreignHasLike) {
			$this->destroy($user, $foreign);
			return back();
		}
		//* Podemos acceder a ello ya que post y comment tienen hasMany(Like::class) entonces laravel
		//* asocia directamente el id del post o comment con el id del post_id o comment_id de la tabla likes
		$foreign->likes()->create([
			'user_id' => $user->id,
			// 'post_id' => $foreign->id
		]);

		// if ($foreign instanceof Post) {

		// 	$postHasLike = $foreign->likes()->where('user_id', $user->id)->exists();

		// 	if ($postHasLike) {
		// 		$this->destroy($user, $foreign);
		// 		return back();
		// 	}
		// 	$foreign->likes()->create([
		// 		'user_id' => $user->id,
		// 		'post_id' => $foreign->id
		// 	]);
		// } else if ($foreign instanceof Comment) {

		// 	$commentHasLike = $foreign->likes()->where('user_id', $user->id)->exists();
		// 	if ($commentHasLike) {
		// 		$this->destroy($user, $foreign);
		// 		return back();
		// 	}
		// 	$foreign->likes()->create([
		// 		'user_id' => $user->id,
		// 		'comment_id' => $foreign->id
		// 	]);
		// }

		return back();
	}

	public function destroy(User $user, $foreign)
	{
		if ($foreign instanceof Post) {
			$foreign->likes()->where([['post_id', $foreign->id], ['user_id', $user->id]])->delete();
		} else if ($foreign instanceof Comment) {
			$foreign->likes()->where([['comment_id', $foreign->id], ['user_id', $user->id]])->delete();
		}
	}
}
