

    <!-- 4. MODAL: ADD / EDIT CATEGORY -->
    <div id="modalCategory" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white border border-slate-200 rounded-2xl w-full max-w-md shadow-2xl flex flex-col max-h-[90vh] my-auto overflow-hidden">
            <!-- Modal Header -->
            <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/70 shrink-0">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                        <i data-lucide="folder-plus" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900" id="modalCategoryTitle">নতুন ক্যাটাগরি যোগ করুন</h3>
                        <p class="text-[11px] text-slate-500">ক্যাটাগরির নাম ও ১টি কভার ইমেজ যুক্ত করুন।</p>
                    </div>
                </div>
                <button type="button" onclick="closeCategoryModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="categoryForm" class="p-5 space-y-4 overflow-y-auto flex-1">
                <input type="hidden" id="catEditUuid">

                <!-- Category Name -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">ক্যাটাগরির নাম (Category Name) *</label>
                    <input type="text" id="fCatName" required placeholder="যেমন: Men's Clothing বা Electronics"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 shadow-xs font-medium">
                </div>

                <!-- 1 Category Image Upload (Auto-compressed to 200KB) -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-slate-900 flex items-center space-x-1.5">
                            <i data-lucide="image" class="w-3.5 h-3.5 text-amber-600"></i>
                            <span>ক্যাটাগরি ইমেজ (১টি ছবি - ঐচ্ছিক)</span>
                        </label>
                        <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                            ⚡ ২০০KB কম্প্রেশন
                        </span>
                    </div>

                    <!-- Single Image Preview Container -->
                    <div id="catImagePreviewWrapper" class="hidden mb-2 relative group w-24 h-24 rounded-xl overflow-hidden border border-slate-200 shadow-2xs">
                        <img id="catImagePreview" src="" alt="Category preview" class="w-full h-full object-cover">
                        <button type="button" onclick="removeCatImage()" class="absolute top-1 right-1 w-6 h-6 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition shadow-xs cursor-pointer" title="ছবি সরান">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>

                    <!-- File input & Dropzone -->
                    <label for="fCatImageInput" id="catImageDropzone" class="border-2 border-dashed border-slate-300 hover:border-brand-500 hover:bg-brand-50/20 rounded-xl p-4 text-center cursor-pointer transition bg-slate-50/50 block group select-none">
                        <input type="file" id="fCatImageInput" accept="image/png,image/jpeg,image/webp,image/gif" class="sr-only" onchange="handleCatImageSelection(event)">
                        <div class="flex flex-col items-center justify-center pointer-events-none">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mb-1.5 group-hover:scale-110 transition">
                                <i data-lucide="upload-cloud" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs font-bold text-slate-800">ছবি আপলোড করতে ক্লিক করুন</div>
                            <div class="text-[10px] text-slate-500 mt-0.5">যেকোনো সাইজের ছবি স্বয়ংক্রিয় ২০০KB-তে অপটিমাইজ হবে</div>
                        </div>
                    </label>
                </div>
            </form>

            <!-- Modal Footer -->
            <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-200 flex items-center justify-end space-x-2 shrink-0">
                <button type="button" onclick="closeCategoryModal()" class="px-4 py-2 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition shadow-2xs cursor-pointer">বাতিল</button>
                <button type="button" onclick="$('#categoryForm').submit()" id="btnSaveCategory" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                    <i data-lucide="save" class="w-3.5 h-3.5"></i>
                    <span id="btnSaveCategoryText">ক্যাটাগরি সংরক্ষণ করুন</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 5. MODAL: PRODUCT DETAILS (CLICK CARD) -->
    <div id="modalProductDetails" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white border border-slate-200 rounded-2xl w-full max-w-xl shadow-2xl flex flex-col max-h-[92vh] my-auto overflow-hidden">
            <!-- Modal Header (Pinned) -->
            <div class="px-5 sm:px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50/70 shrink-0">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                        <i data-lucide="package" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900" id="detailProdTitle">প্রোডাক্টের বিবরণ</h3>
                    </div>
                </div>
                <button type="button" onclick="closeProductDetailsModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition cursor-pointer">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-5 sm:p-6 space-y-4 overflow-y-auto flex-1 text-xs">
                
                <!-- Main Image Preview & Thumbnails Gallery -->
                <div id="detailGallerySection" class="space-y-2">
                    <div class="aspect-video w-full rounded-xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center">
                        <img id="detailMainImage" src="" class="w-full h-full object-contain">
                        <div id="detailNoImagePlaceholder" class="hidden flex flex-col items-center justify-center text-slate-400">
                            <i data-lucide="image-off" class="w-10 h-10 mb-1"></i>
                            <span class="text-xs">কোনো ছবি নেই</span>
                        </div>
                    </div>
                    <div id="detailThumbnailsRow" class="flex gap-2 overflow-x-auto pb-1">
                        <!-- Thumbnails populated dynamically -->
                    </div>
                </div>

                <!-- Stock Units Display Banner -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50/50 border border-emerald-200/80 rounded-xl p-3.5 flex items-center justify-between">
                    <div>
                        <span class="text-[11px] font-bold text-emerald-800 uppercase tracking-wider flex items-center space-x-1.5">
                            <i data-lucide="boxes" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span data-i18n="lblStockQty">ইনভেন্টরি স্টক (Stock Quantity)</span>
                        </span>
                        <div class="flex items-baseline space-x-2 mt-1">
                            <span class="text-2xl font-black text-emerald-950" id="detailStockCount">0</span>
                            <span class="text-xs text-emerald-700 font-semibold" data-i18n="statStockUnits">উপলব্ধ আইটেম/ইউনিট</span>
                        </div>
                    </div>
                </div>

                <!-- Pricing & Profit Overview Card -->
                <div class="grid grid-cols-3 gap-2 p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-center">
                    <div>
                        <span class="text-[10px] text-slate-500 block font-medium" data-i18n="thMainPrice">কেনা দাম (Main)</span>
                        <span class="text-xs sm:text-sm font-black text-slate-800" id="detailMainPrice">৳০.০০</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-500 block font-medium" data-i18n="thRetailerPrice">বিক্রয় মূল্য (Retailer)</span>
                        <span class="text-xs sm:text-sm font-black text-brand-600" id="detailRetailerPrice">৳০.০০</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-emerald-700 font-bold block" data-i18n="thProfitUnit">লাভ / ইউনিট</span>
                        <span class="text-xs sm:text-sm font-black text-emerald-700" id="detailProfitVal">+৳০.০০</span>
                        <span class="text-[9px] text-emerald-600 font-semibold block" id="detailProfitMargin">০% মার্জিন</span>
                    </div>
                </div>

                <!-- Sizes & Colors Tags -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="p-3 bg-slate-50/70 border border-slate-200/70 rounded-xl">
                        <span class="text-[11px] font-bold text-slate-700 block mb-1.5" id="detailSizesLabel" data-i18n="lblSizes">সাইজসমূহ (Sizes)</span>
                        <div id="detailSizesContainer" class="flex flex-wrap gap-1">
                            <!-- Populated -->
                        </div>
                    </div>
                    <div class="p-3 bg-slate-50/70 border border-slate-200/70 rounded-xl">
                        <span class="text-[11px] font-bold text-slate-700 block mb-1.5" data-i18n="lblColors">রঙসমূহ (Colors)</span>
                        <div id="detailColorsContainer" class="flex flex-wrap gap-1">
                            <!-- Populated -->
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <span class="text-[11px] font-bold text-slate-700 block mb-1" data-i18n="lblDescription">পণ্যের বিবরণ (Description)</span>
                    <div id="detailDescription" class="p-3 bg-slate-50 rounded-xl text-slate-700 text-xs leading-relaxed border border-slate-200/80 whitespace-pre-wrap"></div>
                </div>

                <!-- Category & Potential Profit -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                    <div class="flex items-center justify-between p-2.5 bg-slate-50 border border-slate-200 rounded-xl">
                        <span class="text-slate-500 font-medium">ক্যাটাগরি:</span>
                        <span id="detailCategory" class="text-slate-800 bg-white px-2 py-0.5 rounded border border-slate-200 font-bold text-[10px]"></span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 bg-emerald-50/60 border border-emerald-200 rounded-xl">
                        <span class="text-emerald-800 font-semibold">মোট সম্ভাব্য লাভ:</span>
                        <span id="detailTotalPotentialProfit" class="font-black text-emerald-700">৳০.০০</span>
                    </div>
                </div>
            </div>

            <!-- Modal Footer (Pinned Actions) -->
            <div class="px-5 sm:px-6 py-3.5 bg-slate-50/80 border-t border-slate-200 flex items-center justify-between shrink-0">
                <button type="button" id="btnDetailDelete" class="px-3 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 text-xs font-bold rounded-xl transition flex items-center space-x-1.5 cursor-pointer">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    <span data-i18n="deleteBtn">ডিলিট</span>
                </button>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="closeProductDetailsModal()" class="px-4 py-2 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition shadow-2xs cursor-pointer" data-i18n="btnCancel">বন্ধ করুন</button>
                    <button type="button" id="btnDetailEdit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                        <span>সম্পাদনা করুন</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Dedicated Product Delete Confirmation Modal (Yes / No) -->
    <div id="modalConfirmDelete" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white border border-slate-200 rounded-2xl w-full max-w-sm shadow-2xl p-5 sm:p-6 text-center transform transition-all space-y-4">
            <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto shadow-inner">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">পণ্যটি মুছে ফেলতে চান?</h3>
                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                    আপনি কি নিশ্চিতভাবে <b id="confirmDeleteProdName" class="text-rose-600 font-bold"></b> প্রোডাক্টটি মুছে ফেলতে চান? এটি আর ফিরিয়ে আনা সম্ভব হবে না।
                </p>
            </div>
            <div class="grid grid-cols-2 gap-2.5 pt-2">
                <button type="button" onclick="closeConfirmDeleteModal()" class="w-full py-2.5 px-3 bg-slate-100 hover:bg-slate-200 active:bg-slate-300 text-slate-700 text-xs font-bold rounded-xl transition cursor-pointer">
                    না, বাতিল
                </button>
                <button type="button" id="btnExecuteDelete" onclick="executeDeleteProduct()" class="w-full py-2.5 px-3 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center justify-center space-x-1.5 cursor-pointer">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    <span>হ্যাঁ, ডিলিট করুন</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Dedicated Package Product Upload Limit Modal -->
    <div id="modalPackageProductLimit" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white border border-rose-200 rounded-3xl w-full max-w-md shadow-2xl p-6 sm:p-7 text-center transform transition-all space-y-4">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto shadow-inner">
                <i data-lucide="shield-alert" class="w-7 h-7"></i>
            </div>
            <div class="space-y-1.5">
                <h3 class="text-base font-extrabold text-slate-900">প্রোডাক্ট আপলোডের লিমিট শেষ</h3>
                <p id="modalLimitReachedMsg" class="text-xs text-slate-600 leading-relaxed">
                    আপনার প্রোডাক্ট আপলোডের লিমিট শেষ হয়ে গেছে। আপনার প্যাকেজের আওতায় সর্বোচ্চ প্রোডাক্ট যোগ করার সীমা পূর্ণ হয়ে গেছে। আপনি আর নতুন প্রোডাক্ট যোগ করতে পারবেন না।
                </p>
            </div>
            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200 grid grid-cols-3 divide-x divide-slate-200 text-xs">
                <div class="px-1">
                    <span class="text-[10px] text-slate-400 block font-bold">বর্তমান প্রোডাক্ট</span>
                    <span id="modalLimitReachedCurrent" class="text-sm font-black text-slate-800">০ টি</span>
                </div>
                <div class="px-1">
                    <span class="text-[10px] text-slate-400 block font-bold">প্যাকেজ সীমা</span>
                    <span id="modalLimitReachedMax" class="text-sm font-black text-slate-800">০ টি</span>
                </div>
                <div class="px-1">
                    <span class="text-[10px] text-slate-400 block font-bold">আর বাকি আছে</span>
                    <span id="modalLimitReachedRemaining" class="text-sm font-black text-rose-600">০ টি</span>
                </div>
            </div>
            <div class="pt-1">
                <button type="button" onclick="closePackageLimitModal()" class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition cursor-pointer">
                    ঠিক আছে, বুঝতে পেরেছি
                </button>
            </div>
        </div>
    </div>

    <!-- Order Details & Printable Invoice Modal -->
    <div id="modalOrderDetails" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-slate-200 my-8 overflow-hidden transform transition-all">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/70 print:hidden">
                <div class="flex items-center space-x-2.5">
                    <span class="w-8 h-8 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900">অর্ডার ইনভয়েস ও বিবরণ</h3>
                        <p class="text-[11px] text-slate-500 font-mono" id="modalOrderInvoiceNo">ORD-XXXXXX</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="copyOrderInfo(activeModalOrder ? activeModalOrder.uuid : '')" class="px-3 py-1.5 bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 text-xs font-bold rounded-xl transition flex items-center space-x-1.5 shadow-2xs cursor-pointer" title="কুরিয়ার বা মেসেজের জন্য সম্পূর্ণ তথ্য কপি করুন">
                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                        <span>তথ্য কপি করুন</span>
                    </button>
                    <button type="button" onclick="printOrderInvoice()" class="px-3 py-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center space-x-1.5 shadow-2xs cursor-pointer">
                        <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                        <span>চালান প্রিন্ট</span>
                    </button>
                    <button type="button" onclick="closeOrderDetailsModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition cursor-pointer">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body (Printable Area) -->
            <div id="printableInvoiceArea" class="p-6 space-y-5 max-h-[78vh] overflow-y-auto">
                <!-- Status Changer Bar -->
                <div class="p-3.5 bg-amber-50/70 border border-amber-200/80 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 print:hidden">
                    <div class="flex items-center space-x-2">
                        <span class="text-xs font-bold text-slate-700">বর্তমান স্ট্যাটাস:</span>
                        <span id="modalCurrentStatusBadge" class="px-2.5 py-0.5 rounded-full text-xs font-extrabold"></span>
                    </div>
                    <div class="flex items-center space-x-2 w-full sm:w-auto">
                        <label class="text-xs font-semibold text-slate-600 whitespace-nowrap">স্ট্যাটাস পরিবর্তন:</label>
                        <select id="modalStatusSelect" onchange="changeOrderStatusFromModal()"
                            class="px-3 py-1.5 bg-white border border-slate-300 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-orange-500">
                            <option value="pending">🟡 পেন্ডিং (Pending)</option>
                            <option value="processing">🔵 প্রসেসিং (Processing)</option>
                            <option value="delivered">🟢 ডেলিভারি সম্পন্ন (Delivered)</option>
                            <option value="cancel">🔴 বাতিল (Cancel)</option>
                        </select>
                    </div>
                </div>

                <!-- Invoice Header for Print / Display -->
                <div class="flex justify-between items-start border-b border-slate-200 pb-4">
                    <div>
                        <h2 class="text-lg font-black text-slate-900" id="invStoreName"><?= htmlspecialchars($store['name']) ?></h2>
                        <p class="text-xs text-slate-500" id="invStoreAddress"><?= htmlspecialchars($store['address'] ?? '') ?></p>
                        <p class="text-xs text-slate-500 font-mono" id="invStorePhone"><?= htmlspecialchars($store['phone'] ?? '') ?></p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-black text-orange-600 tracking-wider uppercase">INVOICE / চালান</div>
                        <div class="text-xs font-mono font-bold text-slate-800 mt-0.5" id="invOrderNumber">ORD-0000</div>
                        <div class="text-[11px] text-slate-500 mt-0.5" id="invOrderDate">2026-11-11</div>
                    </div>
                </div>

                <!-- Customer & Delivery Information Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">গ্রাহকের তথ্য</div>
                        <div class="text-xs font-black text-slate-900" id="invCustomerName">Customer Name</div>
                        <div class="text-xs text-slate-600 font-mono mt-0.5" id="invCustomerPhone">017XXXXXXXX</div>
                        <div class="mt-2.5 flex items-center space-x-2 print:hidden" id="invCustomerActions">
                            <!-- Quick Call & WhatsApp -->
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">ডেলিভারি ঠিকানা ও জোন</div>
                        <div class="text-xs font-bold text-slate-800" id="invDeliveryZone">ঢাকার ভেতরে (৳৬০)</div>
                        <div class="text-xs text-slate-600 mt-0.5" id="invFullAddress">বিভাগ: ঢাকা, জেলা: ঢাকা...</div>
                        <div class="text-[11px] text-slate-500 mt-1" id="invPaymentMethod">পেমেন্ট: ক্যাশ অন ডেলিভারি (COD)</div>
                    </div>
                </div>

                <!-- Order Items Table -->
                <div>
                    <div class="text-xs font-bold text-slate-800 mb-2">অর্ডারকৃত পণ্য তালিকা</div>
                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead class="bg-slate-100 text-slate-600 font-bold border-b border-slate-200">
                                <tr>
                                    <th class="py-2.5 px-3">পণ্য</th>
                                    <th class="py-2.5 px-2 text-center">সাইজ ও কালার</th>
                                    <th class="py-2.5 px-2 text-right">মূল্য</th>
                                    <th class="py-2.5 px-2 text-center">পরিমাণ</th>
                                    <th class="py-2.5 px-3 text-right">মোট</th>
                                </tr>
                            </thead>
                            <tbody id="invItemsTableBody" class="divide-y divide-slate-100">
                                <!-- Populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Price Calculations Summary -->
                <div class="flex justify-end">
                    <div class="w-full sm:w-64 space-y-1.5 text-xs">
                        <div class="flex justify-between text-slate-600">
                            <span>সাব-টোটাল:</span>
                            <span class="font-bold text-slate-900" id="invSubtotal">৳০</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>ডেলিভারি চার্জ:</span>
                            <span class="font-bold text-slate-900" id="invDeliveryCharge">৳০</span>
                        </div>
                        <div class="border-t border-slate-200 pt-1.5 flex justify-between text-sm font-extrabold text-orange-600">
                            <span>সর্বমোট প্রদেয়:</span>
                            <span id="invTotalAmount">৳০</span>
                        </div>
                    </div>
                </div>

                <!-- Printable Footer Note -->
                <div class="pt-4 border-t border-slate-200 text-center text-[11px] text-slate-400">
                    আমাদের স্টোরে কেনাকাটার জন্য ধন্যবাদ! যে কোনো প্রয়োজনে যোগাযোগ করুন: <span id="invFooterPhone"><?= htmlspecialchars($store['phone'] ?? '') ?></span>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-3.5 bg-slate-50/80 border-t border-slate-200 flex items-center justify-between print:hidden">
                <button type="button" onclick="closeOrderDetailsModal()" class="px-4 py-2 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition shadow-2xs cursor-pointer">বন্ধ করুন</button>
                <button type="button" onclick="printOrderInvoice()" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                    <span>চালান প্রিন্ট করুন</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Set Special Discount Modal -->
    <div id="modalSetDiscount" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-md w-full shadow-2xl border border-slate-200 my-8 overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/70">
                <div class="flex items-center space-x-2.5">
                    <span class="w-8 h-8 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                        <i data-lucide="percent" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900" id="modalSetDiscountTitle">স্পেশাল ডিসকাউন্ট নির্ধারণ করুন</h3>
                        <p class="text-[11px] text-slate-500">পণ্য নির্বাচন করে ছাড়ের শতাংশ ও মেয়াদ সেট করুন</p>
                    </div>
                </div>
                <button type="button" onclick="closeSetDiscountModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition cursor-pointer">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="formSetDiscount" onsubmit="submitSetDiscount(event)" class="p-5 space-y-4 text-xs">
                <!-- 1. Product Selection -->
                <div class="space-y-1.5">
                    <label class="block font-bold text-slate-700">পণ্য নির্বাচন করুন <span class="text-red-500">*</span></label>
                    <select id="discProductUuid" onchange="onDiscountProductSelect()" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">-- পণ্য বেছে নিন --</option>
                    </select>
                </div>

                <!-- 2. Discount Percentage with Quick Chips -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="font-bold text-slate-700">ডিসকাউন্ট পারসেন্ট (%) <span class="text-red-500">*</span></label>
                        <span id="discPercentDisplay" class="text-xs font-black text-orange-600 font-mono">20%</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="number" id="discPercent" min="1" max="99" value="20" oninput="calcDiscountPreview()" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <span class="text-base font-bold text-slate-400">%</span>
                    </div>
                    <!-- Quick Percentage Chips -->
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" onclick="setQuickDiscPercent(10)" class="px-2.5 py-1 bg-slate-100 hover:bg-orange-50 hover:text-orange-600 rounded-lg text-[11px] font-bold text-slate-600 transition">10%</button>
                        <button type="button" onclick="setQuickDiscPercent(15)" class="px-2.5 py-1 bg-slate-100 hover:bg-orange-50 hover:text-orange-600 rounded-lg text-[11px] font-bold text-slate-600 transition">15%</button>
                        <button type="button" onclick="setQuickDiscPercent(20)" class="px-2.5 py-1 bg-slate-100 hover:bg-orange-50 hover:text-orange-600 rounded-lg text-[11px] font-bold text-slate-600 transition">20%</button>
                        <button type="button" onclick="setQuickDiscPercent(25)" class="px-2.5 py-1 bg-slate-100 hover:bg-orange-50 hover:text-orange-600 rounded-lg text-[11px] font-bold text-slate-600 transition">25%</button>
                        <button type="button" onclick="setQuickDiscPercent(30)" class="px-2.5 py-1 bg-slate-100 hover:bg-orange-50 hover:text-orange-600 rounded-lg text-[11px] font-bold text-slate-600 transition">30%</button>
                        <button type="button" onclick="setQuickDiscPercent(50)" class="px-2.5 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-[11px] font-bold transition">50%</button>
                    </div>
                </div>

                <!-- 3. Live Price Calculation Card -->
                <div class="p-3.5 bg-orange-50/60 border border-orange-200/80 rounded-2xl space-y-2">
                    <div class="text-[11px] font-bold text-orange-900 uppercase tracking-wider">হিসাব প্রিভিউ (Live Preview)</div>
                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div class="bg-white p-2 rounded-xl border border-orange-100 shadow-2xs">
                            <span class="text-[10px] text-slate-400 block">মূল দাম</span>
                            <span id="discPrevRegular" class="text-xs font-black text-slate-700 font-mono">৳ 0.00</span>
                        </div>
                        <div class="bg-white p-2 rounded-xl border border-orange-100 shadow-2xs">
                            <span class="text-[10px] text-slate-400 block">ছাড়ের পরিমাণ</span>
                            <span id="discPrevSavings" class="text-xs font-black text-red-600 font-mono">৳ 0.00</span>
                        </div>
                        <div class="bg-white p-2 rounded-xl border border-orange-200 shadow-2xs">
                            <span class="text-[10px] text-slate-400 block">নতুন বিক্রয়মূল্য</span>
                            <span id="discPrevFinal" class="text-xs font-black text-emerald-600 font-mono">৳ 0.00</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Discount Timing -->
                <div class="space-y-1.5">
                    <label class="block font-bold text-slate-700">অফারের মেয়াদ শেষ হওয়ার তারিখ ও সময় <span class="text-red-500">*</span></label>
                    <input type="datetime-local" id="discEndsAt" required class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 font-semibold focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <p class="text-[10px] text-slate-400">⏱️ অফারটি শুরু হবে: <strong>এই মুহূর্ত থেকেই</strong> (স্বয়ংক্রিয়)</p>
                </div>

                <!-- Footer Buttons -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                    <button type="button" onclick="closeSetDiscountModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition cursor-pointer">বাতিল</button>
                    <button type="submit" id="btnSaveDiscount" class="px-5 py-2.5 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white font-extrabold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>ডিসকাউন্ট সক্রিয় করুন</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Order Copy & Courier Entry Modal (One-by-One Copy) -->
    <div id="modalOrderQuickCopy" style="display: none;" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl border border-slate-200 my-8 overflow-hidden transform transition-all">
            <!-- Modal Header -->
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/70">
                <div class="flex items-center space-x-2.5">
                    <span class="w-8 h-8 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900">অর্ডার ও কুরিয়ার কপি তথ্য</h3>
                        <p class="text-[11px] text-slate-500 font-mono" id="qcopyOrderNumber">ORD-XXXXXX</p>
                    </div>
                </div>
                <button type="button" onclick="closeOrderCopyModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- Modal Body (One-by-one copy rows) -->
            <div class="p-5 space-y-3.5 max-h-[75vh] overflow-y-auto text-xs">
                
                <!-- Notice Bar -->
                <div class="p-2.5 bg-orange-50/70 border border-orange-200/80 rounded-xl text-[11px] text-orange-800 flex items-center justify-between gap-2">
                    <span>💡 কুরিয়ারে বুকিং করতে প্রতিটি তথ্য এক ক্লিকে আলাদাভাবে কপি করুন।</span>
                    <button type="button" onclick="copyOrderInfo(activeCopyOrder ? activeCopyOrder.uuid : '')" class="px-2.5 py-1 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-lg transition shrink-0 cursor-pointer shadow-2xs">সব তথ্য কপি</button>
                </div>

                <!-- 1. Customer Name -->
                <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center justify-between gap-2">
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">গ্রাহকের নাম</span>
                        <span class="text-xs font-bold text-slate-900 truncate block mt-0.5" id="qcopyCustomerName">-</span>
                    </div>
                    <button type="button" onclick="copyFieldText('#qcopyCustomerName', 'গ্রাহকের নাম')" class="px-3 py-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg font-bold flex items-center space-x-1 shadow-2xs transition shrink-0 cursor-pointer">
                        <i data-lucide="copy" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span>কপি</span>
                    </button>
                </div>

                <!-- 2. Customer Phone -->
                <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center justify-between gap-2">
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">মোবাইল নম্বর</span>
                        <span class="text-xs font-bold text-slate-900 font-mono block mt-0.5" id="qcopyCustomerPhone">-</span>
                    </div>
                    <div class="flex items-center space-x-1.5 shrink-0">
                        <a href="#" id="qcopyCallBtn" class="w-8 h-8 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center transition" title="কল করুন">
                            <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="#" id="qcopyWaBtn" target="_blank" class="w-8 h-8 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center transition" title="WhatsApp">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        </a>
                        <button type="button" onclick="copyFieldText('#qcopyCustomerPhone', 'মোবাইল নম্বর')" class="px-3 py-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg font-bold flex items-center space-x-1 shadow-2xs transition cursor-pointer">
                            <i data-lucide="copy" class="w-3.5 h-3.5 text-slate-500"></i>
                            <span>কপি</span>
                        </button>
                    </div>
                </div>

                <!-- 3. Delivery Address -->
                <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-start justify-between gap-2">
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">ডেলিভারি ঠিকানা</span>
                        <span class="text-xs font-semibold text-slate-800 block mt-0.5 leading-relaxed" id="qcopyAddress">-</span>
                    </div>
                    <button type="button" onclick="copyFieldText('#qcopyAddress', 'ডেলিভারি ঠিকানা')" class="px-3 py-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg font-bold flex items-center space-x-1 shadow-2xs transition shrink-0 cursor-pointer mt-1">
                        <i data-lucide="copy" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span>কপি</span>
                    </button>
                </div>

                <!-- 4. Area / Upazilla / District Grid -->
                <div class="grid grid-cols-2 gap-2">
                    <div class="p-2.5 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center justify-between gap-1.5">
                        <div class="min-w-0 flex-1">
                            <span class="text-[9px] font-bold text-slate-400 uppercase block">থানা / উপজেলা</span>
                            <span class="text-xs font-bold text-slate-800 truncate block" id="qcopyUpazilla">-</span>
                        </div>
                        <button type="button" onclick="copyFieldText('#qcopyUpazilla', 'থানা/উপজেলা')" class="p-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-600 rounded-lg transition shrink-0 cursor-pointer" title="কপি করুন">
                            <i data-lucide="copy" class="w-3 h-3"></i>
                        </button>
                    </div>
                    <div class="p-2.5 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center justify-between gap-1.5">
                        <div class="min-w-0 flex-1">
                            <span class="text-[9px] font-bold text-slate-400 uppercase block">জেলা</span>
                            <span class="text-xs font-bold text-slate-800 truncate block" id="qcopyDistrict">-</span>
                        </div>
                        <button type="button" onclick="copyFieldText('#qcopyDistrict', 'জেলা')" class="p-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-600 rounded-lg transition shrink-0 cursor-pointer" title="কপি করুন">
                            <i data-lucide="copy" class="w-3 h-3"></i>
                        </button>
                    </div>
                </div>

                <!-- 5. COD Collection Amount (Courier Pure Amount) -->
                <div class="p-3 bg-amber-50/60 border border-amber-200/80 rounded-xl flex items-center justify-between gap-2">
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">কুরিয়ার কালেকশন এমাউন্ট (COD Amount)</span>
                        <div class="flex items-center space-x-2 mt-0.5">
                            <span class="text-sm font-black text-amber-800 font-mono" id="qcopyCodDisplay">৳০</span>
                            <span class="text-[10px] text-amber-600 font-mono" id="qcopyCodRaw" style="display:none;">0</span>
                        </div>
                    </div>
                    <button type="button" onclick="copyPureCodAmount()" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-700 text-white rounded-lg font-bold flex items-center space-x-1 shadow-2xs transition shrink-0 cursor-pointer" title="কুরিয়ার পোর্টালে সরাসরি পেস্ট করতে সংখ্যাটি কপি করুন">
                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                        <span>টাকা কপি</span>
                    </button>
                </div>

                <!-- 6. Products / Item List Summary -->
                <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-start justify-between gap-2">
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">অর্ডারের পণ্যসমূহ (পার্সেল নোট)</span>
                        <span class="text-xs font-medium text-slate-700 block mt-0.5 whitespace-pre-line leading-relaxed font-mono" id="qcopyItemsSummary">-</span>
                    </div>
                    <button type="button" onclick="copyFieldText('#qcopyItemsSummary', 'পণ্যের বিবরণ')" class="px-3 py-1.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg font-bold flex items-center space-x-1 shadow-2xs transition shrink-0 cursor-pointer mt-1">
                        <i data-lucide="copy" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span>কপি</span>
                    </button>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-200 flex items-center justify-between gap-2">
                <button type="button" onclick="closeOrderCopyModal()" class="px-3.5 py-2 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition shadow-2xs cursor-pointer">বন্ধ করুন</button>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="openInvoiceFromCopyModal()" class="px-3.5 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                        <span>চালান দেখুন</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
            <div>
                &copy; <?= date('Y') ?> <strong class="text-slate-700" id="footStoreName"><?= htmlspecialchars($store['name']) ?></strong> &bull; Client Storefront Dashboard
            </div>
            <div class="flex items-center space-x-3 text-slate-400">
                <span data-i18n="footTenantSaas">হেডলেস মাল্টি-টেন্যান্ট ই-কমার্স সিস্টেম</span>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        const STORE_UUID = "<?= htmlspecialchars(ApiClient::getStoreUuid()) ?>";
        const API_URL    = "<?= htmlspecialchars(ApiClient::getApiUrl()) ?>";
        const ASSET_URL  = "<?= htmlspecialchars(ApiClient::getMotherRootUrl()) ?>";
        const STORE_BKASH_NUMBER = "<?= htmlspecialchars($storeBkashNumber ?? ApiClient::getBkashNumber()) ?>";

        StoreApi.init({
            apiUrl: API_URL,
            storeUuid: STORE_UUID
        });

        // 1. Guard check: Ensure token is present
        const token = StoreApi.getToken();
        if (!token) {
            window.location.href = 'login.php';
        }

        let storeData = <?= json_encode($store, JSON_UNESCAPED_UNICODE) ?>;
        let productsData = [];
        let categoriesData = [];
        let defaultCategoryUuid = '';
        let recentlyRestocked = {}; // Tracks restocked items in current session: { [uuid]: { added: number, total: number } }
        let selectedCatImageFile = null;
        let existingCatImageUrl = '';
        let existingImages = []; // List of image URLs
        let selectedNewFiles = []; // Array of File objects selected for upload

        // ==========================================
        // REUSABLE BENGALI & PAGINATION UTILITIES
        // ==========================================
        function toBnDigit(num) {
            const bnDigits = {'0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'};
            return (num !== null && num !== undefined) ? num.toString().replace(/\d/g, d => bnDigits[d]) : '০';
        }

        // Pagination State Variables
        let ordersCurrentPage = 1;
        const ordersPerPage = 8;
        let productsCurrentPage = 1;
        const productsPerPage = 12;
        let cancelledOrdersCurrentPage = 1;
        const cancelledOrdersPerPage = 8;
        let completedOrdersCurrentPage = 1;
        const completedOrdersPerPage = 8;
        let discountsCurrentPage = 1;
        const discountsPerPage = 6;

        function scrollToSectionTop(selector) {
            const $target = $(selector);
            if ($target.length) {
                const top = $target.offset().top - 80;
                $('html, body').animate({ scrollTop: Math.max(0, top) }, 250);
            }
        }

        function renderGenericPagination({
            containerId,
            summaryId,
            buttonsId,
            currentPage,
            totalItems,
            perPage,
            itemLabel,
            onPageChangeFn,
            activeColorClass = 'bg-slate-900 text-white'
        }) {
            const $container = $(`#${containerId}`);
            const $summary = $(`#${summaryId}`);
            const $buttons = $(`#${buttonsId}`);

            if (!totalItems || totalItems <= 0) {
                $container.addClass('hidden');
                $buttons.empty();
                return;
            }

            $container.removeClass('hidden');

            const totalPages = Math.ceil(totalItems / perPage);
            const validCurrentPage = Math.min(Math.max(1, currentPage), totalPages);
            const startIndex = (validCurrentPage - 1) * perPage;
            const endIndex = Math.min(startIndex + perPage, totalItems);

            $summary.html(`<span class="font-bold text-slate-700">${toBnDigit(startIndex + 1)}</span> থেকে <span class="font-bold text-slate-700">${toBnDigit(endIndex)}</span> (মোট <span class="font-bold text-slate-900">${toBnDigit(totalItems)}</span>টি ${itemLabel})`);

            $buttons.empty();
            if (totalPages <= 1) {
                return;
            }

            // Previous Button
            const prevDisabled = validCurrentPage <= 1;
            $buttons.append(`
                <button type="button" onclick="${onPageChangeFn}(${validCurrentPage - 1})" ${prevDisabled ? 'disabled' : ''}
                    class="px-2.5 py-1 text-xs font-bold rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed shadow-2xs">
                    ‹ পূর্ববর্তী
                </button>
            `);

            // Smart Sliding Window (up to 5 page numbers)
            let startPage = Math.max(1, validCurrentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            if (startPage > 1) {
                $buttons.append(`
                    <button type="button" onclick="${onPageChangeFn}(1)"
                        class="w-7 h-7 text-xs font-bold rounded-xl transition cursor-pointer flex items-center justify-center border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-2xs">
                        ${toBnDigit(1)}
                    </button>
                `);
                if (startPage > 2) {
                    $buttons.append(`<span class="px-1 text-xs text-slate-400">...</span>`);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                const isActive = (i === validCurrentPage);
                $buttons.append(`
                    <button type="button" onclick="${onPageChangeFn}(${i})"
                        class="w-7 h-7 text-xs font-bold rounded-xl transition cursor-pointer flex items-center justify-center ${isActive ? `${activeColorClass} shadow-2xs` : 'border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-2xs'}">
                        ${toBnDigit(i)}
                    </button>
                `);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    $buttons.append(`<span class="px-1 text-xs text-slate-400">...</span>`);
                }
                $buttons.append(`
                    <button type="button" onclick="${onPageChangeFn}(${totalPages})"
                        class="w-7 h-7 text-xs font-bold rounded-xl transition cursor-pointer flex items-center justify-center border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-2xs">
                        ${toBnDigit(totalPages)}
                    </button>
                `);
            }

            // Next Button
            const nextDisabled = validCurrentPage >= totalPages;
            $buttons.append(`
                <button type="button" onclick="${onPageChangeFn}(${validCurrentPage + 1})" ${nextDisabled ? 'disabled' : ''}
                    class="px-2.5 py-1 text-xs font-bold rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed shadow-2xs">
                    পরবর্তী ›
                </button>
            `);
        }

        // Section Specific Page Change Handlers
        function changeOrdersPage(page) {
            ordersCurrentPage = page;
            renderOrders(ordersData);
            scrollToSectionTop('#tabContentOrders');
        }

        function changeProductsPage(page) {
            productsCurrentPage = page;
            renderProducts(productsData);
            scrollToSectionTop('#tabContentProducts');
        }

        function changeCancelledOrdersPage(page) {
            cancelledOrdersCurrentPage = page;
            renderCancelledOrders(ordersData);
            scrollToSectionTop('#tabContentCancelledOrders');
        }

        function changeCompletedOrdersPage(page) {
            completedOrdersCurrentPage = page;
            renderCompletedOrders(ordersData);
            scrollToSectionTop('#tabContentCompletedOrders');
        }

        function changeDiscountsPage(page) {
            discountsCurrentPage = page;
            renderDiscountsTable(productsData);
            scrollToSectionTop('#tabContentDiscounts');
        }

        // 2. Bilingual Dictionary
        const i18n = {
            bn: {
                pageTitle: 'অ্যাডমিন ড্যাশবোর্ড | ' + "<?= addslashes($store['name']) ?>",
                badgeStoreAdmin: 'ক্লায়েন্ট অ্যাডমিন প্যানেল',
                btnVisitStore: 'স্টোরফ্রন্ট দেখুন',
                tabDashboard: 'ড্যাশবোর্ড (Dashboard)',
                tabOrders: 'অর্ডার ব্যবস্থাপনা (Order Management)',
                tabAllOrders: 'সকল অর্ডার (All Orders)',
                tabProducts: 'প্রোডাক্ট ও ইনভেন্টরি',
                tabDesignWebsite: 'ওয়েবসাইট ডিজাইন (Design Website)',
                tabPayments: 'পেমেন্ট ও বিলিং (Payments)',
                tabUploadBanner: 'ব্যানার আপলোড (Upload Banner)',
                navMoreMenu: 'অন্যান্য মেনু ও সেটিংস',
                tabCompletedOrders: 'সম্পন্ন অর্ডার ও হিসাব',
                tabCancelledOrders: 'বাতিল অর্ডার (Trash)',
                tabCategories: 'ক্যাটাগরি (Category)',
                tabStockOut: 'স্টক আউট (Stock Out)',
                tabUserInfo: 'ইউজার তথ্য ও স্টোর সেটিংস',
                categoryTitle: 'ক্যাটাগরি ব্যবস্থাপনা (Categories)',
                categorySubtitle: 'পণ্য সুশৃঙ্খলভাবে সাজানোর জন্য ক্যাটাগরি তৈরি ও পরিচালনা করুন। "Unnamed" ডিফল্ট ক্যাটাগরি হিসেবে থাকবে।',
                stockOutTitle: 'স্টক আউট প্রোডাক্ট (Stock Out)',
                stockOutSubtitle: 'যেসব পণ্যের স্টক শেষ বা ০ হয়ে গেছে। নির্দিষ্ট পরিমাণ লিখে "স্টক যোগ করুন" বাটনে ক্লিক করে ইনভেন্টরি বাড়ান।',
                noStockOutFound: 'কোনো স্টক আউট প্রোডাক্ট নেই! আপনার স্টোরের সব পণ্য স্টকে রয়েছে।',
                statusLive: 'স্টোরফ্রন্ট সক্রিয় ও লাইভ',
                lblStoreId: 'স্টোর আইডি:',
                helloWorldBadge: 'হ্যালো ওয়ার্ল্ড! স্বাগতম',
                welcomeMsg: 'স্বাগতম,',
                welcomeSub: 'এটি আপনার স্টোরফ্রন্টের কেন্দ্রীয় অ্যাডমিন ড্যাশবোর্ড। এখান থেকে আপনি স্টোরের প্রোডাক্ট আপলোড, ইনভেন্টরি স্টক এবং কেনা-বেচার লাভ পরিচালনা করতে পারবেন।',
                btnAddProductQuick: 'প্রোডাক্ট যোগ করুন',
                btnViewLive: 'ওয়েবসাইট দেখুন',
                statTotalProducts: 'মোট প্রোডাক্ট',
                statActiveInCatalog: 'ক্যাটালগে প্রদর্শিত',
                statTotalStock: 'মোট ইনভেন্টরি স্টক',
                statStockUnits: 'উপলব্ধ আইটেম/ইউনিট',
                statEstimatedProfit: 'সম্ভাব্য মুনাফা',
                statProfitFormula: '(বিক্রয় - কেনা দাম) × স্টক',
                cardStatus: 'স্টোর স্ট্যাটাস',
                statusActive: 'সক্রিয় (Active)',
                statusSub: 'মাদার কন্ট্রোল দ্বারা অনুমোদিত',
                socialOverviewTitle: 'সংযুক্ত সোশ্যাল মিডিয়া চ্যানেলসমূহ',
                socialOverviewSub: 'আপনার স্টোরফ্রন্টের উপরের বারে এই লিংকগুলো গ্রাহকদের নিকট প্রদর্শিত হয়।',
                btnManageSocial: 'পরিবর্তন করুন →',
                productsTitle: 'প্রোডাক্ট ও ইনভেন্টরি স্টক',
                productsSubtitle: 'নতুন প্রোডাক্ট আপলোড করুন, ২০০KB কম্প্রেসড ইমেজ সংরক্ষণ করুন এবং ইনভেন্টরি স্টক নিয়ন্ত্রণ করুন।',
                btnAddProduct: 'নতুন প্রোডাক্ট যোগ করুন',
                optAllProducts: 'সকল প্রোডাক্ট',
                thProductItem: 'প্রোডাক্ট ও ছবি',
                thMainPrice: 'কেনা দাম (Main)',
                thRetailerPrice: 'বিক্রয় মূল্য (Retailer)',
                thProfitUnit: 'লাভ / ইউনিট',
                thStock: 'ইনভেন্টরি স্টক',
                thVariants: 'সাইজ ও রঙ',
                thStatus: 'স্ট্যাটাস',
                thActions: 'অ্যাকশন',
                loading: 'লোড হচ্ছে...',
                noProductsFound: 'কোনো প্রোডাক্ট পাওয়া যায়নি। নতুন পণ্য যুক্ত করতে "নতুন প্রোডাক্ট যোগ করুন" বাটনে ক্লিক করুন।',
                modalAddProdTitle: 'নতুন প্রোডাক্ট যোগ করুন',
                modalEditProdTitle: 'প্রোডাক্ট সম্পাদনা: ',
                modalAddProdSub: 'ইমেজ সর্বোচ্চ ২০০KB-তে অপটিমাইজ হয়ে মাদার এপিআই-তে সংরক্ষিত হবে।',
                modalProdName: 'প্রোডাক্টের নাম (Product Name) *',
                modalProdSlug: 'ইউনিক স্ল্যাগ (URL Slug) *',
                titlePricingSection: 'মূল্য ও লাভ নির্ধারণ (Pricing & Profit Calculation)',
                lblMainCostPrice: 'মেইন বা কেনা দাম (Cost / Wholesale) *',
                hintMainPrice: 'স্টোরফ্রন্ট যে দামে সংগ্রহ করেছে',
                lblRetailerSellingPrice: 'বিক্রয় মূল্য (Retailer Selling Price) *',
                hintRetailerPrice: 'গ্রাহক ওয়েবসাইটে যে দামে ক্রয় করবে',
                lblProfitPerUnit: 'প্রতি ইউনিটে লাভ (Profit):',
                lblStockQty: 'ইনভেন্টরি স্টক (Stock Quantity) *',
                hintStock: 'প্রতিটি বিক্রয়ে এই সংখ্যা থেকে অটোমেটিক স্টক মাইনাস হবে।',
                lblStatus: 'প্রোডাক্ট স্ট্যাটাস (Status)',
                optActive: 'সক্রিয় (Active - শপে প্রদর্শিত হবে)',
                optInactive: 'নিষ্ক্রিয় (Inactive - লুকানো থাকবে)',
                lblSizes: 'সাইজসমূহ (Sizes)',
                lblColors: 'রঙসমূহ (Colors)',
                lblDescription: 'পণ্যের বিবরণ (Description)',
                lblProductImages: 'প্রোডাক্টের ছবিসমূহ (সর্বোচ্চ ৫টি ছবি)',
                lblAutoCompressBadge: '⚡ স্বয়ংক্রিয় ২০০KB অপটিমাইজেশন',
                dropzonePrompt: 'ছবি আপলোড করতে ক্লিক করুন (বা ড্র্যাগ করুন)',
                dropzoneHelp: 'PNG, JPG, WebP ইত্যাদি (যেকোনো সাইজের ছবি স্বয়ংক্রিয়ভাবে ২০০KB-তে কম্প্রেস হবে)',
                btnCancel: 'বাতিল',
                btnSaveProduct: 'প্রোডাক্ট সংরক্ষণ করুন',
                savingProduct: 'সংরক্ষণ ও ইমেজ প্রসেসিং হচ্ছে...',
                userProfileTitle: 'ইউজার তথ্য ও স্টোর সেটিংস',
                userProfileSub: 'আপনার স্টোরের নাম, স্ল্যাগ, যোগাযোগের ঠিকানা ও সোশ্যাল মিডিয়া প্রোফাইল লিংক আপডেট করুন।',
                fieldStoreName: 'স্টোরের নাম (Store Name) *',
                fieldStoreSlug: 'ইউনিক স্টোর স্ল্যাগ (Store Slug) *',
                fieldOwnerName: 'স্বত্বাধিকারীর নাম (Owner Name)',
                fieldOwnerEmail: 'অ্যাকাউন্ট ইমেইল (Login Email)',
                hintManagedByMother: 'মাদার প্ল্যাটফর্ম দ্বারা নিয়ন্ত্রিত',
                fieldPhone: 'ফোন নম্বর (Phone Number)',
                fieldPassword: 'পাসওয়ার্ড পরিবর্তন (নতুন পাসওয়ার্ড)',
                fieldAddress: 'স্টোর বা অফিসের ঠিকানা (Address)',
                titleSocialSection: 'সোশ্যাল মিডিয়া লিংকসমূহ (Social Media Links)',
                lblFacebook: 'ফেসবুক পেজ (Facebook URL)',
                lblInstagram: 'ইনস্টাগ্রাম (Instagram URL)',
                lblWhatsapp: 'হোয়াটসঅ্যাপ (WhatsApp Number/Link)',
                lblYoutube: 'ইউটিউব চ্যানেল (YouTube Channel)',
                btnSaveProfile: 'পরিবর্তন সংরক্ষণ করুন',
                savingText: 'সংরক্ষণ করা হচ্ছে...',
                saveSuccessTitle: 'সফলভাবে সংরক্ষিত!',
                saveSuccessText: 'আপনার স্টোরের তথ্য সফলভাবে আপডেট হয়েছে।',
                confirmLogoutTitle: 'আপনি কি লগআউট করতে চান?',
                confirmLogoutBtn: 'হ্যাঁ, লগআউট করুন',
                cancelLogoutBtn: 'না',
                footTenantSaas: 'হেডলেস মাল্টি-টেন্যান্ট ই-কমার্স সিস্টেম',
                connected: 'যুক্ত আছে',
                notConnected: 'যুক্ত নেই',
                inStock: 'স্টকে আছে',
                outOfStock: 'স্টক শেষ',
                confirmDeleteProd: 'আপনি কি নিশ্চিত এই প্রোডাক্টটি মুছে ফেলতে চান?',
                deleteBtn: 'হ্যাঁ, ডিলিট করুন'
            },
            en: {
                pageTitle: 'Admin Dashboard | ' + "<?= addslashes($store['name']) ?>",
                badgeStoreAdmin: 'Client Admin Portal',
                btnVisitStore: 'View Storefront',
                tabDashboard: 'Dashboard',
                tabOrders: 'Order Management',
                tabAllOrders: 'All Orders',
                tabProducts: 'Products & Inventory',
                tabDesignWebsite: 'Design Website',
                tabPayments: 'SaaS Billing & Payments',
                tabUploadBanner: 'Upload Banner',
                navMoreMenu: 'More Menus & Settings',
                tabCompletedOrders: 'Completed Orders & Accounts',
                tabCancelledOrders: 'Cancelled Orders (Trash)',
                tabCategories: 'Categories',
                tabStockOut: 'Stock Out',
                tabUserInfo: 'User Info & Store Profile',
                categoryTitle: 'Category Management',
                categorySubtitle: 'Organize products with custom categories and cover images. "Unnamed" is default.',
                stockOutTitle: 'Stock Out Products',
                stockOutSubtitle: 'Products with 0 stock. Enter the quantity you want to restock and click "Add Stock".',
                noStockOutFound: 'No stock out products! All store items are currently available in stock.',
                statusLive: 'Storefront Active & Live',
                lblStoreId: 'Store UUID:',
                helloWorldBadge: 'Hello World! Welcome',
                welcomeMsg: 'Welcome,',
                welcomeSub: 'This is the central admin dashboard for your storefront. From here, you can easily manage products, stock inventory, and profits.',
                btnAddProductQuick: 'Add Product',
                btnViewLive: 'View Live Site',
                statTotalProducts: 'Total Products',
                statActiveInCatalog: 'Active in Catalog',
                statTotalStock: 'Total Stock Inventory',
                statStockUnits: 'Available Items/Units',
                statEstimatedProfit: 'Profit Potential',
                statProfitFormula: '(Retail - Cost) × Stock',
                cardStatus: 'Store Status',
                statusActive: 'Active',
                statusSub: 'Approved by Mother Control',
                socialOverviewTitle: 'Connected Social Media Channels',
                socialOverviewSub: 'These links are displayed to visitors in the top navigation bar of your storefront.',
                btnManageSocial: 'Manage Links →',
                productsTitle: 'Products & Stock Inventory',
                productsSubtitle: 'Upload products, store auto-compressed ~200KB images, and manage real-time inventory.',
                btnAddProduct: 'Add New Product',
                optAllProducts: 'All Products',
                thProductItem: 'Product & Image',
                thMainPrice: 'Cost Price (Main)',
                thRetailerPrice: 'Selling Price (Retailer)',
                thProfitUnit: 'Profit / Unit',
                thStock: 'Stock Inventory',
                thVariants: 'Sizes & Colors',
                thStatus: 'Status',
                thActions: 'Actions',
                loading: 'Loading...',
                noProductsFound: 'No products found. Click "Add New Product" to create your first item.',
                modalAddProdTitle: 'Add New Product',
                modalEditProdTitle: 'Edit Product: ',
                modalAddProdSub: 'Images are automatically compressed to ~200KB and stored on Mother API.',
                modalProdName: 'Product Name *',
                modalProdSlug: 'Product Slug (URL) *',
                titlePricingSection: 'Pricing & Profit Calculation',
                lblMainCostPrice: 'Main / Cost Price (Wholesale) *',
                hintMainPrice: 'Purchase cost paid by storefront',
                lblRetailerSellingPrice: 'Retailer Selling Price *',
                hintRetailerPrice: 'Customer price on website and cart',
                lblProfitPerUnit: 'Profit per Unit:',
                lblStockQty: 'Inventory Stock Quantity *',
                hintStock: 'Each sale automatically deducts from this stock.',
                lblStatus: 'Product Status',
                optActive: 'Active (Visible on shop)',
                optInactive: 'Inactive (Hidden from shop)',
                lblSizes: 'Sizes',
                lblColors: 'Colors',
                lblDescription: 'Description',
                lblProductImages: 'Product Images (Max 5 Images)',
                lblAutoCompressBadge: '⚡ Auto ~200KB Optimization',
                dropzonePrompt: 'Click or drag images to upload',
                dropzoneHelp: 'PNG, JPG, WebP (Images of any size automatically compressed to ~200KB)',
                btnCancel: 'Cancel',
                btnSaveProduct: 'Save Product',
                savingProduct: 'Saving & Compressing Images...',
                userProfileTitle: 'User Info & Store Profile Settings',
                userProfileSub: 'Update your store name, URL slug, contact details, and social media profile links.',
                fieldStoreName: 'Store Name *',
                fieldStoreSlug: 'Unique Store Slug *',
                fieldOwnerName: 'Owner Name',
                fieldOwnerEmail: 'Account Email (Login)',
                hintManagedByMother: 'Managed by Mother platform',
                fieldPhone: 'Phone Number',
                fieldPassword: 'Change Password (New Password)',
                fieldAddress: 'Store or Office Address',
                titleSocialSection: 'Social Media Links',
                lblFacebook: 'Facebook Page URL',
                lblInstagram: 'Instagram URL',
                lblWhatsapp: 'WhatsApp Number/Link',
                lblYoutube: 'YouTube Channel URL',
                btnSaveProfile: 'Save Changes',
                savingText: 'Saving Changes...',
                saveSuccessTitle: 'Successfully Saved!',
                saveSuccessText: 'Your store profile information has been updated.',
                confirmLogoutTitle: 'Are you sure you want to log out?',
                confirmLogoutBtn: 'Yes, Log Out',
                cancelLogoutBtn: 'Cancel',
                footTenantSaas: 'Headless Multi-Tenant SaaS E-commerce',
                connected: 'Linked',
                notConnected: 'Not Linked',
                inStock: 'In Stock',
                outOfStock: 'Out of Stock',
                confirmDeleteProd: 'Are you sure you want to delete this product?',
                deleteBtn: 'Yes, Delete'
            }
        };

        let currentLang = localStorage.getItem('client_lang') || 'bn';

        function switchLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('client_lang', lang);

            if (lang === 'bn') {
                $('#langBn').addClass('bg-white shadow-xs font-bold text-brand-600').removeClass('text-slate-600');
                $('#langEn').removeClass('bg-white shadow-xs font-bold text-brand-600').addClass('text-slate-600');
            } else {
                $('#langEn').addClass('bg-white shadow-xs font-bold text-brand-600').removeClass('text-slate-600');
                $('#langBn').removeClass('bg-white shadow-xs font-bold text-brand-600').addClass('text-slate-600');
            }

            $('[data-i18n]').each(function() {
                const key = $(this).attr('data-i18n');
                if (i18n[lang][key]) {
                    $(this).text(i18n[lang][key]);
                }
            });

            document.title = i18n[lang].pageTitle;
            renderSocialOverview(storeData.social_links || {});
            renderProducts(productsData);
            renderStockOutProducts(productsData);
        }

        // 2.3 Smooth Loader & Toast Helpers
        function showTopLoader() {
            const bar = $('#topLoadingBar');
            bar.removeClass('opacity-0').css('width', '35%');
            setTimeout(() => bar.css('width', '75%'), 120);
        }

        function hideTopLoader() {
            const bar = $('#topLoadingBar');
            bar.css('width', '100%');
            setTimeout(() => {
                bar.addClass('opacity-0');
                setTimeout(() => bar.css('width', '0%'), 250);
            }, 180);
        }

        function showToast(message, type = 'success') {
            const bgGradients = {
                success: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                info: 'linear-gradient(135deg, #ea580c 0%, #c2410c 100%)',
                error: 'linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)',
                warning: 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'
            };
            if (window.Toastify) {
                Toastify({
                    text: message,
                    duration: 2500,
                    gravity: 'bottom',
                    position: 'right',
                    stopOnFocus: true,
                    style: {
                        background: bgGradients[type] || bgGradients.success,
                        borderRadius: '12px',
                        fontSize: '12px',
                        fontWeight: '700',
                        boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.15)',
                        padding: '10px 18px',
                        letterSpacing: '0.01em'
                    }
                }).showToast();
            }
        }

        // 2.4 Skeleton Loaders
        function renderOrderSkeletons(containerId, count = 3) {
            let html = '';
            for (let i = 0; i < count; i++) {
                html += `
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-xs skeleton-shimmer space-y-3">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-200"></div>
                                <div class="space-y-1.5">
                                    <div class="w-28 h-3.5 bg-slate-200 rounded"></div>
                                    <div class="w-20 h-2.5 bg-slate-100 rounded"></div>
                                </div>
                            </div>
                            <div class="w-24 h-7 bg-slate-200 rounded-xl"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 p-3 bg-slate-50 rounded-xl">
                            <div class="space-y-1.5">
                                <div class="w-12 h-2 bg-slate-200 rounded"></div>
                                <div class="w-28 h-3 bg-slate-200 rounded"></div>
                            </div>
                            <div class="space-y-1.5">
                                <div class="w-16 h-2 bg-slate-200 rounded"></div>
                                <div class="w-36 h-3 bg-slate-200 rounded"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                            <div class="w-32 h-3.5 bg-slate-200 rounded"></div>
                            <div class="w-28 h-7 bg-slate-200 rounded-xl"></div>
                        </div>
                    </div>
                `;
            }
            $('#' + containerId).html(html);
        }

        function renderProductTableSkeletons(count = 5) {
            let rows = '';
            for (let i = 0; i < count; i++) {
                rows += `
                    <tr class="skeleton-shimmer border-b border-slate-100">
                        <td class="p-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-slate-200 rounded-xl shrink-0"></div>
                                <div class="space-y-2">
                                    <div class="w-32 h-3 bg-slate-200 rounded"></div>
                                    <div class="w-20 h-2 bg-slate-100 rounded"></div>
                                </div>
                            </div>
                        </td>
                        <td class="p-3"><div class="w-16 h-3 bg-slate-200 rounded mx-auto"></div></td>
                        <td class="p-3"><div class="w-16 h-3 bg-slate-200 rounded mx-auto"></div></td>
                        <td class="p-3"><div class="w-14 h-3 bg-slate-200 rounded mx-auto"></div></td>
                        <td class="p-3"><div class="w-12 h-3 bg-slate-200 rounded mx-auto"></div></td>
                        <td class="p-3"><div class="w-14 h-4 bg-slate-200 rounded-full mx-auto"></div></td>
                        <td class="p-3"><div class="w-14 h-5 bg-slate-200 rounded-full mx-auto"></div></td>
                        <td class="p-3"><div class="w-20 h-7 bg-slate-200 rounded-xl mx-auto"></div></td>
                    </tr>
                `;
            }
            $('#productsTableBody').html(rows);
        }

        function renderCategorySkeletons(count = 4) {
            let cards = '';
            for (let i = 0; i < count; i++) {
                cards += `
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 skeleton-shimmer space-y-3">
                        <div class="w-full h-24 bg-slate-200 rounded-xl"></div>
                        <div class="w-24 h-3.5 bg-slate-200 rounded"></div>
                        <div class="w-16 h-2.5 bg-slate-100 rounded"></div>
                    </div>
                `;
            }
            $('#categoryListGrid').html(cards);
        }

        function renderDeliveryChargeSkeletons(count = 3) {
            let rows = '';
            for (let i = 0; i < count; i++) {
                rows += `
                    <tr class="skeleton-shimmer border-b border-slate-100">
                        <td class="p-3.5"><div class="w-32 h-3.5 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-20 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-16 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-14 h-5 bg-slate-200 rounded-full"></div></td>
                        <td class="p-3.5"><div class="w-12 h-6 bg-slate-200 rounded-lg"></div></td>
                    </tr>
                `;
            }
            $('#deliveryChargesTableBody').html(rows);
        }

        function renderDiscountSkeletons(count = 4) {
            let rows = '';
            for (let i = 0; i < count; i++) {
                rows += `
                    <tr class="skeleton-shimmer border-b border-slate-100">
                        <td class="p-3.5"><div class="w-36 h-3.5 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-20 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-16 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-28 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3.5"><div class="w-14 h-6 bg-slate-200 rounded-lg"></div></td>
                    </tr>
                `;
            }
            $('#discountsTableBody').html(rows);
        }

        function renderPaymentHistorySkeletons(count = 3) {
            let rows = '';
            for (let i = 0; i < count; i++) {
                rows += `
                    <tr class="skeleton-shimmer border-b border-slate-100">
                        <td class="p-3"><div class="w-24 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3"><div class="w-28 h-3.5 bg-slate-200 rounded"></div></td>
                        <td class="p-3"><div class="w-16 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3"><div class="w-16 h-3 bg-slate-200 rounded"></div></td>
                        <td class="p-3"><div class="w-16 h-5 bg-slate-200 rounded-full"></div></td>
                        <td class="p-3"><div class="w-20 h-3 bg-slate-200 rounded"></div></td>
                    </tr>
                `;
            }
            $('#saasPaymentHistorySection table tbody').html(rows);
        }

        // 2.5 Collapsible Navigation Handler
        function toggleCollapsibleNav(forceOpen = null) {
            const container = $('#collapsibleNavLinks');
            const chevron = $('#collapsibleNavChevron');
            const shouldOpen = forceOpen !== null ? forceOpen : container.hasClass('hidden');
            
            if (shouldOpen) {
                container.removeClass('hidden');
                chevron.addClass('rotate-180');
            } else {
                container.addClass('hidden');
                chevron.removeClass('rotate-180');
            }
            if (window.lucide) {
                lucide.createIcons();
            }
        }

        // 3. Tab Switching with Skeleton Loading, Smooth Fade and Top Loader
        function switchTab(tab) {
            showTopLoader();
            const tabs = ['dashboard', 'orders', 'products', 'productCreate', 'designWebsite', 'payments', 'discounts', 'completedOrders', 'cancelledOrders', 'categories', 'stockOut', 'stockManagement', 'userInfo', 'deliveryCharges', 'uploadBanner'];

            // Auto-expand collapsible navigation group if needed
            if (['discounts', 'completedOrders', 'cancelledOrders', 'categories', 'stockOut', 'stockManagement', 'userInfo', 'deliveryCharges', 'uploadBanner'].includes(tab)) {
                toggleCollapsibleNav(true);
            }

            // Immediately update sidebar active button highlight
            tabs.forEach(t => {
                const navBtn = $('#navTab' + t.charAt(0).toUpperCase() + t.slice(1));
                if (t === tab || (tab === 'productCreate' && t === 'products')) {
                    navBtn.addClass('text-brand-600 bg-brand-50 border border-brand-200/50').removeClass('text-slate-600 hover:text-slate-900 hover:bg-slate-50');
                } else {
                    navBtn.removeClass('text-brand-600 bg-brand-50 border border-brand-200/50').addClass('text-slate-600 hover:text-slate-900 hover:bg-slate-50');
                }
            });

            // Update mobile bottom nav & slide-over drawer active states (mobile only)
            if (typeof window.updateMobileNavActive === 'function') {
                window.updateMobileNavActive(tab);
            }

            // Hide all tab contents and show shimmer skeleton
            tabs.forEach(t => {
                $('#tabContent' + t.charAt(0).toUpperCase() + t.slice(1)).addClass('hidden').removeClass('tab-transition');
            });
            const skeleton = $('#tabContentSkeleton');
            skeleton.removeClass('hidden').addClass('tab-transition');

            // Smoothly reveal content after skeleton shimmer
            setTimeout(function() {
                skeleton.addClass('hidden').removeClass('tab-transition');
                const targetContent = $('#tabContent' + tab.charAt(0).toUpperCase() + tab.slice(1));
                targetContent.removeClass('hidden').addClass('tab-transition');

                if (tab === 'discounts') {
                    renderDiscountsTable(productsData);
                } else if (tab === 'orders') {
                    loadOrders();
                } else if (tab === 'completedOrders') {
                    loadOrders().then(() => renderCompletedOrders(ordersData));
                } else if (tab === 'cancelledOrders') {
                    loadOrders().then(() => renderCancelledOrders(ordersData));
                } else if (tab === 'deliveryCharges') {
                    loadDeliveryChargesAdmin();
                } else if (tab === 'designWebsite') {
                    renderDesignWebsiteTab();
                } else if (tab === 'uploadBanner') {
                    renderUploadBannerTab();
                } else if (tab === 'payments') {
                    loadSaasSubscriptionAndPayments();
                } else if (tab === 'stockManagement') {
                    renderStockManagementProducts(productsData);
                } else if (tab === 'userInfo') {
                    if (storeData) populateProfileForm(storeData);
                } else if (tab === 'dashboard') {
                    if (storeData) renderSocialOverview(storeData.social_links || {});
                }

                hideTopLoader();
                if (window.lucide) lucide.createIcons();
            }, 220);
        }

        // 4. Render Social Badges in Overview
        
        // =========================================================================
        // 2-Step SaaS bKash Payment, Subscription & Invoices (Live Integration)
        // =========================================================================
        let currentTenantMonthlyFee = <?= (float)($store['monthly_fee'] ?? 999.00) ?>;
        let currentTenantBillingDay = <?= (int)($store['billing_day'] ?? 10) ?>;
        let saasPaymentsData = [];
        let saasCurrentPage = 1;
        const saasPerPage = 5;
        let currentTenantData = null;

        function goToSaasPaymentStep(step) {
            if (step === 1) {
                $('#saasPayStep1Panel').removeClass('hidden');
                $('#saasPayStep2Panel').addClass('hidden');
                $('#saasPaySuccessState').addClass('hidden');

                // Segmented Tabs
                $('#tabBtnStep1').removeClass('border-slate-200 bg-slate-50 text-slate-500 font-bold').addClass('border-pink-600 bg-pink-50/70 text-pink-700 font-black');
                $('#tabBtnStep1 span:first-child').removeClass('bg-slate-200 text-slate-600').addClass('bg-pink-600 text-white');
                
                $('#tabBtnStep2').removeClass('border-pink-600 bg-pink-50/70 text-pink-700 font-black').addClass('border-slate-200 bg-slate-50 text-slate-500 font-bold');
                $('#tabBtnStep2 span:first-child').removeClass('bg-pink-600 text-white').addClass('bg-slate-200 text-slate-600');
            } else if (step === 2) {
                $('#saasPayStep1Panel').addClass('hidden');
                $('#saasPayStep2Panel').removeClass('hidden');
                $('#saasPaySuccessState').addClass('hidden');

                // Segmented Tabs
                $('#tabBtnStep2').removeClass('border-slate-200 bg-slate-50 text-slate-500 font-bold').addClass('border-pink-600 bg-pink-50/70 text-pink-700 font-black');
                $('#tabBtnStep2 span:first-child').removeClass('bg-slate-200 text-slate-600').addClass('bg-pink-600 text-white');

                $('#tabBtnStep1').removeClass('border-pink-600 bg-pink-50/70 text-pink-700 font-black').addClass('border-slate-200 bg-slate-50 text-slate-500 font-bold');
                $('#tabBtnStep1 span:first-child').removeClass('bg-pink-600 text-white').addClass('bg-slate-200 text-slate-600');
                
                // Focus sender number field
                setTimeout(() => {
                    $('#inputSenderBkashNumber').focus();
                }, 100);
            }
            if (window.lucide) lucide.createIcons();
        }

        function copySaasBkashNumber(num) {
            const targetNum = num || (typeof STORE_BKASH_NUMBER !== 'undefined' ? STORE_BKASH_NUMBER : '') || '01642956206';
            navigator.clipboard.writeText(targetNum).then(() => {
                const btn = $('#btnCopyBkashNumber');
                const text = $('#btnCopyBkashText');
                btn.removeClass('bg-pink-600 hover:bg-pink-700').addClass('bg-emerald-600 hover:bg-emerald-700');
                text.text('কপি হয়েছে!');
                showPaymentToast('বিকাশ নম্বরটি কপি করা হয়েছে: ' + targetNum);
                setTimeout(() => {
                    btn.removeClass('bg-emerald-600 hover:bg-emerald-700').addClass('bg-pink-600 hover:bg-pink-700');
                    text.text('নম্বর কপি করুন');
                }, 2500);
            }).catch(() => {
                showPaymentToast('নম্বর: ' + targetNum);
            });
        }

        async function handleSaasPaymentVerification(e) {
            e.preventDefault();
            const senderNum = $('#inputSenderBkashNumber').val().trim();
            const trxId = $('#inputSenderTrxId').val().trim();

            if (!senderNum || senderNum.length < 11) {
                alert('অনুগ্রহ করে সঠিক ১১ ডিজিটের বিকাশ নম্বর প্রদান করুন।');
                return;
            }

            const btn = $('#btnSubmitSaasPayment');
            btn.prop('disabled', true).html('<i data-lucide="loader" class="w-3.5 h-3.5 animate-spin"></i><span>জমা হচ্ছে...</span>');
            if (window.lucide) lucide.createIcons();

            try {
                const res = await StoreApi.post(`tenants/${STORE_UUID}/payments`, {
                    sender_number: senderNum,
                    trx_id: trxId,
                    amount: currentTenantMonthlyFee
                });

                btn.prop('disabled', false).html('<i data-lucide="send" class="w-3.5 h-3.5"></i><span>পেমেন্ট তথ্য সাবমিট করুন</span>');

                if (res && res.success) {
                    $('#saasPayStep2Panel').addClass('hidden');
                    $('#submittedSenderNumberDisplay').text(senderNum);
                    $('#saasPaySuccessState').removeClass('hidden');

                    showPaymentToast('পেমেন্ট রিকোয়েস্ট সফলভাবে জমা হয়েছে!');
                    loadSaasSubscriptionAndPayments();
                } else {
                    alert((res && res.message) ? res.message : 'পেমেন্ট জমা দেওয়া সম্ভব হয়নি।');
                }
            } catch(err) {
                btn.prop('disabled', false).html('<i data-lucide="send" class="w-3.5 h-3.5"></i><span>পেমেন্ট তথ্য সাবমিট করুন</span>');
                alert(err.message || 'সার্ভার এরর, পুনরায় চেষ্টা করুন।');
            }
            if (window.lucide) lucide.createIcons();
        }

        async function loadSaasSubscriptionAndPayments() {
            if (!STORE_UUID) return;
            renderPaymentHistorySkeletons(3);

            try {
                const res = await StoreApi.get(`tenants/${STORE_UUID}/payments`);
                if (res && res.success && res.data) {
                    const tenant = res.data.tenant || {};
                    currentTenantData = tenant;
                    saasPaymentsData = res.data.payments || [];
                    const bkashNum = res.data.bkash_number || (typeof STORE_BKASH_NUMBER !== 'undefined' ? STORE_BKASH_NUMBER : '') || '01642956206';

                    currentTenantMonthlyFee = parseFloat(tenant.monthly_fee) || currentTenantMonthlyFee || 999;
                    currentTenantBillingDay = parseInt(tenant.billing_day) || currentTenantBillingDay || 10;

                    // Update bKash display
                    $('#saasBkashNumberDisplay').text(bkashNum);
                    $('#saasStep1RuleNumber').text(bkashNum);
                    $('#btnCopyBkashNumber').attr('onclick', `copySaasBkashNumber('${bkashNum}')`);

                    const feeBn = currentTenantMonthlyFee.toLocaleString('bn-BD');
                    $('#saasMonthlyFeeDisplay').text('৳ ' + feeBn);
                    $('#saasStep1AmountDisplay').text('৳ ' + feeBn);
                    $('#saasStep1RuleAmountDisplay').text(feeBn);
                    $('#saasStep2FeeText').text('৳ ' + feeBn);
                    $('#saasStep2FeeInput').val('৳ ' + feeBn);
                    $('#saasStep2CycleInput').val(`প্রতি মাসের ${currentTenantBillingDay} তারিখ পর্যন্ত`);
                    $('#saasNextPaymentDueBadge').text(`প্রতি মাসের ${currentTenantBillingDay} তারিখের মধ্যে প্রদেয়`);

                    // 1. Subscription Validity & Countdown
                    if (tenant.subscription_ends_at) {
                        const expDate = new Date(tenant.subscription_ends_at);
                        const dateFormatted = expDate.toLocaleDateString('bn-BD', { day: 'numeric', month: 'long', year: 'numeric' });
                        $('#saasSubscriptionEndDateDisplay').text(dateFormatted);

                        const diffDays = tenant.days_remaining;
                        if (!tenant.is_overdue && diffDays > 0) {
                            $('#saasSubscriptionDaysBadge').html(`<span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold">${diffDays} দিন বাকি</span><span class="text-slate-400 font-normal">পরবর্তী নবায়ন আবশ্যক</span>`);
                        } else {
                            $('#saasSubscriptionDaysBadge').html(`<span class="px-2 py-0.5 rounded-md bg-rose-50 text-rose-700 border border-rose-200 font-extrabold">মেয়াদ শেষ</span><span class="text-rose-500 font-bold">স্টোর রিনিউ করুন</span>`);
                        }
                    }

                    // 2. Billing Alert Box (Overdue / Expiring Soon)
                    const $alertBox = $('#saasSubscriptionAlertContainer');
                    $alertBox.empty();

                    if (tenant.is_overdue) {
                        $alertBox.html(`
                            <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                <div class="flex items-center space-x-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center font-bold shrink-0">
                                        <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <strong class="text-rose-900 font-black block">আপনার স্টোরের সাবস্ক্রিপশন মেয়াদ শেষ হয়েছে (বিল বকেয়া)!</strong>
                                        <span class="text-rose-700 text-[11px]">সার্ভিস সচল রাখতে অনুগ্রহ করে চলতি মাসের ফি (৳${feeBn}) বিকাশ দিয়ে পরিশোধ করুন।</span>
                                    </div>
                                </div>
                                <button type="button" onclick="goToSaasPaymentStep(1); window.scrollTo({ top: 300, behavior: 'smooth' });" class="px-3.5 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shrink-0 cursor-pointer self-start sm:self-auto">
                                    এখনই পরিশোধ করুন
                                </button>
                            </div>
                        `);
                    } else if (tenant.is_exp_today) {
                        $alertBox.html(`
                            <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs animate-pulse">
                                <div class="flex items-center space-x-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center font-bold shrink-0">
                                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <strong class="text-rose-900 font-black block">আজকেই আপনার স্টোরের মাসিক মেয়াদ শেষ হচ্ছে!</strong>
                                        <span class="text-rose-700 text-[11px]">নিরবচ্ছিন্ন সার্ভিস নিশ্চিত করতে পরবর্তী মাসের বিল পরিশোধ করে রাখুন।</span>
                                    </div>
                                </div>
                                <button type="button" onclick="goToSaasPaymentStep(1); window.scrollTo({ top: 300, behavior: 'smooth' });" class="px-3.5 py-1.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shrink-0 cursor-pointer self-start sm:self-auto">
                                    বিল দিন
                                </button>
                            </div>
                        `);
                    } else if (tenant.days_remaining !== null && tenant.days_remaining <= 5) {
                        $alertBox.html(`
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                <div class="flex items-center space-x-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold shrink-0">
                                        <i data-lucide="clock" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <strong class="text-amber-900 font-black block">মেয়াদ শেষ হতে আর মাত্র ${tenant.days_remaining} দিন বাকি আছে।</strong>
                                        <span class="text-amber-700 text-[11px]">স্থায়ী বিলিং ডেট: প্রতি মাসের ${currentTenantBillingDay} তারিখ।</span>
                                    </div>
                                </div>
                                <button type="button" onclick="goToSaasPaymentStep(1); window.scrollTo({ top: 300, behavior: 'smooth' });" class="px-3.5 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shrink-0 cursor-pointer self-start sm:self-auto">
                                    বিল দিন
                                </button>
                            </div>
                        `);
                    }

                    // 3. Store Status Badge
                    if (tenant.status === 'active' && !tenant.is_overdue) {
                        $('#saasStoreStatusBadge').html('<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span><span>স্টোর স্ট্যাটাস: সচল (Active)</span>').attr('class', 'px-2.5 py-1 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-black flex items-center space-x-1.5');
                    } else if (tenant.status === 'suspended') {
                        $('#saasStoreStatusBadge').html('<span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span><span>স্টোর স্ট্যাটাস: স্থগিত (Suspended)</span>').attr('class', 'px-2.5 py-1 rounded-xl bg-rose-50 text-rose-700 border border-rose-200 text-[11px] font-black flex items-center space-x-1.5');
                    } else {
                        $('#saasStoreStatusBadge').html('<span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span><span>স্টোর স্ট্যাটাস: মেয়াদোত্তীর্ণ (Expired)</span>').attr('class', 'px-2.5 py-1 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-black flex items-center space-x-1.5');
                    }

                    // 4. Render Paginated Invoices Table
                    saasCurrentPage = 1;
                    renderSaasPaymentsTable(saasCurrentPage);
                }
            } catch(e) {
                console.error('Failed to load subscription & payments:', e);
            }
            if (window.lucide) lucide.createIcons();
        }

        function renderSaasPaymentsTable(page = 1) {
            saasCurrentPage = page;
            const $tbody = $('#saasPaymentHistoryTableBody');
            $tbody.empty();

            const total = saasPaymentsData.length;
            $('#saasPaymentCountBadge').text(`মোট ${toBnDigit(total)}টি রেকর্ড`);

            if (total === 0) {
                $tbody.append('<tr><td colspan="8" class="py-8 text-center text-slate-400">এখনো কোনো পেমেন্ট রেকর্ড নেই। উপরে বিকাশ দিয়ে ফি পরিশোধ করুন।</td></tr>');
                $('#saasPaymentPagination').addClass('hidden');
                return;
            }

            const totalPages = Math.ceil(total / saasPerPage);
            if (saasCurrentPage > totalPages) saasCurrentPage = totalPages;
            if (saasCurrentPage < 1) saasCurrentPage = 1;

            const startIndex = (saasCurrentPage - 1) * saasPerPage;
            const endIndex = Math.min(startIndex + saasPerPage, total);
            const pageRecords = saasPaymentsData.slice(startIndex, endIndex);

            pageRecords.forEach(p => {
                let badge = '';
                if (p.status === 'approved') {
                    badge = '<span class="inline-flex items-center space-x-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200"><i data-lucide="check" class="w-3 h-3"></i><span>অনুমোদিত</span></span>';
                } else if (p.status === 'pending') {
                    badge = '<span class="inline-flex items-center space-x-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200"><span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span><span>পেন্ডিং</span></span>';
                } else {
                    badge = '<span class="inline-flex items-center space-x-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-50 text-rose-700 border border-rose-200"><i data-lucide="x" class="w-3 h-3"></i><span>প্রত্যাখ্যাত</span></span>';
                }

                const pDate = p.formatted_date_short || new Date(p.created_at).toLocaleDateString('bn-BD', { day: 'numeric', month: 'short', year: 'numeric' });
                const typeLabel = p.type_label || (p.payment_type === 'initial' ? 'নতুন সাবস্ক্রিপশন' : 'মাসিক রিনিউয়াল');

                const tr = `
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-2.5 px-3 font-mono font-bold text-pink-600">${escapeHtml(p.invoice_no || `INV-${p.id}`)}</td>
                        <td class="py-2.5 px-3 text-slate-500 text-[11px] font-mono">${pDate}</td>
                        <td class="py-2.5 px-3 font-bold text-slate-800 text-[11px]">${escapeHtml(p.billing_month || 'মাসিক ফি')}</td>
                        <td class="py-2.5 px-3">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold ${p.type_badge_cls || 'bg-blue-50 text-blue-700 border border-blue-200'}">
                                <span>${typeLabel}</span>
                            </span>
                        </td>
                        <td class="py-2.5 px-3">
                            <span class="font-mono font-bold text-slate-800 block">${escapeHtml(p.trx_id || '-')}</span>
                            <span class="text-[10px] text-slate-400 font-mono">${escapeHtml(p.payment_method || 'bKash')} (${escapeHtml(p.sender_number || '-')})</span>
                        </td>
                        <td class="py-2.5 px-3 font-mono font-black text-slate-900 text-xs">৳ ${parseFloat(p.amount).toLocaleString('bn-BD')}</td>
                        <td class="py-2.5 px-3">${badge}</td>
                        <td class="py-2.5 px-3 text-right">
                            <button type="button" onclick="showAdminInvoice(${p.id})" class="px-2.5 py-1 text-slate-700 hover:text-emerald-700 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 rounded-lg text-xs font-bold transition inline-flex items-center space-x-1 cursor-pointer">
                                <i data-lucide="printer" class="w-3 h-3 text-emerald-600"></i>
                                <span>ইনভয়েস</span>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(tr);
            });

            renderGenericPagination({
                containerId: 'saasPaymentPagination',
                summaryId: 'saasPaginationSummary',
                buttonsId: 'saasPaginationButtons',
                currentPage: saasCurrentPage,
                totalItems: total,
                perPage: saasPerPage,
                itemLabel: 'ইনভয়েস',
                onPageChangeFn: 'changeSaasPaymentPage',
                activeColorClass: 'bg-pink-600 text-white'
            });

            if (window.lucide) lucide.createIcons();
        }

        function changeSaasPaymentPage(page) {
            const totalPages = Math.ceil(saasPaymentsData.length / saasPerPage);
            if (page < 1 || page > totalPages) return;
            renderSaasPaymentsTable(page);
            scrollToSectionTop('#saasPaymentHistorySection');
        }

        // =========================================================================
        // PRINTABLE OFFICIAL INVOICE MODAL
        // =========================================================================
        function showAdminInvoice(paymentId) {
            const p = saasPaymentsData.find(item => item.id == paymentId);
            if (!p) {
                showPaymentToast('ইনভয়েস তথ্য পাওয়া যায়নি।');
                return;
            }

            const invNo = p.invoice_no || `INV-${p.id}`;
            $('#admInvSubtitle').text(invNo);
            $('#admInvDocNo').text(invNo);
            $('#admInvDocDate').text(p.formatted_date_short || p.created_at);
            
            // Status Badge
            let statusHtml = '';
            if (p.status === 'approved') {
                statusHtml = '<span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200"><i data-lucide="check-circle" class="w-3.5 h-3.5"></i><span>পরিশোধিত (Paid)</span></span>';
            } else if (p.status === 'pending') {
                statusHtml = '<span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800 border border-amber-200"><i data-lucide="clock" class="w-3.5 h-3.5"></i><span>অপেক্ষমাণ (Pending Verification)</span></span>';
            } else {
                statusHtml = '<span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 border border-rose-200"><i data-lucide="x-circle" class="w-3.5 h-3.5"></i><span>প্রত্যাখ্যাত (Rejected)</span></span>';
            }
            $('#admInvStatusBadge').html(statusHtml);

            // Bill To
            if (currentTenantData) {
                $('#admInvStoreName').text(currentTenantData.name || '-');
                $('#admInvOwnerName').text(currentTenantData.owner_name || '-');
                $('#admInvOwnerPhone').text(currentTenantData.owner_phone || '-');
                $('#admInvOwnerEmail').text(currentTenantData.owner_email || '-');
            }

            // Payment Details
            $('#admInvMethod').text(p.payment_method || 'bKash');
            $('#admInvSender').text(p.sender_number || '-');
            $('#admInvTrxId').text(p.trx_id || '-');
            $('#admInvMonth').text(p.billing_month || 'নভেম্বর ২০২৬');

            // Amount
            const amtStr = '৳ ' + parseFloat(p.amount).toLocaleString('bn-BD');
            $('#admInvAmount').text(amtStr);
            $('#admInvTotalAmount').text(amtStr);
            $('#admInvTypeBadge').text(p.type_label || (p.payment_type === 'initial' ? 'নতুন সাবস্ক্রিপশন' : 'মাসিক রিনিউয়াল'));

            $('#adminInvoiceModal').removeClass('hidden');
            $('body').addClass('overflow-hidden');
            if (window.lucide) lucide.createIcons();
        }

        function closeAdminInvoiceModal() {
            $('#adminInvoiceModal').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        }

        // Close on ESC or click outside
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && !$('#adminInvoiceModal').hasClass('hidden')) {
                closeAdminInvoiceModal();
            }
        });
        $('#adminInvoiceModal').on('click', function(e) {
            if (e.target === this) {
                closeAdminInvoiceModal();
            }
        });

        function resetSaasPaymentFlow() {
            $('#inputSenderBkashNumber').val('');
            $('#inputSenderTrxId').val('');
            goToSaasPaymentStep(1);
        }

        function showPaymentToast(msg) {
            const toast = $(`
                <div class="fixed bottom-6 right-6 z-50 flex items-center space-x-2.5 bg-slate-900 text-white px-4 py-3 rounded-2xl shadow-2xl border border-slate-700 text-xs font-bold animate-fade-in max-w-xs sm:max-w-md">
                    <i data-lucide="info" class="w-4 h-4 text-pink-400 shrink-0"></i>
                    <span>${msg}</span>
                </div>
            `);
            $('body').append(toast);
            if (window.lucide) lucide.createIcons();
            setTimeout(() => {
                toast.fadeOut(300, function() { $(this).remove(); });
            }, 3000);
        }

        function renderSocialOverview(socials) {
            const container = $('#socialBadgesContainer');
            container.empty();

            const platforms = [
                { id: 'facebook', label: 'Facebook', icon: 'share-2', color: 'text-blue-600', bg: 'bg-blue-50', border: 'border-blue-200' },
                { id: 'instagram', label: 'Instagram', icon: 'camera', color: 'text-pink-600', bg: 'bg-pink-50', border: 'border-pink-200' },
                { id: 'whatsapp', label: 'WhatsApp', icon: 'message-circle', color: 'text-emerald-600', bg: 'bg-emerald-50', border: 'border-emerald-200' },
                { id: 'youtube', label: 'YouTube', icon: 'video', color: 'text-red-600', bg: 'bg-red-50', border: 'border-red-200' },
            ];

            platforms.forEach(p => {
                const val = (socials && typeof socials[p.id] === 'string') ? socials[p.id].trim() : '';
                const isLinked = val !== '';

                let linkUrl = val;
                if (isLinked) {
                    if (p.id === 'whatsapp' && !val.startsWith('http://') && !val.startsWith('https://')) {
                        const cleanPhone = val.replace(/[^0-9]/g, '');
                        linkUrl = cleanPhone.startsWith('88') ? `https://wa.me/${cleanPhone}` : `https://wa.me/88${cleanPhone}`;
                    } else if (!val.startsWith('http://') && !val.startsWith('https://')) {
                        linkUrl = `https://${val}`;
                    }
                }

                const badge = `
                    <div class="flex items-center justify-between p-3 rounded-xl border ${isLinked ? p.border + ' ' + p.bg : 'border-slate-200 bg-slate-50/50'}">
                        <div class="flex items-center space-x-2.5">
                            <i data-lucide="${p.icon}" class="w-4 h-4 ${isLinked ? p.color : 'text-slate-400'}"></i>
                            <div>
                                <div class="text-xs font-bold ${isLinked ? 'text-slate-900' : 'text-slate-500'}">${p.label}</div>
                                <div class="text-[10px] ${isLinked ? 'text-emerald-700 font-semibold' : 'text-slate-400'}">
                                    ${isLinked ? (i18n[currentLang] ? i18n[currentLang].connected : 'সংযুক্ত') : (i18n[currentLang] ? i18n[currentLang].notConnected : 'যুক্ত নেই')}
                                </div>
                            </div>
                        </div>
                        ${isLinked ? `<a href="${escapeHtml(linkUrl)}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-slate-700 p-1" title="লিংকটি খুলুন"><i data-lucide="external-link" class="w-3.5 h-3.5"></i></a>` : ''}
                    </div>
                `;
                container.append(badge);
            });

            lucide.createIcons();
        }

        // ==========================================
        // 4.5 CATEGORIES LOGIC & MANAGEMENT
        // ==========================================

        async function loadCategories() {
            renderCategorySkeletons(4);
            try {
                const res = await StoreApi.get('categories', { store: STORE_UUID });
                if (res.success && Array.isArray(res.data)) {
                    categoriesData = res.data;
                    const def = categoriesData.find(c => c.is_default == 1 || c.slug === 'unnamed');
                    if (def) {
                        defaultCategoryUuid = def.uuid;
                    }
                    $('#badgeCategoryCount, #mobDrawerBadgeCategory').text(categoriesData.length);
                    $('#categoryHeaderCount').text(categoriesData.length + (currentLang === 'bn' ? ' টি' : ' items'));
                    renderCategories(categoriesData);
                    populateCategoryDropdown(categoriesData);
                }
            } catch (err) {
                console.error('Error fetching categories:', err);
            }
        }

        function populateCategoryDropdown(list) {
            const $select = $('#fProdCategory');
            $select.empty();
            list.forEach(c => {
                const isDef = (c.is_default == 1 || c.slug === 'unnamed');
                const text = isDef ? `${c.name} (ডিফল্ট)` : c.name;
                $select.append(`<option value="${c.uuid}" ${isDef ? 'selected' : ''}>${escapeHtml(text)}</option>`);
            });
            // Ensure default "Unnamed" is selected if nothing picked
            if (!$select.val() && defaultCategoryUuid) {
                $select.val(defaultCategoryUuid);
            }
        }

        function renderCategories(list) {
            const $grid = $('#categoryGridContainer');
            $grid.empty();

            if (!list || list.length === 0) {
                $grid.append(`
                    <div class="col-span-full py-16 text-center text-slate-500">
                        কোনো ক্যাটাগরি পাওয়া যায়নি।
                    </div>
                `);
                return;
            }

            list.forEach(cat => {
                const isDefault = (cat.is_default == 1 || cat.slug === 'unnamed');
                const prodCount = parseInt(cat.product_count) || 0;
                const imgHtml = cat.image
                    ? `<img src="${cat.image}" alt="${escapeHtml(cat.name)}" class="w-full h-full object-cover">`
                    : `<div class="w-full h-full flex items-center justify-center bg-amber-50 text-amber-500"><i data-lucide="folder" class="w-8 h-8"></i></div>`;

                const defaultBadge = isDefault
                    ? `<span class="px-2 py-0.5 rounded-lg text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">ডিফল্ট</span>`
                    : '';

                const deleteBtn = isDefault
                    ? `<span class="p-1.5 text-slate-300 cursor-not-allowed" title="ডিফল্ট Unnamed ক্যাটাগরি মুছে ফেলা যাবে না"><i data-lucide="lock" class="w-3.5 h-3.5"></i></span>`
                    : `<button type="button" onclick="deleteCategory('${cat.uuid}', '${escapeHtml(cat.name)}')" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition cursor-pointer" title="মুছে ফেলুন"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>`;

                $grid.append(`
                    <div class="bg-white border border-slate-200 hover:border-amber-400 rounded-2xl p-3 shadow-2xs hover:shadow-md transition duration-200 flex flex-col justify-between group">
                        <div>
                            <!-- Image Wrapper -->
                            <div class="aspect-square w-full rounded-xl overflow-hidden bg-slate-100 relative mb-2.5 border border-slate-100 flex items-center justify-center">
                                ${imgHtml}
                                <div class="absolute top-1.5 right-1.5">
                                    ${defaultBadge}
                                </div>
                            </div>

                            <!-- Category Name -->
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-amber-600 transition truncate mb-0.5" title="${escapeHtml(cat.name)}">
                                ${escapeHtml(cat.name)}
                            </h4>

                            <!-- Product Count -->
                            <div class="text-[11px] text-slate-500 font-medium">
                                ${prodCount} টি প্রোডাক্ট যুক্ত
                            </div>
                        </div>

                        <!-- Footer with Actions -->
                        <div class="pt-2 mt-2 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[10px] font-mono text-slate-400 truncate">/${escapeHtml(cat.slug)}</span>
                            <div class="flex items-center space-x-1">
                                <button type="button" onclick="openEditCategoryModal('${cat.uuid}')" class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition cursor-pointer" title="সম্পাদনা">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                ${deleteBtn}
                            </div>
                        </div>
                    </div>
                `);
            });

            lucide.createIcons();
        }

        function openCreateCategoryModal() {
            $('#categoryForm')[0].reset();
            $('#catEditUuid').val('');
            $('#modalCategoryTitle').text('নতুন ক্যাটাগরি যোগ করুন');
            selectedCatImageFile = null;
            existingCatImageUrl = '';
            $('#catImagePreviewWrapper').addClass('hidden');
            $('#catImagePreview').attr('src', '');
            $('#modalCategory').removeClass('hidden').css('display', 'flex');
            $('body').addClass('overflow-hidden');
            lucide.createIcons();
        }

        function openEditCategoryModal(uuid) {
            const cat = categoriesData.find(c => c.uuid === uuid);
            if (!cat) return;

            $('#catEditUuid').val(cat.uuid);
            $('#modalCategoryTitle').text('ক্যাটাগরি সম্পাদনা: ' + cat.name);
            $('#fCatName').val(cat.name);
            selectedCatImageFile = null;
            existingCatImageUrl = cat.image || '';

            if (existingCatImageUrl) {
                $('#catImagePreview').attr('src', existingCatImageUrl);
                $('#catImagePreviewWrapper').removeClass('hidden');
            } else {
                $('#catImagePreview').attr('src', '');
                $('#catImagePreviewWrapper').addClass('hidden');
            }

            $('#modalCategory').removeClass('hidden').css('display', 'flex');
            $('body').addClass('overflow-hidden');
            lucide.createIcons();
        }

        function closeCategoryModal() {
            $('#modalCategory').addClass('hidden').css('display', 'none');
            $('body').removeClass('overflow-hidden');
        }

        function handleCatImageSelection(e) {
            const file = e.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                Swal.fire({ icon: 'warning', text: 'অনুগ্রহ করে শুধুমাত্র ছবি ফাইল সিলেক্ট করুন।' });
                return;
            }

            selectedCatImageFile = file;
            const reader = new FileReader();
            reader.onload = function(evt) {
                $('#catImagePreview').attr('src', evt.target.result);
                $('#catImagePreviewWrapper').removeClass('hidden');
            };
            reader.readAsDataURL(file);
        }

        function removeCatImage() {
            selectedCatImageFile = null;
            existingCatImageUrl = '';
            $('#fCatImageInput').val('');
            $('#catImagePreview').attr('src', '');
            $('#catImagePreviewWrapper').addClass('hidden');
        }

        $('#categoryForm').on('submit', async function(e) {
            e.preventDefault();
            const editUuid = $('#catEditUuid').val();
            const isEdit = !!editUuid;
            const catName = $('#fCatName').val().trim();

            if (!catName) {
                Swal.fire({ icon: 'warning', text: 'ক্যাটাগরির নাম দিন।' });
                return;
            }

            $('#btnSaveCategory').prop('disabled', true);
            $('#btnSaveCategoryText').text('সংরক্ষণ হচ্ছে...');

            try {
                let finalImageUrl = existingCatImageUrl;

                // If a new image was selected, upload and compress to ~200KB (Base64 JSON safe from WAF)
                if (selectedCatImageFile) {
                    const base64Data = await new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.onload = () => resolve(reader.result);
                        reader.onerror = reject;
                        reader.readAsDataURL(selectedCatImageFile);
                    });

                    const uploadRes = await StoreApi.post(`categories/upload-image?store=${STORE_UUID}`, {
                        image_base64: base64Data,
                        category_name: catName,
                        store_uuid: STORE_UUID
                    });

                    if (uploadRes.success && uploadRes.data && uploadRes.data.url) {
                        finalImageUrl = uploadRes.data.url;
                    } else {
                        throw new Error(uploadRes.message || 'ক্যাটাগরি ইমেজ আপলোড ব্যর্থ হয়েছে।');
                    }
                }

                const payload = {
                    name: catName,
                    image: finalImageUrl,
                    store_uuid: STORE_UUID
                };

                let res;
                if (isEdit) {
                    res = await StoreApi.put(`categories/${editUuid}?store=${STORE_UUID}`, payload);
                } else {
                    res = await StoreApi.post(`categories?store=${STORE_UUID}`, payload);
                }

                if (res.success) {
                    closeCategoryModal();
                    await loadCategories();
                    await loadProducts(); // Refresh products to reflect updated category name
                    Swal.fire({
                        icon: 'success',
                        title: 'ক্যাটাগরি সংরক্ষিত!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({ icon: 'error', text: res.message || 'ক্যাটাগরি সংরক্ষণ ব্যর্থ।' });
                }
            } catch (err) {
                Swal.fire({ icon: 'error', text: err.message });
            } finally {
                $('#btnSaveCategory').prop('disabled', false);
                $('#btnSaveCategoryText').text('ক্যাটাগরি সংরক্ষণ করুন');
            }
        });

        async function deleteCategory(uuid, name) {
            const confirm = await Swal.fire({
                title: 'ক্যাটাগরি মুছে ফেলতে চান?',
                text: `"${name}" মুছে ফেললে এর ভেতরের সকল প্রোডাক্ট স্বয়ংক্রিয়ভাবে ডিফল্ট "Unnamed" ক্যাটাগরিতে যুক্ত হবে।`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ea580c',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'হ্যাঁ, ডিলিট করুন',
                cancelButtonText: 'বাতিল'
            });

            if (confirm.isConfirmed) {
                try {
                    const res = await StoreApi.delete(`categories/${uuid}?store=${STORE_UUID}`);
                    if (res.success) {
                        await loadCategories();
                        await loadProducts();
                        Swal.fire({ icon: 'success', title: 'ক্যাটাগরি মুছে ফেলা হয়েছে', timer: 1200, showConfirmButton: false });
                    } else {
                        Swal.fire({ icon: 'error', text: res.message || 'ক্যাটাগরি মুছে ফেলা ব্যর্থ।' });
                    }
                } catch (err) {
                    Swal.fire({ icon: 'error', text: err.message });
                }
            }
        }

        // ==========================================
        // 5. PRODUCTS & INVENTORY LOGIC
        // ==========================================

        async function loadProducts() {
            renderProductTableSkeletons(5);
            try {
                const res = await StoreApi.get('products');
                if (res.success && Array.isArray(res.data)) {
                    productsData = res.data;
                    updateProductStats(productsData);
                    renderProducts(productsData);
                    renderStockOutProducts(productsData);
                    renderStockManagementProducts(productsData);
                } else if (res.status === 401) {
                    window.location.href = 'login';
                }
            } catch (err) {
                console.error('Error fetching products:', err);
            }
        }

        // Helper: Parse JSON or array safe
        function parseJsonSafeList(val) {
            if (!val) return [];
            if (Array.isArray(val)) return val;
            if (typeof val === 'string') {
                try {
                    const parsed = JSON.parse(val);
                    return Array.isArray(parsed) ? parsed : [];
                } catch (e) {
                    return [];
                }
            }
            return [];
        }

        // Universal Stock-Out Evaluation (Full Product vs Size/Variant vs Color)
        function getProductStockOutStatus(p) {
            const stock = parseInt(p.stock) || 0;
            const isFull = stock <= 0;

            const rawSizes = parseJsonSafeList(p.sizes);
            const parsedSizes = rawSizes.map(s => {
                if (typeof s === 'object' && s !== null) {
                    return { name: s.name || '', stock: parseInt(s.stock) || 0 };
                }
                return { name: String(s || ''), stock: 0 };
            });

            const rawColors = parseJsonSafeList(p.colors);
            const parsedColors = rawColors.map(c => {
                if (typeof c === 'object' && c !== null) {
                    return { name: c.name || '', stock: parseInt(c.stock) || 0, hex: c.hex || null };
                }
                return { name: String(c || ''), stock: 0, hex: null };
            });

            const zeroSizes = parsedSizes.filter(s => s.stock <= 0);
            const hasZeroSize = parsedSizes.length > 0 && zeroSizes.length > 0;

            const zeroColors = parsedColors.filter(c => c.stock <= 0);
            const hasZeroColor = parsedColors.length > 0 && zeroColors.length > 0;

            // Partial stock out: Product has sizes/variants/colors where at least one has 0 stock
            const isPartial = (parsedSizes.length > 0 && hasZeroSize) || (parsedColors.length > 0 && hasZeroColor);
            const isAny = isFull || isPartial;

            return {
                isFull,
                isPartial,
                isAny,
                parsedSizes,
                parsedColors,
                zeroSizes,
                zeroColors,
                stock
            };
        }

        function updateProductStats(list) {
            const count = list.length;
            $('#badgeProductCount').text(count);
            $('#dashTotalProducts').text(count);

            let totalStock = 0;
            let totalProfitPotential = 0;
            let fullCount = 0;
            let partialCount = 0;
            let totalAttentionCount = 0;
            let inStockCount = 0;
            let outStockCount = 0;
            let hasVariantsCount = 0;

            list.forEach(p => {
                const status = getProductStockOutStatus(p);
                const stock = parseInt(p.stock) || 0;
                const profit = parseFloat(p.profit) || 0;
                totalStock += stock;
                totalProfitPotential += (profit * stock);

                if (status.isFull) fullCount++;
                if (status.isPartial) partialCount++;
                if (status.isAny) totalAttentionCount++;

                if (stock > 0) inStockCount++;
                if (stock <= 0) outStockCount++;
                if (status.parsedSizes.length > 0 || status.parsedColors.length > 0) hasVariantsCount++;
            });

            $('#dashTotalStock').text(totalStock);
            $('#dashTotalProfit').text('৳' + totalProfitPotential.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            
            // Filter Pills Count Badges in Stock Out Tab
            $('#soFilterCountAll').text(totalAttentionCount);
            $('#soFilterCountFull').text(fullCount);
            $('#soFilterCountPartial').text(partialCount);

            // Filter Pills Count Badges in Stock Management Tab
            $('#badgeStockManagementCount, #mobDrawerBadgeStockManagement').text(count);
            $('#stockManagementHeaderCount').text(toBnDigit(count) + (currentLang === 'bn' ? ' টি পণ্য' : ' items'));
            $('#smFilterCountAll').text(count);
            $('#smFilterCountInStock').text(inStockCount);
            $('#smFilterCountOutStock').text(outStockCount);
            $('#smFilterCountHasVariants').text(hasVariantsCount);

            // Global badges
            $('#badgeStockOutCount, #mobDrawerBadgeStockOut').text(totalAttentionCount);
            $('#stockOutHeaderCount').text(toBnDigit(totalAttentionCount) + (currentLang === 'bn' ? ' টি' : ' items'));
            $('#dashStockOutIndicator').text(toBnDigit(totalAttentionCount) + (currentLang === 'bn' ? ' টি স্টক অ্যালার্ট' : ' stock alert'));

            // Package Product Limit Status & Remaining Countdown
            const pkgLimit = parseInt(storeData && storeData.product_limit !== undefined ? storeData.product_limit : 50, 10);
            const isUnlimited = (pkgLimit <= 0);
            const remaining = isUnlimited ? null : Math.max(0, pkgLimit - count);
            const isLimitReached = (!isUnlimited && count >= pkgLimit);

            // 1. Product Toolbar Limit & Remaining Badge
            const badgeEl = $('#productLimitBadge');
            if (badgeEl.length) {
                if (isUnlimited) {
                    badgeEl.html(`<span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-xs font-bold inline-flex items-center space-x-1.5 shadow-2xs"><i data-lucide="infinity" class="w-3.5 h-3.5 text-emerald-600"></i><span>আনলিমিটেড প্রোডাক্ট আপলোড</span></span>`);
                } else if (isLimitReached) {
                    badgeEl.html(`<span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 rounded-xl text-xs font-black inline-flex items-center space-x-1.5 shadow-2xs"><i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-rose-600"></i><span>আর বাকি নেই: ০ টি (${toBnDigit(pkgLimit)} টির কোটা পূর্ণ)</span></span>`);
                } else {
                    badgeEl.html(`<span class="px-3 py-1 bg-amber-50 text-amber-900 border border-amber-200 rounded-xl text-xs font-bold inline-flex items-center space-x-1.5 shadow-2xs"><i data-lucide="package-check" class="w-3.5 h-3.5 text-amber-600"></i><span>আর বাকি আছে: <strong class="text-amber-950 text-sm font-black">${toBnDigit(remaining)}</strong> টি (মোট ${toBnDigit(pkgLimit)} টির মধ্যে ${toBnDigit(count)} টি ব্যবহৃত)</span></span>`);
                }
            }

            // 2. Dashboard Product Limit Remaining Stat
            const dashRemainingEl = $('#dashProductLimitRemaining');
            const dashSubtextEl = $('#dashProductLimitSubtext');
            if (dashRemainingEl.length) {
                dashRemainingEl.removeClass('hidden');
                if (isUnlimited) {
                    dashRemainingEl.removeClass('text-rose-700 bg-rose-50 border-rose-200').addClass('text-emerald-700 bg-emerald-50 border-emerald-200').text('আনলিমিটেড বাকি');
                    dashSubtextEl.text('প্যাকেজ কোটা: আনলিমিটেড');
                } else if (isLimitReached) {
                    dashRemainingEl.removeClass('text-emerald-700 bg-emerald-50 border-emerald-200 text-amber-700 bg-amber-50 border-amber-200').addClass('text-rose-700 bg-rose-50 border-rose-200').text('০ টি বাকি');
                    dashSubtextEl.text(`প্যাকেজ লিমিট পূর্ণ (${toBnDigit(count)}/${toBnDigit(pkgLimit)} টি)`);
                } else {
                    dashRemainingEl.removeClass('text-rose-700 bg-rose-50 border-rose-200 text-emerald-700 bg-emerald-50 border-emerald-200').addClass('text-amber-700 bg-amber-50 border-amber-200').text(`আর বাকি: ${toBnDigit(remaining)} টি`);
                    dashSubtextEl.text(`প্যাকেজ লিমিট: ${toBnDigit(pkgLimit)} টি (ব্যবহৃত ${toBnDigit(count)} টি)`);
                }
            }
            if (window.lucide) lucide.createIcons();
        }

        function renderProducts(list) {
            const $grid = $('#productGridContainer');
            $grid.empty();

            const search = $('#prodSearchInput').val().trim().toLowerCase();

            const filtered = list.filter(p => {
                return !search || p.name.toLowerCase().includes(search) || (p.slug && p.slug.toLowerCase().includes(search));
            });

            if (filtered.length === 0) {
                const emptyHtml = `
                    <div class="col-span-full py-12 text-center flex flex-col items-center justify-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                            <i data-lucide="package-search" class="w-7 h-7"></i>
                        </div>
                        <p class="text-xs text-slate-500 max-w-sm">${i18n[currentLang] ? i18n[currentLang].noProductsFound : 'কোনো প্রোডাক্ট পাওয়া যায়নি।'}</p>
                        <button type="button" onclick="openProductCreatePage()" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold flex items-center space-x-1.5 transition shadow-xs cursor-pointer">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>${i18n[currentLang] ? i18n[currentLang].btnAddProduct : 'নতুন প্রোডাক্ট যোগ করুন'}</span>
                        </button>
                    </div>
                `;
                $grid.append(emptyHtml);
                $('#productsPagination').addClass('hidden');
                lucide.createIcons();
                return;
            }

            const totalPages = Math.ceil(filtered.length / productsPerPage);
            if (productsCurrentPage > totalPages) productsCurrentPage = totalPages || 1;
            if (productsCurrentPage < 1) productsCurrentPage = 1;

            const startIndex = (productsCurrentPage - 1) * productsPerPage;
            const pageProducts = filtered.slice(startIndex, startIndex + productsPerPage);

            pageProducts.forEach(p => {
                const stockCount = parseInt(p.stock) || 0;
                const mainPrice = parseFloat(p.main_price) || 0;
                const retailerPrice = parseFloat(p.retailer_price) || 0;
                const profit = parseFloat(p.profit) || (retailerPrice - mainPrice);
                const profitMargin = retailerPrice > 0 ? ((profit / retailerPrice) * 100).toFixed(0) : 0;
                const imgThumbUrl = (p.images && p.images[0]) ? p.images[0] : null;

                // Prominent Stock Badge (Mobile-First) - NO Active status indicator overload
                const stockBadgeGrid = stockCount > 0
                    ? `<span class="px-2 py-0.5 rounded-lg text-[10px] sm:text-xs font-black shadow-xs bg-emerald-600 text-white flex items-center space-x-1"><i data-lucide="boxes" class="w-3 h-3"></i><span>${stockCount} ${currentLang === 'bn' ? 'টি স্টক' : 'in stock'}</span></span>`
                    : `<span class="px-2 py-0.5 rounded-lg text-[10px] sm:text-xs font-black shadow-xs bg-red-600 text-white flex items-center space-x-1"><i data-lucide="alert-circle" class="w-3 h-3"></i><span>${currentLang === 'bn' ? 'স্টক শেষ' : 'Out of stock'}</span></span>`;

                const imgHtmlGrid = imgThumbUrl
                    ? `<img src="${imgThumbUrl}" alt="${escapeHtml(p.name)}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">`
                    : `<div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50"><i data-lucide="package" class="w-8 h-8"></i></div>`;

                $grid.append(`
                    <div class="bg-white border border-slate-200/90 hover:border-brand-400 rounded-2xl p-2.5 sm:p-3.5 shadow-2xs hover:shadow-md transition duration-200 flex flex-col justify-between group cursor-pointer relative" onclick="openProductDetailsModal('${p.uuid}')">
                        <div>
                            <!-- Image with Prominent Stock Badge (No Active Status Overload) -->
                            <div class="aspect-square w-full bg-slate-100 rounded-xl overflow-hidden relative mb-2.5 border border-slate-100">
                                ${imgHtmlGrid}
                                
                                <!-- Stock Units Badge -->
                                <div class="absolute top-1.5 left-1.5 sm:top-2 sm:left-2">
                                    ${stockBadgeGrid}
                                </div>
                            </div>

                            <!-- Category Badge -->
                            <div class="mb-1">
                                <span class="inline-flex items-center space-x-1 px-1.5 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-600 truncate max-w-full">
                                    <i data-lucide="tag" class="w-2.5 h-2.5 text-slate-400"></i>
                                    <span>${escapeHtml(p.category_name || 'Unnamed')}</span>
                                </span>
                            </div>

                            <!-- Product Name -->
                            <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-brand-600 transition truncate mb-1" title="${escapeHtml(p.name)}">
                                ${escapeHtml(p.name)}
                            </h4>

                            <!-- Pricing Breakdown -->
                            <div class="flex items-baseline justify-between mb-2">
                                <div>
                                    <span class="text-[9px] text-slate-400 font-semibold uppercase block">বিক্রয়</span>
                                    <span class="text-xs sm:text-sm font-black text-slate-900">৳${retailerPrice.toFixed(2)}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] text-emerald-700 font-bold block">+৳${profit.toFixed(0)}</span>
                                    <span class="text-[9px] text-slate-400 font-medium">মার্জিন ${profitMargin}%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer: Actions (Delete Icon Only, Edit, View) -->
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-1" onclick="event.stopPropagation()">
                            <!-- Delete Icon Only (No Text) -->
                            <button type="button" onclick="confirmDeleteProduct('${p.uuid}')" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer" title="মুছে ফেলুন">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>

                            <div class="flex items-center space-x-0.5">
                                <button type="button" onclick="openEditProductModal('${p.uuid}')" class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition cursor-pointer" title="সম্পাদনা">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                <button type="button" onclick="openProductDetailsModal('${p.uuid}')" class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition cursor-pointer" title="বিস্তারিত">
                                    <i data-lucide="maximize-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            });

            renderGenericPagination({
                containerId: 'productsPagination',
                summaryId: 'productsPaginationSummary',
                buttonsId: 'productsPaginationButtons',
                currentPage: productsCurrentPage,
                totalItems: filtered.length,
                perPage: productsPerPage,
                itemLabel: 'প্রোডাক্ট',
                onPageChangeFn: 'changeProductsPage',
                activeColorClass: 'bg-brand-600 text-white'
            });

            lucide.createIcons();
        }

        // ==========================================
        // 5.2 STOCK OUT & RESTOCK MANAGEMENT SYSTEM
        // ==========================================
        let currentStockOutFilter = 'all'; // 'all' | 'full' | 'partial'
        let stockOutDrafts = {}; // { [uuid]: { sizes: [...], colors: [...], stock: number, isModified: boolean } }

        function setStockOutFilter(mode) {
            currentStockOutFilter = mode;
            ['all', 'full', 'partial'].forEach(m => {
                const $btn = $(`#soFilterBtn_${m}`);
                const capM = m.charAt(0).toUpperCase() + m.slice(1);
                const $cnt = $(`#soFilterCount${capM}`);
                if (m === mode) {
                    $btn.removeClass('bg-white hover:bg-slate-100 text-slate-700 border border-slate-200')
                        .addClass('bg-brand-600 text-white shadow-2xs border-transparent');
                    $cnt.removeClass('bg-rose-50 text-rose-700 bg-amber-50 text-amber-800 bg-slate-100 text-slate-700 border border-rose-200 border-amber-200 border-slate-200')
                        .addClass('bg-white/25 text-white font-black');
                } else {
                    $btn.removeClass('bg-brand-600 text-white shadow-2xs border-transparent')
                        .addClass('bg-white hover:bg-slate-100 text-slate-700 border border-slate-200');
                    $cnt.removeClass('bg-white/25 text-white');
                    if (m === 'all') {
                        $cnt.addClass('bg-slate-100 text-slate-700 border border-slate-200 font-bold');
                    } else if (m === 'full') {
                        $cnt.addClass('bg-rose-50 text-rose-700 border border-rose-200 font-bold');
                    } else if (m === 'partial') {
                        $cnt.addClass('bg-amber-50 text-amber-800 border border-amber-200 font-bold');
                    }
                }
            });
            renderStockOutProducts(productsData);
        }

        function renderStockOutProducts(list) {
            const $grid = $('#stockOutGridContainer');
            $grid.empty();

            const search = $('#stockOutSearchInput').val() ? $('#stockOutSearchInput').val().trim().toLowerCase() : '';

            const stockOutList = list.filter(p => {
                const status = getProductStockOutStatus(p);
                const isRecent = !!recentlyRestocked[p.uuid];

                let matchesFilter = false;
                if (currentStockOutFilter === 'all') {
                    matchesFilter = status.isAny || isRecent;
                } else if (currentStockOutFilter === 'full') {
                    matchesFilter = status.isFull || (isRecent && status.stock <= 0);
                } else if (currentStockOutFilter === 'partial') {
                    matchesFilter = status.isPartial;
                }

                if (!matchesFilter) return false;

                if (!search) return true;

                // Match product name, category, or size name
                const nameMatch = (p.name || '').toLowerCase().includes(search);
                const catMatch = (p.category_name || '').toLowerCase().includes(search);
                const sizeMatch = status.parsedSizes.some(s => s.name.toLowerCase().includes(search));
                const colorMatch = status.parsedColors.some(c => c.name.toLowerCase().includes(search));

                return nameMatch || catMatch || sizeMatch || colorMatch;
            });

            if (stockOutList.length === 0) {
                let emptyMsg = 'কোনো স্টক আউট প্রোডাক্ট নেই!';
                let emptySub = 'আপনার স্টোরের সকল পণ্য বর্তমানে পর্যাপ্ত স্টকে উপলব্ধ রয়েছে।';
                if (currentStockOutFilter === 'full') {
                    emptyMsg = 'সম্পূর্ণ স্টক শেষ এমন কোনো পণ্য নেই!';
                    emptySub = 'সকল পণ্যের ন্যূনতম কিছু স্টক স্টোরে অবশিষ্ট রয়েছে।';
                } else if (currentStockOutFilter === 'partial') {
                    emptyMsg = 'সাইজ বা ভ্যারিয়েন্ট স্টক শেষ এমন পণ্য নেই!';
                    emptySub = 'সকল ভ্যারিয়েন্ট ও সাইজের পর্যাপ্ত ইউনিট স্টকে রয়েছে।';
                }

                const emptyHtml = `
                    <div class="col-span-full py-16 text-center flex flex-col items-center justify-center space-y-3 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 shadow-xs">
                            <i data-lucide="check-check" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">${emptyMsg}</h4>
                        <p class="text-xs text-slate-500 max-w-sm">${emptySub}</p>
                    </div>
                `;
                $grid.append(emptyHtml);
                lucide.createIcons();
                return;
            }

            stockOutList.forEach(p => {
                const status = getProductStockOutStatus(p);
                const isRecent = !!recentlyRestocked[p.uuid];
                const retailerPrice = parseFloat(p.retailer_price) || 0;
                const imgThumbUrl = (p.images && p.images[0]) ? p.images[0] : null;

                // Initialize draft state if not modified yet
                if (!stockOutDrafts[p.uuid] || !stockOutDrafts[p.uuid].isModified) {
                    stockOutDrafts[p.uuid] = {
                        sizes: JSON.parse(JSON.stringify(status.parsedSizes)),
                        colors: JSON.parse(JSON.stringify(status.parsedColors)),
                        stock: status.stock,
                        isModified: false
                    };
                }
                const draft = stockOutDrafts[p.uuid];

                const hasSizes = draft.sizes && draft.sizes.length > 0;
                const hasColors = draft.colors && draft.colors.length > 0;

                // Detect if non-clothing variants
                const apparelSizes = ['s', 'm', 'l', 'xl', 'xxl', '2xl', '3xl', 'free size', 'free-size', '28', '30', '32', '34', '36', '38', '40', '42', '44'];
                const isVariant = hasSizes && draft.sizes.some(s => s.name && !apparelSizes.includes(s.name.trim().toLowerCase()));
                const variantHeading = isVariant ? 'ভ্যারিয়েন্ট তালিকা ও স্টক সংখ্যা:' : 'সাইজ তালিকা ও স্টক সংখ্যা:';

                // Status Badge
                let statusBadge = '';
                if (isRecent) {
                    statusBadge = `<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-2xs"><i data-lucide="check-circle" class="w-3.5 h-3.5"></i><span>+${toBnDigit(recentlyRestocked[p.uuid].added)}টি যোগ সম্পন্ন (স্টক: ${toBnDigit(draft.stock)})</span></span>`;
                } else if (status.isFull) {
                    statusBadge = `<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-rose-100 text-rose-700 border border-rose-200 shadow-2xs"><i data-lucide="alert-octagon" class="w-3.5 h-3.5"></i><span>সম্পূর্ণ স্টক শেষ (০ টি)</span></span>`;
                } else if (status.isPartial) {
                    const zeroNames = status.zeroSizes.map(s => s.name).join(', ') || status.zeroColors.map(c => c.name).join(', ');
                    statusBadge = `<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-amber-100 text-amber-800 border border-amber-200 shadow-2xs"><i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i><span>সাইজ স্টক শেষ (${escapeHtml(zeroNames)})</span></span>`;
                }

                // Render Size Steppers Rows (Step 2 style)
                let sizesHtml = '';
                if (hasSizes) {
                    sizesHtml = `
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-bold text-slate-700 flex items-center space-x-1.5">
                                    <i data-lucide="${isVariant ? 'layers' : 'shirt'}" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span>${variantHeading}</span>
                                </span>
                                <span class="text-[11px] text-slate-500 font-semibold">মোট স্টক: <b id="soTotalBadge_${p.uuid}" class="text-brand-600 font-black">${toBnDigit(draft.stock)} টি</b></span>
                            </div>
                            <div class="space-y-1.5 max-h-48 overflow-y-auto pr-0.5" id="soSizeRows_${p.uuid}">
                                ${draft.sizes.map((s, idx) => {
                                    const isZero = (parseInt(s.stock) || 0) <= 0;
                                    const rowBorder = isZero ? 'border-rose-200 bg-rose-50/50 hover:border-rose-300' : 'border-slate-200 bg-slate-50/70 hover:border-brand-200';
                                    const tagBadge = isZero
                                        ? `<span id="soTag_${p.uuid}_size_${idx}" class="text-[10px] font-bold text-rose-600 bg-rose-100/90 px-1.5 py-0.5 rounded border border-rose-200">স্টক ০ (শেষ)</span>`
                                        : `<span id="soTag_${p.uuid}_size_${idx}" class="text-[10px] font-semibold text-slate-600 bg-white px-1.5 py-0.5 rounded border border-slate-200">${toBnDigit(s.stock)} টি</span>`;

                                    return `
                                        <div id="soRow_${p.uuid}_size_${idx}" class="flex items-center justify-between px-2.5 py-1.5 ${rowBorder} border rounded-xl text-xs transition">
                                            <div class="flex items-center space-x-2 min-w-0 pr-1">
                                                <span class="w-5 h-5 rounded bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-[10px] shrink-0">${toBnDigit(idx + 1)}</span>
                                                <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md font-bold text-slate-800 text-xs truncate max-w-[120px]">${escapeHtml(s.name)}</span>
                                                ${tagBadge}
                                            </div>
                                            <div class="flex items-center space-x-1 shrink-0">
                                                <button type="button" onclick="changeStockOutItem('${p.uuid}', 'size', ${idx}, -1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95" title="১ কমান">-</button>
                                                <input type="number" min="0" value="${s.stock}" id="soInput_${p.uuid}_size_${idx}" oninput="onStockOutInput('${p.uuid}', 'size', ${idx}, this.value)" onkeydown="if(event.key==='Enter'){ event.preventDefault(); saveStockOutChanges('${p.uuid}'); }" class="w-12 text-center py-1 border border-slate-300 rounded-lg text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white shadow-2xs">
                                                <button type="button" onclick="changeStockOutItem('${p.uuid}', 'size', ${idx}, 1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 border border-emerald-600 text-white flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95" title="১ বাড়ান">+</button>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                }

                // Render Color Steppers Rows (if product has colors)
                let colorsHtml = '';
                if (hasColors) {
                    colorsHtml = `
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-bold text-slate-700 flex items-center space-x-1.5">
                                    <i data-lucide="palette" class="w-3.5 h-3.5 text-blue-600"></i>
                                    <span>রঙ তালিকা ও স্টক সংখ্যা:</span>
                                </span>
                            </div>
                            <div class="space-y-1.5 max-h-40 overflow-y-auto pr-0.5">
                                ${draft.colors.map((c, idx) => {
                                    const isZero = (parseInt(c.stock) || 0) <= 0;
                                    const rowBorder = isZero ? 'border-rose-200 bg-rose-50/50' : 'border-slate-200 bg-slate-50/70';
                                    const tagBadge = isZero
                                        ? `<span id="soTag_${p.uuid}_color_${idx}" class="text-[10px] font-bold text-rose-600 bg-rose-100/90 px-1.5 py-0.5 rounded border border-rose-200">স্টক ০ (শেষ)</span>`
                                        : `<span id="soTag_${p.uuid}_color_${idx}" class="text-[10px] font-semibold text-slate-600 bg-white px-1.5 py-0.5 rounded border border-slate-200">${toBnDigit(c.stock)} টি</span>`;

                                    return `
                                        <div id="soRow_${p.uuid}_color_${idx}" class="flex items-center justify-between px-2.5 py-1.5 ${rowBorder} border rounded-xl text-xs transition">
                                            <div class="flex items-center space-x-2 min-w-0 pr-1">
                                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span>
                                                <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md font-bold text-slate-800 text-xs truncate max-w-[120px]">${escapeHtml(c.name)}</span>
                                                ${tagBadge}
                                            </div>
                                            <div class="flex items-center space-x-1 shrink-0">
                                                <button type="button" onclick="changeStockOutItem('${p.uuid}', 'color', ${idx}, -1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95">-</button>
                                                <input type="number" min="0" value="${c.stock}" id="soInput_${p.uuid}_color_${idx}" oninput="onStockOutInput('${p.uuid}', 'color', ${idx}, this.value)" onkeydown="if(event.key==='Enter'){ event.preventDefault(); saveStockOutChanges('${p.uuid}'); }" class="w-12 text-center py-1 border border-slate-300 rounded-lg text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white shadow-2xs">
                                                <button type="button" onclick="changeStockOutItem('${p.uuid}', 'color', ${idx}, 1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 border border-emerald-600 text-white flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95">+</button>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                }

                // If Product has NO Sizes and NO Colors (Simple Product)
                let simpleHtml = '';
                if (!hasSizes && !hasColors) {
                    simpleHtml = `
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl">
                                <div>
                                    <span class="text-xs font-bold text-slate-800 block">ইনভেন্টরি স্টক:</span>
                                    <span class="text-[10px] text-slate-400">এই পণ্যের কোনো সাইজ বা ভ্যারিয়েন্ট নেই</span>
                                </div>
                                <div class="flex items-center space-x-1.5">
                                    <button type="button" onclick="changeStockOutSimple('${p.uuid}', -1)" class="w-7 h-7 rounded-lg bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm cursor-pointer shadow-2xs active:scale-95">-</button>
                                    <input type="number" min="0" value="${draft.stock}" id="soInput_${p.uuid}_simple" oninput="onStockOutSimpleInput('${p.uuid}', this.value)" onkeydown="if(event.key==='Enter'){ event.preventDefault(); saveStockOutChanges('${p.uuid}'); }" class="w-14 text-center py-1 border border-slate-300 rounded-lg text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white shadow-2xs">
                                    <button type="button" onclick="changeStockOutSimple('${p.uuid}', 1)" class="w-7 h-7 rounded-lg bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 border border-emerald-600 text-white flex items-center justify-center font-black text-sm cursor-pointer shadow-2xs active:scale-95">+</button>
                                </div>
                            </div>
                        </div>
                    `;
                }

                const imgHtml = imgThumbUrl
                    ? `<img src="${imgThumbUrl}" alt="${escapeHtml(p.name)}" class="w-full h-full object-cover">`
                    : `<div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100"><i data-lucide="package" class="w-6 h-6"></i></div>`;

                $grid.append(`
                    <div class="bg-white border ${status.isFull ? 'border-rose-200' : 'border-amber-200'} rounded-2xl p-4 sm:p-5 shadow-2xs hover:shadow-sm transition flex flex-col justify-between space-y-3.5 relative" id="soCard_${p.uuid}">
                        <!-- Top Metadata Row -->
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center space-x-3 min-w-0">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shrink-0">
                                    ${imgHtml}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center space-x-1.5 mb-0.5">
                                        <span class="inline-flex items-center space-x-1 px-1.5 py-0.5 bg-slate-100 text-slate-600 rounded text-[10px] font-semibold truncate max-w-[140px]">
                                            <i data-lucide="tag" class="w-2.5 h-2.5 text-slate-400"></i>
                                            <span>${escapeHtml(p.category_name || 'Unnamed')}</span>
                                        </span>
                                    </div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate mb-1" title="${escapeHtml(p.name)}">
                                        ${escapeHtml(p.name)}
                                    </h4>
                                    <div class="text-[11px] text-slate-500 font-medium">
                                        বিক্রয় মূল্য: <b class="text-slate-900">৳${retailerPrice.toFixed(2)}</b>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0">
                                ${statusBadge}
                            </div>
                        </div>

                        <!-- Mid Restock Controls -->
                        ${sizesHtml}
                        ${colorsHtml}
                        ${simpleHtml}

                        <!-- Card Action Footer -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                            <div class="flex items-center space-x-1.5">
                                <button type="button" onclick="openProductDetailsModal('${p.uuid}')" class="px-2.5 py-1.5 text-xs text-slate-600 hover:text-brand-600 hover:bg-brand-50 border border-slate-200 rounded-xl transition flex items-center space-x-1 cursor-pointer font-bold" title="পণ্যের বিস্তারিত দেখুন">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span class="hidden sm:inline">বিস্তারিত</span>
                                </button>
                                <button type="button" onclick="quickStockOutBatchAdd('${p.uuid}', 5)" class="px-2.5 py-1.5 text-xs text-emerald-700 hover:text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded-xl transition cursor-pointer font-bold flex items-center space-x-1" title="সব স্টক ০ থাকা আইটেমে ৫ টি যোগ করুন">
                                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                    <span>+৫ রিস্টক</span>
                                </button>
                            </div>

                            <button type="button" onclick="saveStockOutChanges('${p.uuid}')" id="soSaveBtn_${p.uuid}"
                                class="px-3.5 sm:px-4 py-1.5 sm:py-2 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] text-white rounded-xl text-xs font-bold transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                <span>স্টক সেভ করুন</span>
                            </button>
                        </div>
                    </div>
                `);
            });

            lucide.createIcons();
        }

        // Stepper: Change Size or Color Stock by Delta (-1 or +1)
        function changeStockOutItem(uuid, type, idx, delta) {
            const draft = stockOutDrafts[uuid];
            if (!draft) return;

            const list = type === 'size' ? draft.sizes : draft.colors;
            if (!list || !list[idx]) return;

            const current = parseInt(list[idx].stock) || 0;
            const updated = Math.max(0, current + delta);
            list[idx].stock = updated;
            draft.isModified = true;

            // Update input
            $(`#soInput_${uuid}_${type}_${idx}`).val(updated);

            // Update Tag & Row styling
            const $tag = $(`#soTag_${uuid}_${type}_${idx}`);
            const $row = $(`#soRow_${uuid}_${type}_${idx}`);

            if (updated === 0) {
                $tag.removeClass('bg-white text-slate-600 border-slate-200 bg-emerald-50 text-emerald-700 border-emerald-200')
                    .addClass('bg-rose-100/90 text-rose-600 border-rose-200 font-bold')
                    .text('স্টক ০ (শেষ)');
                $row.removeClass('border-slate-200 bg-slate-50/70 border-emerald-200 bg-emerald-50/20')
                    .addClass('border-rose-200 bg-rose-50/50');
            } else {
                $tag.removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                    .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                    .text(toBnDigit(updated) + ' টি');
                $row.removeClass('border-rose-200 bg-rose-50/50')
                    .addClass('border-slate-200 bg-slate-50/70');
            }

            // Recalculate total if sizes
            if (type === 'size' && draft.sizes.length > 0) {
                draft.stock = draft.sizes.reduce((sum, s) => sum + (parseInt(s.stock) || 0), 0);
                $(`#soTotalBadge_${uuid}`).text(toBnDigit(draft.stock) + ' টি');
            } else if (type === 'color' && (!draft.sizes || draft.sizes.length === 0)) {
                draft.stock = draft.colors.reduce((sum, c) => sum + (parseInt(c.stock) || 0), 0);
            }

            // Highlight save button
            $(`#soSaveBtn_${uuid}`).addClass('ring-2 ring-emerald-400');
        }

        // Direct Input: Size or Color Stock
        function onStockOutInput(uuid, type, idx, val) {
            const draft = stockOutDrafts[uuid];
            if (!draft) return;

            const list = type === 'size' ? draft.sizes : draft.colors;
            if (!list || !list[idx]) return;

            const updated = Math.max(0, parseInt(val) || 0);
            list[idx].stock = updated;
            draft.isModified = true;

            const $tag = $(`#soTag_${uuid}_${type}_${idx}`);
            const $row = $(`#soRow_${uuid}_${type}_${idx}`);

            if (updated === 0) {
                $tag.removeClass('bg-white text-slate-600 border-slate-200 bg-emerald-50 text-emerald-700 border-emerald-200')
                    .addClass('bg-rose-100/90 text-rose-600 border-rose-200 font-bold')
                    .text('স্টক ০ (শেষ)');
                $row.removeClass('border-slate-200 bg-slate-50/70 border-emerald-200 bg-emerald-50/20')
                    .addClass('border-rose-200 bg-rose-50/50');
            } else {
                $tag.removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                    .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                    .text(toBnDigit(updated) + ' টি');
                $row.removeClass('border-rose-200 bg-rose-50/50')
                    .addClass('border-slate-200 bg-slate-50/70');
            }

            if (type === 'size' && draft.sizes.length > 0) {
                draft.stock = draft.sizes.reduce((sum, s) => sum + (parseInt(s.stock) || 0), 0);
                $(`#soTotalBadge_${uuid}`).text(toBnDigit(draft.stock) + ' টি');
            } else if (type === 'color' && (!draft.sizes || draft.sizes.length === 0)) {
                draft.stock = draft.colors.reduce((sum, c) => sum + (parseInt(c.stock) || 0), 0);
            }

            $(`#soSaveBtn_${uuid}`).addClass('ring-2 ring-emerald-400');
        }

        // Stepper & Input for Simple Products (No sizes, no colors)
        function changeStockOutSimple(uuid, delta) {
            const draft = stockOutDrafts[uuid];
            if (!draft) return;
            const updated = Math.max(0, (parseInt(draft.stock) || 0) + delta);
            draft.stock = updated;
            draft.isModified = true;
            $(`#soInput_${uuid}_simple`).val(updated);
            $(`#soSaveBtn_${uuid}`).addClass('ring-2 ring-emerald-400');
        }

        function onStockOutSimpleInput(uuid, val) {
            const draft = stockOutDrafts[uuid];
            if (!draft) return;
            draft.stock = Math.max(0, parseInt(val) || 0);
            draft.isModified = true;
            $(`#soSaveBtn_${uuid}`).addClass('ring-2 ring-emerald-400');
        }

        // Quick Batch Add (+5 to any 0-stock size/color)
        function quickStockOutBatchAdd(uuid, amount = 5) {
            const draft = stockOutDrafts[uuid];
            if (!draft) return;

            let changed = false;
            if (draft.sizes && draft.sizes.length > 0) {
                draft.sizes.forEach((s, idx) => {
                    if ((parseInt(s.stock) || 0) <= 0) {
                        s.stock = amount;
                        changed = true;
                        $(`#soInput_${uuid}_size_${idx}`).val(amount);
                        $(`#soTag_${uuid}_size_${idx}`).removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                            .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                            .text(toBnDigit(amount) + ' টি');
                        $(`#soRow_${uuid}_size_${idx}`).removeClass('border-rose-200 bg-rose-50/50')
                            .addClass('border-slate-200 bg-slate-50/70');
                    }
                });
                if (changed) {
                    draft.stock = draft.sizes.reduce((sum, s) => sum + (parseInt(s.stock) || 0), 0);
                    $(`#soTotalBadge_${uuid}`).text(toBnDigit(draft.stock) + ' টি');
                }
            } else if (draft.colors && draft.colors.length > 0) {
                draft.colors.forEach((c, idx) => {
                    if ((parseInt(c.stock) || 0) <= 0) {
                        c.stock = amount;
                        changed = true;
                        $(`#soInput_${uuid}_color_${idx}`).val(amount);
                        $(`#soTag_${uuid}_color_${idx}`).removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                            .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                            .text(toBnDigit(amount) + ' টি');
                        $(`#soRow_${uuid}_color_${idx}`).removeClass('border-rose-200 bg-rose-50/50')
                            .addClass('border-slate-200 bg-slate-50/70');
                    }
                });
                if (changed) {
                    draft.stock = draft.colors.reduce((sum, c) => sum + (parseInt(c.stock) || 0), 0);
                }
            } else {
                draft.stock = (parseInt(draft.stock) || 0) + amount;
                changed = true;
                $(`#soInput_${uuid}_simple`).val(draft.stock);
            }

            if (changed) {
                draft.isModified = true;
                $(`#soSaveBtn_${uuid}`).addClass('ring-2 ring-emerald-400');
                showToast(`+${toBnDigit(amount)}টি স্টক যুক্ত হয়েছে। সংরক্ষণ করতে 'স্টক সেভ করুন' বাটনে চাপুন।`, 'info');
            }
        }

        // Dedicated Quantity Restock Handler for Stock Out Products
        async function saveStockOutChanges(uuid) {
            const draft = stockOutDrafts[uuid];
            if (!draft) return;

            const $btn = $(`#soSaveBtn_${uuid}`);
            if ($btn.prop('disabled')) return;
            const originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).addClass('opacity-70 cursor-not-allowed').html(`
                <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i>
                <span>সেভ হচ্ছে...</span>
            `);
            lucide.createIcons();

            try {
                const payload = {
                    stock: draft.stock
                };
                if (draft.sizes && draft.sizes.length > 0) {
                    payload.sizes = draft.sizes;
                }
                if (draft.colors && draft.colors.length > 0) {
                    payload.colors = draft.colors;
                }

                const res = await StoreApi.post(`products/${uuid}/stock`, payload);
                if (res.success && res.data) {
                    const prod = productsData.find(p => p.uuid === uuid);
                    if (prod) {
                        const prevStock = prod.stock;
                        prod.stock = res.data.stock;
                        if (res.data.sizes) prod.sizes = res.data.sizes;
                        if (res.data.colors) prod.colors = res.data.colors;

                        const addedQty = Math.max(0, prod.stock - prevStock);
                        recentlyRestocked[uuid] = {
                            added: addedQty,
                            total: prod.stock
                        };

                        draft.isModified = false;

                        updateProductStats(productsData);
                        renderProducts(productsData);
                        renderStockOutProducts(productsData);
                        renderStockManagementProducts(productsData);

                        Swal.fire({
                            icon: 'success',
                            title: 'স্টক সফলভাবে সংরক্ষিত হয়েছে!',
                            text: `"${prod.name}"-এর নতুন স্টক: ${toBnDigit(prod.stock)} টি`,
                            timer: 1600,
                            showConfirmButton: false
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ব্যর্থ হয়েছে',
                        text: res.message || 'স্টক আপডেট ব্যর্থ হয়েছে।'
                    });
                    $btn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed').html(originalBtnHtml);
                    lucide.createIcons();
                }
            } catch (err) {
                Swal.fire({ icon: 'error', text: err.message || 'নেটওয়ার্ক ত্রুটি' });
                $btn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed').html(originalBtnHtml);
                lucide.createIcons();
            }
        }

        // Search listeners
        $('#prodSearchInput').on('input', () => {
            productsCurrentPage = 1;
            renderProducts(productsData);
        });
        $('#stockOutSearchInput').on('input', () => renderStockOutProducts(productsData));

        // Quick Stock Adjuster (+1 or -1)
        async function adjustQuickStock(uuid, change) {
            try {
                const res = await StoreApi.post(`products/${uuid}/adjust-stock`, { change: change });
                if (res.success && res.data) {
                    const prod = productsData.find(p => p.uuid === uuid);
                    if (prod) {
                        prod.stock = res.data.stock;
                        updateProductStats(productsData);
                        renderProducts(productsData);
                        renderStockOutProducts(productsData);
                        renderStockManagementProducts(productsData);

                        if (currentDetailProduct && currentDetailProduct.uuid === uuid) {
                            $('#detailStockCount').text(prod.stock);
                            const profit = parseFloat(prod.retailer_price) - parseFloat(prod.main_price);
                            $('#detailTotalPotentialProfit').text('৳' + (profit * parseInt(prod.stock)).toFixed(2));
                        }
                    }
                }
            } catch (err) {
                console.error('Failed to adjust stock:', err);
            }
        }

        // ========================================================
        // 5.3 COMPREHENSIVE STOCK MANAGEMENT SYSTEM (ALL PRODUCTS)
        // ========================================================
        let currentStockManagementFilter = 'all'; // 'all' | 'inStock' | 'outStock' | 'hasVariants'
        let stockManagementDrafts = {}; // { [uuid]: { sizes: [...], colors: [...], stock: number, isModified: boolean } }
        let stockManagementOpenCards = {}; // { [uuid]: boolean }
        let stockManagementCurrentPage = 1;
        let stockManagementPerPage = 6; // default 6 items per page for balanced grid

        function setStockManagementFilter(mode) {
            currentStockManagementFilter = mode;
            stockManagementCurrentPage = 1;
            ['all', 'inStock', 'outStock', 'hasVariants'].forEach(m => {
                const $btn = $(`#smFilterBtn_${m}`);
                const capM = m.charAt(0).toUpperCase() + m.slice(1);
                const $cnt = $(`#smFilterCount${capM}`);
                if (m === mode) {
                    $btn.removeClass('bg-white hover:bg-slate-100 text-slate-700 border border-slate-200')
                        .addClass('bg-brand-600 text-white shadow-2xs border-transparent');
                    $cnt.removeClass('bg-emerald-50 text-emerald-700 bg-rose-50 text-rose-700 bg-indigo-50 text-indigo-700 bg-slate-100 text-slate-700 border border-emerald-200 border-rose-200 border-indigo-200 border-slate-200')
                        .addClass('bg-white/25 text-white font-black');
                } else {
                    $btn.removeClass('bg-brand-600 text-white shadow-2xs border-transparent')
                        .addClass('bg-white hover:bg-slate-100 text-slate-700 border border-slate-200');
                    $cnt.removeClass('bg-white/25 text-white');
                    if (m === 'all') {
                        $cnt.addClass('bg-slate-100 text-slate-700 border border-slate-200 font-bold');
                    } else if (m === 'inStock') {
                        $cnt.addClass('bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold');
                    } else if (m === 'outStock') {
                        $cnt.addClass('bg-rose-50 text-rose-700 border border-rose-200 font-bold');
                    } else if (m === 'hasVariants') {
                        $cnt.addClass('bg-indigo-50 text-indigo-700 border border-indigo-200 font-bold');
                    }
                }
            });
            renderStockManagementProducts(productsData);
        }

        function toggleStockManagementCard(uuid) {
            const $content = $(`#smCollapsible_${uuid}`);
            const $chevron = $(`#smChevron_${uuid}`);
            const $label = $(`#smToggleLabel_${uuid}`);
            const $btn = $(`#smToggleBtn_${uuid}`);

            const isCurrentlyHidden = $content.hasClass('hidden');
            if (isCurrentlyHidden) {
                $content.removeClass('hidden');
                $chevron.addClass('rotate-180 text-indigo-600');
                $label.text('সংকুচিত করুন');
                $btn.addClass('bg-indigo-50/70 border-indigo-200 text-indigo-900').removeClass('bg-slate-50 border-slate-200 text-slate-700');
                stockManagementOpenCards[uuid] = true;
            } else {
                $content.addClass('hidden');
                $chevron.removeClass('rotate-180 text-indigo-600');
                $label.text('স্টক পরিবর্তন');
                $btn.removeClass('bg-indigo-50/70 border-indigo-200 text-indigo-900').addClass('bg-slate-50 border-slate-200 text-slate-700');
                stockManagementOpenCards[uuid] = false;
            }
            if (window.lucide) lucide.createIcons();
        }

        function changeStockManagementPerPage(val) {
            stockManagementPerPage = (val === 'all') ? 'all' : (parseInt(val) || 6);
            stockManagementCurrentPage = 1;
            renderStockManagementProducts(productsData);
        }

        function changeStockManagementPage(page) {
            stockManagementCurrentPage = page;
            renderStockManagementProducts(productsData);
            const container = document.getElementById('tabContentStockManagement');
            if (container) {
                container.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function renderStockManagementPaginationButtons(totalPages) {
            const $btnContainer = $('#smPaginationButtons');
            $btnContainer.empty();

            if (totalPages <= 1) return;

            // Previous Button
            const prevDisabled = stockManagementCurrentPage <= 1;
            $btnContainer.append(`
                <button type="button" onclick="changeStockManagementPage(${stockManagementCurrentPage - 1})" ${prevDisabled ? 'disabled' : ''}
                    class="px-2.5 py-1 text-xs font-bold rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed shadow-2xs">
                    ‹ পূর্ববর্তী
                </button>
            `);

            // Smart Page Numbers Window
            let startPage = Math.max(1, stockManagementCurrentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            if (startPage > 1) {
                $btnContainer.append(`
                    <button type="button" onclick="changeStockManagementPage(1)"
                        class="w-7 h-7 text-xs font-bold rounded-lg transition cursor-pointer flex items-center justify-center border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-2xs">
                        ${toBnDigit(1)}
                    </button>
                `);
                if (startPage > 2) {
                    $btnContainer.append(`<span class="px-1 text-xs text-slate-400">...</span>`);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                const isActive = (i === stockManagementCurrentPage);
                $btnContainer.append(`
                    <button type="button" onclick="changeStockManagementPage(${i})"
                        class="w-7 h-7 text-xs font-bold rounded-lg transition cursor-pointer flex items-center justify-center ${isActive ? 'bg-indigo-600 text-white shadow-2xs' : 'border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-2xs'}">
                        ${toBnDigit(i)}
                    </button>
                `);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    $btnContainer.append(`<span class="px-1 text-xs text-slate-400">...</span>`);
                }
                $btnContainer.append(`
                    <button type="button" onclick="changeStockManagementPage(${totalPages})"
                        class="w-7 h-7 text-xs font-bold rounded-lg transition cursor-pointer flex items-center justify-center border border-slate-200 text-slate-700 hover:bg-slate-50 shadow-2xs">
                        ${toBnDigit(totalPages)}
                    </button>
                `);
            }

            // Next Button
            const nextDisabled = stockManagementCurrentPage >= totalPages;
            $btnContainer.append(`
                <button type="button" onclick="changeStockManagementPage(${stockManagementCurrentPage + 1})" ${nextDisabled ? 'disabled' : ''}
                    class="px-2.5 py-1 text-xs font-bold rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed shadow-2xs">
                    পরবর্তী ›
                </button>
            `);
        }

        function renderStockManagementProducts(list) {
            const $grid = $('#stockManagementGridContainer');
            const $pagination = $('#stockManagementPagination');
            if (!$grid.length) return;
            $grid.empty();

            const search = $('#stockManagementSearchInput').val() ? $('#stockManagementSearchInput').val().trim().toLowerCase() : '';

            const filteredList = list.filter(p => {
                const status = getProductStockOutStatus(p);
                const stock = parseInt(p.stock) || 0;

                let matchesFilter = false;
                if (currentStockManagementFilter === 'all') {
                    matchesFilter = true;
                } else if (currentStockManagementFilter === 'inStock') {
                    matchesFilter = stock > 0;
                } else if (currentStockManagementFilter === 'outStock') {
                    matchesFilter = stock <= 0;
                } else if (currentStockManagementFilter === 'hasVariants') {
                    matchesFilter = status.parsedSizes.length > 0 || status.parsedColors.length > 0;
                }

                if (!matchesFilter) return false;

                if (!search) return true;

                const nameMatch = (p.name || '').toLowerCase().includes(search);
                const catMatch = (p.category_name || '').toLowerCase().includes(search);
                const sizeMatch = status.parsedSizes.some(s => s.name.toLowerCase().includes(search));
                const colorMatch = status.parsedColors.some(c => c.name.toLowerCase().includes(search));

                return nameMatch || catMatch || sizeMatch || colorMatch;
            });

            if (filteredList.length === 0) {
                let emptyMsg = 'কোনো পণ্য পাওয়া যায়নি!';
                let emptySub = 'আপনার অনুসন্ধানের সাথে মিলে এমন কোনো পণ্য পাওয়া যায়নি।';
                if (currentStockManagementFilter === 'outStock') {
                    emptyMsg = 'স্টক শেষ এমন কোনো পণ্য নেই!';
                    emptySub = 'স্টোরের সকল পণ্যের পর্যাপ্ত স্টক অবশিষ্ট রয়েছে।';
                }

                $grid.append(`
                    <div class="col-span-full py-16 text-center flex flex-col items-center justify-center space-y-3 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100 shadow-xs">
                            <i data-lucide="package-search" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">${emptyMsg}</h4>
                        <p class="text-xs text-slate-500 max-w-sm">${emptySub}</p>
                    </div>
                `);
                if ($pagination.length) $pagination.addClass('hidden');
                lucide.createIcons();
                return;
            }

            // Pagination calculation
            const totalItems = filteredList.length;
            const perPage = (stockManagementPerPage === 'all') ? totalItems : (parseInt(stockManagementPerPage) || 6);
            const totalPages = perPage > 0 ? Math.ceil(totalItems / perPage) : 1;

            if (stockManagementCurrentPage > totalPages) {
                stockManagementCurrentPage = Math.max(1, totalPages);
            }

            const startIndex = (stockManagementCurrentPage - 1) * perPage;
            const endIndex = Math.min(startIndex + perPage, totalItems);
            const paginatedSlice = (stockManagementPerPage === 'all') ? filteredList : filteredList.slice(startIndex, endIndex);

            // Update Pagination UI
            if ($pagination.length) {
                $pagination.removeClass('hidden');
                $('#smPaginationSummary').text(`${toBnDigit(startIndex + 1)} থেকে ${toBnDigit(endIndex)} (মোট ${toBnDigit(totalItems)}টি পণ্য)`);
                renderStockManagementPaginationButtons(totalPages);
            }

            paginatedSlice.forEach(p => {
                const status = getProductStockOutStatus(p);
                const retailerPrice = parseFloat(p.retailer_price) || 0;
                const imgThumbUrl = (p.images && p.images[0]) ? p.images[0] : null;

                if (!stockManagementDrafts[p.uuid] || !stockManagementDrafts[p.uuid].isModified) {
                    stockManagementDrafts[p.uuid] = {
                        sizes: JSON.parse(JSON.stringify(status.parsedSizes)),
                        colors: JSON.parse(JSON.stringify(status.parsedColors)),
                        stock: status.stock,
                        isModified: false
                    };
                }
                const draft = stockManagementDrafts[p.uuid];

                const hasSizes = draft.sizes && draft.sizes.length > 0;
                const hasColors = draft.colors && draft.colors.length > 0;

                const apparelSizes = ['s', 'm', 'l', 'xl', 'xxl', '2xl', '3xl', 'free size', 'free-size', '28', '30', '32', '34', '36', '38', '40', '42', '44'];
                const isVariant = hasSizes && draft.sizes.some(s => s.name && !apparelSizes.includes(s.name.trim().toLowerCase()));
                const variantHeading = isVariant ? 'ভ্যারিয়েন্ট তালিকা ও স্টক সংখ্যা:' : 'সাইজ তালিকা ও স্টক সংখ্যা:';

                // Status Badge
                let statusBadge = '';
                if (draft.stock <= 0) {
                    statusBadge = `<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-rose-100 text-rose-700 border border-rose-200 shadow-2xs shrink-0"><i data-lucide="alert-octagon" class="w-3.5 h-3.5"></i><span>স্টক শেষ (০)</span></span>`;
                } else if (status.isPartial) {
                    const zeroNames = status.zeroSizes.map(s => s.name).join(', ') || status.zeroColors.map(c => c.name).join(', ');
                    statusBadge = `<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-amber-100 text-amber-800 border border-amber-200 shadow-2xs shrink-0"><i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i><span>সাইজ সতর্কতা (${escapeHtml(zeroNames)})</span></span>`;
                } else {
                    statusBadge = `<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-2xs shrink-0"><i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i><span>স্টকে আছে (${toBnDigit(draft.stock)} টি)</span></span>`;
                }

                // Sizes / Variants rows
                let sizesHtml = '';
                if (hasSizes) {
                    sizesHtml = `
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-bold text-slate-700 flex items-center space-x-1.5">
                                    <i data-lucide="${isVariant ? 'layers' : 'shirt'}" class="w-3.5 h-3.5 text-indigo-600"></i>
                                    <span>${variantHeading}</span>
                                </span>
                                <span class="text-[11px] text-slate-500 font-semibold">মোট স্টক: <b id="smTotalBadge_${p.uuid}" class="text-indigo-600 font-black">${toBnDigit(draft.stock)} টি</b></span>
                            </div>
                            <div class="space-y-1.5 max-h-48 overflow-y-auto pr-0.5" id="smSizeRows_${p.uuid}">
                                ${draft.sizes.map((s, idx) => {
                                    const isZero = (parseInt(s.stock) || 0) <= 0;
                                    const rowBorder = isZero ? 'border-rose-200 bg-rose-50/50 hover:border-rose-300' : 'border-slate-200 bg-slate-50/70 hover:border-indigo-200';
                                    const tagBadge = isZero
                                        ? `<span id="smTag_${p.uuid}_size_${idx}" class="text-[10px] font-bold text-rose-600 bg-rose-100/90 px-1.5 py-0.5 rounded border border-rose-200">স্টক ০ (শেষ)</span>`
                                        : `<span id="smTag_${p.uuid}_size_${idx}" class="text-[10px] font-semibold text-slate-600 bg-white px-1.5 py-0.5 rounded border border-slate-200">${toBnDigit(s.stock)} টি</span>`;

                                    return `
                                        <div id="smRow_${p.uuid}_size_${idx}" class="flex items-center justify-between px-2.5 py-1.5 ${rowBorder} border rounded-xl text-xs transition">
                                            <div class="flex items-center space-x-2 min-w-0 pr-1">
                                                <span class="w-5 h-5 rounded bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-[10px] shrink-0">${toBnDigit(idx + 1)}</span>
                                                <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md font-bold text-slate-800 text-xs truncate max-w-[120px]">${escapeHtml(s.name)}</span>
                                                ${tagBadge}
                                            </div>
                                            <div class="flex items-center space-x-1 shrink-0">
                                                <button type="button" onclick="changeStockManagementItem('${p.uuid}', 'size', ${idx}, -1)" class="w-8 h-8 sm:w-7 sm:h-7 rounded-lg bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95" title="১ কমান">-</button>
                                                <input type="number" min="0" value="${s.stock}" id="smInput_${p.uuid}_size_${idx}" oninput="onStockManagementInput('${p.uuid}', 'size', ${idx}, this.value)" onkeydown="if(event.key==='Enter'){ event.preventDefault(); saveStockManagementChanges('${p.uuid}'); }" class="w-12 h-8 sm:h-7 text-center py-1 border border-slate-300 rounded-lg text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white shadow-2xs">
                                                <button type="button" onclick="changeStockManagementItem('${p.uuid}', 'size', ${idx}, 1)" class="w-8 h-8 sm:w-7 sm:h-7 rounded-lg bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 border border-indigo-600 text-white flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95" title="১ বাড়ান">+</button>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                }

                // Colors rows
                let colorsHtml = '';
                if (hasColors) {
                    colorsHtml = `
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-bold text-slate-700 flex items-center space-x-1.5">
                                    <i data-lucide="palette" class="w-3.5 h-3.5 text-blue-600"></i>
                                    <span>রঙ তালিকা ও স্টক সংখ্যা:</span>
                                </span>
                            </div>
                            <div class="space-y-1.5 max-h-40 overflow-y-auto pr-0.5">
                                ${draft.colors.map((c, idx) => {
                                    const isZero = (parseInt(c.stock) || 0) <= 0;
                                    const rowBorder = isZero ? 'border-rose-200 bg-rose-50/50' : 'border-slate-200 bg-slate-50/70';
                                    const tagBadge = isZero
                                        ? `<span id="smTag_${p.uuid}_color_${idx}" class="text-[10px] font-bold text-rose-600 bg-rose-100/90 px-1.5 py-0.5 rounded border border-rose-200">স্টক ০ (শেষ)</span>`
                                        : `<span id="smTag_${p.uuid}_color_${idx}" class="text-[10px] font-semibold text-slate-600 bg-white px-1.5 py-0.5 rounded border border-slate-200">${toBnDigit(c.stock)} টি</span>`;

                                    return `
                                        <div id="smRow_${p.uuid}_color_${idx}" class="flex items-center justify-between px-2.5 py-1.5 ${rowBorder} border rounded-xl text-xs transition">
                                            <div class="flex items-center space-x-2 min-w-0 pr-1">
                                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span>
                                                <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md font-bold text-slate-800 text-xs truncate max-w-[120px]">${escapeHtml(c.name)}</span>
                                                ${tagBadge}
                                            </div>
                                            <div class="flex items-center space-x-1 shrink-0">
                                                <button type="button" onclick="changeStockManagementItem('${p.uuid}', 'color', ${idx}, -1)" class="w-8 h-8 sm:w-7 sm:h-7 rounded-lg bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95">-</button>
                                                <input type="number" min="0" value="${c.stock}" id="smInput_${p.uuid}_color_${idx}" oninput="onStockManagementInput('${p.uuid}', 'color', ${idx}, this.value)" onkeydown="if(event.key==='Enter'){ event.preventDefault(); saveStockManagementChanges('${p.uuid}'); }" class="w-12 h-8 sm:h-7 text-center py-1 border border-slate-300 rounded-lg text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white shadow-2xs">
                                                <button type="button" onclick="changeStockManagementItem('${p.uuid}', 'color', ${idx}, 1)" class="w-8 h-8 sm:w-7 sm:h-7 rounded-lg bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 border border-indigo-600 text-white flex items-center justify-center font-black text-sm cursor-pointer select-none shadow-2xs active:scale-95">+</button>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                }

                // Simple product
                let simpleHtml = '';
                if (!hasSizes && !hasColors) {
                    simpleHtml = `
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl">
                                <div>
                                    <span class="text-xs font-bold text-slate-800 block">ইনভেন্টরি স্টক:</span>
                                    <span class="text-[10px] text-slate-400">এই পণ্যের কোনো সাইজ বা ভ্যারিয়েন্ট নেই</span>
                                </div>
                                <div class="flex items-center space-x-1.5">
                                    <button type="button" onclick="changeStockManagementSimple('${p.uuid}', -1)" class="w-8 h-8 sm:w-7 sm:h-7 rounded-lg bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm cursor-pointer shadow-2xs active:scale-95">-</button>
                                    <input type="number" min="0" value="${draft.stock}" id="smInput_${p.uuid}_simple" oninput="onStockManagementSimpleInput('${p.uuid}', this.value)" onkeydown="if(event.key==='Enter'){ event.preventDefault(); saveStockManagementChanges('${p.uuid}'); }" class="w-14 h-8 sm:h-7 text-center py-1 border border-slate-300 rounded-lg text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white shadow-2xs">
                                    <button type="button" onclick="changeStockManagementSimple('${p.uuid}', 1)" class="w-8 h-8 sm:w-7 sm:h-7 rounded-lg bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 border border-indigo-600 text-white flex items-center justify-center font-black text-sm cursor-pointer shadow-2xs active:scale-95">+</button>
                                </div>
                            </div>
                        </div>
                    `;
                }

                const imgHtml = imgThumbUrl
                    ? `<img src="${imgThumbUrl}" alt="${escapeHtml(p.name)}" class="w-full h-full object-cover">`
                    : `<div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100"><i data-lucide="package" class="w-6 h-6"></i></div>`;

                // Collapsible State (Alerted products start open, others collapsed)
                const isOpen = (stockManagementOpenCards[p.uuid] !== undefined) ? !!stockManagementOpenCards[p.uuid] : status.isAny;
                const variantCount = hasSizes ? draft.sizes.length : (hasColors ? draft.colors.length : 1);
                const variantTypeLabel = hasSizes ? (isVariant ? 'ভ্যারিয়েন্ট' : 'সাইজ') : (hasColors ? 'রঙ' : 'আইটেম');
                const toggleBadgeTitle = `${toBnDigit(variantCount)}টি ${variantTypeLabel}`;

                $grid.append(`
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-3.5 sm:p-5 shadow-2xs hover:shadow-sm transition flex flex-col justify-between space-y-3 relative overflow-hidden" id="smCard_${p.uuid}">
                        <!-- Top Metadata Row -->
                        <div class="flex items-start justify-between gap-2.5 sm:gap-3">
                            <div class="flex items-center space-x-2.5 sm:space-x-3 min-w-0 flex-1">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shrink-0">
                                    ${imgHtml}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center space-x-1.5 mb-0.5">
                                        <span class="inline-flex items-center space-x-1 px-1.5 py-0.5 bg-slate-100 text-slate-600 rounded text-[10px] font-semibold truncate max-w-[140px]">
                                            <i data-lucide="tag" class="w-2.5 h-2.5 text-slate-400"></i>
                                            <span>${escapeHtml(p.category_name || 'Unnamed')}</span>
                                        </span>
                                    </div>
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 truncate mb-1" title="${escapeHtml(p.name)}">
                                        ${escapeHtml(p.name)}
                                    </h4>
                                    <div class="text-[11px] text-slate-500 font-medium truncate">
                                        বিক্রয় মূল্য: <b class="text-slate-900">৳${retailerPrice.toFixed(2)}</b>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0">
                                ${statusBadge}
                            </div>
                        </div>

                        <!-- Collapsible Toggle Trigger Button -->
                        <button type="button" onclick="toggleStockManagementCard('${p.uuid}')" id="smToggleBtn_${p.uuid}"
                            class="w-full flex items-center justify-between px-3 py-2 sm:px-3.5 sm:py-2.5 ${isOpen ? 'bg-indigo-50/70 border-indigo-200 text-indigo-900' : 'bg-slate-50 border-slate-200 text-slate-700'} hover:bg-indigo-50/50 border rounded-xl text-xs font-bold transition cursor-pointer shadow-2xs group">
                            <div class="flex items-center space-x-2">
                                <span class="w-6 h-6 rounded-lg ${isOpen ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-200/70 text-slate-600'} flex items-center justify-center transition">
                                    <i data-lucide="${hasSizes ? (isVariant ? 'layers' : 'shirt') : (hasColors ? 'palette' : 'boxes')}" class="w-3.5 h-3.5"></i>
                                </span>
                                <span class="font-extrabold text-xs text-slate-800">${hasSizes || hasColors ? 'ভ্যারিয়েন্ট ও স্টক সমন্বয়' : 'স্টক সমন্বয়'} (${toggleBadgeTitle})</span>
                            </div>
                            <div class="flex items-center space-x-1.5 text-slate-400 group-hover:text-slate-600">
                                <span class="text-[11px] font-semibold text-slate-500 hidden sm:inline" id="smToggleLabel_${p.uuid}">${isOpen ? 'সংকুচিত করুন' : 'স্টক পরিবর্তন'}</span>
                                <i data-lucide="chevron-down" id="smChevron_${p.uuid}" class="w-4 h-4 transition-transform duration-200 ${isOpen ? 'rotate-180 text-indigo-600' : ''}"></i>
                            </div>
                        </button>

                        <!-- Collapsible Body (Hidden by default unless alerted or toggled) -->
                        <div id="smCollapsible_${p.uuid}" class="${isOpen ? '' : 'hidden'} space-y-3 pt-1 border-t border-slate-100 transition-all">
                            ${sizesHtml}
                            ${colorsHtml}
                            ${simpleHtml}

                            <!-- Action Footer inside Collapsible -->
                            <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between gap-2">
                                <button type="button" onclick="openProductDetailsModal('${p.uuid}')" class="px-3 py-2 text-xs text-slate-600 hover:text-brand-600 hover:bg-brand-50 border border-slate-200 rounded-xl transition flex items-center space-x-1.5 cursor-pointer font-bold shadow-2xs" title="পণ্যের বিস্তারিত দেখুন">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span>বিস্তারিত</span>
                                </button>

                                <button type="button" onclick="saveStockManagementChanges('${p.uuid}')" id="smSaveBtn_${p.uuid}"
                                    class="flex-1 sm:flex-none px-4 py-2 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white rounded-xl text-xs font-bold transition shadow-xs flex items-center justify-center space-x-1.5 cursor-pointer">
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    <span>স্টক সেভ করুন</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
            });

            lucide.createIcons();
        }

        function changeStockManagementItem(uuid, type, idx, delta) {
            const draft = stockManagementDrafts[uuid];
            if (!draft) return;

            const list = type === 'size' ? draft.sizes : draft.colors;
            if (!list || !list[idx]) return;

            const current = parseInt(list[idx].stock) || 0;
            const updated = Math.max(0, current + delta);
            list[idx].stock = updated;
            draft.isModified = true;

            $(`#smInput_${uuid}_${type}_${idx}`).val(updated);

            const $tag = $(`#smTag_${uuid}_${type}_${idx}`);
            const $row = $(`#smRow_${uuid}_${type}_${idx}`);

            if (updated === 0) {
                $tag.removeClass('bg-white text-slate-600 border-slate-200')
                    .addClass('bg-rose-100/90 text-rose-600 border-rose-200 font-bold')
                    .text('স্টক ০ (শেষ)');
                $row.removeClass('border-slate-200 bg-slate-50/70')
                    .addClass('border-rose-200 bg-rose-50/50');
            } else {
                $tag.removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                    .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                    .text(toBnDigit(updated) + ' টি');
                $row.removeClass('border-rose-200 bg-rose-50/50')
                    .addClass('border-slate-200 bg-slate-50/70');
            }

            if (type === 'size' && draft.sizes.length > 0) {
                draft.stock = draft.sizes.reduce((sum, s) => sum + (parseInt(s.stock) || 0), 0);
                $(`#smTotalBadge_${uuid}`).text(toBnDigit(draft.stock) + ' টি');
            } else if (type === 'color' && (!draft.sizes || draft.sizes.length === 0)) {
                draft.stock = draft.colors.reduce((sum, c) => sum + (parseInt(c.stock) || 0), 0);
            }

            $(`#smSaveBtn_${uuid}`).addClass('ring-2 ring-indigo-400');
        }

        function onStockManagementInput(uuid, type, idx, val) {
            const draft = stockManagementDrafts[uuid];
            if (!draft) return;

            const list = type === 'size' ? draft.sizes : draft.colors;
            if (!list || !list[idx]) return;

            const updated = Math.max(0, parseInt(val) || 0);
            list[idx].stock = updated;
            draft.isModified = true;

            const $tag = $(`#smTag_${uuid}_${type}_${idx}`);
            const $row = $(`#smRow_${uuid}_${type}_${idx}`);

            if (updated === 0) {
                $tag.removeClass('bg-white text-slate-600 border-slate-200')
                    .addClass('bg-rose-100/90 text-rose-600 border-rose-200 font-bold')
                    .text('স্টক ০ (শেষ)');
                $row.removeClass('border-slate-200 bg-slate-50/70')
                    .addClass('border-rose-200 bg-rose-50/50');
            } else {
                $tag.removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                    .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                    .text(toBnDigit(updated) + ' টি');
                $row.removeClass('border-rose-200 bg-rose-50/50')
                    .addClass('border-slate-200 bg-slate-50/70');
            }

            if (type === 'size' && draft.sizes.length > 0) {
                draft.stock = draft.sizes.reduce((sum, s) => sum + (parseInt(s.stock) || 0), 0);
                $(`#smTotalBadge_${uuid}`).text(toBnDigit(draft.stock) + ' টি');
            } else if (type === 'color' && (!draft.sizes || draft.sizes.length === 0)) {
                draft.stock = draft.colors.reduce((sum, c) => sum + (parseInt(c.stock) || 0), 0);
            }

            $(`#smSaveBtn_${uuid}`).addClass('ring-2 ring-indigo-400');
        }

        function changeStockManagementSimple(uuid, delta) {
            const draft = stockManagementDrafts[uuid];
            if (!draft) return;
            const updated = Math.max(0, (parseInt(draft.stock) || 0) + delta);
            draft.stock = updated;
            draft.isModified = true;
            $(`#smInput_${uuid}_simple`).val(updated);
            $(`#smSaveBtn_${uuid}`).addClass('ring-2 ring-indigo-400');
        }

        function onStockManagementSimpleInput(uuid, val) {
            const draft = stockManagementDrafts[uuid];
            if (!draft) return;
            draft.stock = Math.max(0, parseInt(val) || 0);
            draft.isModified = true;
            $(`#smSaveBtn_${uuid}`).addClass('ring-2 ring-indigo-400');
        }

        function quickStockManagementBatchAdd(uuid, amount = 5) {
            const draft = stockManagementDrafts[uuid];
            if (!draft) return;

            let changed = false;
            if (draft.sizes && draft.sizes.length > 0) {
                draft.sizes.forEach((s, idx) => {
                    s.stock = (parseInt(s.stock) || 0) + amount;
                    changed = true;
                    $(`#smInput_${uuid}_size_${idx}`).val(s.stock);
                    $(`#smTag_${uuid}_size_${idx}`).removeClass('bg-rose-100/90 text-rose-600 border-rose-200')
                        .addClass('bg-white text-slate-600 border-slate-200 font-semibold')
                        .text(toBnDigit(s.stock) + ' টি');
                    $(`#smRow_${uuid}_size_${idx}`).removeClass('border-rose-200 bg-rose-50/50')
                        .addClass('border-slate-200 bg-slate-50/70');
                });
                if (changed) {
                    draft.stock = draft.sizes.reduce((sum, s) => sum + (parseInt(s.stock) || 0), 0);
                    $(`#smTotalBadge_${uuid}`).text(toBnDigit(draft.stock) + ' টি');
                }
            } else if (draft.colors && draft.colors.length > 0) {
                draft.colors.forEach((c, idx) => {
                    c.stock = (parseInt(c.stock) || 0) + amount;
                    changed = true;
                    $(`#smInput_${uuid}_color_${idx}`).val(c.stock);
                });
                if (changed) {
                    draft.stock = draft.colors.reduce((sum, c) => sum + (parseInt(c.stock) || 0), 0);
                }
            } else {
                draft.stock = (parseInt(draft.stock) || 0) + amount;
                changed = true;
                $(`#smInput_${uuid}_simple`).val(draft.stock);
            }

            if (changed) {
                draft.isModified = true;
                $(`#smSaveBtn_${uuid}`).addClass('ring-2 ring-indigo-400');
                showToast(`+${toBnDigit(amount)}টি স্টক যুক্ত হয়েছে। সেভ করতে 'স্টক সেভ করুন' বাটনে চাপুন।`, 'info');
            }
        }

        async function saveStockManagementChanges(uuid) {
            const draft = stockManagementDrafts[uuid];
            if (!draft) return;

            const $btn = $(`#smSaveBtn_${uuid}`);
            if ($btn.prop('disabled')) return;
            const originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).addClass('opacity-70 cursor-not-allowed').html(`
                <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i>
                <span>সেভ হচ্ছে...</span>
            `);
            lucide.createIcons();

            try {
                const payload = {
                    stock: draft.stock
                };
                if (draft.sizes && draft.sizes.length > 0) {
                    payload.sizes = draft.sizes;
                }
                if (draft.colors && draft.colors.length > 0) {
                    payload.colors = draft.colors;
                }

                const res = await StoreApi.post(`products/${uuid}/stock`, payload);
                if (res.success && res.data) {
                    const prod = productsData.find(p => p.uuid === uuid);
                    if (prod) {
                        prod.stock = res.data.stock;
                        if (res.data.sizes) prod.sizes = res.data.sizes;
                        if (res.data.colors) prod.colors = res.data.colors;

                        draft.isModified = false;

                        updateProductStats(productsData);
                        renderProducts(productsData);
                        renderStockOutProducts(productsData);
                        renderStockManagementProducts(productsData);

                        Swal.fire({
                            icon: 'success',
                            title: 'স্টক সফলভাবে সংরক্ষিত হয়েছে!',
                            text: `"${prod.name}"-এর নতুন স্টক: ${toBnDigit(prod.stock)} টি`,
                            timer: 1600,
                            showConfirmButton: false
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ব্যর্থ হয়েছে',
                        text: res.message || 'স্টক আপডেট ব্যর্থ হয়েছে।'
                    });
                    $btn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed').html(originalBtnHtml);
                    lucide.createIcons();
                }
            } catch (err) {
                Swal.fire({ icon: 'error', text: err.message || 'নেটওয়ার্ক ত্রুটি' });
                $btn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed').html(originalBtnHtml);
                lucide.createIcons();
            }
        }

        $('#stockManagementSearchInput').on('input', () => renderStockManagementProducts(productsData));

        // ==========================================
        // 5.5 PRODUCT DETAILS MODAL (CLICK CARD)
        // ==========================================
        let currentDetailProduct = null;

        function openProductDetailsModal(uuid) {
            const p = productsData.find(item => item.uuid === uuid);
            if (!p) return;
            currentDetailProduct = p;

            $('#detailProdTitle').text(p.name);

            // Images Gallery
            const images = Array.isArray(p.images) ? p.images : [];
            const $mainImg = $('#detailMainImage');
            const $placeholder = $('#detailNoImagePlaceholder');
            const $thumbs = $('#detailThumbnailsRow');
            $thumbs.empty();

            if (images.length > 0) {
                $mainImg.attr('src', images[0]).show();
                $placeholder.hide();

                images.forEach((url, idx) => {
                    $thumbs.append(`
                        <button type="button" onclick="selectDetailThumbnail('${url}')" class="w-12 h-12 rounded-lg border-2 hover:border-brand-500 transition shrink-0 aspect-square overflow-hidden bg-slate-100 cursor-pointer ${idx === 0 ? 'border-brand-500' : 'border-slate-200'}">
                            <img src="${url}" class="w-full h-full object-cover">
                        </button>
                    `);
                });
                $thumbs.show();
            } else {
                $mainImg.hide();
                $placeholder.show();
                $thumbs.hide();
            }

            // Stock Count
            const stock = parseInt(p.stock) || 0;
            $('#detailStockCount').text(stock);

            // Pricing & Profit
            const mainPrice = parseFloat(p.main_price) || 0;
            const retailerPrice = parseFloat(p.retailer_price) || 0;
            const profit = parseFloat(p.profit) || (retailerPrice - mainPrice);
            const margin = retailerPrice > 0 ? ((profit / retailerPrice) * 100).toFixed(1) : 0;
            const totalProfit = profit * stock;

            $('#detailMainPrice').text('৳' + mainPrice.toFixed(2));
            $('#detailRetailerPrice').text('৳' + retailerPrice.toFixed(2));
            $('#detailProfitVal').text((profit >= 0 ? '+' : '') + '৳' + profit.toFixed(2));
            $('#detailProfitMargin').text(margin + '% মার্জিন');
            $('#detailTotalPotentialProfit').text('৳' + totalProfit.toFixed(2));

            // Sizes & Colors
            const $sizes = $('#detailSizesContainer');
            $sizes.empty();

            let sizesList = p.sizes;
            if (typeof sizesList === 'string') {
                try { sizesList = JSON.parse(sizesList); } catch(e) { sizesList = []; }
            }
            if (!Array.isArray(sizesList)) sizesList = [];

            let hasVariantStyle = false;
            const apparelSizes = ['s', 'm', 'l', 'xl', 'xxl', '2xl', '3xl', 'free size', 'free-size', '28', '30', '32', '34', '36', '38', '40', '42', '44'];

            if (sizesList.length > 0) {
                sizesList.forEach(s => {
                    let name = '';
                    let stock = null;
                    if (typeof s === 'object' && s !== null) {
                        const rawName = s.name || s.size || s.variant || s.val || s.value || s.title || '';
                        name = (typeof rawName === 'object' && rawName !== null) ? (rawName.name || rawName.size || JSON.stringify(rawName)) : String(rawName || '');
                        stock = s.stock !== undefined ? parseInt(s.stock) : (s.quantity !== undefined ? parseInt(s.quantity) : null);
                    } else {
                        name = String(s || '');
                    }
                    if (!name || name === '[object Object]') name = 'ভেরিয়েন্ট';

                    if (name && !apparelSizes.includes(name.trim().toLowerCase())) {
                        hasVariantStyle = true;
                    }
                    $sizes.append(`
                        <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-800 rounded-lg text-xs font-bold shadow-2xs">
                            <span>${escapeHtml(name)}</span>
                            ${stock !== null ? `<span class="text-[10px] text-slate-500 font-semibold bg-white px-1.5 py-0.5 rounded border border-slate-200">${toBnDigit(stock)}টি</span>` : ''}
                        </span>
                    `);
                });
            } else {
                $sizes.append('<span class="text-slate-400 text-xs">-</span>');
            }

            // Update label dynamically: ভ্যারিয়েন্টসমূহ vs সাইজসমূহ
            if (hasVariantStyle) {
                $('#detailSizesLabel').text('ভ্যারিয়েন্টসমূহ (Variants)');
            } else {
                $('#detailSizesLabel').text('সাইজসমূহ (Sizes)');
            }

            const $colors = $('#detailColorsContainer');
            $colors.empty();

            let colorsList = p.colors;
            if (typeof colorsList === 'string') {
                try { colorsList = JSON.parse(colorsList); } catch(e) { colorsList = []; }
            }
            if (!Array.isArray(colorsList)) colorsList = [];

            if (colorsList.length > 0) {
                colorsList.forEach(c => {
                    let name = '';
                    let stock = null;
                    if (typeof c === 'object' && c !== null) {
                        const rawName = c.name || c.color || c.val || c.value || c.title || '';
                        name = (typeof rawName === 'object' && rawName !== null) ? (rawName.name || JSON.stringify(rawName)) : String(rawName || '');
                        stock = c.stock !== undefined ? parseInt(c.stock) : (c.quantity !== undefined ? parseInt(c.quantity) : null);
                    } else {
                        name = String(c || '');
                    }
                    if (!name || name === '[object Object]') name = 'রঙ';

                    $colors.append(`
                        <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 bg-blue-50 border border-blue-200 text-blue-800 rounded-lg text-xs font-semibold shadow-2xs">
                            <span class="w-2 h-2 rounded-full bg-brand-600 inline-block"></span>
                            <span>${escapeHtml(name)}</span>
                            ${stock !== null ? `<span class="text-[10px] text-blue-600 font-bold bg-white px-1.5 py-0.5 rounded border border-blue-200">${toBnDigit(stock)}টি</span>` : ''}
                        </span>
                    `);
                });
            } else {
                $colors.append('<span class="text-slate-400 text-xs">-</span>');
            }

            // Description & Category
            $('#detailDescription').text(p.description || (currentLang === 'bn' ? 'কোনো বিবরণ যোগ করা হয়নি।' : 'No description provided.'));
            $('#detailCategory').text(p.category_name || 'Unnamed');

            // Action Buttons
            $('#btnDetailEdit').off('click').on('click', () => {
                closeProductDetailsModal();
                openEditProductModal(uuid);
            });

            $('#btnDetailDelete').off('click').on('click', () => {
                closeProductDetailsModal();
                deleteProduct(uuid, p.name);
            });

            $('#modalProductDetails').removeClass('hidden').css('display', 'flex');
            $('body').addClass('overflow-hidden');
            lucide.createIcons();
        }

        function selectDetailThumbnail(url) {
            $('#detailMainImage').attr('src', url);
            $('#detailThumbnailsRow button').each(function() {
                const img = $(this).find('img').attr('src');
                if (img === url) {
                    $(this).addClass('border-brand-500').removeClass('border-slate-200');
                } else {
                    $(this).removeClass('border-brand-500').addClass('border-slate-200');
                }
            });
        }

        function closeProductDetailsModal() {
            $('#modalProductDetails').addClass('hidden').css('display', 'none');
            $('body').removeClass('overflow-hidden');
            currentDetailProduct = null;
        }

        // ==========================================
        // 6. PRODUCT MODAL (CREATE / EDIT & COMPRESS)
        // ==========================================

        function calculateProfitPreview() {
            const main = parseFloat($('#fMainPrice').val()) || 0;
            const retailer = parseFloat($('#fRetailerPrice').val()) || 0;
            const profit = retailer - main;
            const margin = retailer > 0 ? ((profit / retailer) * 100).toFixed(1) : 0;

            $('#previewProfitVal').text('৳' + profit.toFixed(2));
            $('#previewProfitMargin').text(margin + '% মার্জিন');

            if (profit >= 0) {
                $('#previewProfitVal').removeClass('text-red-600').addClass('text-emerald-700');
            } else {
                $('#previewProfitVal').removeClass('text-emerald-700').addClass('text-red-600');
            }
        }

        function appendTag(inputId, val) {
            const el = document.getElementById(inputId);
            let current = el.value.trim();
            const items = current ? current.split(',').map(s => s.trim()) : [];
            if (!items.includes(val)) {
                items.push(val);
                el.value = items.join(', ');
            }
        }

        // ==========================================
        // 3-STEP DEDICATED PRODUCT WIZARD & VARIANTS
        // ==========================================
        let currentProductWizardStep = 1;
        let currentVariantMode = 'size';
        let savedSizeList = [
            { name: 'S', stock: 5 },
            { name: 'M', stock: 5 },
            { name: 'L', stock: 5 },
            { name: 'XL', stock: 5 }
        ];
        let savedVariantList = [
            { name: '128GB', stock: 5 },
            { name: '256GB', stock: 5 }
        ];
        let selectedVariants = [...savedSizeList];
        let selectedColors = [];

        function autoSlugFromName(name) {
            if (!name) {
                $('#fProdSlug').val('');
                $('#previewSlugUrl').text('-');
                return '';
            }
            let slug = name.toString().trim()
                .toLowerCase()
                .replace(/[\s\t\n\r_]+/g, '-')
                .replace(/[^\p{L}\p{M}\p{N}-]+/gu, '')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
            
            if (!slug) {
                slug = 'product-' + Date.now().toString().slice(-6);
            }
            $('#fProdSlug').val(slug);
            $('#previewSlugUrl').text('/' + slug);
            return slug;
        }

        function setVariantMode(mode) {
            if (currentVariantMode === mode) return;

            // Cache current items to respective list
            if (currentVariantMode === 'size') {
                savedSizeList = [...selectedVariants];
            } else {
                savedVariantList = [...selectedVariants];
            }

            currentVariantMode = mode;

            if (mode === 'size') {
                $('#boxSizeMode').removeClass('hidden');
                $('#boxVariantMode').addClass('hidden');
                $('#btnModeSize').addClass('text-brand-600 bg-white shadow-2xs').removeClass('text-slate-600 hover:text-slate-900');
                $('#btnModeVariant').removeClass('text-brand-600 bg-white shadow-2xs').addClass('text-slate-600 hover:text-slate-900');
                $('#variantListHeading').text('সাইজ তালিকা ও স্টক সংখ্যা:');

                selectedVariants = (savedSizeList && savedSizeList.length > 0) ? [...savedSizeList] : [
                    { name: 'S', stock: 5 },
                    { name: 'M', stock: 5 },
                    { name: 'L', stock: 5 },
                    { name: 'XL', stock: 5 }
                ];
            } else {
                $('#boxSizeMode').addClass('hidden');
                $('#boxVariantMode').removeClass('hidden');
                $('#btnModeVariant').addClass('text-brand-600 bg-white shadow-2xs').removeClass('text-slate-600 hover:text-slate-900');
                $('#btnModeSize').removeClass('text-brand-600 bg-white shadow-2xs').addClass('text-slate-600 hover:text-slate-900');
                $('#variantListHeading').text('ভ্যারিয়েন্ট তালিকা ও স্টক সংখ্যা:');

                selectedVariants = (savedVariantList && savedVariantList.length > 0) ? [...savedVariantList] : [
                    { name: '128GB', stock: 5 },
                    { name: '256GB', stock: 5 }
                ];
            }

            renderVariantItems();
            if (window.lucide) lucide.createIcons();
        }

        function toggleVariantSection(checked) {
            $('#variantSectionContainer').removeClass('hidden');
            updateTotalStockFromVariants();
            if (window.lucide) lucide.createIcons();
        }

        function addVariantItem(name, defaultStock = 5) {
            const cleanName = (name || '').trim();
            if (!cleanName) return;

            const exists = selectedVariants.some(v => v.name.toLowerCase() === cleanName.toLowerCase());
            if (exists) {
                Toast.info(`"${cleanName}" ইতিমধ্যে যুক্ত করা আছে।`);
                return;
            }

            selectedVariants.push({
                name: cleanName,
                stock: Math.max(0, parseInt(defaultStock) || 5)
            });

            renderVariantItems();
        }

        function addCustomVariant(type) {
            const inputId = type === 'size' ? '#inputCustomSize' : '#inputCustomVariant';
            const val = $(inputId).val().trim();
            if (!val) return;
            addVariantItem(val);
            $(inputId).val('');
        }

        function removeVariantItem(index) {
            selectedVariants.splice(index, 1);
            renderVariantItems();
        }

        function changeVariantStock(index, delta) {
            if (selectedVariants[index]) {
                const current = parseInt(selectedVariants[index].stock) || 0;
                selectedVariants[index].stock = Math.max(0, current + delta);
                renderVariantItems();
            }
        }

        function onVariantStockInput(index, val) {
            if (selectedVariants[index]) {
                selectedVariants[index].stock = Math.max(0, parseInt(val) || 0);
                updateTotalStockFromVariants();
            }
        }

        function onBaseStockManualChange() {
            updateTotalStockFromVariants();
        }

        function updateTotalStockFromVariants() {
            // Strictly auto-calculate from variant counting
            const total = selectedVariants.reduce((sum, item) => sum + (parseInt(item.stock) || 0), 0);
            $('#fStock').val(total);
            $('#sumStock').text(total);
            $('#displayTotalStockBadge').text(toBnDigit(total) + ' টি');
            updateColorSyncBadge();
        }

        function renderVariantItems() {
            const container = $('#variantItemsList');
            container.empty();

            if (selectedVariants.length === 0) {
                const emptyNoticeText = currentVariantMode === 'size'
                    ? 'কোনো সাইজ এখনো যুক্ত করা হয়নি। ওপরের বাটন চেপে সাইজ যোগ করুন।'
                    : 'কোনো ভ্যারিয়েন্ট এখনো যুক্ত করা হয়নি। ওপরের বক্সে লিখে প্লাস (+) বাটন চেপে যোগ করুন।';
                container.html(`
                    <div class="text-center py-2 text-xs text-slate-400 bg-white border border-dashed border-slate-200 rounded-lg" id="emptyVariantNotice">
                        ${emptyNoticeText}
                    </div>
                `);
                $('#variantCountLabel').text('০টি যুক্ত');
                updateTotalStockFromVariants();
                return;
            }

            $('#variantCountLabel').text(`${toBnDigit(selectedVariants.length)}টি যুক্ত`);

            selectedVariants.forEach((item, i) => {
                container.append(`
                    <div class="flex items-center justify-between px-2.5 py-2 sm:px-2.5 sm:py-1 bg-slate-50/80 border border-slate-200 rounded-xl sm:rounded-lg text-xs hover:border-brand-200 transition">
                        <div class="flex items-center space-x-1.5 sm:space-x-2 min-w-0 pr-1">
                            <span class="w-5 h-5 rounded bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-[10px] shrink-0">${toBnDigit(i + 1)}</span>
                            <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md sm:rounded font-bold text-slate-800 text-xs truncate">${escapeHtml(item.name)}</span>
                        </div>
                        <div class="flex items-center space-x-1 sm:space-x-1.5 shrink-0">
                            <button type="button" onclick="changeVariantStock(${i}, -1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm sm:text-xs cursor-pointer select-none shadow-2xs active:scale-95">-</button>
                            <input type="number" min="0" value="${item.stock}" oninput="onVariantStockInput(${i}, this.value)" class="w-11 sm:w-12 text-center py-1 sm:py-0.5 border border-slate-300 rounded-lg sm:rounded text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white">
                            <button type="button" onclick="changeVariantStock(${i}, 1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm sm:text-xs cursor-pointer select-none shadow-2xs active:scale-95">+</button>
                            <button type="button" onclick="removeVariantItem(${i})" class="w-7 h-7 sm:w-6 sm:h-6 text-slate-400 hover:text-red-600 flex items-center justify-center transition cursor-pointer active:scale-95" title="মুছুন">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                `);
            });

            updateTotalStockFromVariants();
            if (window.lucide) lucide.createIcons();
        }

        // Color Management with Strict Stock Synchronization
        function updateColorSyncBadge() {
            const badge = $('#colorStockSyncBadge');
            if (!badge.length) return;

            if (selectedColors.length === 0) {
                badge.addClass('hidden');
                return;
            }

            const totalStock = parseInt($('#fStock').val()) || 0;
            const colorSum = selectedColors.reduce((sum, item) => sum + (parseInt(item.stock) || 0), 0);

            badge.removeClass('hidden');
            if (colorSum === totalStock && totalStock > 0) {
                badge.removeClass('bg-rose-50 border-rose-200 text-rose-700 bg-amber-50 border-amber-200 text-amber-800')
                     .addClass('bg-emerald-50 border-emerald-200 text-emerald-700')
                     .html(`<i data-lucide="check" class="w-3 h-3 inline mr-1"></i> রঙের মোট স্টক মিলেছে (${toBnDigit(colorSum)}/${toBnDigit(totalStock)})`);
            } else if (colorSum < totalStock) {
                const diff = totalStock - colorSum;
                badge.removeClass('bg-emerald-50 border-emerald-200 text-emerald-700 bg-rose-50 border-rose-200 text-rose-700')
                     .addClass('bg-amber-50 border-amber-200 text-amber-800')
                     .html(`⚠️ রঙের স্টক অসম্পূর্ণ (${toBnDigit(colorSum)}/${toBnDigit(totalStock)} - বাকি ${toBnDigit(diff)}টি)`);
            } else {
                const excess = colorSum - totalStock;
                badge.removeClass('bg-emerald-50 border-emerald-200 text-emerald-700 bg-amber-50 border-amber-200 text-amber-800')
                     .addClass('bg-rose-50 border-rose-200 text-rose-700')
                     .html(`❌ রঙের স্টক অতিরিক্ত (${toBnDigit(colorSum)}/${toBnDigit(totalStock)} - অতিরিক্ত ${toBnDigit(excess)}টি)`);
            }
            if (window.lucide) lucide.createIcons();
        }

        function addColorItem(name, defaultStock = 5) {
            const cleanName = (name || '').trim();
            if (!cleanName) return;

            const exists = selectedColors.some(c => c.name.toLowerCase() === cleanName.toLowerCase());
            if (exists) {
                Toast.info(`"${cleanName}" রঙ ইতিমধ্যে যুক্ত আছে।`);
                return;
            }

            selectedColors.push({
                name: cleanName,
                stock: Math.max(0, parseInt(defaultStock) || 5)
            });

            renderColorItems();
        }

        function addCustomColor() {
            const val = $('#inputCustomColor').val().trim();
            if (!val) return;
            addColorItem(val);
            $('#inputCustomColor').val('');
        }

        function removeColorItem(index) {
            selectedColors.splice(index, 1);
            renderColorItems();
        }

        function changeColorStock(index, delta) {
            if (selectedColors[index]) {
                const current = parseInt(selectedColors[index].stock) || 0;
                selectedColors[index].stock = Math.max(0, current + delta);
                renderColorItems();
            }
        }

        function onColorStockInput(index, val) {
            if (selectedColors[index]) {
                selectedColors[index].stock = Math.max(0, parseInt(val) || 0);
                updateColorSyncBadge();
            }
        }

        function renderColorItems() {
            const container = $('#colorItemsList');
            container.empty();

            if (selectedColors.length === 0) {
                updateColorSyncBadge();
                return;
            }

            selectedColors.forEach((item, i) => {
                container.append(`
                    <div class="flex items-center justify-between px-2.5 py-2 sm:px-2.5 sm:py-1 bg-slate-50/80 border border-slate-200 rounded-xl sm:rounded-lg text-xs">
                        <div class="flex items-center space-x-1.5 sm:space-x-2 min-w-0 pr-1">
                            <i data-lucide="palette" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                            <span class="px-2 py-0.5 bg-white border border-slate-200 rounded-md sm:rounded text-xs font-semibold text-slate-800 truncate">${escapeHtml(item.name)}</span>
                        </div>
                        <div class="flex items-center space-x-1 sm:space-x-1.5 shrink-0">
                            <button type="button" onclick="changeColorStock(${i}, -1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm sm:text-xs cursor-pointer select-none shadow-2xs active:scale-95">-</button>
                            <input type="number" min="0" value="${item.stock}" oninput="onColorStockInput(${i}, this.value)" class="w-11 sm:w-12 text-center py-1 sm:py-0.5 border border-slate-300 rounded-lg sm:rounded text-xs font-bold text-slate-900 focus:outline-none focus:border-brand-600 bg-white">
                            <button type="button" onclick="changeColorStock(${i}, 1)" class="w-7 h-7 sm:w-6 sm:h-6 rounded-lg sm:rounded bg-white hover:bg-slate-100 active:bg-slate-200 border border-slate-300 text-slate-800 flex items-center justify-center font-black text-sm sm:text-xs cursor-pointer select-none shadow-2xs active:scale-95">+</button>
                            <button type="button" onclick="removeColorItem(${i})" class="w-7 h-7 sm:w-6 sm:h-6 text-slate-400 hover:text-red-600 flex items-center justify-center transition cursor-pointer active:scale-95" title="মুছুন">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                `);
            });

            updateColorSyncBadge();
            if (window.lucide) lucide.createIcons();
        }

        // Wizard Step Navigation with Per-Step Validation
        function goToStep(targetStep) {
            // Validation if moving forward from Step 1
            if (targetStep > 1 && currentProductWizardStep === 1) {
                const prodName = $('#fProdName').val().trim();
                if (!prodName || prodName.length < 2) {
                    $('#fProdName').focus().addClass('border-rose-500 ring-2 ring-rose-100');
                    Toast.warning('প্রোডাক্টের নাম লিখুন (কমপক্ষে ২ অক্ষর)।');
                    return;
                }
                $('#fProdName').removeClass('border-rose-500 ring-2 ring-rose-100');

                let slug = $('#fProdSlug').val().trim();
                if (!slug) {
                    autoSlugFromName(prodName);
                }
            }

            // Validation if moving forward from Step 2
            if (targetStep > 2 && (currentProductWizardStep === 2 || currentProductWizardStep === 1)) {
                const mainPrice = parseFloat($('#fMainPrice').val());
                if (isNaN(mainPrice) || mainPrice <= 0) {
                    goToStep(2);
                    $('#fMainPrice').focus().addClass('border-rose-500 ring-2 ring-rose-100');
                    Toast.warning('মেইন বা কেনা দাম (Cost Price) শূন্যের বেশি দিন।');
                    return;
                }
                $('#fMainPrice').removeClass('border-rose-500 ring-2 ring-rose-100');

                const retailerPrice = parseFloat($('#fRetailerPrice').val());
                if (isNaN(retailerPrice) || retailerPrice <= 0) {
                    goToStep(2);
                    $('#fRetailerPrice').focus().addClass('border-rose-500 ring-2 ring-rose-100');
                    Toast.warning('বিক্রয় মূল্য (Selling Price) শূন্যের বেশি দিন।');
                    return;
                }
                $('#fRetailerPrice').removeClass('border-rose-500 ring-2 ring-rose-100');

                // Strict Size/Variant Validation
                const totalStock = parseInt($('#fStock').val()) || 0;
                if (selectedVariants.length === 0) {
                    goToStep(2);
                    Toast.warning('কমপক্ষে একটি সাইজ বা ভ্যারিয়েন্ট যোগ করুন।');
                    return;
                }
                if (totalStock <= 0) {
                    goToStep(2);
                    Toast.warning('সাইজসমূহের মোট স্টক কমপক্ষে ১টি হতে হবে।');
                    return;
                }

                // Strict Color Stock Matching Validation
                if (selectedColors.length > 0) {
                    const colorSum = selectedColors.reduce((sum, item) => sum + (parseInt(item.stock) || 0), 0);
                    if (colorSum !== totalStock) {
                        goToStep(2);
                        Toast.warning(`রঙের মোট স্টক (${toBnDigit(colorSum)}টি) এবং সাইজের মোট স্টক (${toBnDigit(totalStock)}টি) সমান হতে হবে।`);
                        return;
                    }
                }
            }

            currentProductWizardStep = targetStep;

            // Show/Hide Step Sections
            $('#stepSection1').toggleClass('hidden', targetStep !== 1);
            $('#stepSection2').toggleClass('hidden', targetStep !== 2);
            $('#stepSection3').toggleClass('hidden', targetStep !== 3);

            // Update Wizard Buttons
            [1, 2, 3].forEach(s => {
                const btn = $('#wizardStepBtn' + s);
                if (s === targetStep) {
                    btn.addClass('text-brand-600 bg-brand-50 border border-brand-200/60 shadow-2xs')
                       .removeClass('text-slate-500 hover:text-slate-800 hover:bg-slate-50');
                } else {
                    btn.removeClass('text-brand-600 bg-brand-50 border border-brand-200/60 shadow-2xs')
                       .addClass('text-slate-500 hover:text-slate-800 hover:bg-slate-50');
                }
            });

            // Update Step Badge
            $('#stepNumberBadge').text(`${toBnDigit(targetStep)} / ৩`);

            // Step 3 Recap
            if (targetStep === 3) {
                const ret = parseFloat($('#fRetailerPrice').val()) || 0;
                const cost = parseFloat($('#fMainPrice').val()) || 0;
                const profit = ret - cost;
                $('#sumRetailPrice').text('৳' + ret.toFixed(2));
                $('#sumProfit').text('৳' + profit.toFixed(2));
                $('#sumStock').text($('#fStock').val() || 0);
            }

            if (window.lucide) lucide.createIcons();

            // Smooth scroll to top of wizard
            const el = document.getElementById('tabContentProductCreate');
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function showPackageLimitModal(msg, current, max) {
            const rem = Math.max(0, (max || 0) - (current || 0));
            if (msg) $('#modalLimitReachedMsg').text(msg);
            if (current !== undefined) $('#modalLimitReachedCurrent').text(toBnDigit(current) + ' টি');
            if (max !== undefined) $('#modalLimitReachedMax').text(toBnDigit(max) + ' টি');
            $('#modalLimitReachedRemaining').text(toBnDigit(rem) + ' টি');
            $('#modalPackageProductLimit').css('display', 'flex').removeClass('hidden');
            $('body').addClass('overflow-hidden');
            if (window.lucide) lucide.createIcons();
        }

        function closePackageLimitModal() {
            $('#modalPackageProductLimit').css('display', 'none').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        }

        $('#modalPackageProductLimit').on('click', function(e) {
            if (e.target === this) {
                closePackageLimitModal();
            }
        });

        function updateCreatePageLimitNotice(isEdit) {
            const currentCount = Array.isArray(productsData) ? productsData.length : 0;
            const pkgLimit = parseInt(storeData && storeData.product_limit !== undefined ? storeData.product_limit : 50, 10);
            const isUnlimited = (pkgLimit <= 0);
            const remaining = isUnlimited ? null : Math.max(0, pkgLimit - currentCount);
            const pkgName = storeData && storeData.package_name ? storeData.package_name : 'প্যাকেজ';

            $('#createLimitPackageName').text(pkgName);

            if (isEdit) {
                $('#createLimitUsedCount').text(toBnDigit(currentCount));
                $('#createLimitTotalMax').text(isUnlimited ? '∞' : toBnDigit(pkgLimit));
                $('#createLimitRemainingBadge').removeClass('bg-rose-600 bg-amber-500').addClass('bg-slate-700').text('সম্পাদনা মোড');
                return;
            }

            $('#createLimitUsedCount').text(toBnDigit(currentCount));
            $('#createLimitTotalMax').text(isUnlimited ? '∞' : toBnDigit(pkgLimit));

            if (isUnlimited) {
                $('#createLimitRemainingBadge').removeClass('bg-rose-600 bg-amber-500').addClass('bg-emerald-600').text('আনলিমিটেড বাকি');
            } else if (remaining <= 0) {
                $('#createLimitRemainingBadge').removeClass('bg-emerald-600 bg-amber-500').addClass('bg-rose-600 animate-pulse').text('আর বাকি নেই: ০ টি');
            } else {
                $('#createLimitRemainingBadge').removeClass('bg-emerald-600 bg-rose-600').addClass('bg-amber-500').text(`আর বাকি আছে: ${toBnDigit(remaining)} টি`);
            }
        }

        function openProductCreatePage() {
            // Check Package Product Upload Limit
            const currentCount = Array.isArray(productsData) ? productsData.length : 0;
            const pkgLimit = parseInt(storeData && storeData.product_limit !== undefined ? storeData.product_limit : 50, 10);
            const isUnlimited = (pkgLimit <= 0);

            if (!isUnlimited && currentCount >= pkgLimit) {
                showPackageLimitModal(
                    `আপনার প্রোডাক্ট আপলোডের লিমিট শেষ হয়ে গেছে। আপনার প্যাকেজের আওতায় সর্বোচ্চ ${toBnDigit(pkgLimit)}টি প্রোডাক্ট যোগ করার সীমা পূর্ণ হয়ে গেছে। আপনি আর নতুন প্রোডাক্ট যোগ করতে পারবেন না।`,
                    currentCount,
                    pkgLimit
                );
                Toast.error(`প্রোডাক্ট আপলোডের লিমিট (${toBnDigit(pkgLimit)}টি) শেষ হয়ে গেছে।`);
                return;
            }

            try {
                $('#productForm')[0].reset();
                $('#prodEditUuid').val('');
                $('#productPageTitle').text('নতুন প্রোডাক্ট যোগ করুন');
                $('#fProdName, #fProdCategory, #fMainPrice, #fRetailerPrice, #fStock').removeClass('border-rose-500 ring-2 ring-rose-100');
                $('#imageDropzone').removeClass('border-rose-500 bg-rose-50/20');
                $('#imageValidationError').addClass('hidden');

                existingImages = [];
                selectedNewFiles = [];
                currentVariantMode = 'size';
                savedSizeList = [
                    { name: 'S', stock: 5 },
                    { name: 'M', stock: 5 },
                    { name: 'L', stock: 5 },
                    { name: 'XL', stock: 5 }
                ];
                savedVariantList = [
                    { name: '128GB', stock: 5 },
                    { name: '256GB', stock: 5 }
                ];
                selectedVariants = [...savedSizeList];
                selectedColors = [];

                $('#boxSizeMode').removeClass('hidden');
                $('#boxVariantMode').addClass('hidden');
                $('#btnModeSize').addClass('text-brand-600 bg-white shadow-2xs').removeClass('text-slate-600 hover:text-slate-900');
                $('#btnModeVariant').removeClass('text-brand-600 bg-white shadow-2xs').addClass('text-slate-600 hover:text-slate-900');
                $('#variantListHeading').text('সাইজ তালিকা ও স্টক সংখ্যা:');

                $('#variantSectionContainer').removeClass('hidden');
                $('#fStatus').val('active');
                $('#previewSlugUrl').text('-');

                renderVariantItems();
                renderColorItems();
                renderImagePreviews();
                calculateProfitPreview();
                updateTotalStockFromVariants();

                // Ensure categories loaded and default selected
                if (categoriesData && categoriesData.length > 0) {
                    populateCategoryDropdown(categoriesData);
                } else if (defaultCategoryUuid) {
                    $('#fProdCategory').val(defaultCategoryUuid);
                }

                updateCreatePageLimitNotice(false);
                goToStep(1);
                switchTab('productCreate');
            } catch (err) {
                console.error('Error in openProductCreatePage:', err);
            }
        }

        function openProductEditPage(uuid) {
            try {
                const p = productsData.find(item => item.uuid === uuid);
                if (!p) {
                    Toast.error('প্রোডাক্ট পাওয়া যায়নি।');
                    return;
                }

                $('#productForm')[0].reset();
                $('#prodEditUuid').val(p.uuid);
                $('#productPageTitle').text('প্রোডাক্ট সম্পাদনা: ' + p.name);
                $('#fProdName, #fProdCategory, #fMainPrice, #fRetailerPrice, #fStock').removeClass('border-rose-500 ring-2 ring-rose-100');
                $('#imageDropzone').removeClass('border-rose-500 bg-rose-50/20');
                $('#imageValidationError').addClass('hidden');

                $('#fProdName').val(p.name);
                $('#fProdSlug').val(p.slug);
                $('#previewSlugUrl').text('/' + (p.slug || ''));
                $('#fDescription').val(p.description || '');
                $('#fMainPrice').val(p.main_price);
                $('#fRetailerPrice').val(p.retailer_price);
                $('#fStock').val(p.stock);
                $('#fStatus').val(p.status || 'active');

                // Populate categories
                if (categoriesData && categoriesData.length > 0) {
                    populateCategoryDropdown(categoriesData);
                }
                $('#fProdCategory').val(p.category_uuid || defaultCategoryUuid);

                // Parse variants (sizes)
                selectedVariants = [];
                const editSizesList = parseJsonSafeList(p.sizes);
                if (editSizesList.length > 0) {
                    editSizesList.forEach(s => {
                        let name = '';
                        let stock = 0;
                        if (typeof s === 'object' && s !== null) {
                            name = s.name || s.size || s.variant || s.val || s.value || '';
                            stock = parseInt(s.stock !== undefined ? s.stock : s.quantity) || 0;
                        } else if (typeof s === 'string' && s.trim()) {
                            name = s.trim();
                            stock = Math.floor((p.stock || 10) / editSizesList.length) || 1;
                        }
                        if (name) {
                            selectedVariants.push({ name: String(name), stock: stock });
                        }
                    });
                }

                // Parse colors
                selectedColors = [];
                const editColorsList = parseJsonSafeList(p.colors);
                if (editColorsList.length > 0) {
                    editColorsList.forEach(c => {
                        let name = '';
                        let stock = 0;
                        if (typeof c === 'object' && c !== null) {
                            name = c.name || c.color || c.val || c.value || '';
                            stock = parseInt(c.stock !== undefined ? c.stock : c.quantity) || 0;
                        } else if (typeof c === 'string' && c.trim()) {
                            name = c.trim();
                            stock = Math.floor((p.stock || 10) / editColorsList.length) || 1;
                        }
                        if (name) {
                            selectedColors.push({ name: String(name), stock: stock });
                        }
                    });
                }

                $('#variantSectionContainer').removeClass('hidden');

                existingImages = [...(p.images || [])];
                selectedNewFiles = [];

                renderVariantItems();
                renderColorItems();
                renderImagePreviews();
                calculateProfitPreview();

                updateCreatePageLimitNotice(true);
                goToStep(1);
                switchTab('productCreate');
            } catch (err) {
                console.error('Error in openProductEditPage:', err);
            }
        }

        function cancelProductForm() {
            switchTab('products');
        }

        // Backward compatibility modal aliases
        function openCreateProductModal() { openProductCreatePage(); }
        function openEditProductModal(uuid) { openProductEditPage(uuid); }
        function closeProductModal() { cancelProductForm(); }

        // Comprehensive 3-Step Wizard Form Submission
        async function submitProductWizard() {
            const editUuid = $('#prodEditUuid').val();
            const isEdit = !!editUuid;

            // Check Package Product Upload Limit for new product creation
            if (!isEdit) {
                const currentCount = Array.isArray(productsData) ? productsData.length : 0;
                const pkgLimit = parseInt(storeData && storeData.product_limit !== undefined ? storeData.product_limit : 50, 10);
                const isUnlimited = (pkgLimit <= 0);

                if (!isUnlimited && currentCount >= pkgLimit) {
                    showPackageLimitModal(
                        `আপনার প্রোডাক্ট আপলোডের লিমিট শেষ হয়ে গেছে। আপনার প্যাকেজের আওতায় সর্বোচ্চ ${toBnDigit(pkgLimit)}টি প্রোডাক্ট যোগ করার সীমা পূর্ণ হয়ে গেছে। আপনি আর নতুন প্রোডাক্ট যোগ করতে পারবেন না।`,
                        currentCount,
                        pkgLimit
                    );
                    Toast.error(`প্রোডাক্ট আপলোডের লিমিট (${toBnDigit(pkgLimit)}টি) শেষ হয়ে গেছে।`);
                    return;
                }
            }

            const productName = $('#fProdName').val().trim();

            // Validate Step 1
            if (!productName || productName.length < 2) {
                goToStep(1);
                $('#fProdName').focus().addClass('border-rose-500 ring-2 ring-rose-100');
                Toast.warning('প্রোডাক্টের নাম লিখুন (কমপক্ষে ২ অক্ষর)।');
                return;
            }

            const categoryUuid = $('#fProdCategory').val() || defaultCategoryUuid;

            // Validate Step 2
            const mainPrice = parseFloat($('#fMainPrice').val());
            if (isNaN(mainPrice) || mainPrice <= 0) {
                goToStep(2);
                $('#fMainPrice').focus().addClass('border-rose-500 ring-2 ring-rose-100');
                Toast.warning('মেইন বা কেনা দাম (Cost Price) শূন্যের বেশি দিন।');
                return;
            }

            const retailerPrice = parseFloat($('#fRetailerPrice').val());
            if (isNaN(retailerPrice) || retailerPrice <= 0) {
                goToStep(2);
                $('#fRetailerPrice').focus().addClass('border-rose-500 ring-2 ring-rose-100');
                Toast.warning('বিক্রয় মূল্য (Selling Price) শূন্যের বেশি দিন।');
                return;
            }

            // Strict Size/Variant Validation
            const totalStock = parseInt($('#fStock').val()) || 0;
            if (selectedVariants.length === 0) {
                goToStep(2);
                Toast.warning('কমপক্ষে একটি সাইজ বা ভ্যারিয়েন্ট যোগ করুন।');
                return;
            }
            if (totalStock <= 0) {
                goToStep(2);
                Toast.warning('সাইজসমূহের মোট স্টক কমপক্ষে ১টি হতে হবে।');
                return;
            }

            // Strict Color Stock Matching Validation
            if (selectedColors.length > 0) {
                const colorSum = selectedColors.reduce((sum, item) => sum + (parseInt(item.stock) || 0), 0);
                if (colorSum !== totalStock) {
                    goToStep(2);
                    Toast.warning(`রঙের মোট স্টক (${toBnDigit(colorSum)}টি) এবং সাইজের মোট স্টক (${toBnDigit(totalStock)}টি) সমান হতে হবে।`);
                    return;
                }
            }

            // Validate Step 3: Images
            const totalImages = existingImages.length + selectedNewFiles.length;
            if (totalImages === 0) {
                goToStep(3);
                $('#imageDropzone').addClass('border-rose-500 bg-rose-50/20');
                $('#imageValidationError').removeClass('hidden');
                Toast.warning('কমপক্ষে একটি ছবি আপলোড করতে হবে।');
                return;
            }
            if (totalImages > 5) {
                goToStep(3);
                Toast.warning('সর্বোচ্চ ৫টি ছবি রাখা যাবে। অতিরিক্ত ছবি মুছে ফেলুন।');
                return;
            }

            $('#btnSaveProduct').prop('disabled', true);
            $('#btnSaveProductText').text('সংরক্ষণ হচ্ছে...');

            try {
                // Convert new files to Base64 (WAF-proof)
                let newImagesBase64 = [];
                if (selectedNewFiles.length > 0) {
                    const base64Promises = selectedNewFiles.map(file => {
                        return new Promise((resolve, reject) => {
                            const reader = new FileReader();
                            reader.onload = () => resolve(reader.result);
                            reader.onerror = reject;
                            reader.readAsDataURL(file);
                        });
                    });
                    newImagesBase64 = await Promise.all(base64Promises);
                }

                // Format sizes & colors payload
                const sizesPayload = selectedVariants;
                const colorsPayload = selectedColors;

                const payload = {
                    store_uuid: STORE_UUID,
                    name: productName,
                    slug: $('#fProdSlug').val().trim() || autoSlugFromName(productName),
                    category_uuid: categoryUuid,
                    main_price: mainPrice,
                    retailer_price: retailerPrice,
                    stock: totalStock,
                    status: $('#fStatus').val() || 'active',
                    description: $('#fDescription').val().trim(),
                    sizes: sizesPayload,
                    colors: colorsPayload,
                    images: existingImages,
                    images_base64: newImagesBase64
                };

                let res;
                if (isEdit) {
                    res = await StoreApi.put(`products/${editUuid}?store=${STORE_UUID}`, payload);
                } else {
                    res = await StoreApi.post(`products?store=${STORE_UUID}`, payload);
                }

                if (res.success && res.data) {
                    Toast.success('প্রোডাক্ট সফলভাবে সংরক্ষণ করা হয়েছে!');
                    await loadProducts();
                    switchTab('products');
                } else {
                    if (res.data && res.data.limit_reached) {
                        showPackageLimitModal(res.message, res.data.current_count, res.data.product_limit);
                    }
                    Toast.error(res.message || 'প্রোডাক্ট সংরক্ষণ ব্যর্থ হয়েছে।');
                }
            } catch (err) {
                console.error('Error saving product:', err);
                Toast.error(err.message || 'নেটওয়ার্ক ত্রুটি ঘটেছে।');
            } finally {
                $('#btnSaveProduct').prop('disabled', false);
                $('#btnSaveProductText').text('প্রোডাক্ট সংরক্ষণ ও প্রকাশ করুন');
            }
        }

        $('#modalCategory').on('click', function(e) {
            if (e.target === this) {
                closeCategoryModal();
            }
        });

        $('#modalProductDetails').on('click', function(e) {
            if (e.target === this) {
                closeProductDetailsModal();
            }
        });

        // Close modals on Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                if ($('#modalProductDetails').is(':visible')) {
                    closeProductDetailsModal();
                } else if ($('#modalProduct').is(':visible')) {
                    closeProductModal();
                } else if ($('#modalCategory').is(':visible')) {
                    closeCategoryModal();
                }
            }
        });

        function processSelectedFiles(fileList) {
            if (!fileList || fileList.length === 0) return;
            const files = Array.from(fileList);
            const currentCount = existingImages.length + selectedNewFiles.length;

            if (currentCount >= 5) {
                Toast.warning('একটি প্রোডাক্টে সর্বোচ্চ ৫টি ছবি আপলোড করা যাবে। ছবির সীমা পূর্ণ হয়েছে।');
                return;
            }

            const allowed = 5 - currentCount;
            const validFiles = files.filter(f => f.type && f.type.startsWith('image/'));

            if (validFiles.length > allowed) {
                Toast.info(`সর্বোচ্চ ৫টি ছবির সীমা অনুযায়ী প্রথম ${toBnDigit(allowed)}টি ছবি গ্রহণ করা হয়েছে।`);
            }

            validFiles.slice(0, allowed).forEach(f => selectedNewFiles.push(f));
            renderImagePreviews();
        }

        // Image Selection Handler (Client-side limit max 5)
        function handleImageSelection(event) {
            if (event.target && event.target.files) {
                processSelectedFiles(event.target.files);
                event.target.value = '';
            }
        }

        function setupImageDropzone() {
            const dropzone = document.getElementById('imageDropzone');
            if (!dropzone) return;

            ['dragenter', 'dragover'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('border-brand-500', 'bg-brand-50/50');
                });
            });

            ['dragleave', 'drop'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('border-brand-500', 'bg-brand-50/50');
                });
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('border-brand-500', 'bg-brand-50/50');
                if (e.dataTransfer && e.dataTransfer.files) {
                    processSelectedFiles(e.dataTransfer.files);
                }
            });
        }

        function removeExistingImage(index) {
            existingImages.splice(index, 1);
            renderImagePreviews();
        }

        function removeNewFile(index) {
            selectedNewFiles.splice(index, 1);
            renderImagePreviews();
        }

        function renderImagePreviews() {
            const container = $('#imagePreviewGrid');
            container.empty();

            const totalCount = existingImages.length + selectedNewFiles.length;

            // Strictly toggle dropzone vs 5-image limit badge
            if (totalCount >= 5) {
                $('#imageDropzone').addClass('hidden');
                $('#imageLimitReachedBadge').removeClass('hidden');
            } else {
                $('#imageDropzone').removeClass('hidden');
                $('#imageLimitReachedBadge').addClass('hidden');
            }

            // 1. Existing uploaded images
            existingImages.forEach((url, i) => {
                container.append(`
                    <div class="relative group rounded-xl overflow-hidden border border-slate-200 aspect-square bg-slate-50 shadow-2xs">
                        <img src="${url}" class="w-full h-full object-cover">
                        <button type="button" onclick="removeExistingImage(${i})" 
                            class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full p-1 shadow transition cursor-pointer" title="মুছুন">
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                        <span class="absolute bottom-1 left-1 bg-slate-900/80 text-white text-[9px] px-1.5 py-0.5 rounded font-mono font-bold">#${toBnDigit(i+1)}</span>
                    </div>
                `);
            });

            // 2. Newly selected files (local object URL preview)
            selectedNewFiles.forEach((f, i) => {
                const objectUrl = URL.createObjectURL(f);
                container.append(`
                    <div class="relative group rounded-xl overflow-hidden border-2 border-brand-500 aspect-square bg-slate-50 shadow-2xs">
                        <img src="${objectUrl}" class="w-full h-full object-cover">
                        <button type="button" onclick="removeNewFile(${i})" 
                            class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full p-1 shadow transition cursor-pointer" title="মুছুন">
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                        <span class="absolute bottom-1 left-1 bg-brand-600 text-white text-[9px] px-1.5 py-0.5 rounded font-bold shadow-2xs">নতুন</span>
                    </div>
                `);
            });

            lucide.createIcons();

            if (totalCount > 0) {
                $('#imageDropzone').removeClass('border-rose-500 bg-rose-50/20');
                $('#imageValidationError').addClass('hidden');
            }
        }

        // Form Submit: Route to 3-step wizard submit
        $('#productForm').on('submit', function(e) {
            e.preventDefault();
            submitProductWizard();
        });

        // ==========================================
        // PRODUCT DELETE WITH DEDICATED YES / NO MODAL
        // ==========================================
        let pendingDeleteProductUuid = null;

        function confirmDeleteProduct(uuid, name) {
            const prod = productsData.find(item => item.uuid === uuid);
            const prodName = name || (prod ? prod.name : 'এই পণ্যটি');
            pendingDeleteProductUuid = uuid;

            $('#modalConfirmDelete h3').text('পণ্যটি মুছে ফেলতে চান?');
            $('#modalConfirmDelete p').html(`আপনি কি নিশ্চিতভাবে <b id="confirmDeleteProdName" class="text-rose-600 font-bold">"${escapeHtml(prodName)}"</b> প্রোডাক্টটি মুছে ফেলতে চান? এটি আর ফিরিয়ে আনা সম্ভব হবে না।`);
            $('#btnExecuteDelete').off('click').on('click', executeDeleteProduct);
            $('#modalConfirmDelete').removeClass('hidden').css('display', 'flex');
            $('body').addClass('overflow-hidden');
            if (window.lucide) lucide.createIcons();
        }

        function closeConfirmDeleteModal() {
            $('#modalConfirmDelete').addClass('hidden').css('display', 'none');
            $('body').removeClass('overflow-hidden');
            pendingDeleteProductUuid = null;
        }

        async function executeDeleteProduct() {
            if (!pendingDeleteProductUuid) return;
            const uuid = pendingDeleteProductUuid;
            const prod = productsData.find(item => item.uuid === uuid);
            const prodName = prod ? prod.name : 'পণ্য';

            const $btn = $('#btnExecuteDelete');
            const originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).addClass('opacity-70 cursor-not-allowed').html('<i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin inline mr-1"></i> মুছে ফেলা হচ্ছে...');
            if (window.lucide) lucide.createIcons();

            try {
                const res = await StoreApi.delete(`products/${uuid}`);
                if (res.success) {
                    closeConfirmDeleteModal();
                    await loadProducts();
                    Toast.success(`"${prodName}" সফলভাবে মুছে ফেলা হয়েছে`);
                } else {
                    Toast.error(res.message || 'ডিলিট সম্পন্ন করা যায়নি।');
                }
            } catch (err) {
                Toast.error(err.message || 'নেটওয়ার্ক সমস্যা হয়েছে।');
            } finally {
                $btn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed').html(originalBtnHtml);
                if (window.lucide) lucide.createIcons();
            }
        }

        function deleteProduct(uuid, name) {
            confirmDeleteProduct(uuid, name);
        }

        // Close delete confirmation on backdrop click
        $('#modalConfirmDelete').on('click', function(e) {
            if (e.target === this) {
                closeConfirmDeleteModal();
            }
        });

        // ==========================================
        // 7. STORE PROFILE EDIT LOGIC
        // ==========================================

        function populateProfileForm(data) {
            $('#pName').val(data.name || '');
            $('#pSlug').val(data.slug || '');
            $('#pOwnerName').val(data.owner_name || '');
            $('#pOwnerEmail').val(data.owner_email || '');
            $('#pPhone').val(data.owner_phone || '');
            $('#pAddress').val(data.address || '');
            $('#pPassword').val('');

            const socials = data.social_links || {};
            $('#pFacebook').val(socials.facebook || '');
            $('#pInstagram').val(socials.instagram || '');
            $('#pWhatsapp').val(socials.whatsapp || '');
            $('#pYoutube').val(socials.youtube || '');
        }

        function updateUI(data) {
            storeData = data;
            $('#navStoreName').text(data.name);
            $('#welcomeOwnerName').text(data.owner_name || '');
            $('#topOwnerName').text(data.owner_name || '');
            $('#topOwnerEmail').text(data.owner_email || '');
            $('#footStoreName').text(data.name);

            renderSocialOverview(data.social_links || {});
            populateProfileForm(data);
        }

        async function loadProfile() {
            try {
                const res = await StoreApi.get(`tenants/${STORE_UUID}/profile`);
                if (res.success && res.data) {
                    updateUI(res.data);
                } else if (res.status === 401) {
                    StoreApi.setToken('');
                    window.location.href = 'login';
                }
            } catch (err) {
                console.error('Error fetching fresh profile:', err);
            }
        }

        $('#profileForm').on('submit', async function(e) {
            e.preventDefault();

            const socialLinks = {
                facebook: $('#pFacebook').val().trim(),
                instagram: $('#pInstagram').val().trim(),
                whatsapp: $('#pWhatsapp').val().trim(),
                youtube: $('#pYoutube').val().trim()
            };

            const payload = {
                name: $('#pName').val().trim(),
                slug: $('#pSlug').val().trim(),
                owner_phone: $('#pPhone').val().trim(),
                address: $('#pAddress').val().trim(),
                social_links: socialLinks
            };

            const newPwd = $('#pPassword').val();
            if (newPwd && newPwd.trim() !== '') {
                payload.password = newPwd.trim();
            }

            $('#btnSaveProfile').prop('disabled', true);
            $('#btnSaveProfileText').text(i18n[currentLang].savingText);

            try {
                const res = await StoreApi.put(`tenants/${STORE_UUID}/profile`, payload);

                if (res.success && res.data) {
                    updateUI(res.data);
                    Swal.fire({
                        icon: 'success',
                        title: i18n[currentLang].saveSuccessTitle,
                        text: i18n[currentLang].saveSuccessText,
                        timer: 1600,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: res.message || 'Update failed',
                        confirmButtonColor: '#ea580c'
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    text: err.message,
                    confirmButtonColor: '#ea580c'
                });
            } finally {
                $('#btnSaveProfile').prop('disabled', false);
                $('#btnSaveProfileText').text(i18n[currentLang].btnSaveProfile);
            }
        });

        // 8. Logout Confirmation
        function confirmLogout() {
            if (confirm(currentLang === 'bn' ? 'আপনি কি নিশ্চিত যে লগআউট করতে চান?' : 'Are you sure you want to log out?')) {
                window.location.href = 'logout.php';
            }
        }

        // ==========================================
        // ORDER MANAGEMENT MODULE (4 Statuses: Pending, Processing, Delivered, Cancel)
        // ==========================================
        let ordersData = [];
        let orderStats = {};
        let currentOrderStatusFilter = 'active';

        function formatPrice(val) {
            const num = parseFloat(val) || 0;
            return num.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
        }

        async function loadOrders() {
            if ($('#ordersListContainer').children().length === 0 || $('#ordersListContainer').find('.skeleton-shimmer').length === 0) {
                renderOrderSkeletons('ordersListContainer', 3);
            }
            if ($('#completedOrdersListContainer').children().length === 0) {
                renderOrderSkeletons('completedOrdersListContainer', 2);
            }
            if ($('#cancelledOrdersListContainer').children().length === 0) {
                renderOrderSkeletons('cancelledOrdersListContainer', 2);
            }
            try {
                const [ordersRes, statsRes] = await Promise.all([
                    StoreApi.get('orders'),
                    StoreApi.get('orders/stats')
                ]);

                if (ordersRes && ordersRes.success && Array.isArray(ordersRes.data)) {
                    ordersData = ordersRes.data;
                } else {
                    ordersData = [];
                }

                if (statsRes && statsRes.success && statsRes.data) {
                    orderStats = statsRes.data;
                    updateOrderBadgesAndStats(orderStats);
                }

                renderOrders(ordersData);
                renderCompletedOrders(ordersData);
                renderCancelledOrders(ordersData);
            } catch (err) {
                console.error('Error loading orders:', err);
            }
        }

        function updateOrderBadgesAndStats(stats) {
            const pending = parseInt(stats.pending || 0);
            const processing = parseInt(stats.processing || 0);
            const activeOrders = pending + processing;
            const delivered = parseInt(stats.delivered || 0);
            const cancel = parseInt(stats.cancel || 0);
            const total = parseInt(stats.total || 0);
            const deliveredRevenue = parseFloat(stats.delivered_revenue || 0);

            // Nav badges
            $('#badgeActiveOrderCount').text(activeOrders);
            if (activeOrders > 0) {
                $('#badgeActiveOrderCount').removeClass('bg-slate-100 text-slate-700').addClass('bg-amber-100 text-amber-800');
            } else {
                $('#badgeActiveOrderCount').removeClass('bg-amber-100 text-amber-800').addClass('bg-slate-100 text-slate-700');
            }
            $('#badgeCompletedOrderCount').text(delivered);
            $('#badgeCancelledOrderCount').text(cancel);
            $('#ordersHeaderCountBadge').text(activeOrders + 'টি চলমান');
            $('#completedOrdersHeaderCountBadge').text(delivered + 'টি সম্পন্ন');
            $('#cancelledOrdersHeaderCountBadge').text(cancel + 'টি বাতিল');

            // Mobile Drawer Badges Sync
            $('#mobDrawerBadgeCancelledOrder').text(cancel);

            // Dashboard banner stats
            $('#dashTotalOrders').text(total);
            $('#dashPendingOrders').text(pending);
            $('#dashProcessingOrders').text(processing);
            $('#dashDeliveredRevenue').text('৳' + formatPrice(deliveredRevenue));

            // Status filter button counters (Active, Pending, Processing)
            $('#filterCountActive').text(activeOrders);
            $('#filterCountPending').text(pending);
            $('#filterCountProcessing').text(processing);
        }

        function filterOrdersByStatus(status) {
            currentOrderStatusFilter = status;
            ordersCurrentPage = 1;

            // Reset all filter buttons
            $('.order-filter-btn').removeClass('bg-slate-900 text-white shadow-xs')
                .addClass('bg-slate-50 text-slate-600 border border-slate-200');

            // Activate chosen button
            const btnMap = {
                active: '#btnFilterStatusActive',
                pending: '#btnFilterStatusPending',
                processing: '#btnFilterStatusProcessing'
            };

            const activeBtn = $(btnMap[status] || '#btnFilterStatusActive');
            activeBtn.removeClass('bg-slate-50 text-slate-600 border border-slate-200')
                .addClass('bg-slate-900 text-white shadow-xs');

            renderOrders(ordersData);
        }

        function handleOrderSearch() {
            ordersCurrentPage = 1;
            renderOrders(ordersData);
        }

        function renderOrders(orders) {
            const container = $('#ordersListContainer');
            container.empty();

            const query = ($('#orderSearchInput').val() || '').trim().toLowerCase();

            // Order Management strictly displays Pending & Processing orders
            let filtered = orders.filter(ord => {
                if (!['pending', 'processing'].includes(ord.status)) {
                    return false;
                }
                if (currentOrderStatusFilter === 'pending' && ord.status !== 'pending') {
                    return false;
                }
                if (currentOrderStatusFilter === 'processing' && ord.status !== 'processing') {
                    return false;
                }
                // Search query
                if (query) {
                    const matchNum = (ord.order_number || '').toLowerCase().includes(query);
                    const matchName = (ord.customer_name || '').toLowerCase().includes(query);
                    const matchPhone = (ord.customer_phone || '').toLowerCase().includes(query);
                    if (!matchNum && !matchName && !matchPhone) return false;
                }
                return true;
            });

            if (filtered.length === 0) {
                container.html(`
                    <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="package-search" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">কোনো চলমান অর্ডার পাওয়া যায়নি</h4>
                        <p class="text-xs text-slate-500 mt-1">বর্তমানে কোনো পেন্ডিং বা প্রসেসিং অর্ডার নেই।</p>
                    </div>
                `);
                $('#ordersPagination').addClass('hidden');
                lucide.createIcons();
                return;
            }

            const totalPages = Math.ceil(filtered.length / ordersPerPage);
            if (ordersCurrentPage > totalPages) ordersCurrentPage = totalPages || 1;
            if (ordersCurrentPage < 1) ordersCurrentPage = 1;

            const startIndex = (ordersCurrentPage - 1) * ordersPerPage;
            const pageOrders = filtered.slice(startIndex, startIndex + ordersPerPage);

            pageOrders.forEach(ord => {
                const statusBadge = getStatusBadgeHtml(ord.status);
                const cleanPhone = (ord.customer_phone || '').replace(/[^0-9]/g, '');
                const waPhone = cleanPhone.startsWith('88') ? cleanPhone : ('88' + cleanPhone);

                const items = Array.isArray(ord.items) ? ord.items : [];
                let itemsHtml = '';
                items.forEach(it => {
                    const variantText = [it.size ? `সাইজ: ${escapeHtml(it.size)}` : '', it.color ? `কালার: ${escapeHtml(it.color)}` : ''].filter(Boolean).join(' | ');
                    itemsHtml += `
                        <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-100 last:border-b-0">
                            <div class="flex items-center space-x-2.5 min-w-0">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0 flex items-center justify-center">
                                    ${it.product_image ? `<img src="${escapeHtml(it.product_image)}" class="w-full h-full object-cover">` : `<i data-lucide="package" class="w-4 h-4 text-slate-400"></i>`}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-800 truncate">${escapeHtml(it.product_name)}</div>
                                    ${variantText ? `<div class="text-[10px] text-orange-600 font-semibold">${variantText}</div>` : ''}
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-2">
                                <div class="font-bold text-slate-900 font-mono">৳${formatPrice(it.total_price)}</div>
                                <div class="text-[10px] text-slate-400 font-mono">৳${formatPrice(it.unit_price)} × ${it.quantity}</div>
                            </div>
                        </div>
                    `;
                });

                const cardHtml = `
                    <div class="bg-white border border-slate-200 rounded-2xl p-3.5 sm:p-5 shadow-2xs transition hover:border-slate-300">
                        <!-- MOBILE VIEW (COMPACT, TIGHT & SCAN-FRIENDLY: SM:HIDDEN) -->
                        <div class="block sm:hidden space-y-2.5">
                            <!-- Mobile Row 1: Eye Icon, Order #, Status Badge, Total Amount -->
                            <div class="flex items-center justify-between gap-2 pb-2 border-b border-slate-100">
                                <div class="flex items-center space-x-1.5 min-w-0">
                                    <button type="button" onclick="openOrderCopyModal('${ord.uuid}')"
                                        class="w-7 h-7 rounded-lg bg-orange-50 hover:bg-orange-100 text-orange-600 flex items-center justify-center shrink-0 cursor-pointer shadow-2xs"
                                        title="অর্ডারের তথ্য দেখুন ও কপি করুন">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <span class="text-xs font-black text-slate-900 font-mono truncate">${escapeHtml(ord.order_number)}</span>
                                    ${statusBadge}
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-xs font-black text-orange-600 font-mono">৳${formatPrice(ord.total_amount)}</span>
                                </div>
                            </div>

                            <!-- Mobile Row 2: Customer Name, Phone, Zone & Item Count -->
                            <div class="flex items-center justify-between text-xs gap-2">
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 truncate">
                                        ${escapeHtml(ord.customer_name)} <span class="font-mono text-slate-500 font-normal">&bull; ${escapeHtml(ord.customer_phone)}</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 truncate">
                                        ${items.length}টি আইটেম &bull; ${escapeHtml(ord.district || 'ঢাকা')} &bull; ${ord.delivery_zone === 'outside_dhaka' ? 'ঢাকার বাইরে' : 'ঢাকার ভেতরে'}
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Row 3: Action Buttons (Call, WhatsApp, Eye Info Modal, Status Select) -->
                            <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                                <div class="flex items-center space-x-1.5">
                                    <a href="tel:${escapeHtml(ord.customer_phone)}"
                                        class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center transition shadow-2xs" title="কল করুন">
                                        <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <a href="https://wa.me/${waPhone}?text=${encodeURIComponent('আসসালামু আলাইকুম ' + ord.customer_name + ', আপনার অর্ডার ' + ord.order_number + ' সম্পর্কে যোগাযোগ করছি।')}" target="_blank"
                                        class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center transition shadow-2xs" title="WhatsApp">
                                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <button type="button" onclick="openOrderCopyModal('${ord.uuid}')"
                                        class="px-2 py-1 bg-orange-50 hover:bg-orange-100 text-orange-700 border border-orange-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 transition cursor-pointer shadow-2xs" title="অর্ডারের তথ্য দেখুন ও আলাদাভাবে কপি করুন">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        <span>তথ্য দেখুন</span>
                                    </button>
                                </div>
                                <select onchange="changeOrderStatus('${ord.uuid}', this.value)"
                                    class="px-2 py-1 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-bold text-slate-800 focus:outline-none focus:border-orange-500 cursor-pointer">
                                    <option value="pending" ${ord.status === 'pending' ? 'selected' : ''}>🟡 পেন্ডিং</option>
                                    <option value="processing" ${ord.status === 'processing' ? 'selected' : ''}>🔵 প্রসেসিং</option>
                                    <option value="delivered" ${ord.status === 'delivered' ? 'selected' : ''}>🟢 ডেলিভারি</option>
                                    <option value="cancel" ${ord.status === 'cancel' ? 'selected' : ''}>🔴 বাতিল</option>
                                </select>
                            </div>
                        </div>

                        <!-- DESKTOP DETAILED VIEW (HIDDEN SM:BLOCK - PRESERVED AS IS) -->
                        <div class="hidden sm:block">
                            <!-- Top Bar: Order ID, Date, Status -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-3 mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center font-bold shrink-0">
                                        <i data-lucide="receipt" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs font-black text-slate-900 font-mono">${escapeHtml(ord.order_number)}</span>
                                            ${statusBadge}
                                        </div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">${escapeHtml(ord.created_at || '')}</div>
                                    </div>
                                </div>

                                <!-- Quick Status Changer Dropdown -->
                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="copyOrderInfo('${ord.uuid}')" class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition flex items-center space-x-1 cursor-pointer" title="কুরিয়ারের জন্য সম্পূর্ণ তথ্য কপি করুন">
                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                        <span>কপি</span>
                                    </button>
                                    <label class="text-[11px] text-slate-500 font-medium">স্ট্যাটাস:</label>
                                    <select onchange="changeOrderStatus('${ord.uuid}', this.value)"
                                        class="px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-orange-500 cursor-pointer">
                                        <option value="pending" ${ord.status === 'pending' ? 'selected' : ''}>🟡 পেন্ডিং</option>
                                        <option value="processing" ${ord.status === 'processing' ? 'selected' : ''}>🔵 প্রসেসিং</option>
                                        <option value="delivered" ${ord.status === 'delivered' ? 'selected' : ''}>🟢 ডেলিভারি সম্পন্ন</option>
                                        <option value="cancel" ${ord.status === 'cancel' ? 'selected' : ''}>🔴 বাতিল (Trash)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Customer Details & Delivery Info -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-slate-50/70 p-3 rounded-xl border border-slate-100 mb-3">
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">গ্রাহক</div>
                                    <div class="text-xs font-bold text-slate-900">${escapeHtml(ord.customer_name)}</div>
                                    <div class="text-xs text-slate-600 font-mono mt-0.5">${escapeHtml(ord.customer_phone)}</div>
                                    <div class="mt-2 flex items-center space-x-2">
                                        <a href="tel:${escapeHtml(ord.customer_phone)}" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition">
                                            <i data-lucide="phone" class="w-3 h-3"></i>
                                            <span>কল করুন</span>
                                        </a>
                                        <a href="https://wa.me/${waPhone}?text=${encodeURIComponent('আসসালামু আলাইকুম ' + ord.customer_name + ', আপনার অর্ডার ' + ord.order_number + ' সম্পর্কে যোগাযোগ করছি।')}" target="_blank"
                                           class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition">
                                            <i data-lucide="message-circle" class="w-3 h-3"></i>
                                            <span>WhatsApp</span>
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">ডেলিভারি ঠিকানা</div>
                                    <div class="text-xs font-semibold text-slate-700 mt-0.5">${escapeHtml(ord.delivery_address)}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">
                                        ${escapeHtml(ord.upazilla || '')}, ${escapeHtml(ord.district || '')}, ${escapeHtml(ord.division || '')}
                                    </div>
                                    <div class="inline-block mt-1.5 px-2 py-0.5 rounded text-[10px] font-bold bg-orange-100 text-orange-800">
                                        ${ord.delivery_zone === 'outside_dhaka' ? 'ঢাকার বাইরে' : 'ঢাকার ভেতরে'} (৳${formatPrice(ord.delivery_charge)})
                                    </div>
                                </div>
                            </div>

                            <!-- Items Breakdown -->
                            <div class="mb-3 px-1">
                                ${itemsHtml}
                            </div>

                            <!-- Footer: Total & Actions -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100">
                                <div class="flex items-center space-x-2 text-xs">
                                    <span class="px-2 py-0.5 bg-slate-100 rounded text-slate-600 font-semibold text-[11px]">ক্যাশ অন ডেলিভারি</span>
                                    <span class="text-slate-400">&bull;</span>
                                    <span class="text-slate-600">মোট প্রদেয়: <strong class="text-sm font-black text-orange-600 font-mono">৳${formatPrice(ord.total_amount)}</strong></span>
                                </div>
                                <div class="flex items-center space-x-2 self-end sm:self-auto">
                                    <button type="button" onclick="openOrderDetailsModal('${ord.uuid}')"
                                        class="px-3.5 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-2xs cursor-pointer">
                                        <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                                        <span>চালান ও বিস্তারিত</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.append(cardHtml);
            });

            renderGenericPagination({
                containerId: 'ordersPagination',
                summaryId: 'ordersPaginationSummary',
                buttonsId: 'ordersPaginationButtons',
                currentPage: ordersCurrentPage,
                totalItems: filtered.length,
                perPage: ordersPerPage,
                itemLabel: 'অর্ডার',
                onPageChangeFn: 'changeOrdersPage',
                activeColorClass: 'bg-slate-900 text-white'
            });

            lucide.createIcons();
        }

        // ==========================================
        // COMPLETED ORDERS & ACCOUNTS LOGIC
        // ==========================================
        function handleCompletedOrderSearch() {
            completedOrdersCurrentPage = 1;
            renderCompletedOrders(ordersData);
        }

        function renderCompletedOrders(orders) {
            const container = $('#completedOrdersListContainer');
            container.empty();

            const query = ($('#completedOrderSearchInput').val() || '').trim().toLowerCase();
            const completed = orders.filter(ord => ord.status === 'delivered');

            // Financial & Account calculations
            let totalSubtotal = 0;
            let totalDelivery = 0;
            let grandTotal = 0;

            completed.forEach(ord => {
                totalSubtotal += parseFloat(ord.subtotal || 0);
                totalDelivery += parseFloat(ord.delivery_charge || 0);
                grandTotal += parseFloat(ord.total_amount || 0);
            });

            // Update Account Cards
            $('#compStatTotalOrders').text(completed.length);
            $('#compStatItemRevenue').text('৳' + formatPrice(totalSubtotal));
            $('#compStatDeliveryFee').text('৳' + formatPrice(totalDelivery));
            $('#compStatTotalRevenue').text('৳' + formatPrice(grandTotal));
            $('#completedOrdersHeaderCountBadge').text(completed.length + 'টি সম্পন্ন');

            // Apply search filter
            let filtered = completed.filter(ord => {
                if (query) {
                    const matchNum = (ord.order_number || '').toLowerCase().includes(query);
                    const matchName = (ord.customer_name || '').toLowerCase().includes(query);
                    const matchPhone = (ord.customer_phone || '').toLowerCase().includes(query);
                    if (!matchNum && !matchName && !matchPhone) return false;
                }
                return true;
            });

            if (filtered.length === 0) {
                container.html(`
                    <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="package-check" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">কোনো সম্পন্ন অর্ডার পাওয়া যায়নি</h4>
                        <p class="text-xs text-slate-500 mt-1">এখনো কোনো ডেলিভারি সম্পন্ন হয়নি অথবা সার্চের সাথে মেলেনি।</p>
                    </div>
                `);
                $('#completedOrdersPagination').addClass('hidden');
                lucide.createIcons();
                return;
            }

            const totalPages = Math.ceil(filtered.length / completedOrdersPerPage);
            if (completedOrdersCurrentPage > totalPages) completedOrdersCurrentPage = totalPages || 1;
            if (completedOrdersCurrentPage < 1) completedOrdersCurrentPage = 1;

            const startIndex = (completedOrdersCurrentPage - 1) * completedOrdersPerPage;
            const pageOrders = filtered.slice(startIndex, startIndex + completedOrdersPerPage);

            pageOrders.forEach(ord => {
                const statusBadge = getStatusBadgeHtml(ord.status);
                const cleanPhone = (ord.customer_phone || '').replace(/[^0-9]/g, '');
                const waPhone = cleanPhone.startsWith('88') ? cleanPhone : ('88' + cleanPhone);

                const items = Array.isArray(ord.items) ? ord.items : [];
                let itemsHtml = '';
                items.forEach(it => {
                    const variantText = [it.size ? `সাইজ: ${escapeHtml(it.size)}` : '', it.color ? `কালার: ${escapeHtml(it.color)}` : ''].filter(Boolean).join(' | ');
                    itemsHtml += `
                        <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-100 last:border-b-0">
                            <div class="flex items-center space-x-2.5 min-w-0">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0 flex items-center justify-center">
                                    ${it.product_image ? `<img src="${escapeHtml(it.product_image)}" class="w-full h-full object-cover">` : `<i data-lucide="package" class="w-4 h-4 text-slate-400"></i>`}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-800 truncate">${escapeHtml(it.product_name)}</div>
                                    ${variantText ? `<div class="text-[10px] text-emerald-600 font-semibold">${variantText}</div>` : ''}
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-2">
                                <div class="font-bold text-slate-900 font-mono">৳${formatPrice(it.total_price)}</div>
                                <div class="text-[10px] text-slate-400 font-mono">৳${formatPrice(it.unit_price)} × ${it.quantity}</div>
                            </div>
                        </div>
                    `;
                });

                const cardHtml = `
                    <div class="bg-white border border-slate-200 rounded-2xl p-3.5 sm:p-5 shadow-2xs transition hover:border-emerald-300">
                        <!-- MOBILE COMPACT VIEW (SM:HIDDEN) -->
                        <div class="block sm:hidden space-y-2.5">
                            <!-- Mobile Row 1: Info Icon, Order #, Status Badge, Total Amount -->
                            <div class="flex items-center justify-between gap-2 pb-2 border-b border-slate-100">
                                <div class="flex items-center space-x-1.5 min-w-0">
                                    <button type="button" onclick="openOrderDetailsModal('${ord.uuid}')"
                                        class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 cursor-pointer shadow-2xs"
                                        title="বিস্তারিত ও ইনভয়েস দেখুন">
                                        <i data-lucide="info" class="w-4 h-4"></i>
                                    </button>
                                    <span class="text-xs font-black text-slate-900 font-mono truncate">${escapeHtml(ord.order_number)}</span>
                                    ${statusBadge}
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-xs font-black text-emerald-600 font-mono">৳${formatPrice(ord.total_amount)}</span>
                                </div>
                            </div>

                            <!-- Mobile Row 2: Customer Name, Phone, Zone & Item Count -->
                            <div class="flex items-center justify-between text-xs gap-2">
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 truncate">
                                        ${escapeHtml(ord.customer_name)} <span class="font-mono text-slate-500 font-normal">&bull; ${escapeHtml(ord.customer_phone)}</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 truncate">
                                        ${items.length}টি আইটেম &bull; ${escapeHtml(ord.district || 'ঢাকা')} &bull; হিসাব সম্পন্ন
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Row 3: Action Buttons (Call, WhatsApp, Copy, Undo Revert) -->
                            <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                                <div class="flex items-center space-x-1.5">
                                    <a href="tel:${escapeHtml(ord.customer_phone)}"
                                        class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center transition shadow-2xs" title="কল করুন">
                                        <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <a href="https://wa.me/${waPhone}" target="_blank"
                                        class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center justify-center transition shadow-2xs" title="WhatsApp">
                                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <button type="button" onclick="openOrderCopyModal('${ord.uuid}')"
                                        class="px-2 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 transition cursor-pointer shadow-2xs" title="অর্ডার ও কুরিয়ার তথ্য দেখুন">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        <span>তথ্য দেখুন</span>
                                    </button>
                                </div>
                                <div class="inline-flex items-center rounded-lg bg-amber-50 border border-amber-200 p-0.5 shadow-2xs">
                                    <button type="button" onclick="revertCompletedOrder('${ord.uuid}', 'pending')"
                                        class="px-2 py-0.5 text-amber-800 hover:bg-amber-100 rounded text-[10px] font-bold flex items-center space-x-1 transition cursor-pointer" title="পেন্ডিং তালিকায় ফেরত পাঠান">
                                        <i data-lucide="undo-2" class="w-3 h-3 text-amber-600"></i>
                                        <span>রিডো পেন্ডিং</span>
                                    </button>
                                    <div class="h-3 w-px bg-amber-200 mx-0.5"></div>
                                    <button type="button" onclick="revertCompletedOrder('${ord.uuid}', 'processing')"
                                        class="px-2 py-0.5 text-blue-800 hover:bg-blue-100 rounded text-[10px] font-bold flex items-center space-x-1 transition cursor-pointer" title="প্রসেসিং তালিকায় ফেরত পাঠান">
                                        <i data-lucide="arrow-left-right" class="w-3 h-3 text-blue-600"></i>
                                        <span>প্রসেসিং</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- DESKTOP DETAILED VIEW (HIDDEN SM:BLOCK - PRESERVED AS IS + UNDO BUTTON) -->
                        <div class="hidden sm:block">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-3 mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold shrink-0">
                                        <i data-lucide="check-check" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs font-black text-slate-900 font-mono">${escapeHtml(ord.order_number)}</span>
                                            ${statusBadge}
                                        </div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">অর্ডার তারিখ: ${escapeHtml(ord.created_at || '')}</div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="copyOrderInfo('${ord.uuid}')" class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition flex items-center space-x-1 cursor-pointer" title="কুরিয়ারের জন্য সম্পূর্ণ তথ্য কপি">
                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                        <span>কপি</span>
                                    </button>
                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-xs font-bold flex items-center space-x-1">
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                        <span>হিসাব সম্পন্ন</span>
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-emerald-50/30 p-3 rounded-xl border border-emerald-100 mb-3">
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">গ্রাহকের বিবরণ</div>
                                    <div class="text-xs font-bold text-slate-900">${escapeHtml(ord.customer_name)}</div>
                                    <div class="text-xs text-slate-600 font-mono mt-0.5">${escapeHtml(ord.customer_phone)}</div>
                                    <div class="mt-2 flex items-center space-x-2">
                                        <a href="tel:${escapeHtml(ord.customer_phone)}" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition">
                                            <i data-lucide="phone" class="w-3 h-3"></i><span>কল করুন</span>
                                        </a>
                                        <a href="https://wa.me/${waPhone}" target="_blank" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition">
                                            <i data-lucide="message-circle" class="w-3 h-3"></i><span>WhatsApp</span>
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">ডেলিভারি ঠিকানা</div>
                                    <div class="text-xs font-semibold text-slate-700 mt-0.5">${escapeHtml(ord.delivery_address)}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">
                                        ${escapeHtml(ord.upazilla || '')}, ${escapeHtml(ord.district || '')}, ${escapeHtml(ord.division || '')}
                                    </div>
                                    <div class="inline-block mt-1.5 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700">
                                        ${ord.delivery_zone === 'outside_dhaka' ? 'ঢাকার বাইরে' : 'ঢাকার ভেতরে'} (৳${formatPrice(ord.delivery_charge)})
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 px-1">
                                ${itemsHtml}
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100">
                                <div class="flex items-center space-x-3 text-xs">
                                    <span class="text-slate-500">সাবটোটাল: <strong class="text-slate-800 font-mono">৳${formatPrice(ord.subtotal)}</strong></span>
                                    <span class="text-slate-300">+</span>
                                    <span class="text-slate-500">ডেলিভারি ফি: <strong class="text-slate-800 font-mono">৳${formatPrice(ord.delivery_charge)}</strong></span>
                                    <span class="text-slate-400">&bull;</span>
                                    <span class="text-emerald-700 font-bold">আদায়কৃত মোট: <strong class="text-sm font-black text-emerald-700 font-mono">৳${formatPrice(ord.total_amount)}</strong></span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="inline-flex items-center rounded-xl bg-amber-50 border border-amber-200 p-0.5 shadow-2xs">
                                        <button type="button" onclick="revertCompletedOrder('${ord.uuid}', 'pending')"
                                            class="px-2.5 py-1 text-amber-800 hover:bg-amber-100 rounded-lg text-xs font-bold transition flex items-center space-x-1 cursor-pointer" title="পেন্ডিং তালিকায় ফিরিয়ে নিন">
                                            <i data-lucide="undo-2" class="w-3.5 h-3.5 text-amber-600"></i>
                                            <span>রিডো &bull; পেন্ডিং</span>
                                        </button>
                                        <div class="h-4 w-px bg-amber-200"></div>
                                        <button type="button" onclick="revertCompletedOrder('${ord.uuid}', 'processing')"
                                            class="px-2.5 py-1 text-blue-800 hover:bg-blue-100 rounded-lg text-xs font-bold transition flex items-center space-x-1 cursor-pointer" title="প্রসেসিং তালিকায় ফিরিয়ে নিন">
                                            <i data-lucide="arrow-left-right" class="w-3.5 h-3.5 text-blue-600"></i>
                                            <span>রিডো &bull; প্রসেসিং</span>
                                        </button>
                                    </div>
                                    <button type="button" onclick="openOrderDetailsModal('${ord.uuid}')"
                                        class="px-3.5 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-2xs cursor-pointer">
                                        <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                                        <span>চালান ও রশিদ</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.append(cardHtml);
            });

            renderGenericPagination({
                containerId: 'completedOrdersPagination',
                summaryId: 'completedOrdersPaginationSummary',
                buttonsId: 'completedOrdersPaginationButtons',
                currentPage: completedOrdersCurrentPage,
                totalItems: filtered.length,
                perPage: completedOrdersPerPage,
                itemLabel: 'সম্পন্ন অর্ডার',
                onPageChangeFn: 'changeCompletedOrdersPage',
                activeColorClass: 'bg-emerald-600 text-white'
            });

            lucide.createIcons();
        }

        // ==========================================
        // CANCELLED ORDERS (TRASH & UNDO) LOGIC
        // ==========================================
        function handleCancelledOrderSearch() {
            cancelledOrdersCurrentPage = 1;
            renderCancelledOrders(ordersData);
        }

        function renderCancelledOrders(orders) {
            const container = $('#cancelledOrdersListContainer');
            container.empty();

            const query = ($('#cancelledOrderSearchInput').val() || '').trim().toLowerCase();
            const cancelled = orders.filter(ord => ord.status === 'cancel');
            $('#cancelledOrdersHeaderCountBadge').text(cancelled.length + 'টি বাতিল');

            let filtered = cancelled.filter(ord => {
                if (query) {
                    const matchNum = (ord.order_number || '').toLowerCase().includes(query);
                    const matchName = (ord.customer_name || '').toLowerCase().includes(query);
                    const matchPhone = (ord.customer_phone || '').toLowerCase().includes(query);
                    if (!matchNum && !matchName && !matchPhone) return false;
                }
                return true;
            });

            if (filtered.length === 0) {
                container.html(`
                    <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="trash-2" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">কোনো বাতিল অর্ডার নেই</h4>
                        <p class="text-xs text-slate-500 mt-1">ট্র্যাশ সম্পূর্ণ পরিষ্কার! কোনো অর্ডার বাতিল করা হয়নি।</p>
                    </div>
                `);
                $('#cancelledOrdersPagination').addClass('hidden');
                lucide.createIcons();
                return;
            }

            const totalPages = Math.ceil(filtered.length / cancelledOrdersPerPage);
            if (cancelledOrdersCurrentPage > totalPages) cancelledOrdersCurrentPage = totalPages || 1;
            if (cancelledOrdersCurrentPage < 1) cancelledOrdersCurrentPage = 1;

            const startIndex = (cancelledOrdersCurrentPage - 1) * cancelledOrdersPerPage;
            const pageOrders = filtered.slice(startIndex, startIndex + cancelledOrdersPerPage);

            pageOrders.forEach(ord => {
                const statusBadge = getStatusBadgeHtml(ord.status);

                // Calculate days remaining in 30-day trash
                const cancelDate = new Date(ord.updated_at || ord.created_at);
                const daysPassed = Math.floor((new Date() - cancelDate) / (1000 * 60 * 60 * 24));
                const daysRemaining = Math.max(1, 30 - daysPassed);

                const items = Array.isArray(ord.items) ? ord.items : [];
                let itemsHtml = '';
                items.forEach(it => {
                    const variantText = [it.size ? `সাইজ: ${escapeHtml(it.size)}` : '', it.color ? `কালার: ${escapeHtml(it.color)}` : ''].filter(Boolean).join(' | ');
                    itemsHtml += `
                        <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-100 last:border-b-0 opacity-80">
                            <div class="flex items-center space-x-2.5 min-w-0">
                                <div class="w-9 h-9 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0 flex items-center justify-center">
                                    ${it.product_image ? `<img src="${escapeHtml(it.product_image)}" class="w-full h-full object-cover">` : `<i data-lucide="package" class="w-4 h-4 text-slate-400"></i>`}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-800 truncate">${escapeHtml(it.product_name)}</div>
                                    ${variantText ? `<div class="text-[10px] text-slate-500 font-semibold">${variantText}</div>` : ''}
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-2">
                                <div class="font-bold text-slate-700 font-mono">৳${formatPrice(it.total_price)}</div>
                                <div class="text-[10px] text-slate-400 font-mono">৳${formatPrice(it.unit_price)} × ${it.quantity}</div>
                            </div>
                        </div>
                    `;
                });

                const cardHtml = `
                    <div class="bg-white border border-rose-200/80 rounded-2xl p-3.5 sm:p-5 shadow-2xs transition hover:border-rose-400">
                        <!-- MOBILE COMPACT VIEW (SM:HIDDEN) -->
                        <div class="block sm:hidden space-y-2.5">
                            <!-- Mobile Row 1: Info Icon, Order #, Status Badge, Days Remaining -->
                            <div class="flex items-center justify-between gap-2 pb-2 border-b border-slate-100">
                                <div class="flex items-center space-x-1.5 min-w-0">
                                    <button type="button" onclick="openOrderDetailsModal('${ord.uuid}')"
                                        class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 cursor-pointer shadow-2xs"
                                        title="বিস্তারিত ও ইনভয়েস দেখুন">
                                        <i data-lucide="info" class="w-4 h-4"></i>
                                    </button>
                                    <span class="text-xs font-black text-slate-900 font-mono truncate">${escapeHtml(ord.order_number)}</span>
                                    ${statusBadge}
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">${daysRemaining} দিন বাকি</span>
                                </div>
                            </div>

                            <!-- Mobile Row 2: Customer Name, Phone, Total Amount -->
                            <div class="flex items-center justify-between text-xs gap-2">
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 truncate">
                                        ${escapeHtml(ord.customer_name)} <span class="font-mono text-slate-500 font-normal">&bull; ${escapeHtml(ord.customer_phone)}</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 truncate">
                                        ${items.length}টি আইটেম &bull; বাতিলকৃত
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-xs font-black text-rose-600 font-mono">৳${formatPrice(ord.total_amount)}</span>
                                </div>
                            </div>

                            <!-- Mobile Row 3: Action Buttons (Copy, Undo Restore) -->
                            <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                                <button type="button" onclick="openOrderCopyModal('${ord.uuid}')"
                                    class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 transition cursor-pointer shadow-2xs" title="তথ্য দেখুন ও কপি করুন">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span>তথ্য দেখুন</span>
                                </button>
                                <button type="button" onclick="undoCancelOrder('${ord.uuid}')"
                                    class="px-3 py-1 bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition cursor-pointer">
                                    <i data-lucide="undo-2" class="w-3 h-3"></i>
                                    <span>Undo (পুনরুদ্ধার)</span>
                                </button>
                            </div>
                        </div>

                        <!-- DESKTOP DETAILED VIEW (HIDDEN SM:BLOCK - PRESERVED AS IS) -->
                        <div class="hidden sm:block">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-3 mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center font-bold shrink-0">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs font-black text-slate-900 font-mono">${escapeHtml(ord.order_number)}</span>
                                            ${statusBadge}
                                        </div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">বাতিল সময়: ${escapeHtml(ord.updated_at || ord.created_at || '')}</div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="copyOrderInfo('${ord.uuid}')" class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition flex items-center space-x-1 cursor-pointer" title="কুরিয়ারের জন্য সম্পূর্ণ তথ্য কপি">
                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                        <span>কপি</span>
                                    </button>
                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-800 border border-amber-200 rounded-xl text-xs font-bold flex items-center space-x-1.5">
                                        <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-600"></i>
                                        <span>ট্র্যাশে বাকি: ${daysRemaining} দিন</span>
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-rose-50/30 p-3 rounded-xl border border-rose-100 mb-3">
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">গ্রাহকের তথ্য</div>
                                    <div class="text-xs font-bold text-slate-900">${escapeHtml(ord.customer_name)}</div>
                                    <div class="text-xs text-slate-600 font-mono mt-0.5">${escapeHtml(ord.customer_phone)}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">ডেলিভারি ঠিকানা</div>
                                    <div class="text-xs font-semibold text-slate-700 mt-0.5">${escapeHtml(ord.delivery_address)}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">
                                        ${escapeHtml(ord.upazilla || '')}, ${escapeHtml(ord.district || '')}, ${escapeHtml(ord.division || '')}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 px-1">
                                ${itemsHtml}
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-slate-100">
                                <div class="flex items-center space-x-2 text-xs">
                                    <span class="text-slate-500">বাতিলকৃত অর্ডারের মোট: <strong class="text-sm font-black text-rose-600 font-mono">৳${formatPrice(ord.total_amount)}</strong></span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="openOrderDetailsModal('${ord.uuid}')"
                                        class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition flex items-center space-x-1 cursor-pointer">
                                        <i data-lucide="receipt" class="w-3.5 h-3.5"></i>
                                        <span>চালান</span>
                                    </button>
                                    <button type="button" onclick="undoCancelOrder('${ord.uuid}')"
                                        class="px-4 py-1.5 bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-2xs cursor-pointer">
                                        <i data-lucide="undo-2" class="w-3.5 h-3.5"></i>
                                        <span>Undo (পুনরুদ্ধার করুন)</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.append(cardHtml);
            });

            renderGenericPagination({
                containerId: 'cancelledOrdersPagination',
                summaryId: 'cancelledOrdersPaginationSummary',
                buttonsId: 'cancelledOrdersPaginationButtons',
                currentPage: cancelledOrdersCurrentPage,
                totalItems: filtered.length,
                perPage: cancelledOrdersPerPage,
                itemLabel: 'বাতিল অর্ডার',
                onPageChangeFn: 'changeCancelledOrdersPage',
                activeColorClass: 'bg-rose-600 text-white'
            });

            lucide.createIcons();
        }

        async function undoCancelOrder(orderUuid) {
            showTopLoader();
            try {
                const res = await StoreApi.put('orders/' + orderUuid + '/status', { status: 'pending' });
                if (res && res.success) {
                    showToast('অর্ডার সফলভাবে পুনরুদ্ধার করা হয়েছে! (পেন্ডিং তালিকায় স্থানান্তরিত)', 'success');
                    await loadOrders();
                    renderCancelledOrders(ordersData);
                    renderCompletedOrders(ordersData);
                    renderOrders(ordersData);
                    loadProducts();
                } else {
                    showToast((res && res.message) ? res.message : 'অর্ডার আপডেট সম্ভব হয়নি।', 'error');
                }
            } catch (err) {
                showToast(err.message || 'ত্রুটি', 'error');
            } finally {
                hideTopLoader();
            }
        }

        async function revertCompletedOrder(orderUuid, targetStatus = 'pending') {
            showTopLoader();
            try {
                const res = await StoreApi.put('orders/' + orderUuid + '/status', { status: targetStatus });
                if (res && res.success) {
                    const statusName = targetStatus === 'processing' ? 'প্রসেসিং' : 'পেন্ডিং';
                    showToast(`অর্ডারটি পুনরায় অর্ডার ম্যানেজমেন্টে (${statusName} তালিকায়) ফিরিয়ে আনা হয়েছে!`, 'success');
                    await loadOrders();
                    renderCompletedOrders(ordersData);
                    renderOrders(ordersData);
                    loadProducts();
                    if ($('#modalOrderDetails').is(':visible') && activeModalOrder && activeModalOrder.uuid === orderUuid) {
                        openOrderDetailsModal(orderUuid);
                    }
                } else {
                    showToast((res && res.message) ? res.message : 'অর্ডার রিভার্ট করা সম্ভব হয়নি।', 'error');
                }
            } catch (err) {
                showToast(err.message || 'সার্ভার যোগাযোগে ত্রুটি', 'error');
            } finally {
                hideTopLoader();
            }
        }

        function copyOrderInfo(uuid) {
            const ord = ordersData.find(o => o.uuid === uuid) || (activeModalOrder && activeModalOrder.uuid === uuid ? activeModalOrder : null);
            if (!ord) {
                showToast('অর্ডারের তথ্য পাওয়া যায়নি।', 'error');
                return;
            }

            const items = Array.isArray(ord.items) ? ord.items : [];
            let itemsText = items.map((it, idx) => {
                const variants = [it.size ? `সাইজ: ${it.size}` : '', it.color ? `কালার: ${it.color}` : ''].filter(Boolean).join(', ');
                const varStr = variants ? ` (${variants})` : '';
                return `  ${idx + 1}. ${it.product_name}${varStr} x ${it.quantity} = ৳${formatPrice(it.total_price)}`;
            }).join('\n');

            const zoneText = ord.delivery_zone === 'outside_dhaka' ? 'ঢাকার বাইরে (৳১২০)' : 'ঢাকার ভেতরে (৳৬০)';
            const addressFull = [ord.delivery_address, ord.upazilla, ord.district, ord.division].filter(Boolean).join(', ');
            const paymentText = ord.payment_method === 'cod' ? 'ক্যাশ অন ডেলিভারি (COD)' : (ord.payment_method || 'ক্যাশ অন ডেলিভারি');

            const copyText = `অর্ডার নম্বর: ${ord.order_number}
তারিখ: ${ord.created_at || ''}
গ্রাহক: ${ord.customer_name}
মোবাইল: ${ord.customer_phone}
ঠিকানা: ${addressFull}
ডেলিভারি জোন: ${zoneText}
পণ্যসমূহ:
${itemsText}
সাবটোটাল: ৳${formatPrice(ord.subtotal)}
ডেলিভারি ফি: ৳${formatPrice(ord.delivery_charge)}
মোট বিল: ৳${formatPrice(ord.total_amount)}
পেমেন্ট মেথড: ${paymentText}`;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(copyText).then(() => {
                    showToast('অর্ডারের সম্পূর্ণ তথ্য সফলভাবে কপি করা হয়েছে!', 'success');
                }).catch(() => {
                    fallbackCopy(copyText);
                });
            } else {
                fallbackCopy(copyText);
            }
        }

        function fallbackCopy(text) {
            const ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            try {
                document.execCommand('copy');
                showToast('অর্ডারের সম্পূর্ণ তথ্য সফলভাবে কপি করা হয়েছে!', 'success');
            } catch (e) {
                showToast('কপি করতে ব্যর্থ হয়েছে, অনুগ্রহ করে ম্যানুয়ালি কপি করুন।', 'error');
            }
            document.body.removeChild(ta);
        }

        let activeCopyOrder = null;

        function openOrderCopyModal(uuid) {
            const ord = ordersData.find(o => o.uuid === uuid);
            if (!ord) {
                showToast('অর্ডারের তথ্য পাওয়া যায়নি।', 'error');
                return;
            }

            activeCopyOrder = ord;

            $('#qcopyOrderNumber').text(ord.order_number);
            $('#qcopyCustomerName').text(ord.customer_name);
            $('#qcopyCustomerPhone').text(ord.customer_phone);

            const cleanPhone = (ord.customer_phone || '').replace(/[^0-9]/g, '');
            const waPhone = cleanPhone.startsWith('88') ? cleanPhone : ('88' + cleanPhone);
            $('#qcopyCallBtn').attr('href', 'tel:' + cleanPhone);
            $('#qcopyWaBtn').attr('href', 'https://wa.me/' + waPhone + '?text=' + encodeURIComponent('আসসালামু আলাইকুম ' + ord.customer_name + ', আপনার অর্ডার ' + ord.order_number + ' সম্পর্কে যোগাযোগ করছি।'));

            const fullAddr = [ord.delivery_address, ord.upazilla, ord.district, ord.division].filter(Boolean).join(', ');
            $('#qcopyAddress').text(fullAddr || ord.delivery_address);
            $('#qcopyUpazilla').text(ord.upazilla || '-');
            $('#qcopyDistrict').text(ord.district || 'ঢাকা');

            const totalAmt = parseFloat(ord.total_amount || 0);
            $('#qcopyCodDisplay').text('৳' + formatPrice(totalAmt));
            $('#qcopyCodRaw').text(Math.round(totalAmt));

            const items = Array.isArray(ord.items) ? ord.items : [];
            let itemsLines = items.map((it, idx) => {
                const variants = [it.size ? `সাইজ: ${it.size}` : '', it.color ? `কালার: ${it.color}` : ''].filter(Boolean).join(', ');
                const varStr = variants ? ` (${variants})` : '';
                return `${idx + 1}. ${it.product_name}${varStr} x ${it.quantity} = ৳${formatPrice(it.total_price)}`;
            }).join('\n');
            $('#qcopyItemsSummary').text(itemsLines || 'কোনো আইটেম নেই');

            $('#modalOrderQuickCopy').fadeIn(150);
            lucide.createIcons();
        }

        function closeOrderCopyModal() {
            $('#modalOrderQuickCopy').fadeOut(100);
            activeCopyOrder = null;
        }

        function copyFieldText(selector, label) {
            const text = $(selector).text().trim();
            if (!text || text === '-') {
                showToast('কপি করার মতো তথ্য নেই।', 'warning');
                return;
            }
            copyTextToClipboard(text, label);
        }

        function copyPureCodAmount() {
            const rawVal = $('#qcopyCodRaw').text().trim();
            if (!rawVal) {
                showToast('টাকার পরিমাণ পাওয়া যায়নি।', 'warning');
                return;
            }
            copyTextToClipboard(rawVal, 'কালেকশন এমাউন্ট (টাকা)');
        }

        function copyTextToClipboard(text, label = 'তথ্য') {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast(`${label} সফলভাবে কপি হয়েছে!`, 'success');
                }).catch(() => {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }

        function openInvoiceFromCopyModal() {
            if (!activeCopyOrder) return;
            const uuid = activeCopyOrder.uuid;
            closeOrderCopyModal();
            openOrderDetailsModal(uuid);
        }

        function getStatusBadgeHtml(status) {
            switch (status) {
                case 'pending':
                    return '<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span><span>পেন্ডিং</span></span>';
                case 'processing':
                    return '<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800 border border-blue-200"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span><span>প্রসেসিং</span></span>';
                case 'delivered':
                    return '<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span>ডেলিভারি সম্পন্ন</span></span>';
                case 'cancel':
                    return '<span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-100 text-rose-800 border border-rose-200"><span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span><span>বাতিল</span></span>';
                default:
                    return `<span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">${escapeHtml(status)}</span>`;
            }
        }

        async function changeOrderStatus(uuid, newStatus) {
            const statusLabels = {
                pending: 'পেন্ডিং (Pending)',
                processing: 'প্রসেসিং (Processing)',
                delivered: 'ডেলিভারি সম্পন্ন (Delivered)',
                cancel: 'বাতিল (Trash)'
            };
            showTopLoader();
            try {
                const res = await StoreApi.put(`orders/${uuid}/status`, { status: newStatus });
                if (res && res.success) {
                    showToast(`অর্ডার স্ট্যাটাস পরিবর্তিত: ${statusLabels[newStatus] || newStatus}`, 'success');
                    await loadOrders();
                    if (newStatus === 'cancel' || newStatus === 'pending') {
                        loadProducts();
                    }
                    if ($('#modalOrderDetails').is(':visible') && activeModalOrder && activeModalOrder.uuid === uuid) {
                        openOrderDetailsModal(uuid);
                    }
                } else {
                    showToast((res && res.message) ? res.message : 'স্ট্যাটাস আপডেট ব্যর্থ হয়েছে', 'error');
                }
            } catch (err) {
                showToast(err.message || 'সার্ভার যোগাযোগে ত্রুটি', 'error');
            } finally {
                hideTopLoader();
            }
        }

        let activeModalOrder = null;

        function openOrderDetailsModal(uuid) {
            const ord = ordersData.find(o => o.uuid === uuid);
            if (!ord) return;

            activeModalOrder = ord;

            $('#modalOrderInvoiceNo').text(ord.order_number);
            $('#modalCurrentStatusBadge').html(getStatusBadgeHtml(ord.status));
            $('#modalStatusSelect').val(ord.status);

            $('#invOrderNumber').text(ord.order_number);
            $('#invOrderDate').text(ord.created_at || '');

            $('#invCustomerName').text(ord.customer_name);
            $('#invCustomerPhone').text(ord.customer_phone);

            const cleanPhone = (ord.customer_phone || '').replace(/[^0-9]/g, '');
            const waPhone = cleanPhone.startsWith('88') ? cleanPhone : ('88' + cleanPhone);
            $('#invCustomerActions').html(`
                <a href="tel:${escapeHtml(ord.customer_phone)}" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition">
                    <i data-lucide="phone" class="w-3 h-3"></i><span>কল</span>
                </a>
                <a href="https://wa.me/${waPhone}" target="_blank" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-[11px] font-bold flex items-center space-x-1 shadow-2xs transition">
                    <i data-lucide="message-circle" class="w-3 h-3"></i><span>WhatsApp</span>
                </a>
            `);

            const zoneName = (ord.delivery_zone === 'outside_dhaka') ? `ঢাকার বাইরে (৳${formatPrice(ord.delivery_charge)})` : `ঢাকার ভেতরে (৳${formatPrice(ord.delivery_charge)})`;
            $('#invDeliveryZone').text(zoneName);
            $('#invFullAddress').text(`${ord.delivery_address}, ${ord.upazilla || ''}, ${ord.district || ''}, ${ord.division || ''}`);
            $('#invPaymentMethod').text(`পেমেন্ট: ${ord.payment_method === 'cod' ? 'ক্যাশ অন ডেলিভারি (COD)' : ord.payment_method}`);

            // Items table
            const tbody = $('#invItemsTableBody');
            tbody.empty();
            const items = Array.isArray(ord.items) ? ord.items : [];
            items.forEach(it => {
                const variantText = [it.size ? `সাইজ: ${it.size}` : '', it.color ? `কালার: ${it.color}` : ''].filter(Boolean).join(' | ') || 'স্ট্যান্ডার্ড';
                tbody.append(`
                    <tr>
                        <td class="py-2.5 px-3 font-semibold text-slate-800">${escapeHtml(it.product_name)}</td>
                        <td class="py-2.5 px-2 text-center text-orange-600 font-bold">${escapeHtml(variantText)}</td>
                        <td class="py-2.5 px-2 text-right font-mono">৳${formatPrice(it.unit_price)}</td>
                        <td class="py-2.5 px-2 text-center font-bold">${it.quantity}</td>
                        <td class="py-2.5 px-3 text-right font-mono font-bold text-slate-900">৳${formatPrice(it.total_price)}</td>
                    </tr>
                `);
            });

            $('#invSubtotal').text('৳' + formatPrice(ord.subtotal));
            $('#invDeliveryCharge').text('৳' + formatPrice(ord.delivery_charge));
            $('#invTotalAmount').text('৳' + formatPrice(ord.total_amount));

            $('#modalOrderDetails').fadeIn(150);
            lucide.createIcons();
        }

        function closeOrderDetailsModal() {
            $('#modalOrderDetails').fadeOut(100);
            activeModalOrder = null;
        }

        function changeOrderStatusFromModal() {
            if (!activeModalOrder) return;
            const newStatus = $('#modalStatusSelect').val();
            changeOrderStatus(activeModalOrder.uuid, newStatus);
        }

        function printOrderInvoice() {
            window.print();
        }

        // Helper escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
            return text.toString().replace(/[&<>"']/g, m => map[m]);
        }

        // On Page Load
        $(document).ready(function() {
            showTopLoader();
            lucide.createIcons();
            switchLanguage(currentLang);
            updateUI(storeData);
            loadProfile();
            loadCategories();
            loadProducts();
            loadOrders();
            loadDeliveryChargesAdmin();
            setupImageDropzone();
            loadSaasSubscriptionAndPayments();

            // Initial load skeleton transition
            setTimeout(function() {
                $('#sidebarSkeleton').addClass('hidden');
                $('#sidebarNavContent').removeClass('hidden').addClass('tab-transition');
                $('#tabContentSkeleton').addClass('hidden');
                $('#tabContentDashboard').removeClass('hidden').addClass('tab-transition');
                $('#mobileBottomNavSkeleton').addClass('hidden');
                $('#mobileBottomNav').css('display', '').removeClass('hidden').addClass('tab-transition');
                $('#mobileDrawerSkeleton').addClass('hidden');
                $('#mobileDrawerNavContent').removeClass('hidden').addClass('tab-transition');
                if (typeof window.updateMobileNavActive === 'function') { window.updateMobileNavActive('dashboard'); }
                hideTopLoader();
                if (window.lucide) lucide.createIcons();
            }, 300);
        });
    

        // ==========================================
        // DISCOUNT MANAGEMENT SYSTEM
        // ==========================================
        function renderDiscountsTable(list = productsData) {
            const discounted = (list || []).filter(p => p.has_discount || (parseInt(p.discount_percent) > 0 && (!p.discount_ends_at || new Date(p.discount_ends_at.replace(/-/g, '/')) > new Date())));
            
            $('#badgeDiscountCount, #mobDrawerBadgeDiscount').text(discounted.length);
            $('#statActiveDiscounts').text(discounted.length + ' টি');
            
            let maxDisc = 0;
            discounted.forEach(p => {
                const pct = parseInt(p.discount_percent) || 0;
                if (pct > maxDisc) maxDisc = pct;
            });
            $('#statMaxDiscount').text(maxDisc > 0 ? maxDisc + '%' : '0%');

            const $container = $('#discountsListContainer');
            if ($container.length === 0) return;
            $container.empty();

            if (discounted.length === 0) {
                $container.html(`
                    <div class="py-12 text-center space-y-3">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mx-auto">
                            <i data-lucide="tag" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800">কোনো সক্রিয় ডিসকাউন্ট নেই</h4>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto">আপনার যেকোনো পণ্যে স্পেশাল ডিসকাউন্ট পারসেন্ট ও মেয়াদ যুক্ত করতে উপরের বাটনে ক্লিক করুন।</p>
                        <button type="button" onclick="openSetDiscountModal()" class="inline-flex items-center space-x-1.5 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold rounded-xl transition shadow-xs cursor-pointer">
                            <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                            <span>+ নতুন ডিসকাউন্ট চালু করুন</span>
                        </button>
                    </div>
                `);
                $('#discountsPagination').addClass('hidden');
                if (window.lucide) lucide.createIcons();
                return;
            }

            const totalPages = Math.ceil(discounted.length / discountsPerPage);
            if (discountsCurrentPage > totalPages) discountsCurrentPage = totalPages || 1;
            if (discountsCurrentPage < 1) discountsCurrentPage = 1;

            const startIndex = (discountsCurrentPage - 1) * discountsPerPage;
            const pageDiscounts = discounted.slice(startIndex, startIndex + discountsPerPage);

            let cardsHtml = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
            pageDiscounts.forEach(prod => {
                const img = (prod.images && prod.images[0]) ? prod.images[0] : null;
                const regPrice = parseFloat(prod.retailer_price || 0);
                const discPercent = parseInt(prod.discount_percent || 0);
                const discPrice = parseFloat(prod.effective_price || (regPrice * (1 - discPercent / 100)));
                const savings = regPrice - discPrice;
                const endsAt = prod.discount_ends_at ? new Date(prod.discount_ends_at.replace(/-/g, '/')).toLocaleString('bn-BD', { dateStyle: 'medium', timeStyle: 'short' }) : 'মেয়াদহীন';

                cardsHtml += `
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-2xs hover:shadow-md transition space-y-3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center space-x-3 min-w-0">
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                                        ${img ? `<img src="${img}" class="w-full h-full object-cover">` : `<i data-lucide="package" class="w-6 h-6 text-slate-400"></i>`}
                                    </div>
                                    <div class="min-w-0">
                                        <span class="px-2 py-0.5 bg-red-100 text-red-700 font-black rounded-lg text-[10px] inline-flex items-center space-x-1">
                                            <i data-lucide="flame" class="w-3 h-3 text-red-600"></i>
                                            <span>${discPercent}% ছাড়</span>
                                        </span>
                                        <h4 class="font-bold text-slate-900 text-xs truncate mt-1" title="${escapeHtml(prod.name)}">${escapeHtml(prod.name)}</h4>
                                        <span class="text-[10px] text-slate-400">${escapeHtml(prod.category_name || 'ক্যাটাগরি নেই')}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Info -->
                            <div class="mt-3 p-2.5 bg-slate-50 border border-slate-200/70 rounded-xl space-y-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400 text-[10px]">আসল মূল্য:</span>
                                    <span class="line-through text-slate-400 font-mono">৳${regPrice.toFixed(2)}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-600 font-bold text-[11px]">ডিসকাউন্ট মূল্য:</span>
                                    <span class="font-black text-orange-600 font-mono text-sm">৳${discPrice.toFixed(2)}</span>
                                </div>
                                <div class="flex items-center justify-between border-t border-slate-200/60 pt-1 text-[10px]">
                                    <span class="text-emerald-700 font-semibold">গ্রাহকের সাশ্রয়:</span>
                                    <span class="font-bold text-emerald-600 font-mono">৳${savings.toFixed(2)}</span>
                                </div>
                            </div>

                            <!-- Expiry Info & Live Countdown -->
                            <div class="space-y-1.5 mt-2.5">
                                <div class="text-[10px] text-slate-500 flex items-center space-x-1">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span>মেয়াদ শেষ: <strong>${endsAt}</strong></span>
                                </div>
                                <div class="p-2 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/90 rounded-xl flex items-center justify-between text-xs shadow-2xs">
                                    <span class="text-amber-800 font-bold flex items-center space-x-1.5">
                                        <i data-lucide="timer" class="w-3.5 h-3.5 text-orange-600 animate-pulse"></i>
                                        <span>অফার বাকি:</span>
                                    </span>
                                    <span class="font-mono font-black text-amber-950 bg-white px-2 py-0.5 rounded border border-amber-200 text-[11px] discount-countdown-timer shadow-2xs" data-ends="${prod.discount_ends_at || ''}">
                                        হিসাব হচ্ছে...
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-2 pt-2 border-t border-slate-100">
                            <button type="button" onclick="openSetDiscountModal('${prod.uuid}')" class="flex-1 py-1.5 px-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center justify-center space-x-1 cursor-pointer">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                <span>এডিট</span>
                            </button>
                            <button type="button" onclick="removeProductDiscount('${prod.uuid}')" class="py-1.5 px-3 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition flex items-center justify-center space-x-1 cursor-pointer" title="ডিসকাউন্ট বাতিল করুন">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span>বাতিল</span>
                            </button>
                        </div>
                    </div>
                `;
            });
            cardsHtml += '</div>';

            $container.html(cardsHtml);

            renderGenericPagination({
                containerId: 'discountsPagination',
                summaryId: 'discountsPaginationSummary',
                buttonsId: 'discountsPaginationButtons',
                currentPage: discountsCurrentPage,
                totalItems: discounted.length,
                perPage: discountsPerPage,
                itemLabel: 'ডিসকাউন্ট পণ্য',
                onPageChangeFn: 'changeDiscountsPage',
                activeColorClass: 'bg-orange-600 text-white'
            });

            if (window.lucide) lucide.createIcons();

            if (!window.discountCountdownInterval) {
                window.discountCountdownInterval = setInterval(updateDiscountCountdowns, 1000);
            }
            updateDiscountCountdowns();
        }

        function updateDiscountCountdowns() {
            $('.discount-countdown-timer').each(function() {
                const endsAtStr = $(this).attr('data-ends');
                if (!endsAtStr) {
                    $(this).text('মেয়াদহীন অফার');
                    return;
                }
                const endsTime = new Date(endsAtStr.replace(/-/g, '/')).getTime();
                const now = Date.now();
                const diff = endsTime - now;

                if (diff <= 0) {
                    $(this).html('<span class="text-rose-600 font-bold">মেয়াদ শেষ</span>');
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                let text = '';
                if (days > 0) {
                    text = `${toBnDigit(days)} দিন ${toBnDigit(hours)} ঘ. ${toBnDigit(minutes)} মি. ${toBnDigit(seconds)} সে.`;
                } else {
                    text = `${toBnDigit(String(hours).padStart(2, '0'))}:${toBnDigit(String(minutes).padStart(2, '0'))}:${toBnDigit(String(seconds).padStart(2, '0'))}`;
                }
                $(this).text(text);
            });
        }

        function openSetDiscountModal(productUuid = null) {
            const $select = $('#discProductUuid');
            $select.empty().append('<option value="">-- পণ্য বেছে নিন --</option>');

            (productsData || []).forEach(p => {
                const isSelected = productUuid && p.uuid === productUuid;
                const discBadge = p.has_discount ? ` [বর্তমানে ${p.discount_percent}% ছাড় চলছে]` : '';
                $select.append(`<option value="${p.uuid}" ${isSelected ? 'selected' : ''}>${escapeHtml(p.name)} - ৳${parseFloat(p.retailer_price || 0).toFixed(2)}${discBadge}</option>`);
            });

            if (productUuid) {
                const prod = (productsData || []).find(p => p.uuid === productUuid);
                if (prod) {
                    $('#discPercent').val(prod.discount_percent || 20);
                    if (prod.discount_ends_at) {
                        const dt = new Date(prod.discount_ends_at.replace(/-/g, '/'));
                        const localIso = new Date(dt.getTime() - dt.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
                        $('#discEndsAt').val(localIso);
                    } else {
                        setDefaultDiscountExpiry();
                    }
                }
            } else {
                $('#discPercent').val(20);
                setDefaultDiscountExpiry();
            }

            calcDiscountPreview();
            $('#modalSetDiscount').removeClass('hidden').css('display', 'flex');
            $('body').addClass('overflow-hidden');
            if (window.lucide) lucide.createIcons();
        }

        function setDefaultDiscountExpiry() {
            const d = new Date();
            d.setDate(d.getDate() + 7);
            const localIso = new Date(d.getTime() - d.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
            $('#discEndsAt').val(localIso);
        }

        function closeSetDiscountModal() {
            $('#modalSetDiscount').addClass('hidden').css('display', 'none');
            $('body').removeClass('overflow-hidden');
        }

        function setQuickDiscPercent(val) {
            $('#discPercent').val(val);
            calcDiscountPreview();
        }

        function onDiscountProductSelect() {
            calcDiscountPreview();
        }

        function calcDiscountPreview() {
            const uuid = $('#discProductUuid').val();
            const percent = parseInt($('#discPercent').val()) || 0;
            $('#discPercentDisplay').text(percent + '%');

            const prod = (productsData || []).find(p => p.uuid === uuid);
            if (!prod) {
                $('#discPrevRegular').text('৳ 0.00');
                $('#discPrevSavings').text('৳ 0.00');
                $('#discPrevFinal').text('৳ 0.00');
                return;
            }

            const regPrice = parseFloat(prod.retailer_price || 0);
            const savings = (regPrice * percent) / 100;
            const finalPrice = Math.max(0, regPrice - savings);

            $('#discPrevRegular').text('৳ ' + regPrice.toFixed(2));
            $('#discPrevSavings').text('৳ ' + savings.toFixed(2));
            $('#discPrevFinal').text('৳ ' + finalPrice.toFixed(2));
        }

        async function submitSetDiscount(e) {
            e.preventDefault();
            const uuid = $('#discProductUuid').val();
            const percent = parseInt($('#discPercent').val()) || 0;
            const endsAtRaw = $('#discEndsAt').val();

            if (!uuid) {
                Toast.warning('অনুগ্রহ করে একটি পণ্য নির্বাচন করুন।');
                return;
            }
            if (percent < 1 || percent > 99) {
                Toast.warning('ডিসকাউন্ট শতকরা ১% থেকে ৯৯% এর মধ্যে হতে হবে।');
                return;
            }
            if (!endsAtRaw) {
                Toast.warning('অফারের মেয়াদ শেষ হওয়ার তারিখ ও সময় দিন।');
                return;
            }

            const endsDate = new Date(endsAtRaw);
            const formattedEndsAt = endsDate.getFullYear() + '-' +
                String(endsDate.getMonth() + 1).padStart(2, '0') + '-' +
                String(endsDate.getDate()).padStart(2, '0') + ' ' +
                String(endsDate.getHours()).padStart(2, '0') + ':' +
                String(endsDate.getMinutes()).padStart(2, '0') + ':00';

            $('#btnSaveDiscount').prop('disabled', true).html('<i data-lucide="loader-2" class="w-4 h-4 animate-spin inline mr-1"></i><span>সক্রিয় হচ্ছে...</span>');
            if (window.lucide) lucide.createIcons();

            try {
                const res = await StoreApi.put('products/' + encodeURIComponent(uuid) + '/discount', {
                    discount_percent: percent,
                    discount_ends_at: formattedEndsAt
                });

                if (res.success) {
                    Toast.success('ডিসকাউন্ট সফলভাবে চালু করা হয়েছে!');
                    closeSetDiscountModal();
                    await loadProducts();
                    renderDiscountsTable(productsData);
                } else {
                    Toast.error(res.message || 'ডিসকাউন্ট সেট করতে সমস্যা হয়েছে।');
                }
            } catch (err) {
                Toast.error(err.message || 'নেটওয়ার্ক সমস্যা হয়েছে।');
            } finally {
                $('#btnSaveDiscount').prop('disabled', false).html('<i data-lucide="check" class="w-4 h-4 inline mr-1"></i><span>ডিসকাউন্ট সক্রিয় করুন</span>');
                if (window.lucide) lucide.createIcons();
            }
        }

        function removeProductDiscount(uuid) {
            const prod = (productsData || []).find(p => p.uuid === uuid);
            const prodName = prod ? prod.name : 'পণ্য';

            pendingDeleteProductUuid = null;
            $('#modalConfirmDelete h3').text('ডিসকাউন্ট বাতিল করতে চান?');
            $('#modalConfirmDelete p').html(`আপনি কি নিশ্চিতভাবে <b class="text-rose-600 font-bold">"${escapeHtml(prodName)}"</b> এর স্পেশাল অফার সরিয়ে নিতে চান? পণ্যটিতে নিয়মিত বিক্রয়মূল্য কার্যকর হবে।`);
            
            $('#btnExecuteDelete').off('click').on('click', async function() {
                const $btn = $(this);
                const originalHtml = $btn.html();
                $btn.prop('disabled', true).addClass('opacity-70').html('<i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin inline mr-1"></i> বাতিল হচ্ছে...');
                try {
                    const res = await StoreApi.delete('products/' + encodeURIComponent(uuid) + '/discount');
                    if (res.success) {
                        closeConfirmDeleteModal();
                        await loadProducts();
                        renderDiscountsTable(productsData);
                        Toast.info('ডিসকাউন্ট সফলভাবে বাতিল করা হয়েছে।');
                    } else {
                        Toast.error(res.message || 'বাতিল করা সম্ভব হয়নি।');
                    }
                } catch(err) {
                    Toast.error(err.message || 'নেটওয়ার্ক সমস্যা');
                } finally {
                    $btn.prop('disabled', false).removeClass('opacity-70').html(originalHtml);
                    if (window.lucide) lucide.createIcons();
                }
            });

            $('#modalConfirmDelete').removeClass('hidden').css('display', 'flex');
            $('body').addClass('overflow-hidden');
            if (window.lucide) lucide.createIcons();
        }


        // ==========================================
        // DELIVERY CHARGES MANAGEMENT (CRUD)
        // ==========================================
        let deliveryChargesData = [];

        async function loadDeliveryChargesAdmin() {
            renderDeliveryChargeSkeletons(3);
            try {
                const res = await StoreApi.get('delivery-charges', { store: STORE_UUID });
                if (res && res.success && Array.isArray(res.data)) {
                    deliveryChargesData = res.data;
                } else {
                    deliveryChargesData = [];
                }
                renderDeliveryChargesTable(deliveryChargesData);
            } catch (e) {
                console.error('Failed to load delivery charges:', e);
                deliveryChargesData = [];
                renderDeliveryChargesTable([]);
            }
        }

        function renderDeliveryChargesTable(charges) {
            const tbody = document.getElementById('deliveryChargesTableBody');
            if (!tbody) return;
            tbody.innerHTML = '';

            const badgeCount = document.getElementById('badgeDeliveryCount');
            if (badgeCount) badgeCount.textContent = charges.length;
            const mobBadgeCount = document.getElementById('mobDrawerBadgeDelivery');
            if (mobBadgeCount) mobBadgeCount.textContent = charges.length;

            const statTotal = document.getElementById('statDeliveryTotal');
            if (statTotal) statTotal.textContent = charges.length;

            const activeCount = charges.filter(c => c.status === 'active').length;
            const statActive = document.getElementById('statDeliveryActive');
            if (statActive) statActive.textContent = activeCount;

            const defaultCharge = charges.find(c => c.is_default == 1) || charges[0];
            const statDefault = document.getElementById('statDeliveryDefault');
            if (statDefault) {
                statDefault.textContent = defaultCharge ? defaultCharge.title + ' (৳' + parseFloat(defaultCharge.amount).toFixed(2) + ')' : 'কোনো ডিফল্ট নেই';
            }

            if (charges.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">
                            <i data-lucide="truck" class="w-8 h-8 mx-auto mb-2 opacity-50"></i>
                            <div>কোনো ডেলিভারি চার্জ পাওয়া যায়নি</div>
                            <button type="button" onclick="openDeliveryModal()" class="mt-3 px-3 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg transition hover:bg-emerald-700 cursor-pointer">+ প্রথম ডেলিভারি চার্জ যুক্ত করুন</button>
                        </td>
                    </tr>
                `;
                if (window.lucide) lucide.createIcons();
                return;
            }

            let rowsHtml = '';
            charges.forEach(c => {
                const isDefault = (c.is_default == 1);
                const isActive = (c.status === 'active');
                const defaultBadge = isDefault 
                    ? '<span class="ml-1.5 px-2 py-0.5 rounded-full text-[9px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200">ডিফল্ট</span>' 
                    : '';
                const statusBadge = isActive
                    ? '<span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">সক্রিয়</span>'
                    : '<span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">নিষ্ক্রিয়</span>';

                rowsHtml += `
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3.5 px-4 font-bold text-slate-900">
                            <div class="flex items-center">
                                <span>${escapeHtml(c.title)}</span>
                                ${defaultBadge}
                            </div>
                        </td>
                        <td class="py-3.5 px-3 font-mono text-[11px] text-slate-500">${escapeHtml(c.code)}</td>
                        <td class="py-3.5 px-3 font-mono font-black text-slate-900 text-sm">৳${parseFloat(c.amount).toFixed(2)}</td>
                        <td class="py-3.5 px-3 text-slate-500 text-xs">${escapeHtml(c.description || '-')}</td>
                        <td class="py-3.5 px-3 text-center">${statusBadge}</td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end space-x-1">
                                <button type="button" onclick="editDeliveryCharge('${c.uuid}')" class="p-1.5 text-slate-400 hover:text-emerald-600 rounded-lg hover:bg-emerald-50 transition cursor-pointer" title="সম্পাদনা করুন">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <button type="button" onclick="deleteDeliveryCharge('${c.uuid}', '${escapeHtml(c.title)}')" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition cursor-pointer" title="মুছে ফেলুন">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = rowsHtml;
            if (window.lucide) lucide.createIcons();
        }

        function openDeliveryModal(uuid = null) {
            $('#formDeliveryCharge')[0].reset();
            $('#delInputUuid').val('');
            $('#delInputStatus').val('active');
            $('#delInputSort').val(deliveryChargesData.length + 1);
            $('#delInputDefault').prop('checked', false);

            if (uuid) {
                const item = deliveryChargesData.find(c => c.uuid === uuid);
                if (item) {
                    $('#delInputUuid').val(item.uuid);
                    $('#modalDeliveryTitle').text('ডেলিভারি চার্জ সম্পাদনা করুন');
                    $('#delInputTitle').val(item.title);
                    $('#delInputCode').val(item.code);
                    $('#delInputAmount').val(parseFloat(item.amount));
                    $('#delInputDesc').val(item.description || '');
                    $('#delInputStatus').val(item.status);
                    $('#delInputSort').val(item.sort_order || 1);
                    $('#delInputDefault').prop('checked', item.is_default == 1);
                }
            } else {
                $('#modalDeliveryTitle').text('নতুন ডেলিভারি চার্জ যুক্ত করুন');
                if (deliveryChargesData.length === 0) {
                    $('#delInputDefault').prop('checked', true);
                }
            }

            $('#modalDeliveryCharge').removeClass('hidden');
            $('body').addClass('overflow-hidden');
            if (window.lucide) lucide.createIcons();
        }

        function closeDeliveryModal() {
            $('#modalDeliveryCharge').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        }

        async function handleDeliverySubmit(e) {
            e.preventDefault();
            const uuid = $('#delInputUuid').val();
            const title = $('#delInputTitle').val().trim();
            const code = $('#delInputCode').val().trim();
            const amount = parseFloat($('#delInputAmount').val());
            const description = $('#delInputDesc').val().trim();
            const status = $('#delInputStatus').val();
            const sort_order = parseInt($('#delInputSort').val()) || 0;
            const is_default = $('#delInputDefault').is(':checked') ? 1 : 0;

            if (!title || isNaN(amount) || amount < 0) {
                showToast('অনুগ্রহ করে সঠিক তথ্য প্রদান করুন।', 'error');
                return;
            }

            const payload = { store_uuid: STORE_UUID, title, code, amount, description, status, sort_order, is_default };

            try {
                let res;
                if (uuid) {
                    res = await StoreApi.put(`delivery-charges/${uuid}`, payload);
                } else {
                    res = await StoreApi.post('delivery-charges', payload);
                }

                if (res && res.success) {
                    showToast(uuid ? 'ডেলিভারি চার্জ সফলভাবে আপডেট হয়েছে।' : 'নতুন ডেলিভারি চার্জ যুক্ত হয়েছে।', 'success');
                    closeDeliveryModal();
                    await loadDeliveryChargesAdmin();
                } else {
                    showToast((res && res.message) || 'ডেলিভারি চার্জ সংরক্ষণ ব্যর্থ হয়েছে।', 'error');
                }
            } catch (err) {
                console.error('Save delivery charge error:', err);
                showToast('সার্ভার যোগাযোগে সমস্যা হয়েছে।', 'error');
            }
        }

        function editDeliveryCharge(uuid) {
            openDeliveryModal(uuid);
        }

        async function deleteDeliveryCharge(uuid, title) {
            if (!confirm(`"${title}" ডেলিভারি চার্জটি মুছে ফেলতে চান?`)) {
                return;
            }

            try {
                const res = await StoreApi.delete(`delivery-charges/${uuid}?store=${STORE_UUID}`);
                if (res && res.success) {
                    showToast('ডেলিভারি চার্জ মুছে ফেলা হয়েছে।', 'success');
                    await loadDeliveryChargesAdmin();
                } else {
                    showToast((res && res.message) || 'ডেলিভারি চার্জ মোছা সম্ভব হয়নি।', 'error');
                }
            } catch (e) {
                showToast('সার্ভার যোগাযোগে সমস্যা হয়েছে।', 'error');
            }
        }


                // ==========================================
        // WEBSITE DESIGN (20 UNIQUE FLUID TEMPLATES, PALETTES & PREVIEW)
        // ==========================================
        const STORE_TEMPLATES_REGISTRY = <?= json_encode(array_values($themeData['all_templates'] ?? []), JSON_UNESCAPED_UNICODE) ?>;
        const STORE_PALETTES_REGISTRY  = <?= json_encode($themeData['all_palettes'] ?? [], JSON_UNESCAPED_UNICODE) ?>;

        let selectedTemplateId = '<?= htmlspecialchars($templateId ?? 'template_1') ?>';
        let selectedPaletteId  = '<?= htmlspecialchars($paletteId ?? 'orange') ?>';
        const templatePaletteState = {};
        STORE_TEMPLATES_REGISTRY.forEach(tpl => {
            if (tpl.id === selectedTemplateId) {
                templatePaletteState[tpl.id] = selectedPaletteId;
            } else {
                templatePaletteState[tpl.id] = (tpl.palettes && tpl.palettes[0]) ? tpl.palettes[0] : 'orange';
            }
        });

        function renderDesignWebsiteTab() {
            const $grid = $('#designTemplatesGrid');
            if (!$grid.length) return;
            $grid.empty();

            STORE_TEMPLATES_REGISTRY.forEach(tpl => {
                const isSelectedTpl = (tpl.id === selectedTemplateId);
                const activePalKey = templatePaletteState[tpl.id] || (tpl.palettes ? tpl.palettes[0] : 'orange');
                const palObj = STORE_PALETTES_REGISTRY[activePalKey] || STORE_PALETTES_REGISTRY['orange'];
                const primaryHex = palObj ? palObj.primary : '#ea580c';
                const secondaryHex = palObj ? palObj.secondary : '#d97706';
                const cleanActivePalName = (palObj && palObj.name_bn) ? palObj.name_bn.split('(')[0].trim() : 'ডিফল্ট';

                // Sleek, prominent Color Palette Chips on a compact flex row
                let paletteChipsHtml = '';
                (tpl.palettes || []).forEach(pKey => {
                    const p = STORE_PALETTES_REGISTRY[pKey];
                    if (!p) return;
                    const isPalActive = (activePalKey === pKey);
                    const cleanName = (p.name_bn || '').split('(')[0].trim();
                    paletteChipsHtml += `
                        <button type="button" onclick="selectTemplatePalette('${tpl.id}', '${pKey}', event)"
                            title="${p.name_bn} (${p.name_en})"
                            class="flex items-center space-x-1.5 px-2.5 py-1 rounded-lg border transition-all cursor-pointer ${
                                isPalActive 
                                    ? 'border-slate-900 bg-slate-900 text-white shadow-xs font-bold scale-[1.02]' 
                                    : 'border-slate-200 bg-white hover:border-slate-400 text-slate-700'
                            }">
                            <span class="w-3.5 h-3.5 rounded-full shrink-0 border border-white/60 shadow-2xs" style="background: linear-gradient(135deg, ${p.primary}, ${p.secondary});"></span>
                            <span class="text-[11px] truncate max-w-[85px]">${cleanName}</span>
                        </button>
                    `;
                });

                const fontName = tpl.font_name || 'Hind Siliguri';
                const catBn = tpl.category_bn || 'জেনারেল স্টোর';

                const cardHtml = `
                    <div onclick="selectDesignTemplate('${tpl.id}')"
                         class="bg-white rounded-2xl border-2 transition-all duration-200 overflow-hidden flex flex-col justify-between cursor-pointer ${
                             isSelectedTpl 
                                 ? 'border-brand-600 ring-4 ring-brand-100 shadow-md' 
                                 : 'border-slate-200 hover:border-brand-300 shadow-xs hover:shadow-md'
                         }">
                        
                        <div class="p-4 space-y-2.5">
                            <!-- Top Header: Number + Category Badge + Active/Font -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-0.5 rounded-md text-xs font-black text-white shadow-2xs" style="background-color: ${primaryHex};">
                                        #${tpl.number}
                                    </span>
                                    <span class="text-[11px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md">
                                        ${catBn}
                                    </span>
                                </div>
                                ${isSelectedTpl ? `
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center space-x-1 shadow-2xs">
                                        <i data-lucide="check" class="w-3 h-3 text-emerald-600 stroke-[3]"></i>
                                        <span>সক্রিয় থিম</span>
                                    </span>
                                ` : `
                                    <span class="text-[11px] text-slate-400 font-medium">ফন্ট: <strong class="text-slate-600">${fontName}</strong></span>
                                `}
                            </div>

                            <!-- Title & 1-line Description -->
                            <div>
                                <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-brand-600 transition leading-snug">${tpl.name_bn}</h3>
                                <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1">${tpl.desc_bn}</p>
                            </div>

                            <!-- COMPACT PROMINENT COLOR PALETTE ROW -->
                            <div class="pt-2 border-t border-slate-100 space-y-1.5">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-slate-800 flex items-center space-x-1 text-[11px]">
                                        <i data-lucide="palette" class="w-3.5 h-3.5 text-brand-600"></i>
                                        <span>কালার থিম:</span>
                                    </span>
                                    <span class="text-[11px] font-bold text-brand-600">${cleanActivePalName}</span>
                                </div>
                                <div class="flex flex-wrap gap-1.5 items-center">
                                    ${paletteChipsHtml}
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Footer (Compact) -->
                        <div class="px-4 py-2.5 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between gap-2">
                            <button type="button" onclick="previewTemplateTheme('${tpl.id}', event)"
                                class="px-3 py-1.5 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 transition shadow-2xs cursor-pointer flex items-center space-x-1">
                                <i data-lucide="eye" class="w-3.5 h-3.5 text-slate-500"></i>
                                <span>প্রিভিউ</span>
                            </button>

                            <button type="button" onclick="selectAndSaveTemplate('${tpl.id}', event)"
                                class="px-3.5 py-1.5 rounded-xl text-xs font-black transition shadow-2xs cursor-pointer flex items-center space-x-1.5 ${isSelectedTpl ? 'bg-emerald-600 text-white' : 'text-white'}"
                                style="${!isSelectedTpl ? 'background-color:' + primaryHex : ''}">
                                <i data-lucide="${isSelectedTpl ? 'check' : 'mouse-pointer-click'}" class="w-3.5 h-3.5"></i>
                                <span>${isSelectedTpl ? 'সক্রিয় রয়েছে' : 'বেছে নিন'}</span>
                            </button>
                        </div>
                    </div>
                `;
                $grid.append(cardHtml);
            });

            updateActiveDesignHeaderLabels();
            if (window.lucide) lucide.createIcons();
        }

        function previewTemplateTheme(templateId, event) {
            if (event) event.stopPropagation();
            const tplId = templateId || selectedTemplateId || 'template_1';
            const palKey = templatePaletteState[tplId] || selectedPaletteId || 'orange';
            const previewUrl = `../?preview_template=${encodeURIComponent(tplId)}&preview_palette=${encodeURIComponent(palKey)}`;
            window.open(previewUrl, '_blank');
        }

        function updateActiveDesignHeaderLabels() {
            const tpl = STORE_TEMPLATES_REGISTRY.find(t => t.id === selectedTemplateId);
            const pal = STORE_PALETTES_REGISTRY[selectedPaletteId];
            if (tpl) $('#lblActiveTemplateName').text(tpl.name_bn);
            if (pal) $('#lblActivePaletteName').text(pal.name_bn);
        }

        function selectDesignTemplate(templateId) {
            selectedTemplateId = templateId;
            selectedPaletteId = templatePaletteState[templateId] || 'orange';
            applyLiveAdminPalette(selectedPaletteId);
            renderDesignWebsiteTab();
        }

        function selectTemplatePalette(templateId, paletteKey, event) {
            if (event) event.stopPropagation();
            templatePaletteState[templateId] = paletteKey;
            selectedTemplateId = templateId;
            selectedPaletteId = paletteKey;
            applyLiveAdminPalette(paletteKey);
            renderDesignWebsiteTab();
        }

        async function selectAndSaveTemplate(templateId, event) {
            if (event) event.stopPropagation();
            selectedTemplateId = templateId;
            selectedPaletteId = templatePaletteState[templateId] || 'orange';
            applyLiveAdminPalette(selectedPaletteId);
            renderDesignWebsiteTab();
            await saveWebsiteDesign();
        }

        function applyLiveAdminPalette(paletteKey) {
            const pal = STORE_PALETTES_REGISTRY[paletteKey];
            if (!pal || !pal.shades) return;
            const s = pal.shades;
            const root = document.documentElement;
            Object.keys(s).forEach(k => {
                root.style.setProperty(`--brand-${k}`, s[k]);
            });
        }

        async function saveWebsiteDesign() {
            const btn = $('#btnSaveWebsiteDesign');
            btn.prop('disabled', true).addClass('opacity-70');
            showTopLoader();

            try {
                const res = await StoreApi.put(`tenants/${STORE_UUID}/profile`, {
                    template_id: selectedTemplateId,
                    color_palette: selectedPaletteId
                });

                if (res && res.success) {
                    applyLiveAdminPalette(selectedPaletteId);
                    showToast('ওয়েবসাইট টেমপ্লেট ও কালার প্যালেট সফলভাবে আপডেট হয়েছে!', 'success');
                } else {
                    showToast((res && res.message) || 'ডিজাইন সংরক্ষণ ব্যর্থ হয়েছে।', 'error');
                }
            } catch (err) {
                console.error('Save design error:', err);
                showToast('সার্ভার যোগাযোগে সমস্যা হয়েছে।', 'error');
            } finally {
                hideTopLoader();
                btn.prop('disabled', false).removeClass('opacity-70');
            }
        }

        // ==========================================
        // HERO CAROUSEL BANNER UPLOAD (MAX 5, HIGH QUALITY, NO 200KB LIMIT)
        // ==========================================
        function getStoreBannersList() {
            if (!storeData) return [];
            if (Array.isArray(storeData.banners)) return storeData.banners;
            if (typeof storeData.banners === 'string') {
                try {
                    const parsed = JSON.parse(storeData.banners);
                    if (Array.isArray(parsed)) return parsed;
                } catch(e) {}
            }
            return [];
        }

        function resolveBannerFullUrl(relPath) {
            if (!relPath) return '';
            if (relPath.startsWith('http://') || relPath.startsWith('https://')) return relPath;
            return `${ASSET_URL}/${relPath.replace(/^\/+/, '')}`;
        }

        function renderUploadBannerTab() {
            const banners = getStoreBannersList();
            const count = banners.length;

            $('#badgeBannerCount').text(`${count}/5`);
            $('#lblBannerSlotStatus').text(`${count} / 5 ব্যানার আপলোডকৃত`);

            const $grid = $('#uploadedBannersGrid');
            if (!$grid.length) return;
            $grid.empty();

            if (count >= 5) {
                $('#bannerUploadDropzone').addClass('opacity-50 pointer-events-none');
                $('#bannerUploadPromptText').text('সর্বোচ্চ ৫টি ব্যানার পূর্ণ হয়েছে। নতুন ব্যানার যোগ করতে নিচের যেকোনো একটি মুছুন।');
            } else {
                $('#bannerUploadDropzone').removeClass('opacity-50 pointer-events-none');
                $('#bannerUploadPromptText').text(`ব্যানার ছবি আপলোড করতে এখানে ক্লিক করুন (আরও ${5 - count} টি যোগ করা যাবে)`);
            }

            if (count === 0) {
                $grid.html(`
                    <div class="col-span-full py-10 text-center text-slate-400 space-y-2 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <i data-lucide="image" class="w-8 h-8 mx-auto text-slate-300"></i>
                        <div class="text-xs font-bold text-slate-600">কোনো কাস্টম ব্যানার এখনও আপলোড করা হয়নি</div>
                        <div class="text-[11px] text-slate-400">উপরের বক্সে ক্লিক করে সর্বোচ্চ ৫টি হাই-কোয়ালিটি ব্যানার ছবি আপলোড করুন।</div>
                    </div>
                `);
                if (window.lucide) lucide.createIcons();
                return;
            }

            banners.forEach((relPath, idx) => {
                const fullUrl = resolveBannerFullUrl(relPath);
                $grid.append(`
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl overflow-hidden shadow-2xs group flex flex-col justify-between">
                        <div class="relative aspect-[21/9] bg-slate-900 overflow-hidden">
                            <img src="${fullUrl}" alt="Banner Slide #${idx + 1}" class="w-full h-full object-cover">
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-lg bg-black/70 backdrop-blur-xs text-white text-[11px] font-black">
                                    Slide #${idx + 1}
                                </span>
                            </div>
                        </div>
                        <div class="p-3 bg-white flex items-center justify-between">
                            <span class="text-[11px] font-mono text-slate-500 truncate max-w-[220px]">${relPath}</span>
                            <button type="button" onclick="deleteStoreBanner(${idx}, '${relPath.replace(/'/g, "\'")}')"
                                class="px-3 py-1.5 bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200 hover:border-rose-600 rounded-xl text-xs font-bold transition flex items-center space-x-1 cursor-pointer">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span>মুছুন</span>
                            </button>
                        </div>
                    </div>
                `);
            });

            if (window.lucide) lucide.createIcons();
        }

        async function handleBannerUploadSelection(event) {
            const files = Array.from(event.target.files || []);
            if (!files.length) return;

            const currentBanners = getStoreBannersList();
            if (currentBanners.length >= 5) {
                showToast('সর্বোচ্চ ৫টি ব্যানার আপলোড করা যাবে।', 'warning');
                event.target.value = '';
                return;
            }

            const remaining = 5 - currentBanners.length;
            const selectedFiles = files.slice(0, remaining);

            // Strict 5MB limit validation per file
            const maxBytes = 5 * 1024 * 1024;
            for (const f of selectedFiles) {
                if (f.size > maxBytes) {
                    showToast(`'${f.name}' ফাইলটির সাইজ ৫MB এর চেয়ে বড়। ৫MB এর চেয়ে ছোট ফাইল নির্বাচন করুন।`, 'error');
                    event.target.value = '';
                    return;
                }
            }

            showTopLoader();
            $('#bannerUploadPromptText').text('হাই-কোয়ালিটি ব্যানার আপলোড হচ্ছে... অনুগ্রহ করে অপেক্ষা করুন...');

            try {
                // Convert files to base64 to ensure 100% bypass of hosting ModSecurity / WAF multipart blocking
                const base64Promises = selectedFiles.map(file => {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.onload = () => resolve(reader.result);
                        reader.onerror = reject;
                        reader.readAsDataURL(file);
                    });
                });

                const bannersBase64 = await Promise.all(base64Promises);
                const res = await StoreApi.post(`tenants/${STORE_UUID}/banners`, {
                    banners_base64: bannersBase64
                });

                if (res && res.success && res.data) {
                    storeData = res.data;
                    renderUploadBannerTab();
                    showToast('হাই-কোয়ালিটি ব্যানার সফলভাবে আপলোড হয়েছে!', 'success');
                } else {
                    showToast((res && res.message) || 'ব্যানার আপলোড ব্যর্থ হয়েছে।', 'error');
                    renderUploadBannerTab();
                }
            } catch (err) {
                console.error('Banner upload error:', err);
                showToast('ব্যানার আপলোডে সমস্যা হয়েছে।', 'error');
                renderUploadBannerTab();
            } finally {
                hideTopLoader();
                event.target.value = '';
            }
        }

        async function deleteStoreBanner(index, bannerPath) {
            if (!confirm(`Slide #${index + 1} ব্যানারটি হোমপেজ ক্যারোসেল থেকে মুছে ফেলবেন?`)) {
                return;
            }

            showTopLoader();
            try {
                const res = await StoreApi.post(`tenants/${STORE_UUID}/banners/delete`, {
                    index: index,
                    banner_path: bannerPath
                });
                if (res && res.success && res.data) {
                    storeData = res.data;
                    renderUploadBannerTab();
                    showToast('ব্যানার মুছে ফেলা হয়েছে।', 'success');
                } else {
                    showToast((res && res.message) || 'ব্যানার মোছা সম্ভব হয়নি।', 'error');
                }
            } catch (err) {
                showToast('সার্ভার যোগাযোগে সমস্যা হয়েছে।', 'error');
            } finally {
                hideTopLoader();
            }
        }
</script>

    <!-- MODAL: ADD / EDIT DELIVERY CHARGE -->
    <div id="modalDeliveryCharge" class="fixed inset-0 z-[999999] hidden flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div onclick="closeDeliveryModal()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity cursor-pointer"></div>
        
        <!-- Modal Card -->
        <div class="relative bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-lg z-10 overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="truck" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900" id="modalDeliveryTitle">নতুন ডেলিভারি চার্জ যুক্ত করুন</h3>
                        <div class="text-[10px] text-slate-400">এলাকা ও ডেলিভারি ফি কনফিগার করুন</div>
                    </div>
                </div>
                <button type="button" onclick="closeDeliveryModal()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200/60 transition cursor-pointer">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="formDeliveryCharge" onsubmit="handleDeliverySubmit(event)" class="p-5 space-y-4">
                <input type="hidden" id="delInputUuid" value="">

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">জোনের নাম (Zone Title) *</label>
                    <input type="text" id="delInputTitle" required placeholder="যেমন: ঢাকার ভেতরে (Inside Dhaka)"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">ইউনিক কোড (Code)</label>
                        <input type="text" id="delInputCode" placeholder="inside_dhaka"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                        <span class="text-[10px] text-slate-400">খালি রাখলে স্বয়ংক্রিয় তৈরি হবে</span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">ডেলিভারি ফি (টাকা ৳) *</label>
                        <input type="number" id="delInputAmount" step="0.01" min="0" required placeholder="60.00"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono font-bold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">আনুমানিক সময় ও বিবরণ (Description)</label>
                    <input type="text" id="delInputDesc" placeholder="যেমন: হোম ডেলিভারি (২৪-৪৮ ঘণ্টা)"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">স্ট্যাটাস</label>
                        <select id="delInputStatus" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500 outline-none bg-white">
                            <option value="active">সক্রিয় (Active)</option>
                            <option value="inactive">নিষ্ক্রিয় (Inactive)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">ক্রম নম্বর (Sort Order)</label>
                        <input type="number" id="delInputSort" value="1" min="0"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:ring-2 focus:ring-emerald-500 outline-none">
                    </div>
                </div>

                <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center space-x-2.5">
                    <input type="checkbox" id="delInputDefault" class="rounded text-emerald-600 focus:ring-emerald-500 w-4 h-4 cursor-pointer">
                    <label for="delInputDefault" class="text-xs font-bold text-slate-700 cursor-pointer">
                        চেকআউট পেজে এটি ডিফল্ট হিসেবে সিলেক্ট থাকবে
                    </label>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                    <button type="button" onclick="closeDeliveryModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition cursor-pointer">
                        বাতিল
                    </button>
                    <button type="submit" id="btnSaveDelivery" class="px-5 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-extrabold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>সংরক্ষণ করুন</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
