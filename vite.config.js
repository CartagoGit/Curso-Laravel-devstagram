import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	server: {
		hmr: {
			// host: "localhost",
			host: window.location.hostname,
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
			input: ['resources/css/app.css', 'resources/js/app.js'],
			refresh: true,
		}),
	],
});
