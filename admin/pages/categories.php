                <!-- TAB 3: ক্যাটাগরি ব্যবস্থাপনা (CATEGORIES VIEW) -->
                <section id="tabContentCategories" class="space-y-6 hidden">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                        <div class="p-4 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-amber-100 text-amber-700">
                                        <i data-lucide="folder-tree" class="w-4 h-4"></i>
                                    </span>
                                    <h2 class="text-base font-bold text-slate-900" data-i18n="categoryTitle">ক্যাটাগরি ব্যবস্থাপনা (Categories)</h2>
                                    <span id="categoryHeaderCount" class="px-2.5 py-0.5 rounded-full text-xs font-black bg-amber-100 text-amber-800 border border-amber-200">০ টি</span>
                                </div>
                                <p class="text-xs text-slate-500 mt-1" data-i18n="categorySubtitle">পণ্য সুশৃঙ্খলভাবে সাজানোর জন্য ক্যাটাগরি তৈরি ও পরিচালনা করুন। "Unnamed" ডিফল্ট ক্যাটাগরি হিসেবে থাকবে।</p>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="openCreateCategoryModal()"
                                    class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center space-x-1.5 cursor-pointer">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    <span>নতুন ক্যাটাগরি</span>
                                </button>
                                <button type="button" onclick="loadCategories()" class="p-2 text-slate-600 hover:text-slate-900 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-xs cursor-pointer" title="রিফ্রেশ">
                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Categories Grid Container -->
                        <div id="categoryGridContainer" class="p-3 sm:p-5 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                            <!-- Populated dynamically via renderCategories() -->
                            <div class="col-span-full py-12 text-center text-slate-500" data-i18n="loading">লোড হচ্ছে...</div>
                        </div>
                    </div>

                </section>
