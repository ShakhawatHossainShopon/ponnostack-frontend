/**
 * Ponnostack Storefront - Universal API Client
 * 
 * Fetches merchant storefront identity, branding, settings, and catalog
 * using the configured NEXT_PUBLIC_TENANT_UUID.
 */

export interface StorefrontData {
  uuid: string;
  name: string;
  slug: string;
  domain: string | null;
  logo_url: string | null;
  banners: string | null;
  currency: string;
  package_name: string;
  package_slug: string;
  template_id: string;
  color_palette: string;
  social_links: Record<string, string> | any[];
  status: 'active' | 'suspended' | 'expired' | 'payment_pending' | 'setup_pending' | 'inactive';
  is_live: boolean;
  owner_phone: string | null;
  owner_email: string | null;
  address: string | null;
}

export interface ApiResponse<T> {
  success: boolean;
  message: string;
  data: T;
}

const DEFAULT_UUID = '7f8d3f22-4635-4c0b-914f-8087373f15f0';
const DEFAULT_API_URL = 'http://localhost/Ponnostack/backend/api';

export function getTenantUuid(): string {
  return process.env.NEXT_PUBLIC_TENANT_UUID || DEFAULT_UUID;
}

export function getApiBaseUrl(): string {
  let url = process.env.NEXT_PUBLIC_API_URL || DEFAULT_API_URL;
  return url.replace(/\/+$/, '');
}

/**
 * Universal Storefront Fetcher
 * Fetches store branding, name, logo, contact, and settings by UUID
 */
export async function getStorefront(overrideUuid?: string): Promise<StorefrontData> {
  const uuid = overrideUuid || getTenantUuid();
  const baseUrl = getApiBaseUrl();
  const endpoint = `${baseUrl}/storefront/${uuid}`;

  try {
    const res = await fetch(endpoint, {
      // Revalidate or fetch cache strategy
      next: { revalidate: 60 },
      headers: {
        'Accept': 'application/json',
      },
    });

    if (!res.ok) {
      throw new Error(`API error: ${res.status} ${res.statusText}`);
    }

    const json: ApiResponse<StorefrontData> = await res.json();
    if (json.success && json.data) {
      return json.data;
    }
  } catch (err) {
    console.warn(`[Storefront API] Failed to fetch from ${endpoint}:`, err);
  }

  // Graceful Fallback if backend is currently unreachable during local dev
  return {
    uuid: uuid,
    name: 'শিখন ফ্যাশন স্টোর (Shikhon Fashion)',
    slug: 'shikhon',
    domain: 'https://shikhon.ponnostack.shop',
    logo_url: null,
    banners: null,
    currency: 'BDT',
    package_name: 'স্ট্যান্ডার্ড প্যাকেজ',
    package_slug: 'starter',
    template_id: 'template_1',
    color_palette: 'emerald',
    social_links: [],
    status: 'active',
    is_live: true,
    owner_phone: '01642956206',
    owner_email: 'shoponhossain32186@gmail.com',
    address: 'ঢাকা, বাংলাদেশ',
  };
}
