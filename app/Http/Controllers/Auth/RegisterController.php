<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //* Convertimos el valor de username en slug / formato de url
        // para evitar que puedan repetirse los username y nos casque un error

        $request->request->add(['path' => $request->nick, 'nick' => Str::slug($request->nick)]);

        //* Validaciones
        $this->validate($request, [
            'nombre' => 'required|min:3|max:30',
            'nick' => 'required|min:3|max:20|unique:url,username',

            'email' => 'required|min:5|max:60|email|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
        ]);
        User::create([
            'name' => $request->nombre,
            'username' => $request->originalNick,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'path' => $request->path,
            'path' => $request->path,
        ]);
    }
}
