import { getStorefront } from '@/lib/api';
import {
  ShoppingBag,
  Phone,
  Mail,
  MapPin,
  Truck,
  ShieldCheck,
  RotateCcw,
  Headphones,
  CheckCircle2,
  ExternalLink,
  Search,
  Sparkles,
} from 'lucide-react';
import Image from 'next/image';
import Link from 'next/link';

// Sample Showcase Products for the Storefront
const SAMPLE_PRODUCTS = [
  {
    id: 1,
    name: 'প্রিমিয়াম জেন্টস ক্যাজুয়াল শার্ট',
    category: 'মেনস ফ্যাশন',
    price: 850,
    originalPrice: 1250,
    discount: '৩২% ছাড়',
    badge: 'হট ডিল',
    image: 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=500&auto=format&fit=crop&q=60',
  },
  {
    id: 2,
    name: 'এক্সক্লুসিভ ডিজাইনার সিল্ক শাড়ি',
    category: 'ওমেনস কালেকশন',
    price: 2450,
    originalPrice: 3200,
    discount: '২৩% ছাড়',
    badge: 'জনপ্রিয়',
    image: 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=500&auto=format&fit=crop&q=60',
  },
  {
    id: 3,
    name: 'ক্লাসিক লেদার ট্রাভেল ব্যাকপ্যাক',
    category: 'ব্যাগ ও লাগেজ',
    price: 1650,
    originalPrice: 2100,
    discount: '২১% ছাড়',
    badge: 'সেরা মান',
    image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500&auto=format&fit=crop&q=60',
  },
  {
    id: 4,
    name: 'স্মার্ট ব্লুটুথ নয়েজ ক্যানসেলিং ইয়ারবাডস',
    category: 'গ্যাজেটস',
    price: 1290,
    originalPrice: 1800,
    discount: '২৮% ছাড়',
    badge: 'নতুন আগমন',
    image: 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=500&auto=format&fit=crop&q=60',
  },
];

