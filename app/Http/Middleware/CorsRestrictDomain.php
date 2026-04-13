<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CorsRestrictDomain
{
    /**
     * Allowed origin domain
     */
    protected string $allowedOrigin;

    public function __construct()
    {
        $this->allowedOrigin = config('cors.allowed_origin', env('FRONTEND_DOMAIN', 'http://localhost:3000'));
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->header('Origin');
        $hasOrigin = ! empty($origin);
        $isAllowed = $hasOrigin && $this->isAllowedOrigin($origin);

        Log::debug('CORS Check', [
            'origin' => $origin,
            'allowed_origin' => $this->allowedOrigin,
            'is_allowed' => $isAllowed,
            'method' => $request->getMethod(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        if (! $hasOrigin) {
            Log::warning('Request rejected: missing Origin header (likely from Postman/curl/VPN)');

            return response()->json([
                'error' => 'Forbidden',
                'message' => 'API requests rejected',
            ], 403)
                ->header('Vary', 'Origin');
        }

        if (! $isAllowed) {
            Log::warning('CORS request rejected for origin: '.$origin);

            return response()->json([
                'error' => 'Forbidden',
                'message' => 'API requests rejected',
            ], 403)
                ->header('Vary', 'Origin');
        }
        if ($request->isMethod('OPTIONS')) {
            return response()->noContent()
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->header('Access-Control-Max-Age', '86400')
                ->header('Vary', 'Origin');
        }

        $response = $next($request);

        $response->header('Access-Control-Allow-Origin', $origin)
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->header('Vary', 'Origin');

        return $response;
    }

    /**
     * Check if the origin is allowed
     */
    protected function isAllowedOrigin(string $origin): bool
    {
        $allowed = config('cors.allowed_origins', [$this->allowedOrigin]);

        foreach ($allowed as $allowedOrigin) {
            if ($origin === $allowedOrigin) {
                return true;
            }
        }

        return false;
    }
}
