                <!-- TAB 1: ড্যাশবোর্ড (HELLO WORLD & STORE OVERVIEW) -->
                <section id="tabContentDashboard" class="space-y-6 hidden">
                    
                    <!-- Welcome "Hello World" Banner -->
                    <div class="bg-gradient-to-r from-orange-500/10 via-amber-500/5 to-white border border-orange-200 rounded-2xl p-6 shadow-xs relative overflow-hidden">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <div class="inline-flex items-center space-x-2 bg-orange-100 text-orange-700 px-2.5 py-1 rounded-full text-[11px] font-bold mb-2">
                                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                                    <span data-i18n="helloWorldBadge">হ্যালো ওয়ার্ল্ড! স্বাগতম</span>
                                </div>
                                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                                    <span data-i18n="welcomeMsg">স্বাগতম,</span> <span id="welcomeOwnerName"><?= htmlspecialchars($store['owner_name']) ?></span>! 👋
                                </h2>
                                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl" data-i18n="welcomeSub">
                                    এটি আপনার স্টোরফ্রন্টের কেন্দ্রীয় অ্যাডমিন ড্যাশবোর্ড। এখান থেকে আপনি স্টোরের প্রোডাক্ট আপলোড, ইনভেন্টরি স্টক এবং কেনা-বেচার লাভ পরিচালনা করতে পারবেন।
                                </p>
                            </div>
                            
                            <!-- Quick Action Buttons -->
                            <div class="flex flex-wrap sm:flex-col gap-2">
                                <button type="button" onclick="openCreateProductModal()"
                                    class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-2">
                                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                    <span data-i18n="btnAddProductQuick">প্রোডাক্ট যোগ করুন</span>
                                </button>
                                <a href="../" target="_blank"
                                   class="px-4 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-2">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span data-i18n="btnViewLive">ওয়েবসাইট দেখুন</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Orders Overview Banner on Dashboard (Order Summary & Performance) -->
                    <div class="bg-gradient-to-r from-orange-500/10 via-amber-500/5 to-white border border-orange-200 rounded-2xl p-5 shadow-xs">
                        <div class="flex items-center justify-between border-b border-orange-200/60 pb-3 mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-xl bg-orange-600 text-white flex items-center justify-center shadow-xs">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">অর্ডার সামারি ও পারফরম্যান্স</h3>
                                    <p class="text-[11px] text-slate-500">গ্রাহকদের সর্বশেষ অর্ডার পরিস্থিতি একনজরে</p>
                                </div>
                            </div>
                            <button type="button" onclick="switchTab('orders')" class="text-xs text-orange-600 hover:text-orange-700 font-bold flex items-center space-x-1">
                                <span>অর্ডার ম্যানেজমেন্টে যান</span>
                                <span>&rarr;</span>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="bg-white p-3 rounded-xl border border-orange-100 shadow-2xs">
                                <div class="text-[11px] font-medium text-slate-500">মোট অর্ডার</div>
                                <div class="text-xl font-black text-slate-900 mt-0.5" id="dashTotalOrders">0</div>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-amber-200 shadow-2xs">
                                <div class="text-[11px] font-bold text-amber-700 flex items-center space-x-1">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    <span>পেন্ডিং অর্ডার</span>
                                </div>
                                <div class="text-xl font-black text-amber-700 mt-0.5" id="dashPendingOrders">0</div>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-blue-200 shadow-2xs">
                                <div class="text-[11px] font-bold text-blue-700 flex items-center space-x-1">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    <span>প্রসেসিং</span>
                                </div>
                                <div class="text-xl font-black text-blue-700 mt-0.5" id="dashProcessingOrders">0</div>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-emerald-200 shadow-2xs">
                                <div class="text-[11px] font-bold text-emerald-700 flex items-center space-x-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>ডেলিভারি রাজস্ব</span>
                                </div>
                                <div class="text-lg font-black text-emerald-700 mt-0.5" id="dashDeliveredRevenue">৳০.০০</div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Quick Stats / Store Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Card 1: Total Products -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between text-slate-400 mb-2">
                                <span class="text-xs font-semibold text-slate-600" data-i18n="statTotalProducts">মোট প্রোডাক্ট</span>
                                <i data-lucide="package" class="w-4 h-4 text-brand-600"></i>
                            </div>
                            <div class="text-2xl font-black text-slate-900" id="dashTotalProducts">0</div>
                            <div class="text-[11px] text-slate-500 mt-0.5" data-i18n="statActiveInCatalog">ক্যাটালগে প্রদর্শিত</div>
                        </div>

                        <!-- Card 2: Total Stock Inventory -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between text-slate-400 mb-2">
                                <span class="text-xs font-semibold text-slate-600" data-i18n="statTotalStock">মোট ইনভেন্টরি স্টক</span>
                                <i data-lucide="boxes" class="w-4 h-4 text-emerald-600"></i>
                            </div>
                            <div class="text-2xl font-black text-slate-900" id="dashTotalStock">0</div>
                            <div class="text-[11px] text-slate-500 mt-0.5" data-i18n="statStockUnits">উপলব্ধ আইটেম/ইউনিট</div>
                        </div>

                        <!-- Card 3: Estimated Profit -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between text-slate-400 mb-2">
                                <span class="text-xs font-semibold text-slate-600" data-i18n="statEstimatedProfit">সম্ভাব্য মুনাফা</span>
                                <i data-lucide="trending-up" class="w-4 h-4 text-emerald-600"></i>
                            </div>
                            <div class="text-xl font-black text-emerald-600" id="dashTotalProfit">৳০.০০</div>
                            <div class="text-[11px] text-slate-500 mt-0.5" data-i18n="statProfitFormula">(বিক্রয় - কেনা দাম) × স্টক</div>
                        </div>

                        <!-- Card 4: Store Status -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between text-slate-400 mb-2">
                                <span class="text-xs font-semibold text-slate-600" data-i18n="cardStatus">স্টোর স্ট্যাটাস</span>
                                <i data-lucide="activity" class="w-4 h-4 text-emerald-600"></i>
                            </div>
                            <div class="inline-flex items-center space-x-1.5 px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span data-i18n="statusActive">সক্রিয় (Active)</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-1" data-i18n="statusSub">মাদার কন্ট্রোল দ্বারা অনুমোদিত</div>
                        </div>
                    </div>

                    <!-- Social Media Links Overview Card -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                            <div>
                                <h3 class="text-sm font-bold text-slate-900" data-i18n="socialOverviewTitle">সংযুক্ত সোশ্যাল মিডিয়া চ্যানেলসমূহ</h3>
                                <p class="text-xs text-slate-500" data-i18n="socialOverviewSub">আপনার স্টোরফ্রন্টের উপরের বারে এই লিংকগুলো গ্রাহকদের নিকট প্রদর্শিত হয়।</p>
                            </div>
                            <button type="button" onclick="switchTab('userInfo')" class="text-xs text-brand-600 hover:text-brand-700 font-semibold" data-i18n="btnManageSocial">
                                পরিবর্তন করুন &rarr;
                            </button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3" id="socialBadgesContainer">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                </section>
