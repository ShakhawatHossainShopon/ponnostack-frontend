<?php

/**
 * Client Storefront - Dedicated Discounts & Flash Deals Page
 * 
 * Displays all active promotional discount products with countdown timers,
 * original vs discounted pricing, savings calculation, and direct routing
 * to product details and order flow.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/sample_data.php';

$pageTitle = 'বিশেষ ডিসকাউন্ট ও ফ্ল্যাশ সেল | ' . htmlspecialchars($storeName);

// Fetch products that have active discounts
$productsRes = ApiClient::get('products', ['status' => 'active', 'discount_only' => 1]);
$discountedProducts = [];

if (!empty($productsRes['success']) && is_array($productsRes['data'])) {
    foreach ($productsRes['data'] as $p) {
        if (!empty($p['has_discount'])) {
            $discountedProducts[] = $p;
        }
    }
}
if (empty($discountedProducts)) {
    $discountedProducts = array_values(array_filter(getSampleProducts(), fn($p) => !empty($p['has_discount'])));
}

// Dedicated Flash Sale & Discount SEO
$seoTitle = 'বিশেষ ডিসকাউন্ট ও ফ্ল্যাশ সেল অফার | ' . $storeName;
$seoDescription = $storeName . '-এর আকর্ষণীয় ডিসকাউন্ট, বিশেষ ছাড় ও ফ্ল্যাশ ডিল সমূহ দেখুন। সীমিত সময়ের অফারে সাশ্রয়ী মূল্যে অর্ডার করুন।';
$seoKeywords = 'ডিসকাউন্ট, ছাড়, ফ্ল্যাশ সেল, স্পেশাল অফার, ' . $storeName . ', discount offers bangladesh';
$displayProducts = $discountedProducts;

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
        <span class="text-slate-800 font-bold">ডিসকাউন্ট ও বিশেষ অফার</span>
    </nav>

    <!-- Hero Promotional Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-brand-600 via-brand-700 to-brand-800 text-white p-6 sm:p-10 shadow-lg">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 max-w-2xl space-y-3">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-black uppercase tracking-wider">
                <i data-lucide="flame" class="w-4 h-4 text-amber-300 animate-pulse"></i>
                <span>সীমিত সময়ের অফার (Flash Deals)</span>
            </div>
            <h1 class="text-2xl sm:text-4xl font-black leading-tight">
                ধামাকা ডিসকাউন্ট ও স্পেশাল অফারসমূহ!
            </h1>
            <p class="text-xs sm:text-sm text-brand-100 font-medium leading-relaxed">
                আমাদের সেরা কোয়ালিটির পণ্যে উপভোগ করুন অবিশ্বাস্য মূল্যছাড়। অফারের সময়সীমা বা স্টক শেষ হওয়ার আগেই আপনার পছন্দের পণ্যটি অর্ডার করুন।
            </p>
            <div class="flex items-center space-x-3 pt-2 text-xs font-bold text-white">
                <div class="flex items-center space-x-1.5 bg-black/20 px-3 py-1.5 rounded-xl backdrop-blur-sm">
                    <i data-lucide="package-check" class="w-4 h-4 text-emerald-300"></i>
                    <span><?= count($discountedProducts) ?>টি পণ্য ছাড়ে উপলভ্য</span>
                </div>
                <div class="flex items-center space-x-1.5 bg-black/20 px-3 py-1.5 rounded-xl backdrop-blur-sm">
                    <i data-lucide="truck" class="w-4 h-4 text-amber-300"></i>
                    <span>ক্যাশ অন ডেলিভারি</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Discounted Products Section -->
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-3">
            <div>
                <h2 class="text-lg sm:text-xl font-black text-slate-900 flex items-center space-x-2">
                    <i data-lucide="percent" class="w-5 h-5 text-brand-600"></i>
                    <span>চলমান ছাড়যুক্ত পণ্যসমূহ</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">প্রতিটি পণ্যের নির্দিষ্ট কাউন্টডাউন সময়ের মধ্যে অর্ডার সম্পন্ন করুন</p>
            </div>
            <div class="text-xs text-slate-500 font-bold">
                সর্বমোট <strong><?= count($discountedProducts) ?></strong> টি পণ্য
            </div>
        </div>

        <?php if (!empty($discountedProducts)): ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-6">
                <?php foreach ($discountedProducts as $prod): ?>
                    <?php
                        $prodUuid = htmlspecialchars($prod['uuid'], ENT_QUOTES, 'UTF-8');
                        $prodSlug = !empty($prod['slug']) ? $prod['slug'] : $prod['uuid'];
                        $prodUrl = 'product?slug=' . urlencode($prodSlug);
                        $img = !empty($prod['images'][0]) ? $prod['images'][0] : null;
                        $stock = (int)($prod['stock'] ?? 0);
                        $regularPrice = (float)($prod['retailer_price'] ?? 0);
                        $discountPrice = (float)($prod['effective_price'] ?? $regularPrice);
                        $discountPercent = (int)($prod['discount_percent'] ?? 0);
                        $savings = (float)($prod['savings_amount'] ?? 0);
                        $endsAt = !empty($prod['discount_ends_at']) ? $prod['discount_ends_at'] : null;
                    ?>
                    <div onclick="window.location.href='<?= $prodUrl ?>'" 
                         class="bg-white border border-slate-200/90 hover:border-brand-500 rounded-3xl overflow-hidden shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 sm:p-4 group cursor-pointer relative">
                        
                        <!-- Top Floating Badges -->
                        <div class="relative">
                            <!-- Image Showcase -->
                            <div class="aspect-square bg-slate-50 rounded-2xl mb-3 overflow-hidden flex items-center justify-center text-slate-400 relative border border-slate-100">
                                <?php if ($img): ?>
                                    <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <?php else: ?>
                                    <i data-lucide="package" class="w-10 h-10 text-slate-300"></i>
                                <?php endif; ?>

                                <!-- Discount Percentage Ribbon (Top-Right) -->
                                <div class="absolute top-2.5 right-2.5">
                                    <span class="px-2.5 py-1 bg-gradient-to-r from-red-600 to-rose-600 text-white font-black text-xs rounded-xl shadow-md flex items-center space-x-1 animate-bounce">
                                        <i data-lucide="zap" class="w-3 h-3 text-amber-300"></i>
                                        <span><?= $discountPercent ?>% ছাড়</span>
                                    </span>
                                </div>

                                <!-- Stock Status Badge (Top-Left) -->
                                <div class="absolute top-2.5 left-2.5">
                                    <?php if ($stock > 0): ?>
                                        <span class="px-2 py-0.5 bg-slate-900/80 backdrop-blur-md text-white rounded-lg text-[10px] font-bold">
                                            স্টক: <?= $stock ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 bg-rose-600 text-white rounded-lg text-[10px] font-bold">
                                            স্টক শেষ
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Live Countdown Timer Banner -->
                            <?php if ($endsAt): ?>
                                <div class="mb-2.5 px-2.5 py-1.5 bg-brand-50 border border-brand-200/80 rounded-xl text-[10px] font-bold text-brand-900 flex items-center space-x-1.5">
                                    <i data-lucide="clock" class="w-3.5 h-3.5 text-brand-600 shrink-0"></i>
                                    <span class="truncate">বাকি:</span>
                                    <span class="live-discount-timer font-mono text-brand-700" data-ends="<?= htmlspecialchars($endsAt) ?>">গণনা হচ্ছে...</span>
                                </div>
                            <?php endif; ?>

                            <!-- Category & Title -->
                            <div class="mb-1">
                                <span class="inline-flex items-center space-x-1 px-1.5 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-600">
                                    <i data-lucide="tag" class="w-2.5 h-2.5 text-slate-400"></i>
                                    <span><?= htmlspecialchars($prod['category_name'] ?? 'Unnamed') ?></span>
                                </span>
                            </div>

                            <h3 class="font-extrabold text-xs sm:text-sm text-slate-900 line-clamp-1 group-hover:text-brand-600 transition mb-1">
                                <?= htmlspecialchars($prod['name']) ?>
                            </h3>
                        </div>

                        <!-- Price & CTA Action -->
                        <div class="pt-2.5 mt-2 border-t border-slate-100 space-y-2">
                            <div class="flex items-baseline justify-between">
                                <div>
                                    <span class="text-xs sm:text-sm font-black text-brand-600 font-mono">
                                        ৳<?= number_format($discountPrice, 2) ?>
                                    </span>
                                    <span class="text-[11px] text-slate-400 line-through font-mono ml-1.5">
                                        ৳<?= number_format($regularPrice, 2) ?>
                                    </span>
                                </div>
                                <?php if ($savings > 0): ?>
                                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">
                                        সাশ্রয় ৳<?= number_format($savings, 0) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <a href="<?= $prodUrl ?>" onclick="event.stopPropagation();" 
                               class="w-full py-2 px-3 bg-brand-50 group-hover:bg-brand-600 text-brand-700 group-hover:text-white border border-brand-200 group-hover:border-brand-600 text-xs font-black rounded-xl transition flex items-center justify-center space-x-1.5 shadow-2xs">
                                <span>অর্ডার ও বিস্তারিত</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Empty State Notice -->
            <div class="bg-white border border-slate-200 rounded-3xl p-12 sm:p-16 text-center shadow-xs">
                <div class="w-16 h-16 bg-brand-50 text-brand-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="tag" class="w-8 h-8"></i>
                </div>
                <h3 class="text-base font-extrabold text-slate-900 mb-1">বর্তমানে কোনো পণ্যে সক্রিয় ডিসকাউন্ট নেই</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-5">
                    আমাদের স্টোরে নিয়মিত নতুন ছাড় ও ফ্ল্যাশ সেল অফার যুক্ত করা হয়। সব সাধারণ পণ্য দেখতে আমাদের ক্যাটালগ ভিজিট করুন।
                </p>
                <a href="./#catalog" class="inline-flex items-center space-x-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-2xl transition shadow-xs">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>সকল পণ্য দেখুন</span>
                </a>
            </div>
        <?php endif; ?>
    </div>

</main>

<!-- Live Countdown Timer Engine -->
<script>
    function updateDiscountCountdowns() {
        const now = new Date().getTime();
        $('.live-discount-timer').each(function() {
            const endsStr = $(this).data('ends');
            if (!endsStr) return;

            const endsTime = new Date(endsStr.replace(/-/g, '/')).getTime();
            const distance = endsTime - now;

            if (distance <= 0) {
                $(this).text('অফার সমাপ্ত');
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            let timeText = '';
            if (days > 0) {
                timeText += days + 'দিন ';
            }
            timeText += String(hours).padStart(2, '0') + 'ঘণ্টা ' + 
                        String(minutes).padStart(2, '0') + 'মি. ' + 
                        String(seconds).padStart(2, '0') + 'সে.';

            $(this).text(timeText);
        });
    }

    $(document).ready(function() {
        updateDiscountCountdowns();
        setInterval(updateDiscountCountdowns, 1000);
        lucide.createIcons();
    });
</script>

<?php require_once __DIR__ . '/views/footer.php'; ?>
