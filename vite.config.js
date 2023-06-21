import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        hmr: {
            host: "localhost",
        },
        // watch: {
        //     // laravel: {
        //     //     include: ["resources/views/**"],
        //     // },
        //     usePolling: true,
        // },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
