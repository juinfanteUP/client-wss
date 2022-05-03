<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySession
{
    public function handle(Request $req, Closure $next)
    {
        if(!Session()->has('user') )
        {
            return response()->json(null, 401);
        }

        return $next($req);
    }
}
