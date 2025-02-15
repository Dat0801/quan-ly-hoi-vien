import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/build',
    manifest: true,
    rollupOptions: {
      input: {
        app: 'resources/js/app.js',
        styles: 'resources/css/app.css',
      },
    },
  },
  server: {
    host: '0.0.0.0',
    strictPort: true,
    https: true, 
  },
});
