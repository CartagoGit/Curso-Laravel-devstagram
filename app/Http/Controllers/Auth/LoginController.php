<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {

        if (auth()->check()) {

            return redirect()->route('posts.index', auth()->user()->path);
        }
        return view('auth.login');
    }

    public function store()
    {

        //* Validaciones
        $this->validate(request(), [
            'credencial' => 'required',
            'password' => 'required',
        ]);


        //* Autenticar usuario
        $credentials = [
            'username' => request()->credencial,
            'email' => request()->credencial,
            'password' => request()->password,
        ];


        if (
            auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['password']], request()->remember)
            || auth()->attempt(['username' => $credentials['username'], 'password' => $credentials['password']], request()->remember)
        ) {
            //* Redireccionar
            return redirect()->route('posts.index', auth()->user()->path);
        }

        //* Si no se ha podido autenticar, vuelve a la página anterior con el siguiente mensaje
        return back()->with('loginFailed', 'Credenciales no válidas');
    }
}
