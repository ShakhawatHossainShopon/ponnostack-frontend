<?php

/**
 * Hardcoded Mock / Sample Catalog Data
 * Used as clean fallback when Store Owner has not uploaded live products yet.
 */

declare(strict_types=1);

function getSampleCategories(): array
{
    return [
        ['uuid' => 'cat-1', 'slug' => 'mens-fashion', 'name' => 'ছেলেদের ফ্যাশন'],
        ['uuid' => 'cat-2', 'slug' => 'womens-clothing', 'name' => 'মেয়েদের পোশাক'],
        ['uuid' => 'cat-3', 'slug' => 'watches-accessories', 'name' => 'ঘড়ি ও এক্সেসরিজ'],
        ['uuid' => 'cat-4', 'slug' => 'footwear', 'name' => 'জুতো ও ফুটওয়্যার'],
    ];
}

function getSampleProducts(): array
{
    return [
        [
            'uuid' => 'prod-1',
            'slug' => 'premium-cotton-polo-shirt',
            'name' => 'প্রিমিয়াম কটন পোলো শার্ট',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 950.00,
            'effective_price' => 750.00,
            'has_discount' => 1,
            'discount_percent' => 21,
            'stock' => 25,
            'images' => [
                'assets/products/images (1).jpg',
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => ['M', 'L', 'XL'],
            'colors' => ['Navy Blue', 'Black', 'Maroon'],
            'description' => '১০০% কম্বড সুতির তৈরি আরামদায়ক ক্যাজুয়াল পোলো টি-শার্ট। সব ঋতুতে পরিধানযোগ্য এবং লং-লাস্টিং ফ্যাব্রিক কালার।'
        ],
        [
            'uuid' => 'prod-2',
            'slug' => 'designer-traditional-panjabi',
            'name' => 'ডিজাইনার ট্র্যাডিশনাল পাঞ্জাবি',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 1850.00,
            'effective_price' => 1450.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 18,
            'images' => [
                'assets/products/images (2).jpg',
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['40', '42', '44'],
            'colors' => ['White', 'Off-White', 'Black'],
            'description' => 'আভিজাত্য ও ঐতিহ্যের ছোঁয়ায় প্রিমিয়াম কারুকাজ করা আরামদায়ক পাঞ্জাবি। যেকোনো উৎসব বা অনুষ্ঠানের জন্য সেরা পছন্দ।'
        ],
        [
            'uuid' => 'prod-3',
            'slug' => 'classic-leather-strap-watch',
            'name' => 'ক্লাসিক লেদার স্ট্র্যাপ ক্রোনো ওয়াচ',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 2400.00,
            'effective_price' => 1890.00,
            'has_discount' => 1,
            'discount_percent' => 21,
            'stock' => 12,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => [],
            'colors' => ['Brown Leather', 'Black Leather'],
            'description' => 'ওয়াটার রেজিস্ট্যান্ট জাপানিজ মুভমেন্ট এনালগ ক্রোনোগ্রাফ ঘড়ি। জেনুইন লেদার স্ট্র্যাপ ও প্রিমিয়াম স্টেইনলেস স্টিল ডায়াল।'
        ],
        [
            'uuid' => 'prod-4',
            'slug' => 'elegant-linen-casual-shirt',
            'name' => 'এলিগেন্ট লিনেন ক্যাজুয়াল শার্ট',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 1200.00,
            'effective_price' => 1200.00,
            'has_discount' => 0,
            'discount_percent' => 0,
            'stock' => 30,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => ['M', 'L', 'XL', 'XXL'],
            'colors' => ['Sky Blue', 'White', 'Olive'],
            'description' => '১০০% পিওর লিনেন ফেব্রিকের স্লিম-ফিট ক্যাজুয়াল ফুল স্লিভ শার্ট। অফিস বা আউটিং-এ দারুণ স্মার্ট লুক প্রদান করে।'
        ],
        [
            'uuid' => 'prod-5',
            'slug' => 'minimalist-leather-travel-wallet',
            'name' => 'মিনিমালিস্ট লেদার ট্রাভেল ওয়ালেট',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 850.00,
            'effective_price' => 650.00,
            'has_discount' => 1,
            'discount_percent' => 24,
            'stock' => 40,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => [],
            'colors' => ['Tan Brown', 'Dark Coffee'],
            'description' => 'কমপ্যাক্ট আরএফআইডি প্রটেক্টেড প্রিমিয়াম জেনুইন লেদার মানিব্যাগ। কার্ড ও কারেন্সি বহনের জন্য আল্ট্রা-স্লিম ডিজাইন।'
        ],
        [
            'uuid' => 'prod-6',
            'slug' => 'breathable-lightweight-sneakers',
            'name' => 'ব্রিদেবল লাইটওয়েট স্নিকার্স',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 1950.00,
            'effective_price' => 1590.00,
            'has_discount' => 1,
            'discount_percent' => 18,
            'stock' => 15,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['40', '41', '42', '43'],
            'colors' => ['All Black', 'Grey', 'Navy'],
            'description' => 'হালকা ও নরম কুশনযুক্ত আরামদায়ক ক্যাজুয়াল স্নিকার্স। প্রতিদিনের হাঁটাচলা ও ভ্রমণের জন্য সর্বোত্তম।'
        ],
        [
            'uuid' => 'prod-7',
            'slug' => 'royal-embroidered-cotton-kurti',
            'name' => 'রয়্যাল এমব্রয়ডারিড কটন কুর্তি',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 1650.00,
            'effective_price' => 1290.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 20,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => ['M', 'L', 'XL'],
            'colors' => ['Pastel Pink', 'Mint Green'],
            'description' => 'সূক্ষ্ম কারুকাজে তৈরি প্রিমিয়াম কটন কুর্তি। উৎসব ও প্রতিদিনের ব্যবহারে অতুলনীয় আরাম ও সৌন্দর্য।'
        ],
        [
            'uuid' => 'prod-8',
            'slug' => 'smart-fitness-tracker-watch',
            'name' => 'স্মার্ট ফিটনেস ট্র্যাকার ওয়াচ',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 2800.00,
            'effective_price' => 2190.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 16,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => [],
            'colors' => ['Midnight Black', 'Rose Gold'],
            'description' => 'হার্ট রেট, স্লিপ ও স্টেপ কাউন্টযুক্ত ওয়াটারপ্রুফ স্মার্ট ফিটনেস ওয়াচ। শক্তিশালী ব্যাটারি ব্যাকআপ।'
        ],
        [
            'uuid' => 'prod-9',
            'slug' => 'casual-comfort-denim-jeans',
            'name' => 'ক্যাজুয়াল কমফোর্ট ডেনিম জিন্স',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 1450.00,
            'effective_price' => 1150.00,
            'has_discount' => 1,
            'discount_percent' => 20,
            'stock' => 22,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => ['30', '32', '34', '36'],
            'colors' => ['Dark Wash Blue', 'Vintage Grey'],
            'description' => 'স্ট্রেচেবল হাই কোয়ালিটি ডেনিম ফেব্রিক। দীর্ঘ সময় পরেও আরাম বজায় থাকে।'
        ],
        [
            'uuid' => 'prod-10',
            'slug' => 'floral-chiffon-long-gown',
            'name' => 'ফ্লোরাল শিফন লং গাউন',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 2200.00,
            'effective_price' => 1750.00,
            'has_discount' => 1,
            'discount_percent' => 20,
            'stock' => 14,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['Free Size'],
            'colors' => ['Floral Blue', 'Blush Red'],
            'description' => 'আকর্ষণীয় ফ্লোরাল প্রিন্ট ও আধুনিক সিলুয়েটের শিফন গাউন। যেকোনো পার্টি বা আউটিং-এ পারফেক্ট লুক।'
        ],
        [
            'uuid' => 'prod-11',
            'slug' => 'genuine-leather-formal-oxford',
            'name' => 'জেনুইন লেদার ফর্মাল অক্সফোর্ড শু',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 2950.00,
            'effective_price' => 2450.00,
            'has_discount' => 1,
            'discount_percent' => 17,
            'stock' => 10,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => ['40', '41', '42', '43', '44'],
            'colors' => ['Classic Tan', 'Glossy Black'],
            'description' => 'হাতে তৈরি খাঁটি চামড়ার এক্সিকিউটিভ অক্সফোর্ড শু। অ্যান্টি-স্লিপ রাবার সোল ও নরম কুশন ইনসোল।'
        ],
        [
            'uuid' => 'prod-12',
            'slug' => 'uv-polaroid-vintage-sunglasses',
            'name' => 'ইউভি পোলারাইজড ভিন্টেজ সানগ্লাস',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 890.00,
            'effective_price' => 690.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 35,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => [],
            'colors' => ['Matte Black', 'Tortoise'],
            'description' => 'UV400 প্রটেক্টেড লেন্স যা রোদে চোখের পূর্ণ সুরক্ষা দেয়। মেটাল হিঞ্জযুক্ত টেকসই ফ্রেম।'
        ],
        [
            'uuid' => 'prod-13',
            'slug' => 'organic-linen-handloom-saree',
            'name' => 'অরগানিক লিনেন হ্যান্ডলুম শাড়ি',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 2600.00,
            'effective_price' => 2100.00,
            'has_discount' => 1,
            'discount_percent' => 19,
            'stock' => 8,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => ['12 Haat with Blouse Piece'],
            'colors' => ['Mustard Yellow', 'Deep Teal'],
            'description' => 'তাঁতিদের হাতে বোনা খাঁটি লিনেন শাড়ি। ঐতিহ্যবাহী আঁচল ডিজাইন এবং ব্লাউজ পিস অন্তর্ভুক্ত।'
        ],
        [
            'uuid' => 'prod-14',
            'slug' => 'sporty-comfort-cushion-slides',
            'name' => 'স্পোর্টি কমফোর্ট কুশন স্লাইডস',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 650.00,
            'effective_price' => 490.00,
            'has_discount' => 1,
            'discount_percent' => 25,
            'stock' => 50,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['39', '40', '41', '42'],
            'colors' => ['Grey', 'Navy Blue', 'Olive'],
            'description' => 'ইভা ফোম সোলযুক্ত সুপার সফট ওয়াটারপ্রুফ স্লাইডস। ঘরে ও বাইরে হাঁটায় অতুলনীয় আরামদায়ক।'
        ],
        [
            'uuid' => 'prod-15',
            'slug' => 'executive-metal-ballpoint-pen',
            'name' => 'এক্সিকিউটিভ মেটাল বলপয়েন্ট সেট',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 550.00,
            'effective_price' => 420.00,
            'has_discount' => 1,
            'discount_percent' => 24,
            'stock' => 60,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => [],
            'colors' => ['Matte Gold', 'Silver Chrome'],
            'description' => 'উপহার বা প্রফেশনাল ব্যবহারের জন্য রাজকীয় মেটালিক কলম সেট। স্মুথ ব্লু রিফিল অন্তর্ভুক্ত।'
        ],
        [
            'uuid' => 'prod-16',
            'slug' => 'pure-silk-printed-scarf',
            'name' => 'পিওর সিল্ক প্রিন্টেড স্কার্ফ',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 750.00,
            'effective_price' => 590.00,
            'has_discount' => 1,
            'discount_percent' => 21,
            'stock' => 28,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => ['Standard'],
            'colors' => ['Pastel Floral', 'Geometric Navy'],
            'description' => 'মৃদু মোলায়েম সিল্ক ফেব্রিক। আধুনিক হিজাব বা স্কার্ফ হিসেবে স্টাইলিংয়ের জন্য চমৎকার।'
        ],
        [
            'uuid' => 'prod-17',
            'slug' => 'premium-twill-chino-pant',
            'name' => 'প্রিমিয়াম টুইল চিনো প্যান্ট',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 1550.00,
            'effective_price' => 1250.00,
            'has_discount' => 1,
            'discount_percent' => 19,
            'stock' => 30,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => ['30', '32', '34', '36'],
            'colors' => ['Khaki', 'Navy Blue', 'Olive'],
            'description' => '১০০% কটন টুইল ফেব্রিক। অফিস বা ক্যাজুয়াল ব্যবহারে অত্যন্ত আরামদায়ক ও ট্রেন্ডি লুক দেয়।'
        ],
        [
            'uuid' => 'prod-18',
            'slug' => 'georgette-party-wear-dress',
            'name' => 'জর্জেট পার্টি ওয়্যার আনস্টিচড ড্রেস',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 2950.00,
            'effective_price' => 2350.00,
            'has_discount' => 1,
            'discount_percent' => 20,
            'stock' => 12,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['Unstitched'],
            'colors' => ['Emerald Green', 'Royal Navy'],
            'description' => 'সূক্ষ্ম এমব্রয়ডারি ও সিকোয়েন্স কাজের প্রিমিয়াম জর্জেট থ্রি-পিস। বিয়ে ও বিশেষ অনুষ্ঠানের জন্য উপযুক্ত।'
        ],
        [
            'uuid' => 'prod-19',
            'slug' => 'automatic-mechanical-leather-watch',
            'name' => 'অটোমেটিক মেকানিকাল লেদার ওয়াচ',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 4200.00,
            'effective_price' => 3450.00,
            'has_discount' => 1,
            'discount_percent' => 18,
            'stock' => 9,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => [],
            'colors' => ['Rose Gold Black', 'Silver Brown'],
            'description' => 'ব্যাটারিবিহীন সেলফ-ওয়াইন্ডিং মেকানিকাল মুভমেন্ট ঘড়ি। স্ক্র্যাচপ্রুফ স্যাফায়ার গ্লাস ও আসল চামড়ার বেল্ট।'
        ],
        [
            'uuid' => 'prod-20',
            'slug' => 'comfort-slip-on-loafer-shoes',
            'name' => 'কমফোর্ট স্লিপ-অন লোফার শু',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 2650.00,
            'effective_price' => 2150.00,
            'has_discount' => 1,
            'discount_percent' => 19,
            'stock' => 16,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => ['40', '41', '42', '43'],
            'colors' => ['Dark Chocolate', 'Navy Suede'],
            'description' => 'লেইস ছাড়া সহজে পরার উপযোগী সফট কুশন ইনসোলযুক্ত প্রিমিয়াম লোফার। ফরমাল ও সেমি-ফরমাল দুই জায়গাতেই মানানসই।'
        ],
        [
            'uuid' => 'prod-21',
            'slug' => 'high-neck-slim-fit-sweater',
            'name' => 'হাই-নেক স্লিম ফিট উইন্টার সোয়েটার',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 1250.00,
            'effective_price' => 950.00,
            'has_discount' => 1,
            'discount_percent' => 24,
            'stock' => 18,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['M', 'L', 'XL'],
            'colors' => ['Charcoal Grey', 'Wine Red'],
            'description' => 'নরম উল ব্লেন্ড ফ্যাব্রিকে তৈরি প্রিমিয়াম হাই-নেক সোয়েটার। শীতের মৌসুমে স্টাইলিশ ও উষ্ণ রাখে।'
        ],
        [
            'uuid' => 'prod-22',
            'slug' => 'handcrafted-block-print-kameez',
            'name' => 'হ্যান্ডক্রাফটেড ব্লক প্রিন্ট কামিজ',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 1850.00,
            'effective_price' => 1450.00,
            'has_discount' => 1,
            'discount_percent' => 21,
            'stock' => 20,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => ['38', '40', '42', '44'],
            'colors' => ['Indigo Blue', 'Turmeric Yellow'],
            'description' => 'খাঁটি সুতি কাপড়ে প্রাকৃতিক রঙে হাতে করা ঐতিহ্যবাহী ব্লক প্রিন্ট। আরাম ও আভিজাত্যের অনন্য সমন্বয়।'
        ],
        [
            'uuid' => 'prod-23',
            'slug' => 'premium-leather-travel-duffle-bag',
            'name' => 'প্রিমিয়াম লেদার ট্রাভেল ডাফেল ব্যাগ',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 4800.00,
            'effective_price' => 3800.00,
            'has_discount' => 1,
            'discount_percent' => 21,
            'stock' => 8,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => [],
            'colors' => ['Antique Brown', 'Midnight Black'],
            'description' => 'ভ্রমণ ও উইকএন্ড ট্রিপের জন্য প্রিমিয়াম জেনুইন লেদার ডাফেল ব্যাগ। ওয়াটার রেসিস্ট্যান্ট ও মজবুত জিপার।'
        ],
        [
            'uuid' => 'prod-24',
            'slug' => 'athletic-running-sports-shoes',
            'name' => 'অ্যাথলেটিক রানিং স্পোর্টস শু',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 2950.00,
            'effective_price' => 2350.00,
            'has_discount' => 1,
            'discount_percent' => 20,
            'stock' => 14,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => ['41', '42', '43', '44'],
            'colors' => ['Neon Orange Black', 'White Silver'],
            'description' => 'শক-অ্যাবজরবিং এয়ার কুশন সোলযুক্ত অ্যাথলেটিক রানিং শু। দীর্ঘক্ষণ দৌড়ানো বা হাঁটায় পায়ের পেশি আরামদায়ক রাখে।'
        ],
        [
            'uuid' => 'prod-25',
            'slug' => 'classic-check-formal-shirt',
            'name' => 'ক্লাসিক চেক ফরমাল কটন শার্ট',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 1350.00,
            'effective_price' => 1050.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 24,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => ['M', 'L', 'XL', 'XXL'],
            'colors' => ['Sky Blue Check', 'White Navy Check'],
            'description' => 'ব্রিদেবল পিওর কটন ফেব্রিক। সারাদিন ব্যবহারের জন্য কুঁচকে না যাওয়া রিংকল-ফ্রি ফিনিশিং।'
        ],
        [
            'uuid' => 'prod-26',
            'slug' => 'silk-embroidered-party-dupatta',
            'name' => 'সিল্ক এমব্রয়ডারিড পার্টি ওড়না',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 1150.00,
            'effective_price' => 890.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 25,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => ['Standard'],
            'colors' => ['Crimson Red', 'Golden Zari'],
            'description' => 'জারদৌসি ও রেশম সুতার সূচিকর্মে সাজানো আকর্ষণীয় পার্টি ওড়না। যেকোনো সাধারণ ড্রেসকে দেয় জমকালো লুক।'
        ],
        [
            'uuid' => 'prod-27',
            'slug' => 'anti-blue-ray-computer-glasses',
            'name' => 'অ্যান্টি-ব্লু রে স্টাইলিশ কম্পিউটার গ্লাস',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 980.00,
            'effective_price' => 750.00,
            'has_discount' => 1,
            'discount_percent' => 23,
            'stock' => 40,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => [],
            'colors' => ['Glossy Black', 'Transparent Crystal'],
            'description' => 'কম্পিউটার ও মোবাইল স্ক্রিনের ক্ষতিকর নীল আলো প্রতিরোধক লেন্স। মাথা ব্যথা ও চোখের ক্লান্তি দূর করে।'
        ],
        [
            'uuid' => 'prod-28',
            'slug' => 'leather-sleeper-sandals',
            'name' => 'লেদার স্লিপার স্যান্ডেল',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 1450.00,
            'effective_price' => 1150.00,
            'has_discount' => 1,
            'discount_percent' => 21,
            'stock' => 25,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => ['40', '41', '42', '43'],
            'colors' => ['Tan Brown', 'Dark Coffee'],
            'description' => 'প্রাকৃতিক চামড়ায় তৈরি আরামদায়ক টু-স্ট্র্যাপ ক্যাজুয়াল স্যান্ডেল। গ্রিপযুক্ত টেকসই রাবার আউটসোল।'
        ],
        [
            'uuid' => 'prod-29',
            'slug' => 'dry-fit-sports-track-pant',
            'name' => 'ড্রাই-ফিট স্পোর্টস ট্র্যাক প্যান্ট',
            'category_name' => 'ছেলেদের ফ্যাশন',
            'category_uuid' => 'cat-1',
            'retailer_price' => 850.00,
            'effective_price' => 650.00,
            'has_discount' => 1,
            'discount_percent' => 23,
            'stock' => 45,
            'images' => [
                'assets/products/images.jpg'
            ],
            'primary_image' => 'assets/products/images.jpg',
            'sizes' => ['L', 'XL', 'XXL'],
            'colors' => ['Black', 'Dark Ash'],
            'description' => 'জিম, রানিং ও স্পোর্টস অ্যাক্টিভিটির জন্য পারফেক্ট ড্রাই-ফিট স্ট্রেচ ফেব্রিকের ট্রাউজার।'
        ],
        [
            'uuid' => 'prod-30',
            'slug' => 'fashionable-casual-denim-jacket',
            'name' => 'ফ্যাশনেবল ক্যাজুয়াল ডেনিম জ্যাকেট',
            'category_name' => 'মেয়েদের পোশাক',
            'category_uuid' => 'cat-2',
            'retailer_price' => 2300.00,
            'effective_price' => 1850.00,
            'has_discount' => 1,
            'discount_percent' => 19,
            'stock' => 15,
            'images' => [
                'assets/products/images (1).jpg'
            ],
            'primary_image' => 'assets/products/images (1).jpg',
            'sizes' => ['S', 'M', 'L'],
            'colors' => ['Light Washed Blue', 'Vintage Indigo'],
            'description' => 'আধুনিক ট্রেন্ডি ক্রপ কাট ডেনিম জ্যাকেট। মেটাল বাটন ও টেকসই সেলাই দিয়ে তৈরি।'
        ],
        [
            'uuid' => 'prod-31',
            'slug' => 'smart-card-holder-metal-wallet',
            'name' => 'স্মার্ট কার্ড হোল্ডার মেটাল ওয়ালেট',
            'category_name' => 'ঘড়ি ও এক্সেসরিজ',
            'category_uuid' => 'cat-3',
            'retailer_price' => 790.00,
            'effective_price' => 590.00,
            'has_discount' => 1,
            'discount_percent' => 25,
            'stock' => 35,
            'images' => [
                'assets/products/images (2).jpg'
            ],
            'primary_image' => 'assets/products/images (2).jpg',
            'sizes' => [],
            'colors' => ['Space Grey', 'Matte Carbon'],
            'description' => 'এক ক্লিকে কার্ড বের করার পপ-আপ মেকানিজম ও আরএফআইডি ব্লকিং প্রযুক্তিযুক্ত অ্যালুমিনিয়াম কার্ড ওয়ালেট।'
        ],
        [
            'uuid' => 'prod-32',
            'slug' => 'casual-canvas-lace-up-shoes',
            'name' => 'ক্যাজুয়াল ক্যানভাস লেইস-আপ শু',
            'category_name' => 'জুতো ও ফুটওয়্যার',
            'category_uuid' => 'cat-4',
            'retailer_price' => 1650.00,
            'effective_price' => 1290.00,
            'has_discount' => 1,
            'discount_percent' => 22,
            'stock' => 22,
            'images' => [
                'assets/products/images (3).jpg'
            ],
            'primary_image' => 'assets/products/images (3).jpg',
            'sizes' => ['40', '41', '42', '43'],
            'colors' => ['Classic Black', 'Off White'],
            'description' => 'চিরসবুজ ক্লাসিক ক্যানভাস স্নিকার্স। তরুণদের ক্যাজুয়াল জিন্স বা চিনোর সাথে প্রতিদিনের ব্যবহারের জন্য নিখুঁত।'
        ]
    ];
}
