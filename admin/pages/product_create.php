<!-- TAB: ডেডিকেটেড ৩-স্টেপ প্রোডাক্ট তৈরি ও সম্পাদনা পেজ (DEDICATED 3-STEP PRODUCT WIZARD) -->
<section id="tabContentProductCreate" class="space-y-4 hidden">

    <!-- Top Navigation Header -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center space-x-3">
            <button type="button" onclick="cancelProductForm()"
                class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition cursor-pointer"
                title="প্রোডাক্ট তালিকায় ফিরে যান">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </button>
            <div>
                <h2 class="text-base font-bold text-slate-900" id="productPageTitle">নতুন প্রোডাক্ট যোগ করুন</h2>
                <p class="text-xs text-slate-500">৩টি সহজ ধাপে আপনার পণ্যের তথ্য, মূল্য, স্টক ও ছবি যুক্ত করুন।</p>
            </div>
        </div>
        <div class="flex items-center space-x-2 self-end sm:self-auto">
            <span class="text-xs font-semibold text-slate-400">ধাপ:</span>
            <span id="stepNumberBadge" class="px-2.5 py-1 bg-brand-50 text-brand-700 border border-brand-200 rounded-lg text-xs font-bold">
                ১ / ৩
            </span>
        </div>
    </div>

    <!-- Package Limit Remaining Counter Banner -->
    <div id="productCreateLimitNotice" class="bg-amber-50/80 border border-amber-200/90 rounded-2xl p-3 px-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2 shadow-2xs">
        <div class="flex items-center space-x-2 text-xs text-amber-900 font-medium">
            <i data-lucide="package-check" class="w-4 h-4 text-amber-600 shrink-0"></i>
            <span>প্যাকেজ কোটা: <strong id="createLimitPackageName" class="font-bold text-amber-950">স্ট্যান্ডার্ড প্যাকেজ</strong></span>
        </div>
        <div class="flex items-center space-x-3 text-xs">
            <span class="text-amber-800">ব্যবহৃত: <strong id="createLimitUsedCount" class="font-bold text-slate-800 font-mono">০</strong>/<strong id="createLimitTotalMax" class="font-bold text-slate-800 font-mono">৫০</strong></span>
            <span class="px-2.5 py-0.5 rounded-lg text-xs font-black bg-amber-500 text-white shadow-2xs" id="createLimitRemainingBadge">
                আর বাকি আছে: ৪৮ টি
            </span>
        </div>
    </div>

    <!-- 3-Step Wizard Navigation Pills (Mobile First, Compact) -->
    <div class="grid grid-cols-3 gap-2 bg-white border border-slate-200 rounded-2xl p-2 shadow-xs select-none">
        <button type="button" onclick="goToStep(1)" id="wizardStepBtn1"
            class="flex items-center justify-center space-x-1.5 py-2 px-2 rounded-xl text-xs font-bold transition text-brand-600 bg-brand-50 border border-brand-200/60 shadow-2xs">
            <i data-lucide="info" class="w-3.5 h-3.5"></i>
            <span class="truncate">১. মৌলিক তথ্য</span>
        </button>
        <button type="button" onclick="goToStep(2)" id="wizardStepBtn2"
            class="flex items-center justify-center space-x-1.5 py-2 px-2 rounded-xl text-xs font-bold transition text-slate-500 hover:text-slate-800 hover:bg-slate-50">
            <i data-lucide="boxes" class="w-3.5 h-3.5"></i>
            <span class="truncate">২. মূল্য ও স্টক</span>
        </button>
        <button type="button" onclick="goToStep(3)" id="wizardStepBtn3"
            class="flex items-center justify-center space-x-1.5 py-2 px-2 rounded-xl text-xs font-bold transition text-slate-500 hover:text-slate-800 hover:bg-slate-50">
            <i data-lucide="image" class="w-3.5 h-3.5"></i>
            <span class="truncate">৩. ছবি ও প্রকাশ</span>
        </button>
    </div>

    <!-- Main Wizard Form Container -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
        <form id="productForm" class="p-4 sm:p-6" onsubmit="event.preventDefault();">
            <input type="hidden" id="prodEditUuid" value="">

            <!-- ======================================================== -->
            <!-- STEP 1: মৌলিক তথ্য ও ক্যাটাগরি (BASIC INFO & CATEGORY)     -->
            <!-- ======================================================== -->
            <div id="stepSection1" class="space-y-4">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-1.5">
                        <i data-lucide="file-text" class="w-4 h-4 text-brand-600"></i>
                        <span>পণ্যের সাধারণ পরিচিতি ও ক্যাটাগরি</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">পণ্যের সঠিক নাম ও ক্যাটাগরি নির্বাচন করুন।</p>
                </div>

                <!-- Product Name & Real-time Auto-Slug -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">
                        প্রোডাক্টের নাম (Product Name) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="fProdName" required placeholder="যেমন: ক্লাসিক কটন পোলো শার্ট"
                        class="w-full px-3 py-2.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 shadow-xs"
                        oninput="autoSlugFromName(this.value)">
                    <input type="hidden" id="fProdSlug" value="">
                    <div class="text-[11px] text-slate-500 flex items-center space-x-1.5 mt-1.5">
                        <i data-lucide="link" class="w-3.5 h-3.5 text-slate-400 shrink-0"></i>
                        <span>ওয়েব লিংক (URL):</span>
                        <span id="previewSlugUrl" class="font-mono text-brand-600 font-semibold truncate">-</span>
                    </div>
                </div>

                <!-- Category Selection & Quick Add Link -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold text-slate-700">
                            ক্যাটাগরি (Category) <span class="text-rose-500">*</span>
                        </label>
                        <button type="button" onclick="openCreateCategoryModal()" class="text-[11px] font-bold text-brand-600 hover:text-brand-700 flex items-center space-x-1">
                            <i data-lucide="plus-circle" class="w-3 h-3"></i>
                            <span>নতুন ক্যাটাগরি তৈরি করুন</span>
                        </button>
                    </div>
                    <select id="fProdCategory" required
                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 shadow-xs">
                        <option value="">ক্যাটাগরি লোড হচ্ছে...</option>
                    </select>
                    <p class="text-[10px] text-slate-400 mt-1">ক্যাটাগরি সিলেক্ট না করলে এটি স্বয়ংক্রিয়ভাবে ডিফল্ট "Unnamed" ক্যাটাগরিতে যুক্ত হবে।</p>
                </div>

                <!-- Product Description -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">
                        পণ্যের বিবরণ (Description)
                    </label>
                    <textarea id="fDescription" rows="3" placeholder="পণ্যের ম্যাটেরিয়াল, সাইজ চার্ট, বৈশিষ্ট্য ও বিস্তারিত বিবরণ..."
                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 shadow-xs"></textarea>
                </div>

                <!-- Step 1 Actions -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                    <button type="button" onclick="goToStep(2)"
                        class="w-full sm:w-auto px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center justify-center space-x-1.5 cursor-pointer">
                        <span>পরবর্তী ধাপ: মূল্য ও স্টক</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- STEP 2: মূল্য, স্টক ও ভ্যারিয়েন্ট (PRICING & VARIANTS)      -->
            <!-- ======================================================== -->
            <div id="stepSection2" class="space-y-4 hidden">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-1.5">
                        <i data-lucide="calculator" class="w-4 h-4 text-brand-600"></i>
                        <span>মূল্য নির্ধারণ, স্টক ও ভ্যারিয়েন্ট</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">কেনা দাম, বিক্রয় মূল্য এবং প্রয়োজন অনুযায়ী সাইজ বা রঙের আলাদা স্টক সেট করুন।</p>
                </div>

                <!-- 1. Ultra-Compact Pricing & Profit Calculator Row -->
                <div class="bg-slate-50/80 border border-slate-200 rounded-xl p-3 sm:p-3">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-2.5 items-end">
                        <div>
                            <label class="block text-xs sm:text-[11px] font-semibold text-slate-700 mb-1">
                                কেনা দাম (Cost Price) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 sm:pl-2.5 flex items-center pointer-events-none text-slate-400 font-bold text-xs">৳</span>
                                <input type="number" id="fMainPrice" required step="0.01" min="0" placeholder="650.00"
                                    class="w-full pl-7 sm:pl-6 pr-3 sm:pr-2 py-2 sm:py-1.5 bg-white border border-slate-300 rounded-xl sm:rounded-lg text-xs text-slate-900 font-bold focus:outline-none focus:border-brand-600 shadow-2xs"
                                    oninput="calculateProfitPreview()">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs sm:text-[11px] font-semibold text-slate-700 mb-1">
                                বিক্রয় মূল্য (Selling Price) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 sm:pl-2.5 flex items-center pointer-events-none text-slate-400 font-bold text-xs">৳</span>
                                <input type="number" id="fRetailerPrice" required step="0.01" min="0" placeholder="1250.00"
                                    class="w-full pl-7 sm:pl-6 pr-3 sm:pr-2 py-2 sm:py-1.5 bg-white border border-slate-300 rounded-xl sm:rounded-lg text-xs text-slate-900 font-bold focus:outline-none focus:border-brand-600 shadow-2xs"
                                    oninput="calculateProfitPreview()">
                            </div>
                        </div>

                        <!-- Live Profit Calculation Display Badge -->
                        <div class="flex items-center justify-between sm:justify-center space-x-1.5 bg-emerald-50 border border-emerald-200/90 rounded-xl sm:rounded-lg px-3 py-2 sm:px-2.5 sm:py-1.5 text-xs h-[38px] sm:h-[32px]">
                            <div class="flex items-center space-x-1.5 sm:space-x-1 text-emerald-800 font-bold text-xs sm:text-[11px]">
                                <i data-lucide="trending-up" class="w-4 h-4 sm:w-3.5 sm:h-3.5 text-emerald-600"></i>
                                <span>লাভ:</span>
                                <span id="previewProfitVal" class="text-xs font-black text-emerald-700">৳০.০০</span>
                            </div>
                            <span id="previewProfitMargin" class="text-xs sm:text-[10px] font-bold text-emerald-700 bg-emerald-100/70 px-2 sm:px-1.5 py-0.5 rounded-md sm:rounded">০%</span>
                        </div>
                    </div>
                </div>

                <!-- Hidden Input for Auto-Calculated Total Stock (Counted from variants) -->
                <input type="hidden" id="fStock" value="0">

                <!-- 2. Integrated Responsive Size & Variant System -->
                <div id="variantSectionContainer" class="border border-slate-200 rounded-xl bg-white p-3 sm:p-2.5 space-y-3 sm:space-y-2.5">
                    <!-- Header with Total Stock Badge & Mode Selector -->
                    <div class="flex flex-wrap items-center justify-between gap-2 pb-2.5 sm:pb-2 border-b border-slate-100">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-bold text-slate-800">সাইজ / ভ্যারিয়েন্ট:</span>
                            <div class="inline-flex rounded-xl sm:rounded-lg border border-slate-200 bg-slate-50 p-1 sm:p-0.5 text-xs sm:text-[11px] font-bold">
                                <button type="button" id="btnModeSize" onclick="setVariantMode('size')"
                                    class="px-3 py-1.5 sm:px-2 sm:py-0.5 rounded-lg sm:rounded-md transition text-brand-600 bg-white shadow-2xs">
                                    👕 সাইজ (Size)
                                </button>
                                <button type="button" id="btnModeVariant" onclick="setVariantMode('variant')"
                                    class="px-3 py-1.5 sm:px-2 sm:py-0.5 rounded-lg sm:rounded-md transition text-slate-600 hover:text-slate-900">
                                    🏷️ ভ্যারিয়েন্ট
                                </button>
                            </div>
                        </div>

                        <!-- Compact Total Stock Badge Display -->
                        <div class="flex items-center space-x-1.5">
                            <span class="text-xs sm:text-[11px] text-slate-500 font-semibold">মোট স্টক:</span>
                            <span id="displayTotalStockBadge" class="px-3 py-1 sm:px-2.5 sm:py-0.5 bg-brand-600 text-white font-black text-xs rounded-lg sm:rounded-md shadow-2xs">
                                ০ টি
                            </span>
                        </div>
                    </div>

                    <!-- 1. Size Mode Quick Presets -->
                    <div id="boxSizeMode" class="flex flex-wrap items-center gap-1.5 sm:gap-1.5">
                        <span class="text-xs sm:text-[10px] text-slate-400 font-medium w-full sm:w-auto mb-0.5 sm:mb-0">কুইক সাইজ:</span>
                        <button type="button" onclick="addVariantItem('S')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 border border-slate-200 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs active:scale-95">+S</button>
                        <button type="button" onclick="addVariantItem('M')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 border border-slate-200 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs active:scale-95">+M</button>
                        <button type="button" onclick="addVariantItem('L')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 border border-slate-200 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs active:scale-95">+L</button>
                        <button type="button" onclick="addVariantItem('XL')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 border border-slate-200 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs active:scale-95">+XL</button>
                        <button type="button" onclick="addVariantItem('XXL')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 border border-slate-200 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs active:scale-95">+XXL</button>
                        <button type="button" onclick="addVariantItem('Free Size')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-slate-50 hover:bg-brand-50 hover:text-brand-600 border border-slate-200 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs active:scale-95">+Free Size</button>
                        
                        <div class="flex items-center space-x-1.5 w-full sm:w-auto mt-1 sm:mt-0 sm:ml-auto">
                            <input type="text" id="inputCustomSize" placeholder="অন্য সাইজ (38, 40)"
                                class="px-3 py-1.5 sm:py-0.5 bg-white border border-slate-300 rounded-lg sm:rounded text-xs flex-1 sm:w-32 focus:outline-none focus:border-brand-600 shadow-2xs"
                                onkeydown="if(event.key==='Enter'){event.preventDefault(); addCustomVariant('size');}">
                            <button type="button" onclick="addCustomVariant('size')" title="যুক্ত করুন" class="w-8 h-8 sm:w-7 sm:h-7 sm:px-2 sm:py-1 bg-slate-900 text-white rounded-lg sm:rounded text-xs font-bold hover:bg-slate-800 transition flex items-center justify-center shrink-0 active:scale-95">
                                <i data-lucide="plus" class="w-4 h-4 sm:w-3.5 sm:h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- 2. Variant Mode Input (Direct Custom Input, No Quick Presets) -->
                    <div id="boxVariantMode" class="hidden flex items-center space-x-1.5 w-full">
                        <input type="text" id="inputCustomVariant" placeholder="ভ্যারিয়েন্টের নাম লিখুন (যেমন: 128GB বা 500ml)"
                            class="px-3 py-1.5 sm:py-1 bg-white border border-slate-300 rounded-lg text-xs flex-1 max-w-sm focus:outline-none focus:border-brand-600 shadow-2xs"
                            onkeydown="if(event.key==='Enter'){event.preventDefault(); addCustomVariant('variant');}">
                        <button type="button" onclick="addCustomVariant('variant')" title="যুক্ত করুন" class="w-8 h-8 sm:w-7 sm:h-7 bg-brand-600 text-white rounded-lg text-xs font-bold hover:bg-brand-700 transition flex items-center justify-center shrink-0 active:scale-95 shadow-2xs">
                            <i data-lucide="plus" class="w-4 h-4 sm:w-3.5 sm:h-3.5"></i>
                        </button>
                    </div>

                    <!-- Active Selected Sizes / Variants Table -->
                    <div>
                        <div class="text-[11px] font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                            <span id="variantListHeading">সাইজ তালিকা ও স্টক সংখ্যা:</span>
                            <span id="variantCountLabel" class="text-[10px] text-slate-400 font-normal">০টি যুক্ত</span>
                        </div>

                        <div id="variantItemsList" class="space-y-1.5 sm:space-y-1 max-h-56 sm:max-h-48 overflow-y-auto pr-0.5">
                            <div class="text-center py-3 text-xs text-slate-400 bg-white border border-dashed border-slate-200 rounded-lg" id="emptyVariantNotice">
                                কোনো সাইজ বা ভ্যারিয়েন্ট এখনো যুক্ত করা হয়নি।
                            </div>
                        </div>
                    </div>

                    <!-- Color Options Section (Universal) -->
                    <div class="pt-2.5 sm:pt-2 border-t border-slate-100">
                        <div class="flex items-center justify-between mb-2 sm:mb-1.5">
                            <div class="flex items-center space-x-1.5">
                                <span class="text-xs font-bold text-slate-800">রঙ (Color Options - ঐচ্ছিক)</span>
                                <span class="text-[10px] text-slate-400 font-normal hidden sm:inline">(রং দিলে মোট স্টকের সমান হতে হবে)</span>
                            </div>
                            <div id="colorStockSyncBadge" class="hidden text-[10px] font-bold px-2 py-0.5 rounded border"></div>
                        </div>

                        <div class="flex flex-wrap items-center gap-1.5 mb-2 sm:mb-1.5" id="quickColorButtons">
                            <button type="button" onclick="addColorItem('Black')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs flex items-center space-x-1.5 sm:space-x-1 active:scale-95">
                                <span class="w-2.5 h-2.5 sm:w-2 sm:h-2 rounded-full bg-black inline-block"></span>
                                <span>Black</span>
                            </button>
                            <button type="button" onclick="addColorItem('White')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs flex items-center space-x-1.5 sm:space-x-1 active:scale-95">
                                <span class="w-2.5 h-2.5 sm:w-2 sm:h-2 rounded-full bg-slate-300 inline-block border"></span>
                                <span>White</span>
                            </button>
                            <button type="button" onclick="addColorItem('Navy')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs flex items-center space-x-1.5 sm:space-x-1 active:scale-95">
                                <span class="w-2.5 h-2.5 sm:w-2 sm:h-2 rounded-full bg-blue-900 inline-block"></span>
                                <span>Navy</span>
                            </button>
                            <button type="button" onclick="addColorItem('Red')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs flex items-center space-x-1.5 sm:space-x-1 active:scale-95">
                                <span class="w-2.5 h-2.5 sm:w-2 sm:h-2 rounded-full bg-red-600 inline-block"></span>
                                <span>Red</span>
                            </button>
                            <button type="button" onclick="addColorItem('Gray')" class="px-3 py-1.5 sm:px-2 sm:py-0.5 bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-lg sm:rounded text-xs font-bold transition shadow-2xs flex items-center space-x-1.5 sm:space-x-1 active:scale-95">
                                <span class="w-2.5 h-2.5 sm:w-2 sm:h-2 rounded-full bg-gray-500 inline-block"></span>
                                <span>Gray</span>
                            </button>

                            <div class="flex items-center space-x-1.5 w-full sm:w-auto mt-1 sm:mt-0 sm:ml-auto">
                                <input type="text" id="inputCustomColor" placeholder="অন্য রং (যেমন: Olive)"
                                    class="px-3 py-1.5 sm:py-0.5 bg-white border border-slate-300 rounded-lg sm:rounded text-xs flex-1 sm:w-28 focus:outline-none focus:border-brand-600 shadow-2xs"
                                    onkeydown="if(event.key==='Enter'){event.preventDefault(); addCustomColor();}">
                                <button type="button" onclick="addCustomColor()" title="যুক্ত করুন" class="w-8 h-8 sm:w-7 sm:h-7 sm:px-2 sm:py-1 bg-slate-900 hover:bg-slate-800 text-white rounded-lg sm:rounded text-xs font-bold transition flex items-center justify-center shrink-0 active:scale-95">
                                    <i data-lucide="plus" class="w-4 h-4 sm:w-3.5 sm:h-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <div id="colorItemsList" class="space-y-1.5 sm:space-y-1 max-h-40 sm:max-h-36 overflow-y-auto pr-0.5">
                            <!-- Populated dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for backward compatibility -->
                <input type="hidden" id="fSizes" value="">
                <input type="hidden" id="fColors" value="">

                <!-- Step 2 Actions -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    <button type="button" onclick="goToStep(1)"
                        class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition shadow-2xs flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>আগের ধাপ</span>
                    </button>
                    <button type="button" onclick="goToStep(3)"
                        class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                        <span>পরবর্তী ধাপ: ছবি ও প্রকাশ</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- STEP 3: ছবি আপলোড ও প্রকাশ (MEDIA & PUBLISH)              -->
            <!-- ======================================================== -->
            <div id="stepSection3" class="space-y-4 hidden">
                <div class="border-b border-slate-100 pb-2">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-1.5">
                        <i data-lucide="image" class="w-4 h-4 text-brand-600"></i>
                        <span>প্রোডাক্টের ছবি ও প্রকাশনা</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">আকর্ষণীয় ছবি আপলোড করুন এবং তথ্য যাচাই করে প্রোডাক্টটি প্রকাশ করুন।</p>
                </div>

                <!-- Multi-Image Upload (Auto-compressed to ~200KB, Max 5 Images) -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-slate-900 flex items-center space-x-1">
                            <span>প্রোডাক্টের ছবিসমূহ (সর্বোচ্চ ৫টি ছবি)</span>
                            <span class="text-rose-500 font-black">*</span>
                        </label>
                        <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                            ⚡ স্বয়ংক্রিয় ২০০KB অপটিমাইজেশন
                        </span>
                    </div>

                    <!-- Limit Reached Notice (Hidden until 5 images) -->
                    <div id="imageLimitReachedBadge" class="hidden p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-center text-xs font-bold text-emerald-800 flex items-center justify-center space-x-2">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                        <span>সর্বোচ্চ ৫টি ছবি যুক্ত করা হয়েছে (ছবির সীমা পূর্ণ)। কোনো ছবি পরিবর্তন করতে নিচের প্রিভিউ থেকে মুছুন।</span>
                    </div>

                    <!-- File input & Dropzone -->
                    <label for="fImagesInput" id="imageDropzone"
                        class="border-2 border-dashed border-slate-300 hover:border-brand-500 hover:bg-brand-50/20 rounded-xl p-5 text-center cursor-pointer transition bg-slate-50/50 block group select-none">
                        <input type="file" id="fImagesInput" multiple accept="image/png,image/jpeg,image/webp,image/gif" class="sr-only" onchange="handleImageSelection(event)">
                        <div class="flex flex-col items-center justify-center pointer-events-none">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>
                            <div class="text-xs font-bold text-slate-800">ছবি আপলোড করতে ক্লিক করুন (বা ড্র্যাগ করুন)</div>
                            <div class="text-[10px] text-slate-500 mt-0.5">PNG, JPG, WebP ইত্যাদি (স্বয়ংক্রিয়ভাবে ২০০KB-তে অপটিমাইজ হবে)</div>
                            <div class="mt-2.5 inline-flex items-center space-x-1.5 px-3 py-1 bg-white border border-slate-200 rounded-lg text-xs font-semibold text-brand-600 shadow-2xs group-hover:border-brand-300">
                                <i data-lucide="folder-open" class="w-3.5 h-3.5"></i>
                                <span>গ্যালারি বা ক্যামেরা থেকে ছবি বাছুন</span>
                            </div>
                        </div>
                    </label>

                    <!-- Validation Error Message -->
                    <div id="imageValidationError" class="hidden mt-2 p-2.5 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold flex items-center space-x-2">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 shrink-0"></i>
                        <span>কমপক্ষে একটি প্রোডাক্টের ছবি আপলোড করা আবশ্যক। ছবি ছাড়া পণ্য সংরক্ষণ করা যাবে না।</span>
                    </div>

                    <!-- Live Image Previews Container -->
                    <div id="imagePreviewGrid" class="grid grid-cols-3 sm:grid-cols-5 gap-2 mt-3">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- Status Selector & Summary Review Card -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">প্রোডাক্ট স্ট্যাটাস</label>
                        <select id="fStatus"
                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 font-semibold focus:outline-none focus:border-brand-600 shadow-xs">
                            <option value="active">সক্রিয় (Active - স্টোরফ্রন্টে প্রদর্শন করবে)</option>
                            <option value="inactive">ড্রাফট / নিষ্ক্রিয় (Draft - লুকানো থাকবে)</option>
                        </select>
                    </div>

                    <!-- Summary Recap Badge -->
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 flex flex-col justify-center">
                        <div class="text-[11px] font-bold text-slate-500 mb-1">এক নজরে সারসংক্ষেপ:</div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-600 font-medium">বিক্রয় মূল্য: <strong id="sumRetailPrice" class="text-slate-900">৳০.০০</strong></span>
                            <span class="text-emerald-700 font-bold">লাভ: <span id="sumProfit">৳০.০০</span></span>
                            <span class="text-brand-700 font-bold">স্টক: <span id="sumStock">০</span> টি</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3 Actions (Save & Publish) -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                    <button type="button" onclick="goToStep(2)"
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition shadow-2xs flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>আগের ধাপ</span>
                    </button>
                    <button type="button" onclick="submitProductWizard()" id="btnSaveProduct"
                        class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-2 cursor-pointer">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        <span id="btnSaveProductText">প্রোডাক্ট সংরক্ষণ ও প্রকাশ করুন</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

</section>
