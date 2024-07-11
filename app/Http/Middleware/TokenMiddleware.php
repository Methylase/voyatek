<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Suport\Facades\Auth;
use App\Models\User;

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
        $user = User::where('api_token',$token)->first();
        if( !$user){
            return response()->json(['error'=>'Unauthorized. token not valid'], 401);
        }
         $request->merge(["auth_user" =>$user]);
        return $next($request);
    }
}
