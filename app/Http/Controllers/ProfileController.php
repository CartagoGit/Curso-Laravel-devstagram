<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

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
		$request->request->add(['path' => \Illuminate\Support\Str::slug($request->nick)]);
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
		]);
		dd('guardar');
	}
}