export default async function StorefrontHomePage() {
  const store = await getStorefront();

  return (
    <div className="flex flex-col min-h-screen bg-[#FAFAF9] text-slate-800">
      
      {/* 1. TOP ANNOUNCEMENT BAR */}
      <div className="bg-[#00684A] text-white text-xs py-2 px-4 text-center font-medium">
        <div className="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1 text-[11px] sm:text-xs">
          <div className="flex items-center space-x-1.5">
            <Sparkles className="w-3.5 h-3.5 text-[#00ED64]" />
            <span>আমাদের অনলাইন শপে স্বাগতম! সারাদেশে ক্যাশ অন ডেলিভারি সুবিধা রয়েছে।</span>
          </div>
          {store.owner_phone && (
            <div className="flex items-center space-x-1 text-emerald-100 font-mono">
              <Phone className="w-3 h-3" />
              <span>সহায়তা: {store.owner_phone}</span>
            </div>
          )}
        </div>
      </div>

      {/* 2. MAIN STOREFRONT NAVBAR */}
      <header className="bg-white/95 backdrop-blur-md border-b border-slate-200/90 sticky top-0 z-40">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 h-16 sm:h-20 flex items-center justify-between gap-4">
          
          {/* Logo & Store Name */}
          <Link href="/" className="flex items-center space-x-3 group">
            <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
              {store.logo_url ? (
                <img
                  src={store.logo_url}
                  alt={store.name}
                  className="w-full h-full object-contain p-1"
                />
              ) : (
                <ShoppingBag className="w-5 h-5 sm:w-6 sm:h-6 text-[#00684A]" />
              )}
            </div>
            <div>
              <span className="text-base sm:text-xl font-black text-slate-900 leading-tight block group-hover:text-[#00684A] transition">
                {store.name}
              </span>
              <span className="text-[10px] sm:text-[11px] text-slate-400 font-medium flex items-center gap-1">
                <span className="w-1.5 h-1.5 rounded-full bg-[#00ED64] animate-pulse"></span>
                <span>ভেরিফাইড মার্চেন্ট স্টোরফ্রন্ট</span>
              </span>
            </div>
          </Link>

          {/* Search Bar (Desktop) */}
          <div className="hidden md:flex flex-1 max-w-md mx-4">
            <div className="relative w-full">
              <Search className="w-4 h-4 text-slate-400 absolute left-3.5 top-3" />
              <input
                type="text"
                placeholder="পণ্য বা ক্যাটাগরি খুঁজুন..."
                className="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:bg-white focus:outline-none focus:border-[#00684A] transition"
              />
            </div>
          </div>

          {/* Right Action: Cart Button */}
          <div className="flex items-center space-x-2.5">
            <button
              type="button"
              className="py-2 px-3.5 sm:px-4 rounded-xl bg-[#00684A] hover:bg-[#00523A] active:scale-95 text-white text-xs font-bold transition flex items-center space-x-2 shadow-sm cursor-pointer"
            >
              <ShoppingBag className="w-4 h-4 text-[#00ED64]" />
              <span>কার্ট (০)</span>
            </button>
          </div>

        </div>
      </header>

      {/* 3. HERO SHOWCASE BANNER */}
      <section className="bg-gradient-to-b from-emerald-50/70 via-white to-[#FAFAF9] border-b border-slate-200/60 py-8 sm:py-16">
        <div className="max-w-6xl mx-auto px-4 sm:px-6">
          <div className="flex flex-col lg:flex-row items-center justify-between gap-8 sm:gap-12">
            
            {/* Left Content */}
            <div className="space-y-4 sm:space-y-5 text-center lg:text-left max-w-xl">
              <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100/80 text-[#00684A] border border-emerald-200 text-xs font-bold">
                <CheckCircle2 className="w-3.5 h-3.5" />
                <span>অফিসিয়াল অনলাইন স্টোর</span>
              </div>

              <h1 className="text-2xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-snug sm:leading-tight">
                {store.name}-এ সেরা দামে পছন্দের পণ্য কিনুন
              </h1>

              <p className="text-xs sm:text-sm text-slate-600 leading-relaxed">
                কোনো মধ্যস্বত্বভোগী ছাড়া সরাসরি বিশ্বস্ত সরবরাহকারী থেকে আপনার দোরগোড়ায় পণ্য পৌঁছে দেওয়া হয়। শতভাগ সন্তুষ্টি ও ক্যাশ অন ডেলিভারি গ্যারান্টি।
              </p>

              {/* Call to Actions */}
              <div className="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2">
                <a
                  href="#products"
                  className="py-3 px-6 rounded-xl bg-[#00684A] hover:bg-[#00523A] active:scale-95 text-white text-xs sm:text-sm font-bold shadow-md shadow-[#00684A]/20 transition flex items-center space-x-2"
                >
                  <ShoppingBag className="w-4 h-4 text-[#00ED64]" />
                  <span>পণ্য দেখুন &rarr;</span>
                </a>

                {store.owner_phone && (
                  <a
                    href={`https://wa.me/88${store.owner_phone.replace(/[^0-9]/g, '')}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="py-3 px-5 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 text-xs sm:text-sm font-bold transition flex items-center space-x-2 shadow-xs"
                  >
                    <span>হোয়াটসঅ্যাপ অর্ডার</span>
                    <ExternalLink className="w-3.5 h-3.5 text-slate-400" />
                  </a>
                )}
              </div>

              {/* UUID & API Connection Status Indicator */}
              <div className="pt-3">
                <div className="inline-flex items-center gap-2 p-2 rounded-xl bg-slate-100/80 border border-slate-200 text-[11px] font-mono text-slate-500">
                  <span className="w-2 h-2 rounded-full bg-emerald-500"></span>
                  <span className="truncate max-w-[220px] sm:max-w-none">
                    UUID: {store.uuid}
                  </span>
                </div>
              </div>

            </div>

            {/* Right Card / Visual */}
            <div className="w-full max-w-sm sm:max-w-md bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
              <div className="absolute top-0 right-0 w-32 h-32 bg-emerald-100 rounded-full blur-2xl -mr-10 -mt-10 opacity-70"></div>
              
              <div className="relative space-y-4">
                <div className="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-200 text-[#00684A] flex items-center justify-center font-bold">
                  {store.logo_url ? (
                    <img src={store.logo_url} alt="" className="w-full h-full object-contain p-1" />
                  ) : (
                    <ShoppingBag className="w-7 h-7" />
                  )}
                </div>

                <div>
                  <h3 className="text-lg font-black text-slate-900">{store.name}</h3>
                  <p className="text-xs text-slate-500 mt-1">
                    প্যাকেজ: <span className="font-bold text-[#00684A]">{store.package_name}</span>
                  </p>
                </div>

                <div className="pt-3 border-t border-slate-100 space-y-2 text-xs">
                  <div className="flex items-center justify-between text-slate-600">
                    <span>কারেন্সি:</span>
                    <strong className="font-mono">{store.currency} (৳)</strong>
                  </div>
                  <div className="flex items-center justify-between text-slate-600">
                    <span>ডেলিভারি এরিয়া:</span>
                    <strong className="text-slate-800">সারাদেশে (৬৪ জেলা)</strong>
                  </div>
                  <div className="flex items-center justify-between text-slate-600">
                    <span>পেমেন্ট:</span>
                    <strong className="text-emerald-700">ক্যাশ অন ডেলিভারি / বিকাশ</strong>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      {/* 4. VALUE PROPOSITION (TRUST PILLARS) */}
      <section className="border-b border-slate-200/80 bg-white py-6">
        <div className="max-w-6xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
            
            <div className="flex flex-col items-center p-3 rounded-2xl hover:bg-slate-50 transition">
              <div className="w-10 h-10 rounded-xl bg-emerald-50 text-[#00684A] flex items-center justify-center mb-2">
                <Truck className="w-5 h-5" />
              </div>
              <h4 className="text-xs font-black text-slate-900">দ্রুত হোম ডেলিভারি</h4>
              <p className="text-[11px] text-slate-500 mt-0.5">৪৮ থেকে ৭২ ঘণ্টার মধ্যে</p>
            </div>

            <div className="flex flex-col items-center p-3 rounded-2xl hover:bg-slate-50 transition">
              <div className="w-10 h-10 rounded-xl bg-emerald-50 text-[#00684A] flex items-center justify-center mb-2">
                <ShieldCheck className="w-5 h-5" />
              </div>
              <h4 className="text-xs font-black text-slate-900">ক্যাশ অন ডেলিভারি</h4>
              <p className="text-[11px] text-slate-500 mt-0.5">পণ্য হাতে পেয়ে মূল্য পরিশোধ</p>
            </div>

            <div className="flex flex-col items-center p-3 rounded-2xl hover:bg-slate-50 transition">
              <div className="w-10 h-10 rounded-xl bg-emerald-50 text-[#00684A] flex items-center justify-center mb-2">
                <RotateCcw className="w-5 h-5" />
              </div>
              <h4 className="text-xs font-black text-slate-900">সহজ রিটার্ন পলিসি</h4>
              <p className="text-[11px] text-slate-500 mt-0.5">৭ দিনের রিপ্লেসমেন্ট সুবিধা</p>
            </div>

            <div className="flex flex-col items-center p-3 rounded-2xl hover:bg-slate-50 transition">
              <div className="w-10 h-10 rounded-xl bg-emerald-50 text-[#00684A] flex items-center justify-center mb-2">
                <Headphones className="w-5 h-5" />
              </div>
              <h4 className="text-xs font-black text-slate-900">২৪/৭ কাস্টমার সাপোর্ট</h4>
              <p className="text-[11px] text-slate-500 mt-0.5">কল ও হোয়াটসঅ্যাপে সার্বক্ষণিক সহায়তা</p>
            </div>

          </div>
        </div>
      </section>

      {/* 5. FEATURED PRODUCTS SHOWCASE */}
      <section id="products" className="py-10 sm:py-16">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 space-y-6 sm:space-y-8">
          
          <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
              <div className="text-xs font-bold uppercase tracking-wider text-[#00684A] mb-1">
                সেরা কালেকশন
              </div>
              <h2 className="text-xl sm:text-3xl font-black text-slate-900">
                জনপ্রিয় ও ট্রেন্ডিং প্রোডাক্টসমূহ
              </h2>
            </div>
            <span className="text-xs text-slate-500">
              {SAMPLE_PRODUCTS.length}টি পণ্য প্রদর্শিত
            </span>
          </div>

          {/* Product Grid */}
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-6">
            {SAMPLE_PRODUCTS.map((product) => (
              <div
                key={product.id}
                className="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl overflow-hidden hover:shadow-lg hover:border-emerald-300 transition-all flex flex-col justify-between group"
              >
                {/* Product Image */}
                <div className="relative aspect-square w-full bg-slate-100 overflow-hidden">
                  <img
                    src={product.image}
                    alt={product.name}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  />
                  {product.badge && (
                    <span className="absolute top-2.5 left-2.5 px-2 py-0.5 bg-[#00684A] text-white text-[10px] font-bold rounded-lg shadow-xs">
                      {product.badge}
                    </span>
                  )}
                  {product.discount && (
                    <span className="absolute top-2.5 right-2.5 px-2 py-0.5 bg-rose-600 text-white text-[10px] font-bold rounded-lg shadow-xs">
                      {product.discount}
                    </span>
                  )}
                </div>

                {/* Product Details */}
                <div className="p-3.5 sm:p-5 space-y-2.5 flex-1 flex flex-col justify-between">
                  <div>
                    <span className="text-[10px] sm:text-[11px] font-semibold text-slate-400 block">
                      {product.category}
                    </span>
                    <h3 className="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-[#00684A] transition line-clamp-2 mt-0.5">
                      {product.name}
                    </h3>
                  </div>

                  <div className="pt-2 border-t border-slate-100">
                    <div className="flex items-baseline space-x-1.5 mb-3">
                      <span className="text-sm sm:text-lg font-black text-slate-900 font-mono">
                        ৳{product.price}
                      </span>
                      {product.originalPrice && (
                        <span className="text-[11px] sm:text-xs text-slate-400 line-through font-mono">
                          ৳{product.originalPrice}
                        </span>
                      )}
                    </div>

                    <button
                      type="button"
                      className="w-full py-2 sm:py-2.5 rounded-xl bg-slate-100 hover:bg-[#00684A] hover:text-white text-slate-800 text-xs font-bold transition flex items-center justify-center space-x-1.5 cursor-pointer"
                    >
                      <ShoppingBag className="w-3.5 h-3.5" />
                      <span>অর্ডার করুন</span>
                    </button>
                  </div>
                </div>

              </div>
            ))}
          </div>

        </div>
      </section>

      {/* 6. STOREFRONT FOOTER */}
      <footer className="bg-white border-t border-slate-200/90 pt-10 pb-8 mt-auto">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 space-y-8">
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            
            {/* Col 1: Store Bio */}
            <div className="space-y-3">
              <div className="flex items-center space-x-2.5">
                <div className="w-8 h-8 rounded-xl bg-emerald-50 text-[#00684A] flex items-center justify-center font-bold">
                  {store.logo_url ? (
                    <img src={store.logo_url} alt="" className="w-full h-full object-contain p-1" />
                  ) : (
                    <ShoppingBag className="w-4 h-4" />
                  )}
                </div>
                <strong className="text-base font-black text-slate-900">{store.name}</strong>
              </div>
              <p className="text-xs text-slate-500 leading-relaxed">
                আপনার প্রিয় নো-কোড ইকমার্স স্টোরফ্রন্ট। সর্বোচ্চ বিশ্বস্ততা ও গুণগত মানের পণ্য আপনার দোরগোড়ায়।
              </p>
            </div>

            {/* Col 2: Direct Contact */}
            <div className="space-y-2.5">
              <h4 className="text-xs font-black uppercase tracking-wider text-slate-900">যোগাযোগ</h4>
              <ul className="space-y-1.5 text-xs text-slate-600">
                {store.owner_phone && (
                  <li className="flex items-center space-x-2">
                    <Phone className="w-3.5 h-3.5 text-[#00684A] shrink-0" />
                    <span className="font-mono">{store.owner_phone}</span>
                  </li>
                )}
                {store.owner_email && (
                  <li className="flex items-center space-x-2">
                    <Mail className="w-3.5 h-3.5 text-[#00684A] shrink-0" />
                    <span>{store.owner_email}</span>
                  </li>
                )}
                <li className="flex items-center space-x-2">
                  <MapPin className="w-3.5 h-3.5 text-[#00684A] shrink-0" />
                  <span>{store.address || 'ঢাকা, বাংলাদেশ'}</span>
                </li>
              </ul>
            </div>

            {/* Col 3: Platform Information */}
            <div className="space-y-2.5">
              <h4 className="text-xs font-black uppercase tracking-wider text-slate-900">প্ল্যাটফর্ম নিশ্চয়তা</h4>
              <p className="text-xs text-slate-500 leading-relaxed">
                এই স্টোরফ্রন্টটি পরিচালিত হচ্ছে <strong className="text-[#00684A]">Ponnostack</strong> নো-কোড ক্লাউড কমার্স আর্কিটেকচার দ্বারা।
              </p>
              <div className="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-[#00684A]">
                <CheckCircle2 className="w-3 h-3 text-[#00ED64]" />
                <span>নিরাপদ ও এনক্রিপ্টেড চেকআউট</span>
              </div>
            </div>

          </div>

          {/* Bottom Bar */}
          <div className="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <p>&copy; {new Date().getFullYear()} {store.name}. সর্বস্বত্ব সংরক্ষিত।</p>
            <p className="text-[11px]">
              Powered by <span className="font-bold text-[#00684A]">Ponnostack</span>
            </p>
          </div>

        </div>
      </footer>

    </div>
  );
}
