import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/front.css', // Pastikan file ini terdaftar di sini
                'resources/js/app.js', // Jika ada file JS lain
            ],
            refresh: true,
        }),
    ],
});
