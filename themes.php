<?php

/**
 * Storefront Themes & 20 Templates Registry
 *
 * Defines:
 * - Master Color Palettes (50-900 Tailwind shade scale)
 * - 20 E-Commerce Storefront Templates, each with its own curated Color Palettes
 *   and visual styling presets for the universal Homepage sections (Banner, Sale,
 *   Category, All Products, Newsletter) as well as About & Contact pages.
 */

declare(strict_types=1);

/**
 * Get all available color palettes (Tailwind 50-900 scale)
 */
function getStoreColorPalettes(): array
{
    return [
        'orange' => [
            'id'      => 'orange',
            'name_bn' => 'সানসেট অরেঞ্জ (Sunset Orange)',
            'name_en' => 'Sunset Orange',
            'primary' => '#ea580c',
            'secondary' => '#d97706',
            'shades'  => [
                50  => '#fff7ed',
                100 => '#ffedd5',
                200 => '#fed7aa',
                300 => '#fdba74',
                400 => '#fb923c',
                500 => '#f97316',
                600 => '#ea580c',
                700 => '#c2410c',
                800 => '#9a3412',
                900 => '#7c2d12',
            ],
        ],
        'emerald' => [
            'id'      => 'emerald',
            'name_bn' => 'ফ্রেশ এমেরাল্ড (Fresh Emerald)',
            'name_en' => 'Fresh Emerald',
            'primary' => '#059669',
            'secondary' => '#0d9488',
            'shades'  => [
                50  => '#ecfdf5',
                100 => '#d1fae5',
                200 => '#a7f3d0',
                300 => '#6ee7b7',
                400 => '#34d399',
                500 => '#10b981',
                600 => '#059669',
                700 => '#047857',
                800 => '#065f46',
                900 => '#064e3b',
            ],
        ],
        'royal_blue' => [
            'id'      => 'royal_blue',
            'name_bn' => 'রয়্যাল ব্লু (Royal Blue)',
            'name_en' => 'Royal Blue',
            'primary' => '#2563eb',
            'secondary' => '#4f46e5',
            'shades'  => [
                50  => '#eff6ff',
                100 => '#dbeafe',
                200 => '#bfdbfe',
                300 => '#93c5fd',
                400 => '#60a5fa',
                500 => '#3b82f6',
                600 => '#2563eb',
                700 => '#1d4ed8',
                800 => '#1e40af',
                900 => '#1e3a8a',
            ],
        ],
        'rose' => [
            'id'      => 'rose',
            'name_bn' => 'ভেলভেট রোজ (Velvet Rose)',
            'name_en' => 'Velvet Rose',
            'primary' => '#e11d48',
            'secondary' => '#db2777',
            'shades'  => [
                50  => '#fff1f2',
                100 => '#ffe4e6',
                200 => '#fecdd3',
                300 => '#fda4af',
                400 => '#fb7185',
                500 => '#f43f5e',
                600 => '#e11d48',
                700 => '#be123c',
                800 => '#9f1239',
                900 => '#881337',
            ],
        ],
        'violet' => [
            'id'      => 'violet',
            'name_bn' => 'রয়্যাল ভায়োলেট (Royal Violet)',
            'name_en' => 'Royal Violet',
            'primary' => '#7c3aed',
            'secondary' => '#9333ea',
            'shades'  => [
                50  => '#f5f3ff',
                100 => '#ede9fe',
                200 => '#ddd6fe',
                300 => '#c4b5fd',
                400 => '#a78bfa',
                500 => '#8b5cf6',
                600 => '#7c3aed',
                700 => '#6d28d9',
                800 => '#5b21b6',
                900 => '#4c1d95',
            ],
        ],
        'teal' => [
            'id'      => 'teal',
            'name_bn' => 'ওশান টিল (Ocean Teal)',
            'name_en' => 'Ocean Teal',
            'primary' => '#0d9488',
            'secondary' => '#0891b2',
            'shades'  => [
                50  => '#f0fdfa',
                100 => '#ccfbf1',
                200 => '#99f6e4',
                300 => '#5eead4',
                400 => '#2dd4bf',
                500 => '#14b8a6',
                600 => '#0d9488',
                700 => '#0f766e',
                800 => '#115e59',
                900 => '#134e4a',
            ],
        ],
        'amber' => [
            'id'      => 'amber',
            'name_bn' => 'গোল্ডেন অ্যাম্বার (Golden Amber)',
            'name_en' => 'Golden Amber',
            'primary' => '#d97706',
            'secondary' => '#ea580c',
            'shades'  => [
                50  => '#fffbeb',
                100 => '#fef3c7',
                200 => '#fde68a',
                300 => '#fcd34d',
                400 => '#fbbf24',
                500 => '#f59e0b',
                600 => '#d97706',
                700 => '#b45309',
                800 => '#92400e',
                900 => '#78350f',
            ],
        ],
        'indigo' => [
            'id'      => 'indigo',
            'name_bn' => 'ডিপ ইন্ডিগো (Deep Indigo)',
            'name_en' => 'Deep Indigo',
            'primary' => '#4f46e5',
            'secondary' => '#2563eb',
            'shades'  => [
                50  => '#eef2ff',
                100 => '#e0e7ff',
                200 => '#c7d2fe',
                300 => '#a5b4fc',
                400 => '#818cf8',
                500 => '#6366f1',
                600 => '#4f46e5',
                700 => '#4338ca',
                800 => '#3730a3',
                900 => '#312e81',
            ],
        ],
        'fuchsia' => [
            'id'      => 'fuchsia',
            'name_bn' => 'মডার্ন ফুশিয়া (Modern Fuchsia)',
            'name_en' => 'Modern Fuchsia',
            'primary' => '#c026d3',
            'secondary' => '#db2777',
            'shades'  => [
                50  => '#fdf4ff',
                100 => '#fae8ff',
                200 => '#f5d0fe',
                300 => '#f0abfc',
                400 => '#e879f9',
                500 => '#d946ef',
                600 => '#c026d3',
                700 => '#a21caf',
                800 => '#86198f',
                900 => '#701a75',
            ],
        ],
        'cyan' => [
            'id'      => 'cyan',
            'name_bn' => 'সাইবার সায়ান (Cyber Cyan)',
            'name_en' => 'Cyber Cyan',
            'primary' => '#0891b2',
            'secondary' => '#0284c7',
            'shades'  => [
                50  => '#ecfeff',
                100 => '#cffafe',
                200 => '#a5f3fc',
                300 => '#67e8f9',
                400 => '#22d3ee',
                500 => '#06b6d4',
                600 => '#0891b2',
                700 => '#0e7490',
                800 => '#155e75',
                900 => '#164e63',
            ],
        ],
        'crimson' => [
            'id'      => 'crimson',
            'name_bn' => 'ক্রিমসন রেড (Crimson Red)',
            'name_en' => 'Crimson Red',
            'primary' => '#dc2626',
            'secondary' => '#e11d48',
            'shades'  => [
                50  => '#fef2f2',
                100 => '#fee2e2',
                200 => '#fecaca',
                300 => '#fca5a5',
                400 => '#f87171',
                500 => '#ef4444',
                600 => '#dc2626',
                700 => '#b91c1c',
                800 => '#991b1b',
                900 => '#7f1d1d',
            ],
        ],
        'slate_noir' => [
            'id'      => 'slate_noir',
            'name_bn' => 'মনোক্রোম স্লেট (Monochrome Slate)',
            'name_en' => 'Monochrome Slate',
            'primary' => '#1e293b',
            'secondary' => '#334155',
            'shades'  => [
                50  => '#f8fafc',
                100 => '#f1f5f9',
                200 => '#e2e8f0',
                300 => '#cbd5e1',
                400 => '#94a3b8',
                500 => '#64748b',
                600 => '#1e293b',
                700 => '#0f172a',
                800 => '#090d16',
                900 => '#020617',
            ],
        ],
        'lime' => [
            'id'      => 'lime',
            'name_bn' => 'অর্গানিক লাইম (Organic Lime)',
            'name_en' => 'Organic Lime',
            'primary' => '#65a30d',
            'secondary' => '#16a34a',
            'shades'  => [
                50  => '#f7fee7',
                100 => '#ecfccb',
                200 => '#d9f99d',
                300 => '#bef264',
                400 => '#a3e635',
                500 => '#84cc16',
                600 => '#65a30d',
                700 => '#4d7c0f',
                800 => '#3f6212',
                900 => '#365314',
            ],
        ],
        'sky' => [
            'id'      => 'sky',
            'name_bn' => 'স্কাই ব্রিজ (Sky Breeze)',
            'name_en' => 'Sky Breeze',
            'primary' => '#0284c7',
            'secondary' => '#2563eb',
            'shades'  => [
                50  => '#f0f9ff',
                100 => '#e0f2fe',
                200 => '#bae6fd',
                300 => '#7dd3fc',
                400 => '#38bdf8',
                500 => '#0ea5e9',
                600 => '#0284c7',
                700 => '#0369a1',
                800 => '#075985',
                900 => '#0c4a6e',
            ],
        ],
        'bronze' => [
            'id'      => 'bronze',
            'name_bn' => 'টেরাকোটা ব্রোঞ্জ (Terracotta Bronze)',
            'name_en' => 'Terracotta Bronze',
            'primary' => '#b45309',
            'secondary' => '#9a3412',
            'shades'  => [
                50  => '#fdf8f6',
                100 => '#f2e8e5',
                200 => '#eaddd7',
                300 => '#e0cec7',
                400 => '#d2bab0',
                500 => '#c29d8f',
                600 => '#b45309',
                700 => '#92400e',
                800 => '#78350f',
                900 => '#451a03',
            ],
        ],
    ];
}

