<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Cors
{
    public function handle($request, Closure $next)
    {
        if (App::environment('production')) {
            $allowedOrigins = [
                'http://localhost:5173',
                'https://localhost:5173',
                'http://www.truffler.id',
                'https://www.truffler.id',
            ];

            $origin = $request->headers->get('Origin');

            if ($origin && in_array($origin, $allowedOrigins)) {
                return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin)
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            }
        } else {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        }

        return abort(403, 'Unauthorized');
    }
}
