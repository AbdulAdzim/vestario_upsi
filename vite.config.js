import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
            buildDirectory: 'build',
            manifest: 'manifest.json' // Explicitly sets manifest name and location
        }),
        tailwindcss(),
    ],
    server: {
        https: true,
        host: '0.0.0.0', // Allows external access
        hmr: {
            host: process.env.DEV_SERVER_HOST || 'localhost',
            protocol: 'wss',
            port: 5173 // Explicit port for HMR
        }
    },
    build: {
        manifest: 'manifest.json', // Ensures manifest generation
        outDir: 'public/build',
        emptyOutDir: true,
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
                // Removed duplicate manifest: true (already specified above)
            }
        }
    },
    resolve: {
        alias: {
            '@': '/resources/js',
            '~': '/resources' // Additional helpful alias
        }
    },
    optimizeDeps: {
        include: ['laravel-vite-plugin'] // Improves build performance
    }
});