/**
 * Get all 20 Storefront Templates with their curated palettes and layout presets
 */
function getStoreTemplates(): array
{
    return [
        'template_1' => [
            'id'            => 'template_1',
            'number'        => 1,
            'name_bn'       => 'ক্লাসিক বাজার (Classic Bazaar)',
            'name_en'       => 'Classic Bazaar',
            'category_bn'   => 'জেনারেল ও মাল্টি-ভেন্ডর',
            'category_en'   => 'General Store',
            'desc_bn'       => 'সব ধরনের পণ্যের জন্য ক্লিন, ব্যালেন্সড এবং কনভার্সন-ফ্রেন্ডলি ডিফল্ট স্টোরফ্রন্ট লেআউট।',
            'font_name'     => 'Hind Siliguri',
            'font_family'   => "'Hind Siliguri', -apple-system, sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap',
            'header_style'  => 'header_1',
            'footer_style'  => 'footer_1',
            'card_variant'  => 'card_1',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'cards',
            'prod_layout'   => 'grid4',
            'palettes'      => ['orange', 'emerald', 'royal_blue', 'rose'],
            'banner_style'  => 'split_gradient',
            'sale_style'    => 'ribbon_grid',
            'cat_style'     => 'pill_cards',
            'card_style'    => 'rounded_classic',
            'news_style'    => 'gradient_banner',
        ],
        'template_2' => [
            'id'            => 'template_2',
            'number'        => 2,
            'name_bn'       => 'ফ্যাশন ভোগ (Fashion Vogue)',
            'name_en'       => 'Fashion Vogue',
            'category_bn'   => 'ফ্যাশন ও লাইফস্টাইল',
            'category_en'   => 'Fashion & Apparel',
            'desc_bn'       => 'পোশাক ও বুটিক শপের জন্য এডিটোরিয়াল ব্যানার ও পোর্ট্রেট-ফ্রেন্ডলি প্রিমিয়াম কার্ড ডিজাইন।',
            'font_name'     => 'Playfair Display',
            'font_family'   => "'Playfair Display', 'Noto Serif Bengali', serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400&display=swap',
            'header_style'  => 'header_2',
            'footer_style'  => 'footer_2',
            'card_variant'  => 'card_2',
            'sale_layout'   => 'spotlight',
            'cat_layout'    => 'stories',
            'prod_layout'   => 'showcase3',
            'palettes'      => ['rose', 'slate_noir', 'fuchsia', 'amber'],
            'banner_style'  => 'centered_editorial',
            'sale_style'    => 'spotlight_cards',
            'cat_style'     => 'circle_badges',
            'card_style'    => 'editorial_soft',
            'news_style'    => 'minimal_chic',
        ],
        'template_3' => [
            'id'            => 'template_3',
            'number'        => 3,
            'name_bn'       => 'টেক গ্যাজেট প্রো (Tech Gadget Pro)',
            'name_en'       => 'Tech Gadget Pro',
            'category_bn'   => 'ইলেকট্রনিক্স ও গ্যাজেট',
            'category_en'   => 'Electronics & Tech',
            'desc_bn'       => 'মোবাইল, কম্পিউটার ও এক্সেসরিজ শপের জন্য আধুনিক শার্প বর্ডার ও স্পেক-হাইলাইট গ্রিড।',
            'font_name'     => 'Space Grotesk',
            'font_family'   => "'Space Grotesk', 'Anek Bangla', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@400;600;700&family=Space+Grotesk:wght@500;600;700&display=swap',
            'header_style'  => 'header_3',
            'footer_style'  => 'footer_3',
            'card_variant'  => 'card_3',
            'sale_layout'   => 'carousel',
            'cat_layout'    => 'bento',
            'prod_layout'   => 'sidebar',
            'palettes'      => ['royal_blue', 'cyan', 'indigo', 'slate_noir'],
            'banner_style'  => 'cyber_dark',
            'sale_style'    => 'tech_flash',
            'cat_style'     => 'icon_tiles',
            'card_style'    => 'bordered_tech',
            'news_style'    => 'dark_cyber',
        ],
        'template_4' => [
            'id'            => 'template_4',
            'number'        => 4,
            'name_bn'       => 'ফ্রেশ মার্ট গ্রোসারি (FreshMart Grocery)',
            'name_en'       => 'FreshMart Grocery',
            'category_bn'   => 'গ্রোসারি ও অর্গানিক ফুড',
            'category_en'   => 'Grocery & Organic',
            'desc_bn'       => 'নিত্যপ্রয়োজনীয় বাজার, ফলমূল ও অর্গানিক খাবারের জন্য ফ্রেশ ও কমপ্যাক্ট ডিসপ্লে।',
            'font_name'     => 'Cinzel & Tiro',
            'font_family'   => "'Cinzel', 'Tiro Bangla', serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Tiro+Bangla:ital@0;1&display=swap',
            'header_style'  => 'header_4',
            'footer_style'  => 'footer_4',
            'card_variant'  => 'card_4',
            'sale_layout'   => 'spotlight',
            'cat_layout'    => 'chips',
            'prod_layout'   => 'showcase3',
            'palettes'      => ['emerald', 'lime', 'amber', 'orange'],
            'banner_style'  => 'fresh_organic',
            'sale_style'    => 'daily_deals',
            'cat_style'     => 'compact_chips',
            'card_style'    => 'compact_fresh',
            'news_style'    => 'soft_tinted',
        ],
        'template_5' => [
            'id'            => 'template_5',
            'number'        => 5,
            'name_bn'       => 'গ্লো বিউটি অ্যান্ড কসমেটিকস (Glow Beauty)',
            'name_en'       => 'Glow Beauty & Cosmetics',
            'category_bn'   => 'বিউটি ও স্কিনকেয়ার',
            'category_en'   => 'Beauty & Skincare',
            'desc_bn'       => 'প্রসাধনী ও স্কিনকেয়ার ব্র্যান্ডের জন্য সফট গ্লো শ্যাডো এবং এলিগ্যান্ট রাউন্ডেড লেআউট।',
            'font_name'     => 'Outfit',
            'font_family'   => "'Outfit', 'Noto Sans Bengali', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;600;700&family=Outfit:wght@400;500;600;700;800&display=swap',
            'header_style'  => 'header_5',
            'footer_style'  => 'footer_5',
            'card_variant'  => 'card_5',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'stories',
            'prod_layout'   => 'grid4',
            'palettes'      => ['fuchsia', 'rose', 'violet', 'teal'],
            'banner_style'  => 'soft_luxury',
            'sale_style'    => 'glow_deals',
            'cat_style'     => 'circle_badges',
            'card_style'    => 'luxury_pill',
            'news_style'    => 'centered_card',
        ],
        'template_6' => [
            'id'            => 'template_6',
            'number'        => 6,
            'name_bn'       => 'রয়্যাল জুয়েলারি ও ঘড়ি (Royal Luxe)',
            'name_en'       => 'Royal Luxe & Watch',
            'category_bn'   => 'জুয়েলারি ও লাক্সারি',
            'category_en'   => 'Jewelry & Watches',
            'desc_bn'       => 'গহনা, ঘড়ি ও প্রিমিয়াম গিফট শপের জন্য রাজকীয় বর্ডার ও হাই-কনট্রাস্ট শোকেস।',
            'font_name'     => 'Syne',
            'font_family'   => "'Syne', 'Anek Bangla', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@500;700&family=Syne:wght@600;700;800&display=swap',
            'header_style'  => 'header_6',
            'footer_style'  => 'footer_6',
            'card_variant'  => 'card_6',
            'sale_layout'   => 'carousel',
            'cat_layout'    => 'bento',
            'prod_layout'   => 'dense6',
            'palettes'      => ['amber', 'bronze', 'slate_noir', 'crimson'],
            'banner_style'  => 'royal_frame',
            'sale_style'    => 'spotlight_cards',
            'cat_style'     => 'minimal_underline',
            'card_style'    => 'framed_luxe',
            'news_style'    => 'dark_cyber',
        ],
        'template_7' => [
            'id'            => 'template_7',
            'number'        => 7,
            'name_bn'       => 'হোম ডেকোর ও ফার্নিচার (Cozy Nest)',
            'name_en'       => 'Cozy Nest Decor',
            'category_bn'   => 'ফার্নিচার ও ইন্টেরিয়র',
            'category_en'   => 'Home & Furniture',
            'desc_bn'       => 'ঘর সাজানোর পণ্য ও ফার্নিচারের জন্য প্রশস্ত কার্ড এবং ওয়ার্ম আর্কিটেকচারাল ভিউ।',
            'font_name'     => 'Plus Jakarta Sans',
            'font_family'   => "'Plus Jakarta Sans', 'Hind Siliguri', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap',
            'header_style'  => 'header_7',
            'footer_style'  => 'footer_7',
            'card_variant'  => 'card_7',
            'sale_layout'   => 'bento',
            'cat_layout'    => 'cards',
            'prod_layout'   => 'sidebar',
            'palettes'      => ['bronze', 'amber', 'teal', 'emerald'],
            'banner_style'  => 'split_gradient',
            'sale_style'    => 'ribbon_grid',
            'cat_style'     => 'icon_tiles',
            'card_style'    => 'editorial_soft',
            'news_style'    => 'soft_tinted',
        ],
        'template_8' => [
            'id'            => 'template_8',
            'number'        => 8,
            'name_bn'       => 'কিডস জোন ও টয় শপ (Kids Wonderland)',
            'name_en'       => 'Kids Wonderland',
            'category_bn'   => 'বেবি কেয়ার ও খেলনা',
            'category_en'   => 'Kids & Toys',
            'desc_bn'       => 'শিশুদের পোশাক ও খেলনার দোকানের জন্য প্লেফুল রাউন্ডেড বাটন ও উজ্জ্বল ব্যাজ ডিজাইন।',
            'font_name'     => 'Baloo Da 2',
            'font_family'   => "'Baloo Da 2', cursive, sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@500;600;700;800&display=swap',
            'header_style'  => 'header_8',
            'footer_style'  => 'footer_8',
            'card_variant'  => 'card_8',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'stories',
            'prod_layout'   => 'dense6',
            'palettes'      => ['sky', 'fuchsia', 'orange', 'violet'],
            'banner_style'  => 'playful_pop',
            'sale_style'    => 'glow_deals',
            'cat_style'     => 'pill_cards',
            'card_style'    => 'luxury_pill',
            'news_style'    => 'gradient_banner',
        ],
        'template_9' => [
            'id'            => 'template_9',
            'number'        => 9,
            'name_bn'       => 'স্পোর্টস ও ফিটনেস (Active Pulse)',
            'name_en'       => 'Active Pulse Sports',
            'category_bn'   => 'স্পোর্টস ও জিম গিয়ার',
            'category_en'   => 'Sports & Fitness',
            'desc_bn'       => 'জার্সি, জুতো ও ফিটনেস গিয়ারের জন্য বোল্ড টাইপোগ্রাফি এবং এনার্জেটিক গ্রিড।',
            'font_name'     => 'Lexend',
            'font_family'   => "'Lexend', 'Noto Sans Bengali', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@500;700&display=swap',
            'header_style'  => 'header_9',
            'footer_style'  => 'footer_9',
            'card_variant'  => 'card_9',
            'sale_layout'   => 'carousel',
            'cat_layout'    => 'stories',
            'prod_layout'   => 'sidebar',
            'palettes'      => ['crimson', 'orange', 'royal_blue', 'lime'],
            'banner_style'  => 'cyber_dark',
            'sale_style'    => 'tech_flash',
            'cat_style'     => 'compact_chips',
            'card_style'    => 'bordered_tech',
            'news_style'    => 'gradient_banner',
        ],
        'template_10' => [
            'id'            => 'template_10',
            'number'        => 10,
            'name_bn'       => 'বুকশপ ও স্টেশনারি (Scholar Hub)',
            'name_en'       => 'Scholar Book Hub',
            'category_bn'   => 'বই ও শিক্ষা উপকরণ',
            'category_en'   => 'Books & Stationery',
            'desc_bn'       => 'বইয়ের দোকান ও স্টেশনারির জন্য পরিপাটি রিডার-ফ্রেন্ডলি ক্যাটালগ ও দ্রুত ব্রাউজিং।',
            'font_name'     => 'Mina & Serif',
            'font_family'   => "'Mina', 'Merriweather', serif, sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&family=Mina:wght@400;700&display=swap',
            'header_style'  => 'header_10',
            'footer_style'  => 'footer_10',
            'card_variant'  => 'card_10',
            'sale_layout'   => 'carousel',
            'cat_layout'    => 'bento',
            'prod_layout'   => 'dense6',
            'palettes'      => ['indigo', 'teal', 'amber', 'slate_noir'],
            'banner_style'  => 'centered_editorial',
            'sale_style'    => 'daily_deals',
            'cat_style'     => 'minimal_underline',
            'card_style'    => 'rounded_classic',
            'news_style'    => 'minimal_chic',
        ],
        'template_11' => [
            'id'            => 'template_11',
            'number'        => 11,
            'name_bn'       => 'মেডি-কেয়ার ফার্মেসি (MediCare Plus)',
            'name_en'       => 'MediCare Pharmacy',
            'category_bn'   => 'হেলথ ও ওয়েলনেস',
            'category_en'   => 'Health & Pharmacy',
            'desc_bn'       => 'স্বাস্থ্যসেবা ও ওয়েলনেস পণ্যের জন্য পরিচ্ছন্ন, নির্ভরযোগ্য ও স্পষ্ট তথ্যসমৃদ্ধ লেআউট।',
            'font_name'     => 'Poppins',
            'font_family'   => "'Poppins', 'Hind Siliguri', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&family=Poppins:wght@400;500;600;700;800&display=swap',
            'header_style'  => 'header_11',
            'footer_style'  => 'footer_11',
            'card_variant'  => 'card_11',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'cards',
            'prod_layout'   => 'grid4',
            'palettes'      => ['teal', 'sky', 'emerald', 'royal_blue'],
            'banner_style'  => 'fresh_organic',
            'sale_style'    => 'daily_deals',
            'cat_style'     => 'icon_tiles',
            'card_style'    => 'compact_fresh',
            'news_style'    => 'soft_tinted',
        ],
        'template_12' => [
            'id'            => 'template_12',
            'number'        => 12,
            'name_bn'       => 'মিনিমাল নর্ডিক (Minimal Nordic)',
            'name_en'       => 'Minimal Nordic',
            'category_bn'   => 'মডার্ন মিনিমালিস্ট',
            'category_en'   => 'Modern Minimal',
            'desc_bn'       => 'অতিরিক্ত অলংকরণ ছাড়া হোয়াইট-স্পেস নির্ভর আল্ট্রা-ক্লিন মডার্ন ব্র্যান্ড স্টোর।',
            'font_name'     => 'Raleway',
            'font_family'   => "'Raleway', 'Noto Serif Bengali', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@500;700&family=Raleway:wght@400;500;600;700;800&display=swap',
            'header_style'  => 'header_12',
            'footer_style'  => 'footer_12',
            'card_variant'  => 'card_12',
            'sale_layout'   => 'spotlight',
            'cat_layout'    => 'chips',
            'prod_layout'   => 'showcase3',
            'palettes'      => ['slate_noir', 'indigo', 'teal', 'bronze'],
            'banner_style'  => 'centered_editorial',
            'sale_style'    => 'spotlight_cards',
            'cat_style'     => 'minimal_underline',
            'card_style'    => 'editorial_soft',
            'news_style'    => 'minimal_chic',
        ],
        'template_13' => [
            'id'            => 'template_13',
            'number'        => 13,
            'name_bn'       => 'মেগা ডিলস ফ্ল্যাশ মার্ট (Mega Flash Mart)',
            'name_en'       => 'Mega Flash Mart',
            'category_bn'   => 'ডিসকাউন্ট ও হোলসেল',
            'category_en'   => 'Mega Deals & Wholesale',
            'desc_bn'       => 'হাই-ভলিউম অফার, ক্যাম্পেইন ও পাইকারি/খুচরা বিক্রির জন্য হাই-ইমপ্যাক্ট ব্যাজ লেআউট।',
            'font_name'     => 'DM Sans',
            'font_family'   => "'DM Sans', 'Anek Bangla', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@500;700&family=DM+Sans:wght@400;500;700;800&display=swap',
            'header_style'  => 'header_13',
            'footer_style'  => 'footer_13',
            'card_variant'  => 'card_13',
            'sale_layout'   => 'bento',
            'cat_layout'    => 'cards',
            'prod_layout'   => 'dense6',
            'palettes'      => ['crimson', 'orange', 'amber', 'violet'],
            'banner_style'  => 'playful_pop',
            'sale_style'    => 'tech_flash',
            'cat_style'     => 'pill_cards',
            'card_style'    => 'rounded_classic',
            'news_style'    => 'gradient_banner',
        ],
        'template_14' => [
            'id'            => 'template_14',
            'number'        => 14,
            'name_bn'       => 'দেশি ক্রাফট ও বুটিক (Deshi Heritage)',
            'name_en'       => 'Deshi Heritage Craft',
            'category_bn'   => 'হ্যান্ডিক্রাফট ও জামদানি/তাঁত',
            'category_en'   => 'Handicraft & Ethnic',
            'desc_bn'       => 'দেশীয় পোশাক, হস্তশিল্প ও ঐতিহ্যবাহী পণ্যের জন্য উষ্ণ ও শৈল্পিক উপস্থাপনা।',
            'font_name'     => 'Montserrat',
            'font_family'   => "'Montserrat', 'Hind Siliguri', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@500;700&family=Montserrat:wght@400;500;600;700;800&display=swap',
            'header_style'  => 'header_14',
            'footer_style'  => 'footer_14',
            'card_variant'  => 'card_14',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'bento',
            'prod_layout'   => 'sidebar',
            'palettes'      => ['bronze', 'crimson', 'amber', 'emerald'],
            'banner_style'  => 'royal_frame',
            'sale_style'    => 'ribbon_grid',
            'cat_style'     => 'circle_badges',
            'card_style'    => 'framed_luxe',
            'news_style'    => 'centered_card',
        ],
        'template_15' => [
            'id'            => 'template_15',
            'number'        => 15,
            'name_bn'       => 'স্নিকার ও স্ট্রিটওয়্যার (Urban Kicks)',
            'name_en'       => 'Urban Kicks Streetwear',
            'category_bn'   => 'জুতো ও স্ট্রিট ফ্যাশন',
            'category_en'   => 'Footwear & Streetwear',
            'desc_bn'       => 'জুতো, স্নিকার ও ট্রেন্ডি ফ্যাশনের জন্য বোল্ড কার্ড শ্যাডো এবং ডাইনামিক ব্যানার।',
            'font_name'     => 'Inter',
            'font_family'   => "'Inter', 'Noto Sans Bengali', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@500;700&display=swap',
            'header_style'  => 'header_15',
            'footer_style'  => 'footer_15',
            'card_variant'  => 'card_15',
            'sale_layout'   => 'carousel',
            'cat_layout'    => 'stories',
            'prod_layout'   => 'dense6',
            'palettes'      => ['violet', 'slate_noir', 'crimson', 'cyan'],
            'banner_style'  => 'cyber_dark',
            'sale_style'    => 'spotlight_cards',
            'cat_style'     => 'compact_chips',
            'card_style'    => 'bordered_tech',
            'news_style'    => 'dark_cyber',
        ],
        'template_16' => [
            'id'            => 'template_16',
            'number'        => 16,
            'name_bn'       => 'গুরমেট ফুড ও বেকারি (Sweet Crave)',
            'name_en'       => 'Sweet Crave Bakery & Food',
            'category_bn'   => 'হোমমেড ফুড ও স্ন্যাকস',
            'category_en'   => 'Food, Bakery & Sweets',
            'desc_bn'       => 'কেক, মিষ্টি, আচার ও হোমমেড খাবারের জন্য লোভনীয় রঙ ও সফট কার্ড ফ্রেম।',
            'font_name'     => 'Urbanist',
            'font_family'   => "'Urbanist', 'Anek Bangla', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@500;700&family=Urbanist:wght@400;500;600;700;800&display=swap',
            'header_style'  => 'header_16',
            'footer_style'  => 'footer_16',
            'card_variant'  => 'card_16',
            'sale_layout'   => 'bento',
            'cat_layout'    => 'bento',
            'prod_layout'   => 'sidebar',
            'palettes'      => ['orange', 'rose', 'amber', 'bronze'],
            'banner_style'  => 'soft_luxury',
            'sale_style'    => 'glow_deals',
            'cat_style'     => 'circle_badges',
            'card_style'    => 'luxury_pill',
            'news_style'    => 'centered_card',
        ],
        'template_17' => [
            'id'            => 'template_17',
            'number'        => 17,
            'name_bn'       => 'অটো পার্টস ও টুলস (MotoGear Pro)',
            'name_en'       => 'MotoGear & Hardware',
            'category_bn'   => 'বাইক এক্সেসরিজ ও হার্ডওয়্যার',
            'category_en'   => 'Auto & Hardware',
            'desc_bn'       => 'মোটরবাইক গিয়ার, টুলস ও মেশিনারিজ শপের জন্য ইন্ডাস্ট্রিয়াল গ্রিড ও মজবুত বর্ডার।',
            'font_name'     => 'Cabin',
            'font_family'   => "'Cabin', 'Hind Siliguri', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Cabin:wght@500;600;700&family=Hind+Siliguri:wght@500;700&display=swap',
            'header_style'  => 'header_17',
            'footer_style'  => 'footer_17',
            'card_variant'  => 'card_17',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'bento',
            'prod_layout'   => 'grid4',
            'palettes'      => ['slate_noir', 'crimson', 'orange', 'royal_blue'],
            'banner_style'  => 'cyber_dark',
            'sale_style'    => 'tech_flash',
            'cat_style'     => 'icon_tiles',
            'card_style'    => 'bordered_tech',
            'news_style'    => 'dark_cyber',
        ],
        'template_18' => [
            'id'            => 'template_18',
            'number'        => 18,
            'name_bn'       => 'গ্রিন নার্সারি ও অ্যাগ্রো (Eco Bloom)',
            'name_en'       => 'Eco Bloom Nursery',
            'category_bn'   => 'গাছ, বীজ ও কৃষি পণ্য',
            'category_en'   => 'Plants & Agro',
            'desc_bn'       => 'ছাদবাগান, ইনডোর প্ল্যান্ট ও কৃষি পণ্যের জন্য ন্যাচারাল গ্রিন-ফ্রেন্ডলি লেআউট।',
            'font_name'     => 'Rubik',
            'font_family'   => "'Rubik', 'Noto Sans Bengali', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@500;700&family=Rubik:wght@400;500;600;700;800&display=swap',
            'header_style'  => 'header_18',
            'footer_style'  => 'footer_18',
            'card_variant'  => 'card_18',
            'sale_layout'   => 'grid',
            'cat_layout'    => 'cards',
            'prod_layout'   => 'showcase3',
            'palettes'      => ['lime', 'emerald', 'teal', 'bronze'],
            'banner_style'  => 'fresh_organic',
            'sale_style'    => 'ribbon_grid',
            'cat_style'     => 'pill_cards',
            'card_style'    => 'editorial_soft',
            'news_style'    => 'soft_tinted',
        ],
        'template_19' => [
            'id'            => 'template_19',
            'number'        => 19,
            'name_bn'       => 'গিফট ও পার্টি শপ (JoyBox Gifts)',
            'name_en'       => 'JoyBox Gift Studio',
            'category_bn'   => 'গিফট হ্যাম্পার ও ইভেন্ট',
            'category_en'   => 'Gifts & Occasions',
            'desc_bn'       => 'উপহার সামগ্রী, ফুল ও কাস্টমাইজড মগ/টি-শার্ট শপের জন্য আকর্ষণীয় কার্ড ডিজাইন।',
            'font_name'     => 'Quicksand',
            'font_family'   => "'Quicksand', 'Baloo Da 2', cursive, sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&family=Quicksand:wght@500;600;700&display=swap',
            'header_style'  => 'header_19',
            'footer_style'  => 'footer_19',
            'card_variant'  => 'card_19',
            'sale_layout'   => 'carousel',
            'cat_layout'    => 'stories',
            'prod_layout'   => 'dense6',
            'palettes'      => ['rose', 'violet', 'fuchsia', 'amber'],
            'banner_style'  => 'playful_pop',
            'sale_style'    => 'glow_deals',
            'cat_style'     => 'circle_badges',
            'card_style'    => 'luxury_pill',
            'news_style'    => 'gradient_banner',
        ],
        'template_20' => [
            'id'            => 'template_20',
            'number'        => 20,
            'name_bn'       => 'সিগনেচার প্রিমিয়াম স্টোর (Signature Elite)',
            'name_en'       => 'Signature Elite Flagship',
            'category_bn'   => 'ফ্ল্যাগশিপ ব্র্যান্ড স্টোর',
            'category_en'   => 'Flagship D2C Brand',
            'desc_bn'       => 'এক্সক্লুসিভ ব্র্যান্ডের জন্য গ্লাসমরফিজম ব্যানার ও হাই-কনভার্সন শোকেস ডিজাইন।',
            'font_name'     => 'Manrope',
            'font_family'   => "'Manrope', 'Anek Bangla', sans-serif",
            'font_url'      => 'https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@600;700;800&family=Manrope:wght@500;600;700;800&display=swap',
            'header_style'  => 'header_20',
            'footer_style'  => 'footer_20',
            'card_variant'  => 'card_20',
            'sale_layout'   => 'spotlight',
            'cat_layout'    => 'chips',
            'prod_layout'   => 'showcase3',
            'palettes'      => ['indigo', 'violet', 'sky', 'emerald'],
            'banner_style'  => 'royal_frame',
            'sale_style'    => 'spotlight_cards',
            'cat_style'     => 'icon_tiles',
            'card_style'    => 'framed_luxe',
            'news_style'    => 'centered_card',
        ],
    ];
}

