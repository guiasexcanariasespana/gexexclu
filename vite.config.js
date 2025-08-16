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
    port: 5174, // u otro puerto disponible
    strictPort: true // evita que busque otro puerto automáticamente
  },    
});
