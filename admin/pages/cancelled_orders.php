                <!-- TAB: বাতিল অর্ডার / ট্র্যাশ (ORDER CANCEL & TRASH) -->
                <section id="tabContentCancelledOrders" class="space-y-6 hidden">
                    
                    <!-- Header Banner -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </span>
                                <h2 class="text-base font-extrabold text-slate-900">বাতিল অর্ডার ও ট্র্যাশ (Order Cancel & Trash)</h2>
                                <span id="cancelledOrdersHeaderCountBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-700">০টি বাতিল</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">বাতিল হওয়া সকল অর্ডার এখানে তালিকাভুক্ত থাকে। যেকোনো সময় 'Undo (পুনরুদ্ধার)' বাটনে ক্লিক করে ফিরিয়ে নিতে পারবেন।</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button type="button" onclick="loadOrders().then(() => renderCancelledOrders(ordersData))" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center space-x-1.5 shadow-2xs">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                <span>রিফ্রেশ</span>
                            </button>
                        </div>
                    </div>

                    <!-- 30-Day Trash Policy Alert Banner -->
                    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-4 flex items-start space-x-3.5">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                        </div>
                        <div class="text-xs text-rose-900 leading-relaxed">
                            <strong class="font-bold">৩০ দিনের স্বয়ংক্রিয় ট্র্যাশ নীতি (Auto-removal in 30 Days):</strong>
                            <p class="text-rose-700 mt-0.5">এখানে থাকা বাতিল অর্ডারগুলো সর্বোচ্চ ৩০ দিন সংরক্ষিত থাকবে। ৩০ দিন অতিবাহিত হলে ডাটাবেজ থেকে স্বয়ংক্রিয়ভাবে মুছে ফেলা হবে। ভুলবশত কোনো অর্ডার বাতিল করা হয়ে থাকলে ডানপাশের <strong class="text-rose-900">"Undo (পুনরুদ্ধার)"</strong> বাটনে চাপ দিন, সাথে সাথে অর্ডারটি পেন্ডিং তালিকায় সক্রিয় হয়ে যাবে।</p>
                        </div>
                    </div>

                    <!-- Search Controls -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-xs">
                        <div class="relative">
                            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="text" id="cancelledOrderSearchInput" oninput="handleCancelledOrderSearch()" placeholder="বাতিল অর্ডারের ইনভয়েস নং, গ্রাহকের নাম অথবা ফোন নম্বর দিয়ে খুঁজুন..."
                                class="w-full pl-10 pr-4 py-2 bg-slate-50 hover:bg-white focus:bg-white border border-slate-200 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-rose-500 transition shadow-2xs">
                        </div>
                    </div>

                    <!-- Cancelled Orders List Container -->
                    <div id="cancelledOrdersListContainer" class="space-y-4">
                        <!-- Populated dynamically via renderCancelledOrders() -->
                    </div>
                </section>