/**
 * Resolve active template and color palette for a store
 */
function resolveStoreTheme(array $store): array
{
    $templates = getStoreTemplates();
    $palettes  = getStoreColorPalettes();

    $templateId = $store['template_id'] ?? 'template_1';
    if (!isset($templates[$templateId])) {
        $templateId = 'template_1';
    }
    $activeTemplate = $templates[$templateId];

    $paletteId = $store['color_palette'] ?? ($activeTemplate['palettes'][0] ?? 'orange');
    if (!isset($palettes[$paletteId])) {
        $paletteId = $activeTemplate['palettes'][0] ?? 'orange';
    }
    $activePalette = $palettes[$paletteId];

    return [
        'template_id'   => $templateId,
        'palette_id'    => $paletteId,
        'template'      => $activeTemplate,
        'palette'       => $activePalette,
        'all_templates' => $templates,
        'all_palettes'  => $palettes,
    ];
}

/**
 * Render dynamic CSS overrides so that any `orange-*` utility classes
 * across all pages (Product Details, Category, Discount, Checkout, Admin, etc.)
 * automatically adopt the selected color palette shades!
 */
function renderThemePaletteCss(array $shades): string
{
    $s50  = $shades[50]  ?? '#fff7ed';
    $s100 = $shades[100] ?? '#ffedd5';
    $s200 = $shades[200] ?? '#fed7aa';
    $s300 = $shades[300] ?? '#fdba74';
    $s400 = $shades[400] ?? '#fb923c';
    $s500 = $shades[500] ?? '#f97316';
    $s600 = $shades[600] ?? '#ea580c';
    $s700 = $shades[700] ?? '#c2410c';
    $s800 = $shades[800] ?? '#9a3412';
    $s900 = $shades[900] ?? '#7c2d12';

    return <<<CSS
:root {
    --brand-50: {$s50};
    --brand-100: {$s100};
    --brand-200: {$s200};
    --brand-300: {$s300};
    --brand-400: {$s400};
    --brand-500: {$s500};
    --brand-600: {$s600};
    --brand-700: {$s700};
    --brand-800: {$s800};
    --brand-900: {$s900};
}

/* Header must NEVER be transparent - 100% Solid & Opaque across all templates */
header, header.sticky, #mainStoreHeader {
    opacity: 1 !important;
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
}

