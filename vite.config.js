import path from 'path';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import {defineConfig} from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts', 'resources/css/public.css', 'resources/js/public.ts'],
            refresh: ['resources/routes/**', 'routes/**', 'resources/views/**/*'],
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@/Images': path.resolve(__dirname, './resources/images'),
        },
    },
});
