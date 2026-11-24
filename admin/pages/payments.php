<?php
/**
 * Admin Panel - SaaS Subscription, bKash Payment & Invoices Management
 * 
 * Features:
 * - Real-time subscription validity countdown & expiration alerts
 * - Universal bKash Number (from .env)
 * - 2-Step Payment Form (Send Money instructions + Verification submission)
 * - Paginated Invoices & Transaction History
 * - Printable Official Invoice Modal with PDF / Print support
 */

declare(strict_types=1);

$storeBkashNumber = $storeBkashNumber ?? ApiClient::getBkashNumber();
?>
                <!-- ========================================== -->
                <section id="tabContentPayments" class="hidden space-y-5 max-w-full overflow-hidden">
                    <!-- Top Header Card -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-start sm:items-center space-x-3">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-pink-50 text-pink-600 border border-pink-200 flex items-center justify-center shrink-0 shadow-2xs">
                                <i data-lucide="credit-card" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h2 class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">ওয়েবসাইট সাবস্ক্রিপশন ও পেমেন্ট (SaaS Billing)</h2>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-pink-50 text-pink-700 border border-pink-200 shrink-0">
                                        বিকাশ পেমেন্ট
                                    </span>
                                </div>
                                <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                                    আপনার স্টোরের মাসিক সার্ভিস ফি বিকাশ দিয়ে পরিশোধ করুন ও পূর্ববর্তী ইনভয়েস হিস্ট্রি দেখুন
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center shrink-0 pt-1 sm:pt-0">
                            <span id="saasStoreStatusBadge" class="px-2.5 py-1 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-black flex items-center space-x-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>স্টোর স্ট্যাটাস: সচল (Active)</span>
                            </span>
                        </div>
                    </div>

                    <!-- Dynamic Billing Alert Box (Overdue / Expiring Soon) -->
                    <div id="saasSubscriptionAlertContainer"></div>

                    <!-- Clean Status Info: Subscription Validity & Payment Due (2 Cards) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <!-- Card 1: Subscription Ends -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex items-center justify-between gap-3 hover:border-emerald-200 transition">
                            <div class="min-w-0">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">সাবস্ক্রিপশনের মেয়াদ শেষ হবে</span>
                                <div id="saasSubscriptionEndDateDisplay" class="text-base sm:text-lg font-black text-slate-900 mt-0.5 truncate">লোড হচ্ছে...</div>
                                <div id="saasSubscriptionDaysBadge" class="flex items-center space-x-1.5 text-[11px] text-emerald-700 font-extrabold mt-1">
                                    <span class="px-2 py-0.5 rounded-md bg-emerald-50 border border-emerald-200">হিসাব করা হচ্ছে...</span>
                                    <span class="text-slate-400 font-normal">পরবর্তী নবায়ন আবশ্যক</span>
                                </div>
                            </div>
                            <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center shrink-0">
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            </div>
                        </div>

                        <!-- Card 2: Next Payment & Amount Due -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-xs flex items-center justify-between gap-3 hover:border-pink-200 transition">
                            <div class="min-w-0">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">পরবর্তী পেমেন্ট ও প্রদেয় ফি</span>
                                <div class="text-base sm:text-lg font-black text-pink-600 mt-0.5"><span id="saasMonthlyFeeDisplay">৳ <?= number_format((float)($store['monthly_fee'] ?? 999.00)) ?></span> <span class="text-xs font-normal text-slate-400">/ প্রতি মাস</span></div>
                                <div class="flex items-center space-x-1.5 text-[11px] text-pink-700 font-extrabold mt-1">
                                    <span id="saasNextPaymentDueBadge" class="px-2 py-0.5 rounded-md bg-pink-50 border border-pink-200">প্রতি মাসের <?= (int)($store['billing_day'] ?? 10) ?> তারিখের মধ্যে প্রদেয়</span>
                                </div>
                            </div>
                            <div class="w-11 h-11 rounded-2xl bg-pink-50 text-pink-600 border border-pink-100 flex items-center justify-center shrink-0">
                                <i data-lucide="wallet-cards" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- 2-STEP BKASH PAYMENT CONTAINER -->
                    <!-- ============================================== -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-6 shadow-xs space-y-5">
                        <!-- Step Navigation Progress Bar -->
                        <div class="border-b border-slate-100 pb-4">
                            <div class="grid grid-cols-2 gap-2 max-w-md mx-auto">
                                <!-- Step 1 Tab -->
                                <button type="button" onclick="goToSaasPaymentStep(1)" id="tabBtnStep1"
                                    class="flex items-center justify-center space-x-2 py-2 px-3 rounded-xl border-2 border-pink-600 bg-pink-50/70 text-pink-700 text-xs font-black transition cursor-pointer">
                                    <span class="w-5 h-5 rounded-full bg-pink-600 text-white text-[10px] flex items-center justify-center shrink-0 font-black">১</span>
                                    <span class="truncate">১. টাকা পাঠান</span>
                                </button>

                                <!-- Step 2 Tab -->
                                <button type="button" onclick="goToSaasPaymentStep(2)" id="tabBtnStep2"
                                    class="flex items-center justify-center space-x-2 py-2 px-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-slate-500 text-xs font-bold transition cursor-pointer hover:border-slate-300">
                                    <span class="w-5 h-5 rounded-full bg-slate-200 text-slate-600 text-[10px] flex items-center justify-center shrink-0 font-black">২</span>
                                    <span class="truncate">২. প্রেরক নম্বর দিন</span>
                                </button>
                            </div>
                        </div>

                        <!-- ----------------------------------------- -->
                        <!-- STEP 1 PANEL: TRANSFER INSTRUCTIONS & NUMBER -->
                        <!-- ----------------------------------------- -->
                        <div id="saasPayStep1Panel" class="space-y-4 sm:space-y-5">
                            <!-- SaaS Owner bKash Number Highlight Box -->
                            <div class="bg-gradient-to-br from-pink-50/90 via-pink-50/40 to-white border-2 border-pink-200 rounded-2xl p-4 sm:p-5 text-center space-y-2.5 shadow-2xs">
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold bg-pink-100 text-pink-800">
                                    <i data-lucide="phone-outgoing" class="w-3.5 h-3.5 text-pink-600"></i>
                                    <span>আমাদের বিকাশ সেন্ড মানি নম্বর</span>
                                </span>

                                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-3 pt-1">
                                    <div class="w-full sm:w-auto px-4 py-2 sm:py-2.5 bg-white border-2 border-pink-300 rounded-xl font-mono text-xl sm:text-2xl font-black text-pink-600 tracking-wider shadow-xs select-all text-center" id="saasBkashNumberDisplay">
                                        <?= htmlspecialchars($storeBkashNumber) ?>
                                    </div>
                                    <button type="button" onclick="copySaasBkashNumber('<?= htmlspecialchars($storeBkashNumber) ?>')" id="btnCopyBkashNumber"
                                        class="w-full sm:w-auto px-4 py-2 sm:py-2.5 bg-pink-600 hover:bg-pink-700 active:scale-98 text-white rounded-xl text-xs font-bold transition flex items-center justify-center space-x-1.5 cursor-pointer shadow-xs">
                                        <i data-lucide="copy" class="w-3.5 h-3.5 shrink-0"></i>
                                        <span id="btnCopyBkashText">নম্বর কপি করুন</span>
                                    </button>
                                </div>

                                <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-4 text-[11px] font-bold text-slate-600 pt-1">
                                    <span class="flex items-center space-x-1">
                                        <i data-lucide="credit-card" class="w-3.5 h-3.5 text-pink-600 shrink-0"></i>
                                        <span>অ্যাকাউন্ট: বিকাশ পার্সোনাল</span>
                                    </span>
                                    <span class="hidden sm:inline text-slate-300">•</span>
                                    <span class="flex items-center space-x-1">
                                        <i data-lucide="coins" class="w-3.5 h-3.5 text-amber-600 shrink-0"></i>
                                        <span>টাকার পরিমাণ: <strong id="saasStep1AmountDisplay" class="text-slate-900 font-black">৳ <?= number_format((float)($store['monthly_fee'] ?? 999.00)) ?></strong></span>
                                    </span>
                                </div>
                            </div>

                            <!-- Detailed Step-by-Step Instructions -->
                            <div class="bg-slate-50/80 border border-slate-200 rounded-2xl p-3.5 sm:p-4 space-y-2.5">
                                <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider flex items-center space-x-2">
                                    <i data-lucide="list-ordered" class="w-4 h-4 text-pink-600 shrink-0"></i>
                                    <span>বিকাশ থেকে ফি পাঠানোর সহজ নিয়মাবলী (How to Transfer)</span>
                                </h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-2.5 text-xs">
                                    <div class="flex items-start space-x-2.5 p-2.5 bg-white border border-slate-200 rounded-xl">
                                        <span class="w-5 h-5 rounded-md bg-pink-50 text-pink-600 font-black text-xs flex items-center justify-center shrink-0">১</span>
                                        <div class="min-w-0">
                                            <strong class="text-slate-800 block text-xs">বিকাশ অ্যাপ ওপেন করুন</strong>
                                            <span class="text-slate-500 text-[11px] block leading-tight">বিকাশ অ্যাপ খুলুন অথবা <code class="font-mono bg-slate-100 px-1 rounded">*247#</code> ডায়াল করুন।</span>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-2.5 p-2.5 bg-white border border-slate-200 rounded-xl">
                                        <span class="w-5 h-5 rounded-md bg-pink-50 text-pink-600 font-black text-xs flex items-center justify-center shrink-0">২</span>
                                        <div class="min-w-0">
                                            <strong class="text-slate-800 block text-xs">"Send Money" চাপুন</strong>
                                            <span class="text-slate-500 text-[11px] block leading-tight">মেনু থেকে সেন্ড মানি অপশনটি সিলেক্ট করুন।</span>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-2.5 p-2.5 bg-white border border-slate-200 rounded-xl">
                                        <span class="w-5 h-5 rounded-md bg-pink-50 text-pink-600 font-black text-xs flex items-center justify-center shrink-0">৩</span>
                                        <div class="min-w-0">
                                            <strong class="text-slate-800 block text-xs">আমাদের নম্বরটি দিন</strong>
                                            <span class="text-slate-500 text-[11px] block leading-tight">প্রাপকের নম্বরে <code class="font-mono font-bold text-pink-600" id="saasStep1RuleNumber"><?= htmlspecialchars($storeBkashNumber) ?></code> পেস্ট করুন।</span>
                                        </div>
                                    </div>

                                    <div class="flex items-start space-x-2.5 p-2.5 bg-white border border-slate-200 rounded-xl">
                                        <span class="w-5 h-5 rounded-md bg-pink-50 text-pink-600 font-black text-xs flex items-center justify-center shrink-0">৪</span>
                                        <div class="min-w-0">
                                            <strong class="text-slate-800 block text-xs">টাকার পরিমাণ ও পিন দিন</strong>
                                            <span class="text-slate-500 text-[11px] block leading-tight">টাকার ঘরে <strong id="saasStep1RuleAmountDisplay" class="text-slate-800 font-bold"><?= number_format((float)($store['monthly_fee'] ?? 999.00)) ?></strong> লিখে পিন দিয়ে সেন্ড মানি সম্পন্ন করুন।</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Perfect Action Button -->
                            <div class="pt-1 text-center">
                                <button type="button" onclick="goToSaasPaymentStep(2)"
                                    class="w-full sm:w-auto px-6 py-3 bg-pink-600 hover:bg-pink-700 active:scale-98 text-white rounded-xl text-xs sm:text-sm font-black transition shadow-sm hover:shadow-md flex items-center justify-center gap-2 mx-auto cursor-pointer">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i>
                                    <span>টাকা পাঠিয়েছি (পরবর্তী ধাপ)</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4 shrink-0"></i>
                                </button>
                                <p class="text-[11px] text-slate-400 mt-2">
                                    টাকা পাঠানো হয়ে থাকলে উপরের বাটনে চাপ দিয়ে যে নম্বর থেকে পাঠিয়েছেন তা দিন
                                </p>
                            </div>
                        </div>

                        <!-- ----------------------------------------- -->
                        <!-- STEP 2 PANEL: ENTER SENDER BKASH NUMBER -->
                        <!-- ----------------------------------------- -->
                        <div id="saasPayStep2Panel" class="hidden space-y-4 sm:space-y-5">
                            <div class="bg-pink-50/60 border border-pink-200 rounded-xl p-3.5 flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center shrink-0 font-bold">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-black text-pink-900">পেমেন্ট ভেরিফিকেশন তথ্য প্রদান করুন</h4>
                                    <p class="text-[11px] text-pink-800 mt-0.5 leading-relaxed">
                                        যে বিকাশ নম্বর থেকে আপনি <strong id="saasStep2FeeText">৳ <?= number_format((float)($store['monthly_fee'] ?? 999.00)) ?></strong> পাঠিয়েছেন তা নিচে লিখুন। আমাদের টিম দ্রুত যাচাই করে আপনার স্টোরের সাবস্ক্রিপশন নিশ্চিত করবে।
                                    </p>
                                </div>
                            </div>

                            <form id="formSaasPaymentVerification" onsubmit="handleSaasPaymentVerification(event)" class="space-y-3.5 max-w-lg mx-auto">
                                <!-- Field 1: Sender Mobile Number (Required) -->
                                <div>
                                    <label class="block text-xs font-black text-slate-800 mb-1 flex items-center justify-between">
                                        <span class="flex items-center space-x-1.5">
                                            <i data-lucide="smartphone" class="w-3.5 h-3.5 text-pink-600 shrink-0"></i>
                                            <span>যে বিকাশ নম্বর থেকে টাকা পাঠিয়েছেন <strong class="text-rose-500">*</strong></span>
                                        </span>
                                        <span class="text-[10px] text-rose-500 font-bold">আবশ্যক</span>
                                    </label>
                                    <div class="relative">
                                        <input type="tel" id="inputSenderBkashNumber" required placeholder="01XXXXXXXXX" pattern="[0-9]{11}" maxlength="11"
                                            class="w-full px-3.5 py-2.5 pl-10 border-2 border-slate-200 rounded-xl text-xs sm:text-sm font-mono font-bold text-slate-900 focus:border-pink-500 focus:ring-2 focus:ring-pink-100 outline-hidden transition">
                                        <i data-lucide="phone" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3"></i>
                                    </div>
                                    <span class="text-[10px] sm:text-[11px] text-slate-400 mt-1 block">আপনার ১১ ডিজিটের বিকাশ নম্বরটি লিখুন।</span>
                                </div>

                                <!-- Field 2: Transaction ID (Optional/Recommended) -->
                                <div>
                                    <label class="block text-xs font-black text-slate-800 mb-1 flex items-center justify-between">
                                        <span class="flex items-center space-x-1.5">
                                            <i data-lucide="hash" class="w-3.5 h-3.5 text-slate-500 shrink-0"></i>
                                            <span>বিকাশ ট্রানজাকশন আইডি / TrxID (ঐচ্ছিক)</span>
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-medium">যদি থাকে</span>
                                    </label>
                                    <input type="text" id="inputSenderTrxId" placeholder="যেমন: BK992A81"
                                        class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-xs font-mono font-bold text-slate-800 focus:border-pink-500 outline-hidden uppercase transition">
                                    <span class="text-[10px] sm:text-[11px] text-slate-400 mt-1 block">বিকাশের কনফার্মেশন এসএমএস থেকে TrxID দিতে পারেন।</span>
                                </div>

                                <!-- Field 3: Amount & Validity Info (Compact) -->
                                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 mb-0.5">প্রদেয় ফি</label>
                                        <input type="text" id="saasStep2FeeInput" readonly value="৳ <?= number_format((float)($store['monthly_fee'] ?? 999.00)) ?>" class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-xs font-black text-slate-800 outline-hidden">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 mb-0.5">পরবর্তী বিলিং সাইকেল</label>
                                        <input type="text" id="saasStep2CycleInput" readonly value="প্রতি মাসের <?= (int)($store['billing_day'] ?? 10) ?> তারিখ পর্যন্ত" class="w-full px-3 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-xs font-black text-emerald-800 outline-hidden">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-between pt-3 gap-2 sm:gap-3">
                                    <button type="button" onclick="goToSaasPaymentStep(1)"
                                        class="w-full sm:w-auto px-4 py-2.5 bg-slate-100 hover:bg-slate-200 active:scale-98 text-slate-700 rounded-xl text-xs font-bold transition flex items-center justify-center space-x-1.5 cursor-pointer">
                                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 shrink-0"></i>
                                        <span>আগের ধাপে ফিরুন</span>
                                    </button>

                                    <button type="submit" id="btnSubmitSaasPayment"
                                        class="w-full sm:w-auto px-6 py-2.5 bg-pink-600 hover:bg-pink-700 active:scale-98 text-white rounded-xl text-xs font-black transition shadow-sm flex items-center justify-center space-x-1.5 cursor-pointer">
                                        <i data-lucide="send" class="w-3.5 h-3.5 shrink-0"></i>
                                        <span>পেমেন্ট তথ্য সাবমিট করুন</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- ----------------------------------------- -->
                        <!-- SUCCESS CONFIRMATION STATE (AFTER SUBMIT) -->
                        <!-- ----------------------------------------- -->
                        <div id="saasPaySuccessState" class="hidden text-center py-5 space-y-3">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 border-2 border-emerald-200 flex items-center justify-center mx-auto shadow-xs">
                                <i data-lucide="check" class="w-6 h-6"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-sm sm:text-base font-black text-slate-900">ধন্যবাদ! পেমেন্ট রিকোয়েস্ট সফলভাবে জমা হয়েছে</h3>
                                <p class="text-xs text-slate-500 max-w-sm mx-auto">
                                    প্রেরক বিকাশ নম্বর (<strong id="submittedSenderNumberDisplay" class="text-slate-800 font-mono">01XXXXXXXXX</strong>) যাচাই করে খুব শীঘ্রই সাবস্ক্রিপশন নিশ্চিত করা হবে।
                                </p>
                            </div>
                            <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-2">
                                <button type="button" onclick="resetSaasPaymentFlow()"
                                    class="w-full sm:w-auto px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition cursor-pointer">
                                    নতুন পেমেন্ট ফরম দেখুন
                                </button>
                                <a href="#saasPaymentHistorySection"
                                    class="w-full sm:w-auto px-4 py-2 bg-pink-600 text-white rounded-xl text-xs font-bold hover:bg-pink-700 transition cursor-pointer">
                                    পেমেন্ট হিস্ট্রি দেখুন ↓
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- SAAS SUBSCRIPTION PAYMENT HISTORY & INVOICES -->
                    <!-- ============================================== -->
                    <div id="saasPaymentHistorySection" class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-xs space-y-3.5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <div>
                                <h3 class="text-xs sm:text-sm font-extrabold text-slate-900">সাবস্ক্রিপশন পেমেন্ট ও ইনভয়েস হিস্ট্রি (Payment Invoices)</h3>
                                <p class="text-[11px] sm:text-xs text-slate-500">আপনার স্টোরের পূর্ববর্তী সকল বিকাশ পেমেন্ট ও অফিসিয়াল ইনভয়েস রশিদ</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="loadSaasSubscriptionAndPayments()" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition" title="রিফ্রেশ">
                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                </button>
                                <span id="saasPaymentCountBadge" class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-bold shrink-0">
                                    মোট ০টি রেকর্ড
                                </span>
                            </div>
                        </div>

                        <!-- History Table with Smooth Mobile Scrolling -->
                        <div class="overflow-x-auto -mx-4 sm:mx-0 px-4 sm:px-0">
                            <table class="w-full min-w-[620px] text-left text-xs">
                                <thead>
                                    <tr class="text-slate-400 font-bold border-b border-slate-100 uppercase text-[10px] tracking-wider">
                                        <th class="py-2.5 px-3">ইনভয়েস নং</th>
                                        <th class="py-2.5 px-3">তারিখ ও সময়</th>
                                        <th class="py-2.5 px-3">বিলিং মাস</th>
                                        <th class="py-2.5 px-3">ধরন</th>
                                        <th class="py-2.5 px-3">TrxID ও মেথড</th>
                                        <th class="py-2.5 px-3">পরিশোধিত ফি</th>
                                        <th class="py-2.5 px-3">স্ট্যাটাস</th>
                                        <th class="py-2.5 px-3 text-right">ইনভয়েস রশিদ</th>
                                    </tr>
                                </thead>
                                <tbody id="saasPaymentHistoryTableBody" class="divide-y divide-slate-100 font-medium text-slate-700">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Clean Pagination Controls -->
                        <div id="saasPaymentPagination" class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3 border-t border-slate-100 text-xs">
                            <div class="text-slate-500 text-[11px]">
                                <span id="saasPaginationSummary">১ থেকে ৫ (মোট ০টি ইনভয়েস)</span>
                            </div>
                            <div class="flex items-center space-x-1.5" id="saasPaginationButtons">
                                <!-- Populated dynamically via JS -->
                            </div>
                        </div>
                    </div>

                </section>

                <!-- ======================================================= -->
                <!-- OFFICIAL PRINTABLE INVOICE MODAL -->
                <!-- ======================================================= -->
                <div id="adminInvoiceModal" class="fixed inset-0 z-[999999] flex items-center justify-center p-3 sm:p-4 bg-slate-900/60 backdrop-blur-xs hidden transition-all duration-300">
                    <div class="bg-white border border-slate-200/90 rounded-3xl max-w-2xl w-full max-h-[92vh] overflow-y-auto shadow-2xl p-5 sm:p-8 space-y-6 relative" onclick="event.stopPropagation()">
                        
                        <!-- Modal Action Bar (Print & Close) -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 print:hidden">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center font-bold">
                                    <i data-lucide="file-text" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-black text-slate-900">অফিসিয়াল ইনভয়েস রশিদ</h3>
                                    <p class="text-[11px] text-slate-400 font-mono" id="admInvSubtitle">INV-0000</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="window.print()"
                                    class="inline-flex items-center space-x-1.5 py-2 px-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-xs cursor-pointer">
                                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                                    <span>প্রিন্ট / PDF</span>
                                </button>
                                <button type="button" onclick="closeAdminInvoiceModal()"
                                    class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition cursor-pointer">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                        <!-- INVOICE DOCUMENT BODY -->
                        <div class="space-y-6" id="admInvoicePrintArea">
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div>
                                    <img src="<?= htmlspecialchars(ApiClient::getMotherRootUrl()) ?>/assets/images/logo.png" alt="Ponnostack" class="h-8 w-auto object-contain mb-1.5" onerror="this.outerHTML='<span class=\'font-black text-xl text-brand-600\'>Ponnostack</span>'">
                                    <p class="text-xs text-slate-500 font-medium">সম্পূর্ণ স্বয়ংক্রিয় মাল্টি-টেন্যান্ট ই-কমার্স প্ল্যাটফর্ম</p>
                                    <span class="text-[11px] text-slate-400 block font-mono">ওয়েবসাইট: ponnostack.shop | ঢাকা, বাংলাদেশ</span>
                                </div>

                                <div class="sm:text-right">
                                    <span class="text-xs font-black uppercase text-slate-400 tracking-wider block">INVOICE</span>
                                    <strong class="text-base sm:text-lg font-black text-slate-900 font-mono block" id="admInvDocNo">INV-0000</strong>
                                    <span class="text-xs text-slate-500 font-mono block mt-1">ইস্যুর তারিখ: <span id="admInvDocDate">-</span></span>
                                    <div class="mt-2" id="admInvStatusBadge"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs">
                                <div>
                                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block mb-1">বিল গ্রহীতা (Bill To):</span>
                                    <strong class="text-slate-900 text-sm block font-black" id="admInvStoreName"><?= htmlspecialchars($storeName) ?></strong>
                                    <span class="text-slate-600 block" id="admInvOwnerName"><?= htmlspecialchars($ownerName) ?></span>
                                    <span class="text-slate-500 font-mono block" id="admInvOwnerPhone"><?= htmlspecialchars($ownerPhone) ?></span>
                                    <span class="text-slate-500 font-mono block" id="admInvOwnerEmail"><?= htmlspecialchars($ownerEmail) ?></span>
                                </div>
                                <div>
                                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block mb-1">পেমেন্ট বিবরণ (Payment Details):</span>
                                    <div class="space-y-1">
                                        <div class="flex justify-between"><span class="text-slate-500">মেথড:</span> <strong class="font-bold text-slate-800" id="admInvMethod">bKash</strong></div>
                                        <div class="flex justify-between"><span class="text-slate-500">প্রেরক নম্বর:</span> <span class="font-mono text-slate-800 font-bold" id="admInvSender">-</span></div>
                                        <div class="flex justify-between"><span class="text-slate-500">TrxID:</span> <span class="font-mono text-emerald-800 font-bold" id="admInvTrxId">-</span></div>
                                        <div class="flex justify-between"><span class="text-slate-500">বিলিং মাস:</span> <strong class="font-bold text-slate-800" id="admInvMonth">-</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-slate-200 rounded-2xl overflow-hidden">
                                <table class="w-full text-xs text-left">
                                    <thead class="bg-slate-100 text-slate-600 uppercase text-[10px] font-black tracking-wider border-b border-slate-200">
                                        <tr>
                                            <th class="py-2.5 px-4">আইটেম বিবরণ</th>
                                            <th class="py-2.5 px-4">প্যাকেজ</th>
                                            <th class="py-2.5 px-4">ধরন</th>
                                            <th class="py-2.5 px-4 text-right">পরিমাণ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <tr>
                                            <td class="py-3 px-4">
                                                <strong class="text-slate-900 font-bold block">পণ্যস্ট্যাক ই-কমার্স স্টোরফ্রন্ট সাবস্ক্রিপশন ফি</strong>
                                                <span class="text-[11px] text-slate-500" id="admInvItemDesc">মাসিক ক্লাউড প্ল্যাটফর্ম ও টেকনোলজি সার্ভিস</span>
                                            </td>
                                            <td class="py-3 px-4 text-slate-700 font-medium" id="admInvPackageName"><?= htmlspecialchars($store['package_name'] ?? 'স্ট্যান্ডার্ড প্যাকেজ') ?></td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200" id="admInvTypeBadge">মাসিক রিনিউয়াল</span>
                                            </td>
                                            <td class="py-3 px-4 text-right font-mono font-black text-slate-900 text-sm" id="admInvAmount">৳ 0</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-slate-50 border-t border-slate-200 text-xs">
                                        <tr>
                                            <td colspan="3" class="py-2.5 px-4 font-bold text-slate-700 text-right">মোট প্রদেয় বিল:</td>
                                            <td class="py-2.5 px-4 text-right font-mono font-black text-base text-pink-600" id="admInvTotalAmount">৳ 0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center text-[11px] text-slate-400 gap-2">
                                <span>এটি একটি সিস্টেম জেনারেটেড ডিজিটাল ইনভয়েস, কোনো ম্যানুয়াল স্বাক্ষরের প্রয়োজন নেই।</span>
                                <span class="font-mono text-[10px]">পণ্যস্ট্যাক ক্লাউড বিলিং সিস্টেম</span>
                            </div>
                        </div>
                    </div>
                </div>
