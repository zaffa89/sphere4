import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel(['resources/js/app.js']),
        /*
        laravel({
            input: 'resources/js/app.js',
        }, 'resources/css/app.css'),
        */
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        rollupOptions: {
            treeshake: false
        }
    },
    optimizeDeps: {
        include: ['@bryntum/calendar' , '@bryntum/calendar-vue-3']
    },
    resolve: {
        alias: {
          '@utilities': path.resolve(__dirname, './resources/js/utilities'),
          '@modals' : path.resolve(__dirname, './resources/js/Pages/Sphere/Modals'),
          '@forms' : path.resolve(__dirname, './resources/js/Pages/Sphere/Forms'),
        },
      }
});
