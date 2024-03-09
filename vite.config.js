import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/css/app.css',
				'resources/js/app.js',
				'resources/js/svk.js',
			],
			refresh: true,
		}),
	],
	build: {
		assetsDir: 'assets',
	},
	server: {
		proxy: {
			/*"/images": {
                target: "http://localhost:8000",
                changeOrigin: true,
            },*/
			'/images': 'src/images',
		},
	},
});
