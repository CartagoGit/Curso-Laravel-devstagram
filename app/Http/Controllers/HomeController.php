<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	//
	public function __invoke()
	{
		// Obtener a quienes seguimos
		$ids = null;
		if (auth()->check() && auth()->user()->followed->count() > 0) {
			$ids = auth()->user()->followed->pluck('id')->toArray();
		}else {
			$ids = Post::all()->pluck('user_id')->toArray();
		}
		// array_push($ids, auth()->id());
		$posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);

		return view('home', ['posts' => $posts]);
	}
}
