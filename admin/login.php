<?php

/**
 * Client Storefront - Store Owner Admin Login
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

$logoPath = !empty($store['logo_url']) ? $store['logo_url'] : ApiClient::assetUrl($store['logo'] ?? null);
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>স্টোর অ্যাডমিন লগইন | <?= htmlspecialchars($store['name']) ?></title>

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
                        brand: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>

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
                        duration: 3500,
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

        // Complete override: Swal will never open
        window.Swal = {
            fire: function(opts) {
                let msg = typeof opts === 'string' ? opts : (opts.text || opts.title || '');
                let icon = opts.icon || 'info';
                if (icon === 'success') Toast.success(msg);
                else if (icon === 'error') Toast.error(msg);
                else if (icon === 'warning') Toast.warning(msg);
                else Toast.info(msg);
                return Promise.resolve({ isConfirmed: true, value: true });
            }
        };
    </script>

    <!-- Store API Reusable Client -->
    <script src="../assets/js/api.js"></script>

    <style>
        body { font-family: 'Hind Siliguri', -apple-system, sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col justify-between text-slate-800 antialiased selection:bg-brand-100 selection:text-brand-700">

    <!-- Top Bar: Back to store & Language Switch -->
    <header class="w-full max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="../" class="inline-flex items-center space-x-2 text-xs font-semibold text-slate-600 hover:text-brand-600 transition bg-white border border-slate-200 px-3 py-1.5 rounded-xl shadow-xs">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span data-i18n="backToStore">স্টোরফ্রন্টে ফিরে যান</span>
        </a>


    </header>

    <!-- Main Container -->
    <main class="w-full max-w-md mx-auto px-4 py-6">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-200/50 p-6 sm:p-8">
            
            <!-- Store Branding Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center mb-3">
                    <?php if (!empty($logoPath)): ?>
                        <img src="<?= htmlspecialchars($logoPath) ?>" alt="<?= htmlspecialchars($store['name']) ?>" class="w-16 h-16 rounded-2xl object-cover border border-slate-200 shadow-sm">
                    <?php else: ?>
                        <div class="w-16 h-16 rounded-2xl bg-brand-600 text-white font-extrabold text-2xl flex items-center justify-center shadow-md">
                            <?= strtoupper(mb_substr($store['name'], 0, 1, 'UTF-8')) ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <h1 class="text-lg font-bold text-slate-900 leading-tight"><?= htmlspecialchars($store['name']) ?></h1>
                <p class="text-xs text-slate-500 mt-1 font-medium" data-i18n="loginSubtitle">স্টোর মালিকদের ড্যাশবোর্ড ও ম্যানেজমেন্ট পোর্টাল</p>
            </div>

            <!-- Login Form -->
            <form id="storeLoginForm" novalidate class="space-y-4">
                <!-- Email Field -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5" data-i18n="emailLabel">
                        ইমেইল ঠিকানা (Email Address) *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" id="email" placeholder="owner@apex-lifestyle.com"
                            class="w-full pl-9 pr-3 py-2.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-slate-700" data-i18n="passwordLabel">
                            পাসওয়ার্ড (Password) *
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" id="password" placeholder="••••••••"
                            class="w-full pl-9 pr-10 py-2.5 bg-white border border-slate-300 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100 transition shadow-xs">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                            <i data-lucide="eye" id="eyeIcon" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="btnLogin"
                    class="w-full mt-2 py-2.5 px-4 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl transition shadow-sm hover:shadow flex items-center justify-center space-x-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span id="btnLoginText" data-i18n="loginBtn">ড্যাশবোর্ডে প্রবেশ করুন</span>
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full max-w-md mx-auto px-4 py-4 text-center text-xs text-slate-400">
        &copy; <?= date('Y') ?> <?= htmlspecialchars($store['name']) ?> &bull; Powered by Headless Multi-Tenant SaaS
    </footer>

    <script>
        // Store UUID from configuration
        const STORE_UUID = "<?= htmlspecialchars(ApiClient::getStoreUuid()) ?>";
        const API_URL    = "<?= htmlspecialchars(ApiClient::getApiUrl()) ?>";

        StoreApi.init({
            apiUrl: API_URL,
            storeUuid: STORE_UUID
        });

        // Check if already authenticated
        if (StoreApi.getToken()) {
            // Verify if current token belongs to this store
            const stored = localStorage.getItem('store_tenant');
            if (stored) {
                try {
                    const parsed = JSON.parse(stored);
                    if (parsed.uuid === STORE_UUID) {
                        window.location.href = './';
                    }
                } catch(e) {}
            }
        }

        // Bilingual Dictionary
        const i18n = {
            bn: {
                pageTitle: 'স্টোর অ্যাডমিন লগইন | ' + "<?= addslashes($store['name']) ?>",
                backToStore: 'স্টোরফ্রন্টে ফিরে যান',
                loginSubtitle: 'স্টোর মালিকদের ড্যাশবোর্ড ও ম্যানেজমেন্ট পোর্টাল',
                emailLabel: 'ইমেইল ঠিকানা (Email Address) *',
                passwordLabel: 'পাসওয়ার্ড (Password) *',
                loginBtn: 'ড্যাশবোর্ডে প্রবেশ করুন',
                loggingIn: 'যাচাই করা হচ্ছে...',
                loginSuccessTitle: 'স্বাগতম!',
                loginSuccessText: 'ড্যাশবোর্ডে প্রবেশ করা হচ্ছে...',
                loginFailedTitle: 'লগইন ব্যর্থ হয়েছে',
                loginFailedText: 'ইমেইল অথবা পাসওয়ার্ড সঠিক নয়।',
                errorTitle: 'ত্রুটি',
            },
            en: {
                pageTitle: 'Store Admin Sign In | ' + "<?= addslashes($store['name']) ?>",
                backToStore: 'Back to Storefront',
                loginSubtitle: 'Storefront Owner Dashboard & Management Portal',
                emailLabel: 'Email Address *',
                passwordLabel: 'Password *',
                loginBtn: 'Sign In to Dashboard',
                loggingIn: 'Verifying...',
                loginSuccessTitle: 'Welcome Back!',
                loginSuccessText: 'Redirecting to your dashboard...',
                loginFailedTitle: 'Authentication Failed',
                loginFailedText: 'Invalid email or password.',
                errorTitle: 'Error',
            }
        };

        let currentLang = localStorage.getItem('client_lang') || 'bn';

        function switchLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('client_lang', lang);

            if (lang === 'bn') {
                $('#langBn').addClass('bg-brand-600 text-white font-bold').removeClass('text-slate-600');
                $('#langEn').removeClass('bg-brand-600 text-white font-bold').addClass('text-slate-600');
            } else {
                $('#langEn').addClass('bg-brand-600 text-white font-bold').removeClass('text-slate-600');
                $('#langBn').removeClass('bg-brand-600 text-white font-bold').addClass('text-slate-600');
            }

            $('[data-i18n]').each(function() {
                const key = $(this).attr('data-i18n');
                if (i18n[lang][key]) {
                    $(this).text(i18n[lang][key]);
                }
            });

            document.title = i18n[lang].pageTitle;
        }

        function togglePasswordVisibility() {
            const pwd = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                eye.setAttribute('data-lucide', 'eye-off');
            } else {
                pwd.type = 'password';
                eye.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        // Input clearing on user typing
        $('#email').on('input', function() {
            $(this).removeClass('border-red-500 ring-2 ring-red-100');
        });
        $('#password').on('input', function() {
            $(this).removeClass('border-red-500 ring-2 ring-red-100');
        });

        // Form Submit Handler
        $('#storeLoginForm').on('submit', async function(e) {
            e.preventDefault();

            const emailInput = $('#email');
            const passwordInput = $('#password');
            const email = emailInput.val().trim();
            const password = passwordInput.val();

            // Clear previous red borders
            emailInput.removeClass('border-red-500 ring-2 ring-red-100');
            passwordInput.removeClass('border-red-500 ring-2 ring-red-100');

            // 1. Validation for empty email
            if (!email) {
                emailInput.addClass('border-red-500 ring-2 ring-red-100').focus();
                Toast.error(currentLang === 'bn' ? 'অনুগ্রহ করে ইমেইল ঠিকানা প্রদান করুন।' : 'Please enter your email address.');
                return;
            }

            // 2. Validation for empty password
            if (!password) {
                passwordInput.addClass('border-red-500 ring-2 ring-red-100').focus();
                Toast.error(currentLang === 'bn' ? 'অনুগ্রহ করে পাসওয়ার্ড প্রদান করুন।' : 'Please enter your password.');
                return;
            }

            $('#btnLogin').prop('disabled', true);
            $('#btnLoginText').text(i18n[currentLang].loggingIn);

            try {
                const res = await StoreApi.post('tenants/auth/login', {
                    store_uuid: STORE_UUID,
                    email: email,
                    password: password
                });

                if (res.success && res.data && res.data.token) {
                    StoreApi.setToken(res.data.token);
                    localStorage.setItem('store_tenant', JSON.stringify(res.data.tenant));

                    Toast.success(i18n[currentLang].loginSuccessText || 'স্বাগতম! ড্যাশবোর্ডে প্রবেশ করা হচ্ছে...');

                    setTimeout(function() {
                        window.location.href = './';
                    }, 800);
                } else {
                    emailInput.addClass('border-red-500 ring-2 ring-red-100');
                    passwordInput.addClass('border-red-500 ring-2 ring-red-100');
                    Toast.error(res.message || i18n[currentLang].loginFailedText || 'ইমেইল অথবা পাসওয়ার্ড সঠিক নয়।');
                    $('#btnLogin').prop('disabled', false);
                    $('#btnLoginText').text(i18n[currentLang].loginBtn);
                }
            } catch (err) {
                emailInput.addClass('border-red-500 ring-2 ring-red-100');
                passwordInput.addClass('border-red-500 ring-2 ring-red-100');
                Toast.error(err.message || 'নেটওয়ার্ক সংযোগে সমস্যা হয়েছে।');
                $('#btnLogin').prop('disabled', false);
                $('#btnLoginText').text(i18n[currentLang].loginBtn);
            }
        });

        // Initialize icons and language on load
        $(document).ready(function() {
            lucide.createIcons();
            switchLanguage(currentLang);
        });
    </script>
</body>
</html>
