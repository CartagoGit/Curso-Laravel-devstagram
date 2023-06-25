<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageNotFoundController extends Controller
{
    //
    static public function redirectAuth(): RedirectResponse
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return redirect('/login');
    }


}
