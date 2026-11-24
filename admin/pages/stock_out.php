                <!-- TAB 4: স্টক আউট ও রিস্টক ম্যানেজমেন্ট (STOCK OUT & RESTOCK VIEW) -->
                <section id="tabContentStockOut" class="space-y-6 hidden">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        <!-- Top Header -->
                        <div class="p-4 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-xl bg-rose-100 text-rose-600 shadow-2xs">
                                        <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                                    </span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900" data-i18n="stockOutTitle">স্টক আউট ও রিস্টক ম্যানেজমেন্ট</h2>
                                    <span id="stockOutHeaderCount" class="px-2.5 py-0.5 rounded-full text-xs font-black bg-rose-100 text-rose-700 border border-rose-200">০ টি</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-1" data-i18n="stockOutSubtitle">যেসব পণ্যের সম্পূর্ণ স্টক শেষ বা নির্দিষ্ট সাইজ/রঙের স্টক ০ হয়েছে। এখান থেকেই সরাসরি সাইজ ও কালার অনুযায়ী স্টক বাড়ান।</p>
                            </div>

                            <button type="button" onclick="loadProducts()" class="p-2 sm:px-3 sm:py-2 text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-xs cursor-pointer flex items-center space-x-1.5 text-xs font-bold" title="রিফ্রেশ">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                <span class="hidden sm:inline">রিফ্রেশ</span>
                            </button>
                        </div>

                        <!-- Filter Tabs & Search Bar (Lightweight & Touch Friendly) -->
                        <div class="p-3 sm:p-4 bg-slate-50/70 border-b border-slate-200/80 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
                            <!-- Filter Pills -->
                            <div class="flex flex-wrap items-center gap-1.5 sm:gap-2" id="stockOutFilterPills">
                                <button type="button" onclick="setStockOutFilter('all')" id="soFilterBtn_all"
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-brand-600 text-white shadow-2xs cursor-pointer">
                                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                                    <span>সকল স্টক আউট</span>
                                    <span id="soFilterCountAll" class="px-1.5 py-0.2 rounded-full text-[10px] bg-white/20 text-white font-black">০</span>
                                </button>

                                <button type="button" onclick="setStockOutFilter('full')" id="soFilterBtn_full"
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer">
                                    <span class="w-2 h-2 rounded-full bg-rose-500 inline-block"></span>
                                    <span>সম্পূর্ণ স্টক শেষ</span>
                                    <span id="soFilterCountFull" class="px-1.5 py-0.2 rounded-full text-[10px] bg-rose-50 text-rose-700 font-bold border border-rose-200">০</span>
                                </button>

                                <button type="button" onclick="setStockOutFilter('partial')" id="soFilterBtn_partial"
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 inline-block"></span>
                                    <span>সাইজ / ভ্যারিয়েন্ট স্টক শেষ</span>
                                    <span id="soFilterCountPartial" class="px-1.5 py-0.2 rounded-full text-[10px] bg-amber-50 text-amber-800 font-bold border border-amber-200">০</span>
                                </button>
                            </div>

                            <!-- Search Input -->
                            <div class="relative w-full md:w-72 shrink-0">
                                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                                <input type="text" id="stockOutSearchInput" placeholder="পণ্য বা সাইজের নাম দিয়ে খুঁজুন..."
                                    class="w-full pl-9 pr-4 py-1.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 shadow-2xs">
                            </div>
                        </div>

                        <!-- Stock Out Cards Grid (Clean, Responsive 1 to 2 Columns for comfortable size control) -->
                        <div id="stockOutGridContainer" class="p-3 sm:p-5 grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5">
                            <!-- Populated dynamically via renderStockOutProducts() -->
                        </div>
                    </div>

                </section>
