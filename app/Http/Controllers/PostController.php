<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth'])->except(['show', 'index']);
	}
	//
	public function index(string $userPath)

	{

		if (!User::where('path', $userPath)->exists()) {
			$actualUser = auth()->user();
			return redirect('/' . $actualUser->path);
		}
		$user = User::where('path', $userPath)->first();
		$posts = Post::where('user_id', $user->id)->paginate();

		// REVIEW Hardcodeado
		$followers = ['algo', 'algomas', 'algo', 'algomas', 'algo', 'algomas', 'algo', 'algomas', 'algo', 'algomas'];
		$followed = ['seguido', 'seguido2', 'seguido3', 'seguido', 'seguido2', 'seguido3', 'seguido', 'seguido2', 'seguido3', 'seguido', 'seguido2', 'seguido3', 'seguido', 'seguido2', 'seguido3'];

		return view('main.dashboard', ['user' => $user, 'posts' => $posts, 'followers' => $followers, 'followed' => $followed]);
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

		// Post::create([
		// 	'user_id' => auth()->id(),
		// 	'title' => $request->titulo,
		// 	'description' => $request->descripcion,
		// 	'image' => $request->imagen,
		// ]);

		//* Otra forma

		// $post = new Post();
		// $post->user_id = auth()->id();
		// $post->title = $request->titulo;
		// $post->description = $request->descripcion;
		// $post->image = $request->imagen;
		// $post->save();


		//* Una tercera forma de guardar los datos
		$request->user()->posts()->create([
			'title' => $request->titulo,
			'description' => $request->descripcion,
			'image' => $request->imagen,
			// 'user_id' => auth()->id(),
		]);


		return redirect()->route('posts.index', auth()->user()->path);
	}

	public function show(string $userPath, int $postId)
	{

		$post = Post::find($postId);
		$user = User::where('path', $userPath)->first();

		if (!$post || !$user) {
			return redirect()->route('posts.index', auth()->user()->path);
		}
		return view('posts.show', ['user' => $user, 'post' => $post]);
	}
}
