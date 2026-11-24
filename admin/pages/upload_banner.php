                <!-- TAB: UPLOAD BANNER (HERO CAROUSEL BANNERS - MAX 5, HIGH QUALITY, NO 200KB LIMIT) -->
                <section id="tabContentUploadBanner" class="hidden space-y-6">
                    <!-- Header -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start sm:items-center space-x-3.5">
                            <div class="w-11 h-11 rounded-2xl bg-brand-50 text-brand-600 border border-brand-200 flex items-center justify-center shrink-0 shadow-2xs">
                                <i data-lucide="image-plus" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-extrabold text-slate-900">হিরো ক্যারোসেল ব্যানার আপলোড (Upload Banner)</h2>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    হোমপেজের প্রথম সেকশনের (Hero Carousel) জন্য সর্বোচ্চ ৫টি হাই-কোয়ালিটি ব্যানার আপলোড করুন। এতে কোনো ২০০KB লিমিট নেই।
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 shrink-0">
                            <span id="lblBannerSlotStatus" class="px-3 py-1.5 rounded-xl bg-brand-50 border border-brand-200 text-brand-700 text-xs font-extrabold">
                                0 / 5 ব্যানার আপলোডকৃত
                            </span>
                            <a href="../" target="_blank" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center space-x-1.5">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                <span>লাইভ ক্যারোসেল দেখুন</span>
                            </a>
                        </div>
                    </div>

                    <!-- Upload Dropzone Box -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">নতুন ব্যানার ইমেজ যোগ করুন (High Resolution)</h3>
                                <p class="text-xs text-slate-500">JPG, PNG, WebP বা GIF ফরম্যাট। মূল রেজোলিউশন ও ১০০% অরিজিনাল কোয়ালিটিতে সংরক্ষিত হবে।</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-bold">
                                ✨ আনকম্প্রেসড হাই-কোয়ালিটি (No 200KB Limit)
                            </span>
                        </div>

                        <label for="bannerFileInput" id="bannerUploadDropzone"
                            class="border-2 border-dashed border-slate-300 hover:border-brand-500 hover:bg-brand-50/20 rounded-2xl p-8 text-center cursor-pointer transition bg-slate-50/60 block group select-none">
                            <input type="file" id="bannerFileInput" accept="image/png,image/jpeg,image/webp,image/gif" multiple class="sr-only" onchange="handleBannerUploadSelection(event)">
                            <div class="flex flex-col items-center justify-center pointer-events-none space-y-2">
                                <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-200 flex items-center justify-center group-hover:scale-110 transition shadow-2xs">
                                    <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                                </div>
                                <div class="text-sm font-extrabold text-slate-800" id="bannerUploadPromptText">ব্যানার ছবি আপলোড করতে এখানে ক্লিক করুন (একসাথে বা আলাদাভাবে সর্বোচ্চ ৫টি)</div>
                                <div class="text-xs text-slate-400">প্রস্তাবিত রেশিও: ওয়াইডস্ক্রিন ব্যানার (যেমন: 1920×700px বা 1600×600px)</div>
                            </div>
                        </label>
                    </div>

                    <!-- Uploaded Banners Grid (1 to 5 Slides) -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h3 class="text-sm font-extrabold text-slate-900">বর্তমান ক্যারোসেল ব্যানার সমূহ (Active Carousel Slides)</h3>
                            <span class="text-[11px] text-slate-400">হোমপেজে ক্রমানুসারে স্লাইড হবে</span>
                        </div>

                        <div id="uploadedBannersGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Populated dynamically via renderUploadBannerTab() -->
                        </div>
                    </div>
                </section>

                <!-- ========================================== -->
                <!-- 13. TAB: PAYMENTS & GATEWAYS (DESIGN MOCKUP) -->
                <!-- ========================================== -->
                <!-- ========================================== -->
                <!-- 13. TAB: SAAS BILLING & PAYMENTS (DESIGN MOCKUP) -->
                <!-- ========================================== -->
                <!-- ========================================== -->
                <!-- 13. TAB: SAAS BILLING & PAYMENTS (CLEAN & MOBILE RESPONSIVE) -->