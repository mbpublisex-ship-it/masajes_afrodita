import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',      // tu JS
                'resources/scss/app.scss',  // estilos públicos
                'resources/scss/admin.scss' // estilos del panel
            ],
            refresh: true,
        }),
        tailwindcss(), // si realmente estás usando Tailwind; si no, puedes quitar esta línea
    ],
});
