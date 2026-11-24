                <!-- TAB 2: প্রোডাক্টস ও ইনভেন্টরি ম্যানেজমেন্ট (PRODUCTS & STOCK) -->
                <section id="tabContentProducts" class="space-y-6 hidden">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        
                        <!-- Header & Actions Toolbar -->
                        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center space-x-2.5">
                                    <h2 class="text-base font-bold text-slate-900" data-i18n="productsTitle">প্রোডাক্ট ও ইনভেন্টরি স্টক</h2>
                                    <div id="productLimitBadge"></div>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5" data-i18n="productsSubtitle">নতুন প্রোডাক্ট আপলোড করুন, ২০০KB কম্প্রেসড ইমেজ সংরক্ষণ করুন এবং ইনভেন্টরি স্টক নিয়ন্ত্রণ করুন।</p>
                            </div>
                            <button type="button" onclick="openProductCreatePage()"
                                class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold flex items-center space-x-2 transition shadow-xs self-start sm:self-auto cursor-pointer">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                <span data-i18n="btnAddProduct">নতুন প্রোডাক্ট যোগ করুন</span>
                            </button>
                        </div>

                        <!-- Search & Filter Bar with Grid/Table View Mode Toggle -->
                        <div class="p-4 bg-slate-50/50 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div class="relative flex-1 w-full max-w-sm">
                                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
                                <input type="text" id="prodSearchInput" placeholder="প্রোডাক্টের নাম বা স্ল্যাগ দিয়ে খুঁজুন..."
                                    class="w-full pl-9 pr-4 py-1.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 shadow-xs">
                            </div>

                            <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                                <button type="button" onclick="loadProducts()" class="p-2 text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-xs" title="রিফ্রেশ">
                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Small Grid View (Mobile-First, Highly Visual, Prominent Stock & Status) -->
                        <div id="productGridContainer" class="p-3 sm:p-5 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                            <!-- Populated dynamically via JS -->
                            <div class="col-span-full py-12 text-center text-slate-500" data-i18n="loading">লোড হচ্ছে...</div>
                        </div>
                    </div>

                </section>
