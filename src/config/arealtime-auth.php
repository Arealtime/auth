<?php

return [
    'user_model' => 'App\\Models\\User',
    'access_token_name' => 'access_token_name',
    'refresh_token_name' => 'refresh_token_name',
    'create_token' => 'my-app',
    'jwt' => [
        'ttl' => 60,
        'refresh_ttl' => 3600
    ]
];
