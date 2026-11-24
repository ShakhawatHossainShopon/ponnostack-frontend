<?php
/**
 * Global Order Tracking Modal Component
 * Included across all storefront pages via views/footer.php.
 */
?>
<!-- GLOBAL ORDER TRACKING MODAL -->
<div id="orderTrackingModal" style="display: none;" class="fixed inset-0 z-[999999] flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
    <!-- Backdrop Overlay -->
    <div onclick="closeOrderTrackingModal()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300"></div>

    <div class="relative bg-white border border-slate-200 rounded-3xl w-full max-w-lg shadow-2xl flex flex-col max-h-[92vh] my-auto overflow-hidden z-10">
        <!-- Header -->
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/80 shrink-0">
            <div class="flex items-center space-x-2">
                <span class="w-8 h-8 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                </span>
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">অর্ডার ট্র্যাকিং (Order Tracking)</h3>
                    <p class="text-[11px] text-slate-500">আপনার অর্ডারের লাইভ ডেলিভারি অগ্রগতি দেখুন</p>
                </div>
            </div>
            <button type="button" onclick="closeOrderTrackingModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-5 space-y-4 overflow-y-auto flex-1 text-xs">
            <!-- Saved Orders Quick Selector from LocalStorage -->
            <div id="savedOrdersSection" class="hidden space-y-1.5">
                <span class="text-[11px] font-bold text-slate-700 block">আপনার সাম্প্রতিক অর্ডারসমূহ:</span>
                <div id="savedOrdersPills" class="flex flex-wrap gap-1.5"></div>
            </div>

            <!-- Tracking Lookup Input Box -->
            <div class="flex gap-2">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 font-mono text-xs">#</span>
                    <input type="text" id="trackInputNumber" placeholder="ইনভয়েস বা অর্ডার নম্বর (যেমন: ORD-261111-XXXX)"
                        class="w-full h-10 pl-8 pr-3 bg-slate-50 border border-slate-300 rounded-xl text-xs font-mono font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500 shadow-2xs"
                        onkeydown="if(event.key==='Enter'){ searchOrderTracking(); }">
                </div>
                <button type="button" onclick="searchOrderTracking()" id="btnSearchTrack"
                    class="h-10 px-4 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white rounded-xl text-xs font-bold transition shadow-xs flex items-center space-x-1.5 cursor-pointer shrink-0">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    <span>ট্র্যাক করুন</span>
                </button>
            </div>

            <!-- Loading Spinner -->
            <div id="trackLoading" class="hidden py-8 text-center text-slate-500 space-y-2">
                <div class="w-8 h-8 border-3 border-brand-600 border-t-transparent rounded-full animate-spin mx-auto"></div>
                <p class="text-xs font-semibold">অর্ডার ট্র্যাকিং তথ্য লোড হচ্ছে...</p>
            </div>

            <!-- Tracking Result Container -->
            <div id="trackResultContainer" class="hidden space-y-4">
                <!-- Status Banner & Info -->
                <div class="p-3.5 bg-slate-50 border border-slate-200/90 rounded-2xl flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">ইনভয়েস নম্বর</span>
                        <span class="text-sm font-black text-slate-900 font-mono" id="trOrderNumber">ORD-0000</span>
                    </div>
                    <div id="trStatusBadge">
                        <!-- Populated dynamically -->
                    </div>
                </div>

                <!-- Visual Stepper Roadmap (Pending -> Processing -> Delivered) -->
                <div class="p-4 bg-white border border-slate-200 rounded-2xl shadow-2xs space-y-3">
                    <h4 class="text-xs font-bold text-slate-900 flex items-center space-x-1.5">
                        <i data-lucide="navigation" class="w-3.5 h-3.5 text-brand-600"></i>
                        <span>ডেলিভারি অগ্রগতি (Delivery Progress)</span>
                    </h4>

                    <!-- Cancel Notice (if status === 'cancel') -->
                    <div id="trCancelNotice" class="hidden p-3 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold flex items-center space-x-2">
                        <i data-lucide="x-circle" class="w-4 h-4 text-rose-500 shrink-0"></i>
                        <span>এই অর্ডারটি বাতিল করা হয়েছে। বিস্তারিত তথ্যের জন্য আমাদের সাথে যোগাযোগ করুন।</span>
                    </div>

                    <!-- Roadmap Stepper -->
                    <div id="trRoadmapStepper" class="space-y-4 pt-1">
                        <!-- Populated dynamically -->
                    </div>
                </div>

                <!-- Order Details & Line Items -->
                <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-2xl space-y-2">
                    <span class="text-xs font-bold text-slate-900 block">অর্ডারকৃত পণ্যসমূহ</span>
                    <div id="trItemsList" class="space-y-1.5 border-b border-slate-200 pb-2"></div>
                    <div class="flex items-center justify-between pt-1 text-xs">
                        <span class="text-slate-500 font-medium">মোট প্রদেয় (ক্যাশ অন ডেলিভারি):</span>
                        <span class="font-black text-brand-600 text-sm font-mono" id="trTotalAmount">৳০.০০</span>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs space-y-1">
                    <span class="font-bold text-slate-800 block">ডেলিভারি ঠিকানা:</span>
                    <div class="text-slate-600" id="trDeliveryAddress"></div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-200 flex justify-end shrink-0">
            <button type="button" onclick="closeOrderTrackingModal()" class="px-4 py-2 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer shadow-2xs">বন্ধ করুন</button>
        </div>
    </div>
