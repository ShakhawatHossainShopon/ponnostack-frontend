<?php
/**
 * Client Storefront Admin - Mobile Bottom Navigation & Slide-Over Drawer
 * 
 * Exclusively active on mobile viewports (md:hidden).
 * Desktop layout (>= 768px) remains 100% untouched.
 * 
 * - 5 bottom navigation tabs: Orders, Inventory, Dashboard (middle), Accounts, More (three dots)
 * - All 5 tabs are 100% uniform in style, baseline, and height
 * - Zero count/number badges on the bottom bar
 * - 100% preserved count badges inside the three-dots slide-over drawer
 * - Skeleton loaders for both bottom bar and drawer during load
 */
?>

<!-- 0. MOBILE BOTTOM NAVIGATION SKELETON LOADER (md:hidden, visible on initial page load) -->
<div id="mobileBottomNavSkeleton" class="md:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur-md border-t border-slate-200/80 shadow-[0_-2px_12px_rgba(0,0,0,0.04)] pb-[calc(env(safe-area-inset-bottom)+0.35rem)] pt-2 select-none pointer-events-none">
    <div class="grid grid-cols-5 items-center max-w-lg mx-auto px-1 h-12">
        <!-- 1. Orders Skeleton -->
        <div class="flex flex-col items-center justify-center space-y-1">
            <div class="w-5 h-5 rounded-md skeleton-shimmer"></div>
            <div class="w-8 h-2 rounded skeleton-shimmer"></div>
        </div>
        <!-- 2. Inventory Skeleton -->
        <div class="flex flex-col items-center justify-center space-y-1">
            <div class="w-5 h-5 rounded-md skeleton-shimmer"></div>
            <div class="w-10 h-2 rounded skeleton-shimmer"></div>
        </div>
        <!-- 3. Dashboard Skeleton (Identical dimensions) -->
        <div class="flex flex-col items-center justify-center space-y-1">
            <div class="w-5 h-5 rounded-md skeleton-shimmer"></div>
            <div class="w-10 h-2 rounded skeleton-shimmer"></div>
        </div>
        <!-- 4. Accounts Skeleton -->
        <div class="flex flex-col items-center justify-center space-y-1">
            <div class="w-5 h-5 rounded-md skeleton-shimmer"></div>
            <div class="w-8 h-2 rounded skeleton-shimmer"></div>
        </div>
        <!-- 5. More Menu Skeleton -->
        <div class="flex flex-col items-center justify-center space-y-1">
            <div class="w-5 h-5 rounded-md skeleton-shimmer"></div>
            <div class="w-7 h-2 rounded skeleton-shimmer"></div>
        </div>
    </div>
</div>

