<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}
	//
	public function index(string $userPath)
	{
		if (!User::where('path', $userPath)->exists()) {
			$actualUser = auth()->user();
			return redirect('/' . $actualUser->path);
		}
		$user = User::where('path', $userPath)->first();

		return view('main.dashboard', ['user' => $user]);
	}

	public function create()
	{
		return view('posts.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'titulo' => 'required|max:255',
			'descripcion' => 'required|max:2200',
			// 'imagen' => 'required|image'
			'imagen' => 'required'
		]);

		Post::create([
			'user_id' => auth()->id(),
			'title' => $request->titulo,
			'description' => $request->descripcion,
			'image' => $request->imagen,
		]);


		return redirect()->route('posts.index', auth()->user()->path);
	}
}
