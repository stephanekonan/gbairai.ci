<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->role === 'admin') {

            return $next($request);

        } else {

            Alert::toast('Accès non autorisé', 'error')->position('top');
            return redirect()->back();
        }
    }
}