</div>

<script>
    window.openOrderTrackingModal = function(prefillOrderNumber = null) {
        window.renderSavedOrdersPills();

        if (prefillOrderNumber) {
            $('#trackInputNumber').val(prefillOrderNumber);
            window.searchOrderTracking();
        } else {
            try {
                const raw = localStorage.getItem('client_saved_orders');
                if (raw) {
                    const list = JSON.parse(raw);
                    if (list.length > 0 && list[0].order_number) {
                        $('#trackInputNumber').val(list[0].order_number);
                        window.searchOrderTracking();
                    }
                }
            } catch(e){}
        }

        const $modal = $('#orderTrackingModal');
        const $backdrop = $modal.children().first();
        const $dialog = $modal.find('.max-w-lg');

        $modal.removeClass('hidden').css('display', 'flex');
        $('body').addClass('overflow-hidden');

        if (window.gsap) {
            gsap.fromTo($backdrop[0], { opacity: 0 }, { opacity: 1, duration: 0.25 });
            gsap.fromTo($dialog[0], { scale: 0.92, opacity: 0, y: 15 }, { scale: 1, opacity: 1, y: 0, duration: 0.35, ease: 'back.out(1.5)' });
        }
        if (window.lucide) lucide.createIcons();
    };

    window.closeOrderTrackingModal = function() {
        const $modal = $('#orderTrackingModal');
        const $backdrop = $modal.children().first();
        const $dialog = $modal.find('.max-w-lg');

        if (window.gsap) {
            gsap.to($backdrop[0], { opacity: 0, duration: 0.2 });
            gsap.to($dialog[0], {
                scale: 0.93,
                opacity: 0,
                duration: 0.2,
                ease: 'power2.in',
                onComplete: function() {
                    $modal.addClass('hidden').css('display', 'none');
                    $('body').removeClass('overflow-hidden');
                }
            });
        } else {
            $modal.addClass('hidden').css('display', 'none');
            $('body').removeClass('overflow-hidden');
        }
    };

    window.renderSavedOrdersPills = function() {
        try {
            const raw = localStorage.getItem('client_saved_orders');
            const $container = $('#savedOrdersPills');
            $container.empty();

            if (raw) {
                const list = JSON.parse(raw);
                if (Array.isArray(list) && list.length > 0) {
                    list.forEach(ord => {
                        if (!ord || !ord.order_number) return;
                        const rawPrice = ord.total_amount !== undefined ? ord.total_amount : (ord.total !== undefined ? ord.total : ord.amount);
                        const numPrice = parseFloat(rawPrice);
                        const priceHtml = !isNaN(numPrice) 
                            ? `<span class="text-slate-400 font-sans text-[9px]">(৳${numPrice.toFixed(0)})</span>` 
                            : '';

                        $container.append(`
                            <button type="button" onclick="selectSavedOrder('${ord.order_number}')" 
                                class="px-2.5 py-1 bg-white hover:bg-brand-50 border border-slate-300 hover:border-brand-400 rounded-lg text-slate-800 text-[11px] font-mono font-bold transition flex items-center space-x-1 cursor-pointer">
                                <span>#${ord.order_number}</span>
                                ${priceHtml}
                            </button>
                        `);
                    });
                    $('#savedOrdersSection').removeClass('hidden');
                    return;
                }
            }
            $('#savedOrdersSection').addClass('hidden');
        } catch(e) {
            $('#savedOrdersSection').addClass('hidden');
        }
    };

    window.selectSavedOrder = function(ordNumber) {
        $('#trackInputNumber').val(ordNumber);
        window.searchOrderTracking();
    };

    window.searchOrderTracking = async function() {
        const orderNumber = $('#trackInputNumber').val().trim();
        if (!orderNumber) {
            if (typeof showToast === 'function') showToast('অনুগ্রহ করে অর্ডার বা ইনভয়েস নম্বর লিখুন।', 'warning');
            else if (window.Toast) Toast.warning('অনুগ্রহ করে অর্ডার বা ইনভয়েস নম্বর লিখুন।');
            return;
        }

        $('#trackLoading').removeClass('hidden');
        $('#trackResultContainer').addClass('hidden');
        $('#btnSearchTrack').prop('disabled', true);

        try {
            const api = (typeof StoreApi !== 'undefined') ? StoreApi : window.StoreApi;
            if (!api) {
                throw new Error('StoreApi client not initialized');
            }
            if (typeof api.getStoreUuid === 'function' && !api.getStoreUuid()) {
                api.init({
                    apiUrl: '<?= htmlspecialchars(ApiClient::getApiUrl()) ?>',
                    storeUuid: '<?= htmlspecialchars(ApiClient::getStoreUuid()) ?>'
                });
            }
            const res = await api.get(`orders/track/${encodeURIComponent(orderNumber)}`);
            if (res.success && res.data) {
                window.renderTrackingRoadmap(res.data);
            } else {
                const msg = res.message || 'অর্ডার খুঁজে পাওয়া যায়নি।';
                if (typeof showToast === 'function') showToast(msg, 'error');
                else if (window.Toast) Toast.error(msg);
            }
        } catch(err) {
            if (typeof showToast === 'function') showToast(err.message, 'error');
            else if (window.Toast) Toast.error(err.message);
        } finally {
            $('#trackLoading').addClass('hidden');
            $('#btnSearchTrack').prop('disabled', false);
        }
    };

    window.renderTrackingRoadmap = function(data) {
        const order = data.order;
        const roadmap = data.roadmap;

        // Sync/heal saved order price in localStorage
        try {
            const raw = localStorage.getItem('client_saved_orders');
            if (raw && order && order.order_number) {
                let list = JSON.parse(raw);
                if (Array.isArray(list)) {
                    let updated = false;
                    list = list.map(item => {
                        if (item && item.order_number === order.order_number) {
                            updated = true;
                            return {
                                ...item,
                                total: order.total_amount,
                                total_amount: order.total_amount
                            };
                        }
                        return item;
                    });
                    if (updated) {
                        localStorage.setItem('client_saved_orders', JSON.stringify(list));
                        window.renderSavedOrdersPills();
                    }
                }
            }
        } catch(e) {}

        $('#trOrderNumber').text(order.order_number);
        $('#trTotalAmount').text('৳' + parseFloat(order.total_amount).toFixed(2));
        $('#trDeliveryAddress').text(`${order.delivery_address}, ${order.upazilla}, ${order.district}, ${order.division} (ফোন: ${order.customer_phone})`);

        const statusMap = {
            pending: { label: 'পেন্ডিং (অর্ডার গৃহীত)', bg: 'bg-amber-100 text-amber-800 border-amber-200' },
            processing: { label: 'প্রসেসিং ও প্যাকেজিং', bg: 'bg-blue-100 text-blue-800 border-blue-200' },
            delivered: { label: 'ডেলিভারি সম্পন্ন', bg: 'bg-emerald-100 text-emerald-800 border-emerald-200' },
            cancel: { label: 'অর্ডার বাতিল', bg: 'bg-rose-100 text-rose-800 border-rose-200' }
        };

        const badge = statusMap[order.status] || statusMap.pending;
        $('#trStatusBadge').html(`
            <span class="px-2.5 py-1 rounded-lg text-xs font-bold border ${badge.bg}">
                ${badge.label}
            </span>
        `);

        if (roadmap.is_cancelled) {
            $('#trCancelNotice').removeClass('hidden');
            $('#trRoadmapStepper').addClass('hidden');
        } else {
            $('#trCancelNotice').addClass('hidden');
            $('#trRoadmapStepper').removeClass('hidden');

            const $stepper = $('#trRoadmapStepper');
            $stepper.empty();

            roadmap.steps.forEach((step, idx) => {
                const isCompleted = step.completed;
                const isCurrent = step.current;

                let iconColor = isCompleted ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-400';
                if (isCurrent && !isCompleted) iconColor = 'bg-brand-600 text-white animate-pulse';

                $stepper.append(`
                    <div class="flex items-start space-x-3 relative">
                        ${idx < roadmap.steps.length - 1 ? `
                            <div class="absolute left-3.5 top-8 bottom-0 w-0.5 ${isCompleted ? 'bg-emerald-500' : 'bg-slate-200'}" style="height: calc(100% - 10px);"></div>
                        ` : ''}
                        
                        <div class="w-7 h-7 rounded-full ${iconColor} flex items-center justify-center shrink-0 z-10 shadow-xs">
                            <i data-lucide="${step.icon}" class="w-4 h-4"></i>
                        </div>

                        <div class="min-w-0 pb-3">
                            <h5 class="text-xs font-bold ${isCompleted ? 'text-slate-900' : 'text-slate-500'}">
                                ${step.title}
                                ${isCurrent ? '<span class="ml-1.5 px-1.5 py-0.2 rounded text-[9px] font-bold bg-brand-100 text-brand-700">বর্তমান অবস্থা</span>' : ''}
                            </h5>
                            <p class="text-[11px] text-slate-500 mt-0.5">${step.subtitle}</p>
                        </div>
                    </div>
                `);
            });
        }

        const $items = $('#trItemsList');
        $items.empty();
        if (Array.isArray(order.items)) {
            order.items.forEach(it => {
                const variant = [it.size ? `সাইজ: ${it.size}` : '', it.color ? `রঙ: ${it.color}` : ''].filter(Boolean).join(' | ');
                $items.append(`
                    <div class="flex items-center justify-between text-xs py-0.5">
                        <span class="text-slate-800 font-medium">${it.product_name} ${variant ? `<span class="text-[10px] text-slate-400">(${variant})</span>` : ''}</span>
                        <span class="font-bold text-slate-900">${it.quantity} × ৳${parseFloat(it.unit_price).toFixed(0)}</span>
                    </div>
                `);
            });
        }

        $('#trackResultContainer').removeClass('hidden');
        if (window.lucide) lucide.createIcons();
    };

    var openOrderTrackingModal = window.openOrderTrackingModal;
    var closeOrderTrackingModal = window.closeOrderTrackingModal;
    var renderSavedOrdersPills = window.renderSavedOrdersPills;
    var selectSavedOrder = window.selectSavedOrder;
    var searchOrderTracking = window.searchOrderTracking;
    var renderTrackingRoadmap = window.renderTrackingRoadmap;

    $(document).ready(function() {
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#orderTrackingModal').is(':visible')) {
                closeOrderTrackingModal();
            }
        });
    });
</script>