<!-- 1. MOBILE BOTTOM APP-STYLE NAVIGATION BAR (md:hidden, 100% Uniform, No Badges, Flat Clean Design) -->
<nav id="mobileBottomNav" style="display: none;" class="md:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur-md border-t border-slate-200/80 shadow-[0_-2px_12px_rgba(0,0,0,0.04)] pb-[calc(env(safe-area-inset-bottom)+0.35rem)] pt-1.5 select-none">
    <div class="grid grid-cols-5 items-center max-w-lg mx-auto px-1 h-12">
        
        <!-- 1. Orders Tab -->
        <button type="button" onclick="switchTab('orders')" id="mobNavOrders"
            class="mob-nav-btn group flex flex-col items-center justify-center py-1 transition active:scale-95 text-slate-400 hover:text-slate-600 cursor-pointer">
            <i data-lucide="shopping-bag" class="w-5 h-5 stroke-[1.8] transition-transform group-hover:scale-105"></i>
            <span class="text-[11px] font-bold mt-1 tracking-tight truncate max-w-[58px]">অর্ডার</span>
        </button>

        <!-- 2. Products / Inventory Tab -->
        <button type="button" onclick="switchTab('products')" id="mobNavProducts"
            class="mob-nav-btn group flex flex-col items-center justify-center py-1 transition active:scale-95 text-slate-400 hover:text-slate-600 cursor-pointer">
            <i data-lucide="package" class="w-5 h-5 stroke-[1.8] transition-transform group-hover:scale-105"></i>
            <span class="text-[11px] font-bold mt-1 tracking-tight truncate max-w-[58px]">ইনভেন্টরি</span>
        </button>

        <!-- 3. Dashboard Tab (In the Middle, Exactly Same Style as Others) -->
        <button type="button" onclick="switchTab('dashboard')" id="mobNavDashboard"
            class="mob-nav-btn group flex flex-col items-center justify-center py-1 transition active:scale-95 text-brand-600 cursor-pointer">
            <i data-lucide="layout-dashboard" class="w-5 h-5 stroke-[1.8] transition-transform group-hover:scale-105"></i>
            <span class="text-[11px] font-bold mt-1 tracking-tight truncate max-w-[58px]">ড্যাশবোর্ড</span>
        </button>

        <!-- 4. Accounts / Completed Orders Tab -->
        <button type="button" onclick="switchTab('completedOrders')" id="mobNavCompletedOrders"
            class="mob-nav-btn group flex flex-col items-center justify-center py-1 transition active:scale-95 text-slate-400 hover:text-slate-600 cursor-pointer">
            <i data-lucide="check-circle-2" class="w-5 h-5 stroke-[1.8] transition-transform group-hover:scale-105"></i>
            <span class="text-[11px] font-bold mt-1 tracking-tight truncate max-w-[58px]">হিসাব</span>
        </button>

        <!-- 5. Three-Dot / More Menu (Opens Drawer) -->
        <button type="button" onclick="toggleMobileDrawer(true)" id="mobNavMore"
            class="mob-nav-btn group flex flex-col items-center justify-center py-1 transition active:scale-95 text-slate-400 hover:text-slate-600 cursor-pointer">
            <i data-lucide="more-horizontal" class="w-5 h-5 stroke-[2] transition-transform group-hover:scale-105"></i>
            <span class="text-[11px] font-bold mt-1 tracking-tight truncate max-w-[58px]">মেনু</span>
        </button>

    </div>
</nav>


<!-- 2. MOBILE RIGHT-SIDE SLIDE-OVER DRAWER (md:hidden, With 100% Preserved Badges) -->
<!-- Backdrop Overlay -->
<div id="mobileDrawerBackdrop" onclick="toggleMobileDrawer(false)"
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-[99998] md:hidden transition-opacity duration-300 opacity-0 pointer-events-none">
</div>

