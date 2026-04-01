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
        $user_id = $request->user()?->id;

        if (!$user_id) {


        }





        return $next($request);
    }
}
