import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/base.scss',
                // 'resources/sass/product-card.scss',
                'resources/js/app.js',
                'resources/js/theme.js'
            ],
            refresh: true,
        }),
    ],
});
