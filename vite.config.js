import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	server: {
		hmr: {
			// host: "localhost",
			host: process.env.APP_URL,
			// host: window.location.hostname,
			log: true,
		},
		// watch: {
		//     // laravel: {
		//     //     include: ["resources/views/**"],
		//     // },
		//     usePolling: true,
		// },
		//   host: ''
	},
	plugins: [
		laravel({
			input: [
				'resources/css/*.css', // Acepta todos los archivos CSS en la carpeta css
				'resources/js/*.js', // Acepta todos los archivos JS en la carpeta resources
			],
			refresh: true,
		}),
	],
});
