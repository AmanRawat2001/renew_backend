<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Configure Cross-Origin Resource Sharing (CORS) for your API.
    | The HandleCors middleware will use this configuration.
    |
    | Note: We have a custom CorsRestrictDomain middleware that runs FIRST
    | to ensure strict CORS enforcement.
    |
    */

    // Paths where CORS should not be checked - empty to effectively disable
    'paths' => [],

    // HTTP methods allowed
    'allowed_methods' => ['*'],

    // Origins allowed - IMPORTANT: Be very restrictive
    'allowed_origins' => [
        env('FRONTEND_DOMAIN', 'http://localhost:3000'),
        'http://localhost:5173',
        'http://localhost:5174',
    ],
    // Origin patterns (regex)
    'allowed_origins_patterns' => [],

    // Headers allowed
    'allowed_headers' => ['*'],

    // Headers exposed to the client
    'exposed_headers' => [],

    // Max cache age in seconds
    'max_age' => 0,

    // Support credentials
    'supports_credentials' => false,

];
