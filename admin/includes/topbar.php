    <!-- 1. TOP NAVIGATION BAR -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            
            <!-- Left: Store Branding -->
            <div class="flex items-center space-x-3">
                <a href="./" class="flex items-center space-x-3">
                    <?php if (!empty($logoPath)): ?>
                        <img src="<?= htmlspecialchars($logoPath) ?>" alt="<?= htmlspecialchars($store['name']) ?>" id="navStoreLogo" class="w-9 h-9 rounded-xl object-cover border border-slate-200 shadow-xs">
                    <?php else: ?>
                        <div id="navStoreInitial" class="w-9 h-9 rounded-xl bg-brand-600 text-white font-extrabold text-base flex items-center justify-center shadow-xs">
                            <?= strtoupper(mb_substr($store['name'], 0, 1, 'UTF-8')) ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <div class="text-sm font-bold text-slate-900 leading-tight" id="navStoreName"><?= htmlspecialchars($store['name']) ?></div>
                        <div class="text-[10px] text-slate-400 font-medium flex items-center space-x-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span data-i18n="badgeStoreAdmin">ক্লায়েন্ট অ্যাডমিন প্যানেল</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Right Controls: Live Store Link, Language Switch, Profile & Logout -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                <!-- Visit Storefront Button -->
                <a href="../" target="_blank"
                   class="inline-flex items-center space-x-1.5 text-xs font-semibold text-slate-700 hover:text-brand-600 bg-slate-100 hover:bg-slate-200/80 px-3 py-1.5 rounded-xl transition">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    <span class="hidden sm:inline" data-i18n="btnVisitStore">স্টোরফ্রন্ট দেখুন</span>
                </a>



                <!-- User Profile Pill -->
                <div class="hidden md:flex items-center space-x-2 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-xs" id="topOwnerAvatar">
                        <?= strtoupper(mb_substr($store['owner_name'], 0, 1, 'UTF-8')) ?>
                    </div>
                    <div class="text-left text-xs">
                        <div class="font-bold text-slate-900 leading-tight" id="topOwnerName"><?= htmlspecialchars($store['owner_name']) ?></div>
                        <div class="text-[10px] text-slate-400 truncate max-w-[120px]" id="topOwnerEmail"><?= htmlspecialchars($store['owner_email']) ?></div>
                    </div>
                </div>

                <!-- Logout Button -->
                <button type="button" onclick="confirmLogout()" title="লগআউট"
                    class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </header>
