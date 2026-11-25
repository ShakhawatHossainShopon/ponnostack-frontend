                <!-- TAB: সম্পন্ন অর্ডার ও হিসাব (COMPLETED ORDERS & ACCOUNTS) -->
                <section id="tabContentCompletedOrders" class="space-y-6 hidden">
                    
                    <!-- Header Banner -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                </span>
                                <h2 class="text-base font-extrabold text-slate-900">সম্পন্ন অর্ডার ও হিসাব (Completed Orders & Accounts)</h2>
                                <span id="completedOrdersHeaderCountBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">০টি সম্পন্ন</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">সফলভাবে ডেলিভারি হওয়া সকল অর্ডার এবং আর্থিক হিসাবের পূর্ণাঙ্গ বিবরণ।</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button type="button" onclick="loadOrders().then(() => renderCompletedOrders(ordersData))" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center space-x-1.5 shadow-2xs">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                <span>হিসাব রিফ্রেশ</span>
                            </button>
                        </div>
                    </div>

                    <!-- Financial & Accounts Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-500">মোট সম্পন্ন অর্ডার</span>
                                <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <i data-lucide="package-check" class="w-4 h-4"></i>
                                </span>
                            </div>
                            <div class="mt-2 text-2xl font-black text-slate-900" id="compStatTotalOrders">0</div>
                            <div class="text-[11px] text-emerald-600 font-semibold mt-0.5">সফলভাবে গ্রাহকের হাতে পৌঁছেছে</div>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-500">পণ্য বিক্রয় বাবদ আয়</span>
                                <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                </span>
                            </div>
                            <div class="mt-2 text-2xl font-black text-slate-900" id="compStatItemRevenue">৳0</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">ডেলিভারিকৃত পণ্যের সাবটোটাল</div>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-500">সংগৃহীত ডেলিভারি ফি</span>
                                <span class="w-8 h-8 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                                    <i data-lucide="truck" class="w-4 h-4"></i>
                                </span>
                            </div>
                            <div class="mt-2 text-2xl font-black text-slate-900" id="compStatDeliveryFee">৳0</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">আদায়কৃত মোট কুরিয়ার চার্জ</div>
                        </div>

                        <div class="bg-gradient-to-br from-emerald-500 to-teal-700 text-white rounded-2xl p-4 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-emerald-100">মোট হিসাব (Net Accounts)</span>
                                <span class="w-8 h-8 rounded-xl bg-white/20 text-white flex items-center justify-center">
                                    <i data-lucide="wallet" class="w-4 h-4"></i>
                                </span>
                            </div>
                            <div class="mt-2 text-2xl font-black text-white" id="compStatTotalRevenue">৳0</div>
                            <div class="text-[11px] text-emerald-100 mt-0.5 font-medium">ক্যাশ অন ডেলিভারিতে মোট আদায়</div>
                        </div>
                    </div>

                    <!-- Search Controls -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-xs">
                        <div class="relative">
                            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="text" id="completedOrderSearchInput" oninput="handleCompletedOrderSearch()" placeholder="সম্পন্ন অর্ডারের ইনভয়েস নং, গ্রাহকের নাম অথবা ফোন নম্বর দিয়ে খুঁজুন..."
                                class="w-full pl-10 pr-4 py-2 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-emerald-500 transition shadow-2xs">
                        </div>
                    </div>

                    <!-- Completed Orders List Container -->
                    <div id="completedOrdersListContainer" class="space-y-4">
                        <!-- Populated dynamically via renderCompletedOrders() -->
                    </div>

                    <!-- Completed Orders Pagination -->
                    <div id="completedOrdersPagination" class="hidden mt-6 bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div id="completedOrdersPaginationSummary" class="text-xs font-medium text-slate-500 text-center sm:text-left"></div>
                        <div id="completedOrdersPaginationButtons" class="flex items-center gap-1.5 flex-wrap justify-center"></div>
                    </div>

                </section>