/* 1. Global Brand Utilities (100% Palette-Driven across all views) */
.bg-brand-50 { background-color: var(--brand-50) !important; }
.bg-brand-100 { background-color: var(--brand-100) !important; }
.bg-brand-200 { background-color: var(--brand-200) !important; }
.bg-brand-300 { background-color: var(--brand-300) !important; }
.bg-brand-400 { background-color: var(--brand-400) !important; }
.bg-brand-500 { background-color: var(--brand-500) !important; }
.bg-brand-600 { background-color: var(--brand-600) !important; }
.bg-brand-700 { background-color: var(--brand-700) !important; }
.bg-brand-800 { background-color: var(--brand-800) !important; }
.bg-brand-900 { background-color: var(--brand-900) !important; }

.hover\\:bg-brand-50:hover { background-color: var(--brand-50) !important; }
.hover\\:bg-brand-100:hover { background-color: var(--brand-100) !important; }
.hover\\:bg-brand-500:hover { background-color: var(--brand-500) !important; }
.hover\\:bg-brand-600:hover { background-color: var(--brand-600) !important; }
.hover\\:bg-brand-700:hover { background-color: var(--brand-700) !important; }
.hover\\:bg-brand-800:hover { background-color: var(--brand-800) !important; }

.text-brand-300 { color: var(--brand-300) !important; }
.text-brand-400 { color: var(--brand-400) !important; }
.text-brand-500 { color: var(--brand-500) !important; }
.text-brand-600 { color: var(--brand-600) !important; }
.text-brand-700 { color: var(--brand-700) !important; }
.text-brand-800 { color: var(--brand-800) !important; }
.text-brand-900 { color: var(--brand-900) !important; }

