                <!-- GLOBAL SAAS SUBSCRIPTION / BLOCKED WARNING BANNER -->
                <div id="saasBlockedWarningBanner" class="hidden mb-6 bg-gradient-to-r from-rose-600 via-rose-500 to-red-600 text-white rounded-2xl p-4 sm:p-5 shadow-lg border-2 border-red-400">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-start space-x-3.5">
                            <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0 text-white shadow-inner">
                                <i data-lucide="alert-octagon" class="w-6 h-6 animate-pulse"></i>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-0.5 rounded-full bg-white/20 text-[10px] font-black uppercase tracking-wider">পাবলিক ওয়েবসাইট বন্ধ (Blocked)</span>
                                    <span id="saasBannerStatusBadge" class="px-2 py-0.5 rounded-full bg-black/25 text-[10px] font-bold">মেয়াদ শেষ</span>
                                </div>
                                <h3 class="text-sm sm:text-base font-black mt-1" id="saasBannerTitle">সাবস্ক্রিপশনের মেয়াদ শেষ হয়েছে — ওয়েবসাইটটি সাময়িকভাবে বন্ধ (Blocked) আছে!</h3>
                                <p class="text-xs text-rose-100 mt-1 leading-relaxed" id="saasBannerDesc">
                                    আপনার স্টোরের মাসিক সার্ভিস ফি <strong id="saasBannerAmountDisplay" class="text-white font-extrabold underline">৳ <?= number_format((float)($store['monthly_fee'] ?? 999.00)) ?></strong> বকেয়া থাকায় পাবলিক ভিজিটরদের জন্য সাইটটি ব্লক রয়েছে। ওয়েবসাইট চালু করতে বিকাশ দিয়ে ফি পরিশোধ করুন।
                                </p>
                            </div>
                        </div>
                        <button type="button" onclick="switchTab('payments')" class="w-full sm:w-auto px-4 py-2.5 bg-white text-rose-700 hover:bg-rose-50 font-black text-xs rounded-xl shadow-md transition flex items-center justify-center space-x-1.5 shrink-0 cursor-pointer">
                            <i data-lucide="credit-card" class="w-4 h-4 text-pink-600"></i>
                            <span>বিকাশ দিয়ে ফি পরিশোধ করুন</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
