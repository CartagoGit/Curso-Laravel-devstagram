<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	//
	public function __invoke()
	{
		// Obtener a quienes seguimos
		$followed = auth()->user()->followed->pluck('id')->toArray();
		dd($followed);
		return view('home');
	}
}