.hover\\:text-brand-400:hover { color: var(--brand-400) !important; }
.hover\\:text-brand-500:hover { color: var(--brand-500) !important; }
.hover\\:text-brand-600:hover { color: var(--brand-600) !important; }
.hover\\:text-brand-700:hover { color: var(--brand-700) !important; }

.border-brand-100 { border-color: var(--brand-100) !important; }
.border-brand-200 { border-color: var(--brand-200) !important; }
.border-brand-300 { border-color: var(--brand-300) !important; }
.border-brand-400 { border-color: var(--brand-400) !important; }
.border-brand-500 { border-color: var(--brand-500) !important; }
.border-brand-600 { border-color: var(--brand-600) !important; }
.border-brand-700 { border-color: var(--brand-700) !important; }

.hover\\:border-brand-400:hover { border-color: var(--brand-400) !important; }
.hover\\:border-brand-500:hover { border-color: var(--brand-500) !important; }
.hover\\:border-brand-600:hover { border-color: var(--brand-600) !important; }

.focus\\:border-brand-500:focus { border-color: var(--brand-500) !important; }
.focus\\:border-brand-600:focus { border-color: var(--brand-600) !important; }
.focus\\:ring-brand-500:focus { --tw-ring-color: var(--brand-500) !important; }
.ring-brand-200 { --tw-ring-color: var(--brand-200) !important; }

