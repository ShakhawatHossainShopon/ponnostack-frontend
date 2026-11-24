<?php

/**
 * Client Storefront - Store Owner Admin Dashboard
 * 
 * Features:
 * - Light Mode Only & Bengali-First with Bilingual Toggle
 * - Overview Dashboard ("Hello World" & Account Summary)
 * - Products & Inventory Management (Pricing, Stock, Sizes, Colors)
 * - Multi-Image Compressor to ~200KB via Mother API
 * - Storefront Profile & Social Media Settings
 */

declare(strict_types=1);

$logoPath = !empty($store['logo_url']) ? $store['logo_url'] : ApiClient::assetUrl($store['logo'] ?? null);
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অ্যাডমিন ড্যাশবোর্ড | <?= htmlspecialchars($store['name']) ?></title>
    <?php if (!empty($logoUrl)): ?>
        <link rel="icon" href="<?= htmlspecialchars($logoUrl) ?>">
        <link rel="shortcut icon" href="<?= htmlspecialchars($logoUrl) ?>">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars($logoUrl) ?>">
    <?php endif; ?>

    <!-- Google Fonts: Hind Siliguri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

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
                            boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1)',
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

        // Lightweight Swal bridge to Toast
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
                return Promise.resolve({ isConfirmed: false, isDismissed: true });
            },
            showLoading: function() {},
            close: function() {}
        };
    </script>

    <!-- Store API Reusable Client -->
    <script src="../assets/js/api.js"></script>

    <style>
        body { font-family: 'Hind Siliguri', -apple-system, sans-serif; }
        
        /* Smooth tab transition */
        @keyframes fadeInUpSmooth {
            from {
                opacity: 0;
                transform: translateY(5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .tab-transition {
            animation: fadeInUpSmooth 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Shimmer Skeleton Animation */
        @keyframes shimmerWave {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .skeleton-shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: shimmerWave 1.6s infinite ease-in-out;
        }

        @media print {
            body * { visibility: hidden; }
            #modalOrderDetails, #modalOrderDetails * { visibility: visible; }
            #modalOrderDetails {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                background: white !important;
                box-shadow: none !important;
                border: none !important;
            }
            .print\:hidden { display: none !important; }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col text-slate-800 antialiased selection:bg-brand-100 selection:text-brand-700">

    <!-- Top Slim Progress Bar -->
    <div id="topLoadingBar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-orange-500 via-amber-400 to-brand-600 z-[99999] transition-all duration-300 ease-out w-0 opacity-0 pointer-events-none"></div>