<!-- Drawer Container (Slides from Right) -->
<aside id="mobileDrawerPanel"
    class="fixed inset-y-0 right-0 w-[84%] max-w-[320px] bg-white z-[99999] shadow-2xl flex flex-col md:hidden transform transition-transform duration-300 ease-out translate-x-full">
    
    <!-- Drawer Header -->
    <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/80 shrink-0">
        <div class="flex items-center space-x-2.5 min-w-0">
            <?php if (!empty($logoPath)): ?>
                <img src="<?= htmlspecialchars($logoPath) ?>" alt="<?= htmlspecialchars($store['name']) ?>" class="w-8 h-8 rounded-xl object-cover border border-slate-200 shrink-0">
            <?php else: ?>
                <div class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center shrink-0">
                    <?= strtoupper(mb_substr($store['name'], 0, 1, 'UTF-8')) ?>
                </div>
            <?php endif; ?>
            <div class="min-w-0">
                <h3 class="text-xs font-bold text-slate-900 truncate leading-tight"><?= htmlspecialchars($store['name']) ?></h3>
                <span class="text-[10px] text-slate-400 font-medium block">অন্যান্য মেনু ও সেটিংস</span>
            </div>
        </div>
        <button type="button" onclick="toggleMobileDrawer(false)"
            class="w-8 h-8 rounded-full bg-white hover:bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center border border-slate-200 transition cursor-pointer shadow-2xs">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

    <!-- Drawer Skeleton Loader (Visible during initial loading) -->
    <div id="mobileDrawerSkeleton" class="flex-1 overflow-y-auto p-3 space-y-4 text-xs">
        <div class="space-y-2">
            <div class="w-24 h-2.5 rounded skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
        </div>
        <div class="space-y-2 pt-2 border-t border-slate-100">
            <div class="w-20 h-2.5 rounded skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
        </div>
        <div class="space-y-2 pt-2 border-t border-slate-100">
            <div class="w-28 h-2.5 rounded skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
            <div class="w-full h-9 rounded-xl skeleton-shimmer"></div>
        </div>
    </div>

    <!-- Drawer Nav Body (Scrollable, Excludes 4 bottom nav items - 100% Badges Displayed) -->
    <div id="mobileDrawerNavContent" class="hidden flex-1 overflow-y-auto p-3 space-y-4 text-xs">
        
        <!-- Group 1: পণ্য ও স্টক ব্যবস্থাপনা -->
        <div class="space-y-1">
            <div class="px-3 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">পণ্য ও স্টক পরিচালনা</div>
            
            <!-- Stock Management (সকল পণ্যের স্টক সমন্বয়) -->
            <button type="button" onclick="switchTab('stockManagement'); toggleMobileDrawer(false);" id="mobDrawerTabStockManagement"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i data-lucide="boxes" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>স্টক ম্যানেজমেন্ট</span>
                </div>
                <span id="mobDrawerBadgeStockManagement" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">0</span>
            </button>

            <!-- Categories -->
            <button type="button" onclick="switchTab('categories'); toggleMobileDrawer(false);" id="mobDrawerTabCategories"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i data-lucide="folder-tree" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>ক্যাটাগরি (Category)</span>
                </div>
                <span id="mobDrawerBadgeCategory" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">0</span>
            </button>

            <!-- Stock Out Products -->
            <button type="button" onclick="switchTab('stockOut'); toggleMobileDrawer(false);" id="mobDrawerTabStockOut"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>স্টক আউট (Stock Out)</span>
                </div>
                <span id="mobDrawerBadgeStockOut" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">0</span>
            </button>

            <!-- Discounts & Deals -->
            <button type="button" onclick="switchTab('discounts'); toggleMobileDrawer(false);" id="mobDrawerTabDiscounts"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">
                        <i data-lucide="percent" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>ডিসকাউন্ট ও অফার তালিকা</span>
                </div>
                <span id="mobDrawerBadgeDiscount" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-orange-100 text-orange-700">0</span>
            </button>
        </div>

        <!-- Group 2: অর্ডার ও ডেলিভারি -->
        <div class="space-y-1 pt-2 border-t border-slate-100">
            <div class="px-3 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">অর্ডার ও ডেলিভারি</div>
            
            <!-- Cancelled Orders (Trash) -->
            <button type="button" onclick="switchTab('cancelledOrders'); toggleMobileDrawer(false);" id="mobDrawerTabCancelledOrders"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>বাতিল অর্ডার (Trash)</span>
                </div>
                <span id="mobDrawerBadgeCancelledOrder" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">0</span>
            </button>

            <!-- Delivery Charges -->
            <button type="button" onclick="switchTab('deliveryCharges'); toggleMobileDrawer(false);" id="mobDrawerTabDeliveryCharges"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="truck" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>ডেলিভারি চার্জ (Delivery)</span>
                </div>
                <span id="mobDrawerBadgeDelivery" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800">0</span>
            </button>
        </div>

        <!-- Group 3: স্টোর ডিজাইন ও সেটিংস -->
        <div class="space-y-1 pt-2 border-t border-slate-100">
            <div class="px-3 py-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">ডিজাইন ও সেটিংস</div>
            
            <!-- Design Website -->
            <button type="button" onclick="switchTab('designWebsite'); toggleMobileDrawer(false);" id="mobDrawerTabDesignWebsite"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                        <i data-lucide="palette" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>ওয়েবসাইট ডিজাইন</span>
                </div>
            </button>

            <!-- Upload Banner -->
            <button type="button" onclick="switchTab('uploadBanner'); toggleMobileDrawer(false);" id="mobDrawerTabUploadBanner"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                        <i data-lucide="image-plus" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>ব্যানার আপলোড</span>
                </div>
                <span id="mobDrawerBadgeBanner" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-brand-100 text-brand-700"><?= count($store['banners'] ?? []) ?>/5</span>
            </button>

            <!-- Payments & Billing -->
            <button type="button" onclick="switchTab('payments'); toggleMobileDrawer(false);" id="mobDrawerTabPayments"
                class="mob-drawer-link w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <div class="flex items-center space-x-2.5">
                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-3.5 h-3.5"></i>
                    </span>
                    <span>পেমেন্ট ও বিলিং</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">নতুন</span>
            </button>

            <!-- User Info / Store Settings -->
            <button type="button" onclick="switchTab('userInfo'); toggleMobileDrawer(false);" id="mobDrawerTabUserInfo"
                class="mob-drawer-link w-full flex items-center space-x-2.5 px-3 py-2 rounded-xl text-xs font-bold transition text-slate-700 hover:bg-slate-50 cursor-pointer">
                <span class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                    <i data-lucide="user-cog" class="w-3.5 h-3.5"></i>
                </span>
                <span>স্টোর সেটিংস ও তথ্য</span>
            </button>
        </div>

    </div>

    <!-- Drawer Footer Actions -->
    <div class="p-3 border-t border-slate-100 bg-slate-50/80 shrink-0 space-y-2">
        <a href="../" target="_blank"
            class="w-full flex items-center justify-center space-x-2 py-2 px-3 bg-white hover:bg-slate-100 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 transition shadow-2xs">
            <i data-lucide="external-link" class="w-3.5 h-3.5 text-brand-600"></i>
            <span>লাইভ স্টোরফ্রন্ট দেখুন</span>
        </a>
        <button type="button" onclick="confirmLogout()"
            class="w-full flex items-center justify-center space-x-2 py-2 px-3 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-xl text-xs font-bold transition shadow-2xs cursor-pointer">
            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
            <span>লগআউট করুন</span>
        </button>
    </div>

