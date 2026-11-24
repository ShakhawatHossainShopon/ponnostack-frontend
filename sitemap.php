<?php
/**
 * Dynamic XML Sitemap Generator for Client Storefront
 * Generates Google-compliant XML sitemap with all active products, categories, and static pages.
 */
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

header('Content-Type: application/xml; charset=utf-8');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$baseUrl = $protocol . $host . $baseDir;

// Fetch products & categories
$productsRes = ApiClient::get('products', ['status' => 'active']);
$products = (!empty($productsRes['success']) && is_array($productsRes['data'])) ? $productsRes['data'] : [];

$categoriesRes = ApiClient::get('categories');
$categories = (!empty($categoriesRes['success']) && is_array($categoriesRes['data'])) ? $categoriesRes['data'] : [];

$today = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    
    <!-- 1. Storefront Homepage -->
    <url>
        <loc><?= htmlspecialchars($baseUrl) ?>/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <?php if (!empty($logoUrl)): ?>
        <image:image>
            <image:loc><?= htmlspecialchars($logoUrl) ?></image:loc>
            <image:title><?= htmlspecialchars($storeName) ?> Logo</image:title>
        </image:image>
        <?php endif; ?>
    </url>

    <!-- 2. Active Products (Highest SEO Value) -->
    <?php foreach ($products as $p): 
        $pSlug = $p['slug'] ?? $p['uuid'] ?? '';
        if (empty($pSlug)) continue;
        $pUrl = $baseUrl . '/product/' . rawurlencode($pSlug);
        $pImg = !empty($p['image_url']) ? $p['image_url'] : ApiClient::assetUrl($p['image'] ?? null);
    ?>
    <url>
        <loc><?= htmlspecialchars($pUrl) ?></loc>
        <lastmod><?= !empty($p['updated_at']) ? date('Y-m-d', strtotime($p['updated_at'])) : $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
        <?php if (!empty($pImg)): ?>
        <image:image>
            <image:loc><?= htmlspecialchars($pImg) ?></image:loc>
            <image:title><?= htmlspecialchars($p['name'] ?? '') ?></image:title>
            <?php if (!empty($p['description'])): ?>
            <image:caption><?= htmlspecialchars(mb_substr(strip_tags($p['description']), 0, 100, 'UTF-8')) ?></image:caption>
            <?php endif; ?>
        </image:image>
        <?php endif; ?>
    </url>
    <?php endforeach; ?>

    <!-- 3. Active Categories -->
    <?php foreach ($categories as $cat): 
        $cSlug = $cat['slug'] ?? $cat['uuid'] ?? '';
        if (empty($cSlug)) continue;
        $cUrl = $baseUrl . '/category?cat=' . rawurlencode($cSlug);
    ?>
    <url>
        <loc><?= htmlspecialchars($cUrl) ?></loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>

    <!-- 4. Special Offers & Discounts -->
    <url>
        <loc><?= htmlspecialchars($baseUrl) ?>/discount</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- 5. About Us -->
    <url>
        <loc><?= htmlspecialchars($baseUrl) ?>/about</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    <!-- 6. Contact Us -->
    <url>
        <loc><?= htmlspecialchars($baseUrl) ?>/contact</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
