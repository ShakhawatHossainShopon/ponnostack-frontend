                <!-- TAB 4: স্টক আউট প্রোডাক্টসমূহ (STOCK OUT VIEW) -->
                <section id="tabContentStockOut" class="space-y-6 hidden">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        <div class="p-4 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-rose-100 text-rose-600">
                                        <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                                    </span>
                                    <h2 class="text-base font-bold text-slate-900" data-i18n="stockOutTitle">স্টক আউট প্রোডাক্ট (Stock Out)</h2>
                                    <span id="stockOutHeaderCount" class="px-2.5 py-0.5 rounded-full text-xs font-black bg-rose-100 text-rose-700 border border-rose-200">০ টি</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-1" data-i18n="stockOutSubtitle">যেসব পণ্যের স্টক শেষ বা ০ হয়ে গেছে। এখান থেকে সরাসরি (+) বাটনে ক্লিক করে দ্রুত স্টক বাড়ান।</p>
                            </div>

                            <button type="button" onclick="loadProducts()" class="p-2 text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-xs cursor-pointer" title="রিফ্রেশ">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>

                        <!-- Search Bar for Stock Out Items -->
                        <div class="p-4 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                            <div class="relative w-full max-w-sm">
                                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                                <input type="text" id="stockOutSearchInput" placeholder="স্টক আউট প্রোডাক্ট খুঁজুন..."
                                    class="w-full pl-9 pr-4 py-1.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 shadow-xs">
                            </div>
                        </div>

                        <!-- Stock Out Small Grid -->
                        <div id="stockOutGridContainer" class="p-3 sm:p-5 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                            <!-- Populated dynamically via renderStockOutProducts() -->
                        </div>
                    </div>

                </section>
