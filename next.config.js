/** @type {import('next').NextConfig} */
const nextConfig = {
  // Static export mode: Builds pure HTML/CSS/JS in 'out/' folder
  // Can be hosted directly on standard cPanel, Apache, Nginx, or Vercel
  output: 'export',
  trailingSlash: true,
  images: {
    unoptimized: true,
  },
};

module.exports = nextConfig;
