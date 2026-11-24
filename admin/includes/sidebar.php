            <!-- Left Navigation Sidebar -->
            <aside class="md:col-span-3 lg:col-span-3">

                <!-- 1. Sidebar Skeleton Loader (Visible on Initial Page Load) -->
                <div id="sidebarSkeleton" class="bg-white border border-slate-200 rounded-2xl p-2 shadow-xs space-y-1">
                    <!-- 1. Dashboard Item Skeleton -->
                    <div class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-4 h-4 rounded skeleton-shimmer shrink-0"></div>
                        <div class="h-3.5 w-32 rounded skeleton-shimmer"></div>
                    </div>

                    <!-- 2. Orders Item Skeleton -->
                    <div class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 rounded skeleton-shimmer shrink-0"></div>
                            <div class="h-3.5 w-28 rounded skeleton-shimmer"></div>
                        </div>
                        <div class="h-4 w-6 rounded-full skeleton-shimmer"></div>
                    </div>

                    <!-- 3. Products Item Skeleton -->
                    <div class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 rounded skeleton-shimmer shrink-0"></div>
                            <div class="h-3.5 w-36 rounded skeleton-shimmer"></div>
                        </div>
                        <div class="h-4 w-6 rounded-full skeleton-shimmer"></div>
                    </div>

                    <!-- 4. Website Design Skeleton -->
                    <div class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl">
                        <div class="w-4 h-4 rounded skeleton-shimmer shrink-0"></div>
                        <div class="h-3.5 w-40 rounded skeleton-shimmer"></div>
                    </div>

                    <!-- 5. Payments Skeleton -->
                    <div class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 rounded skeleton-shimmer shrink-0"></div>
                            <div class="h-3.5 w-32 rounded skeleton-shimmer"></div>
                        </div>
                        <div class="h-4 w-10 rounded-full skeleton-shimmer"></div>
                    </div>

                    <!-- Divider & Collapsible Trigger Skeleton -->
                    <div class="pt-1.5 border-t border-slate-100 mt-2">
                        <div class="w-full flex items-center justify-between px-3 py-2 rounded-xl">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-4 h-4 rounded skeleton-shimmer shrink-0"></div>
                                <div class="h-3.5 w-28 rounded skeleton-shimmer"></div>
                            </div>
                            <div class="w-3.5 h-3.5 rounded skeleton-shimmer"></div>
                        </div>
                    </div>
                </div>

                <!-- 2. Actual Navigation Links (Hidden on load, smoothly fades in) -->
                <nav id="sidebarNavContent" class="hidden bg-white border border-slate-200 rounded-2xl p-2 shadow-xs space-y-1">
                    <!-- Tab 1: Dashboard -->
                    <button type="button" onclick="switchTab('dashboard')" id="navTabDashboard"
                        class="w-full flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-brand-600 bg-brand-50 border border-brand-200/50">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span data-i18n="tabDashboard">ড্যাশবোর্ড (Dashboard)</span>
                    </button>

                    <!-- Tab: Order Management -->
                    <button type="button" onclick="switchTab('orders')" id="navTabOrders"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="shopping-bag" class="w-4 h-4 text-orange-600"></i>
                            <span data-i18n="tabOrders">অর্ডার ব্যবস্থাপনা</span>
                        </div>
                        <span id="badgeActiveOrderCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">0</span>
                    </button>

                    <!-- Tab 2: Products & Inventory -->
                    <button type="button" onclick="switchTab('products')" id="navTabProducts"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="package" class="w-4 h-4"></i>
                            <span data-i18n="tabProducts">প্রোডাক্ট ও ইনভেন্টরি</span>
                        </div>
                        <span id="badgeProductCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-100 text-brand-700">0</span>
                    </button>

                    <!-- Tab: Design Website -->
                    <button type="button" onclick="switchTab('designWebsite')" id="navTabDesignWebsite"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="palette" class="w-4 h-4 text-brand-600"></i>
                            <span data-i18n="tabDesignWebsite">ওয়েবসাইট ডিজাইন (Design Website)</span>
                        </div>
                    </button>

                    <!-- Tab: Payments (Design Only) -->
                    <button type="button" onclick="switchTab('payments')" id="navTabPayments"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="credit-card" class="w-4 h-4 text-emerald-600"></i>
                            <span data-i18n="tabPayments">পেমেন্ট ও বিলিং (Payments)</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">নতুন</span>
                    </button>

                    <!-- Collapsible Menu Divider & Toggle Button -->
                    <div class="pt-1.5 border-t border-slate-100 mt-2">
                        <button type="button" onclick="toggleCollapsibleNav()" id="btnToggleCollapsibleNav"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition group">
                            <div class="flex items-center space-x-2.5">
                                <i data-lucide="layers" class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition"></i>
                                <span data-i18n="navMoreMenu">অন্যান্য মেনু ও সেটিংস</span>
                            </div>
                            <i id="collapsibleNavChevron" data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200"></i>
                        </button>

                        <!-- Collapsible Sub-Items (Completed Orders, Cancelled Orders, Category, Stock Out, Store Settings) -->
                        <div id="collapsibleNavLinks" class="hidden mt-1 space-y-1 pl-2.5 border-l-2 border-slate-200 ml-3">
                            <!-- Tab: Completed Orders & Accounts -->
                            <button type="button" onclick="switchTab('completedOrders')" id="navTabCompletedOrders"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                                    <span data-i18n="tabCompletedOrders">সম্পন্ন অর্ডার ও হিসাব</span>
                                </div>
                                <span id="badgeCompletedOrderCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">0</span>
                            </button>

                            <!-- Tab: Cancelled Orders (Trash) -->
                            <button type="button" onclick="switchTab('cancelledOrders')" id="navTabCancelledOrders"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                                    <span data-i18n="tabCancelledOrders">বাতিল অর্ডার (Trash)</span>
                                </div>
                                <span id="badgeCancelledOrderCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">0</span>
                            </button>

                            <!-- Tab 3: Categories -->
                            <button type="button" onclick="switchTab('categories')" id="navTabCategories"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="folder-tree" class="w-4 h-4 text-amber-500"></i>
                                    <span data-i18n="tabCategories">ক্যাটাগরি (Category)</span>
                                </div>
                                <span id="badgeCategoryCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">0</span>
                            </button>

                            <!-- Tab 4: Stock Out Products -->
                            <button type="button" onclick="switchTab('stockOut')" id="navTabStockOut"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-500"></i>
                                    <span data-i18n="tabStockOut">স্টক আউট (Stock Out)</span>
                                </div>
                                <span id="badgeStockOutCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">0</span>
                            </button>

                            <!-- Tab 5: Store Profile / Settings -->
                            <!-- Tab: Discounts & Deals List -->
                            <button type="button" onclick="switchTab('discounts')" id="navTabDiscounts"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="percent" class="w-4 h-4 text-orange-500"></i>
                                    <span>ডিসকাউন্ট ও অফার তালিকা</span>
                                </div>
                                <span id="badgeDiscountCount" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-orange-100 text-orange-700">0</span>
                            </button>

                            <!-- Tab: Delivery Charges (ডেলিভারি চার্জ ও জোন) -->
                            <button type="button" onclick="switchTab('deliveryCharges')" id="navTabDeliveryCharges"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="truck" class="w-4 h-4 text-emerald-600"></i>
                                    <span>ডেলিভারি চার্জ (Delivery)</span>
                                </div>
                                <span id="badgeDeliveryCount" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800">0</span>
                            </button>

                            

                                                        <!-- Tab: Upload Banner (ব্যানার আপলোড - Max 5 High Quality) -->
                            <button type="button" onclick="switchTab('uploadBanner')" id="navTabUploadBanner"
                                class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <div class="flex items-center space-x-2.5">
                                    <i data-lucide="image-plus" class="w-4 h-4 text-brand-600"></i>
                                    <span data-i18n="tabUploadBanner">ব্যানার আপলোড (Upload Banner)</span>
                                </div>
                                <span id="badgeBannerCount" class="px-2 py-0.5 rounded-full text-[10px] font-black bg-brand-100 text-brand-700"><?= count($store['banners'] ?? []) ?>/5</span>
                            </button>

                            <button type="button" onclick="switchTab('userInfo')" id="navTabUserInfo"
                                class="w-full flex items-center space-x-2.5 px-3 py-2 rounded-xl text-xs font-bold transition text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                                <i data-lucide="user-cog" class="w-4 h-4 text-slate-500"></i>
                                <span data-i18n="tabUserInfo">ইউজার তথ্য ও স্টোর সেটিংস</span>
                            </button>
                        </div>
                    </div>
                </nav>
            </aside>