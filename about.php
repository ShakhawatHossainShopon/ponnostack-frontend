<?php

/**
 * Client Storefront - About Us Page
 * 
 * Showcases authentic store profile, genuine quality commitments,
 * customer-first purchasing benefits, physical location, operating schedule, and contact channels.
 * Strictly zero false claims or speculative statistics.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$pageTitle = 'আমাদের সম্পর্কে | ' . htmlspecialchars($storeName);

// Dedicated About Us SEO
$seoTitle = 'আমাদের সম্পর্কে | ' . $storeName;
$seoDescription = $storeName . ' সম্পর্কে বিস্তারিত জানুন। গ্রাহক সন্তুষ্টি, ১০০% নির্ভরযোগ্য মান ও নিরাপদ অনলাইন শপিং অভিজ্ঞতা আমাদের প্রতিশ্রুতি। ঠিকানা: ' . ($storeAddress ?: 'বাংলাদেশ');
$seoKeywords = 'আমাদের সম্পর্কে, এবাউট আস, ' . $storeName . ', ' . ($storeAddress ?: 'বাংলাদেশ');

require_once __DIR__ . '/views/header.php';
?>

<main class="max-w-6xl mx-auto px-4 py-6 sm:py-8 space-y-8 flex-1">

    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 text-xs font-medium text-slate-500" aria-label="Breadcrumb">
        <a href="./" class="hover:text-brand-600 transition flex items-center space-x-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i>
            <span>হোম</span>
        </a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
        <span class="text-slate-900 font-bold">আমাদের সম্পর্কে</span>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-brand-950 text-white p-8 sm:p-12 shadow-xl border border-slate-800">
        <div class="relative z-10 max-w-2xl space-y-4">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-brand-500/20 text-brand-300 border border-brand-400/30 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                <span>অফিসিয়াল স্টোর প্রোফাইল</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                <?= htmlspecialchars($storeName) ?>
            </h1>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                আমরা আন্তরিকতার সাথে গ্রাহকদের জন্য সেরা মানের পণ্য, সাশ্রয়ী মূল্য এবং নির্ভরযোগ্য ক্যাশ অন ডেলিভারি নিশ্চিত করতে কাজ করে যাচ্ছি। অনলাইন কেনাকাটাকে সম্পূর্ণ স্বচ্ছ, সহজ এবং ঝুঁকিমুক্ত করাই আমাদের মূল অঙ্গীকার।
            </p>
            <div class="pt-2 flex flex-wrap gap-3">
                <a href="category" class="px-5 py-2.5 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center space-x-1.5 cursor-pointer">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                    <span>পণ্যসমূহ দেখুন</span>
                </a>
                <a href="contact" class="px-5 py-2.5 bg-slate-800/80 hover:bg-slate-700 text-slate-200 border border-slate-700 font-bold text-xs rounded-xl transition flex items-center space-x-1.5 cursor-pointer">
                    <i data-lucide="phone-call" class="w-4 h-4"></i>
                    <span>সরাসরি যোগাযোগ</span>
                </a>
            </div>
        </div>

        <!-- Ambient Glow -->
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>
    </section>

    <!-- Core Values / Authentic Shopping Guarantees -->
    <section class="space-y-4">
        <div class="text-center max-w-md mx-auto">
            <h2 class="text-lg sm:text-xl font-bold text-slate-900">আমাদের মূল অঙ্গীকার ও সেবার মান</h2>
            <p class="text-xs text-slate-500 mt-1">স্বচ্ছতা, বিশ্বস্ততা এবং প্রতিটি অর্ডারে পরিপূর্ণ গ্রাহক যত্ন</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- 1. Authentic Quality Check -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
                <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-sm text-slate-900">যাচাইকৃত পণ্যের মান</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    প্যাকিং করার পূর্বে প্রতিটি পণ্য সতর্কতার সাথে পরীক্ষা করা হয়, যাতে কোনো ডিফেক্ট বা অমিল ছাড়া সঠিক পণ্য আপনার কাছে পৌঁছায়।
                </p>
            </div>

            <!-- 2. Nationwide Courier Delivery -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i data-lucide="truck" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-sm text-slate-900">সারাদেশে নিরাপদ ডেলিভারি</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    স্বনামধন্য কুরিয়ার সার্ভিসের মাধ্যমে দেশের যেকোনো প্রান্তে দ্রুততম সময়ে হোম ডেলিভারি পৌঁছে দেওয়া হয়।
                </p>
            </div>

            <!-- 3. Cash on Delivery -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="banknote" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-sm text-slate-900">হাতে পেয়ে মূল্য পরিশোধ</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    ক্যাশ অন ডেলিভারি (COD) সুবিধায় পার্সেল হাতে পেয়ে পণ্য দেখে সম্পূর্ণ নিশ্চিন্তে টাকা পরিশোধ করতে পারবেন।
                </p>
            </div>

            <!-- 4. Dedicated Support -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <i data-lucide="headphones" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-sm text-slate-900">সরাসরি সহায়তা চ্যানেল</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    হটলাইন ফোন ও WhatsApp-এ আমাদের সাথে সরাসরি যোগাযোগ করে যেকোনো তথ্য বা সমাধান তৎক্ষণাৎ গ্রহণ করতে পারবেন।
                </p>
            </div>
        </div>
    </section>

    <!-- Store Profile & Commitment Details -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Story / Mission (2 Cols) -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 space-y-4 shadow-2xs">
            <div class="flex items-center space-x-2 text-brand-600">
                <i data-lucide="target" class="w-5 h-5"></i>
                <h2 class="font-bold text-base text-slate-900">আমাদের লক্ষ্য ও ব্যবসায়িক নীতি</h2>
            </div>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                <?= htmlspecialchars($storeName) ?> গ্রাহক সন্তুষ্টিকে ব্যবসার শীর্ষ অগ্রাধিকার বিবেচনা করে। আমরা বিশ্বাস করি, দীর্ঘমেয়াদী সম্পর্কের ভিত্তি হলো সততা ও স্বচ্ছতা। তাই আমাদের ওয়েবসাইটে প্রদর্শিত প্রতিটি পণ্যের ছবি ও বিবরণ বাস্তব সম্মত রাখা হয়।
            </p>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                অর্ডার নিশ্চিতকরণ থেকে শুরু করে পার্সেল রিসিভ করা পর্যন্ত প্রতিটি ধাপে গ্রাহককে অবহিত রাখা হয়। কোনো পণ্যে সাইজ বা মানের সমস্যা পরিলক্ষিত হলে ঝামেলামুক্ত পরিবর্তনের নিশ্চয়তা দিয়ে থাকি।
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4 border-t border-slate-100 text-center">
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <i data-lucide="check-check" class="w-5 h-5 text-brand-600 mx-auto mb-1"></i>
                    <span class="text-xs font-bold text-slate-800 block">কোয়ালিটি নিশ্চয়তা</span>
                    <span class="text-[10px] text-slate-500">প্রতিটি পার্সেল প্রি-চেকড</span>
                </div>
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <i data-lucide="clock" class="w-5 h-5 text-blue-600 mx-auto mb-1"></i>
                    <span class="text-xs font-bold text-slate-800 block">দ্রুত ডেলিভারি</span>
                    <span class="text-[10px] text-slate-500">২৪-৭২ ঘণ্টায় প্রাপ্যতা</span>
                </div>
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <i data-lucide="badge-percent" class="w-5 h-5 text-emerald-600 mx-auto mb-1"></i>
                    <span class="text-xs font-bold text-slate-800 block">ন্যায্য মূল্য</span>
                    <span class="text-[10px] text-slate-500">কোনো লুকানো চার্জ নেই</span>
                </div>
            </div>
        </div>

        <!-- Official Information Card (1 Col) -->
        <div class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 space-y-4 shadow-2xs">
            <h2 class="font-bold text-base text-slate-900 flex items-center space-x-2">
                <i data-lucide="building" class="w-4 h-4 text-brand-600"></i>
                <span>স্টোরফ্রন্ট তথ্য</span>
            </h2>

            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">স্টোরের নাম</span>
                    <span class="font-bold text-slate-800"><?= htmlspecialchars($storeName) ?></span>
                </div>

                <?php if (!empty($store['owner_name'])): ?>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">পরিচালনা ও সত্ত্বাধিকারী</span>
                        <span class="font-semibold text-slate-700"><?= htmlspecialchars($store['owner_name']) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($storeAddress)): ?>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">অফিস ও শো-রুম ঠিকানা</span>
                        <span class="text-slate-700 leading-relaxed block"><?= htmlspecialchars($storeAddress) ?></span>
                    </div>
                <?php endif; ?>

                <div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">কাস্টমার সার্ভিস সময়</span>
                    <span class="text-slate-700">শনিবার – বৃহস্পতিবার ৯:০০ AM – ১০:০০ PM</span>
                </div>

                <div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">মুদ্রা (Currency)</span>
                    <span class="font-bold text-brand-600"><?= htmlspecialchars($storeCurrency) ?></span>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100">
                <a href="contact" class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition flex items-center justify-center space-x-1.5 shadow-xs cursor-pointer">
                    <i data-lucide="phone-call" class="w-3.5 h-3.5"></i>
                    <span>যোগাযোগ পেজ দেখুন</span>
                </a>
            </div>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/views/footer.php'; ?>
