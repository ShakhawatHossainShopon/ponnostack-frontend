<?php
// Core SEO Resolution Engine for Client Storefront
$currentProtocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$currentHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
$currentUri = $_SERVER['REQUEST_URI'] ?? '';
$currentScript = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
$storeBaseDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$storeBaseUrl = $currentProtocol . $currentHost . $storeBaseDir;
$currentFullUrl = $currentProtocol . $currentHost . $currentUri;

// 1. Title Resolution
$resolvedSeoTitle = !empty($seoTitle) ? $seoTitle : ($pageTitle ?? ($storeName . ' | অফিসিয়াল অনলাইন শপ'));

// 2. Description Resolution
if (!empty($seoDescription)) {
    $resolvedSeoDesc = $seoDescription;
} elseif (isset($product) && is_array($product)) {
    $rawPDesc = trim(strip_tags((string)($product['description'] ?? '')));
    $resolvedSeoDesc = !empty($rawPDesc) 
        ? (mb_substr($rawPDesc, 0, 155, 'UTF-8') . (mb_strlen($rawPDesc, 'UTF-8') > 155 ? '...' : '')) 
        : ($product['name'] . ' কিনুন ' . $storeName . ' থেকে সেরা মূল্যে। ক্যাশ অন ডেলিভারি ও দ্রুততম হোম ডেলিভারি।');
} elseif (isset($activeCat) && is_array($activeCat)) {
    $resolvedSeoDesc = $activeCat['name'] . ' ক্যাটাগরির সেরা পণ্যসমূহ কিনুন ' . $storeName . ' থেকে। বিকাশ ও ক্যাশ অন ডেলিভারি রেডি।';
} elseif ($currentScript === 'discount.php') {
    $resolvedSeoDesc = $storeName . '-এর আকর্ষণীয় ডিসকাউন্ট ও বিশেষ অফারসমূহ। সেরা মূল্যে পছন্দের পণ্য কিনুন ঘরে বসেই।';
} elseif ($currentScript === 'about.php') {
    $resolvedSeoDesc = $storeName . ' সম্পর্কে জানুন। ১০০% অথেনটিক পণ্য ও গ্রাহক সন্তুষ্টি আমাদের মূল অঙ্গীকার। ঠিকানা: ' . ($storeAddress ?: 'বাংলাদেশ');
} elseif ($currentScript === 'contact.php') {
    $resolvedSeoDesc = $storeName . '-এর সাথে যোগাযোগ করুন। ফোন: ' . ($ownerPhone ?: 'হটলাইন') . ', ইমেইল: ' . $ownerEmail;
} elseif ($currentScript === 'checkout.php') {
    $resolvedSeoDesc = 'আপনার পছন্দের পণ্যগুলোর নিরাপদ চেকআউট ও অর্ডার সম্পন্ন করুন ' . $storeName . '-এ।';
} else {
    $resolvedSeoDesc = 'স্বাগতম ' . $storeName . '-এ! সেরা মানের পোশাক, ফ্যাশন ও প্রয়োজনীয় পণ্য কিনুন সাশ্রয়ী মূল্যে। ক্যাশ অন ডেলিভারি ও ফাস্ট হোম ডেলিভারি।';
}

// 3. Keywords Resolution
if (!empty($seoKeywords)) {
    $resolvedSeoKeywords = $seoKeywords;
} else {
    $resolvedSeoKeywords = $storeName . ', অনলাইন শপিং, কেনাকাটা, ই-কমার্স শপ, buy online bangladesh, cash on delivery';
    if (isset($product['name'])) $resolvedSeoKeywords .= ', ' . $product['name'];
    if (isset($activeCat['name'])) $resolvedSeoKeywords .= ', ' . $activeCat['name'];
}

// 4. Image Resolution (for OG and Twitter)
if (!empty($seoImage)) {
    $resolvedSeoImg = $seoImage;
} elseif (isset($product) && is_array($product)) {
    $resolvedSeoImg = $product['primary_image_url'] ?? (!empty($product['image_url']) ? $product['image_url'] : ApiClient::assetUrl($product['primary_image'] ?? $product['images'][0] ?? $product['image'] ?? null));
} elseif (!empty($logoUrl)) {
    $resolvedSeoImg = $logoUrl;
} elseif (!empty($storeBanners[0])) {
    $resolvedSeoImg = $storeBanners[0];
} else {
    $resolvedSeoImg = $storeBaseUrl . '/assets/logo.png';
}

