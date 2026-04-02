<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        dd("ALO BRE JARANE");
        $role = $request->user()->role;

        // mora da dohvatim njegov naziv role
        // - Znaci mora join sa roles


        if ($role->name != 'admin') {
            return redirect()->back();
        }



        return $next($request);
    }
}
