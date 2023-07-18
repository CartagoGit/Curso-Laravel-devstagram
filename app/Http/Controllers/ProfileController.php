<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
		//* Comprobamos si el password de verificación es el actual password
		$request = request();
		if (!Hash::check($request->actual_password, auth()->user()->password)) {
			return back()
				->withErrors(['actual_password' => 'Creedencial invalida'])
				->withInput();
		}


		// * Agregar el campo path al request
		$request->request->add(['path' => Str::slug($request->nick)]);

		// * Validaciones
		$this->validate($request, [
			'nombre' => 'required|min:3|max:30',
			'nick' => [
				'required',
				'min:3',
				'max:20',
				Rule::unique('users', 'username')->ignore($user->id),
				// 'unique:users,username',
				// function ($attribute, $value, $fail) use ($request) {
				// 	$isCurrentUser = $request->user()->username === $value;
				// 	if (!$isCurrentUser && User::where('username', $value)->exists()) {
				// 		$fail('El valor del campo nick ya está en uso.');
				// 	}
				// },
				function ($attribute, $value, $fail) use ($request, $user) {
					$currentUser = User::find($user->id);
					$isCurrentUser = $request->user()->path === $currentUser->path;
					$existingPath = User::where('path', $request->path)->exists();
					if ($existingPath  && !$isCurrentUser) {
						$fail('El valor del campo nick ya está en uso.');
					}
				},
			],

			'email' => [
				'required',
				'min:5',
				'max:60',
				'email',
				Rule::unique('users')->ignore($user->id),
				// function ($attribute, $value, $fail) use ($request) {
				// 	$isCurrentUser = $request->user()->email === $value;
				// 	if (!$isCurrentUser && User::where('email', $value)->exists()) {
				// 		$fail('El valor del campo email ya está en uso.');
				// 	}
				// },
			],
			'password' => 'sometimes|nullable|confirmed|min:6|max:255',
			'imagen' => 'sometimes|nullable|string|max:255'
		]);

		//* Guardar cambios
		$userBD = User::find($user->id);
		$userBD->name = $request->nombre;
		$userBD->username = $request->nick;
		$userBD->email = $request->email;
		$userBD->path = $request->path;

		$userBD->image = $request->imagen ?: null;

		if ($request->password) {
			$userBD->password = bcrypt($request->password);
		}
		$userBD->save();

		return redirect()->route('posts.index', $userBD->path)->with('status', 'Perfil actualizado correctamente');
		// dd('guardar');

	}
}
