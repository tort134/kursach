<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{

    public function handle(Request $request, Closure $next): Response{
        $user = User::where('remember_token', $request->bearerToken())->first();

        if(!$user) throw new ApiException(403, 'Login Failed');

        $request->user = $user;

        return $next($request);
    }
}
