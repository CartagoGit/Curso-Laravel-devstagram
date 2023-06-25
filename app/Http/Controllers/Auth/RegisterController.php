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
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //* Convertimos el valor de username en slug / formato de url
        // para evitar que puedan repetirse los username y nos casque un error

        $request->request->add(['path' => Str::slug($request->nick)]);

        //* Validaciones
        $this->validate($request, [
            'nombre' => 'required|min:3|max:30',
            // 'nick' => 'required|min:3|max:20|unique:url,username',
            'nick' => [
                'required',
                'min:3',
                'max:20',
                'unique:users,username',
                function ($attribute, $value, $fail) use ($request) {
                    $existingPath = User::where('path', $request->path)->exists();
                    if ($existingPath) {
                        $fail('El valor del campo nick ya está en uso.');
                    }
                },
            ],

            'email' => 'required|min:5|max:60|email|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
        ]);
        User::create([
            'name' => $request->nombre,
            'username' => $request->nick,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'path' => $request->path,
        ]);

        //* Autenticar usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        //* Otra forma de autenticar
        auth()->attempt($request->only(['email', 'password']));

        return redirect()->route('dashboard');
    }
}
