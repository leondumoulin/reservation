<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $jwtToken = config('app.jwt_token');
        try {
            $token = JWTAuth::parseToken()->authenticate();
            if ($token !== $jwtToken) {
                return response('Unauthorized', 401);
            }
        } catch (JWTException $e) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
