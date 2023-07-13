<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

	//
	public function store(Request $request, User $user, Post $post)
	{

		$this->validate($request, [
			'comentario' => 'required|max:2200|min:10',
		]);
		Comment::create([
			'user_id' => auth()->id(),
			'post_id' => $post->id,
			'comment' => $request->comentario,
		]);


		return back();
	}
}
