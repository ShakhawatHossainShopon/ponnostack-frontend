<?php
/**
 * Global Shopping Cart Slide-in Drawer Component
 * Included via views/footer.php across all storefront pages.
 */
?>
<!-- GLOBAL CART DRAWER (SLIDE-IN SIDEBAR) -->
<div id="cartDrawer" style="display: none;" class="fixed inset-0 z-[999999] overflow-hidden">
    <!-- Backdrop Overlay -->
    <div onclick="closeCartDrawer()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 cursor-pointer"></div>

    <!-- Drawer Panel Wrapper -->
    <div class="fixed inset-y-0 right-0 max-w-full flex pl-6 sm:pl-10 pointer-events-none h-full">
        <div class="pointer-events-auto w-screen max-w-md bg-white shadow-2xl flex flex-col h-full border-l border-slate-200 relative">
            
            <!-- Drawer Header -->
            <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50 shrink-0">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-lg bg-brand-100 text-brand-600 flex items-center justify-center shrink-0">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="text-sm font-extrabold text-slate-900 leading-tight">আপনার শপিং কার্ট</h3>
                            <span id="cartDrawerItemCountBadge" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-brand-100 text-brand-700">০ টি</span>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">নির্বাচিত পণ্যের তালিকা</div>
                    </div>
                </div>
                <button type="button" onclick="closeCartDrawer()" class="p-2 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-200/60 transition cursor-pointer" title="বন্ধ করুন">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Drawer Body: Scrollable Line Items List -->
            <div id="cartDrawerItemsList" class="p-4 space-y-3 overflow-y-auto flex-1 min-h-0 bg-slate-50/50">
                <!-- Populated dynamically via JS -->
            </div>

            <!-- Drawer Footer: Subtotal & Proceed to Checkout (Sticky at Bottom) -->
            <div class="p-4 sm:p-5 bg-white border-t border-slate-200 shrink-0 space-y-3 shadow-lg">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-600 font-bold">সাবটোটাল (Subtotal):</span>
                    <span id="cartDrawerSubtotal" class="text-base font-black text-slate-900 font-mono">৳ ০.০০</span>
                </div>
                <p class="text-[10px] text-slate-400">ডেলিভারি চার্জ চেকআউট পেজে এলাকা অনুযায়ী যুক্ত হবে।</p>
                <div class="flex gap-2">
                    <button type="button" onclick="clearCart()" class="px-3.5 py-2.5 bg-slate-100 hover:bg-rose-50 hover:text-rose-600 border border-slate-200 text-slate-600 text-xs font-bold rounded-xl transition cursor-pointer flex items-center justify-center shrink-0" title="কার্ট খালি করুন">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                    <a href="<?= $clientBasePath ?? '' ?>/checkout" id="btnProceedCheckout" class="flex-1 py-3 px-4 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white text-xs sm:text-sm font-extrabold rounded-xl transition shadow-md flex items-center justify-center space-x-2 cursor-pointer">
                        <span>চেকআউট পেজে যান (Checkout)</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Canonical LocalStorage Key
    window.CART_STORAGE_KEY = 'client_cart';

    // Helper: Escape HTML to prevent XSS
    function escapeHtmlCart(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Read Cart from LocalStorage
    window.getCart = function() {
        try {
            const raw = localStorage.getItem(window.CART_STORAGE_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            console.error('Failed to parse cart JSON', e);
            return [];
        }
    };

    // Save Cart to LocalStorage and update UI
    window.saveCart = function(cartData) {
        try {
            const toSave = cartData !== undefined ? cartData : (window.cart || []);
            localStorage.setItem(window.CART_STORAGE_KEY, JSON.stringify(toSave));
            window.cart = toSave;
            window.updateCartBadge();
        } catch (e) {
            console.error('Failed to save cart to localStorage', e);
        }
    };

    // Update Cart Counters across header and drawer
    window.updateCartBadge = function() {
        const currentCart = window.cart || window.getCart();
        const count = currentCart.reduce((sum, item) => sum + (parseInt(item.quantity) || 1), 0);
        $('#cartCountBadge').text(count);
        $('#cartDrawerItemCountBadge').text(count + ' টি');
        if (window.gsap && count > 0) {
            gsap.fromTo('#cartCountBadge', { scale: 1.5 }, { scale: 1, duration: 0.35, ease: 'back.out(2)' });
        }
    };

    // Open Cart Slide-in Drawer with GSAP 60fps Smooth Transition
    window.openCartDrawer = function() {
        window.cart = window.getCart();
        window.renderCartDrawer();
        const $drawer = $('#cartDrawer');
        const $backdrop = $drawer.children().first();
        const $panel = $drawer.find('.max-w-md');

        $drawer.removeClass('hidden').css('display', 'block');
        $('body').addClass('overflow-hidden');

        if (window.gsap) {
            gsap.fromTo($backdrop[0], { opacity: 0 }, { opacity: 1, duration: 0.25, ease: 'power2.out' });
            gsap.fromTo($panel[0], { x: '100%' }, { x: '0%', duration: 0.35, ease: 'power3.out' });
        }
        if (window.lucide) lucide.createIcons();
    };

    // Close Cart Slide-in Drawer with GSAP 60fps Smooth Transition
    window.closeCartDrawer = function() {
        const $drawer = $('#cartDrawer');
        const $backdrop = $drawer.children().first();
        const $panel = $drawer.find('.max-w-md');

        if (window.gsap) {
            gsap.to($backdrop[0], { opacity: 0, duration: 0.2, ease: 'power2.in' });
            gsap.to($panel[0], {
                x: '100%',
                duration: 0.25,
                ease: 'power3.in',
                onComplete: function() {
                    $drawer.addClass('hidden').css('display', 'none');
                    $('body').removeClass('overflow-hidden');
                }
            });
        } else {
            $drawer.addClass('hidden').css('display', 'none');
            $('body').removeClass('overflow-hidden');
        }
    };

    // Render Drawer Content
    window.renderCartDrawer = function() {
        const currentCart = window.cart || window.getCart();
        const $list = $('#cartDrawerItemsList');
        $list.empty();

        if (currentCart.length === 0) {
            $list.html(`
                <div class="py-16 text-center space-y-3">
                    <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-400 flex items-center justify-center mx-auto">
                        <i data-lucide="shopping-bag" class="w-7 h-7"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-700">আপনার কার্ট বর্তমানে খালি</p>
                    <p class="text-[11px] text-slate-400">শপ থেকে আপনার পছন্দের পণ্য যোগ করুন।</p>
                    <button type="button" onclick="closeCartDrawer(); window.location.href='<?= $clientBasePath ?? '' ?>/#catalog';" class="inline-flex items-center space-x-1.5 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition mt-2 cursor-pointer shadow-xs">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>শপে পণ্য দেখুন</span>
                    </button>
                </div>
            `);
            $('#cartDrawerSubtotal').text('৳ 0.00');
            $('#btnProceedCheckout')
                .addClass('opacity-50 pointer-events-none cursor-not-allowed')
                .attr('href', '#')
                .html('<span>চেকআউট পেজে যান (Checkout)</span><i data-lucide="arrow-right" class="w-4 h-4"></i>');
            if (window.lucide) lucide.createIcons();
            return;
        }

        $('#btnProceedCheckout')
            .removeClass('opacity-50 pointer-events-none cursor-not-allowed')
            .attr('href', '<?= $clientBasePath ?? '' ?>/checkout')
            .html('<span>চেকআউট পেজে যান (Checkout)</span><i data-lucide="arrow-right" class="w-4 h-4"></i>');

        let subtotal = 0;

        currentCart.forEach((item, index) => {
            const qty = parseInt(item.quantity) || 1;
            const price = parseFloat(item.unit_price) || 0;
            const lineTotal = price * qty;
            subtotal += lineTotal;

            const variantText = [
                item.size ? `সাইজ: ${escapeHtmlCart(item.size)}` : null,
                item.color ? `রং: ${escapeHtmlCart(item.color)}` : null
            ].filter(Boolean).join(' | ');

            const imgHtml = item.image
                ? `<img src="${escapeHtmlCart(item.image)}" alt="${escapeHtmlCart(item.name)}" class="w-full h-full object-cover">`
                : `<div class="w-full h-full flex items-center justify-center text-slate-400"><i data-lucide="package" class="w-5 h-5"></i></div>`;

            $list.append(`
                <div class="p-3 bg-white border border-slate-200/90 rounded-2xl shadow-2xs flex items-center justify-between gap-3 text-xs hover:border-slate-300 transition">
                    <div class="flex items-center space-x-3 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                            ${imgHtml}
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-slate-900 truncate" title="${escapeHtmlCart(item.name)}">${escapeHtmlCart(item.name)}</h4>
                            ${variantText ? `<div class="text-[10px] text-slate-500 font-medium">${variantText}</div>` : ''}
                            <div class="text-xs font-black text-slate-900 mt-0.5">৳${price.toFixed(2)}</div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 shrink-0">
                        <div class="flex items-center space-x-1 bg-slate-100 border border-slate-200 rounded-lg p-0.5 shadow-2xs">
                            <button type="button" onclick="adjustCartItemQty(${index}, -1)" class="w-6 h-6 rounded bg-white hover:bg-slate-200 text-slate-700 font-black text-xs flex items-center justify-center transition cursor-pointer shadow-2xs">-</button>
                            <span class="text-xs font-bold text-slate-900 px-1 min-w-[20px] text-center">${qty}</span>
                            <button type="button" onclick="adjustCartItemQty(${index}, 1)" class="w-6 h-6 rounded bg-white hover:bg-slate-200 text-slate-700 font-black text-xs flex items-center justify-center transition cursor-pointer shadow-2xs">+</button>
                        </div>
                        <button type="button" onclick="removeCartItem(${index})" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition cursor-pointer" title="মুছে ফেলুন">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            `);
        });

        $('#cartDrawerSubtotal').text('৳ ' + subtotal.toFixed(2));
        if (window.lucide) lucide.createIcons();
    };

    // Stepper Quantity Adjustment with Stock Validation
    window.adjustCartItemQty = function(index, change) {
        let currentCart = window.cart || window.getCart();
        if (!currentCart[index]) return;

        const item = currentCart[index];
        const maxStock = parseInt(item.stock);

        // Stock Validation when clicking "+"
        if (change > 0 && !isNaN(maxStock)) {
            if (maxStock <= 0) {
                if (typeof window.showToast === 'function') {
                    showToast('দুঃখিত, পণ্যটি বর্তমানে স্টকে নেই।', 'error');
                }
                return;
            }
            if (item.quantity >= maxStock) {
                if (typeof window.showToast === 'function') {
                    showToast(`দুঃখিত, এই পণ্যের সর্বোচ্চ ${maxStock} টি স্টক উপলব্ধ রয়েছে।`, 'warning');
                } else if (window.Swal) {
                    Swal.fire({ icon: 'warning', text: `দুঃখিত, এই পণ্যের সর্বোচ্চ ${maxStock} টি স্টক উপলব্ধ রয়েছে।` });
                } else {
                    alert(`দুঃখিত, এই পণ্যের সর্বোচ্চ ${maxStock} টি স্টক উপলব্ধ রয়েছে।`);
                }
                return;
            }
        }

        currentCart[index].quantity = (parseInt(currentCart[index].quantity) || 1) + change;
        if (currentCart[index].quantity <= 0) {
            currentCart.splice(index, 1);
        }
        window.saveCart(currentCart);
        window.renderCartDrawer();
    };

    // Remove single line item
    window.removeCartItem = function(index) {
        let currentCart = window.cart || window.getCart();
        currentCart.splice(index, 1);
        window.saveCart(currentCart);
        window.renderCartDrawer();
    };

    // Clear entire cart
    window.clearCart = function() {
        window.saveCart([]);
        window.renderCartDrawer();
    };

    // Bind aliases into global scope for backward compatibility
    var getCart = window.getCart;
    var saveCart = window.saveCart;
    var updateCartBadge = window.updateCartBadge;
    var openCartDrawer = window.openCartDrawer;
    var closeCartDrawer = window.closeCartDrawer;
    var renderCartDrawer = window.renderCartDrawer;
    var adjustCartItemQty = window.adjustCartItemQty;
    var removeCartItem = window.removeCartItem;
    var clearCart = window.clearCart;

    $(document).ready(function() {
        window.cart = window.getCart();
        window.updateCartBadge();
        
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#cartDrawer').is(':visible')) {
                closeCartDrawer();
            }
        });
    });
</script>