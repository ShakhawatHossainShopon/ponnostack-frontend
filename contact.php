<?php

/**
 * Client Storefront - Contact Us Page
 * 
 * Provides direct communication channels (Hotline, WhatsApp, Email, Physical Address),
 * realistic order and delivery assistance, return guidelines, and operating schedule.
 * Strictly zero dummy/mock forms.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$pageTitle = 'যোগাযোগ করুন | ' . htmlspecialchars($storeName);

// Dedicated Contact Us SEO
$seoTitle = 'যোগাযোগ করুন | ' . $storeName;
$seoDescription = $storeName . '-এর সাথে যোগাযোগ করুন। ফোন: ' . ($ownerPhone ?: 'হটলাইন') . ', ইমেইল: ' . $ownerEmail . '। যেকোনো অর্ডার বা তথ্যে আমরা সবসময় আপনার পাশে আছি।';
$seoKeywords = 'যোগাযোগ, কন্টাক্ট, ফোন নম্বর, কাস্টমার কেয়ার, ' . $storeName;

require_once __DIR__ . '/views/header.php';

// Prepare WhatsApp link
$waNumber = !empty($socials['whatsapp']) ? trim((string)$socials['whatsapp']) : (!empty($ownerPhone) ? trim((string)$ownerPhone) : '');
$waHref = '';
if (!empty($waNumber)) {
    if (str_starts_with($waNumber, 'http://') || str_starts_with($waNumber, 'https://')) {
        $waHref = $waNumber;
    } else {
        $cleanDigits = preg_replace('/[^0-9]/', '', $waNumber);
        if (str_starts_with($cleanDigits, '01') && strlen($cleanDigits) === 11) {
            $cleanDigits = '88' . $cleanDigits;
        }
        if (!empty($cleanDigits)) {
            $waHref = 'https://wa.me/' . $cleanDigits;
        }
    }
}
?>

<main class="max-w-6xl mx-auto px-4 py-6 sm:py-8 space-y-8 flex-1">

    <!-- Breadcrumbs -->
    <nav class="flex items-center space-x-2 text-xs font-medium text-slate-500" aria-label="Breadcrumb">
        <a href="./" class="hover:text-brand-600 transition flex items-center space-x-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i>
            <span>হোম</span>
        </a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
        <span class="text-slate-900 font-bold">যোগাযোগ</span>
    </nav>

    <!-- Header Banner -->
    <section class="p-6 sm:p-10 bg-gradient-to-r from-slate-900 via-slate-800 to-brand-950 text-white rounded-3xl shadow-sm relative overflow-hidden">
        <div class="relative z-10 max-w-xl space-y-3">
            <div class="inline-flex items-center space-x-1.5 px-3 py-1 bg-brand-500/20 text-brand-300 border border-brand-400/30 rounded-lg text-xs font-bold uppercase tracking-wider">
                <i data-lucide="headphones" class="w-3.5 h-3.5"></i>
                <span>সরাসরি কাস্টমার কেয়ার</span>
            </div>
            <h1 class="text-2xl sm:text-4xl font-black">যেকোনো তথ্যে আমরা সবসময় আপনার পাশে</h1>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                পণ্য, অর্ডার, ডেলিভারি বা এক্সচেঞ্জ সংক্রান্ত যেকোনো বিষয়ে আমাদের সাথে সরাসরি যোগাযোগ করুন। ফোন বা WhatsApp-এ আমরা দ্রুততম সময়ে সহায়তা প্রদান করি।
            </p>
        </div>
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>
    </section>

    <!-- 4 Direct Contact Channels Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- 1. Hotline Phone -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
            <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                <i data-lucide="phone-call" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">সরাসরি হটলাইন</span>
                <div class="text-sm font-black text-slate-900 font-mono mt-0.5">
                    <?= !empty($ownerPhone) ? htmlspecialchars($ownerPhone) : '01700-000000' ?>
                </div>
            </div>
            <?php if (!empty($ownerPhone)): ?>
                <a href="tel:<?= htmlspecialchars($ownerPhone) ?>" class="inline-flex items-center space-x-1 text-xs font-bold text-brand-600 hover:text-brand-700">
                    <span>কল করুন</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            <?php endif; ?>
        </div>

        <!-- 2. WhatsApp Support -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="message-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">WhatsApp চ্যাট</span>
                <div class="text-sm font-black text-slate-900 font-mono mt-0.5">তাৎক্ষণিক সহায়তা</div>
            </div>
            <?php if (!empty($waHref)): ?>
                <a href="<?= htmlspecialchars($waHref) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1 text-xs font-bold text-emerald-600 hover:text-emerald-700">
                    <span>WhatsApp মেসেজ পাঠান</span>
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                </a>
            <?php endif; ?>
        </div>

        <!-- 3. Email Support -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">অফিসিয়াল ইমেইল</span>
                <div class="text-xs font-bold text-slate-900 truncate mt-0.5" title="<?= htmlspecialchars($ownerEmail ?? '') ?>">
                    <?= !empty($ownerEmail) ? htmlspecialchars($ownerEmail) : 'support@example.com' ?>
                </div>
            </div>
            <?php if (!empty($ownerEmail)): ?>
                <a href="mailto:<?= htmlspecialchars($ownerEmail) ?>" class="inline-flex items-center space-x-1 text-xs font-bold text-blue-600 hover:text-blue-700">
                    <span>ইমেইল পাঠান</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            <?php endif; ?>
        </div>

        <!-- 4. Location / Address -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-2xs hover:shadow-md transition space-y-3">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="map-pin" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">শো-রুম ও অফিস</span>
                <div class="text-xs font-medium text-slate-700 line-clamp-2 mt-0.5 leading-relaxed">
                    <?= !empty($storeAddress) ? htmlspecialchars($storeAddress) : 'ঢাকা, বাংলাদেশ' ?>
                </div>
            </div>
            <span class="text-[10px] text-slate-400 font-bold">সকাল ৯টা – রাত ১০টা</span>
        </div>
    </section>

    <!-- Support Details & Guidelines (Authentic, Non-False Store Info) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left 2 Cols: Real Support & Policy Assistance -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Order & Delivery Assistance -->
            <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-2xs space-y-4">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">ডেলিভারি ও অর্ডার সহায়িকা</h2>
                        <span class="text-xs text-slate-500">আপনার অর্ডার দ্রুত ও নিরাপদে পৌঁছানোর তথ্য</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-slate-600 pt-2">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                        <div class="font-bold text-slate-900 flex items-center space-x-1.5">
                            <i data-lucide="clock" class="w-4 h-4 text-brand-600"></i>
                            <span>ডেলিভারি সময়সীমা</span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-slate-600">
                            ঢাকার অভ্যন্তরে ২৪ থেকে ৪৮ ঘণ্টার মধ্যে এবং ঢাকার বাইরে ২ থেকে ৩ কর্মদিবসের মধ্যে নির্ভরযোগ্য কুরিয়ার মাধ্যমে ডেলিভারি সম্পন্ন হয়।
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5">
                        <div class="font-bold text-slate-900 flex items-center space-x-1.5">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                            <span>হাতে পেয়ে যাচাইয়ের সুযোগ</span>
                        </div>
                        <p class="text-[11px] leading-relaxed text-slate-600">
                            ডেলিভারি ম্যানের সামনে পার্সেলটি দেখে বুঝে নিয়ে ক্যাশ অন ডেলিভারিতে সম্পূর্ণ নিশ্চিন্তে মূল্য পরিশোধ করতে পারবেন।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Return & Exchange Guidelines -->
            <div class="bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-2xs space-y-4">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">সহজ এক্সচেঞ্জ ও রিটার্ন পলিসি</h2>
                        <span class="text-xs text-slate-500">গ্রাহক সন্তুষ্টিই আমাদের মূল অগ্রাধিকার</span>
                    </div>
                </div>

                <div class="space-y-3 text-xs text-slate-600 pt-1">
                    <div class="flex items-start space-x-3">
                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[11px] font-black shrink-0 mt-0.5">১</div>
                        <div>
                            <strong class="text-slate-900 block">ত্রুটি বা সাইজ সমস্যা জানালে তাত্ক্ষণিক সমাধান:</strong>
                            <p class="text-[11px] text-slate-500 mt-0.5">পার্সেল রিসিভ করার ৩ দিনের মধ্যে যেকোনো ত্রুটি বা সাইজ অমিল হলে আমাদের হটলাইন বা WhatsApp-এ জানান।</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[11px] font-black shrink-0 mt-0.5">২</div>
                        <div>
                            <strong class="text-slate-900 block">অরিজিনাল প্যাকেজিং অক্ষুণ্ণ রাখা:</strong>
                            <p class="text-[11px] text-slate-500 mt-0.5">পণ্যটি অব্যবহৃত অবস্থায় মূল ট্যাগ ও প্যাকেজিংসহ সংরক্ষণ করুন, যাতে এক্সচেঞ্জ প্রক্রিয়া দ্রুত সম্পন্ন করা যায়।</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Direct Fast Action Card -->
            <div class="p-6 rounded-3xl bg-gradient-to-r from-brand-600 to-brand-700 text-white shadow-md flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left">
                    <h3 class="text-lg font-black">দ্রুত কোনো জিজ্ঞাসা আছে?</h3>
                    <p class="text-xs text-brand-100">আমাদের প্রতিনিধির সাথে সরাসরি কথা বলতে নিচের বাটন ব্যবহার করুন।</p>
                </div>
                <div class="flex items-center space-x-3 shrink-0">
                    <?php if (!empty($waHref)): ?>
                    <a href="<?= htmlspecialchars($waHref) ?>" target="_blank" rel="noopener noreferrer" 
                       class="px-4 py-2.5 rounded-xl bg-white text-emerald-700 hover:bg-emerald-50 font-black text-xs transition shadow-sm flex items-center space-x-1.5">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>WhatsApp চ্যাট</span>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($ownerPhone)): ?>
                    <a href="tel:<?= htmlspecialchars($ownerPhone) ?>" 
                       class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-black text-xs transition shadow-sm flex items-center space-x-1.5">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        <span>কল করুন</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Right 1 Col: Schedule & Storefront Profile -->
        <div class="space-y-4">
            
            <!-- Operating Hours Card -->
            <div class="bg-white border border-slate-200/90 rounded-3xl p-6 shadow-2xs space-y-4 text-xs">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-900">সার্ভিস ও কল সময়সূচী</h3>
                </div>
                
                <div class="space-y-2.5 text-slate-600 divide-y divide-slate-100">
                    <div class="flex items-center justify-between pt-2">
                        <span>শনিবার – বৃহস্পতিবার:</span>
                        <strong class="text-slate-800 font-mono">৯:০০ AM – ১০:০০ PM</strong>
                    </div>
                    <div class="flex items-center justify-between pt-2">
                        <span>শুক্রবার:</span>
                        <strong class="text-slate-800 font-mono">২:৩০ PM – ১০:০০ PM</strong>
                    </div>
                    <div class="flex items-center justify-between pt-2">
                        <span>অনলাইন অর্ডার:</span>
                        <strong class="text-emerald-600 font-bold">২৪ ঘণ্টা সচল</strong>
                    </div>
                </div>
            </div>

            <!-- Direct Verification & Order Tracking Card -->
            <div class="bg-white border border-slate-200/90 rounded-3xl p-6 shadow-2xs space-y-4 text-xs">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="package-search" class="w-4 h-4"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-900">অর্ডার ট্র্যাকিং</h3>
                </div>
                
                <p class="text-slate-600 leading-relaxed text-[11px]">
                    আপনার পূর্বে প্লেস করা অর্ডারের বর্তমান অবস্থা সরাসরি ট্র্যাক করতে পারবেন।
                </p>

                <button type="button" onclick="openOrderTrackingModal()" 
                        class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition flex items-center justify-center space-x-1.5 shadow-xs cursor-pointer">
                    <i data-lucide="map-pin" class="w-4 h-4 text-brand-400"></i>
                    <span>লাইভ পার্সেল ট্র্যাক করুন</span>
                </button>
            </div>

            <!-- Payment Security Badge -->
            <div class="p-5 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-2 text-xs">
                <div class="flex items-center space-x-2 text-slate-900 font-bold">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600"></i>
                    <span>১০০% নিরাপদ কেনাকাটা</span>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    ক্যাশ অন ডেলিভারি এবং যাচাইকৃত পেমেন্ট মেথড। কোনো আগাম ঝুঁকি ছাড়াই পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।
                </p>
            </div>

        </div>

    </div>

</main>

<?php require_once __DIR__ . '/views/footer.php'; ?>
