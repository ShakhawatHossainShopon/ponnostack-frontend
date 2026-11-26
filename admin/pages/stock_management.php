                <!-- TAB: সামগ্রিক স্টক ম্যানেজমেন্ট (UNIVERSAL STOCK MANAGEMENT VIEW) -->
                <section id="tabContentStockManagement" class="space-y-6 hidden">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        <!-- Top Header -->
                        <div class="p-4 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-xl bg-indigo-100 text-indigo-700 shadow-2xs">
                                        <i data-lucide="boxes" class="w-4 h-4"></i>
                                    </span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900">স্টক ম্যানেজমেন্ট (Stock Management)</h2>
                                    <span id="stockManagementHeaderCount" class="px-2.5 py-0.5 rounded-full text-xs font-black bg-indigo-50 text-indigo-700 border border-indigo-200">০ টি পণ্য</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">আপনার স্টোরের সকল পণ্যের মূল স্টক এবং সাইজ, ভ্যারিয়েন্ট ও রঙ অনুযায়ী আলাদা আলাদা স্টক এখান থেকেই বাড়াতে বা কমাতে পারেন।</p>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="loadProducts()" class="p-2 sm:px-3 sm:py-2 text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-xs cursor-pointer flex items-center space-x-1.5 text-xs font-bold" title="রিফ্রেশ">
                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                    <span class="hidden sm:inline">রিফ্রেশ</span>
                                </button>
                            </div>
                        </div>

                        <!-- Filter Tabs & Search Bar (Mobile Touch & Swipe Optimized) -->
                        <div class="p-3 sm:p-4 bg-slate-50/70 border-b border-slate-200/80 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
                            <!-- Filter Pills: Horizontal scrollable on mobile, wrap on desktop -->
                            <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto pb-1.5 sm:pb-0 sm:flex-wrap scrollbar-none" id="stockManagementFilterPills">
                                <button type="button" onclick="setStockManagementFilter('all')" id="smFilterBtn_all"
                                    class="px-2.5 sm:px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-brand-600 text-white shadow-2xs border border-transparent cursor-pointer shrink-0">
                                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                                    <span>সকল পণ্য</span>
                                    <span id="smFilterCountAll" class="px-1.5 py-0.5 rounded-full text-[10px] bg-white/25 text-white font-black">০</span>
                                </button>

                                <button type="button" onclick="setStockManagementFilter('inStock')" id="smFilterBtn_inStock"
                                    class="px-2.5 sm:px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer shrink-0">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span>
                                    <span>স্টকে আছে (>০)</span>
                                    <span id="smFilterCountInStock" class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-50 text-emerald-700 font-bold border border-emerald-200">০</span>
                                </button>

                                <button type="button" onclick="setStockManagementFilter('outStock')" id="smFilterBtn_outStock"
                                    class="px-2.5 sm:px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer shrink-0">
                                    <span class="w-2 h-2 rounded-full bg-rose-500 inline-block"></span>
                                    <span>স্টক শেষ (০)</span>
                                    <span id="smFilterCountOutStock" class="px-1.5 py-0.5 rounded-full text-[10px] bg-rose-50 text-rose-700 font-bold border border-rose-200">০</span>
                                </button>

                                <button type="button" onclick="setStockManagementFilter('hasVariants')" id="smFilterBtn_hasVariants"
                                    class="px-2.5 sm:px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer shrink-0">
                                    <i data-lucide="shirt" class="w-3.5 h-3.5 text-indigo-500"></i>
                                    <span>সাইজ/ভ্যারিয়েন্টযুক্ত</span>
                                    <span id="smFilterCountHasVariants" class="px-1.5 py-0.5 rounded-full text-[10px] bg-indigo-50 text-indigo-700 font-bold border border-indigo-200">০</span>
                                </button>
                            </div>

                            <!-- Search Input -->
                            <div class="relative w-full md:w-72 shrink-0">
                                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-3 sm:top-2.5"></i>
                                <input type="text" id="stockManagementSearchInput" placeholder="পণ্য বা সাইজের নাম দিয়ে খুঁজুন..."
                                    class="w-full pl-9 pr-4 py-2 sm:py-1.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 shadow-2xs">
                            </div>
                        </div>

                        <!-- Product Cards Grid (1 Col Mobile, 2 Col Desktop) -->
                        <div id="stockManagementGridContainer" class="p-2.5 sm:p-5 grid grid-cols-1 lg:grid-cols-2 gap-3.5 sm:gap-5">
                            <!-- Populated dynamically via renderStockManagementProducts() -->
                        </div>

                        <!-- Pagination Footer Bar (Responsive & Lightweight) -->
                        <div id="stockManagementPagination" class="p-3.5 sm:p-4 bg-slate-50/80 border-t border-slate-200/90 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                            <div class="text-slate-500 font-medium text-center sm:text-left">
                                দেখানো হচ্ছে <span id="smPaginationSummary" class="font-bold text-slate-800">০ থেকে ০ (মোট ০টি পণ্য)</span>
                            </div>

                            <div class="flex flex-wrap items-center justify-center gap-2">
                                <!-- Per Page Dropdown -->
                                <div class="flex items-center space-x-1.5 text-slate-500 text-xs font-semibold mr-1">
                                    <span>প্রতি পেজে:</span>
                                    <select id="smPerPageSelect" onchange="changeStockManagementPerPage(this.value)"
                                        class="bg-white border border-slate-300 rounded-lg px-2 py-1 text-xs font-bold text-slate-800 focus:outline-none focus:border-brand-600 shadow-2xs cursor-pointer">
                                        <option value="6" selected>৬ টি</option>
                                        <option value="10">১০ টি</option>
                                        <option value="20">২০ টি</option>
                                        <option value="all">সকল পণ্য</option>
                                    </select>
                                </div>

                                <!-- Pagination Button Group -->
                                <div id="smPaginationButtons" class="flex items-center space-x-1">
                                    <!-- Populated dynamically via renderStockManagementPagination() -->
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
