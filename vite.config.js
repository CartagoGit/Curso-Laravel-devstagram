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
			input: ['resources/css/app.css', 'resources/css/dropzone.css','resources/js/app.js'],
			refresh: true,
		}),
	],
});
