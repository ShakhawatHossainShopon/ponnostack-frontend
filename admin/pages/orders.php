                <!-- TAB 5: অর্ডার ব্যবস্থাপনা (ORDER MANAGEMENT) -->
                <section id="tabContentOrders" class="space-y-4 hidden">

                    <!-- 2 Status Filter Tabs: All Active, Pending, Processing -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-2.5 shadow-xs">
                        <div class="flex flex-wrap gap-2" id="orderStatusFilterButtons">
                            <button type="button" onclick="filterOrdersByStatus('active')" id="btnFilterStatusActive"
                                class="order-filter-btn px-3.5 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-2 bg-slate-900 text-white shadow-xs">
                                <span>সকল চলমান অর্ডার (Active)</span>
                                <span id="filterCountActive" class="px-1.5 py-0.5 rounded-full text-[10px] bg-slate-700 text-white font-mono">0</span>
                            </button>
                            <button type="button" onclick="filterOrdersByStatus('pending')" id="btnFilterStatusPending"
                                class="order-filter-btn px-3.5 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-2 bg-slate-50 hover:bg-amber-50 text-slate-600 hover:text-amber-700 border border-slate-200 hover:border-amber-300">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <span>পেন্ডিং (Pending)</span>
                                <span id="filterCountPending" class="px-1.5 py-0.5 rounded-full text-[10px] bg-amber-100 text-amber-800 font-mono">0</span>
                            </button>
                            <button type="button" onclick="filterOrdersByStatus('processing')" id="btnFilterStatusProcessing"
                                class="order-filter-btn px-3.5 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-2 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-700 border border-slate-200 hover:border-blue-300">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span>প্রসেসিং (Processing)</span>
                                <span id="filterCountProcessing" class="px-1.5 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-800 font-mono">0</span>
                            </button>
                        </div>
                    </div>

                    <!-- Search Controls -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-xs">
                        <div class="relative">
                            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="text" id="orderSearchInput" oninput="handleOrderSearch()" placeholder="ইনভয়েস বা অর্ডার নং (e.g. ORD-...), গ্রাহকের নাম অথবা ফোন নম্বর দিয়ে খুঁজুন..."
                                class="w-full pl-10 pr-4 py-2 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-orange-500 transition shadow-2xs">
                        </div>
                    </div>

                    <!-- Order Cards List Container -->
                    <div id="ordersListContainer" class="space-y-4">
                        <!-- Populated dynamically via renderOrders() -->
                    </div>

                    <!-- Orders Pagination -->
                    <div id="ordersPagination" class="hidden mt-6 bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div id="ordersPaginationSummary" class="text-xs font-medium text-slate-500 text-center sm:text-left"></div>
                        <div id="ordersPaginationButtons" class="flex items-center gap-1.5 flex-wrap justify-center"></div>
                    </div>

                </section>
