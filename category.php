<?php

/**
 * Client Storefront - Category & Catalog Browsing Page
 * 
 * Allows customers to browse products filtered by categories, sort by price,
 * and view active discount deals and stock statuses.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/sample_data.php';
require_once __DIR__ . '/views/template_cards.php';

// If no custom categories exist, merchant does not get a dedicated category page (unless searching for products)
if (empty($hasCategories) && empty($_GET['q'])) {
    header('Location: ' . (!empty($clientBasePath) ? $clientBasePath : './'));
    exit;
}

// Fetch active products
$productsRes = ApiClient::get('products', ['status' => 'active']);
$allProducts = (!empty($productsRes['success']) && is_array($productsRes['data']) && count($productsRes['data']) > 0) ? $productsRes['data'] : getSampleProducts();

// Determine active category filter from GET ?cat=...
$activeCatSlug = trim((string)($_GET['cat'] ?? ''));
$activeCat = null;
if ($activeCatSlug !== '') {
    foreach ($categories as $c) {
        if (($c['slug'] ?? '') === $activeCatSlug || ($c['uuid'] ?? '') === $activeCatSlug || ($c['name'] ?? '') === $activeCatSlug) {
            $activeCat = $c;
            break;
        }
    }
}

// Calculate product counts per category
$categoryCounts = [];
foreach ($allProducts as $p) {
    $cId = $p['category_uuid'] ?? ($p['category_name'] ?? 'other');
    $categoryCounts[$cId] = ($categoryCounts[$cId] ?? 0) + 1;
}

// Filter products if a category is selected
$displayProducts = $allProducts;
if ($activeCat !== null) {
    $displayProducts = array_filter($allProducts, function ($p) use ($activeCat) {
        return ($p['category_uuid'] ?? '') === ($activeCat['uuid'] ?? '') ||
               ($p['category_name'] ?? '') === ($activeCat['name'] ?? '');
    });
}

// Filter products if search query is provided via GET ?q=...
$searchQuery = trim((string)($_GET['q'] ?? ''));
if ($searchQuery !== '') {
    $searchLower = mb_strtolower($searchQuery, 'UTF-8');
    $displayProducts = array_filter($displayProducts, function ($p) use ($searchLower) {
        $pName = mb_strtolower((string)($p['name'] ?? ''), 'UTF-8');
        $pCat  = mb_strtolower((string)($p['category_name'] ?? ''), 'UTF-8');
        $pDesc = mb_strtolower((string)($p['description'] ?? ''), 'UTF-8');
        return str_contains($pName, $searchLower) || str_contains($pCat, $searchLower) || str_contains($pDesc, $searchLower);
    });
}

$pageTitle = ($searchQuery !== '' ? 'সার্চ: ' . htmlspecialchars($searchQuery) . ' | ' : '') . ($activeCat ? htmlspecialchars($activeCat['name']) . ' - ' : '') . 'ক্যাটাগরি সমূহ | ' . htmlspecialchars($storeName);

// Dedicated Category SEO
$seoTitle = ($searchQuery !== '' ? 'সার্চ: ' . $searchQuery . ' | ' : '') . ($activeCat ? $activeCat['name'] . ' - ' : '') . 'ক্যাটাগরি সমূহ | ' . $storeName;
$seoDescription = ($activeCat ? $activeCat['name'] . ' ক্যাটাগরির সেরা পণ্যসমূহ কিনুন ' . $storeName . ' থেকে।' : 'সকল ক্যাটাগরির সেরা পণ্যসমূহ এক নজরে দেখুন ' . $storeName . '-এ।') . ' ক্যাশ অন ডেলিভারি ও হোম ডেলিভারি সুবিধা।';
$seoKeywords = ($activeCat ? $activeCat['name'] . ', ' : '') . 'ক্যাটাগরি, কালেকশন, ' . $storeName . ', অনলাইন শপিং বাংলাদেশ';

require_once __DIR__ . '/views/header.php';
?>

<main class="max-w-6xl mx-auto px-4 py-6 sm:py-8 space-y-6 flex-1">

    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 text-xs font-medium text-slate-500">
        <a href="./" class="hover:text-brand-600 transition flex items-center space-x-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i>
            <span>হোম</span>
        </a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
        <a href="category" class="hover:text-brand-600 transition">ক্যাটাগরি</a>
        <?php if ($activeCat): ?>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
            <span class="text-slate-900 font-bold"><?= htmlspecialchars($activeCat['name']) ?></span>
        <?php endif; ?>
    </nav>

    <!-- Header Banner -->
    <div class="p-6 sm:p-8 bg-gradient-to-r from-brand-600 via-brand-700 to-brand-800 text-white rounded-3xl shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center space-x-1.5 px-3 py-1 bg-brand-700/60 text-white rounded-lg text-xs font-bold uppercase tracking-wider mb-2">
                <i data-lucide="folder-tree" class="w-3.5 h-3.5"></i>
                <span>ক্যাটালগ কালেকশন</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black">
                <?= $activeCat ? htmlspecialchars($activeCat['name']) : 'সকল ক্যাটাগরি ও পণ্যসম্ভার' ?>
            </h1>
            <p class="text-xs sm:text-sm text-brand-100 mt-1 max-w-xl">
                <?= $activeCat ? 'এই ক্যাটাগরির সেরা কালেকশন ও স্পেশাল অফারসমূহ এক নজরে দেখুন।' : 'আপনার পছন্দের ক্যাটাগরি বেছে নিন এবং পছন্দসই প্রডাক্ট অর্ডার করুন।' ?>
            </p>
        </div>

        <div class="flex items-center space-x-2 bg-brand-900/40 p-3 rounded-2xl border border-brand-400/30 text-xs shrink-0 self-start md:self-auto">
            <i data-lucide="boxes" class="w-5 h-5 text-amber-300"></i>
            <div>
                <span class="text-brand-200 text-[10px] block">মোট পণ্য</span>
                <span class="font-black text-sm text-white"><?= count($displayProducts) ?> টি প্রডাক্ট</span>
            </div>
        </div>
    </div>

    <!-- Dedicated Category Grid Showcase (Visible on dedicated category page when viewing all categories) -->
    <?php if (empty($activeCat) && !empty($categories)): ?>
    <section class="space-y-3">
        <div class="flex items-center justify-between">
            <h2 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center space-x-2">
                <i data-lucide="grid" class="w-4 h-4 text-brand-600"></i>
                <span>ক্যাটাগরি সমূহ</span>
            </h2>
            <span class="text-xs text-slate-500 font-medium"><?= count($categories) ?> টি ক্যাটাগরি উপলব্ধ</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
            <?php foreach ($categories as $cat): ?>
                <?php 
                    $catSlug = $cat['slug'] ?? $cat['uuid'];
                    $catCount = $categoryCounts[$cat['uuid']] ?? ($categoryCounts[$cat['name']] ?? 0);
                    $catImg = !empty($cat['image']) ? ApiClient::assetUrl($cat['image']) : null;
                ?>
                <a href="category?cat=<?= urlencode((string)$catSlug) ?>"
                   class="bg-white border border-slate-200 hover:border-brand-500 rounded-2xl p-3 shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between group cursor-pointer">
                    <div class="aspect-square w-full rounded-xl overflow-hidden bg-slate-50 relative mb-2.5 border border-slate-100 flex items-center justify-center">
                        <?php if ($catImg): ?>
                            <img src="<?= htmlspecialchars($catImg) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <?php else: ?>
                            <div class="w-full h-full flex flex-col items-center justify-center bg-brand-50/50 text-brand-500 group-hover:bg-brand-50 transition">
                                <i data-lucide="folder" class="w-8 h-8"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-brand-600 transition truncate mb-0.5">
                            <?= htmlspecialchars($cat['name']) ?>
                        </h3>
                        <div class="text-[11px] text-slate-500 font-medium flex items-center justify-between">
                            <span><?= $catCount ?> টি পণ্য</span>
                            <span class="text-brand-600 font-bold group-hover:translate-x-0.5 transition-transform">→</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Category Pills Filter Bar (Horizontal Scrollable) -->
    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-2xs">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center space-x-2 overflow-x-auto pb-1 sm:pb-0 flex-1 no-scrollbar">
                <!-- All Categories Pill -->
                <a href="category" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition shrink-0 whitespace-nowrap flex items-center space-x-1.5 <?= empty($activeCat) ? 'bg-brand-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                    <span>সকল পণ্য (<?= count($allProducts) ?>)</span>
                </a>

                <?php foreach ($categories as $cat): ?>
                    <?php 
                        $catSlug = $cat['slug'] ?? $cat['uuid'];
                        $isSelected = $activeCat && (($activeCat['uuid'] ?? '') === $cat['uuid'] || ($activeCat['slug'] ?? '') === $cat['slug']);
                        $count = $categoryCounts[$cat['uuid']] ?? ($categoryCounts[$cat['name']] ?? 0);
                    ?>
                    <a href="category?cat=<?= urlencode((string)$catSlug) ?>" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition shrink-0 whitespace-nowrap flex items-center space-x-1.5 <?= $isSelected ? 'bg-brand-600 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                        <span><?= htmlspecialchars($cat['name']) ?></span>
                        <span class="text-[10px] px-1.5 py-0.2 rounded-full <?= $isSelected ? 'bg-brand-700 text-white' : 'bg-white text-slate-500' ?>"><?= $count ?></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Sorting Dropdown -->
            <div class="flex items-center space-x-2 shrink-0 text-xs">
                <span class="text-slate-400 font-medium">সর্ট:</span>
                <select id="sortSelect" onchange="sortProductsList(this.value)" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-700 font-bold focus:outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer">
                    <option value="default">ডিফল্ট</option>
                    <option value="price_asc">দাম: কম থেকে বেশি</option>
                    <option value="price_desc">দাম: বেশি থেকে কম</option>
                    <option value="discount">অফার ও ছাড়</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Grid (Paginated with Infinite Scroll) -->
    <div id="categoryProductsGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php if (!empty($displayProducts)): ?>
            <?php 
            $initialCategoryLimit = 8;
            $initialCategoryItems = array_slice($displayProducts, 0, $initialCategoryLimit);
            foreach ($initialCategoryItems as $prod): 
            ?>
                <?php
                    $img = !empty($prod['images'][0]) ? $prod['images'][0] : null;
                    $stock = (int)($prod['stock'] ?? 0);
                    $retailerPrice = (float)($prod['retailer_price'] ?? 0);
                    $hasDiscount = !empty($prod['has_discount']);
                    $discountPercent = (int)($prod['discount_percent'] ?? 0);
                    $effectivePrice = (float)($prod['effective_price'] ?? $retailerPrice);
                    $sizes = is_array($prod['sizes'] ?? null) ? $prod['sizes'] : [];
                    $colors = is_array($prod['colors'] ?? null) ? $prod['colors'] : [];
                    $prodSlug = !empty($prod['slug']) ? $prod['slug'] : ($prod['uuid'] ?? '');
                    $prodUrl = 'product?slug=' . urlencode((string)$prodSlug);
                ?>
                <div data-price="<?= $effectivePrice ?>" data-discount="<?= $hasDiscount ? $discountPercent : 0 ?>"
                     onclick="window.location.href='<?= $prodUrl ?>'" 
                     class="product-card bg-white border border-slate-200/90 hover:border-brand-500 rounded-2xl overflow-hidden shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between p-3 sm:p-4 group cursor-pointer">
                    <div>
                        <!-- Product Image Container -->
                        <div class="aspect-square bg-slate-100 rounded-xl mb-2.5 overflow-hidden flex items-center justify-center text-slate-400 relative border border-slate-100">
                            <?php if ($img): ?>
                                <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <?php else: ?>
                                <i data-lucide="package" class="w-10 h-10 text-slate-300"></i>
                            <?php endif; ?>

                            <!-- Discount Ribbon -->
                            <?php if ($hasDiscount): ?>
                                <div class="absolute top-2 right-2">
                                    <span class="px-2 py-0.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-lg text-[10px] sm:text-xs font-black shadow-sm flex items-center space-x-0.5 animate-pulse">
                                        <i data-lucide="flame" class="w-3 h-3 text-amber-300"></i>
                                        <span>-<?= $discountPercent ?>% ছাড়</span>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!-- Stock Badge -->
                            <div class="absolute top-2 left-2">
                                <?php if ($stock > 0): ?>
                                    <span class="px-2 py-0.5 bg-emerald-600/95 text-white rounded-lg text-[10px] sm:text-xs font-black shadow-xs flex items-center space-x-1">
                                        <i data-lucide="boxes" class="w-3 h-3"></i>
                                        <span><?= $stock ?> টি স্টক</span>
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 bg-red-600/95 text-white rounded-lg text-[10px] sm:text-xs font-black shadow-xs flex items-center space-x-1">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                        <span>স্টক শেষ</span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Category Tag -->
                        <div class="mb-1">
                            <span class="inline-flex items-center space-x-1 px-1.5 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-600 truncate max-w-full">
                                <i data-lucide="tag" class="w-2.5 h-2.5 text-slate-400"></i>
                                <span><?= htmlspecialchars($prod['category_name'] ?? 'General') ?></span>
                            </span>
                        </div>

                        <!-- Title & Price in Same Row (Flex Design) -->
                        <div class="flex items-center justify-between gap-2 mt-1 mb-1.5">
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= htmlspecialchars($prod['name']) ?>">
                                <?= htmlspecialchars($prod['name']) ?>
                            </h4>
                            <div class="text-right shrink-0">
                                <?php if ($hasDiscount): ?>
                                    <div class="flex items-baseline space-x-1">
                                        <span class="text-xs sm:text-sm font-black text-brand-600 tracking-tight">
                                            ৳<?= number_format($effectivePrice, 0) ?>
                                        </span>
                                        <span class="text-[10px] text-slate-400 line-through">
                                            ৳<?= number_format($retailerPrice, 0) ?>
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-xs sm:text-sm font-black text-brand-600 tracking-tight">
                                        ৳<?= number_format($retailerPrice, 0) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Order Action Button -->
                    <div class="pt-2 border-t border-slate-100">
                        <?php if ($stock > 0): ?>
                            <a href="<?= $prodUrl ?>" onclick="event.stopPropagation();" class="w-full py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold transition flex items-center justify-center space-x-1 shadow-2xs cursor-pointer">
                                <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                <span>অর্ডার করুন</span>
                            </a>
                        <?php else: ?>
                            <span class="w-full py-1.5 bg-slate-100 text-slate-400 text-xs font-bold rounded-xl cursor-not-allowed flex items-center justify-center">
                                স্টক শেষ
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full bg-white border border-slate-200 rounded-3xl p-12 text-center shadow-xs">
                <div class="w-16 h-16 bg-brand-50 text-brand-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="folder-search" class="w-8 h-8"></i>
                </div>
                <h3 class="text-base font-extrabold text-slate-900 mb-1">এই ক্যাটাগরিতে কোনো পণ্য পাওয়া যায়নি</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mb-4">অন্যান্য ক্যাটাগরি ঘুরে দেখুন অথবা সকল পণ্য ব্রাউজ করুন।</p>
                <a href="category" class="inline-flex items-center space-x-1.5 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs">
                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                    <span>সকল ক্যাটাগরি দেখুন</span>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Animated Skeleton Loader Container (Active during Infinite Scroll fetch) -->
    <div id="categorySkeletonContainer" class="hidden grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 pt-2">
        <?= renderProductSkeletonCard(4) ?>
    </div>

    <!-- Infinite Scroll Sentinel Trigger -->
    <div id="categoryInfiniteTrigger" class="py-4 w-full flex items-center justify-center">
        <span id="categoryAllLoadedBadge" class="<?= count($displayProducts) <= $initialCategoryLimit ? '' : 'hidden' ?> text-xs font-bold text-slate-400 py-3 flex items-center space-x-1.5">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
            <span>সকল পণ্য প্রদর্শিত হয়েছে</span>
        </span>
    </div>

</main>

<script>
    let categoryCurrentPage = 2;
    const categoryLimit = 8;
    const activeCategoryFilter = <?= json_encode(!empty($activeCat['slug']) ? $activeCat['slug'] : (!empty($activeCat['uuid']) ? $activeCat['uuid'] : '')) ?>;
    const activeSearchFilter = <?= json_encode($searchQuery) ?>;
    let currentSortType = '';
    let categoryHasMore = true;
    let categoryLoading = false;

    function checkCategoryScrollTrigger() {
        if (!categoryHasMore || categoryLoading) return;
        const triggerEl = document.getElementById('categoryInfiniteTrigger');
        if (!triggerEl) return;
        const rect = triggerEl.getBoundingClientRect();
        if (rect.top <= (window.innerHeight || document.documentElement.clientHeight) + 450) {
            loadMoreCategoryProducts(false);
        }
    }

    function loadMoreCategoryProducts(reset = false) {
        if (categoryLoading) return;
        if (!reset && !categoryHasMore) return;

        categoryLoading = true;
        $('#categorySkeletonContainer').removeClass('hidden');

        if (reset) {
            categoryCurrentPage = 1;
            categoryHasMore = true;
            $('#categoryProductsGrid').empty();
            $('#categoryAllLoadedBadge').addClass('hidden');
        }

        $.ajax({
            url: 'ajax_products.php',
            type: 'GET',
            data: {
                page: categoryCurrentPage,
                limit: categoryLimit,
                category: activeCategoryFilter,
                q: activeSearchFilter,
                sort: currentSortType,
                card_type: 'category'
            },
            dataType: 'json',
            success: function(res) {
                setTimeout(function() {
                    $('#categorySkeletonContainer').addClass('hidden');
                    if (res && res.success && res.html) {
                        // Extract strictly valid HTML element nodes (nodeType 1)
                        const parsedNodes = $.parseHTML(res.html.trim());
                        const elementCards = $(parsedNodes).filter(function() {
                            return this.nodeType === 1;
                        }).get();

                        if (elementCards && elementCards.length > 0) {
                            $('#categoryProductsGrid').append(elementCards);
                            if (window.lucide) lucide.createIcons();

                            // Safe GSAP animation on element nodes only
                            if (window.gsap) {
                                try {
                                    gsap.fromTo(elementCards, 
                                        { opacity: 0, y: 16 }, 
                                        { opacity: 1, y: 0, duration: 0.3, stagger: 0.03, clearProps: 'all', ease: 'power2.out' }
                                    );
                                } catch (e) {
                                    $(elementCards).css({ opacity: 1, transform: 'none' });
                                }
                            } else {
                                $(elementCards).css({ opacity: 1, transform: 'none' });
                            }
                        }

                        categoryCurrentPage++;
                        categoryHasMore = !!res.has_more;

                        if (!categoryHasMore) {
                            $('#categoryAllLoadedBadge').removeClass('hidden');
                        }
                    } else {
                        categoryHasMore = false;
                        $('#categoryAllLoadedBadge').removeClass('hidden');
                    }
                    categoryLoading = false;

                    // Re-check trigger in case user is still near bottom
                    setTimeout(checkCategoryScrollTrigger, 120);
                }, 300);
            },
            error: function() {
                $('#categorySkeletonContainer').addClass('hidden');
                categoryLoading = false;
            }
        });
    }

    function sortProductsList(type) {
        currentSortType = type;
        loadMoreCategoryProducts(true);
    }

    $(document).ready(function() {
        if (window.lucide) lucide.createIcons();

        // 1. IntersectionObserver for modern browsers
        if ('IntersectionObserver' in window) {
            const triggerEl = document.getElementById('categoryInfiniteTrigger');
            if (triggerEl) {
                const observer = new IntersectionObserver(function(entries) {
                    if (entries[0].isIntersecting) {
                        checkCategoryScrollTrigger();
                    }
                }, { rootMargin: '400px' });
                observer.observe(triggerEl);
            }
        }

        // 2. Active Window Scroll & Resize listener
        let catScrollThrottle = null;
        $(window).on('scroll resize', function() {
            if (catScrollThrottle) return;
            catScrollThrottle = setTimeout(function() {
                catScrollThrottle = null;
                checkCategoryScrollTrigger();
            }, 60);
        });

        // Initial check
        setTimeout(checkCategoryScrollTrigger, 400);
    });
</script>

<?php require_once __DIR__ . '/views/footer.php'; ?>
