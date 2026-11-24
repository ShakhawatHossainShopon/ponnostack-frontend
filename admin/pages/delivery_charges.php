                <!-- Section: Delivery Charges Management (CRUD) -->
                <section id="tabContentDeliveryCharges" class="space-y-6 hidden">
                    <!-- Top Action Bar -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center space-x-2.5">
                                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                    <i data-lucide="truck" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-extrabold text-slate-900 leading-tight">ডেলিভারি চার্জ ও জোন ব্যবস্থাপনা</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">চেকআউট পেজে এলাকাভিত্তিক ডেলিভারি ফি (ঢাকার ভেতরে, ঢাকার বাইরে ইত্যাদি) ডায়নামিকভাবে CRUD করুন।</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="openDeliveryModal()"
                            class="px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-extrabold rounded-xl transition shadow-xs flex items-center space-x-2 shrink-0 cursor-pointer">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>নতুন ডেলিভারি চার্জ যুক্ত করুন</span>
                        </button>
                    </div>

                    <!-- Summary Stats Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs">
                            <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">মোট জোন সংখ্যা</div>
                            <div class="text-2xl font-black text-slate-900 mt-1 font-mono" id="statDeliveryTotal">০</div>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs">
                            <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">সক্রিয় ডেলিভারি জোন</div>
                            <div class="text-2xl font-black text-emerald-600 mt-1 font-mono" id="statDeliveryActive">০</div>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs">
                            <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">ডিফল্ট ডেলিভারি জোন</div>
                            <div class="text-xs font-bold text-slate-800 mt-2 truncate" id="statDeliveryDefault">ঢাকার ভেতরে (৳৬০.০০)</div>
                        </div>
                    </div>

                    <!-- Delivery Charges Table Container -->
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                            <h4 class="text-xs font-bold text-slate-900">সকল ডেলিভারি চার্জ তালিকা</h4>
                            <button type="button" onclick="loadDeliveryChargesAdmin()" class="px-2.5 py-1 text-slate-500 hover:text-slate-800 text-xs rounded-lg hover:bg-slate-100 transition flex items-center space-x-1 cursor-pointer">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                <span>রিফ্রেশ</span>
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold">
                                        <th class="py-3 px-4">জোন / এলাকার নাম</th>
                                        <th class="py-3 px-3">ইউনিক কোড</th>
                                        <th class="py-3 px-3">ডেলিভারি ফি (টাকা)</th>
                                        <th class="py-3 px-3">আনুমানিক সময় ও বিবরণ</th>
                                        <th class="py-3 px-3 text-center">স্ট্যাটাস</th>
                                        <th class="py-3 px-4 text-right">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody id="deliveryChargesTableBody" class="divide-y divide-slate-100 font-medium text-slate-700">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