</aside>

<script>
    // Smooth Mobile Drawer Toggle (Right Slide-over)
    window.toggleMobileDrawer = function(open) {
        const $backdrop = $('#mobileDrawerBackdrop');
        const $panel = $('#mobileDrawerPanel');

        if (open) {
            $backdrop.removeClass('pointer-events-none').addClass('opacity-100').removeClass('opacity-0');
            $panel.removeClass('translate-x-full').addClass('translate-x-0');
            $('body').addClass('overflow-hidden');
        } else {
            $backdrop.addClass('opacity-0').removeClass('opacity-100').addClass('pointer-events-none');
            $panel.addClass('translate-x-full').removeClass('translate-x-0');
            $('body').removeClass('overflow-hidden');
        }
        if (window.lucide) lucide.createIcons();
    };

    // Synchronize Mobile Bottom Nav & Drawer Active States (Flat, Uniform, Zero Badges on Bottom Nav)
    window.updateMobileNavActive = function(tab) {
        // Reset all 5 bottom nav buttons to default inactive state
        $('.mob-nav-btn')
            .removeClass('text-brand-600 font-extrabold')
            .addClass('text-slate-400 font-bold');

        // Drawer Items reset
        $('.mob-drawer-link')
            .removeClass('bg-brand-50 text-brand-700 border border-brand-200/60 font-black')
            .addClass('text-slate-700 font-bold');

        if (tab === 'dashboard') {
            $('#mobNavDashboard').addClass('text-brand-600 font-extrabold').removeClass('text-slate-400');
        } else if (tab === 'orders') {
            $('#mobNavOrders').addClass('text-brand-600 font-extrabold').removeClass('text-slate-400');
        } else if (tab === 'products' || tab === 'productCreate') {
            $('#mobNavProducts').addClass('text-brand-600 font-extrabold').removeClass('text-slate-400');
        } else if (tab === 'completedOrders') {
            $('#mobNavCompletedOrders').addClass('text-brand-600 font-extrabold').removeClass('text-slate-400');
        } else {
            // Tab is from the 3-dot drawer: highlight 'মেনু' button
            $('#mobNavMore').addClass('text-brand-600 font-extrabold').removeClass('text-slate-400');

            const drawerBtn = $('#mobDrawerTab' + tab.charAt(0).toUpperCase() + tab.slice(1));
            if (drawerBtn.length) {
                drawerBtn.addClass('bg-brand-50 text-brand-700 border border-brand-200/60 font-black').removeClass('text-slate-700 font-bold');
            }
        }
    };
</script>