/* Gradients */
.from-brand-500 { --tw-gradient-from: var(--brand-500) var(--tw-gradient-from-position) !important; }
.from-brand-600 { --tw-gradient-from: var(--brand-600) var(--tw-gradient-from-position) !important; }
.from-brand-700 { --tw-gradient-from: var(--brand-700) var(--tw-gradient-from-position) !important; }
.via-brand-600 { --tw-gradient-via: var(--brand-600) var(--tw-gradient-via-position) !important; }
.via-brand-700 { --tw-gradient-via: var(--brand-700) var(--tw-gradient-via-position) !important; }
.to-brand-600 { --tw-gradient-to: var(--brand-600) var(--tw-gradient-to-position) !important; }
.to-brand-700 { --tw-gradient-to: var(--brand-700) var(--tw-gradient-to-position) !important; }
.to-brand-800 { --tw-gradient-to: var(--brand-800) var(--tw-gradient-to-position) !important; }

/* 2. Map legacy orange classes to active brand palette so all pages update simultaneously */
.bg-orange-50 { background-color: var(--brand-50) !important; }
.bg-orange-100 { background-color: var(--brand-100) !important; }
.bg-orange-200 { background-color: var(--brand-200) !important; }
.bg-orange-500 { background-color: var(--brand-500) !important; }
.bg-orange-600 { background-color: var(--brand-600) !important; }
.bg-orange-700 { background-color: var(--brand-700) !important; }
.hover\\:bg-orange-50:hover { background-color: var(--brand-50) !important; }
.hover\\:bg-orange-100:hover { background-color: var(--brand-100) !important; }
.hover\\:bg-orange-600:hover { background-color: var(--brand-600) !important; }
.hover\\:bg-orange-700:hover { background-color: var(--brand-700) !important; }
.text-orange-400 { color: var(--brand-400) !important; }
.text-orange-500 { color: var(--brand-500) !important; }
.text-orange-600 { color: var(--brand-600) !important; }
.text-orange-700 { color: var(--brand-700) !important; }
.text-orange-800 { color: var(--brand-800) !important; }
.hover\\:text-orange-600:hover { color: var(--brand-600) !important; }
.hover\\:text-orange-700:hover { color: var(--brand-700) !important; }
.border-orange-200 { border-color: var(--brand-200) !important; }
.border-orange-300 { border-color: var(--brand-300) !important; }
.border-orange-400 { border-color: var(--brand-400) !important; }
.border-orange-500 { border-color: var(--brand-500) !important; }
.border-orange-600 { border-color: var(--brand-600) !important; }
.hover\\:border-orange-300:hover { border-color: var(--brand-300) !important; }
.hover\\:border-orange-400:hover { border-color: var(--brand-400) !important; }
.hover\\:border-orange-500:hover { border-color: var(--brand-500) !important; }
.hover\\:border-orange-600:hover { border-color: var(--brand-600) !important; }
.focus\\:border-orange-500:focus { border-color: var(--brand-500) !important; }
.focus\\:border-orange-600:focus { border-color: var(--brand-600) !important; }
.focus\\:ring-orange-500:focus { --tw-ring-color: var(--brand-500) !important; }
.ring-orange-200 { --tw-ring-color: var(--brand-200) !important; }
.from-orange-500 { --tw-gradient-from: var(--brand-500) var(--tw-gradient-from-position) !important; }
.from-orange-600 { --tw-gradient-from: var(--brand-600) var(--tw-gradient-from-position) !important; }
.to-orange-600 { --tw-gradient-to: var(--brand-600) var(--tw-gradient-to-position) !important; }
.to-orange-700 { --tw-gradient-to: var(--brand-700) var(--tw-gradient-to-position) !important; }
.to-amber-600 { --tw-gradient-to: var(--brand-700) var(--tw-gradient-to-position) !important; }
.via-amber-600 { --tw-gradient-via: var(--brand-600) var(--tw-gradient-via-position) !important; }

