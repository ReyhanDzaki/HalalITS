import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"], // Path to your entry points
            refresh: true, // Enable hot module reloading during development
        }),
    ],
});
