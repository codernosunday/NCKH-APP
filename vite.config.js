import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // css --------------------
                'resources/css/app.css',
                'resources/css/auth/login.css',
                'resources/css/layout.css',
                'resources/css/pages/TrangDangKyDeTai.css',
                'resources/css/pages/Formdangkydetai.css',
                // js ---------------------
                'resources/js/app.js',
                'resources/js/auth/login.js',
                'resources/js/pages/Formdangkydetai.js',
                'resources/js/pages/Detaithuchien.js',
                'resources/js/pages/trangchu.js',
                'resources/js/pages/thongtincanhan.js',
            ],
            refresh: true,
        }),
    ],
});
