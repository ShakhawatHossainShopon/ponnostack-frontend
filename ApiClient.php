<?php

/**
 * Reusable Client API Client (PHP)
 * 
 * Provides unified, reusable HTTP methods to communicate with the Mother Platform API.
 */
class ApiClient
{
    private static ?array $config = null;
    private static ?array $storeCache = null;

    /**
     * Load configuration from config.php
     */
    private static function init(): void
    {
        if (self::$config === null) {
            self::$config = require __DIR__ . '/config.php';
        }
    }

    /**
     * Get Base API URL
     */
    public static function getApiUrl(): string
    {
        self::init();
        return rtrim(self::$config['api_url'], '/');
    }

    /**
     * Detect tenant subdomain or store slug dynamically from HTTP_HOST.
     *
     * Supported formats:
     * - rohimstore.ponnostack.shop -> 'rohimstore'
     * - rohimstore.ponnostack.com  -> 'rohimstore'
     * - rohimstore.localhost       -> 'rohimstore'
     * - rohimstore.myshop.com.bd   -> 'rohimstore'
     * - www.rohimstore.domain.com  -> 'rohimstore'
     * - localhost, 127.0.0.1, or platform root domains -> null (fallback to config/default)
     *
     * @return string|null Store slug or null if not a tenant subdomain
     */
    public static function detectSubdomain(): ?string
    {
        $httpHost = $_SERVER['HTTP_HOST'] ?? '';
        if (empty($httpHost)) {
            return null;
        }

        // Strip port (e.g. "rohimstore.localhost:8080" -> "rohimstore.localhost")
        $host = strtolower(trim(explode(':', $httpHost)[0]));

        // Ignore direct IP addresses (127.0.0.1, 192.168.x.x, etc.)
        if (filter_var($host, FILTER_VALIDATE_IP)) {
            return null;
        }

        // Strip leading 'www.'
        if (str_starts_with($host, 'www.')) {
            $host = substr($host, 4);
        }

        // Split hostname into domain segments
        $parts = explode('.', $host);
        $count = count($parts);

        // Single segment hostname e.g. "localhost" has no subdomain
        if ($count <= 1) {
            return null;
        }

        // Reserved / system subdomains belonging to the mother platform
        $reserved = [
            'www', 'admin', 'api', 'app', 'portal', 'mail', 'cpanel',
            'webmail', 'mother', 'central', 'control', 'ns1', 'ns2',
            'dev', 'stage', 'staging', 'test', 'demo', 'localhost'
        ];

        // 1. Check if configured BASE_DOMAIN is matched (e.g. "rohimstore.ponnostack.shop")
        self::init();
        $baseDomain = strtolower(trim((string)(self::$config['base_domain'] ?? 'ponnostack.shop')));
        if (!empty($baseDomain) && str_ends_with($host, '.' . $baseDomain)) {
            $sub = substr($host, 0, -(strlen($baseDomain) + 1));
            if (str_starts_with($sub, 'www.')) {
                $sub = substr($sub, 4);
            }
            if (!empty($sub) && !in_array($sub, $reserved, true) && preg_match('/^[a-z0-9_-]+$/', $sub)) {
                return $sub;
            }
        }

        // 2. Local testing with .localhost (e.g. "shikhon.localhost")
        if ($count === 2 && $parts[1] === 'localhost') {
            $sub = $parts[0];
            return (!in_array($sub, $reserved, true) && preg_match('/^[a-z0-9_-]+$/', $sub)) ? $sub : null;
        }

        // 3. Generic 3+ level domain e.g. "sub.domain.com" or "sub.domain.com.bd"
        if ($count >= 3) {
            $sub = $parts[0];
            if (!in_array($sub, $reserved, true) && preg_match('/^[a-z0-9_-]+$/', $sub)) {
                return $sub;
            }
        }

        return null;
    }

    /**
     * Resolve the active Store Identifier (Slug or UUID)
     *
     * Resolution order:
     * 1. Query parameter (?store=...) - allows explicit testing, preview & overriding
     * 2. Subdomain from HTTP_HOST (e.g. "rohimstore" from "rohimstore.ponnostack.shop")
     * 3. Configured default STORE_UUID in config.php / .env
     */
    public static function getStoreIdentifier(): string
    {
        self::init();

        // 1. Explicit query param (?store=...)
        if (!empty($_GET['store'])) {
            return trim((string)$_GET['store']);
        }

        // 2. Dynamic Subdomain Detection from HTTP_HOST
        $subdomain = self::detectSubdomain();
        if (!empty($subdomain)) {
            return $subdomain;
        }

        // 3. Fallback to configured default STORE_UUID
        return trim(self::$config['store_uuid'] ?? '');
    }

    /**
     * Get active Store UUID
     * If the store profile is already cached, returns the real canonical UUID.
     */
    public static function getStoreUuid(): string
    {
        self::init();

        // If store profile is cached, always return its canonical UUID
        if (!empty(self::$storeCache['uuid'])) {
            return self::$storeCache['uuid'];
        }

        return self::getStoreIdentifier();
    }

