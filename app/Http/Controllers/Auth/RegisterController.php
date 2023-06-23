<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //* Validaciones
        $this->validate($request, [
            'nombre' => 'required|min:3|max:30',
            'nick' => 'required|min:3|max:20|unique:users,username',
            'email' => 'required|min:5|max:60|email|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
        ]);
        User::create([
            'name' => $request->nombre,
            'username' => $request->nick,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }
}
