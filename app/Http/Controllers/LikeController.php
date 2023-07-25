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
		// $kindLike = request()->kindLike;
		// if (!$kindLike) {
		// 	dd('No request with var kindLike => "post" or "comment"');
		// }
		// // $foreign = json_decode(request()->foreign);
		// $foreign = $kindLike == 'post' ? Post::find(json_decode(request()->foreign)->id) : Comment::find(json_decode(request()->foreign)->id);
		// $user = auth()->user();
		// if (!$user) {
		// 	return back();
		// }

		// $user = User::find($user->id);
		$data = $this->_getKindForeignModel(request());
		$foreign = $data['foreign'];
		$user = $data['user'];

		$foreignHasLike = $foreign->likes()->where('user_id', $user->id)->exists();

		if ($foreignHasLike) {
			$this->destroy(request());
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

	// public function destroy(User $user, $foreign)
	// {

	// 	if ($foreign instanceof Post) {
	// 		$foreign->likes()->where([['post_id', $foreign->id], ['user_id', $user->id]])->delete();
	// 	} else if ($foreign instanceof Comment) {
	// 		$foreign->likes()->where([['comment_id', $foreign->id], ['user_id', $user->id]])->delete();
	// 	}
	// }

	public function destroy(Request $request)
	{
		$data = $this->_getKindForeignModel($request);
		$foreign = $data['foreign'];
		$user = $data['user'];

		$foreign->likes()->where('user_id', $user->id)->delete();
		return back();
	}

	/**
	 * ? Recupera el el comentario o post como tipo foraneo y el usuario que le dio like
	 */
	private function _getKindForeignModel(Request $request)
	{
		$kindLike = $request->kindLike;
		if (!$kindLike) {
			dd('No request with var kindLike => "post" or "comment"');
		}
		$foreign = $kindLike == 'post' ? Post::find(json_decode($request->foreign)->id) : Comment::find(json_decode($request->foreign)->id);
		$user = auth()->user();
		if (!$user) {
			return back();
		}
		$user = User::find($user->id);
		return ['user' => $user, 'foreign' => $foreign];
	}
}
