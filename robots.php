<?php
/**
 * Dynamic Robots.txt Generator for Client Storefront
 */
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

header('Content-Type: text/plain; charset=utf-8');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$baseUrl = $protocol . $host . $baseDir;

echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: /admin/\n";
echo "Disallow: /checkout\n";
echo "\n";
echo "Sitemap: {$baseUrl}/sitemap.php\n";
