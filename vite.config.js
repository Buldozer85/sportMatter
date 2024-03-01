import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // replace with the IP address of the Homestead machine
        https: false,
        cors: false,
        hmr: {
            host: 'localhost', // replace with the IP address of the Homestead machine
        }
    },
});
