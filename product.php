<?php

/**
 * Client Storefront - Dedicated Standalone Product Details Page
 * 
 * Provides a production-level product details experience with high-res gallery,
 * breadcrumbs, interactive variant selectors (Size & Color), real-time stock status,
 * "Add to Cart", direct "Buy Now" routing to checkout.php, and related products.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/sample_data.php';

$identifier = trim((string)($_GET['slug'] ?? $_GET['id'] ?? $_GET['product'] ?? ''));

$product = null;
if (!empty($identifier)) {
    $res = ApiClient::get("products/{$identifier}");
    if (!empty($res['success']) && !empty($res['data'])) {
        $product = $res['data'];
    }
}

// Fallback: direct database check if API was unreachable or mismatched
if (!$product && !empty($identifier)) {
    try {
        require_once __DIR__ . '/../backend/app/Core/Database.php';
        $pdo = \App\Core\Database::connect();
        $stmt = $pdo->prepare("SELECT p.*, c.name AS category_name, c.slug AS category_slug 
                                FROM products p 
                                LEFT JOIN categories c ON p.category_uuid = c.uuid 
                                WHERE (p.uuid = :u OR p.slug = :s) LIMIT 1");
        $stmt->execute(['u' => $identifier, 's' => $identifier]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            require_once __DIR__ . '/../backend/app/Models/Product.php';
            $pModel = new \App\Models\Product();
            $product = $pModel->formatProduct($row);
        }
    } catch (\Throwable $e) {
        // Fallback to sample data if database not reachable
    }
}

// If no identifier provided, load first active product from store
if (!$product && empty($identifier)) {
    $allRes = ApiClient::get('products', ['status' => 'active', 'limit' => 1]);
    if (!empty($allRes['success']) && !empty($allRes['data'][0])) {
        $product = $allRes['data'][0];
    }
}

// Fetch related products for recommendations
$allProductsRes = ApiClient::get('products', ['status' => 'active', 'limit' => 6]);
$relatedProducts = [];
if (!empty($allProductsRes['success']) && is_array($allProductsRes['data'])) {
    foreach ($allProductsRes['data'] as $p) {
        if ($product && ($p['uuid'] ?? '') === ($product['uuid'] ?? '')) continue;
        $relatedProducts[] = $p;
        if (count($relatedProducts) >= 4) break;
    }
}

$pageTitle = $product 
    ? htmlspecialchars($product['name']) . ' - ' . htmlspecialchars($storeName)
    : 'পণ্য পাওয়া যায়নি | ' . htmlspecialchars($storeName);

// Dedicated Product Detail SEO
if ($product) {
    $seoTitle = $product['name'] . ' - ' . $storeName;
    $rawPDesc = trim(strip_tags((string)($product['description'] ?? '')));
    $seoDescription = !empty($rawPDesc) 
        ? (mb_substr($rawPDesc, 0, 155, 'UTF-8') . (mb_strlen($rawPDesc, 'UTF-8') > 155 ? '...' : '')) 
        : ($product['name'] . ' কিনুন ' . $storeName . ' থেকে সেরা মূল্যে। ক্যাশ অন ডেলিভারি ও দ্রুততম হোম ডেলিভারি সুবিধা।');
    $seoImage = !empty($product['image_url']) ? $product['image_url'] : ApiClient::assetUrl($product['image'] ?? null);
    $seoType = 'product';
    $seoKeywords = $product['name'] . ', ' . ($product['category_name'] ?? '') . ', ' . $storeName . ', অনলাইন শপিং, দাম, buy online bd';
}

require_once __DIR__ . '/views/header.php';
?>

<!-- BASE PATH HELPER -->
<script>
    const STORE_BASE_URL = '<?= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') ?>';
</script>

<main class="max-w-6xl mx-auto px-4 py-6 sm:py-8 space-y-8 flex-1">

    <?php if (!$product): ?>
        <!-- 404 PRODUCT NOT FOUND VIEW -->
        <div class="bg-white border border-slate-200 rounded-3xl p-12 sm:p-16 text-center max-w-xl mx-auto shadow-xs my-8">
            <div class="w-16 h-16 rounded-2xl bg-brand-100 text-brand-600 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="package-search" class="w-8 h-8"></i>
            </div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-2">পণ্যটি খুঁজে পাওয়া যায়নি</h2>
            <p class="text-xs text-slate-500 mb-6">
                আপনার অনুরোধকৃত পণ্যটি বর্তমানে অপসারণ করা হয়েছে অথবা লিঙ্কটি ভুল হতে পারে। আমাদের শপের অন্যান্য পণ্য দেখতে নিচের বাটনে ক্লিক করুন।
            </p>
            <a href="./" class="inline-flex items-center space-x-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>হোমপেজে ফিরে যান</span>
            </a>
        </div>
    <?php else: ?>
        <?php
            $images = is_array($product['images'] ?? null) ? $product['images'] : [];
            $mainImage = !empty($images[0]) ? $images[0] : null;
            $stock = (int)($product['stock'] ?? 0);
            $retailerPrice = (float)($product['retailer_price'] ?? 0);

            // Normalize Sizes: supports JSON string, array of strings, or array of objects [{name, stock}]
            $rawSizes = $product['sizes'] ?? [];
            if (is_string($rawSizes)) {
                $rawSizes = json_decode($rawSizes, true) ?? [];
            }
            $normalizedSizes = [];
            if (is_array($rawSizes)) {
                foreach ($rawSizes as $item) {
                    if (is_array($item)) {
                        $name = trim((string)($item['name'] ?? $item['label'] ?? $item['size'] ?? ''));
                        $vStock = (isset($item['stock']) && $item['stock'] !== '' && $item['stock'] !== null) ? (int)$item['stock'] : null;
                        if ($name !== '') {
                            $normalizedSizes[] = ['name' => $name, 'stock' => $vStock];
                        }
                    } elseif (is_scalar($item) && trim((string)$item) !== '') {
                        $normalizedSizes[] = ['name' => trim((string)$item), 'stock' => null];
                    }
                }
            }

            // Normalize Colors: supports JSON string, array of strings, or array of objects [{name, stock, code}]
            $rawColors = $product['colors'] ?? [];
            if (is_string($rawColors)) {
                $rawColors = json_decode($rawColors, true) ?? [];
            }
            $normalizedColors = [];
            if (is_array($rawColors)) {
                foreach ($rawColors as $item) {
                    if (is_array($item)) {
                        $name = trim((string)($item['name'] ?? $item['label'] ?? $item['color'] ?? ''));
                        $vStock = (isset($item['stock']) && $item['stock'] !== '' && $item['stock'] !== null) ? (int)$item['stock'] : null;
                        $code = $item['code'] ?? null;
                        if ($name !== '') {
                            $normalizedColors[] = ['name' => $name, 'stock' => $vStock, 'code' => $code];
                        }
                    } elseif (is_scalar($item) && trim((string)$item) !== '') {
                        $normalizedColors[] = ['name' => trim((string)$item), 'stock' => null, 'code' => null];
                    }
                }
            }

            // Default selected size: prefer first in-stock variant
            $defaultSize = null;
            foreach ($normalizedSizes as $ns) {
                if ($ns['stock'] === null || $ns['stock'] > 0) {
                    $defaultSize = $ns;
                    break;
                }
            }
            if (!$defaultSize && !empty($normalizedSizes)) {
                $defaultSize = $normalizedSizes[0];
            }

            // Default selected color: prefer first in-stock variant
            $defaultColor = null;
            foreach ($normalizedColors as $nc) {
                if ($nc['stock'] === null || $nc['stock'] > 0) {
                    $defaultColor = $nc;
                    break;
                }
            }
            if (!$defaultColor && !empty($normalizedColors)) {
                $defaultColor = $normalizedColors[0];
            }

            // Initial effective variant stock
            $initialStock = $stock;
            if ($defaultSize && $defaultSize['stock'] !== null) {
                $initialStock = $defaultSize['stock'];
            } elseif ($defaultColor && $defaultColor['stock'] !== null) {
                $initialStock = $defaultColor['stock'];
            }
        ?>

        <!-- Breadcrumbs Navigation -->
        <nav class="flex items-center space-x-2 text-xs font-medium text-slate-500">
            <a href="./" class="hover:text-brand-600 transition flex items-center space-x-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>হোম</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <a href="./#catalog" class="hover:text-brand-600 transition">পণ্য ক্যাটালগ</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-800 font-bold truncate max-w-xs"><?= htmlspecialchars($product['name']) ?></span>
        </nav>

        <!-- PRODUCT DETAILS MAIN GRID (2-COLUMNS) -->
        <div class="bg-white border border-slate-200 rounded-3xl p-4 sm:p-8 shadow-xs">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- LEFT COLUMN: IMAGE SHOWCASE & GALLERY -->
                <div class="md:col-span-6 space-y-4">
                    <!-- Main High-Res Preview Image with E-commerce Hover Zoom -->
                    <div id="productZoomContainer" class="aspect-square bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden relative cursor-crosshair flex items-center justify-center select-none group">
                        <?php if ($mainImage): ?>
                            <img id="mainProductView" src="<?= htmlspecialchars($mainImage) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                                 class="w-full h-full object-contain p-2 pointer-events-none transition-transform duration-150 ease-out will-change-transform">
                        <?php else: ?>
                            <div class="text-center p-8 text-slate-400">
                                <i data-lucide="package" class="w-16 h-16 mx-auto mb-2 text-slate-300"></i>
                                <span class="text-xs">কোনো ছবি নেই</span>
                            </div>
                        <?php endif; ?>

                        <!-- Zoom Hint Pill (Desktop) -->
                        <div id="zoomHintBadge" class="absolute bottom-3 right-3 hidden sm:flex items-center space-x-1.5 px-2.5 py-1 bg-slate-900/75 backdrop-blur-xs text-white text-[11px] font-semibold rounded-lg shadow-xs pointer-events-none transition-opacity duration-200">
                            <i data-lucide="zoom-in" class="w-3.5 h-3.5 text-brand-400"></i>
                            <span>জুম করতে মাউস রাখুন</span>
                        </div>

                        <!-- Dynamic Stock Badge Overlay on Image -->
                        <div class="absolute top-3 left-3 pointer-events-none" id="imageStockBadgeContainer">
                            <?php if ($initialStock > 0): ?>
                                <span class="px-2.5 py-1 bg-emerald-600/95 text-white rounded-lg text-xs font-black shadow-xs flex items-center space-x-1.5">
                                    <i data-lucide="boxes" class="w-3.5 h-3.5"></i>
                                    <span id="stockBadgeText">স্টকে আছে (<?= $initialStock ?> টি)</span>
                                </span>
                            <?php else: ?>
                                <span class="px-2.5 py-1 bg-rose-600/95 text-white rounded-lg text-xs font-black shadow-xs flex items-center space-x-1.5">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                    <span id="stockBadgeText">স্টক শেষ</span>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Thumbnails Row -->
                    <?php if (count($images) > 1): ?>
                        <div class="flex gap-2.5 overflow-x-auto pb-1" id="productThumbnailsRow">
                            <?php foreach ($images as $idx => $imgUrl): ?>
                                <button type="button" onclick="changeMainImage('<?= htmlspecialchars($imgUrl, ENT_QUOTES) ?>', this)" 
                                    class="w-16 h-16 rounded-xl border-2 overflow-hidden bg-slate-50 shrink-0 aspect-square transition cursor-pointer p-1 <?= $idx === 0 ? 'border-brand-500 ring-2 ring-brand-200' : 'border-slate-200 hover:border-slate-300' ?>">
                                    <img src="<?= htmlspecialchars($imgUrl) ?>" class="w-full h-full object-contain">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- RIGHT COLUMN: PRODUCT INFO & VARIANT SELECTOR -->
                <div class="md:col-span-6 space-y-6">
                    <div>
                        <!-- Category Badge -->
                        <div class="mb-2">
                            <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                                <i data-lucide="tag" class="w-3 h-3 text-brand-500"></i>
                                <span><?= htmlspecialchars($product['category_name'] ?? 'Unnamed') ?></span>
                            </span>
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                            <?= htmlspecialchars($product['name']) ?>
                        </h1>
                    </div>

                    <!-- Price & Guarantee Banner -->
                    <?php
                        $hasDiscount = !empty($product['has_discount']);
                        $effectivePrice = (float)($product['effective_price'] ?? $retailerPrice);
                        $discountPercent = (int)($product['discount_percent'] ?? 0);
                        $savings = round($retailerPrice - $effectivePrice, 2);
                        $endsAt = !empty($product['discount_ends_at']) ? $product['discount_ends_at'] : null;
                    ?>
                    <div class="p-4 bg-brand-50/60 border border-brand-200/80 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block">
                                <?= $hasDiscount ? 'অফার মূল্য (Discount Price)' : 'বিক্রয় মূল্য' ?>
                            </span>
                            <div class="flex items-baseline space-x-2">
                                <div class="text-2xl sm:text-3xl font-black text-brand-600 font-mono">
                                    ৳<?= number_format($effectivePrice, 0) ?>
                                </div>
                                <?php if ($hasDiscount): ?>
                                    <span class="text-sm text-slate-400 line-through font-mono">
                                        ৳<?= number_format($retailerPrice, 0) ?>
                                    </span>
                                    <span class="px-2 py-0.5 bg-red-600 text-white text-[11px] font-black rounded-lg shadow-2xs animate-pulse">
                                        <?= $discountPercent ?>% ছাড়
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if ($hasDiscount && $savings > 0): ?>
                                <div class="text-[11px] text-emerald-700 font-bold mt-1">
                                    🎉 আপনি সাশ্রয় করছেন ৳<?= number_format($savings, 0) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col sm:items-end gap-1.5">
                            <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600"></i>
                                <span>ক্যাশ অন ডেলিভারি</span>
                            </span>
                            <?php if ($hasDiscount && $endsAt): ?>
                                <div class="text-[10px] font-bold text-brand-700 bg-white/80 px-2 py-0.5 rounded-lg border border-brand-200 flex items-center space-x-1">
                                    <i data-lucide="clock" class="w-3 h-3 text-brand-500"></i>
                                    <span>অফার মেয়াদ: <?= htmlspecialchars($endsAt) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- VARIANT SELECTORS (Size & Color) -->
                    <div class="space-y-4 pt-2 border-t border-slate-100">
                        
                        <!-- Size Selector -->
                        <?php if (!empty($normalizedSizes)): ?>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-xs font-bold text-slate-800 flex items-center space-x-1.5">
                                        <i data-lucide="ruler" class="w-3.5 h-3.5 text-brand-500"></i>
                                        <span>সাইজ নির্বাচন করুন (Size):</span>
                                    </label>
                                    <span id="selectedSizeBadge" class="text-xs font-extrabold text-brand-600">
                                        <?= htmlspecialchars($defaultSize['name'] ?? '') ?>
                                        <?php if ($defaultSize && $defaultSize['stock'] !== null): ?>
                                            <span class="text-[11px] font-normal <?= $defaultSize['stock'] > 0 ? 'text-slate-500' : 'text-rose-600 font-bold' ?>">
                                                (<?= $defaultSize['stock'] > 0 ? 'স্টক: ' . $defaultSize['stock'] . 'টি' : 'স্টক শেষ' ?>)
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="flex flex-wrap gap-2" id="sizeOptionsContainer">
                                    <?php foreach ($normalizedSizes as $idx => $s): ?>
                                        <?php
                                            $isSel = ($defaultSize && $defaultSize['name'] === $s['name']);
                                            $hasStock = ($s['stock'] !== null);
                                            $isOutOfStock = ($hasStock && $s['stock'] <= 0);
                                        ?>
                                        <button type="button" 
                                            onclick="selectVariantSize('<?= htmlspecialchars($s['name'], ENT_QUOTES) ?>', this)"
                                            data-size-name="<?= htmlspecialchars($s['name'], ENT_QUOTES) ?>"
                                            data-size-stock="<?= $s['stock'] !== null ? $s['stock'] : '' ?>"
                                            class="variant-size-btn px-3.5 py-2 rounded-xl text-xs font-bold transition border flex items-center space-x-1.5 cursor-pointer <?= $isSel ? 'bg-brand-600 text-white border-brand-600 shadow-xs' : ($isOutOfStock ? 'bg-slate-100 text-slate-400 border-slate-200 hover:border-slate-300' : 'bg-white text-slate-700 border-slate-300 hover:border-brand-400') ?>">
                                            <span><?= htmlspecialchars($s['name']) ?></span>
                                            <?php if ($hasStock): ?>
                                                <span class="size-stock-tag text-[10px] px-1.5 py-0.5 rounded-md font-medium <?= $isSel ? 'bg-white/20 text-white' : ($isOutOfStock ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600') ?>">
                                                    <?= $s['stock'] > 0 ? $s['stock'] . 'টি' : 'স্টক শেষ' ?>
                                                </span>
                                            <?php endif; ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Color Selector -->
                        <?php if (!empty($normalizedColors)): ?>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-xs font-bold text-slate-800 flex items-center space-x-1.5">
                                        <i data-lucide="palette" class="w-3.5 h-3.5 text-brand-500"></i>
                                        <span>রঙ নির্বাচন করুন (Color):</span>
                                    </label>
                                    <span id="selectedColorBadge" class="text-xs font-extrabold text-brand-600">
                                        <?= htmlspecialchars($defaultColor['name'] ?? '') ?>
                                        <?php if ($defaultColor && $defaultColor['stock'] !== null): ?>
                                            <span class="text-[11px] font-normal <?= $defaultColor['stock'] > 0 ? 'text-slate-500' : 'text-rose-600 font-bold' ?>">
                                                (<?= $defaultColor['stock'] > 0 ? 'স্টক: ' . $defaultColor['stock'] . 'টি' : 'স্টক শেষ' ?>)
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="flex flex-wrap gap-2" id="colorOptionsContainer">
                                    <?php foreach ($normalizedColors as $idx => $c): ?>
                                        <?php
                                            $isSel = ($defaultColor && $defaultColor['name'] === $c['name']);
                                            $hasStock = ($c['stock'] !== null);
                                            $isOutOfStock = ($hasStock && $c['stock'] <= 0);
                                        ?>
                                        <button type="button" 
                                            onclick="selectVariantColor('<?= htmlspecialchars($c['name'], ENT_QUOTES) ?>', this)"
                                            data-color-name="<?= htmlspecialchars($c['name'], ENT_QUOTES) ?>"
                                            data-color-stock="<?= $c['stock'] !== null ? $c['stock'] : '' ?>"
                                            class="variant-color-btn px-3.5 py-2 rounded-xl text-xs font-bold transition border flex items-center space-x-1.5 cursor-pointer <?= $isSel ? 'bg-brand-600 text-white border-brand-600 shadow-xs' : ($isOutOfStock ? 'bg-slate-100 text-slate-400 border-slate-200 hover:border-slate-300' : 'bg-white text-slate-700 border-slate-300 hover:border-brand-400') ?>">
                                            <?php if (!empty($c['code'])): ?>
                                                <span class="w-3 h-3 rounded-full border border-black/10 shrink-0" style="background-color: <?= htmlspecialchars($c['code']) ?>;"></span>
                                            <?php endif; ?>
                                            <span><?= htmlspecialchars($c['name']) ?></span>
                                            <?php if ($hasStock): ?>
                                                <span class="color-stock-tag text-[10px] px-1.5 py-0.5 rounded-md font-medium <?= $isSel ? 'bg-white/20 text-white' : ($isOutOfStock ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600') ?>">
                                                    <?= $c['stock'] > 0 ? $c['stock'] . 'টি' : 'স্টক শেষ' ?>
                                                </span>
                                            <?php endif; ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Quantity Stepper with Live Stock Integration -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold text-slate-800">পরিমাণ (Quantity):</label>
                                <div id="liveStockNotice">
                                    <?php if ($initialStock > 0): ?>
                                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                            স্টকে আছে: <strong id="maxStockDisplay"><?= $initialStock ?></strong> টি
                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200">
                                            স্টক শেষ
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center bg-slate-50 border border-slate-300 rounded-xl p-1 shadow-2xs">
                                    <button type="button" onclick="adjustProductQty(-1)" id="btnQtyMinus" 
                                        class="w-9 h-9 rounded-lg bg-white hover:bg-slate-200 text-slate-700 font-black text-sm flex items-center justify-center transition cursor-pointer shadow-2xs select-none <?= $initialStock <= 0 ? 'opacity-50 cursor-not-allowed' : '' ?>">-</button>
                                    <input type="number" id="productQtyInput" min="1" max="<?= max(1, $initialStock) ?>" value="<?= $initialStock > 0 ? 1 : 0 ?>" 
                                           oninput="handleQtyDirectInput(this)" onchange="handleQtyDirectInput(this)"
                                           class="w-14 text-center font-black text-slate-900 bg-transparent border-none focus:outline-none focus:ring-0 text-sm font-mono [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button type="button" onclick="adjustProductQty(1)" id="btnQtyPlus" 
                                        class="w-9 h-9 rounded-lg bg-brand-600 hover:bg-brand-700 text-white font-black text-sm flex items-center justify-center transition cursor-pointer shadow-2xs select-none <?= $initialStock <= 0 ? 'opacity-50 cursor-not-allowed' : '' ?>">+</button>
                                </div>
                                <span class="text-[11px] text-slate-500" id="stockLimitHint">
                                    <?php if ($initialStock > 0): ?>
                                        (সর্বোচ্চ <strong id="stockLimitNumber"><?= $initialStock ?></strong> টি পর্যন্ত অর্ডার করা যাবে)
                                    <?php else: ?>
                                        <span class="text-rose-600 font-bold">বর্তমানে এই ভ্যারিয়েন্ট স্টকে নেই</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- ACTION BUTTONS: Add to Cart & Buy Now -->
                    <div id="actionButtonsContainer" class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                        <?php if ($initialStock > 0): ?>
                            <button type="button" id="btnAddToCart" onclick="handleAddToCart()" 
                                class="flex-1 py-3.5 px-6 bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold rounded-2xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                                <i data-lucide="shopping-bag" class="w-4 h-4 text-brand-400"></i>
                                <span>কার্টে যোগ করুন</span>
                            </button>
                            <button type="button" id="btnBuyNow" onclick="handleBuyNow()" 
                                class="flex-1 py-3.5 px-6 bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold rounded-2xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                                <i data-lucide="zap" class="w-4 h-4"></i>
                                <span>এখনই কিনুন</span>
                            </button>
                        <?php else: ?>
                            <button type="button" id="btnStockOutDisabled" disabled 
                                class="w-full py-3.5 px-6 bg-slate-200 text-slate-400 text-xs font-extrabold rounded-2xl cursor-not-allowed flex items-center justify-center space-x-2">
                                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                                <span>পণ্যটি বর্তমানে স্টক আউট</span>
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- Trust Highlights Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 pt-4 border-t border-slate-100 text-[11px] text-slate-600">
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 flex items-center space-x-2">
                            <i data-lucide="truck" class="w-4 h-4 text-brand-600 shrink-0"></i>
                            <span>সারা দেশে হোম ডেলিভারি</span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 flex items-center space-x-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                            <span>১০০% আসল প্রোডাক্ট</span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 flex items-center space-x-2">
                            <i data-lucide="banknote" class="w-4 h-4 text-blue-600 shrink-0"></i>
                            <span>ক্যাশ অন ডেলিভারি</span>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="pt-4 border-t border-slate-100">
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2">পণ্যের বিবরণ (Description):</h3>
                        <div class="text-xs text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-100 whitespace-pre-wrap">
                            <?= !empty($product['description']) ? htmlspecialchars($product['description']) : 'কোনো বিবরণ যোগ করা হয়নি।' ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- RELATED PRODUCTS SECTION -->
        <?php if (!empty($relatedProducts)): ?>
            <div class="space-y-4 pt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">সম্পর্কিত অন্যান্য পণ্য</h3>
                        <p class="text-xs text-slate-500">আমাদের স্টোরের আরও কিছু জনপ্রিয় আইটেম</p>
                    </div>
                    <a href="./#catalog" class="text-xs text-brand-600 hover:text-brand-700 font-bold flex items-center space-x-1">
                        <span>সবগুলো দেখুন</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
                    <?php foreach ($relatedProducts as $rel): ?>
                        <?php
                            $relImg = !empty($rel['images'][0]) ? $rel['images'][0] : null;
                            $relStock = (int)($rel['stock'] ?? 0);
                            $relPrice = (float)($rel['effective_price'] ?? $rel['retailer_price'] ?? 0);
                            $relSlug = !empty($rel['slug']) ? $rel['slug'] : $rel['uuid'];
                        ?>
                        <a href="product?slug=<?= urlencode((string)$relSlug) ?>" 
                           class="bg-white border border-slate-200/90 hover:border-brand-500 rounded-2xl overflow-hidden shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between p-3 sm:p-4 group">
                            <div>
                                <div class="aspect-square bg-slate-50 rounded-xl mb-2.5 overflow-hidden flex items-center justify-center text-slate-400 relative border border-slate-100">
                                    <?php if ($relImg): ?>
                                        <img src="<?= htmlspecialchars($relImg) ?>" alt="<?= htmlspecialchars($rel['name']) ?>" 
                                             class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
                                    <?php else: ?>
                                        <i data-lucide="package" class="w-8 h-8 text-slate-300"></i>
                                    <?php endif; ?>
                                </div>
                                <h4 class="font-bold text-xs sm:text-sm text-slate-900 line-clamp-1 group-hover:text-brand-600 transition mb-1">
                                    <?= htmlspecialchars($rel['name']) ?>
                                </h4>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-slate-100 mt-2">
                                <span class="text-xs sm:text-sm font-black text-slate-900 font-mono">
                                    ৳<?= number_format($relPrice, 0) ?>
                                </span>
                                <span class="text-[11px] font-bold text-brand-600">বিস্তারিত &rarr;</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</main>

<!-- Cart Drawer is globally provided in views/cart_drawer.php via views/footer.php -->

<?php if ($product): ?>
<!-- SCRIPTS FOR PRODUCT DETAILS & STOCK VALIDATION -->
<script>
    const CURRENT_PRODUCT = <?= json_encode($product, JSON_UNESCAPED_UNICODE) ?>;
    const SIZES_DATA = <?= json_encode($normalizedSizes, JSON_UNESCAPED_UNICODE) ?>;
    const COLORS_DATA = <?= json_encode($normalizedColors, JSON_UNESCAPED_UNICODE) ?>;
    const BASE_PRODUCT_STOCK = parseInt(CURRENT_PRODUCT && CURRENT_PRODUCT.stock !== undefined ? CURRENT_PRODUCT.stock : 0, 10);

    let selectedSize = <?= $defaultSize ? json_encode($defaultSize['name'], JSON_UNESCAPED_UNICODE) : 'null' ?>;
    let selectedColor = <?= $defaultColor ? json_encode($defaultColor['name'], JSON_UNESCAPED_UNICODE) : 'null' ?>;
    let selectedQty = <?= $initialStock > 0 ? 1 : 0 ?>;

    // Canonical cart management bridges
    function getCart() { return (window.getCart ? window.getCart() : []); }
    function saveCart(data) { if (window.saveCart) window.saveCart(data); }
    function updateCartBadge() { if (window.updateCartBadge) window.updateCartBadge(); }
    function openCartDrawer() { if (window.openCartDrawer) window.openCartDrawer(); }
    function closeCartDrawer() { if (window.closeCartDrawer) window.closeCartDrawer(); }

    // Change Main Image
    function changeMainImage(url, el) {
        const img = document.getElementById('mainProductView');
        if (img) {
            img.style.transform = 'scale(1)';
            img.style.transformOrigin = 'center center';
        }
        $('#mainProductView').attr('src', url);
        $('#productThumbnailsRow button').removeClass('border-brand-500 ring-2 ring-brand-200').addClass('border-slate-200');
        $(el).addClass('border-brand-500 ring-2 ring-brand-200').removeClass('border-slate-200');
    }

    // Hover Zoom Engine
    function initProductImageZoom() {
        const container = document.getElementById('productZoomContainer');
        const img = document.getElementById('mainProductView');
        const hint = document.getElementById('zoomHintBadge');

        if (!container || !img) return;
        let isZoomed = false;

        container.addEventListener('mouseenter', function() {
            img.style.transition = 'transform 0.12s ease-out';
            if (hint) hint.style.opacity = '0';
        });

        container.addEventListener('mousemove', function(e) {
            const rect = container.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            const clampX = Math.max(0, Math.min(100, x));
            const clampY = Math.max(0, Math.min(100, y));

            img.style.transformOrigin = `${clampX}% ${clampY}%`;
            img.style.transform = 'scale(2.2)';
        });

        container.addEventListener('mouseleave', function() {
            img.style.transition = 'transform 0.25s ease-out';
            img.style.transformOrigin = 'center center';
            img.style.transform = 'scale(1)';
            if (hint) hint.style.opacity = '1';
        });

        container.addEventListener('click', function() {
            if (window.innerWidth < 640) {
                isZoomed = !isZoomed;
                if (isZoomed) {
                    img.style.transform = 'scale(2)';
                    if (hint) hint.style.opacity = '0';
                } else {
                    img.style.transform = 'scale(1)';
                    if (hint) hint.style.opacity = '1';
                }
            }
        });
    }

    // Determine currently available stock based on selected variant
    function getActiveVariantStock() {
        if (!CURRENT_PRODUCT) return 0;

        // 1. Check size-specific stock if size is selected
        if (selectedSize && Array.isArray(SIZES_DATA) && SIZES_DATA.length > 0) {
            const sItem = SIZES_DATA.find(s => s.name === selectedSize);
            if (sItem && sItem.stock !== null && sItem.stock !== undefined && !isNaN(parseInt(sItem.stock, 10))) {
                return parseInt(sItem.stock, 10);
            }
        }

        // 2. Check color-specific stock if color is selected
        if (selectedColor && Array.isArray(COLORS_DATA) && COLORS_DATA.length > 0) {
            const cItem = COLORS_DATA.find(c => c.name === selectedColor);
            if (cItem && cItem.stock !== null && cItem.stock !== undefined && !isNaN(parseInt(cItem.stock, 10))) {
                return parseInt(cItem.stock, 10);
            }
        }

        // 3. Fallback to base product stock
        return isNaN(BASE_PRODUCT_STOCK) ? 0 : BASE_PRODUCT_STOCK;
    }

    // Reactive UI updater for stock, stepper, input, and CTA buttons
    function updateStockUI() {
        const activeStock = getActiveVariantStock();

        // 1. Overlay stock badge on image
        const badgeEl = $('#stockBadgeText');
        if (badgeEl.length) {
            const badgeWrapper = badgeEl.closest('span');
            if (activeStock > 0) {
                badgeEl.text(`স্টকে আছে (${activeStock} টি)`);
                badgeWrapper.removeClass('bg-rose-600/95').addClass('bg-emerald-600/95');
                badgeWrapper.find('i').attr('data-lucide', 'boxes');
            } else {
                badgeEl.text('স্টক শেষ');
                badgeWrapper.removeClass('bg-emerald-600/95').addClass('bg-rose-600/95');
                badgeWrapper.find('i').attr('data-lucide', 'alert-circle');
            }
        }

        // 2. Quantity section stock notice
        const noticeEl = $('#liveStockNotice');
        if (activeStock > 0) {
            noticeEl.html(`
                <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                    স্টকে আছে: <strong id="maxStockDisplay">${activeStock}</strong> টি
                </span>
            `);
            $('#stockLimitHint').html(`(সর্বোচ্চ <strong id="stockLimitNumber">${activeStock}</strong> টি পর্যন্ত অর্ডার করা যাবে)`);
        } else {
            noticeEl.html(`
                <span class="text-xs font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200">
                    স্টক শেষ
                </span>
            `);
            $('#stockLimitHint').html(`(<span class="text-rose-600 font-bold">বর্তমানে এই ভ্যারিয়েন্ট স্টকে নেই</span>)`);
        }

        // 3. Stepper & Input Validation
        const qtyInput = $('#productQtyInput');
        qtyInput.attr('max', Math.max(1, activeStock));

        if (activeStock <= 0) {
            selectedQty = 0;
            qtyInput.val(0);
            $('#btnQtyMinus, #btnQtyPlus').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
        } else {
            $('#btnQtyMinus, #btnQtyPlus').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
            if (selectedQty <= 0) selectedQty = 1;
            if (selectedQty > activeStock) {
                selectedQty = activeStock;
                showToast(`নির্বাচিত ভ্যারিয়েন্টে সর্বোচ্চ ${activeStock} টি স্টক রয়েছে।`, 'info');
            }
            qtyInput.val(selectedQty);
        }

        // 4. Action Buttons Container (Add to Cart & Buy Now)
        const btnContainer = $('#actionButtonsContainer');
        if (activeStock > 0) {
            btnContainer.html(`
                <button type="button" id="btnAddToCart" onclick="handleAddToCart()" 
                    class="flex-1 py-3.5 px-6 bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold rounded-2xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                    <i data-lucide="shopping-bag" class="w-4 h-4 text-brand-400"></i>
                    <span>কার্টে যোগ করুন</span>
                </button>
                <button type="button" id="btnBuyNow" onclick="handleBuyNow()" 
                    class="flex-1 py-3.5 px-6 bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold rounded-2xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                    <i data-lucide="zap" class="w-4 h-4"></i>
                    <span>এখনই কিনুন</span>
                </button>
            `);
        } else {
            btnContainer.html(`
                <button type="button" id="btnStockOutDisabled" disabled 
                    class="w-full py-3.5 px-6 bg-slate-200 text-slate-400 text-xs font-extrabold rounded-2xl cursor-not-allowed flex items-center justify-center space-x-2">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <span>নির্বাচিত ভ্যারিয়েন্টে স্টক শেষ</span>
                </button>
            `);
        }

        lucide.createIcons();
    }

    // Size Variant Selection
    function selectVariantSize(size, el) {
        selectedSize = size;
        const sItem = SIZES_DATA.find(s => s.name === size);
        let stockNote = '';
        if (sItem && sItem.stock !== null && sItem.stock !== undefined) {
            const vStock = parseInt(sItem.stock, 10);
            stockNote = vStock > 0 
                ? ` <span class="text-[11px] font-normal text-slate-500">(স্টক: ${vStock}টি)</span>`
                : ` <span class="text-[11px] font-bold text-rose-600">(স্টক শেষ)</span>`;
        }
        $('#selectedSizeBadge').html(`${size}${stockNote}`);

        // Update button styles
        $('.variant-size-btn').each(function() {
            const btnStock = $(this).data('size-stock');
            const isOutOfStock = (btnStock !== '' && parseInt(btnStock, 10) <= 0);
            $(this).removeClass('bg-brand-600 text-white border-brand-600 shadow-xs')
                   .addClass(isOutOfStock ? 'bg-slate-100 text-slate-400 border-slate-200' : 'bg-white text-slate-700 border-slate-300');
            $(this).find('.size-stock-tag').removeClass('bg-white/20 text-white')
                   .addClass(isOutOfStock ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600');
        });

        $(el).removeClass('bg-white bg-slate-100 text-slate-700 text-slate-400 border-slate-300 border-slate-200')
             .addClass('bg-brand-600 text-white border-brand-600 shadow-xs');
        $(el).find('.size-stock-tag').removeClass('bg-slate-100 text-slate-600 bg-rose-100 text-rose-700')
             .addClass('bg-white/20 text-white');

        updateStockUI();
    }

    // Color Variant Selection
    function selectVariantColor(color, el) {
        selectedColor = color;
        const cItem = COLORS_DATA.find(c => c.name === color);
        let stockNote = '';
        if (cItem && cItem.stock !== null && cItem.stock !== undefined) {
            const vStock = parseInt(cItem.stock, 10);
            stockNote = vStock > 0 
                ? ` <span class="text-[11px] font-normal text-slate-500">(স্টক: ${vStock}টি)</span>`
                : ` <span class="text-[11px] font-bold text-rose-600">(স্টক শেষ)</span>`;
        }
        $('#selectedColorBadge').html(`${color}${stockNote}`);

        // Update button styles
        $('.variant-color-btn').each(function() {
            const btnStock = $(this).data('color-stock');
            const isOutOfStock = (btnStock !== '' && parseInt(btnStock, 10) <= 0);
            $(this).removeClass('bg-brand-600 text-white border-brand-600 shadow-xs')
                   .addClass(isOutOfStock ? 'bg-slate-100 text-slate-400 border-slate-200' : 'bg-white text-slate-700 border-slate-300');
            $(this).find('.color-stock-tag').removeClass('bg-white/20 text-white')
                   .addClass(isOutOfStock ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600');
        });

        $(el).removeClass('bg-white bg-slate-100 text-slate-700 text-slate-400 border-slate-300 border-slate-200')
             .addClass('bg-brand-600 text-white border-brand-600 shadow-xs');
        $(el).find('.color-stock-tag').removeClass('bg-slate-100 text-slate-600 bg-rose-100 text-rose-700')
             .addClass('bg-white/20 text-white');

        updateStockUI();
    }

    // Stepper Quantity Adjustment with Strict Stock Validation
    function adjustProductQty(change) {
        const maxStock = getActiveVariantStock();

        if (maxStock <= 0) {
            selectedQty = 0;
            $('#productQtyInput').val(0);
            showToast('দুঃখিত, এই ভ্যারিয়েন্টটি বর্তমানে স্টকে নেই।', 'error');
            return;
        }

        if (change > 0 && selectedQty >= maxStock) {
            showToast(`দুঃখিত, স্টকে সর্বোচ্চ ${maxStock} টি পণ্য উপলব্ধ রয়েছে।`, 'warning');
            return;
        }

        selectedQty += change;
        if (selectedQty < 1) selectedQty = 1;
        if (selectedQty > maxStock) selectedQty = maxStock;
        $('#productQtyInput').val(selectedQty);
    }

    // Direct Quantity Typing Handler (Prevents invalid or negative stock inputs)
    function handleQtyDirectInput(el) {
        const maxStock = getActiveVariantStock();
        let val = parseInt($(el).val(), 10);

        if (maxStock <= 0) {
            selectedQty = 0;
            $(el).val(0);
            showToast('দুঃখিত, এই পণ্যটি বর্তমানে স্টকে নেই।', 'error');
            return;
        }

        if (isNaN(val) || val < 1) {
            val = 1;
        } else if (val > maxStock) {
            val = maxStock;
            showToast(`দুঃখিত, স্টকে সর্বোচ্চ ${maxStock} টি পণ্য রয়েছে। এর বেশি অর্ডার করা সম্ভব নয়।`, 'warning');
        }

        selectedQty = val;
        $(el).val(selectedQty);
    }

    // Handle Add to Cart with Strict Stock Limit Verification
    function handleAddToCart() {
        if (!CURRENT_PRODUCT) return;
        const maxStock = getActiveVariantStock();

        if (maxStock <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'স্টক শেষ!',
                text: 'দুঃখিত, এই পণ্যটি বা নির্বাচিত ভ্যারিয়েন্ট বর্তমানে স্টকে নেই।',
                confirmButtonColor: '#ea580c'
            });
            return;
        }

        if (selectedQty <= 0 || selectedQty > maxStock) {
            selectedQty = Math.max(1, Math.min(selectedQty, maxStock));
            $('#productQtyInput').val(selectedQty);
            Swal.fire({
                icon: 'warning',
                title: 'সঠিক পরিমাণ দিন!',
                text: `অনুগ্রহ করে ১ থেকে ${maxStock} এর মধ্যে সঠিক পরিমাণ নির্বাচন করুন।`,
                confirmButtonColor: '#ea580c'
            });
            return;
        }

        const lineItem = {
            product_uuid: CURRENT_PRODUCT.uuid,
            name: CURRENT_PRODUCT.name,
            image: (CURRENT_PRODUCT.images && CURRENT_PRODUCT.images[0]) ? CURRENT_PRODUCT.images[0] : null,
            unit_price: parseFloat(CURRENT_PRODUCT.effective_price || CURRENT_PRODUCT.retailer_price || 0),
            size: selectedSize,
            color: selectedColor,
            quantity: selectedQty,
            stock: maxStock
        };

        const currentCart = window.cart || (window.getCart ? window.getCart() : []);
        const existingIdx = currentCart.findIndex(it => 
            it.product_uuid === lineItem.product_uuid && 
            (it.size || '') === (lineItem.size || '') && 
            (it.color || '') === (lineItem.color || '')
        );

        const existingQty = existingIdx > -1 ? (parseInt(currentCart[existingIdx].quantity, 10) || 0) : 0;
        const newTotalQty = existingQty + lineItem.quantity;

        // Stock Limit Check: Cannot exceed available stock
        if (newTotalQty > maxStock) {
            const remaining = Math.max(0, maxStock - existingQty);
            if (remaining === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'স্টক সীমা অতিক্রম!',
                    text: `আপনি ইতিমধ্যে কার্টে সর্বোচ্চ উপলব্ধ পরিমাণ (${existingQty} টি) যোগ করেছেন। আর অতিরিক্ত পণ্য যোগ করা যাবে না।`,
                    confirmButtonColor: '#ea580c'
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'স্টক সীমাবদ্ধতা!',
                    text: `স্টকে মোট ${maxStock} টি পণ্য রয়েছে। আপনি ইতিমধ্যে ${existingQty} টি কার্টে রেখেছেন, তাই আরও সর্বোচ্চ ${remaining} টি যোগ করতে পারবেন।`,
                    confirmButtonColor: '#ea580c'
                });
            }
            return;
        }

        if (existingIdx > -1) {
            currentCart[existingIdx].quantity = newTotalQty;
            currentCart[existingIdx].stock = maxStock;
        } else {
            currentCart.push(lineItem);
        }

        window.cart = currentCart;
        if (window.saveCart) {
            window.saveCart(currentCart);
        } else {
            localStorage.setItem('client_cart', JSON.stringify(currentCart));
            updateCartBadge();
        }

        showToast(`"${CURRENT_PRODUCT.name}" (${lineItem.quantity} টি) কার্টে যোগ করা হয়েছে।`, 'success');
        openCartDrawer();
    }

    // Handle Direct Buy Now with Stock Limit Verification
    function handleBuyNow() {
        if (!CURRENT_PRODUCT) return;
        const maxStock = getActiveVariantStock();

        if (maxStock <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'স্টক শেষ!',
                text: 'দুঃখিত, এই পণ্যটি বা নির্বাচিত ভ্যারিয়েন্ট বর্তমানে স্টকে নেই।',
                confirmButtonColor: '#ea580c'
            });
            return;
        }

        if (selectedQty <= 0 || selectedQty > maxStock) {
            selectedQty = Math.max(1, Math.min(selectedQty, maxStock));
            $('#productQtyInput').val(selectedQty);
            Swal.fire({
                icon: 'warning',
                title: 'স্টক সীমাবদ্ধতা!',
                text: `দুঃখিত, স্টকে সর্বোচ্চ ${maxStock} টি পণ্য রয়েছে। আপনি সর্বোচ্চ ${maxStock} টি অর্ডার করতে পারবেন।`,
                confirmButtonColor: '#ea580c'
            });
            return;
        }

        const directItem = {
            product_uuid: CURRENT_PRODUCT.uuid,
            name: CURRENT_PRODUCT.name,
            image: (CURRENT_PRODUCT.images && CURRENT_PRODUCT.images[0]) ? CURRENT_PRODUCT.images[0] : null,
            unit_price: parseFloat(CURRENT_PRODUCT.effective_price || CURRENT_PRODUCT.retailer_price || 0),
            size: selectedSize,
            color: selectedColor,
            quantity: selectedQty,
            stock: maxStock
        };

        // Store direct checkout item in localStorage
        localStorage.setItem('client_direct_buy_item', JSON.stringify(directItem));

        // Redirect immediately to standalone checkout page
        window.location.href = (typeof STORE_BASE_URL !== 'undefined' ? STORE_BASE_URL : '') + '/checkout?buy_now=1';
    }

    $(document).ready(function() {
        updateCartBadge();
        initProductImageZoom();
        updateStockUI();
        lucide.createIcons();
    });
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/views/footer.php'; ?>
