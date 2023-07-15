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
		dd('editar');
		return view('profile.index', [
			'user' => $user
		]);
	}

	public function store()
	{
		dd('guardar');
	}
}
