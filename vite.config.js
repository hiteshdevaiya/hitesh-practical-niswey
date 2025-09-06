import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: [
                'resources/**',
            ],
        }),
    ],
    // optimizeDeps: {
    //     include: ['chart.js/auto', 'jquery'],
    // },
    build: {
        emptyOutDir: true,
        assetsInclude: [
            "**/*.woff2",
            "**/*.woff",
            "**/*.eot",
            "**/*.ttf",
            "**/*.svg",
            "**/*.png",
            "**/*.jpg",
            "**/*.webp",
        ],
    },
    resolve: {
        alias: {
            "@": "/resources",
            // path: "path-browserify",
            // "~select2": path.resolve(__dirname, "node_modules/select2"),
            // "~jquery": path.resolve(__dirname, "node_modules/jquery"),
        },
    },
    server: {
        hmr: false,
        watch: {
            ignored: ['**/*'],
            usePolling: false,
        },
    },
});