/* 3. Opacity & Alpha mix fallbacks */
.bg-brand-50\/80, .bg-orange-50\/80 { background-color: color-mix(in srgb, var(--brand-50) 80%, transparent) !important; }
.bg-brand-50\/70, .bg-orange-50\/70 { background-color: color-mix(in srgb, var(--brand-50) 70%, transparent) !important; }
.bg-brand-50\/60, .bg-orange-50\/60 { background-color: color-mix(in srgb, var(--brand-50) 60%, transparent) !important; }
.bg-brand-50\/50, .bg-orange-50\/50 { background-color: color-mix(in srgb, var(--brand-50) 50%, transparent) !important; }
.bg-brand-50\/40, .bg-orange-50\/40 { background-color: color-mix(in srgb, var(--brand-50) 40%, transparent) !important; }
.bg-brand-50\/30, .bg-orange-50\/30 { background-color: color-mix(in srgb, var(--brand-50) 30%, transparent) !important; }
.bg-brand-100\/60, .bg-orange-100\/60 { background-color: color-mix(in srgb, var(--brand-100) 60%, transparent) !important; }
.bg-brand-600\/20, .bg-orange-600\/20 { background-color: color-mix(in srgb, var(--brand-600) 20%, transparent) !important; }
.bg-brand-600\/30, .bg-orange-600\/30 { background-color: color-mix(in srgb, var(--brand-600) 30%, transparent) !important; }
.border-brand-200\/80, .border-orange-200\/80 { border-color: color-mix(in srgb, var(--brand-200) 80%, transparent) !important; }
.border-brand-200\/60, .border-orange-200\/60 { border-color: color-mix(in srgb, var(--brand-200) 60%, transparent) !important; }
.border-brand-500\/40, .border-orange-500\/40 { border-color: color-mix(in srgb, var(--brand-500) 40%, transparent) !important; }
.border-brand-500\/30, .border-orange-500\/30 { border-color: color-mix(in srgb, var(--brand-500) 30%, transparent) !important; }
CSS;
}
