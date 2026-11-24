<?php

/**
 * Client Storefront - Store Owner Admin Dashboard (Master Layout)
 * 
 * Modular Clean Architecture:
 * - includes/header.php
 * - includes/topbar.php
 * - includes/sidebar.php
 * - pages/*.php
 * - includes/footer.php
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

// 1. Header (HTML head, fonts, tailwind, styles, loader)
require_once __DIR__ . '/includes/header.php';

// 2. Top Navigation Bar (Logo, live link, language switch, profile, logout)
require_once __DIR__ . '/includes/topbar.php';
?>

<!-- MAIN LAYOUT WITH SIDEBAR & CONTENT TABS -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 w-full flex-1">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        <!-- Left Navigation Sidebar -->
        <?php require_once __DIR__ . '/includes/sidebar.php'; ?>

        <!-- Main Content Area -->
        <main class="md:col-span-9 lg:col-span-9">
            <?php
            // Shimmer Skeleton Loader for Page Transitions
            require_once __DIR__ . '/includes/skeleton.php';

            // Global SaaS Warning Banner
            require_once __DIR__ . '/includes/blocked_banner.php';

            // Primary Tabs
            require_once __DIR__ . '/pages/dashboard.php';
            require_once __DIR__ . '/pages/orders.php';
            require_once __DIR__ . '/pages/products.php';
            require_once __DIR__ . '/pages/design_website.php';
            require_once __DIR__ . '/pages/payments.php';

            // Sub-Menu Tabs
            require_once __DIR__ . '/pages/completed_orders.php';
            require_once __DIR__ . '/pages/cancelled_orders.php';
            require_once __DIR__ . '/pages/categories.php';
            require_once __DIR__ . '/pages/stock_out.php';
            require_once __DIR__ . '/pages/discounts.php';
            require_once __DIR__ . '/pages/delivery_charges.php';
            require_once __DIR__ . '/pages/upload_banner.php';
            require_once __DIR__ . '/pages/settings.php';
            ?>
        </main>

    </div>
</div>

<?php
// 3. Footer (All modals, scripts, SweetAlert, StoreApi handlers, and closing body/html)
require_once __DIR__ . '/includes/footer.php';
?>
