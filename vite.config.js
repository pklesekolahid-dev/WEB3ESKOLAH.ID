import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // <--- Tambahkan ini

export default defineConfig({
    plugins: [
        tailwindcss(), // <--- Tambahkan ini di paling atas
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});