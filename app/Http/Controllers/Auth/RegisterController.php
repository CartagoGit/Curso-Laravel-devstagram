<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);

        // dd($request->only('email', 'password'));

        //* Validaciones
        $this->validate($request, [
            'nombre' => 'required|min:3|max:30',
            'nick' => 'required|min:3|max:20|unique:users',
            'email' => 'required|min:5|max:60|email|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
        ]);

        dd('Creando validaciones...');
    }
}
