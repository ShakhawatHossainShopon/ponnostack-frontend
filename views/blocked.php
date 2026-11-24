<?php
/**
 * Ponnostack Client Storefront - Status & Subscription Gatekeeper Screen
 */

$monthlyFee = (float)($store['monthly_fee'] ?? 200.00);
$storeName  = $store['name'] ?? 'অনলাইন স্টোর';
$status     = strtolower($store['status'] ?? 'expired');
$logoUrl    = !empty($store['logo_url']) ? $store['logo_url'] : ApiClient::assetUrl($store['logo'] ?? null);

// Determine portal URL from config / .env
$portalUrl = ApiClient::getPortalUrl();

// Status Configuration
$statusConfig = [
    'setup_pending' => [
        'title' => 'স্টোর সেটআপ প্রক্রিয়াধীন রয়েছে (Setup in Progress)',
        'badge' => 'সেটআপ অপেক্ষমান',
        'badge_class' => 'bg-amber-100 text-amber-800 border-amber-200',
        'header_gradient' => 'from-amber-500 via-orange-500 to-amber-600',
        'icon' => 'clock',
        'desc' => 'আপনার স্টোরফ্রন্টটি সুপার অ্যাডমিনের প্রাথমিক কনফিগারেশন ও যাচাইয়ের জন্য অপেক্ষমান রয়েছে। সেটআপ সম্পন্ন হলে স্বয়ংক্রিয়ভাবে লাইভ হবে।',
        'show_bill_btn' => false,
        'btn_text' => 'কাস্টমার পোর্টালে যান →',
    ],
    'payment_pending' => [
        'title' => 'পেমেন্ট ভেরিফিকেশন বাকি রয়েছে (Payment Pending)',
        'badge' => 'পেমেন্ট অপেক্ষমান',
        'badge_class' => 'bg-blue-100 text-blue-800 border-blue-200',
        'header_gradient' => 'from-blue-600 via-indigo-600 to-blue-700',
        'icon' => 'credit-card',
        'desc' => 'আপনার সাবস্ক্রিপশন পেমেন্ট তথ্যটি যাচাই প্রক্রিয়ায় রয়েছে। সুপার অ্যাডমিন অনুমোদন করার সাথে সাথে স্টোরফ্রন্ট সচল হবে।',
        'show_bill_btn' => true,
        'btn_text' => 'ড্যাশবোর্ড পোর্টালে যান (Pay Bill) →',
    ],
    'suspended' => [
        'title' => 'ওয়েবসাইট সাময়িকভাবে স্থগিত আছে (Store Suspended)',
        'badge' => 'স্থগিত (SUSPENDED)',
        'badge_class' => 'bg-rose-100 text-rose-800 border-rose-200',
        'header_gradient' => 'from-rose-600 via-red-600 to-rose-700',
        'icon' => 'shield-alert',
        'desc' => 'প্রশাসনিক কারণে এই স্টোরফ্রন্টটি সাময়িকভাবে স্থগিত করা হয়েছে। পুনরায় সচল করতে সাপোর্ট টিম বা পোর্টালে যোগাযোগ করুন।',
        'show_bill_btn' => true,
        'btn_text' => 'সাপোর্ট পোর্টালে যোগাযোগ করুন →',
    ],
    'expired' => [
        'title' => 'সাবস্ক্রিপশনের মেয়াদ শেষ হয়েছে (Subscription Expired)',
        'badge' => 'মেয়াদ শেষ (EXPIRED)',
        'badge_class' => 'bg-rose-100 text-rose-800 border-rose-200',
        'header_gradient' => 'from-rose-500 via-pink-600 to-rose-600',
        'icon' => 'alert-octagon',
        'desc' => 'এই স্টোরফ্রন্টের মাসিক সাবস্ক্রিপশন ফি বকেয়া থাকায় ওয়েবসাইটটি সাময়িকভাবে বন্ধ আছে। পুনরায় সাইটটি চালু করতে বিল পরিশোধ করুন।',
        'show_bill_btn' => true,
        'btn_text' => 'ড্যাশবোর্ড পোর্টালে যান (Pay Bill) →',
    ],
    'inactive' => [
        'title' => 'স্টোরফ্রন্টটি বর্তমানে নিষ্ক্রিয় (Store Inactive)',
        'badge' => 'নিষ্ক্রিয় (INACTIVE)',
        'badge_class' => 'bg-slate-100 text-slate-800 border-slate-200',
        'header_gradient' => 'from-slate-700 via-slate-800 to-slate-900',
        'icon' => 'power',
        'desc' => 'এই স্টোরফ্রন্টটি বর্তমানে বন্ধ রাখা হয়েছে। পুনরায় চালু করতে স্টোর ওনারের পোর্টালে লগইন করুন।',
        'show_bill_btn' => true,
        'btn_text' => 'ড্যাশবোর্ড পোর্টালে যান →',
    ],
];

