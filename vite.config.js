import {defineConfig} from 'vite';
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
                'resources/vendor/fontawesome-free/css/all.min.css',
                'resources/vendor/aos/aos.css',
                'resources/vendor/glightbox/css/glightbox.min.css',
                'resources/vendor/swiper/swiper-bundle.min.css',
                'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'resources/vendor/aos/aos.js',
                'resources/vendor/glightbox/js/glightbox.min.js',
                'resources/vendor/isotope-layout/isotope.pkgd.min.js',
                'resources/vendor/swiper/swiper-bundle.min.js',
                'resources/vendor/purecounter/purecounter_vanilla.js',
                'resources/vendor/php-email-form/validate.js',
                'resources/js/main.js',
            ],
            refresh: true,
        }),
    ],
});
