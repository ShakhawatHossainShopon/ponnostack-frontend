                <!-- TAB: স্পেশাল ডিসকাউন্ট ও অফার (DISCOUNTS VIEW) -->
                <section id="tabContentDiscounts" class="space-y-6 hidden">
                    <!-- Stat Summary Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                                <i data-lucide="percent" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">সক্রিয় অফার</span>
                                <span id="statActiveDiscounts" class="text-xl font-black text-slate-900 font-mono">0 টি</span>
                            </div>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                                <i data-lucide="flame" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">সর্বোচ্চ ছাড়</span>
                                <span id="statMaxDiscount" class="text-xl font-black text-red-600 font-mono">0%</span>
                            </div>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <i data-lucide="sparkles" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">ডিসকাউন্ট পেইজ</span>
                                <a href="../discount" target="_blank" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center space-x-1 mt-0.5">
                                    <span>লাইভ প্রিভিউ দেখুন</span>
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Active Discount Products List -->
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-orange-100 text-orange-700">
                                        <i data-lucide="percent" class="w-4 h-4"></i>
                                    </span>
                                    <h2 class="text-base font-bold text-slate-900">স্পেশাল ডিসকাউন্ট ও অফার ব্যবস্থাপনা</h2>
                                </div>
                                <p class="text-xs text-slate-500 mt-1">যেকোনো পণ্যে ডিসকাউন্ট পারসেন্ট ও মেয়াদ নির্ধারণ করুন। স্বয়ংক্রিয়ভাবে ডিসকাউন্ট পেইজ ও চেকআউটে প্রযোজ্য হবে।</p>
                            </div>

                            <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                                <button type="button" onclick="openSetDiscountModal()" class="px-4 py-2 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                    <span>নতুন ডিসকাউন্ট চালু করুন</span>
                                </button>
                            </div>
                        </div>

                        <div id="discountsListContainer" class="p-4 sm:p-5">
                            <!-- Populated dynamically via JS -->
                            <div class="py-12 text-center text-slate-400 text-xs">লোড হচ্ছে...</div>
                        </div>

                        <!-- Discounts Pagination -->
                        <div id="discountsPagination" class="hidden p-4 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div id="discountsPaginationSummary" class="text-xs font-medium text-slate-500 text-center sm:text-left"></div>
                            <div id="discountsPaginationButtons" class="flex items-center gap-1.5 flex-wrap justify-center"></div>
                        </div>
                    </div>
                </section>
