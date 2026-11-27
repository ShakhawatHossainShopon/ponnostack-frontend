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
    'api_url'    => Env::get('API_URL', 'https://ponnostack.shop/backend/api'),

    // Mother Platform Asset / Uploads Root URL (leave blank to auto-resolve from api_url)
    'asset_url'  => Env::get('ASSET_URL', ''),

    // Unique Store UUID assigned to this client tenant in Mother Control Panel
    'store_uuid' => Env::get('STORE_UUID', '286208db-136a-4e6f-ac8d-eba06755ed7a'),

    // Base Platform Domain for Subdomain Multi-tenancy (e.g. ponnostack.shop)
    'base_domain' => Env::get('BASE_DOMAIN', 'ponnostack.shop'),

    // Customer Portal URL
    'portal_url' => Env::get('PORTAL_URL', 'http://localhost/Ponnostack/portal/login.php'),

    // Universal bKash Number for SaaS Monthly Bill Payments
    'bkash_number' => Env::get('BKASH_NUMBER', '01642956206'),

    // Store Cache duration (in seconds, 0 to disable during development)
    'cache_time' => (int)Env::get('CACHE_TIME', 0),

    // Application Environment
    'app_env'    => Env::get('APP_ENV', 'production'),
];
