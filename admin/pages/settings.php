                <section id="tabContentUserInfo" class="space-y-6 hidden">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs">
                        <div class="border-b border-slate-100 pb-4 mb-6">
                            <h2 class="text-base font-bold text-slate-900" data-i18n="userProfileTitle">ইউজার তথ্য ও স্টোর সেটিংস</h2>
                            <p class="text-xs text-slate-500 mt-0.5" data-i18n="userProfileSub">আপনার স্টোরের নাম, স্ল্যাগ, যোগাযোগের ঠিকানা ও সোশ্যাল মিডিয়া প্রোফাইল লিংক আপডেট করুন।</p>
                        </div>

                        <form id="profileForm" class="space-y-5">
                            
                            <!-- Store Name & Slug -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldStoreName">স্টোরের নাম (Store Name) *</label>
                                    <input type="text" id="pName" required
                                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldStoreSlug">ইউনিক স্টোর স্ল্যাগ (Store Slug) *</label>
                                    <input type="text" id="pSlug" required
                                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 font-mono focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                </div>
                            </div>

                            <!-- Owner Name & Email (Account Info) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldOwnerName">স্বত্বাধিকারীর নাম (Owner Name)</label>
                                    <input type="text" id="pOwnerName" readonly disabled
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-500 cursor-not-allowed">
                                    <p class="text-[10px] text-slate-400 mt-1" data-i18n="hintManagedByMother">মাদার প্ল্যাটফর্ম দ্বারা নিয়ন্ত্রিত</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldOwnerEmail">অ্যাকাউন্ট ইমেইল (Login Email)</label>
                                    <input type="email" id="pOwnerEmail" readonly disabled
                                        class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-500 cursor-not-allowed">
                                    <p class="text-[10px] text-slate-400 mt-1" data-i18n="hintManagedByMother">মাদার প্ল্যাটফর্ম দ্বারা নিয়ন্ত্রিত</p>
                                </div>
                            </div>

                            <!-- Phone Number & Password Change -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldPhone">ফোন নম্বর (Phone Number)</label>
                                    <input type="text" id="pPhone" placeholder="01700000000 বা +8801700000000"
                                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldPassword">পাসওয়ার্ড পরিবর্তন (নতুন পাসওয়ার্ড)</label>
                                    <input type="password" id="pPassword" placeholder="পরিবর্তন না করতে চাইলে ফাঁকা রাখুন"
                                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                </div>
                            </div>

                            <!-- Store Address -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1" data-i18n="fieldAddress">স্টোর বা অফিসের ঠিকানা (Address)</label>
                                <textarea id="pAddress" rows="2" placeholder="রোড #১২, বনানী, ঢাকা"
                                    class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs"></textarea>
                            </div>

                            <!-- Social Media Links Section -->
                            <div class="border-t border-slate-100 pt-5">
                                <h4 class="text-xs font-bold text-slate-900 mb-3 flex items-center space-x-2">
                                    <i data-lucide="share-2" class="w-3.5 h-3.5 text-brand-600"></i>
                                    <span data-i18n="titleSocialSection">সোশ্যাল মিডিয়া লিংকসমূহ (Social Media Links)</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                            <span class="inline-flex items-center space-x-1">
                                                <i data-lucide="share-2" class="w-3 h-3 text-blue-600"></i>
                                                <span data-i18n="lblFacebook">ফেসবুক পেজ (Facebook URL)</span>
                                            </span>
                                        </label>
                                        <input type="url" id="pFacebook" placeholder="https://facebook.com/yourstore"
                                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                            <span class="inline-flex items-center space-x-1">
                                                <i data-lucide="camera" class="w-3 h-3 text-pink-600"></i>
                                                <span data-i18n="lblInstagram">ইনস্টাগ্রাম (Instagram URL)</span>
                                            </span>
                                        </label>
                                        <input type="url" id="pInstagram" placeholder="https://instagram.com/yourstore"
                                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                            <span class="inline-flex items-center space-x-1">
                                                <i data-lucide="message-circle" class="w-3 h-3 text-emerald-600"></i>
                                                <span data-i18n="lblWhatsapp">হোয়াটসঅ্যাপ (WhatsApp Number/Link)</span>
                                            </span>
                                        </label>
                                        <input type="text" id="pWhatsapp" placeholder="+8801700000000 বা https://wa.me/..."
                                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                            <span class="inline-flex items-center space-x-1">
                                                <i data-lucide="video" class="w-3 h-3 text-red-600"></i>
                                                <span data-i18n="lblYoutube">ইউটিউব চ্যানেল (YouTube Channel)</span>
                                            </span>
                                        </label>
                                        <input type="url" id="pYoutube" placeholder="https://youtube.com/@yourstore"
                                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">
                                            <span class="inline-flex items-center space-x-1">
                                                <i data-lucide="music-2" class="w-3 h-3 text-slate-900"></i>
                                                <span data-i18n="lblTiktok">টিকটক (TikTok URL)</span>
                                            </span>
                                        </label>
                                        <input type="url" id="pTiktok" placeholder="https://tiktok.com/@yourstore"
                                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                                <button type="button" onclick="switchTab('dashboard')"
                                    class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition" data-i18n="btnCancel">বাতিল</button>
                                
                                <button type="submit" id="btnSaveProfile"
                                    class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-sm hover:shadow flex items-center space-x-2">
                                    <i data-lucide="save" class="w-4 h-4"></i>
                                    <span id="btnSaveProfileText" data-i18n="btnSaveProfile">পরিবর্তন সংরক্ষণ করুন</span>
                                </button>
                            </div>

                        </form>
                    </div>

                </section>

            