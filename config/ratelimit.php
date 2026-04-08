<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Rate Limiting Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for rate limiting the API endpoints
    |
    */

    'api_limit' => env('API_RATE_LIMIT', 60),
    'api_decay' => env('API_RATE_DECAY', 1), // in minutes

];
