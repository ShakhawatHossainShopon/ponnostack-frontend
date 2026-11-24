<?php

/**
 * Ponnostack Client Storefront Configuration
 * 
 * Powered by zero-dependency .env environment variable loader
 */

require_once __DIR__ . '/Env.php';

// Auto-load .env or .env.local
if (file_exists(__DIR__ . '/.env')) {
    Env::load(__DIR__ . '/.env');
}
if (file_exists(__DIR__ . '/.env.local')) {
    Env::load(__DIR__ . '/.env.local');
}

return [
    // Mother Platform API URL
    'api_url'    => Env::get('API_URL', 'http://localhost/Ponnostack/backend/api'),

    // Unique Store UUID assigned to this client tenant in Mother Control Panel
    'store_uuid' => Env::get('STORE_UUID', 'e86c2f55-4eae-429c-8220-f55d817f742a'),

    // Customer Portal URL
    'portal_url' => Env::get('PORTAL_URL', 'http://localhost/Ponnostack/portal/login.php'),

    // Store Cache duration (in seconds, 0 to disable during development)
    'cache_time' => (int)Env::get('CACHE_TIME', 0),

    // Application Environment
    'app_env'    => Env::get('APP_ENV', 'production'),
];
