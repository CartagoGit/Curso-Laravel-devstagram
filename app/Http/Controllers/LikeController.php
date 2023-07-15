<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	//

	public function store(User $user,  $foreign)
	{
		if ($foreign instanceof Post) {
			$postHasLike = !!Post::find($foreign->id)->likes()->where(['user_id', $user->id]);
			if($postHasLike){
				$this->destroy($user, $foreign);
				return;
			}
			$foreign->likes()->create([
				'user_id' => $user->id,
				'post_id' => $foreign->id
			]);
		} else if ($foreign instanceof Comment) {
			$commentHasLike = !!Comment::find($foreign->id)->likes()->where(['user_id', $user->id]);
			if($commentHasLike){
				$this->destroy($user, $foreign);
				return;
			}
			$foreign->likes()->create([
				'user_id' => $user->id,
				'comment_id' => $foreign->id
			]);
		}
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
