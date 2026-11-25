<?php

/**
 * Universal 20-Template Product Card Engine
 * 
 * Generates 20 genuinely distinct, bespoke product card CSS designs.
 * Uses ONLY real dynamic database data:
 * - Real product title & category
 * - Real image from database
 * - Real stock count & availability
 * - Real price & real discount percent (only when active)
 * - Real sizes & colors (only if set in database)
 * - Real description snippet (only if set in database)
 * - Standardized button text: "অর্ডার করুন" across all templates
 * 
 * Strictly NO hardcoded fake tags, NO floating speculative badges, NO fake ratings.
 */

declare(strict_types=1);

function renderUniversalProductCard(array $prod, int $tplNum, string $currency = 'BDT'): string
{
    $img = !empty($prod['images'][0]) ? $prod['images'][0] : null;
    $name = htmlspecialchars((string)($prod['name'] ?? 'পণ্য'), ENT_QUOTES, 'UTF-8');
    $stock = (int)($prod['stock'] ?? 0);
    $retailerPrice = (float)($prod['retailer_price'] ?? 0);
    $hasDiscount = !empty($prod['has_discount']);
    $discountPercent = (int)($prod['discount_percent'] ?? 0);
    $effectivePrice = (float)($prod['effective_price'] ?? $retailerPrice);
    $rawCatName = !empty($prod['category_name']) ? trim((string)$prod['category_name']) : '';
    $categoryName = (strtolower($rawCatName) !== 'unname' && strtolower($rawCatName) !== 'unnamed') ? htmlspecialchars($rawCatName, ENT_QUOTES, 'UTF-8') : '';

    // Product cards show Title and Price (no description or sizes as requested)
    $cleanDesc = '';
    $descSnippet = '';
    $sizes = [];
    $colors = [];

    $prodSlug = !empty($prod['slug']) ? $prod['slug'] : ($prod['uuid'] ?? '');
    $prodUrl = 'product?slug=' . urlencode((string)$prodSlug);

    $imgTag = $img
        ? '<img src="' . htmlspecialchars($img) . '" alt="' . $name . '" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">'
        : '<div class="w-full h-full flex items-center justify-center text-slate-300"><i data-lucide="package" class="w-10 h-10"></i></div>';

    $priceFormatted = '৳' . number_format($effectivePrice, 0);
    $retailFormatted = '৳' . number_format($retailerPrice, 0);

    ob_start();
    switch ($tplNum) {

        // ==========================================
        // TEMPLATE 1: Modern Classic E-Commerce
        // Rounded-2xl, crisp white, full-width CTA
        // ==========================================
        case 1:
        default:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-white border border-slate-200/90 hover:border-brand-500 rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="flex items-center justify-between mb-2 text-[10px]">
                        <?php if ($categoryName !== ''): ?>
                            <span class="font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md truncate max-w-[130px]"><?= $categoryName ?></span>
                        <?php else: ?><span></span><?php endif; ?>
                        <span class="font-medium <?= $stock > 0 ? 'text-emerald-700 bg-emerald-50' : 'text-red-700 bg-red-50' ?> px-2 py-0.5 rounded-md">
                            <?= $stock > 0 ? $stock . 'টি স্টক' : 'স্টক শেষ' ?>
                        </span>
                    </div>

                    <div class="aspect-square bg-slate-50 rounded-xl mb-2.5 overflow-hidden flex items-center justify-center relative border border-slate-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-red-600 text-white rounded-lg text-[10px] font-black shadow-xs">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-2">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="text-xs sm:text-sm font-black text-brand-600 tracking-tight"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[10px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <button type="button" class="w-full py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold transition flex items-center justify-center space-x-1 shadow-2xs">
                        <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                        <span>অর্ডার করুন</span>
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 2: Vogue Lookbook (Portrait 3:4)
        // Stone editorial, serif typography, minimalist chic
        // ==========================================
        case 2:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#fdfcf9] border border-stone-200/90 hover:border-stone-400 rounded-xl overflow-hidden shadow-xs hover:shadow-2xl transition-all duration-300 flex flex-col justify-between p-3 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-[3/4] bg-stone-100 rounded-lg mb-2.5 overflow-hidden flex items-center justify-center relative">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 left-2 px-2 py-0.5 bg-stone-900 text-stone-100 text-[8px] font-bold tracking-widest uppercase">
                                -<?= $discountPercent ?>%
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <div class="text-[9px] text-stone-400 uppercase tracking-widest font-serif"><?= $categoryName ?></div>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-serif font-bold text-xs sm:text-sm text-stone-900 line-clamp-1 group-hover:text-stone-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-serif font-bold text-xs sm:text-sm text-stone-900"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[10px] text-stone-400 line-through block font-serif -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-stone-400 font-serif mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-stone-100">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded text-xs font-serif transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 3: Tech Gadget (Cyber Dark)
        // Neon cyan, dark background, monospace
        // ==========================================
        case 3:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-slate-900 text-white border border-slate-700/80 hover:border-brand-400 rounded-xl overflow-hidden shadow-md hover:shadow-brand-500/20 hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-slate-950 rounded-lg mb-2.5 overflow-hidden flex items-center justify-center relative border border-slate-800">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-1.5 py-0.5 bg-red-600 text-white text-[9px] font-mono font-bold rounded">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-400 font-mono block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-100 line-clamp-1 group-hover:text-brand-300 transition font-mono flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="text-xs sm:text-sm font-black text-brand-400 font-mono"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-500 line-through block font-mono -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-slate-400 font-mono mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-slate-800">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-500 hover:bg-brand-400 text-slate-950 font-black text-xs rounded transition font-mono whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 4: FreshMart Natural
        // Natural emerald/amber, clean green styling
        // ==========================================
        case 4:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#fbfdfa] border border-brand-200/90 hover:border-brand-500 rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50/50 rounded-xl mb-2.5 overflow-hidden flex items-center justify-center relative border border-brand-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-amber-600 text-white rounded-lg text-[9px] font-black shadow-xs">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[10px] text-brand-700/80 font-bold block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 line-clamp-1 group-hover:text-brand-700 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-800"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-700 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold transition shadow-2xs whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 5: Glow Beauty Pastel
        // Soft blush pink, 28px pill curves
        // ==========================================
        case 5:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#fffcfc] border border-brand-200/80 hover:border-brand-400 rounded-[28px] overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-[4/5] bg-brand-50/40 rounded-[22px] mb-2.5 overflow-hidden flex items-center justify-center relative border border-brand-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2.5 right-2.5 px-2.5 py-0.5 bg-rose-500 text-white rounded-full text-[9px] font-bold shadow-xs">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-400 font-bold uppercase tracking-wider block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-800 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-600"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-500 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-full text-xs font-bold transition shadow-xs whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 6: Neo-Brutalist Bold Pop
        // 2.5px solid black border, 4px hard shadow
        // ==========================================
        case 6:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-white border-[2.5px] border-black rounded-lg overflow-hidden shadow-[4px_4px_0px_0px_#000] hover:shadow-[1px_1px_0px_0px_#000] hover:translate-x-[3px] hover:translate-y-[3px] transition-all duration-200 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-slate-100 mb-2.5 overflow-hidden flex items-center justify-center relative border-2 border-black">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-2 py-0.5 bg-yellow-400 text-black border border-black text-[10px] font-black uppercase">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="px-1.5 py-0.5 bg-black text-white text-[8px] font-black uppercase inline-block mb-1"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-black text-xs sm:text-sm text-black line-clamp-1 flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-sm text-black"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[10px] text-slate-500 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] font-black text-slate-500 mt-1 uppercase">স্টক: <?= $stock ?></div>
                </div>

                <div class="pt-2 mt-1 border-t-2 border-black">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-500 hover:bg-brand-600 text-black border-2 border-black text-xs font-black uppercase whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 7: Scandinavian Interior
        // 16:11 landscape image, warm stone tone
        // ==========================================
        case 7:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#f9f8f5] border border-stone-200/90 hover:border-stone-400 rounded-xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-[16/11] bg-stone-100 rounded-lg mb-2.5 overflow-hidden flex items-center justify-center relative border border-stone-200">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-1.5 py-0.5 bg-stone-900 text-white rounded text-[8px] font-medium">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <div class="text-[9px] text-stone-500 uppercase tracking-wider font-semibold"><?= $categoryName ?></div>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-semibold text-xs sm:text-sm text-stone-900 line-clamp-1 group-hover:text-stone-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-bold text-xs sm:text-sm text-stone-900"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-stone-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-stone-400 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-stone-200">
                    <button type="button" class="w-full px-2.5 py-1.5 border border-stone-800 text-stone-900 hover:bg-stone-900 hover:text-white rounded text-xs font-semibold transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 8: Kids Wonderland Curves
        // 30px candy curves, bright pink/yellow
        // ==========================================
        case 8:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-white border-2 border-brand-200 hover:border-brand-400 rounded-[30px] overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50/60 rounded-[22px] mb-2.5 overflow-hidden flex items-center justify-center relative border border-brand-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-brand-500 text-white rounded-full text-[9px] font-black shadow-xs">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-500 font-bold block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-black text-xs sm:text-sm text-slate-800 line-clamp-1 flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-sm text-brand-600"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-400 mt-1 font-bold">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-full text-xs font-black shadow-xs whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 9: Active Sports Dynamic
        // Red speed stripe, athletic dark aesthetic
        // ==========================================
        case 9:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-slate-950 text-white border-l-4 border-l-brand-600 border border-slate-800 hover:border-brand-500 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-slate-900 rounded mb-2 overflow-hidden flex items-center justify-center relative">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-red-600 text-white text-[9px] font-black uppercase italic skew-x-[-10deg] shadow-sm">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-slate-400 uppercase tracking-wider block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-black italic text-xs sm:text-sm text-white line-clamp-1 group-hover:text-brand-400 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-sm text-brand-500"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-500 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-slate-400 font-mono mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-slate-800">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white font-black text-xs rounded uppercase whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 10: Literary Academic Jacket
        // Antique paper tone #faf7f2, serif literary
        // ==========================================
        case 10:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#faf7f2] border border-[#ded4c3] hover:border-brand-500 rounded-md overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between p-3 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-[3/4] bg-[#f0eae1] rounded mb-2 overflow-hidden flex items-center justify-center relative border border-[#e5dcce]">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 bg-[#59432d] text-white text-[8px] font-serif rounded">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-stone-500 font-serif block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-serif font-bold text-xs sm:text-sm text-stone-900 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-serif font-bold text-xs sm:text-sm text-brand-700"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-stone-400 line-through block font-serif -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[8px] text-stone-500 font-serif mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-[#ded4c3]">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded text-xs font-serif transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 11: MediCare Pharmacy
        // Clinical teal, crisp clean styling
        // ==========================================
        case 11:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-white border border-brand-200 hover:border-brand-400 rounded-xl overflow-hidden shadow-2xs hover:shadow-md transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50/40 rounded-lg mb-2 overflow-hidden flex items-center justify-center relative border border-brand-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 bg-red-600 text-white text-[8px] font-bold rounded">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-700 font-bold block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-800 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-800"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-600 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded text-xs font-bold transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 12: Nordic Obsidian Gold
        // Midnight black #0a0b10, gold hairline
        // ==========================================
        case 12:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#0b0c10] text-white border border-brand-500/30 hover:border-brand-400 rounded-xl overflow-hidden shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-black rounded-lg mb-2.5 overflow-hidden flex items-center justify-center relative border border-brand-500/20">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 bg-brand-500 text-black text-[8px] font-bold rounded">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-400/70 uppercase tracking-widest block font-serif"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-serif font-bold text-xs sm:text-sm text-brand-100 line-clamp-1 group-hover:text-brand-300 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-serif font-bold text-xs sm:text-sm text-brand-300"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-500 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-400/60 font-serif mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-500/20">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-500 hover:bg-brand-400 text-slate-950 font-serif font-black text-xs rounded transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 13: Mega Wholesale Flash
        // Orange & red retail style
        // ==========================================
        case 13:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-white border-2 border-brand-400 hover:border-brand-600 rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50 rounded-xl mb-2 overflow-hidden flex items-center justify-center relative border border-brand-200">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-red-600 text-white rounded-lg text-[10px] font-black">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-600 font-bold block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-black text-xs sm:text-sm text-slate-900 line-clamp-1 flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-sm text-red-600"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-600 font-bold mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-xs font-black transition shadow-xs whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 14: Deshi Heritage Handloom
        // Terracotta dashed border, warm craft look
        // ==========================================
        case 14:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#fff9f5] border-2 border-dashed border-brand-300 hover:border-brand-600 rounded-xl overflow-hidden shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50 rounded-lg mb-2 overflow-hidden flex items-center justify-center relative border border-brand-200">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 bg-brand-800 text-white rounded text-[8px] font-serif">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-800/80 font-serif block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-serif font-bold text-xs sm:text-sm text-brand-950 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-serif font-bold text-xs sm:text-sm text-brand-900"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-stone-400 line-through block font-serif -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[8px] text-brand-800 font-serif mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-200/60">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded text-xs font-serif transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 15: Urban Streetwear Drop
        // Dark zinc, emerald accents, monochrome
        // ==========================================
        case 15:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-zinc-950 text-white border border-zinc-800 hover:border-brand-400 rounded-xl overflow-hidden shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-zinc-900 rounded mb-2.5 overflow-hidden flex items-center justify-center relative border border-zinc-800">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-1.5 py-0.5 bg-white text-black text-[8px] font-black uppercase">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-zinc-500 uppercase tracking-widest block font-mono"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-black uppercase text-xs sm:text-sm text-zinc-100 line-clamp-1 group-hover:text-brand-400 transition font-mono flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-400 font-mono"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-zinc-500 line-through block font-mono -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[8px] text-zinc-500 font-mono mt-1">QTY: <?= $stock ?></div>
                </div>

                <div class="pt-2 mt-1 border-t border-zinc-800">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-500 hover:bg-brand-400 text-slate-950 font-black text-xs rounded transition font-mono whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 16: Sweet Crave Bakery & Food
        // Honey caramel #fffdf8, soft rounded 2xl
        // ==========================================
        case 16:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#fffdf8] border border-brand-200/90 hover:border-brand-400 rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50/60 rounded-xl mb-2 overflow-hidden flex items-center justify-center relative border border-brand-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-amber-600 text-white rounded-lg text-[9px] font-black">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-700/80 font-bold block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-800 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-900"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-700 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 17: MotoGear & Hardware
        // Industrial slate-900, heavy border
        // ==========================================
        case 17:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-slate-900 text-white border-2 border-slate-700 hover:border-brand-500 rounded-lg overflow-hidden shadow-md transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-slate-950 rounded mb-2 overflow-hidden flex items-center justify-center relative border border-slate-800">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 bg-red-600 text-white text-[8px] font-black uppercase">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-slate-400 block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-100 line-clamp-1 group-hover:text-brand-400 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-400"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-500 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-slate-400 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-slate-800">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-500 text-white font-black text-xs rounded transition uppercase whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 18: Eco Bloom Botanical
        // Moss green accents, Scandinavian clean
        // ==========================================
        case 18:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#f7f9f6] border border-brand-300/80 hover:border-brand-600 rounded-2xl overflow-hidden shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-[16/11] bg-brand-50 rounded-xl mb-2 overflow-hidden flex items-center justify-center relative border border-brand-200">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 bg-brand-700 text-white rounded text-[8px] font-medium">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-700 font-semibold uppercase block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-stone-900 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-bold text-xs sm:text-sm text-brand-900"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-stone-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-700 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-200">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-xs font-bold transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 19: JoyBox Celebrations
        // Pink / lilac celebration style
        // ==========================================
        case 19:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-white border border-brand-200 hover:border-brand-500 rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-brand-50/50 rounded-xl mb-2 overflow-hidden flex items-center justify-center relative border border-brand-100">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-1.5 right-1.5 px-2 py-0.5 bg-rose-500 text-white rounded-full text-[8px] font-bold">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-600 font-bold block"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-800 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-black text-xs sm:text-sm text-brand-600"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-brand-600 mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-brand-100">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-full text-xs font-bold transition shadow-xs whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;

        // ==========================================
        // TEMPLATE 20: Signature Diamond Elite Flagship
        // Midnight royal navy #0b101b, gold frame
        // ==========================================
        case 20:
            ?>
            <div onclick="window.location.href='<?= $prodUrl ?>'" class="product-item-card bg-[#0b101b] text-white border border-brand-400/40 hover:border-brand-300 rounded-2xl overflow-hidden shadow-xl transition-all duration-300 flex flex-col justify-between p-3.5 group cursor-pointer" data-product-name="<?= strtolower($name) ?>">
                <div>
                    <div class="aspect-square bg-slate-950 rounded-xl mb-2.5 overflow-hidden flex items-center justify-center relative border border-brand-500/20">
                        <?= $imgTag ?>
                        <?php if ($hasDiscount): ?>
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-red-600 text-white text-[8px] font-black rounded">-<?= $discountPercent ?>%</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($categoryName !== ''): ?>
                        <span class="text-[9px] text-brand-400/70 uppercase tracking-widest block font-serif"><?= $categoryName ?></span>
                    <?php endif; ?>
                    <!-- Title & Price in Same Row (Flex Design) -->
                    <div class="flex items-center justify-between gap-2 mt-1 mb-1">
                        <h4 class="font-serif font-bold text-xs sm:text-sm text-brand-100 line-clamp-1 group-hover:text-brand-300 transition flex-1 min-w-0" title="<?= $name ?>"><?= $name ?></h4>
                        <div class="text-right shrink-0">
                            <span class="font-serif font-black text-xs sm:text-sm text-brand-300"><?= $priceFormatted ?></span>
                            <?php if ($hasDiscount): ?>
                                <span class="text-[9px] text-slate-400 line-through block -mt-0.5"><?= $retailFormatted ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-[9px] text-slate-400 font-serif mt-1">স্টক: <?= $stock ?> টি</div>
                </div>

                <div class="pt-2 mt-1 border-t border-slate-800">
                    <button type="button" class="w-full px-2.5 py-1.5 bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-400 text-slate-950 font-serif font-black text-xs rounded-lg shadow-sm transition whitespace-nowrap flex items-center justify-center">
                        অর্ডার করুন
                    </button>
                </div>
            </div>
            <?php
            break;
    }

    return (string)ob_get_clean();
}

/**
 * Render Animated Skeleton Cards for Loading State
 */
function renderProductSkeletonCard(int $count = 4): string
{
    $html = '';
    for ($i = 0; $i < $count; $i++) {
        $html .= '
        <div class="product-skeleton-card bg-white border border-slate-200/90 rounded-2xl p-3 sm:p-3.5 flex flex-col justify-between space-y-3 animate-pulse shadow-2xs">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <div class="h-3.5 w-16 bg-slate-200 rounded-md"></div>
                    <div class="h-3.5 w-12 bg-slate-100 rounded-md"></div>
                </div>
                <div class="aspect-square bg-slate-200/80 rounded-xl mb-2.5 w-full flex items-center justify-center">
                    <div class="w-8 h-8 rounded-full bg-slate-300/60"></div>
                </div>
                <div class="space-y-1.5">
                    <div class="h-4 bg-slate-200 rounded-md w-4/5"></div>
                    <div class="h-3 bg-slate-100 rounded-md w-3/5"></div>
                </div>
                <div class="h-2.5 w-14 bg-slate-100 rounded mt-2"></div>
            </div>
            <div class="pt-2 border-t border-slate-100 flex flex-col gap-1.5">
                <div class="flex items-baseline space-x-2">
                    <div class="h-4 w-16 bg-slate-200 rounded"></div>
                    <div class="h-3 w-10 bg-slate-100 rounded"></div>
                </div>
                <div class="h-8 w-full bg-slate-200 rounded-xl"></div>
            </div>
        </div>';
    }
    return $html;
}

/**
 * Render Category Page Product Card
 */
function renderCategoryProductCard(array $prod, string $currency = 'BDT'): string
{
    $img = !empty($prod['images'][0]) ? $prod['images'][0] : null;
    $stock = (int)($prod['stock'] ?? 0);
    $retailerPrice = (float)($prod['retailer_price'] ?? 0);
    $hasDiscount = !empty($prod['has_discount']);
    $discountPercent = (int)($prod['discount_percent'] ?? 0);
    $effectivePrice = (float)($prod['effective_price'] ?? $retailerPrice);
    $sizes = array_values(array_filter(array_map(function($item) {
        if (is_array($item)) return $item['name'] ?? $item['label'] ?? $item['size'] ?? '';
        return is_scalar($item) ? trim((string)$item) : '';
    }, is_array($prod['sizes'] ?? null) ? $prod['sizes'] : [])));
    $colors = array_values(array_filter(array_map(function($item) {
        if (is_array($item)) return $item['name'] ?? $item['label'] ?? $item['color'] ?? '';
        return is_scalar($item) ? trim((string)$item) : '';
    }, is_array($prod['colors'] ?? null) ? $prod['colors'] : [])));
    $prodSlug = !empty($prod['slug']) ? $prod['slug'] : ($prod['uuid'] ?? '');
    $prodUrl = 'product?slug=' . urlencode((string)$prodSlug);

    ob_start();
    ?>
    <div data-price="<?= $effectivePrice ?>" data-discount="<?= $hasDiscount ? $discountPercent : 0 ?>"
         onclick="window.location.href='<?= $prodUrl ?>'" 
         class="product-card bg-white border border-slate-200/90 hover:border-brand-500 rounded-2xl overflow-hidden shadow-2xs hover:shadow-md transition-all duration-200 flex flex-col justify-between p-3 sm:p-4 group cursor-pointer">
        <div>
            <!-- Product Image Container -->
            <div class="aspect-square bg-slate-100 rounded-xl mb-2.5 overflow-hidden flex items-center justify-center text-slate-400 relative border border-slate-100">
                <?php if ($img): ?>
                    <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars((string)($prod['name'] ?? 'পণ্য')) ?>" 
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
                    <span><?= htmlspecialchars((string)($prod['category_name'] ?? 'General')) ?></span>
                </span>
            </div>

            <!-- Title & Price in Same Row (Flex Design) -->
            <div class="flex items-center justify-between gap-2 mt-1 mb-1.5">
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 line-clamp-1 group-hover:text-brand-600 transition flex-1 min-w-0" title="<?= htmlspecialchars((string)($prod['name'] ?? 'পণ্য')) ?>">
                    <?= htmlspecialchars((string)($prod['name'] ?? 'পণ্য')) ?>
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
    <?php
    return (string)ob_get_clean();
}
