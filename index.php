<?php

/**
 * Client Storefront - Official Homepage
 * 
 * Features:
 * - Status Gatekeeper (Active vs Expired / Suspended / Setup Pending)
 * - Dynamic Theme & Color Palette Alignment (20 Distinct Designs)
 * - Hero Carousel Banner Slider
 * - Trust Features Bar (Cash on Delivery, Fast Shipping, Original Quality)
 * - Category Quick Filters
 * - Flash Deals & Special Discounts Showcase
 * - Universal 20-Template Product Grid (renderUniversalProductCard)
 * - Global Cart Drawer & Live Tracking Modals
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/sample_data.php';
require_once __DIR__ . '/views/template_cards.php';

// Fetch active products from API; fallback to sample data if store owner hasn't uploaded products yet
$productsRes = ApiClient::get('products', ['status' => 'active']);
$allProducts = (!empty($productsRes['success']) && is_array($productsRes['data']) && count($productsRes['data']) > 0)
    ? $productsRes['data']
    : getSampleProducts();

// Filter flash deals products
$discountedProducts = array_values(array_filter($allProducts, fn($p) => !empty($p['has_discount'])));

$displayProducts = $allProducts;
$pageTitle = htmlspecialchars($storeName) . ' | অফিসিয়াল অনলাইন শপ';
$seoTitle = $storeName . ' | সেরা অনলাইন কেনাকাটা ও অফার';
$seoDescription = 'স্বাগতম ' . $storeName . '-এর অফিসিয়াল অনলাইন শপে। সেরা মূল্যে আকর্ষণীয় পণ্য অর্ডার করুন। বিকাশ ও ক্যাশ অন ডেলিভারি সুবিধা।';

require_once __DIR__ . '/views/header.php';
?>

<main class="max-w-6xl mx-auto px-4 py-6 sm:py-8 space-y-10 flex-1">

    <!-- 1. HOT DEALS / FLASH SALE / DISCOUNT SHOWCASE (FIRST SECTION - TOPMOST) -->
    <?php if (!empty($discountedProducts)): ?>
    <?php 
        $earliestEnd = null;
        foreach ($discountedProducts as $dp) {
            if (!empty($dp['discount_ends_at'])) {
                if (!$earliestEnd || $dp['discount_ends_at'] < $earliestEnd) {
                    $earliestEnd = $dp['discount_ends_at'];
                }
            }
        }
    ?>
    <section class="p-5 sm:p-6 rounded-3xl bg-gradient-to-r from-brand-600 via-brand-700 to-brand-800 text-white shadow-lg space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-1">
                <div class="flex flex-wrap items-center gap-2">
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[11px] font-black uppercase tracking-wider">
                        <i data-lucide="flame" class="w-3.5 h-3.5 text-amber-300 animate-pulse"></i>
                        <span>ধামাকা অফার (Hot Deals)</span>
                    </div>
                    <?php if ($earliestEnd): ?>
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-black/30 backdrop-blur-md text-amber-300 text-[11px] font-bold border border-white/20">
                        <i data-lucide="timer" class="w-3.5 h-3.5 text-amber-300"></i>
                        <span>অফার বাকি:</span>
                        <span class="font-mono font-black text-white home-discount-countdown" data-ends="<?= htmlspecialchars($earliestEnd) ?>">--:--:--</span>
                    </div>
                    <?php endif; ?>
                </div>
                <h2 class="text-xl sm:text-2xl font-black">সীমিত সময়ের বিশেষ মূল্যছাড়!</h2>
            </div>
            <a href="discount" class="self-start sm:self-auto px-4 py-2 rounded-xl bg-white text-brand-700 hover:bg-brand-50 font-extrabold text-xs transition shadow-md flex items-center space-x-1.5">
                <span>সব অফার দেখুন</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
            <?php foreach (array_slice($discountedProducts, 0, 4) as $prod): ?>
                <?= renderUniversalProductCard($prod, $tplNum, $storeCurrency) ?>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 2. HERO CAROUSEL BANNER SECTION (SECOND SECTION - ONLY IF BANNERS EXIST) -->
    <?php if (!empty($storeBanners)): ?>
    <section class="relative overflow-hidden rounded-3xl shadow-lg group bg-slate-900 aspect-[21/9] sm:aspect-[21/8] max-h-[460px]">
        <div id="heroCarouselTrack" class="flex transition-transform duration-500 ease-out h-full w-full">
            <?php foreach ($storeBanners as $idx => $bannerUrl): ?>
            <div class="min-w-full h-full relative shrink-0">
                <img src="<?= htmlspecialchars($bannerUrl) ?>" 
                     alt="<?= htmlspecialchars($storeName) ?> Banner <?= $idx + 1 ?>" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($storeBanners) > 1): ?>
        <!-- Slider Navigation Controls -->
        <button type="button" onclick="prevHeroBanner()" 
                class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/80 hover:bg-white text-slate-800 shadow-md backdrop-blur-sm flex items-center justify-center transition opacity-0 group-hover:opacity-100 cursor-pointer">
            <i data-lucide="chevron-left" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </button>
        <button type="button" onclick="nextHeroBanner()" 
                class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/80 hover:bg-white text-slate-800 shadow-md backdrop-blur-sm flex items-center justify-center transition opacity-0 group-hover:opacity-100 cursor-pointer">
            <i data-lucide="chevron-right" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </button>

        <!-- Carousel Indicator Dots -->
        <div class="absolute bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 flex items-center space-x-2">
            <?php foreach ($storeBanners as $idx => $b): ?>
            <button type="button" onclick="goToHeroBanner(<?= $idx ?>)" 
                    class="hero-dot w-2.5 h-2.5 rounded-full transition-all <?= $idx === 0 ? 'bg-white w-6' : 'bg-white/50 hover:bg-white/80' ?>">
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- 3. CATEGORY SECTION (THIRD SECTION - AFTER BANNERS; ONLY IF CUSTOM CATEGORIES EXIST) -->
    <?php if (!empty($hasCategories)): ?>
    <section class="space-y-3">
        <div class="flex items-center justify-between">
            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center space-x-2">
                <i data-lucide="grid" class="w-4 h-4 text-brand-600"></i>
                <span>ক্যাটাগরি সমূহ</span>
            </h3>
            <a href="category" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center space-x-1">
                <span>সব দেখুন</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2.5 sm:gap-3.5">
            <?php foreach ($categories as $cat): ?>
                <?php
                    $catSlug = $cat['slug'] ?? $cat['uuid'];
                    $catImg = !empty($cat['image']) ? ApiClient::assetUrl($cat['image']) : null;
                ?>
                <a href="category?cat=<?= urlencode((string)$catSlug) ?>" 
                   class="group flex flex-col items-center text-center p-2.5 sm:p-3 rounded-2xl bg-white hover:bg-brand-50/30 border border-slate-200/90 hover:border-brand-500 shadow-2xs hover:shadow-sm transition-all duration-200 cursor-pointer">
                    <!-- Category Small Image -->
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl overflow-hidden bg-slate-50 mb-2 border border-slate-100 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                        <?php if ($catImg): ?>
                            <img src="<?= htmlspecialchars($catImg) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-brand-50 text-brand-600">
                                <i data-lucide="folder" class="w-6 h-6"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Category Name -->
                    <span class="text-[11px] sm:text-xs font-bold text-slate-800 group-hover:text-brand-600 transition truncate max-w-full block leading-tight" title="<?= htmlspecialchars($cat['name']) ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 4. MAIN CATALOG / PRODUCTS SHOWCASE (ALIGNED WITH ACTIVE TEMPLATE) -->
    <section id="catalog" class="space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-3">
            <div>
                <h2 class="text-lg sm:text-xl font-black text-slate-900 flex items-center space-x-2">
                    <i data-lucide="package" class="w-5 h-5 text-brand-600"></i>
                    <span>আমাদের জনপ্রিয় পণ্যসমূহ</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">সেরা দামে সেরা মানের পণ্য ঘরে বসেই অর্ডার করুন</p>
            </div>
            <div class="text-xs text-slate-500 font-bold">
                সর্বমোট <strong><?= count($allProducts) ?></strong> টি পণ্য উপলভ্য
            </div>
        </div>

        <?php if (empty($allProducts)): ?>
        <div class="py-16 text-center space-y-3 bg-white rounded-3xl border border-dashed border-slate-200 p-8 shadow-2xs">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center">
                <i data-lucide="package-open" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-extrabold text-slate-800">বর্তমানে কোনো পণ্য যুক্ত নেই</h3>
            <p class="text-xs text-slate-500 max-w-sm mx-auto">স্টোর ওনার এখনও কোনো পণ্য যোগ করেননি। নতুন পণ্য যুক্ত করা হলে এখানে প্রদর্শিত হবে।</p>
        </div>
        <?php else: ?>
        <!-- Dynamic 20-Template Product Grid (Paginated with Infinite Scroll) -->
        <div id="catalogProductsGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-6">
            <?php 
            $initialLimit = 8;
            $initialProducts = array_slice($allProducts, 0, $initialLimit);
            foreach ($initialProducts as $prod): 
            ?>
                <?= renderUniversalProductCard($prod, $tplNum, $storeCurrency) ?>
            <?php endforeach; ?>
        </div>

        <!-- Animated Skeleton Loader Container (Active during Infinite Scroll fetch) -->
        <div id="catalogSkeletonContainer" class="hidden grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-6 pt-2">
            <?= renderProductSkeletonCard(4) ?>
        </div>

        <!-- Infinite Scroll Sentinel Trigger -->
        <div id="catalogInfiniteTrigger" class="py-4 w-full flex items-center justify-center">
            <span id="allProductsLoadedBadge" class="<?= count($allProducts) <= $initialLimit ? '' : 'hidden' ?> text-xs font-bold text-slate-400 py-3 flex items-center space-x-1.5">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
                <span>সকল পণ্য প্রদর্শিত হয়েছে</span>
            </span>
        </div>
        <?php endif; ?>
    </section>

</main>

<!-- HERO CAROUSEL & INFINITE SCROLL CLIENT SCRIPT -->
<script>
    let currentHeroIndex = 0;
    const totalHeroBanners = <?= count($storeBanners) ?>;
    let heroAutoTimer = null;

    function updateHeroCarousel() {
        const track = document.getElementById('heroCarouselTrack');
        if (!track) return;
        track.style.transform = `translateX(-${currentHeroIndex * 100}%)`;
        
        document.querySelectorAll('.hero-dot').forEach((dot, idx) => {
            if (idx === currentHeroIndex) {
                dot.classList.add('bg-white', 'w-6');
                dot.classList.remove('bg-white/50');
            } else {
                dot.classList.remove('bg-white', 'w-6');
                dot.classList.add('bg-white/50');
            }
        });
    }

    function nextHeroBanner() {
        if (totalHeroBanners <= 1) return;
        currentHeroIndex = (currentHeroIndex + 1) % totalHeroBanners;
        updateHeroCarousel();
        resetHeroTimer();
    }

    function prevHeroBanner() {
        if (totalHeroBanners <= 1) return;
        currentHeroIndex = (currentHeroIndex - 1 + totalHeroBanners) % totalHeroBanners;
        updateHeroCarousel();
        resetHeroTimer();
    }

    function goToHeroBanner(idx) {
        currentHeroIndex = idx;
        updateHeroCarousel();
        resetHeroTimer();
    }

    function resetHeroTimer() {
        if (heroAutoTimer) clearInterval(heroAutoTimer);
        if (totalHeroBanners > 1) {
            heroAutoTimer = setInterval(nextHeroBanner, 5000);
        }
    }

    // Infinite Scroll Engine for Homepage Main Catalog
    let infiniteCatalogPage = 2;
    const infiniteCatalogLimit = 8;
    const totalCatalogProducts = <?= count($allProducts) ?>;
    let infiniteCatalogHasMore = true;
    let infiniteCatalogLoading = false;

    function checkCatalogScrollTrigger() {
        if (!infiniteCatalogHasMore || infiniteCatalogLoading) return;
        const triggerEl = document.getElementById('catalogInfiniteTrigger');
        if (!triggerEl) return;
        const rect = triggerEl.getBoundingClientRect();
        if (rect.top <= (window.innerHeight || document.documentElement.clientHeight) + 450) {
            loadMoreCatalogProducts();
        }
    }

    function loadMoreCatalogProducts() {
        if (!infiniteCatalogHasMore || infiniteCatalogLoading) return;
        infiniteCatalogLoading = true;
        $('#catalogSkeletonContainer').removeClass('hidden');

        $.ajax({
            url: 'ajax_products.php',
            type: 'GET',
            data: {
                page: infiniteCatalogPage,
                limit: infiniteCatalogLimit,
                tpl: <?= $tplNum ?>,
                card_type: 'universal'
            },
            dataType: 'json',
            success: function(res) {
                setTimeout(function() {
                    $('#catalogSkeletonContainer').addClass('hidden');
                    if (res && res.success && res.html) {
                        // Extract strictly valid HTML element nodes (nodeType 1), discarding any TextNodes
                        const parsedNodes = $.parseHTML(res.html.trim());
                        const elementCards = $(parsedNodes).filter(function() {
                            return this.nodeType === 1;
                        }).get();

                        if (elementCards && elementCards.length > 0) {
                            $('#catalogProductsGrid').append(elementCards);
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

                        infiniteCatalogPage++;
                        infiniteCatalogHasMore = !!res.has_more;

                        if (!infiniteCatalogHasMore) {
                            $('#allProductsLoadedBadge').removeClass('hidden');
                        }
                    } else {
                        infiniteCatalogHasMore = false;
                        $('#allProductsLoadedBadge').removeClass('hidden');
                    }
                    infiniteCatalogLoading = false;

                    // Re-check trigger in case user is still near bottom
                    setTimeout(checkCatalogScrollTrigger, 120);
                }, 300);
            },
            error: function() {
                $('#catalogSkeletonContainer').addClass('hidden');
                infiniteCatalogLoading = false;
            }
        });
    }

    $(document).ready(function() {
        resetHeroTimer();
        if (window.lucide) lucide.createIcons();

        // 1. IntersectionObserver for modern browsers
        if ('IntersectionObserver' in window) {
            const triggerEl = document.getElementById('catalogInfiniteTrigger');
            if (triggerEl) {
                const observer = new IntersectionObserver(function(entries) {
                    if (entries[0].isIntersecting) {
                        checkCatalogScrollTrigger();
                    }
                }, { rootMargin: '400px' });
                observer.observe(triggerEl);
            }
        }

        // 2. Active Window Scroll & Resize listener for reliable triggering
        let scrollThrottle = null;
        $(window).on('scroll resize', function() {
            if (scrollThrottle) return;
            scrollThrottle = setTimeout(function() {
                scrollThrottle = null;
                checkCatalogScrollTrigger();
            }, 60);
        });

        // Initial check in case screen height requires immediate second page
        setTimeout(checkCatalogScrollTrigger, 400);
    });
</script>

<?php
require_once __DIR__ . '/views/footer.php';
?>
