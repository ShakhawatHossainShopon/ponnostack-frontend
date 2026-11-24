<?php

/**
 * Client Storefront Lifecycle & Status Gatekeeper
 */

declare(strict_types=1);

require_once __DIR__ . '/ApiClient.php';

// Fetch Store details using the configured Store UUID
$store = ApiClient::getStore();

// 1. Check if Storefront was found
if (!$store) {
    http_response_code(503);
    ?>
    <!DOCTYPE html>
    <html lang="bn">
    <head>
        <meta charset="UTF-8">
        <title>স্টোর কনফিগারেশন ত্রুটি | Configuration Error</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white border border-red-200 rounded-2xl p-6 text-center shadow-lg">
            <h2 class="text-lg font-bold text-red-600 mb-2">স্টোর কনফিগারেশন ত্রুটি</h2>
            <p class="text-xs text-slate-600 mb-4">
                প্রদত্ত Store UUID (<code><?= htmlspecialchars(ApiClient::getStoreUuid()) ?></code>) মাদার প্ল্যাটফর্মে খুঁজে পাওয়া যায়নি অথবা মাদার এপিআই অফলাইনে রয়েছে।
            </p>
            <div class="text-[11px] text-slate-400">
                অনুগ্রহ করে <code>config.php</code> ফাইলের <code>store_uuid</code> ও <code>api_url</code> যাচাই করুন।
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// 2. STATUS & SUBSCRIPTION GATEKEEPER: Check if Storefront is active and subscription is valid
$isSubscriptionExpired = (!empty($store['subscription_ends_at']) && strtotime($store['subscription_ends_at']) <= time()) || in_array($store['status'] ?? '', ['expired', 'suspended', 'inactive']);
if ($store['status'] !== 'active' || $isSubscriptionExpired) {
    http_response_code(403);
    require __DIR__ . '/views/blocked.php';
    exit;
}

// Common Store Variables for Views
$storeName     = $store['name'];
$storeSlug     = $store['slug'];
$storeCurrency = $store['currency'] ?? 'BDT';
$ownerName     = $store['owner_name'];
$ownerEmail    = $store['owner_email'];
$ownerPhone    = $store['owner_phone'] ?? '';
$storeAddress  = $store['address'] ?? '';
$storeBkashNumber = ApiClient::getBkashNumber();
$socials       = $store['social_links'] ?? [];
$logoUrl       = !empty($store['logo_url']) ? $store['logo_url'] : ApiClient::assetUrl($store['logo'] ?? null);

// Build full URLs for store hero carousel banners (strictly live banners uploaded by store owner, up to 5)
$rawBanners   = is_array($store['banners'] ?? null) ? $store['banners'] : [];
$storeBanners = !empty($store['banner_urls']) && is_array($store['banner_urls'])
    ? array_values(array_filter(array_slice($store['banner_urls'], 0, 5)))
    : array_values(array_filter(array_map(fn($b) => ApiClient::assetUrl($b), array_slice($rawBanners, 0, 5))));

require_once __DIR__ . '/themes.php';

// Support Live Preview Theme & Palette query parameters (?preview_template=...&preview_palette=...)
$isThemePreview = false;
$storeForTheme  = $store;
if (!empty($_GET['preview_template'])) {
    $storeForTheme['template_id'] = trim((string)$_GET['preview_template']);
    $isThemePreview = true;
}
if (!empty($_GET['preview_palette'])) {
    $storeForTheme['color_palette'] = trim((string)$_GET['preview_palette']);
    $isThemePreview = true;
}

$themeData      = resolveStoreTheme($storeForTheme);
$templateId     = $themeData['template_id'];
$paletteId      = $themeData['palette_id'];
$activeTemplate = $themeData['template'];
$activePalette  = $themeData['palette'];
$brandShades    = $activePalette['shades'];

// Global categories check: Unnamed category is ignored on customer storefront.
// Only custom categories created by the merchant count towards $hasCategories.
$categoriesRes  = ApiClient::get('categories');
$allCategories  = (!empty($categoriesRes['success']) && is_array($categoriesRes['data'])) ? $categoriesRes['data'] : [];
$categories     = array_values(array_filter($allCategories, function($c) {
    return empty($c['is_default']) && strtolower((string)($c['slug'] ?? '')) !== 'unnamed' && strtolower((string)($c['name'] ?? '')) !== 'unnamed';
}));
$hasCategories  = !empty($categories);

