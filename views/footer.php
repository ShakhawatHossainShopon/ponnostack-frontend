    </div><!-- End flex-1 -->

    <?php
    $tplNum = (int)($activeTemplate['number'] ?? 1);
    
    // 20 Distinct Footer Theme Presets (100% Solid & Opaque - NEVER Transparent)
    $footerThemeConfigs = [
        1  => ['bg' => 'bg-white', 'text' => 'text-slate-600', 'border' => 'border-t border-slate-200', 'subtext' => 'text-slate-400', 'isDark' => false],
        2  => ['bg' => 'bg-brand-50', 'text' => 'text-slate-700', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-500', 'isDark' => false],
        3  => ['bg' => 'bg-slate-950', 'text' => 'text-slate-300', 'border' => 'border-t border-brand-500/30', 'subtext' => 'text-slate-500', 'isDark' => true],
        4  => ['bg' => 'bg-brand-50', 'text' => 'text-slate-800', 'border' => 'border-t-2 border-brand-500', 'subtext' => 'text-slate-500', 'isDark' => false],
        5  => ['bg' => 'bg-brand-50', 'text' => 'text-slate-700', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-400', 'isDark' => false],
        6  => ['bg' => 'bg-white', 'text' => 'text-black', 'border' => 'border-t-2 border-black', 'subtext' => 'text-slate-600', 'isDark' => false],
        7  => ['bg' => 'bg-brand-50', 'text' => 'text-slate-800', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-500', 'isDark' => false],
        8  => ['bg' => 'bg-gradient-to-r from-brand-50 via-white to-brand-50', 'text' => 'text-slate-700', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-400', 'isDark' => false],
        9  => ['bg' => 'bg-slate-900', 'text' => 'text-slate-300', 'border' => 'border-t-2 border-brand-500', 'subtext' => 'text-slate-500', 'isDark' => true],
        10 => ['bg' => 'bg-brand-50', 'text' => 'text-slate-800', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-500', 'isDark' => false],
        11 => ['bg' => 'bg-white', 'text' => 'text-slate-700', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-400', 'isDark' => false],
        12 => ['bg' => 'bg-neutral-900', 'text' => 'text-slate-300', 'border' => 'border-t border-brand-500/30', 'subtext' => 'text-slate-500', 'isDark' => true],
        13 => ['bg' => 'bg-slate-900', 'text' => 'text-slate-300', 'border' => 'border-t-2 border-brand-500', 'subtext' => 'text-slate-500', 'isDark' => true],
        14 => ['bg' => 'bg-brand-50', 'text' => 'text-slate-800', 'border' => 'border-t-2 border-brand-500', 'subtext' => 'text-slate-500', 'isDark' => false],
        15 => ['bg' => 'bg-zinc-950', 'text' => 'text-zinc-300', 'border' => 'border-t border-brand-500/30', 'subtext' => 'text-zinc-500', 'isDark' => true],
        16 => ['bg' => 'bg-brand-50', 'text' => 'text-slate-900', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-500', 'isDark' => false],
        17 => ['bg' => 'bg-slate-900', 'text' => 'text-slate-300', 'border' => 'border-t-2 border-brand-500', 'subtext' => 'text-slate-500', 'isDark' => true],
        18 => ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-t border-slate-200', 'subtext' => 'text-slate-400', 'isDark' => false],
        19 => ['bg' => 'bg-gradient-to-r from-brand-50 via-white to-brand-50', 'text' => 'text-slate-700', 'border' => 'border-t border-brand-200', 'subtext' => 'text-slate-400', 'isDark' => false],
        20 => ['bg' => 'bg-slate-950', 'text' => 'text-slate-300', 'border' => 'border-t border-brand-500/40', 'subtext' => 'text-slate-400', 'isDark' => true],
    ];
    $ft = $footerThemeConfigs[$tplNum] ?? $footerThemeConfigs[1];
    ?>

    <!-- FOOTER (20 DISTINCT THEME PRESENTATIONS) -->
    <footer class="<?= $ft['bg'] ?> <?= $ft['border'] ?> mt-16 <?= $ft['text'] ?> text-xs">
        <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <!-- Col 1: Store Bio & Identity -->
            <div class="space-y-3 md:col-span-1">
                <div class="flex items-center space-x-2">
                    <?php if (!empty($logoUrl)): ?>
                        <img src="<?= htmlspecialchars($logoUrl) ?>" class="w-7 h-7 rounded-lg object-cover border <?= $ft['isDark'] ? 'border-slate-700' : 'border-slate-200' ?>">
                    <?php endif; ?>
                    <span class="font-bold <?= $ft['isDark'] ? 'text-white' : 'text-slate-900' ?> text-sm"><?= htmlspecialchars($storeName) ?></span>
                </div>
                <p class="<?= $ft['subtext'] ?> leading-relaxed text-[11px]">
                    <?= htmlspecialchars($storeAddress ?: 'অনলাইন শপিং ও অফিসিয়াল স্টোরফ্রন্ট। ১০০% অরিজিনাল পণ্য ও দ্রুত ডেলিভারি।') ?>
                </p>
                <div class="text-[10px] <?= $ft['subtext'] ?> font-mono">
                    Template: <span class="text-brand-500 font-bold">#<?= $tplNum ?> <?= htmlspecialchars($activeTemplate['name_en'] ?? '') ?></span>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="space-y-2">
                <h4 class="font-bold <?= $ft['isDark'] ? 'text-white' : 'text-slate-900' ?> text-xs uppercase tracking-wider mb-2">প্রয়োজনীয় লিংক</h4>
                <div><a href="./" class="hover:text-brand-500 transition">হোমপেজ (Home)</a></div>
                <div><a href="discount" class="hover:text-brand-500 transition font-bold text-brand-500 flex items-center space-x-1"><span>🔥 ডিসকাউন্ট অফার</span></a></div>
                <?php if (!empty($hasCategories)): ?>
                <div><a href="category" class="hover:text-brand-500 transition">ক্যাটাগরি সমূহ</a></div>
                <?php endif; ?>
                <div><a href="about" class="hover:text-brand-500 transition">আমাদের সম্পর্কে</a></div>
                <div><a href="contact" class="hover:text-brand-500 transition">সহায়তা ও যোগাযোগ</a></div>
            </div>

            <!-- Col 3: Customer Care & Order -->
            <div class="space-y-2">
                <h4 class="font-bold <?= $ft['isDark'] ? 'text-white' : 'text-slate-900' ?> text-xs uppercase tracking-wider mb-2">গ্রাহক সেবা ও ট্র্যাকিং</h4>
                <div><button type="button" onclick="openOrderTrackingModal()" class="hover:text-brand-500 transition cursor-pointer text-left">📦 অর্ডার ট্র্যাক করুন</button></div>
                <div><button type="button" onclick="openCartDrawer()" class="hover:text-brand-500 transition cursor-pointer text-left">🛍️ শপিং কার্ট</button></div>
                <div><a href="admin/" class="hover:text-brand-500 transition flex items-center space-x-1"><i data-lucide="shield" class="w-3 h-3 text-brand-500"></i><span>স্টোর অ্যাডমিন</span></a></div>
                <?php if (!empty($ownerEmail)): ?>
                    <div class="truncate text-[11px] <?= $ft['subtext'] ?>">ইমেইল: <a href="mailto:<?= htmlspecialchars($ownerEmail) ?>" class="hover:text-brand-500 underline"><?= htmlspecialchars($ownerEmail) ?></a></div>
                <?php endif; ?>
            </div>

            <?php
            // Social media validation: ONLY show icons for links actually provided by store owner
            $hasAnySocial = false;
            $socialNetworks = ['facebook', 'instagram', 'whatsapp', 'youtube', 'tiktok'];
            if (!empty($socials) && is_array($socials)) {
                foreach ($socialNetworks as $sKey) {
                    if (!empty($socials[$sKey]) && trim((string)$socials[$sKey]) !== '') {
                        $hasAnySocial = true;
                        break;
                    }
                }
            }
            ?>
            <!-- Col 4: Social & Support -->
            <div class="space-y-3">
                <h4 class="font-bold <?= $ft['isDark'] ? 'text-white' : 'text-slate-900' ?> text-xs uppercase tracking-wider">
                    <?= $hasAnySocial ? 'সোশ্যাল মিডিয়া ও সাপোর্ট' : 'গ্রাহক সহায়তা ও সাপোর্ট' ?>
                </h4>
                
                <?php if ($hasAnySocial): ?>
                <div class="flex items-center space-x-2">
                    <?php if (!empty($socials['facebook'])): ?>
                        <a href="<?= htmlspecialchars($socials['facebook']) ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-lg <?= $ft['isDark'] ? 'bg-slate-800 text-blue-400 hover:bg-blue-600 hover:text-white' : 'bg-blue-50 text-blue-600 hover:bg-blue-100' ?> flex items-center justify-center transition shadow-xs" title="Facebook">
                            <i data-lucide="share-2" class="w-3.5 h-3.5"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($socials['instagram'])): ?>
                        <a href="<?= htmlspecialchars($socials['instagram']) ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-lg <?= $ft['isDark'] ? 'bg-slate-800 text-pink-400 hover:bg-pink-600 hover:text-white' : 'bg-pink-50 text-pink-600 hover:bg-pink-100' ?> flex items-center justify-center transition shadow-xs" title="Instagram">
                            <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($socials['whatsapp'])): ?>
                        <?php 
                            $wa = trim($socials['whatsapp']);
                            $waUrl = str_starts_with($wa, 'http') ? $wa : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $wa);
                        ?>
                        <a href="<?= htmlspecialchars($waUrl) ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-lg <?= $ft['isDark'] ? 'bg-slate-800 text-emerald-400 hover:bg-emerald-600 hover:text-white' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' ?> flex items-center justify-center transition shadow-xs" title="WhatsApp">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($socials['youtube'])): ?>
                        <a href="<?= htmlspecialchars($socials['youtube']) ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-lg <?= $ft['isDark'] ? 'bg-slate-800 text-red-400 hover:bg-red-600 hover:text-white' : 'bg-red-50 text-red-600 hover:bg-red-100' ?> flex items-center justify-center transition shadow-xs" title="YouTube">
                            <i data-lucide="video" class="w-3.5 h-3.5"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($socials['tiktok'])): ?>
                        <a href="<?= htmlspecialchars($socials['tiktok']) ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded-lg <?= $ft['isDark'] ? 'bg-slate-800 text-slate-200 hover:bg-black hover:text-white' : 'bg-slate-100 text-slate-800 hover:bg-slate-200' ?> flex items-center justify-center transition shadow-xs" title="TikTok">
                            <i data-lucide="video" class="w-3.5 h-3.5"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($ownerPhone)): ?>
                    <div class="text-[11px] <?= $ft['subtext'] ?>">
                        হটলাইন: <strong class="<?= $ft['isDark'] ? 'text-white' : 'text-slate-800' ?>"><?= htmlspecialchars($ownerPhone) ?></strong>
                    </div>
                <?php endif; ?>

                <div class="pt-1">
                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-md text-[10px] font-bold <?= $ft['isDark'] ? 'bg-slate-800 text-emerald-400' : 'bg-emerald-50 text-emerald-700' ?>">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>১০০% নিরাপদ ডেলিভারি</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="border-t <?= $ft['isDark'] ? 'border-slate-800' : 'border-slate-100' ?> py-4 text-center text-[11px] <?= $ft['subtext'] ?>">
            &copy; <?= date('Y') ?> <strong><?= htmlspecialchars($storeName) ?></strong>. সর্বস্বত্ব সংরক্ষিত।
        </div>
    </footer>

    <!-- Global Cart Slide-in Drawer -->
    <?php require_once __DIR__ . '/cart_drawer.php'; ?>

    <!-- Global Order Tracking Modal -->
    <?php require_once __DIR__ . '/tracking_modal.php'; ?>

    <?php
    // Floating WhatsApp Button Resolution:
    // Priority: Socials WhatsApp -> fallback to Store Hotline phone
    $waRawNumber = !empty($socials['whatsapp']) ? trim((string)$socials['whatsapp']) : (!empty($ownerPhone) ? trim((string)$ownerPhone) : '');
    $floatingWaUrl = '';
    if (!empty($waRawNumber)) {
        if (str_starts_with($waRawNumber, 'http://') || str_starts_with($waRawNumber, 'https://')) {
            $floatingWaUrl = $waRawNumber;
        } else {
            $digits = preg_replace('/[^0-9]/', '', $waRawNumber);
            if (str_starts_with($digits, '01') && strlen($digits) === 11) {
                $digits = '88' . $digits;
            }
            if (!empty($digits)) {
                $floatingWaUrl = 'https://wa.me/' . $digits;
            }
        }
    }
    ?>
    <?php if (!empty($floatingWaUrl)): ?>
    <!-- Floating Fixed WhatsApp Chat Widget (Like Modern Business Websites) -->
    <aside aria-label="WhatsApp Support" class="fixed <?= !empty($isThemePreview) ? 'bottom-20' : 'bottom-6' ?> right-6 z-40 group print:hidden">
        <a href="<?= htmlspecialchars($floatingWaUrl) ?>" 
           target="_blank" 
           rel="noopener noreferrer" 
           aria-label="হোয়াটসঅ্যাপে চ্যাট করুন"
           class="relative flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-[0_8px_25px_rgba(37,211,102,0.45)] hover:shadow-[0_12px_32px_rgba(37,211,102,0.7)] hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-300/50">
            
            <!-- Live Pulse Ping Ring Effect -->
            <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-35 animate-ping pointer-events-none"></span>
            
            <!-- Official Crisp WhatsApp Vector Icon -->
            <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-current drop-shadow-sm transition-transform duration-300 group-hover:rotate-6" viewBox="0 0 24 24">
                <path d="M12.031 2C6.495 2 2 6.495 2 12.031c0 1.97.57 3.805 1.557 5.358L2 22l4.774-1.524A9.972 9.972 0 0 0 12.031 22C17.567 22 22 17.505 22 12.031 22 6.495 17.567 2 12.031 2zm0 18.286a8.23 8.23 0 0 1-4.223-1.164l-.303-.18-2.825.902.903-2.753-.197-.313a8.243 8.243 0 0 1-1.27-4.447c0-4.57 3.716-8.286 8.286-8.286 4.57 0 8.286 3.716 8.286 8.286 0 4.57-3.716 8.286-8.286 8.286zm4.536-6.205c-.249-.125-1.472-.727-1.7-.81-.228-.083-.394-.125-.56.125-.166.249-.643.81-.788.976-.145.166-.29.187-.539.062-.249-.125-1.05-.387-2-1.234-.738-.658-1.237-1.471-1.382-1.72-.145-.249-.015-.384.11-.508.112-.112.249-.29.373-.435.125-.145.166-.249.249-.415.083-.166.042-.311-.021-.435-.062-.125-.56-1.349-.768-1.847-.202-.486-.407-.42-.56-.428l-.477-.008c-.166 0-.435.062-.663.311-.228.249-.871.851-.871 2.075 0 1.224.892 2.407 1.016 2.573.125.166 1.756 2.682 4.254 3.761.594.257 1.058.41 1.42.525.597.19 1.14.163 1.57.099.479-.071 1.472-.602 1.68-1.183.207-.581.207-1.079.145-1.183-.062-.104-.228-.166-.477-.29z"/>
            </svg>

            <!-- Online Status Dot -->
            <span class="absolute top-1 right-1 flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-60"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-400 border-2 border-white"></span>
            </span>
        </a>

        <!-- Desktop Hover Tooltip -->
        <div class="pointer-events-none absolute right-full top-1/2 -translate-y-1/2 mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hidden sm:block">
            <div class="bg-slate-900 text-white text-xs font-bold py-1.5 px-3 rounded-xl shadow-xl whitespace-nowrap flex items-center space-x-1.5 border border-slate-700/60">
                <span>হোয়াটসঅ্যাপে চ্যাট করুন</span>
                <span class="text-emerald-400">&rarr;</span>
            </div>
        </div>
    </aside>
    <?php endif; ?>

    <?php if (!empty($isThemePreview)): ?>
        <!-- Floating Live Theme Preview Control Bar -->
        <div class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:right-6 sm:left-6 z-[99990] bg-slate-900/95 backdrop-blur-md text-white border border-brand-500/50 rounded-2xl px-4 py-3 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-3 text-xs">
            <div class="flex items-center space-x-3">
                <span class="px-2.5 py-1 rounded-lg bg-brand-600 text-white font-black text-[11px] flex items-center space-x-1">
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                    <span>লাইভ প্রিভিউ মোড</span>
                </span>
                <div>
                    <span class="text-slate-400">টেমপ্লেট:</span>
                    <strong class="text-white ml-1"><?= htmlspecialchars($activeTemplate['name_bn'] ?? '') ?> (#<?= (int)($activeTemplate['number'] ?? 1) ?>)</strong>
                    <span class="mx-2 text-slate-600">|</span>
                    <span class="text-slate-400">কালার প্যালেট:</span>
                    <strong class="text-brand-400 ml-1"><?= htmlspecialchars($activePalette['name_bn'] ?? '') ?></strong>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <!-- Quick Template Switcher in Preview -->
                <select onchange="window.location.href='?preview_template=' + this.value + '&preview_palette=<?= urlencode($paletteId) ?>'"
                    class="h-8 px-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-xs font-bold focus:outline-none focus:border-brand-500 cursor-pointer">
                    <?php foreach (($themeData['all_templates'] ?? []) as $tKey => $tItem): ?>
                        <option value="<?= htmlspecialchars($tKey) ?>" <?= $tKey === $templateId ? 'selected' : '' ?>>
                            #<?= (int)$tItem['number'] ?> - <?= htmlspecialchars($tItem['name_bn']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Quick Palette Switcher for Current Preview Template -->
                <select onchange="window.location.href='?preview_template=<?= urlencode($templateId) ?>&preview_palette=' + this.value"
                    class="h-8 px-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-xs font-bold focus:outline-none focus:border-brand-500 cursor-pointer">
                    <?php foreach (($activeTemplate['palettes'] ?? []) as $pKey): ?>
                        <?php $pObj = $themeData['all_palettes'][$pKey] ?? null; if (!$pObj) continue; ?>
                        <option value="<?= htmlspecialchars($pKey) ?>" <?= $pKey === $paletteId ? 'selected' : '' ?>>
                            🎨 <?= htmlspecialchars($pObj['name_bn']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <a href="./" class="h-8 px-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold flex items-center space-x-1 transition">
                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    <span>প্রিভিউ বন্ধ</span>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
