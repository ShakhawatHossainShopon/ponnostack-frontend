                                <!-- TAB: DESIGN WEBSITE (20 UNIQUE FLUID TEMPLATES, PALETTES & LIVE PREVIEW) -->
                <section id="tabContentDesignWebsite" class="hidden space-y-6">
                    <!-- Top Header Card (Responsive, Never Squished) -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs space-y-4">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center space-x-3.5 min-w-0 flex-1">
                                <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 border border-brand-200 flex items-center justify-center shrink-0 shadow-2xs">
                                    <i data-lucide="palette" class="w-6 h-6"></i>
                                </div>
                                <div class="min-w-0">
                                    <h2 class="text-base sm:text-lg font-black text-slate-900">ওয়েবসাইট ডিজাইন ও টেমপ্লেট স্টুডিও</h2>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        ২০টি রেডিমেড থিম। যেকোনো থিম সিলেক্ট করে লাইভ প্রিভিউ দেখুন এবং পছন্দ অনুযায়ী স্টোরে অ্যাপ্লাই করুন।
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2.5 shrink-0 self-start md:self-auto">
                                <button type="button" onclick="previewTemplateTheme(selectedTemplateId)"
                                    class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                                    <i data-lucide="eye" class="w-4 h-4 text-brand-400"></i>
                                    <span>লাইভ প্রিভিউ (Preview)</span>
                                </button>

                                <button type="button" onclick="saveWebsiteDesign()" id="btnSaveWebsiteDesign"
                                    class="px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                    <span>ডিজাইন সেভ ও অ্যাপ্লাই</span>
                                </button>
                            </div>
                        </div>

                        <!-- Current Active Theme Status Bar -->
                        <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs">
                            <div class="flex items-center space-x-2">
                                <span class="text-slate-500 font-semibold">বর্তমান সক্রিয় থিম:</span>
                                <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 font-black flex items-center space-x-1 shadow-2xs">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span id="lblActiveTemplateName"><?= htmlspecialchars($activeTemplate['name_bn'] ?? '') ?></span>
                                </span>
                                <span class="text-slate-300">|</span>
                                <span class="text-slate-500 font-semibold">রঙের প্যালেট:</span>
                                <span id="lblActivePaletteName" class="font-bold text-brand-600"><?= htmlspecialchars($activePalette['name_bn'] ?? '') ?></span>
                            </div>
                            <span class="text-[11px] text-slate-400">নিচের যেকোনো কার্ডে ক্লিক করে সরাসরি থিম পরিবর্তন ও প্রিভিউ দেখুন</span>
                        </div>
                    </div>

                    <!-- Clean Helpful Guide Strip -->
                    <div class="p-3.5 bg-brand-50/70 border border-brand-200/80 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
                        <div class="flex items-center space-x-2 text-slate-700">
                            <i data-lucide="sparkles" class="w-4 h-4 text-brand-600 shrink-0"></i>
                            <span>পছন্দের থিমটি নির্বাচন করার পর <strong>'লাইভ প্রিভিউ'</strong> বাটনে ক্লিক করলেই আপনার স্টোরের নতুন লুক দেখতে পাবেন।</span>
                        </div>
                        <button type="button" onclick="switchTab('uploadBanner')" class="text-xs text-brand-700 hover:text-brand-800 font-extrabold flex items-center space-x-1 cursor-pointer shrink-0">
                            <i data-lucide="image-plus" class="w-3.5 h-3.5"></i>
                            <span>ব্যানার ক্যারোসেল আপলোড &rarr;</span>
                        </button>
                    </div>

                    <!-- 20 Templates Grid -->
                    <div id="designTemplatesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <!-- Populated dynamically via renderDesignWebsiteTab() -->
                    </div>
                </section>