// 5. Robots Tag
$resolvedSeoRobots = !empty($seoRobots) 
    ? $seoRobots 
    : ($currentScript === 'checkout.php' ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');

// 6. Canonical URL
if (!empty($seoCanonical)) {
    $resolvedSeoCanonical = $seoCanonical;
} else {
    // Build clean canonical URL without internal tracking/debug query params (e.g. ?store=)
    $cleanPath = explode('?', $currentUri)[0];
    $cleanQuery = [];
    if (!empty($_GET['page'])) $cleanQuery['page'] = (int)$_GET['page'];
    if (!empty($_GET['cat']))  $cleanQuery['cat'] = trim((string)$_GET['cat']);
    if (!empty($_GET['slug'])) $cleanQuery['slug'] = trim((string)$_GET['slug']);
    if (!empty($_GET['q']))    $cleanQuery['q'] = trim((string)$_GET['q']);
    $queryString = !empty($cleanQuery) ? ('?' . http_build_query($cleanQuery)) : '';
    $resolvedSeoCanonical = $currentProtocol . $currentHost . $cleanPath . $queryString;
}

// 7. OG Type
$resolvedSeoType = !empty($seoType) ? $seoType : (isset($product) ? 'product' : 'website');
?>
<!DOCTYPE html>
<html lang="bn" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- PRIMARY E-COMMERCE SEO TITLE & META -->
    <title><?= htmlspecialchars($resolvedSeoTitle) ?></title>
    <meta name="title" content="<?= htmlspecialchars($resolvedSeoTitle) ?>">
    <meta name="description" content="<?= htmlspecialchars($resolvedSeoDesc) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($resolvedSeoKeywords) ?>">
    <meta name="robots" content="<?= htmlspecialchars($resolvedSeoRobots) ?>">
    <meta name="googlebot" content="<?= htmlspecialchars($resolvedSeoRobots) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($resolvedSeoCanonical) ?>">
    
    <!-- AUTHOR & LOCALIZATION -->
    <meta name="author" content="<?= htmlspecialchars($storeName) ?>">
    <meta name="publisher" content="<?= htmlspecialchars($storeName) ?>">
    <meta name="application-name" content="<?= htmlspecialchars($storeName) ?>">
    <meta name="apple-mobile-web-app-title" content="<?= htmlspecialchars($storeName) ?>">
    <meta name="geo.region" content="BD">
    <meta name="language" content="Bengali, English">
    
    <!-- OPEN GRAPH (FACEBOOK, LINKEDIN, WHATSAPP, TELEGRAM) -->
    <meta property="og:type" content="<?= htmlspecialchars($resolvedSeoType) ?>">
    <meta property="og:locale" content="bn_BD">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:site_name" content="<?= htmlspecialchars($storeName) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($resolvedSeoTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($resolvedSeoDesc) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($resolvedSeoCanonical) ?>">
    <?php if (!empty($resolvedSeoImg)): ?>
        <meta property="og:image" content="<?= htmlspecialchars($resolvedSeoImg) ?>">
        <meta property="og:image:secure_url" content="<?= htmlspecialchars($resolvedSeoImg) ?>">
        <meta property="og:image:alt" content="<?= htmlspecialchars($resolvedSeoTitle) ?>">
    <?php endif; ?>
    
    <!-- TWITTER CARDS -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($resolvedSeoTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($resolvedSeoDesc) ?>">
    <?php if (!empty($resolvedSeoImg)): ?>
        <meta name="twitter:image" content="<?= htmlspecialchars($resolvedSeoImg) ?>">
        <meta name="twitter:image:alt" content="<?= htmlspecialchars($resolvedSeoTitle) ?>">
    <?php endif; ?>

    <!-- SCHEMA.ORG JSON-LD STRUCTURED DATA -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "WebSite",
          "@id": "<?= htmlspecialchars($storeBaseUrl) ?>/#website",
          "url": "<?= htmlspecialchars($storeBaseUrl) ?>/",
          "name": "<?= addslashes($storeName) ?>",
          "alternateName": "<?= addslashes($storeSlug) ?>",
          "inLanguage": "bn-BD",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "<?= htmlspecialchars($storeBaseUrl) ?>/?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        },
        {
          "@type": "OnlineStore",
          "@id": "<?= htmlspecialchars($storeBaseUrl) ?>/#store",
          "name": "<?= addslashes($storeName) ?>",
          "url": "<?= htmlspecialchars($storeBaseUrl) ?>/",
          <?php if (!empty($logoUrl)): ?>
          "logo": {
            "@type": "ImageObject",
            "url": "<?= htmlspecialchars($logoUrl) ?>"
          },
          <?php endif; ?>
          <?php if (!empty($ownerPhone)): ?>
          "telephone": "<?= addslashes($ownerPhone) ?>",
          <?php endif; ?>
          <?php if (!empty($ownerEmail)): ?>
          "email": "<?= addslashes($ownerEmail) ?>",
          <?php endif; ?>
          <?php if (!empty($storeAddress)): ?>
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= addslashes($storeAddress) ?>",
            "addressCountry": "BD"
          },
          <?php endif; ?>
          "priceRange": "$$",
          "sameAs": <?= json_encode(array_values(array_filter([
              $socials['facebook'] ?? null,
              $socials['instagram'] ?? null,
              $socials['youtube'] ?? null,
              $socials['tiktok'] ?? null,
              !empty($socials['whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $socials['whatsapp']) : null
          ]))) ?>
        }
        <?php if (isset($product) && is_array($product)): ?>
        ,{
          "@type": "Product",
          "@id": "<?= htmlspecialchars($currentFullUrl) ?>/#product",
          "name": "<?= addslashes($product['name']) ?>",
          <?php if (!empty($resolvedSeoImg)): ?>
          "image": ["<?= htmlspecialchars($resolvedSeoImg) ?>"],
          <?php endif; ?>
          "description": "<?= addslashes(mb_substr(strip_tags((string)($product['description'] ?? $product['name'])), 0, 300, 'UTF-8')) ?>",
          "sku": "<?= addslashes((string)($product['sku'] ?? $product['uuid'] ?? 'PROD')) ?>",
          "brand": {
            "@type": "Brand",
            "name": "<?= addslashes($storeName) ?>"
          },
          "offers": {
            "@type": "Offer",
            "url": "<?= htmlspecialchars($currentFullUrl) ?>",
            "priceCurrency": "<?= addslashes($storeCurrency) ?>",
            "price": "<?= (float)($product['effective_price'] ?? $product['retailer_price'] ?? $product['sale_price'] ?? $product['price'] ?? 0) ?>",
            "priceValidUntil": "<?= date('Y-12-31') ?>",
            "itemCondition": "https://schema.org/NewCondition",
            "availability": "<?= (!isset($product['stock']) || (int)$product['stock'] > 0) ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' ?>",
            "seller": {
              "@type": "Organization",
              "name": "<?= addslashes($storeName) ?>"
            }
          }
        }
        <?php endif; ?>
        <?php if (!empty($displayProducts) && is_array($displayProducts)): ?>
        ,{
          "@type": "ItemList",
          "name": "<?= addslashes($resolvedSeoTitle) ?>",
          "numberOfItems": <?= min(count($displayProducts), 12) ?>,
          "itemListElement": [
            <?php
            $items = array_slice($displayProducts, 0, 12);
            $itemSchemas = [];
            foreach ($items as $idx => $it) {
                $pUrl = $storeBaseUrl . '/product/' . ($it['slug'] ?? $it['uuid']);
                $pImg = $it['primary_image_url'] ?? (!empty($it['image_url']) ? $it['image_url'] : ApiClient::assetUrl($it['primary_image'] ?? $it['images'][0] ?? $it['image'] ?? null));
                $pPrice = (float)($it['effective_price'] ?? $it['retailer_price'] ?? $it['sale_price'] ?? $it['price'] ?? 0);
                $itemSchemas[] = json_encode([
                    '@type' => 'ListItem',
                    'position' => $idx + 1,
                    'item' => [
                        '@type' => 'Product',
                        'name' => $it['name'],
                        'url' => $pUrl,
                        'image' => $pImg,
                        'offers' => [
                            '@type' => 'Offer',
                            'price' => $pPrice,
                            'priceCurrency' => $storeCurrency
                        ]
                    ]
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
            echo implode(",\n            ", $itemSchemas);
            ?>
          ]
        }
        <?php endif; ?>
      ]
    }
    </script>

    <?php if (!empty($logoUrl)): ?>
        <link rel="icon" href="<?= htmlspecialchars($logoUrl) ?>">
        <link rel="shortcut icon" href="<?= htmlspecialchars($logoUrl) ?>">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars($logoUrl) ?>">
    <?php else: ?>
        <link rel="icon" type="image/png" sizes="32x32" href="<?= htmlspecialchars($clientBasePath) ?>/assets/favicon.png">
        <link rel="shortcut icon" href="<?= htmlspecialchars($clientBasePath) ?>/assets/favicon.png">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars($clientBasePath) ?>/assets/logo.png">
    <?php endif; ?>
    
    <!-- Dynamic Google Fonts for Active Template -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= htmlspecialchars($activeTemplate['font_url'] ?? 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap') ?>" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: <?= json_encode($brandShades ?? [
                            50 => '#fff7ed', 100 => '#ffedd5', 200 => '#fed7aa', 300 => '#fdba74', 400 => '#fb923c',
                            500 => '#f97316', 600 => '#ea580c', 700 => '#c2410c', 800 => '#9a3412', 900 => '#7c2d12'
                        ]) ?>
                    }
                }
            }
        }
    </script>
    <style id="dynamicThemePaletteStyles">
        <?= renderThemePaletteCss($brandShades ?? []) ?>
    </style>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- GSAP (GreenSock Animation Platform) for Smooth UI/UX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <!-- Toastify JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Universal Toast Engine (Zero Swal) -->
    <script>
        window.Toast = {
            show: function(msg, type = 'info') {
                const colors = {
                    success: 'linear-gradient(135deg, #059669 0%, #10b981 100%)',
                    error: 'linear-gradient(135deg, #dc2626 0%, #ef4444 100%)',
                    warning: 'linear-gradient(135deg, #d97706 0%, #f59e0b 100%)',
                    info: 'linear-gradient(135deg, #2563eb 0%, #3b82f6 100%)'
                };
                if (typeof Toastify === 'function') {
                    Toastify({
                        text: msg,
                        duration: 3200,
                        gravity: 'top',
                        position: 'right',
                        stopOnFocus: true,
                        style: {
                            background: colors[type] || colors.info,
                            borderRadius: '12px',
                            fontSize: '13px',
                            fontWeight: '600',
                            boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.2)',
                            padding: '12px 20px',
                            color: '#ffffff'
                        }
                    }).showToast();
                } else {
                    alert(msg);
                }
            },
            success: function(msg) { this.show(msg, 'success'); },
            error: function(msg) { this.show(msg, 'error'); },
            warning: function(msg) { this.show(msg, 'warning'); },
            info: function(msg) { this.show(msg, 'info'); }
        };

        // Complete override: Swal will never open
        window.Swal = {
            fire: function(opts) {
                let msg = typeof opts === 'string' ? opts : (opts.text || opts.title || '');
                let icon = opts.icon || 'info';
                if (opts.title && opts.text) {
                    msg = opts.title + ' — ' + opts.text;
                }
                if (icon === 'success') Toast.success(msg);
                else if (icon === 'error') Toast.error(msg);
                else if (icon === 'warning') Toast.warning(msg);
                else Toast.info(msg);
                return Promise.resolve({ isConfirmed: true, value: true });
            }
        };
    </script>

    <!-- StoreApi Client -->
    <script src="<?= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') ?>/assets/js/api.js?v=2"></script>
    <script>
        if (typeof StoreApi !== 'undefined') {
            window.StoreApi = StoreApi;
            StoreApi.init({
                apiUrl: '<?= htmlspecialchars(ApiClient::getApiUrl()) ?>',
                storeUuid: '<?= htmlspecialchars(ApiClient::getStoreUuid()) ?>'
            });
        }
    </script>
    
    <style>
        body { font-family: <?= $activeTemplate['font_family'] ?? "'Hind Siliguri', -apple-system, sans-serif" ?>; }
        
        /* Shimmer Skeleton Animation */
        @keyframes shimmerPulse {
            0% { opacity: 0.55; }
            50% { opacity: 1; }
            100% { opacity: 0.55; }
        }
        .skeleton-shimmer {
            animation: shimmerPulse 1.4s ease-in-out infinite;
        }

        /* Smooth Page Entrance (Opacity only to keep fixed position viewports intact) */
        @keyframes pageFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .page-smooth-entrance {
            animation: pageFadeIn 0.2s ease-out forwards;
        }

        /* Guarantee header links and buttons are always solid, visible and interactive */
        #mainStoreHeader, #mainStoreHeader nav, #mainStoreHeader nav a, #mainStoreHeader button {
            opacity: 1 !important;
            visibility: visible !important;
        }

        /* Product cards default visibility resilience */
        .product-item-card, .product-card {
            visibility: visible;
        }
    </style>
    <script>
        function showTopLoader() {
            const bar = $('#topLoadingBar');
            bar.removeClass('opacity-0');
            if (window.gsap) {
                gsap.to(bar[0], { width: '70%', duration: 0.35, ease: 'power2.out' });
            } else {
                bar.css('width', '70%');
            }
        }
        function hideTopLoader() {
            const bar = $('#topLoadingBar');
            if (window.gsap) {
                gsap.to(bar[0], { 
                    width: '100%', 
                    duration: 0.25, 
                    ease: 'power2.inOut',
                    onComplete: function() {
                        gsap.to(bar[0], { opacity: 0, duration: 0.2, onComplete: () => { bar.css('width', '0%'); } });
                    }
                });
            } else {
                bar.css('width', '100%');
                setTimeout(() => {
                    bar.addClass('opacity-0');
                    setTimeout(() => bar.css('width', '0%'), 250);
                }, 180);
            }
        }

        // Global Reusable Product Skeleton Generator
        window.getProductSkeletonHtml = function(count = 4) {
            let html = '';
            for (let i = 0; i < count; i++) {
                html += `
                <div class="product-skeleton-card bg-white border border-slate-200/90 rounded-2xl p-3 sm:p-3.5 flex flex-col justify-between space-y-3 animate-pulse shadow-2xs">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="h-3.5 w-16 bg-slate-200 rounded-md"></div>
                            <div class="h-3.5 w-12 bg-slate-100 rounded-md"></div>
                        </div>
                        <div class="aspect-square bg-slate-200/80 rounded-xl mb-2.5 w-full flex items-center justify-center">
                            <div class="w-8 h-8 rounded-full bg-slate-300/60"></div>
                        </div>
                        <div class="space-y-1.5">
                            <div class="h-4 bg-slate-200 rounded-md w-4/5"></div>
                            <div class="h-3 bg-slate-100 rounded-md w-3/5"></div>
                        </div>
                        <div class="h-2.5 w-14 bg-slate-100 rounded mt-2"></div>
                    </div>
                    <div class="pt-2 border-t border-slate-100 flex flex-col gap-1.5">
                        <div class="flex items-baseline space-x-2">
                            <div class="h-4 w-16 bg-slate-200 rounded"></div>
                            <div class="h-3 w-10 bg-slate-100 rounded"></div>
                        </div>
                        <div class="h-8 w-full bg-slate-200 rounded-xl"></div>
                    </div>
                </div>`;
            }
            return html;
        };
        function showToast(message, type = 'success') {
            const bgGradients = {
                success: 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                info: 'linear-gradient(135deg, #ea580c 0%, #c2410c 100%)',
                error: 'linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)',
                warning: 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'
            };
            if (window.Toastify) {
                Toastify({
                    text: message,
                    duration: 2500,
                    gravity: 'bottom',
                    position: 'right',
                    stopOnFocus: true,
                    style: {
                        background: bgGradients[type] || bgGradients.success,
                        borderRadius: '12px',
                        fontSize: '12px',
                        fontWeight: '700',
                        boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.15)',
                        padding: '10px 18px'
                    }
                }).showToast();
            }
        }
        $(document).ready(function() {
            showTopLoader();
            setTimeout(hideTopLoader, 300);

            // GSAP Enhanced Smooth Micro-Interactions (Header is kept 100% visible immediately, zero hiding)
            if (window.gsap) {
                // Hero Carousel Smooth Entrance
                if ($('#heroCarouselTrack').length) {
                    gsap.from('#heroCarouselTrack', {
                        opacity: 0,
                        scale: 0.98,
                        duration: 0.6,
                        ease: 'power3.out'
                    });
                }

                // Category Pills Stagger
                if ($('.no-scrollbar a').length) {
                    gsap.from('.no-scrollbar a', {
                        opacity: 0,
                        x: 20,
                        stagger: 0.035,
                        duration: 0.4,
                        ease: 'power2.out',
                        delay: 0.15
                    });
                }

                // Product Cards Staggered Reveal
                if ($('#catalog .grid > *').length) {
                    gsap.from('#catalog .grid > *', {
                        opacity: 0,
                        y: 25,
                        stagger: 0.05,
                        duration: 0.5,
                        ease: 'power2.out',
                        clearProps: 'transform,opacity',
                        delay: 0.2
                    });
                }

                // Product Card Subtle Hover Physics
                $(document).on('mouseenter', '#catalog .grid > *, .product-card', function() {
                    gsap.to(this, { y: -5, duration: 0.25, ease: 'power2.out' });
                }).on('mouseleave', '#catalog .grid > *, .product-card', function() {
                    gsap.to(this, { y: 0, duration: 0.25, ease: 'power2.out' });
                });
            }
        });
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col justify-between antialiased">

    <!-- Top Slim Progress Bar -->
    <div id="topLoadingBar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-brand-500 via-brand-400 to-brand-600 z-[99999] transition-all duration-300 ease-out w-0 opacity-0 pointer-events-none"></div>

    <!-- 1. UPPER NAVBAR (TOP BAR WITH CONTACT & SOCIAL MEDIA LINKS) -->
    <div class="bg-slate-900 text-slate-300 text-[11px] sm:text-xs py-1.5 sm:py-2">
        <div class="max-w-6xl mx-auto px-3 sm:px-4 flex flex-row items-center justify-between gap-2">
            
            <!-- Left: Contact & Address info -->
            <div class="flex items-center space-x-2 sm:space-x-4 min-w-0">
                <?php if (!empty($ownerPhone)): ?>
                    <a href="tel:<?= htmlspecialchars($ownerPhone) ?>" class="flex items-center space-x-1 sm:space-x-1.5 hover:text-white transition truncate">
                        <i data-lucide="phone" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-brand-400 shrink-0"></i>
                        <span class="truncate"><?= htmlspecialchars($ownerPhone) ?></span>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($ownerEmail)): ?>
                    <a href="mailto:<?= htmlspecialchars($ownerEmail) ?>" class="hidden md:flex items-center space-x-1.5 hover:text-white transition">
                        <i data-lucide="mail" class="w-3.5 h-3.5 text-brand-400"></i>
                        <span><?= htmlspecialchars($ownerEmail) ?></span>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($storeAddress)): ?>
                    <span class="hidden lg:flex items-center space-x-1.5 text-slate-400">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span class="truncate max-w-xs"><?= htmlspecialchars($storeAddress) ?></span>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Right: Dynamic Social Media Links -->
            <div class="flex items-center space-x-1.5 sm:space-x-2 shrink-0">
                <?php 
                $hasHeaderSocials = !empty($socials['facebook']) || !empty($socials['instagram']) || !empty($socials['whatsapp']) || !empty($socials['youtube']) || !empty($socials['tiktok']);
                if ($hasHeaderSocials): 
                ?>
                    <span class="text-slate-400 text-[10px] sm:text-[11px] mr-1 hidden md:inline">যুক্ত থাকুন:</span>
                <?php endif; ?>
                
                <?php if (!empty($socials['facebook'])): ?>
                    <a href="<?= htmlspecialchars($socials['facebook']) ?>" target="_blank" title="Facebook" 
                       class="hidden sm:flex w-6 h-6 rounded-full bg-slate-800 hover:bg-blue-600 text-slate-300 hover:text-white items-center justify-center transition">
                        <i data-lucide="share-2" class="w-3.5 h-3.5"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($socials['instagram'])): ?>
                    <a href="<?= htmlspecialchars($socials['instagram']) ?>" target="_blank" title="Instagram" 
                       class="hidden sm:flex w-6 h-6 rounded-full bg-slate-800 hover:bg-pink-600 text-slate-300 hover:text-white items-center justify-center transition">
                        <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($socials['whatsapp'])): ?>
                    <?php 
                        $waRaw = $socials['whatsapp'];
                        $waHref = str_starts_with($waRaw, 'http') ? $waRaw : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waRaw);
                    ?>
                    <a href="<?= htmlspecialchars($waHref) ?>" target="_blank" title="WhatsApp" 
                       class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-slate-800 hover:bg-emerald-600 text-slate-300 hover:text-white flex items-center justify-center transition">
                        <i data-lucide="message-circle" class="w-3 h-3 sm:w-3.5 sm:h-3.5"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($socials['youtube'])): ?>
                    <a href="<?= htmlspecialchars($socials['youtube']) ?>" target="_blank" title="YouTube" 
                       class="hidden sm:flex w-6 h-6 rounded-full bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white items-center justify-center transition">
                        <i data-lucide="video" class="w-3.5 h-3.5"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($socials['tiktok'])): ?>
                    <a href="<?= htmlspecialchars($socials['tiktok']) ?>" target="_blank" title="TikTok" 
                       class="hidden sm:flex w-6 h-6 rounded-full bg-slate-800 hover:bg-black text-slate-300 hover:text-white items-center justify-center transition">
                        <i data-lucide="video" class="w-3.5 h-3.5"></i>
                    </a>
                <?php endif; ?>

                <span class="text-slate-700 mx-0.5 sm:mx-1">|</span>
                <span class="text-[10px] sm:text-[11px] font-bold text-brand-400 bg-slate-800 px-1.5 sm:px-2 py-0.5 rounded">
                    <?= htmlspecialchars($storeCurrency) ?>
                </span>
                <span class="text-slate-700 mx-0.5 sm:mx-1">|</span>
                <a href="admin/" class="inline-flex items-center space-x-1 text-[10px] sm:text-[11px] text-slate-300 hover:text-white transition px-1.5 sm:px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700" title="স্টোর অ্যাডমিন ড্যাশবোর্ড">
                    <i data-lucide="shield" class="w-3 h-3 text-brand-400"></i>
                    <span>অ্যাডমিন</span>
                </a>
            </div>
        </div>
    </div>

