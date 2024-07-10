<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Suport\Facades\Auth;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if($token ==''){
            return response()->json(['error'=>'Unauthorized. token is not available'], 401);
        }
        $defaultToken = "vg@123";
        if( $token != $defaultToken){
            return response()->json(['error'=>'Unauthorized. token not valid'], 401);
        }

        return $next($request);
    }
}
