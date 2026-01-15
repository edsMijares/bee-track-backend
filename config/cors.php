<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'auth/*', 'me'],

    'allowed_methods' => ['*'],

    // 'allowed_origins' => ['http://localhost:3000'],
    'allowed_origins' => ['https://bee-track-frontend.onrender.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
