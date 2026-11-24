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
     * Get configured Store UUID
     */
    public static function getStoreUuid(): string
    {
        self::init();
        if (!empty($_GET['store'])) {
            return trim((string)$_GET['store']);
        }
        return trim(self::$config['store_uuid'] ?? '');
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
     * Get Mother Platform Root URL (for media/asset resolution)
     */
    public static function getMotherRootUrl(): string
    {
        $apiUrl = self::getApiUrl();
        // Remove trailing '/api'
        return preg_replace('/\/api$/', '', $apiUrl);
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

        $uuid = self::getStoreUuid();
        if (empty($uuid)) {
            return null;
        }

        $response = self::get("tenants/{$uuid}");

        if (!empty($response['success']) && !empty($response['data'])) {
            self::$storeCache = $response['data'];
            return self::$storeCache;
        }

        return null;
    }
}
