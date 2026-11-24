<?php

declare(strict_types=1);

/**
 * Lightweight Zero-Dependency Environment Variable Loader
 */
class Env
{
    private static bool $loaded = false;

    /**
     * Load environment variables from a given file path
     */
    public static function load(string $filePath): void
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip empty lines and comment lines
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Must contain key=value delimiter
            if (!str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key === '') {
                continue;
            }

            // Remove surrounding single or double quotes
            $len = strlen($value);
            if ($len >= 2) {
                if (($value[0] === '"' && $value[$len - 1] === '"') ||
                    ($value[0] === "'" && $value[$len - 1] === "'")) {
                    $value = substr($value, 1, -1);
                }
            }

            // Set environment variable
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }

        self::$loaded = true;
    }

    /**
     * Retrieve environment variable with optional default
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if (!self::$loaded) {
            $baseDir = dirname(__DIR__);
            if (file_exists($baseDir . '/.env')) {
                self::load($baseDir . '/.env');
            }
        }

        $val = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($val === false || $val === null || $val === '') {
            return $default;
        }

        return $val;
    }
}
