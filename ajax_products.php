<?php

/**
 * Client Storefront - Dynamic Products AJAX Pagination & Infinite Scroll Endpoint
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/sample_data.php';
require_once __DIR__ . '/views/template_cards.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $page = max(1, (int)($_GET['page'] ?? 1));
    $limit = max(1, min(24, (int)($_GET['limit'] ?? 8)));
    $category = trim((string)($_GET['category'] ?? ''));
    $search = trim((string)($_GET['q'] ?? ''));
    $sort = trim((string)($_GET['sort'] ?? ''));
    $tplNum = (int)($_GET['tpl'] ?? ($activeTemplate['number'] ?? 1));
    $cardType = trim((string)($_GET['card_type'] ?? 'universal'));
    $currency = $storeCurrency ?? 'BDT';

    // Fetch active products from API or sample fallback
    $productsRes = ApiClient::get('products', ['status' => 'active']);
    $isSample = empty($productsRes['success']) || !is_array($productsRes['data']) || count($productsRes['data']) === 0;
    $allProducts = !$isSample
        ? $productsRes['data']
        : getSampleProducts();

    // 1. Filter by category if requested
    $filtered = $allProducts;
    if ($category !== '') {
        $catLower = mb_strtolower($category, 'UTF-8');
        $filtered = array_values(array_filter($filtered, function ($p) use ($catLower) {
            $slug = mb_strtolower((string)($p['category_slug'] ?? ''), 'UTF-8');
            $uuid = mb_strtolower((string)($p['category_uuid'] ?? ''), 'UTF-8');
            $name = mb_strtolower((string)($p['category_name'] ?? ''), 'UTF-8');
            return $slug === $catLower || $uuid === $catLower || $name === $catLower;
        }));
    }

    // 2. Filter by search query if requested
    if ($search !== '') {
        $qLower = mb_strtolower($search, 'UTF-8');
        $filtered = array_values(array_filter($filtered, function ($p) use ($qLower) {
            $name = mb_strtolower((string)($p['name'] ?? ''), 'UTF-8');
            $cat = mb_strtolower((string)($p['category_name'] ?? ''), 'UTF-8');
            $desc = mb_strtolower(strip_tags((string)($p['description'] ?? '')), 'UTF-8');
            return str_contains($name, $qLower) || str_contains($cat, $qLower) || str_contains($desc, $qLower);
        }));
    }

    // 3. Sorting
    if ($sort === 'price_asc') {
        usort($filtered, fn($a, $b) => (float)($a['effective_price'] ?? $a['retailer_price'] ?? 0) <=> (float)($b['effective_price'] ?? $b['retailer_price'] ?? 0));
    } elseif ($sort === 'price_desc') {
        usort($filtered, fn($a, $b) => (float)($b['effective_price'] ?? $b['retailer_price'] ?? 0) <=> (float)($a['effective_price'] ?? $a['retailer_price'] ?? 0));
    } elseif ($sort === 'discount') {
        usort($filtered, fn($a, $b) => (int)($b['discount_percent'] ?? 0) <=> (int)($a['discount_percent'] ?? 0));
    }

    $total = count($filtered);
    $offset = ($page - 1) * $limit;
    $pagedItems = array_slice($filtered, $offset, $limit);
    $hasMore = ($offset + count($pagedItems)) < $total;

    // Render cards HTML (trimmed to guarantee clean element parsing)
    $cardsHtml = '';
    foreach ($pagedItems as $prod) {
        if ($cardType === 'category') {
            $cardsHtml .= trim(renderCategoryProductCard($prod, $currency));
        } else {
            $cardsHtml .= trim(renderUniversalProductCard($prod, $tplNum, $currency));
        }
    }

    echo json_encode([
        'success'      => true,
        'page'         => $page,
        'limit'        => $limit,
        'total'        => $total,
        'count'        => count($pagedItems),
        'has_more'     => $hasMore,
        'html'         => $cardsHtml
    ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
    echo json_encode([
        'success'  => false,
        'message'  => $e->getMessage(),
        'has_more' => false,
        'html'     => ''
    ]);
}
