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
if (!$product && !empty($identifier)) {
    foreach (getSampleProducts() as $sp) {
        if ($sp['slug'] === $identifier || $sp['uuid'] === $identifier) {
            $product = $sp;
            break;
        }
    }
}
if (!$product && empty($identifier)) {
    $samples = getSampleProducts();
    $product = $samples[0] ?? null;
}

// Fetch related products for recommendations
$allProductsRes = ApiClient::get('products', ['status' => 'active', 'limit' => 5]);
$relatedProducts = [];
if (!empty($allProductsRes['success']) && is_array($allProductsRes['data'])) {
    foreach ($allProductsRes['data'] as $p) {
        if ($product && $p['uuid'] === $product['uuid']) continue;
        $relatedProducts[] = $p;
        if (count($relatedProducts) >= 4) break;
    }
}
if (empty($relatedProducts)) {
    foreach (getSampleProducts() as $sp) {
        if ($product && $sp['uuid'] === $product['uuid']) continue;
        $relatedProducts[] = $sp;
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
            $images = is_array($product['images']) ? $product['images'] : [];
            $mainImage = !empty($images[0]) ? $images[0] : null;
            $stock = (int)($product['stock'] ?? 0);
            $retailerPrice = (float)($product['retailer_price'] ?? 0);
            $sizes = is_array($product['sizes']) ? $product['sizes'] : [];
            $colors = is_array($product['colors']) ? $product['colors'] : [];
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

                        <!-- Stock Badge Overlay -->
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <?php if ($stock > 0): ?>
                                <span class="px-2.5 py-1 bg-emerald-600/95 text-white rounded-lg text-xs font-black shadow-xs flex items-center space-x-1">
                                    <i data-lucide="boxes" class="w-3.5 h-3.5"></i>
                                    <span>স্টকে আছে (<?= $stock ?> টি)</span>
                                </span>
                            <?php else: ?>
                                <span class="px-2.5 py-1 bg-rose-600/95 text-white rounded-lg text-xs font-black shadow-xs flex items-center space-x-1">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                    <span>স্টক শেষ</span>
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
                        $savings = (float)($product['savings_amount'] ?? 0);
                        $endsAt = !empty($product['discount_ends_at']) ? $product['discount_ends_at'] : null;
                    ?>
                    <div class="p-4 bg-brand-50/60 border border-brand-200/80 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block">
                                <?= $hasDiscount ? 'অফার মূল্য (Discount Price)' : 'বিক্রয় মূল্য' ?>
                            </span>
                            <div class="flex items-baseline space-x-2">
                                <div class="text-2xl sm:text-3xl font-black text-brand-600 font-mono">
                                    ৳<?= number_format($effectivePrice, 2) ?>
                                </div>
                                <?php if ($hasDiscount): ?>
                                    <span class="text-sm text-slate-400 line-through font-mono">
                                        ৳<?= number_format($retailerPrice, 2) ?>
                                    </span>
                                    <span class="px-2 py-0.5 bg-red-600 text-white text-[11px] font-black rounded-lg shadow-2xs animate-pulse">
                                        <?= $discountPercent ?>% ছাড়
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if ($hasDiscount && $savings > 0): ?>
                                <div class="text-[11px] text-emerald-700 font-bold mt-1">
                                    🎉 আপনি সাশ্রয় করছেন ৳<?= number_format($savings, 2) ?>
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
                        <?php if (!empty($sizes)): ?>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-xs font-bold text-slate-800">সাইজ নির্বাচন করুন (Size):</label>
                                    <span id="selectedSizeBadge" class="text-xs font-extrabold text-brand-600"><?= htmlspecialchars($sizes[0]) ?></span>
                                </div>
                                <div class="flex flex-wrap gap-2" id="sizeOptionsContainer">
                                    <?php foreach ($sizes as $idx => $s): ?>
                                        <button type="button" onclick="selectVariantSize('<?= htmlspecialchars($s, ENT_QUOTES) ?>', this)" 
                                            class="variant-size-btn px-4 py-2 rounded-xl text-xs font-bold transition border cursor-pointer <?= $idx === 0 ? 'bg-brand-600 text-white border-brand-600 shadow-xs' : 'bg-white text-slate-700 border-slate-300 hover:border-brand-400' ?>">
                                            <?= htmlspecialchars($s) ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Color Selector -->
                        <?php if (!empty($colors)): ?>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-xs font-bold text-slate-800">রঙ নির্বাচন করুন (Color):</label>
                                    <span id="selectedColorBadge" class="text-xs font-extrabold text-brand-600"><?= htmlspecialchars($colors[0]) ?></span>
                                </div>
                                <div class="flex flex-wrap gap-2" id="colorOptionsContainer">
                                    <?php foreach ($colors as $idx => $c): ?>
                                        <button type="button" onclick="selectVariantColor('<?= htmlspecialchars($c, ENT_QUOTES) ?>', this)" 
                                            class="variant-color-btn px-4 py-2 rounded-xl text-xs font-bold transition border cursor-pointer <?= $idx === 0 ? 'bg-brand-600 text-white border-brand-600 shadow-xs' : 'bg-white text-slate-700 border-slate-300 hover:border-brand-400' ?>">
                                            <?= htmlspecialchars($c) ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Quantity Stepper -->
                        <div>
                            <label class="text-xs font-bold text-slate-800 block mb-2">পরিমাণ (Quantity):</label>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center bg-slate-50 border border-slate-300 rounded-xl p-1 shadow-2xs">
                                    <button type="button" onclick="adjustProductQty(-1)" class="w-8 h-8 rounded-lg bg-white hover:bg-slate-200 text-slate-700 font-black text-sm flex items-center justify-center transition cursor-pointer shadow-2xs">-</button>
                                    <span id="productQtyDisplay" class="text-sm font-black text-slate-900 px-4 min-w-[36px] text-center font-mono">1</span>
                                    <button type="button" onclick="adjustProductQty(1)" class="w-8 h-8 rounded-lg bg-brand-600 hover:bg-brand-700 text-white font-black text-sm flex items-center justify-center transition cursor-pointer shadow-2xs">+</button>
                                </div>
                                <span class="text-xs text-slate-400">
                                    (সর্বোচ্চ স্টক: <strong><?= $stock ?></strong> টি)
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ACTION BUTTONS: Add to Cart & Buy Now -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                        <?php if ($stock > 0): ?>
                            <button type="button" onclick="handleAddToCart()" 
                                class="flex-1 py-3 px-6 bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold rounded-2xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                                <i data-lucide="shopping-bag" class="w-4 h-4 text-brand-400"></i>
                                <span>কার্টে যোগ করুন</span>
                            </button>
                            <button type="button" onclick="handleBuyNow()" 
                                class="flex-1 py-3 px-6 bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold rounded-2xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                                <i data-lucide="zap" class="w-4 h-4"></i>
                                <span>এখনই কিনুন</span>
                            </button>
                        <?php else: ?>
                            <button type="button" disabled 
                                class="w-full py-3 px-6 bg-slate-200 text-slate-400 text-xs font-extrabold rounded-2xl cursor-not-allowed flex items-center justify-center space-x-2">
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
                            $relPrice = (float)($rel['retailer_price'] ?? 0);
                            $relSlug = !empty($rel['slug']) ? $rel['slug'] : $rel['uuid'];
                        ?>
                        <a href="product?slug=<?= urlencode($relSlug) ?>" 
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
                                    ৳<?= number_format($relPrice, 2) ?>
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

<!-- SCRIPTS FOR PRODUCT PAGE -->
<script>
    const CURRENT_PRODUCT = <?= json_encode($product, JSON_UNESCAPED_UNICODE) ?>;
    let selectedSize = <?= !empty($sizes[0]) ? json_encode($sizes[0]) : 'null' ?>;
    let selectedColor = <?= !empty($colors[0]) ? json_encode($colors[0]) : 'null' ?>;
    let selectedQty = 1;

    // Cart LocalStorage
    // ==========================================
    // GLOBAL CART HELPER BRIDGES
    // ==========================================
    // Canonical cart management is in views/cart_drawer.php
    function getCart() { return (window.getCart ? window.getCart() : []); }
    function saveCart(data) { if (window.saveCart) window.saveCart(data); }
    function updateCartBadge() { if (window.updateCartBadge) window.updateCartBadge(); }
    function openCartDrawer() { if (window.openCartDrawer) window.openCartDrawer(); }
    function closeCartDrawer() { if (window.closeCartDrawer) window.closeCartDrawer(); }
    function renderCartDrawer() { if (window.renderCartDrawer) window.renderCartDrawer(); }
    function adjustCartItemQty(index, change) { if (window.adjustCartItemQty) window.adjustCartItemQty(index, change); }
    function removeCartItem(index) { if (window.removeCartItem) window.removeCartItem(index); }
    function clearCart() { if (window.clearCart) window.clearCart(); }

    // Image Switcher
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

    // ==========================================
    // E-COMMERCE HOVER ZOOM ENGINE
    // ==========================================
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
            img.style.transform = 'scale(2.35)';
        });

        container.addEventListener('mouseleave', function() {
            img.style.transition = 'transform 0.25s ease-out';
            img.style.transformOrigin = 'center center';
            img.style.transform = 'scale(1)';
            if (hint) hint.style.opacity = '1';
        });

        // Touch toggle for mobile devices
        container.addEventListener('click', function(e) {
            if (window.innerWidth < 640) {
                isZoomed = !isZoomed;
                if (isZoomed) {
                    const rect = container.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    img.style.transformOrigin = `${x}% ${y}%`;
                    img.style.transform = 'scale(2.2)';
                    if (hint) hint.style.opacity = '0';
                } else {
                    img.style.transform = 'scale(1)';
                    img.style.transformOrigin = 'center center';
                    if (hint) hint.style.opacity = '1';
                }
            }
        });
    }

    // Variant Selectors
    function selectVariantSize(size, el) {
        selectedSize = size;
        $('#selectedSizeBadge').text(size);
        $('.variant-size-btn').removeClass('bg-brand-600 text-white border-brand-600 shadow-xs')
                              .addClass('bg-white text-slate-700 border-slate-300');
        $(el).addClass('bg-brand-600 text-white border-brand-600 shadow-xs')
             .removeClass('bg-white text-slate-700 border-slate-300');
    }

    function selectVariantColor(color, el) {
        selectedColor = color;
        $('#selectedColorBadge').text(color);
        $('.variant-color-btn').removeClass('bg-brand-600 text-white border-brand-600 shadow-xs')
                               .addClass('bg-white text-slate-700 border-slate-300');
        $(el).addClass('bg-brand-600 text-white border-brand-600 shadow-xs')
             .removeClass('bg-white text-slate-700 border-slate-300');
    }

    // Quantity Stepper with Stock Validation
    function adjustProductQty(change) {
        if (!CURRENT_PRODUCT) return;
        const maxStock = parseInt(CURRENT_PRODUCT.stock !== undefined ? CURRENT_PRODUCT.stock : 0);

        if (maxStock <= 0) {
            selectedQty = 0;
            $('#productQtyDisplay').text(0);
            showToast('দুঃখিত, পণ্যটি বর্তমানে স্টকে নেই।', 'error');
            return;
        }

        if (change > 0 && selectedQty >= maxStock) {
            showToast(`দুঃখিত, স্টকে সর্বোচ্চ ${maxStock} টি পণ্য উপলব্ধ রয়েছে।`, 'warning');
            return;
        }

        selectedQty += change;
        if (selectedQty < 1) selectedQty = 1;
        if (selectedQty > maxStock) selectedQty = maxStock;
        $('#productQtyDisplay').text(selectedQty);
    }

    // Handle Add to Cart with Strict Stock Limit Verification
    function handleAddToCart() {
        if (!CURRENT_PRODUCT) return;
        const maxStock = parseInt(CURRENT_PRODUCT.stock !== undefined ? CURRENT_PRODUCT.stock : 0);

        if (maxStock <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'স্টক শেষ!',
                text: 'দুঃখিত, এই পণ্যটি বর্তমানে স্টকে নেই।',
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

        const currentCart = window.cart || window.getCart();
        const existingIdx = currentCart.findIndex(it => 
            it.product_uuid === lineItem.product_uuid && 
            it.size === lineItem.size && 
            it.color === lineItem.color
        );

        const existingQty = existingIdx > -1 ? (parseInt(currentCart[existingIdx].quantity) || 0) : 0;
        const newTotalQty = existingQty + lineItem.quantity;

        // Stock Limit Check: Cannot exceed available stock
        if (newTotalQty > maxStock) {
            const remaining = Math.max(0, maxStock - existingQty);
            if (remaining === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'স্টক সীমা অতিক্রম!',
                    text: `আপনি ইতিমধ্যে কার্টে সর্বোচ্চ পরিমাণ (${existingQty} টি) যোগ করেছেন। স্টকে আর অতিরিক্ত পণ্য নেই।`,
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
        window.saveCart(currentCart);

        showToast(`"${CURRENT_PRODUCT.name}" (${lineItem.quantity} টি) কার্টে যোগ করা হয়েছে।`, 'success');
        openCartDrawer();
    }

    // Handle Direct Buy Now with Stock Limit Verification
    function handleBuyNow() {
        if (!CURRENT_PRODUCT) return;
        const maxStock = parseInt(CURRENT_PRODUCT.stock !== undefined ? CURRENT_PRODUCT.stock : 0);

        if (maxStock <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'স্টক শেষ!',
                text: 'দুঃখিত, এই পণ্যটি বর্তমানে স্টকে নেই।',
                confirmButtonColor: '#ea580c'
            });
            return;
        }

        if (selectedQty > maxStock) {
            selectedQty = maxStock;
            $('#productQtyDisplay').text(selectedQty);
            Swal.fire({
                icon: 'warning',
                title: 'স্টক সীমাবদ্ধতা!',
                text: `দুঃখিত, স্টকে মাত্র ${maxStock} টি পণ্য রয়েছে। আপনি সর্বোচ্চ ${maxStock} টি অর্ডার করতে পারবেন।`,
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
        lucide.createIcons();
    });
</script>

<?php require_once __DIR__ . '/views/footer.php'; ?>
