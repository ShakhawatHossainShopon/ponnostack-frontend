<?php

/**
 * Client Storefront - Dedicated Standalone Checkout Page
 * 
 * Provides a production-level checkout flow with full Bangladesh address fields,
 * live dynamic delivery charges from admin settings, Cash on Delivery with Bengali note,
 * real-time order summary, and auto-saving to localStorage for zero-login tracking.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

// Fetch dynamic delivery charges from Mother API
$deliveryChargesRes = ApiClient::request('GET', '/delivery-charges?active_only=1');
$deliveryCharges = ($deliveryChargesRes['success'] && !empty($deliveryChargesRes['data'])) 
    ? $deliveryChargesRes['data'] 
    : [
        [
            'code' => 'inside_dhaka',
            'title' => 'ঢাকার ভেতরে (Inside Dhaka)',
            'amount' => 80.00,
            'description' => 'হোম ডেলিভারি (২৪-৪৮ ঘণ্টা)',
            'is_default' => 1
        ],
        [
            'code' => 'outside_dhaka',
            'title' => 'ঢাকার বাইরে (Outside Dhaka)',
            'amount' => 150.00,
            'description' => 'কুরিয়ার হোম ডেলিভারি (২-৩ দিন)',
            'is_default' => 0
        ]
    ];

$defaultDeliveryCharge = 80.00;
$defaultDeliveryTitle = 'ঢাকার ভেতরে';
foreach ($deliveryCharges as $dc) {
    if (!empty($dc['is_default'])) {
        $defaultDeliveryCharge = (float)$dc['amount'];
        $defaultDeliveryTitle = (string)($dc['title'] ?? 'ঢাকার ভেতরে');
        break;
    }
}
if (empty($defaultDeliveryCharge) && !empty($deliveryCharges[0]['amount'])) {
    $defaultDeliveryCharge = (float)$deliveryCharges[0]['amount'];
    $defaultDeliveryTitle = (string)($deliveryCharges[0]['title'] ?? 'ঢাকার ভেতরে');
}

$pageTitle = 'চেকআউট | ' . htmlspecialchars($storeName);

// Dedicated Checkout SEO
$seoTitle = 'নিরাপদ চেকআউট ও অর্ডার কনফার্মেশন | ' . $storeName;
$seoDescription = 'আপনার কার্টের পণ্যগুলোর নিরাপদ চেকআউট ও ক্যাশ অন ডেলিভারি অর্ডার সম্পন্ন করুন ' . $storeName . '-এ।';
$seoRobots = 'noindex, follow';

require_once __DIR__ . '/views/header.php';
?>

<main class="max-w-6xl mx-auto px-4 py-6 sm:py-10 space-y-8 flex-1">

    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 text-xs font-medium text-slate-500">
        <a href="./" class="hover:text-brand-600 transition flex items-center space-x-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i>
            <span>হোম</span>
        </a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
        <span class="text-slate-800 font-bold">চেকআউট ও অর্ডার কনফার্মেশন</span>
    </nav>

    <!-- 1. EMPTY CART STATE (HIDDEN WHEN ITEMS EXIST) -->
    <div id="checkoutEmptyState" style="display: none;" class="bg-white border border-slate-200 rounded-3xl p-12 sm:p-16 text-center max-w-lg mx-auto shadow-xs my-6">
        <div class="w-16 h-16 rounded-2xl bg-brand-100 text-brand-600 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="shopping-bag" class="w-8 h-8"></i>
        </div>
        <h2 class="text-xl font-extrabold text-slate-900 mb-2">আপনার কার্ট বর্তমানে খালি</h2>
        <p class="text-xs text-slate-500 mb-6">
            চেকআউট করার জন্য আপনার কার্টে কোনো পণ্য পাওয়া যায়নি। অনুগ্রহ করে শপ থেকে আপনার পছন্দের পণ্য যোগ করুন।
        </p>
        <a href="./#catalog" class="inline-flex items-center space-x-2 px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-2xl transition shadow-xs">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>শপে ফিরে যান</span>
        </a>
    </div>

    <!-- 2. CHECKOUT MAIN GRID (LEFT: SHIPPING FORM | RIGHT: ORDER SUMMARY) -->
    <div id="checkoutMainContainer" class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-start">
        
        <!-- LEFT COLUMN: SHIPPING & BILLING FORM -->
        <div class="md:col-span-7 space-y-6">
            
            <form id="checkoutOrderForm" onsubmit="submitCheckoutOrder(event)" class="space-y-6">
                
                <!-- Section 1: Customer Contact Info -->
                <div class="bg-white border border-slate-200 rounded-3xl p-5 sm:p-7 shadow-xs space-y-4">
                    <div class="flex items-center space-x-3 border-b border-slate-100 pb-3">
                        <span class="w-8 h-8 rounded-xl bg-brand-100 text-brand-700 font-black text-xs flex items-center justify-center">১</span>
                        <div>
                            <h2 class="text-sm font-extrabold text-slate-900">কাস্টমার তথ্য ও ডেলিভারি ঠিকানা</h2>
                            <p class="text-[11px] text-slate-400">ডেলিভারির জন্য আপনার সঠিক তথ্য প্রদান করুন</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">আপনার নাম *</label>
                            <input type="text" id="chkName" required placeholder="পুরো নাম লিখুন (e.g. মোঃ করিম)"
                                class="w-full px-3.5 py-2.5 bg-slate-50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-500 transition shadow-2xs">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">মোবাইল নম্বর *</label>
                            <input type="tel" id="chkPhone" required placeholder="১১ ডিজিটের নম্বর (e.g. 017XXXXXXXX)" maxlength="14"
                                class="w-full px-3.5 py-2.5 bg-slate-50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 font-mono focus:outline-none focus:border-brand-500 transition shadow-2xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <!-- Division Dropdown -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">বিভাগ (Division) *</label>
                            <select id="chkDivision" required onchange="handleDivisionChange()"
                                class="w-full px-3 py-2.5 bg-slate-50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:border-brand-500 transition shadow-2xs">
                                <option value="">বিভাগ সিলেক্ট করুন</option>
                                <option value="ঢাকা" selected>ঢাকা (Dhaka)</option>
                                <option value="চট্টগ্রাম">চট্টগ্রাম (Chattogram)</option>
                                <option value="রাজশাহী">রাজশাহী (Rajshahi)</option>
                                <option value="খুলনা">খুলনা (Khulna)</option>
                                <option value="বরিশাল">বরিশাল (Barishal)</option>
                                <option value="সিলেট">সিলেট (Sylhet)</option>
                                <option value="রংপুর">রংপুর (Rangpur)</option>
                                <option value="ময়মনসিংহ">ময়মনসিংহ (Mymensingh)</option>
                            </select>
                        </div>

                        <!-- District -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">জেলা (District) *</label>
                            <input type="text" id="chkDistrict" required placeholder="জেলা (e.g. ঢাকা)"
                                class="w-full px-3.5 py-2.5 bg-slate-50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-500 transition shadow-2xs">
                        </div>

                        <!-- Upazilla / Thana -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">উপজেলা / থানা *</label>
                            <input type="text" id="chkUpazilla" required placeholder="থানা/উপজেলা (e.g. মিরপুর)"
                                class="w-full px-3.5 py-2.5 bg-slate-50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-500 transition shadow-2xs">
                        </div>
                    </div>

                    <!-- Full Street Address -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">বিস্তারিত ডেলিভারি ঠিকানা *</label>
                        <textarea id="chkAddress" required rows="2" placeholder="বাসা নম্বর, রোড নম্বর, এলাকা ইত্যাদি বিস্তারিত লিখুন..."
                            class="w-full px-3.5 py-2.5 bg-slate-50 focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-500 transition shadow-2xs"></textarea>
                    </div>
                </div>

                <!-- Section 2: Delivery Area (Zone) Selection -->
                <div class="bg-white border border-slate-200 rounded-3xl p-5 sm:p-7 shadow-xs space-y-4">
                    <div class="flex items-center space-x-3 border-b border-slate-100 pb-3">
                        <span class="w-8 h-8 rounded-xl bg-brand-100 text-brand-700 font-black text-xs flex items-center justify-center">২</span>
                        <div>
                            <h2 class="text-sm font-extrabold text-slate-900">ডেলিভারি এলাকা নির্বাচন</h2>
                            <p class="text-[11px] text-slate-400">আপনার অবস্থানের ওপর ভিত্তি করে ডেলিভারি চার্জ নির্ধারিত হবে</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5" id="deliveryZoneContainer">
                        <?php 
                        $hasDefault = false;
                        foreach ($deliveryCharges as $idx => $dc): 
                            $isFirst = ($idx === 0);
                            $isDefault = !empty($dc['is_default']) || (!$hasDefault && $isFirst);
                            if ($isDefault) $hasDefault = true;
                        ?>
                            <label class="delivery-zone-card flex items-center justify-between p-4 <?= $isDefault ? 'border-2 border-brand-500 bg-brand-50/60' : 'border border-slate-200 bg-white hover:border-brand-300' ?> rounded-2xl cursor-pointer transition shadow-2xs">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="chkDeliveryZone" value="<?= htmlspecialchars($dc['code']) ?>" 
                                           data-amount="<?= (float)$dc['amount'] ?>" 
                                           data-title="<?= htmlspecialchars($dc['title']) ?>"
                                           <?= $isDefault ? 'checked' : '' ?> 
                                           onchange="selectDeliveryZone(this)" class="text-brand-600 focus:ring-brand-500">
                                    <div>
                                        <div class="text-xs font-black text-slate-900 flex items-center space-x-1.5">
                                             <span><?= htmlspecialchars($dc['title']) ?></span>
                                        </div>
                                        <?php if (!empty($dc['description'])): ?>
                                            <div class="text-[10px] text-slate-500 mt-0.5"><?= htmlspecialchars($dc['description']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <span class="text-xs font-black <?= $isDefault ? 'text-brand-600' : 'text-slate-800' ?> font-mono">৳<?= number_format((float)$dc['amount'], 2) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Section 3: Payment Method (Cash on Delivery) -->
                <div class="bg-white border border-slate-200 rounded-3xl p-5 sm:p-7 shadow-xs space-y-4">
                    <div class="flex items-center space-x-3 border-b border-slate-100 pb-3">
                        <span class="w-8 h-8 rounded-xl bg-brand-100 text-brand-700 font-black text-xs flex items-center justify-center">৩</span>
                        <div>
                            <h2 class="text-sm font-extrabold text-slate-900">মূল্য পরিশোধের পদ্ধতি (Payment Method)</h2>
                            <p class="text-[11px] text-slate-400">নিরাপদে ও সহজে ডেলিভারি পাওয়ার পর টাকা দিন</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl space-y-2">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="radio" name="chkPaymentMethod" value="cash_on_delivery" checked class="text-brand-600 focus:ring-brand-500">
                            <div>
                                <span class="text-xs font-bold text-slate-900 flex items-center space-x-1.5">
                                    <i data-lucide="banknote" class="w-4 h-4 text-emerald-600"></i>
                                    <span>ক্যাশ অন ডেলিভারি (Cash on Delivery)</span>
                                </span>
                                <span class="text-[11px] text-slate-500 block mt-0.5">পার্সেল হাতে পেয়ে ডেলিভারিম্যানকে টাকা পরিশোধ করুন।</span>
                            </div>
                        </label>

                        <!-- Bengali Note as requested by user -->
                        <div class="pt-2 border-t border-slate-200/80 flex items-center space-x-2 text-[11px] text-amber-700 bg-amber-50/70 p-2.5 rounded-xl border border-amber-200/60">
                            <i data-lucide="info" class="w-3.5 h-3.5 shrink-0 text-amber-600"></i>
                            <span>* অনলাইন পেমেন্ট মেথড (বিকাশ, নগদ, কার্ড) শীঘ্রই যুক্ত হবে।</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button for Mobile View -->
                <div class="md:hidden">
                    <button type="submit" id="btnSubmitOrderMobile" 
                        class="w-full py-4 px-6 bg-brand-600 hover:bg-brand-700 text-white text-sm font-black rounded-2xl transition shadow-md flex items-center justify-center space-x-2 cursor-pointer">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        <span>অর্ডার নিশ্চিত করুন &bull; ৳<span class="btnTotalDisplay">০.০০</span></span>
                    </button>
                </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: ORDER SUMMARY SIDEBAR -->
        <div class="md:col-span-5 space-y-4 md:sticky md:top-24">
            <div class="bg-white border border-slate-200 rounded-3xl p-5 sm:p-7 shadow-xs space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-extrabold text-slate-900">অর্ডার সারসংক্ষেপ (Order Summary)</h3>
                    <span id="chkItemsCountBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">০ টি পণ্য</span>
                </div>

                <!-- Items Breakdown List -->
                <div id="chkItemsList" class="space-y-3 max-h-72 overflow-y-auto divide-y divide-slate-100 pr-1">
                    <!-- Populated dynamically via JS -->
                </div>

                <!-- Price Breakdown Calculations -->
                <div class="space-y-2 pt-3 border-t border-slate-100 text-xs">
                    <div class="flex items-center justify-between text-slate-600">
                        <span>পণ্যের মোট মূল্য (Subtotal):</span>
                        <span class="font-bold text-slate-900 font-mono" id="chkSubtotalDisplay">৳০.০০</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span class="flex items-center space-x-1">
                            <span>ডেলিভারি চার্জ:</span>
                            <span id="chkZoneLabel" class="text-[10px] text-brand-600 font-semibold">(<?= htmlspecialchars($defaultDeliveryTitle) ?>)</span>
                        </span>
                        <span class="font-bold text-slate-900 font-mono" id="chkDeliveryDisplay">৳<?= number_format($defaultDeliveryCharge, 2) ?></span>
                    </div>
                    <div class="pt-2 border-t border-slate-200 flex items-center justify-between">
                        <span class="text-sm font-extrabold text-slate-900">সর্বমোট প্রদেয় বিল:</span>
                        <span class="text-xl font-black text-brand-600 font-mono" id="chkGrandTotalDisplay">৳০.০০</span>
                    </div>
                </div>

                <!-- Big Primary Submit CTA -->
                <button type="button" onclick="$('#checkoutOrderForm').submit()" id="btnSubmitOrderDesktop"
                    class="w-full py-4 px-6 bg-brand-600 hover:bg-brand-700 text-white text-sm font-black rounded-2xl transition shadow-md flex items-center justify-center space-x-2 cursor-pointer">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    <span>অর্ডার নিশ্চিত করুন</span>
                </button>

                <!-- Security & Trust Badges -->
                <div class="pt-3 border-t border-slate-100 space-y-2 text-[11px] text-slate-400">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600"></i>
                        <span>নিরাপদ ও নির্ভরযোগ্য অর্ডার প্রসেসিং</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i data-lucide="truck" class="w-3.5 h-3.5 text-brand-500"></i>
                        <span>সরাসরি বিশ্বস্ত ডেলিভারি প্রতিনিধির মাধ্যমে পণ্য প্রেরণ</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. ORDER SUCCESS VIEW (CONFIRMATION & INVOICE RECEIPT) -->
    <div id="checkoutSuccessView" style="display: none;" class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-12 max-w-2xl mx-auto shadow-sm my-6 text-center space-y-6">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto shadow-xs">
            <i data-lucide="check-circle-2" class="w-10 h-10"></i>
        </div>

        <div>
            <div class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 mb-2">অর্ডার সফলভাবে গৃহীত হয়েছে!</div>
            <h2 class="text-2xl font-black text-slate-900">ধন্যবাদ, আপনার অর্ডার নিশ্চিত করা হয়েছে!</h2>
            <p class="text-xs text-slate-500 mt-1">আমাদের টিম শীঘ্রই আপনার নম্বরে কল করে অর্ডারটি ভেরিফাই করবে।</p>
        </div>

        <!-- Receipt Box -->
        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-left space-y-3 text-xs">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <span class="text-slate-500">ইনভয়েস / অর্ডার নং:</span>
                <span class="font-mono font-black text-slate-900 text-sm" id="succOrderNumber">ORD-XXXXXX</span>
            </div>
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <span class="text-slate-500">গ্রাহকের নাম:</span>
                <span class="font-bold text-slate-900" id="succCustomerName">-</span>
            </div>
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <span class="text-slate-500">মোবাইল নম্বর:</span>
                <span class="font-mono font-bold text-slate-900" id="succCustomerPhone">-</span>
            </div>
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <span class="text-slate-500">ডেলিভারি ঠিকানা:</span>
                <span class="font-medium text-slate-800 text-right max-w-xs" id="succDeliveryAddress">-</span>
            </div>
            <div class="flex items-center justify-between pt-1">
                <span class="font-bold text-slate-700">সর্বমোট প্রদেয় (ক্যাশ অন ডেলিভারি):</span>
                <span class="font-mono font-black text-brand-600 text-base" id="succTotalAmount">৳০.০০</span>
            </div>
        </div>

        <!-- Action CTAs -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <button type="button" onclick="trackNewOrderFromReceipt()" 
                class="w-full sm:w-auto px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center justify-center space-x-2 cursor-pointer">
                <i data-lucide="map-pin" class="w-4 h-4 text-brand-400"></i>
                <span>লাইভ অর্ডার ট্র্যাক করুন</span>
            </button>
            <a href="./#catalog" class="w-full sm:w-auto px-6 py-3 bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl transition shadow-2xs">
                আরও কেনাকাটা করুন
            </a>
        </div>
    </div>

</main>

<!-- SCRIPTS FOR STANDALONE CHECKOUT PAGE -->
<script>
    let checkoutItems = [];
    window.DELIVERY_CHARGES = <?= json_encode($deliveryCharges, JSON_UNESCAPED_UNICODE) ?>;
    
    // Find initial selected charge
    const initialCheckedRadio = $('input[name="chkDeliveryZone"]:checked');
    let currentDeliveryCharge = initialCheckedRadio.length 
        ? parseFloat(initialCheckedRadio.data('amount')) 
        : (parseFloat(window.DELIVERY_CHARGES[0]?.amount) || 60.00);
    let currentZoneTitle = initialCheckedRadio.length 
        ? initialCheckedRadio.data('title') 
        : (window.DELIVERY_CHARGES[0]?.title || 'ঢাকার ভেতরে');
    let isSubmitting = false;

    // 1. Determine Checkout Mode (Direct Buy Now or Cart Items)
    function initCheckoutItems() {
        const urlParams = new URLSearchParams(window.location.search);
        const isBuyNow = urlParams.get('buy_now') === '1';

        if (isBuyNow) {
            try {
                const directItem = localStorage.getItem('client_direct_buy_item');
                if (directItem) {
                    checkoutItems = [JSON.parse(directItem)];
                }
            } catch(e) { checkoutItems = []; }
        }

        // Fallback to regular cart if no direct item
        if (checkoutItems.length === 0) {
            try {
                const storedCart = localStorage.getItem('client_cart');
                if (storedCart) {
                    checkoutItems = JSON.parse(storedCart);
                }
            } catch(e) { checkoutItems = []; }
        }

        if (!Array.isArray(checkoutItems) || checkoutItems.length === 0) {
            $('#checkoutMainContainer').hide();
            $('#checkoutEmptyState').show();
            return;
        }

        renderCheckoutSummary();
    }

    // 2. Render Order Summary
    function renderCheckoutSummary() {
        const $list = $('#chkItemsList');
        $list.empty();

        let subtotal = 0;
        let totalCount = 0;

        checkoutItems.forEach(it => {
            const lineTotal = it.unit_price * it.quantity;
            subtotal += lineTotal;
            totalCount += it.quantity;

            const variantText = [
                it.size ? `সাইজ: ${it.size}` : null,
                it.color ? `রঙ: ${it.color}` : null
            ].filter(Boolean).join(' | ');

            const imgHtml = it.image 
                ? `<img src="${it.image}" class="w-full h-full object-contain p-1">`
                : `<div class="w-full h-full flex items-center justify-center text-slate-400"><i data-lucide="package" class="w-4 h-4"></i></div>`;

            $list.append(`
                <div class="flex items-center justify-between py-2 text-xs">
                    <div class="flex items-center space-x-3 min-w-0">
                        <div class="w-11 h-11 rounded-lg bg-slate-50 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                            ${imgHtml}
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-slate-800 truncate">${it.name}</h4>
                            ${variantText ? `<div class="text-[10px] text-brand-600 font-semibold">${variantText}</div>` : ''}
                            <div class="text-[10px] text-slate-400 font-mono">৳${it.unit_price.toFixed(2)} × ${it.quantity}</div>
                        </div>
                    </div>
                    <span class="font-black text-slate-900 font-mono shrink-0 pl-2">৳${lineTotal.toFixed(2)}</span>
                </div>
            `);
        });

        $('#chkItemsCountBadge').text(totalCount + ' টি পণ্য');
        $('#chkSubtotalDisplay').text('৳' + subtotal.toFixed(2));
        $('#chkDeliveryDisplay').text('৳' + currentDeliveryCharge.toFixed(2));
        $('#chkZoneLabel').text(`(${currentZoneTitle})`);
        
        const grandTotal = subtotal + currentDeliveryCharge;
        $('#chkGrandTotalDisplay').text('৳' + grandTotal.toFixed(2));
        $('.btnTotalDisplay').text(grandTotal.toFixed(2));

        lucide.createIcons();
    }

    // 3. Dynamic Delivery Zone Fee Switcher
    function selectDeliveryZone(radioEl) {
        const amount = parseFloat($(radioEl).data('amount')) || 0;
        const title = $(radioEl).data('title') || '';
        currentDeliveryCharge = amount;
        currentZoneTitle = title;

        $('.delivery-zone-card').each(function() {
            const isChecked = $(this).find('input[type="radio"]').is(':checked');
            if (isChecked) {
                $(this).addClass('border-2 border-brand-500 bg-brand-50/60').removeClass('border-slate-200 bg-white hover:border-brand-300');
                $(this).find('span.font-mono').addClass('text-brand-600').removeClass('text-slate-800');
            } else {
                $(this).removeClass('border-2 border-brand-500 bg-brand-50/60').addClass('border border-slate-200 bg-white hover:border-brand-300');
                $(this).find('span.font-mono').removeClass('text-brand-600').addClass('text-slate-800');
            }
        });

        $('#chkZoneLabel').text(`(${title})`);
        renderCheckoutSummary();
    }

    function handleDivisionChange() {
        const div = $('#chkDivision').val();
        if (!div) return;

        if (div === 'ঢাকা') {
            const insideRadio = $('input[name="chkDeliveryZone"]').filter(function() {
                const val = ($(this).val() || '').toLowerCase();
                const title = ($(this).data('title') || '').toLowerCase();
                return val.includes('inside') || val.includes('dhaka') || title.includes('ঢাকা');
            }).first();
            if (insideRadio.length) {
                insideRadio.prop('checked', true);
                selectDeliveryZone(insideRadio[0]);
            }
        } else {
            const outsideRadio = $('input[name="chkDeliveryZone"]').filter(function() {
                const val = ($(this).val() || '').toLowerCase();
                const title = ($(this).data('title') || '').toLowerCase();
                return val.includes('outside') || title.includes('বাইরে');
            }).first();
            if (outsideRadio.length) {
                outsideRadio.prop('checked', true);
                selectDeliveryZone(outsideRadio[0]);
            }
        }
    }

    // 4. Submit Order
    async function submitCheckoutOrder(e) {
        e.preventDefault();
        if (isSubmitting) return;

        const name = $('#chkName').val().trim();
        const phone = $('#chkPhone').val().trim();
        const division = $('#chkDivision').val();
        const district = $('#chkDistrict').val().trim();
        const upazilla = $('#chkUpazilla').val().trim();
        const address = $('#chkAddress').val().trim();
        const zone = $('input[name="chkDeliveryZone"]:checked').val() || 'inside_dhaka';

        if (!name || !phone || !division || !district || !upazilla || !address) {
            showToast('অনুগ্রহ করে সকল ডেলিভারি তথ্য সঠিকভাবে পূরণ করুন।', 'warning');
            return;
        }

        const cleanPhone = phone.replace(/[^0-9]/g, '');
        if (cleanPhone.length < 11) {
            showToast('অনুগ্রহ করে সঠিক ১১ ডিজিটের মোবাইল নম্বর প্রদান করুন (যেমন: 017XXXXXXXX)।', 'warning');
            return;
        }

        if (checkoutItems.length === 0) {
            showToast('অর্ডারের জন্য কোনো পণ্য পাওয়া যায়নি।', 'error');
            return;
        }

        showTopLoader();

        const payload = {
            customer_name: name,
            customer_phone: phone,
            division: division,
            district: district,
            upazilla: upazilla,
            delivery_address: address,
            delivery_zone: zone,
            delivery_charge: currentDeliveryCharge,
            items: checkoutItems.map(it => ({
                product_uuid: it.product_uuid,
                product_name: it.name,
                size: it.size || null,
                color: it.color || null,
                unit_price: it.unit_price,
                quantity: it.quantity
            }))
        };

        isSubmitting = true;
        const submitBtns = $('#btnSubmitOrderDesktop, #btnSubmitOrderMobile');
        submitBtns.prop('disabled', true).addClass('opacity-75 cursor-wait').html('<svg class="animate-spin w-4 h-4 text-white inline-block mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg><span>অর্ডার প্রসেস হচ্ছে...</span>');

        try {
            const res = await StoreApi.post('orders', payload);

            if (res && res.success && res.data) {
                const order = res.data;

                // Save to localStorage for zero-login tracking
                saveOrderToLocalStorage({
                    order_number: order.order_number,
                    created_at: order.created_at,
                    total: order.total_amount,
                    total_amount: order.total_amount,
                    status: order.status || 'pending'
                });

                // Clear cart and buy now cache
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('buy_now') === '1') {
                    localStorage.removeItem('client_direct_buy_item');
                } else {
                    localStorage.removeItem('client_cart');
                }

                // Render Success View
                $('#succOrderNumber').text(order.order_number);
                $('#succCustomerName').text(order.customer_name);
                $('#succCustomerPhone').text(order.customer_phone);
                $('#succDeliveryAddress').text(`${order.delivery_address}, ${order.upazilla}, ${order.district}`);
                $('#succTotalAmount').text('৳' + parseFloat(order.total_amount).toFixed(2));

                $('#checkoutMainContainer').hide();
                $('#checkoutSuccessView').fadeIn(200);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                showToast((res && res.message) ? res.message : 'অনুগ্রহ করে পুনরায় চেষ্টা করুন।', 'error');
            }
        } catch(err) {
            showToast(err.message || 'নেটওয়ার্ক বা সার্ভারে সমস্যা দেখা দিয়েছে।', 'error');
        } finally {
            hideTopLoader();
            isSubmitting = false;
            submitBtns.prop('disabled', false).removeClass('opacity-50 cursor-not-allowed').html('<i data-lucide="check-circle" class="w-4 h-4"></i><span>অর্ডার নিশ্চিত করুন</span>');
            lucide.createIcons();
        }
    }

    function saveOrderToLocalStorage(orderSummary) {
        try {
            let saved = [];
            const existing = localStorage.getItem('client_saved_orders');
            if (existing) saved = JSON.parse(existing);
            saved = saved.filter(o => o.order_number !== orderSummary.order_number);
            saved.unshift(orderSummary);
            // keep up to 10 recent orders
            saved = saved.slice(0, 10);
            localStorage.setItem('client_saved_orders', JSON.stringify(saved));
        } catch(e) {}
    }

    let newlyPlacedOrderNumber = '';
    function trackNewOrderFromReceipt() {
        const orderNum = $('#succOrderNumber').text();
        if (typeof openOrderTrackingModal === 'function') {
            openOrderTrackingModal(orderNum);
        } else {
            window.location.href = './';
        }
    }

    function openCartDrawer() {
        initCheckoutItems();
    }

    $(document).ready(function() {
        initCheckoutItems();
        lucide.createIcons();
    });
</script>

<?php require_once __DIR__ . '/views/footer.php'; ?>