<?php
// Compute base client URL and active storefront page
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$clientBasePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($clientBasePath === '/' || $clientBasePath === '\\') {
    $clientBasePath = '';
}

$activeNav = 'home';
if (preg_match('#/discount(?:/|\?|$)#', $requestUri)) {
    $activeNav = 'discount';
} elseif (preg_match('#/category(?:/|\?|$)#', $requestUri)) {
    $activeNav = 'category';
} elseif (preg_match('#/about(?:/|\?|$)#', $requestUri)) {
    $activeNav = 'about';
} elseif (preg_match('#/contact(?:/|\?|$)#', $requestUri)) {
    $activeNav = 'contact';
} elseif (preg_match('#/product(?:/|\?|$)#', $requestUri)) {
    $activeNav = 'product';
} elseif (preg_match('#/checkout(?:/|\?|$)#', $requestUri)) {
    $activeNav = 'checkout';
}

$tplNum = (int)($activeTemplate['number'] ?? 1);

// 20 Unique Header Styling Presets (100% Solid, Opaque & BORDERLESS - Zero Navbar Borders)
$headerContainerThemes = [
    1  => 'bg-white shadow-xs',
    2  => 'bg-brand-50 shadow-xs',
    3  => 'bg-slate-950 text-slate-100 shadow-lg',
    4  => 'bg-brand-50 shadow-xs',
    5  => 'bg-white shadow-xs',
    6  => 'bg-white shadow-xs',
    7  => 'bg-brand-50 shadow-xs',
    8  => 'bg-gradient-to-r from-brand-50 via-white to-brand-50 shadow-xs',
    9  => 'bg-slate-900 text-white shadow-md',
    10 => 'bg-brand-50 text-slate-900 shadow-xs',
    11 => 'bg-white shadow-xs',
    12 => 'bg-neutral-900 text-slate-100 shadow-md',
    13 => 'bg-white shadow-sm',
    14 => 'bg-brand-50 shadow-xs',
    15 => 'bg-zinc-950 text-zinc-100 shadow-lg',
    16 => 'bg-brand-50 shadow-xs',
    17 => 'bg-slate-900 text-slate-100 shadow-md',
    18 => 'bg-slate-50 shadow-xs',
    19 => 'bg-gradient-to-r from-brand-50 via-white to-brand-50 shadow-xs',
    20 => 'bg-slate-950 text-slate-100 shadow-xl',
];
$headerThemeClass = $headerContainerThemes[$tplNum] ?? 'bg-white shadow-xs';
$isDarkHeader = in_array($tplNum, [3, 9, 12, 15, 17, 20], true);
?>
    <!-- 2. MAIN NAVBAR (LOGO, STORE NAME & NAVIGATION) - 100% SOLID OPAQUE, ZERO BORDERS -->
    <header id="mainStoreHeader" class="<?= $headerThemeClass ?> sticky top-0 z-30 transition-colors duration-200" style="opacity: 1 !important; border: none !important; backdrop-filter: none !important; -webkit-backdrop-filter: none !important;">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            
            <!-- Brand Logo & Name -->
            <a href="<?= $clientBasePath ?>/" class="flex items-center space-x-3 text-decoration-none shrink-0 group">
                <?php if (!empty($logoUrl)): ?>
                    <img src="<?= htmlspecialchars($logoUrl) ?>" alt="<?= htmlspecialchars($storeName) ?>" 
                         class="w-10 h-10 rounded-xl object-cover shadow-sm group-hover:scale-105 transition-transform duration-200">
                <?php else: ?>
                    <div class="w-10 h-10 rounded-xl bg-brand-600 text-white font-extrabold flex items-center justify-center text-lg shadow-sm group-hover:scale-105 transition-transform duration-200">
                        <?= strtoupper(mb_substr($storeName, 0, 1, 'UTF-8')) ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div class="text-base font-extrabold <?= $isDarkHeader ? 'text-white' : 'text-slate-900' ?> leading-tight"><?= htmlspecialchars($storeName) ?></div>
                </div>
            </a>

            <!-- Nav Links (Desktop) - 100% Borderless Clean Design -->
            <nav class="hidden md:flex items-center space-x-6 text-sm font-semibold">
                <a href="<?= $clientBasePath ?>/" class="transition flex items-center space-x-1 py-1 <?= $activeNav === 'home' ? 'text-brand-600 font-black' : ($isDarkHeader ? 'text-slate-300 hover:text-white' : 'text-slate-600 hover:text-brand-600') ?>">
                    <span>হোম</span>
                </a>
                <a href="<?= $clientBasePath ?>/discount" class="transition flex items-center space-x-1 py-1 <?= $activeNav === 'discount' ? 'text-brand-600 font-black' : ($isDarkHeader ? 'text-slate-300 hover:text-white' : 'text-slate-600 hover:text-brand-600') ?>">
                    <i data-lucide="flame" class="w-3.5 h-3.5 text-brand-500"></i>
                    <span>ডিসকাউন্ট</span>
                    <span class="px-1.5 py-0.2 bg-red-500 text-white text-[9px] font-black rounded-full uppercase tracking-wider animate-pulse">Hot</span>
                </a>
                <?php if (!empty($hasCategories)): ?>
                <a href="<?= $clientBasePath ?>/category" class="transition flex items-center space-x-1 py-1 <?= $activeNav === 'category' ? 'text-brand-600 font-black' : ($isDarkHeader ? 'text-slate-300 hover:text-white' : 'text-slate-600 hover:text-brand-600') ?>">
                    <span>ক্যাটাগরি</span>
                </a>
                <?php endif; ?>
                <a href="<?= $clientBasePath ?>/about" class="transition flex items-center space-x-1 py-1 <?= $activeNav === 'about' ? 'text-brand-600 font-black' : ($isDarkHeader ? 'text-slate-300 hover:text-white' : 'text-slate-600 hover:text-brand-600') ?>">
                    <span>আমাদের সম্পর্কে</span>
                </a>
                <a href="<?= $clientBasePath ?>/contact" class="transition flex items-center space-x-1 py-1 <?= $activeNav === 'contact' ? 'text-brand-600 font-black' : ($isDarkHeader ? 'text-slate-300 hover:text-white' : 'text-slate-600 hover:text-brand-600') ?>">
                    <span>যোগাযোগ</span>
                </a>
            </nav>

            <!-- Right: Expandable Search + Track Order + Cart + Mobile Hamburger -->
            <div class="flex items-center space-x-1.5 sm:space-x-2">
                
                <!-- Expandable Live Header Search (All 20 Templates) -->
                <div class="relative flex items-center" id="headerSearchContainer">
                    <button type="button" onclick="toggleHeaderSearch()" id="headerSearchToggleBtn" 
                            class="p-2 <?= $isDarkHeader ? 'text-slate-300 hover:text-white hover:bg-slate-800' : 'text-slate-700 hover:text-brand-600 hover:bg-slate-100' ?> rounded-xl transition cursor-pointer flex items-center justify-center" 
                            title="পণ্য খুঁজুন">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>

                    <!-- Beautiful Floating Expandable Search Pill -->
                    <div id="headerSearchPill" class="hidden opacity-0 scale-95 transition-all duration-200 ease-out absolute right-0 top-1/2 -translate-y-1/2 z-50">
                        <form action="<?= $clientBasePath ?>/category" method="GET" id="headerSearchForm" onsubmit="return handleHeaderSearchSubmit(event)" 
                              class="flex items-center h-10 w-72 sm:w-80 md:w-96 max-w-[85vw] rounded-full border shadow-2xl px-3.5 space-x-2 <?= $isDarkHeader ? 'bg-slate-900 border-slate-700 text-white shadow-black/50' : 'bg-white border-slate-300 text-slate-800 shadow-slate-400/30' ?>">
                            <i data-lucide="search" class="w-4 h-4 text-brand-500 shrink-0"></i>
                            <input type="text" name="q" id="headerSearchInput" placeholder="পণ্য বা ক্যাটাগরি খুঁজুন..." 
                                   oninput="handleHeaderLiveSearch(this.value)"
                                   autocomplete="off"
                                   class="w-full bg-transparent text-xs sm:text-sm focus:outline-none <?= $isDarkHeader ? 'placeholder-slate-500 text-white' : 'placeholder-slate-400 text-slate-800' ?>">
                            <button type="button" onclick="closeHeaderSearch()" class="p-1 rounded-full text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-800 shrink-0 cursor-pointer transition" title="বন্ধ করুন">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Track Order Button (Desktop & Tablet) -->
                <button type="button" onclick="openOrderTrackingModal()" class="hidden sm:flex px-3 py-1.5 <?= $isDarkHeader ? 'bg-slate-800 hover:bg-slate-700 text-slate-200 border-slate-700' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-slate-200/80' ?> border rounded-xl text-xs font-bold transition items-center space-x-1.5 cursor-pointer" title="অর্ডার ট্র্যাক করুন">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-brand-500"></i>
                    <span>ট্র্যাক অর্ডার</span>
                </button>

                <!-- Shopping Cart Button with Count Badge -->
                <button type="button" onclick="openCartDrawer()" class="relative p-2 <?= $isDarkHeader ? 'bg-slate-800 hover:bg-slate-700 border-slate-700 text-white' : 'bg-brand-50 hover:bg-brand-100 border-brand-200 text-brand-700' ?> border rounded-xl transition cursor-pointer" title="শピング কার্ট">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-brand-500"></i>
                    <span id="cartCountBadge" class="absolute -top-1.5 -right-1.5 bg-brand-600 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow-xs">0</span>
                </button>

                <!-- Mobile Hamburger Menu Button (md:hidden) -->
                <button type="button" onclick="toggleMobileNav()" id="btnMobileNavToggle" class="p-2 <?= $isDarkHeader ? 'text-slate-300 hover:text-white hover:bg-slate-800 border-slate-700' : 'text-slate-700 hover:text-brand-600 hover:bg-slate-100 border-slate-200' ?> border rounded-xl transition md:hidden cursor-pointer flex items-center justify-center shadow-2xs" aria-label="মেনু খুলুন" title="মেনু">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Slide-in Navigation Drawer (Activated by Hamburger Menu) -->
        <div id="mobileNavDrawer" class="fixed inset-0 z-[99998] hidden">
            <!-- Backdrop -->
            <div onclick="closeMobileNav()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 cursor-pointer"></div>

            <!-- Drawer Panel -->
            <div class="fixed inset-y-0 left-0 w-72 max-w-[85vw] bg-white shadow-2xl flex flex-col h-full border-r border-slate-200 z-10">
                <!-- Header -->
                <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                    <div class="flex items-center space-x-2.5 min-w-0">
                        <?php if (!empty($logoUrl)): ?>
                            <img src="<?= htmlspecialchars($logoUrl) ?>" class="w-8 h-8 rounded-lg object-cover border border-slate-200 shrink-0">
                        <?php else: ?>
                            <div class="w-8 h-8 rounded-lg bg-brand-600 text-white font-bold flex items-center justify-center text-xs shrink-0">
                                <?= strtoupper(mb_substr($storeName, 0, 1, 'UTF-8')) ?>
                            </div>
                        <?php endif; ?>
                        <div class="truncate">
                            <div class="text-xs font-black text-slate-900 truncate"><?= htmlspecialchars($storeName) ?></div>
                            <div class="text-[9px] text-emerald-600 font-semibold flex items-center space-x-1">
                                <span class="w-1 h-1 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>অফিসিয়াল স্টোরফ্রন্ট</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="closeMobileNav()" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-200/60 transition cursor-pointer" title="বন্ধ করুন">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Nav Links -->
                <div class="p-3 space-y-1 overflow-y-auto flex-1">
                    <a href="<?= $clientBasePath ?>/" onclick="closeMobileNav()" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold transition <?= $activeNav === 'home' ? 'bg-brand-50 text-brand-600 border border-brand-200/60' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <i data-lucide="home" class="w-4 h-4 <?= $activeNav === 'home' ? 'text-brand-600' : 'text-slate-400' ?>"></i>
                        <span>হোম (Home)</span>
                    </a>

                    <a href="<?= $clientBasePath ?>/discount" onclick="closeMobileNav()" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition <?= $activeNav === 'discount' ? 'bg-red-50 text-red-600 border border-red-200/60' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="flame" class="w-4 h-4 text-red-500"></i>
                            <span>ডিসকাউন্ট অফার</span>
                        </div>
                        <span class="px-1.5 py-0.5 bg-red-500 text-white text-[9px] font-black rounded-full uppercase tracking-wider animate-pulse">Hot</span>
                    </a>

                    <?php if (!empty($hasCategories)): ?>
                    <a href="<?= $clientBasePath ?>/category" onclick="closeMobileNav()" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold transition <?= $activeNav === 'category' ? 'bg-brand-50 text-brand-600 border border-brand-200/60' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <i data-lucide="layout-grid" class="w-4 h-4 <?= $activeNav === 'category' ? 'text-brand-600' : 'text-slate-400' ?>"></i>
                        <span>ক্যাটাগরি সমূহ</span>
                    </a>
                    <?php endif; ?>

                    <a href="<?= $clientBasePath ?>/about" onclick="closeMobileNav()" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold transition <?= $activeNav === 'about' ? 'bg-brand-50 text-brand-600 border border-brand-200/60' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <i data-lucide="info" class="w-4 h-4 <?= $activeNav === 'about' ? 'text-brand-600' : 'text-slate-400' ?>"></i>
                        <span>আমাদের সম্পর্কে</span>
                    </a>

                    <a href="<?= $clientBasePath ?>/contact" onclick="closeMobileNav()" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold transition <?= $activeNav === 'contact' ? 'bg-brand-50 text-brand-600 border border-brand-200/60' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <i data-lucide="phone-call" class="w-4 h-4 <?= $activeNav === 'contact' ? 'text-brand-600' : 'text-slate-400' ?>"></i>
                        <span>সহায়তা ও যোগাযোগ</span>
                    </a>

                    <div class="pt-2 border-t border-slate-100 my-2 space-y-1">
                        <button type="button" onclick="closeMobileNav(); openOrderTrackingModal();" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50 transition cursor-pointer text-left">
                            <i data-lucide="map-pin" class="w-4 h-4 text-brand-600"></i>
                            <span>অর্ডার ট্র্যাক করুন</span>
                        </button>
                        
                        <button type="button" onclick="closeMobileNav(); openCartDrawer();" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50 transition cursor-pointer text-left">
                            <div class="flex items-center space-x-3">
                                <i data-lucide="shopping-bag" class="w-4 h-4 text-brand-600"></i>
                                <span>শপিং কার্ট</span>
                            </div>
                            <span class="cartMobileCountBadge px-2 py-0.5 rounded-full text-[10px] font-black bg-brand-100 text-brand-700">০ টি</span>
                        </button>
                        
                        <a href="<?= $clientBasePath ?>/admin/" onclick="closeMobileNav()" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                            <i data-lucide="shield" class="w-4 h-4 text-slate-500"></i>
                            <span>স্টোর অ্যাডমিন</span>
                        </a>
                    </div>
                </div>

                <!-- Footer Support -->
                <div class="p-3 bg-slate-50 border-t border-slate-100 text-xs space-y-2">
                    <?php if (!empty($ownerPhone)): ?>
                        <a href="tel:<?= htmlspecialchars($ownerPhone) ?>" class="flex items-center space-x-2 text-slate-700 font-bold hover:text-brand-600 transition text-[11px]">
                            <i data-lucide="phone" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span><?= htmlspecialchars($ownerPhone) ?></span>
                        </a>
                    <?php endif; ?>
                    <div class="text-[10px] text-slate-400">
                        &copy; <?= date('Y') ?> <?= htmlspecialchars($storeName) ?>. সর্বস্বত্ব সংরক্ষিত।
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        function toggleMobileNav() {
            const drawer = $('#mobileNavDrawer');
            if (drawer.hasClass('hidden')) {
                openMobileNav();
            } else {
                closeMobileNav();
            }
        }

        function openMobileNav() {
            $('#mobileNavDrawer').removeClass('hidden');
            $('body').addClass('overflow-hidden');
            const currentCart = (window.cart || (typeof window.getCart === 'function' ? window.getCart() : []));
            const count = currentCart.reduce((sum, item) => sum + (parseInt(item.quantity) || 1), 0);
            $('.cartMobileCountBadge').text(count + ' টি');
            if (window.lucide) lucide.createIcons();
        }

        function closeMobileNav() {
            $('#mobileNavDrawer').addClass('hidden');
            $('body').removeClass('overflow-hidden');
        }

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!$('#mobileNavDrawer').hasClass('hidden')) {
                    closeMobileNav();
                }
                closeHeaderSearch();
            }
        });

        // Expandable Header Search Handler
        function openHeaderSearch() {
            const pill = document.getElementById('headerSearchPill');
            const input = document.getElementById('headerSearchInput');
            if (!pill) return;
            pill.classList.remove('hidden');
            setTimeout(() => {
                pill.classList.remove('opacity-0', 'scale-95');
                pill.classList.add('opacity-100', 'scale-100');
                if (input) input.focus();
                if (window.lucide) lucide.createIcons();
            }, 10);
        }

        function closeHeaderSearch() {
            const pill = document.getElementById('headerSearchPill');
            if (!pill) return;
            pill.classList.remove('opacity-100', 'scale-100');
            pill.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                pill.classList.add('hidden');
            }, 150);
        }

        function toggleHeaderSearch() {
            const pill = document.getElementById('headerSearchPill');
            if (!pill) return;
            if (pill.classList.contains('hidden')) {
                openHeaderSearch();
            } else {
                closeHeaderSearch();
            }
        }

        // Close search when clicking outside
        $(document).on('click', function(e) {
            const container = document.getElementById('headerSearchContainer');
            const pill = document.getElementById('headerSearchPill');
            if (container && pill && !pill.classList.contains('hidden')) {
                if (!container.contains(e.target)) {
                    closeHeaderSearch();
                }
            }
        });

        function handleHeaderLiveSearch(term) {
            if (typeof window.filterCatalogBySearch === 'function') {
                window.filterCatalogBySearch(term);
            }
        }

        function handleHeaderSearchSubmit(e) {
            const path = window.location.pathname;
            if (path.endsWith('/client/') || path.endsWith('/client') || path.endsWith('/index.php') || path.endsWith('/')) {
                const val = ($('#headerSearchInput').val() || '').trim();
                if (typeof window.filterCatalogBySearch === 'function') {
                    e.preventDefault();
                    window.filterCatalogBySearch(val);
                    const el = document.getElementById('sectionAllProducts');
                    if (el) el.scrollIntoView({ behavior: 'smooth' });
                    return false;
                }
            }
            return true;
        }
    </script>

    <div class="flex-1">
