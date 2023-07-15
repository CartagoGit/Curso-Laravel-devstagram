<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserProfile
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$userId = $request->route('user')->id;
		$loggedInUserId = auth()->id();
		if ($userId != $loggedInUserId) {
			// Si los IDs no coinciden, significa que el usuario está intentando editar el perfil de otro usuario
			// abort(403, 'No tienes permiso para acceder a esta página.');
			return back();
		}
		return $next($request);
	}
}
