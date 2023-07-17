<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
	//
	public function __construct()
	{

		$this->middleware('auth');
		$this->middleware('checkprofile');
	}
	public function index(User $user)
	{

		return view('profile.index', [
			'user' => $user
		]);
	}

	public function store(User $user)
	{
		$request = request();
		$request->request->add(['path' => Str::slug($request->nick)]);


		$this->validate($request, [
			'nombre' => 'required|min:3|max:30',
			// 'nick' => 'required|min:3|max:20|unique:url,username',
			'nick' => [
				'required',
				'min:3',
				'max:20',
				// 'unique:users,username',
				function ($attribute, $value, $fail) use ($request) {
					$isCurrentUser = $request->user()->username === $value;
					if (!$isCurrentUser && User::where('username', $value)->exists()) {
						$fail('El valor del campo nick ya está en uso.');
					}
				},
			],

			'email' => [
				'required',
				'min:5',
				'max:60',
				'email',
				function ($attribute, $value, $fail) use ($request) {
					$isCurrentUser = $request->user()->email === $value;
					if (!$isCurrentUser && User::where('email', $value)->exists()) {
						$fail('El valor del campo email ya está en uso.');
					}
				},
			],
			'password' => 'sometimes|nullable|confirmed|min:6|max:255',
			'imagen' => 'sometimes|nullable|string|max:255'
		]);

		// Guardar cambios
		$userBD = User::find($user->id);
		$userBD->name = $request->nombre;
		$userBD->username = $request->nick;
		$userBD->email = $request->email;
		if ($request->password) {
			$userBD->password = bcrypt($request->password);
		}
		$userBD->path = $request->path;
		$userBD->image = $request->imagen;
		$userBD->save();

		return redirect()->route('posts.index', $userBD->path)->with('status', 'Perfil actualizado correctamente');
		// dd('guardar');

	}
}
