import type { Metadata } from 'next';
import { getStorefront } from '@/lib/api';
import './globals.css';

export async function generateMetadata(): Promise<Metadata> {
  const store = await getStorefront();

  const title = `${store.name} | অনলাইন শপিং`;
  const description = `${store.name} থেকে সরাসরি অর্ডার করুন সেরা মানের পণ্য। বিশ্বস্ত ক্যাশ অন ডেলিভারি এবং দ্রুত হোম ডেলিভারি সেবা।`;

  return {
    title: {
      default: title,
      template: `%s | ${store.name}`,
    },
    description: description,
    keywords: [store.name, 'online shop bd', 'ecommerce bangladesh', 'ponnostack', store.slug],
    metadataBase: store.domain ? new URL(store.domain) : undefined,
    openGraph: {
      title: title,
      description: description,
      url: store.domain || undefined,
      siteName: store.name,
      locale: 'bn_BD',
      type: 'website',
      images: store.logo_url ? [{ url: store.logo_url }] : [],
    },
    twitter: {
      card: 'summary_large_image',
      title: title,
      description: description,
    },
    icons: {
      icon: store.logo_url || '/favicon.ico',
    },
  };
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="bn" className="scroll-smooth">
      <head>
        <meta name="theme-color" content="#00684A" />
      </head>
      <body className="min-h-screen flex flex-col justify-between selection:bg-[#DCFCE7] selection:text-[#00684A]">
        {children}
      </body>
    </html>
  );
}
