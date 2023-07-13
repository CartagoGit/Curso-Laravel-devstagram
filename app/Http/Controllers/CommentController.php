<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

	//
	public function store(Request $request, string $userPath, int $postId)
	{


		$this->validate($request, [
			'comentario' => 'required|max:2200|min:10',
		]);
		$userCommented = auth()->user();
		Comment::create([
			'user_id' => $userCommented->id,
			'post_id' => $postId,
			'comment' => $request->comentario,
		]);


		return back()->with('message', 'Comentario agregado correctamente');
	}
}
