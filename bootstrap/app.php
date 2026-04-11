<?php

use App\Http\Middleware\ApiRateLimit;
use App\Http\Middleware\ApiSecurityHeaders;
use App\Http\Middleware\CorsRestrictDomain;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            CorsRestrictDomain::class,
        ]);

        $middleware->api(append: [
            ApiSecurityHeaders::class,
            ApiRateLimit::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(function (Exception $e) {
            Log::error('API Request Error', [
                'exception' => $e,
                'ip' => request()->ip(),
            ]);
        });
    })->create();
