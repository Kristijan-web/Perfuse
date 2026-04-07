<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // ukoliko je koriscen auth middleware trebao bi da imam pristup user-u na $request->user()
        // $user_id = $request->user()?->id;
        // $role = $request->user()->role;

        // mora da dohvatim njegov naziv role
        // - Znaci mora join sa roles

        // proverava da li je user ulogovan 
        if (!Auth::check() || Auth::user()->role->name != 'admin') {
            return redirect()->back();
        }



        // if ($role->name != 'admin') {
        //     return redirect()->back();
        // }



        return $next($request);
    }
}