$currentConfig = $statusConfig[$status] ?? $statusConfig['expired'];
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($storeName) ?> | <?= htmlspecialchars($currentConfig['title']) ?></title>
    <!-- Google Fonts: Hind Siliguri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Hind Siliguri', -apple-system, sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="max-w-lg w-full bg-white border border-slate-200 rounded-3xl shadow-xl overflow-hidden my-6">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r <?= $currentConfig['header_gradient'] ?> p-6 sm:p-7 text-white text-center space-y-3">
            
            <!-- Store Logo -->
            <div class="inline-flex items-center justify-center mb-1">
                <?php if (!empty($logoUrl)): ?>
                    <img src="<?= htmlspecialchars($logoUrl) ?>" alt="<?= htmlspecialchars($storeName) ?>" class="w-16 h-16 rounded-2xl object-cover border-2 border-white/40 shadow-md bg-white">
                <?php else: ?>
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-xs flex items-center justify-center text-white text-2xl font-black shadow-inner border border-white/30">
                        <?= strtoupper(mb_substr($storeName, 0, 1, 'UTF-8')) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-xs text-white">
                <i data-lucide="<?= $currentConfig['icon'] ?>" class="w-4 h-4"></i>
                <span><?= htmlspecialchars($currentConfig['badge']) ?></span>
            </div>

            <h1 class="text-base sm:text-lg font-black tracking-tight leading-snug">
                <?= htmlspecialchars($currentConfig['title']) ?>
            </h1>
            <p class="text-xs sm:text-sm text-white/90 max-w-md mx-auto leading-relaxed">
                <?= htmlspecialchars($currentConfig['desc']) ?>
            </p>
        </div>

        <!-- Store Overview Details -->
        <div class="p-5 sm:p-6 bg-slate-50/70 border-b border-slate-100">
            <div class="grid grid-cols-2 gap-3 text-xs">
                
                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-[11px] text-slate-400 font-semibold block uppercase">স্টোরের নাম</span>
                    <strong class="text-slate-900 text-sm font-bold truncate block mt-0.5"><?= htmlspecialchars($storeName) ?></strong>
                </div>

                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-[11px] text-slate-400 font-semibold block uppercase">স্টোর ওনার</span>
                    <strong class="text-slate-900 text-sm font-bold truncate block mt-0.5"><?= htmlspecialchars($store['owner_name'] ?? 'Store Owner') ?></strong>
                </div>

                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-[11px] text-slate-400 font-semibold block uppercase">মাসিক সাবস্ক্রিপশন ফি</span>
                    <strong class="text-slate-900 text-sm font-bold block mt-0.5">৳ <?= number_format($monthlyFee) ?> / মাস</strong>
                </div>

                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-2xs">
                    <span class="text-[11px] text-slate-400 font-semibold block uppercase">প্যাকেজ</span>
                    <strong class="text-slate-900 text-sm font-bold block mt-0.5"><?= htmlspecialchars($store['package_name'] ?? 'স্ট্যান্ডার্ড প্যাকেজ') ?></strong>
                </div>

            </div>
        </div>

        <!-- Action Section: Direct Portal / Pay Bill Button -->
        <div class="p-6 text-center space-y-3">
            <a href="<?= htmlspecialchars($portalUrl) ?>"
               class="w-full inline-flex items-center justify-center space-x-2 py-3 px-6 bg-slate-900 hover:bg-black text-white text-xs sm:text-sm font-extrabold rounded-xl shadow-md hover:shadow-lg transition">
                <span><?= htmlspecialchars($currentConfig['btn_text']) ?></span>
            </a>

            <div class="text-[11px] text-slate-400">
                &copy; <?= date('Y') ?> <?= htmlspecialchars($storeName) ?> &bull; Powered by Ponnostack Headless SaaS
            </div>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
