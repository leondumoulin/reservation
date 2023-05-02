<?php
namespace App\Http\Middleware;

use Closure;

class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiKey = config('app.api_key');

        if ($request->header('X-API-KEY') !== $apiKey) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
