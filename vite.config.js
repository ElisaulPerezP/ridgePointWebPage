import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/main.css',
                'resources/js/app.js',
                'resources/vendor/bootstrap/css/bootstrap.min.css',
                'resources/vendor/bootstrap-icons/bootstrap-icons.css',
                'resources/js/main.js',
                'resources/vendor/aos/aos.css',
                'resources/vendor/aos/aos.js',
                'aos/dist/aos.css',
            ],
            refresh: true,
        }),
    ],
});