    /**
     * Get configured Customer Portal URL
     */
    public static function getPortalUrl(): string
    {
        self::init();
        return trim(self::$config['portal_url'] ?? 'http://localhost/Ponnostack/portal/login.php');
    }

    /**
     * Get configured Universal bKash Number for monthly bills
     */
    public static function getBkashNumber(): string
    {
        self::init();
        return trim(self::$config['bkash_number'] ?? '01642956206');
    }

    /**
     * Get Mother Platform Root URL (for media/asset resolution)
     */
    public static function getMotherRootUrl(): string
    {
        self::init();
        if (!empty(self::$config['asset_url'])) {
            return rtrim(self::$config['asset_url'], '/');
        }

        $apiUrl = self::getApiUrl();
        // Cleanly strip trailing /backend, /api, /public, etc. to get the root platform asset URL
        $rootUrl = preg_replace('#/(backend|api|public)(/.*)?$#i', '', $apiUrl);
        return rtrim($rootUrl, '/');
    }

    /**
     * Resolve full media asset URL
     *
     * @param string|null $relativePath e.g. "uploads/logos/xyz.png"
     * @return string|null
     */
    public static function assetUrl(?string $relativePath): ?string
    {
        if (empty($relativePath)) {
            return null;
        }

        if (str_starts_with($relativePath, 'http://') || str_starts_with($relativePath, 'https://')) {
            return $relativePath;
        }

        return self::getMotherRootUrl() . '/' . ltrim($relativePath, '/');
    }

    /**
     * Reusable HTTP Request Engine
     *
     * @param string $method GET, POST, PUT, DELETE
     * @param string $endpoint API path relative to /api (e.g. "/tenants/demo-uuid")
     * @param array $data Body data (for POST/PUT) or Query params (for GET)
     * @return array Standard response array ['success' => bool, 'data' => mixed, 'message' => string]
     */
    public static function request(string $method, string $endpoint, array $data = [], array $customHeaders = []): array
    {
        self::init();
        $url = self::getApiUrl() . '/' . ltrim($endpoint, '/');

        if (strtoupper($method) === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        }

        $method = strtoupper($method);
        $headers = array_merge([
            'Accept: application/json',
            'Content-Type: application/json',
            'X-Store-UUID: ' . self::getStoreUuid(),
        ], $customHeaders);

        $bodyContent = null;
        if (in_array($method, ['POST', 'PUT', 'PATCH']) && !empty($data)) {
            $bodyContent = json_encode($data);
        }

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            if ($bodyContent !== null) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyContent);
            }

            $raw = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlErr = curl_error($ch);
            curl_close($ch);

            if ($raw === false || !empty($curlErr)) {
                return [
                    'success' => false,
                    'message' => 'Connection failed: ' . ($curlErr ?: 'Mother platform unreachable'),
                    'data'    => null,
                    'status'  => 500,
                ];
            }
        } else {
            // Pure native PHP stream context fallback (Zero cURL dependency)
            $options = [
                'http' => [
                    'method'        => $method,
                    'header'        => implode("\r\n", $headers),
                    'timeout'       => 6,
                    'ignore_errors' => true,
                ],
            ];

            if ($bodyContent !== null) {
                $options['http']['content'] = $bodyContent;
            }

            $context = stream_context_create($options);
            $raw = @file_get_contents($url, false, $context);

            $httpCode = 200;
            if (isset($http_response_header) && is_array($http_response_header)) {
                foreach ($http_response_header as $headerLine) {
                    if (preg_match('#HTTP/[0-9\.]+\s+([0-9]+)#', $headerLine, $m)) {
                        $httpCode = (int)$m[1];
                        break;
                    }
                }
            }

            if ($raw === false) {
                return [
                    'success' => false,
                    'message' => 'Connection failed: Unable to connect to Mother platform via HTTP stream.',
                    'data'    => null,
                    'status'  => 500,
                ];
            }
        }

        $decoded = json_decode($raw, true);
        if (!is_array($decoded)) {
            return [
                'success' => false,
                'message' => 'Invalid JSON response from Mother API (HTTP ' . $httpCode . ')',
                'data'    => null,
                'status'  => $httpCode,
            ];
        }

        $decoded['status'] = $httpCode;
        return $decoded;
    }

    /**
     * Send GET request
     */
    public static function get(string $endpoint, array $params = []): array
    {
        return self::request('GET', $endpoint, $params);
    }

    /**
     * Send POST request
     */
    public static function post(string $endpoint, array $body = []): array
    {
        return self::request('POST', $endpoint, $body);
    }

    /**
     * Fetch & Cache the Current Store Profile using Store UUID
     *
     * @param bool $forceRefresh
     * @return array|null
     */
    public static function getStore(bool $forceRefresh = false): ?array
    {
        if (self::$storeCache !== null && !$forceRefresh) {
            return self::$storeCache;
        }

        $identifier = self::getStoreIdentifier();
        if (empty($identifier)) {
            return null;
        }

        $response = self::get("tenants/{$identifier}");

        if (!empty($response['success']) && !empty($response['data'])) {
            self::$storeCache = $response['data'];
            return self::$storeCache;
        }

        return null;
    }
}
