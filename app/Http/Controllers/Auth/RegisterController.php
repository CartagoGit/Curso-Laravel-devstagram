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
            'nombre' => 'required|min:3|max:255',
            'nick' => 'required|min:3|max:255',
            'email' => 'required|min:5|max:255|email',
            'password' => 'required|confirmed|min:8|max:255',
        ]);
    }
}
