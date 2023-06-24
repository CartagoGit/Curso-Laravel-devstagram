<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store()
    {

        $credencial = request()->credencial;

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

        // if (!auth()->attempt($credentials)) {
        //     return back()->with('status', 'Credenciales no válidas');
        // }
        if (
            auth()->attempt((['email' => $credentials['email'], 'password' => $credentials['password']]))
            || auth()->attempt((['username' => $credentials['username'], 'password' => $credentials['password']]))
        ) {
            //* Redireccionar
            return redirect()->route('dashboard');
        }

        //* Si no se ha podido autenticar, vuelve a la página anterior con el siguiente mensaje
        return back()->with('loginFailed', 'Credenciales no válidas');
    }
}
