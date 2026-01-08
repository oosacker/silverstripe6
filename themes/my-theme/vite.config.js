import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import { resolve } from "path";

export default defineConfig({
    plugins: [react()],
    base: "/resources/themes/my-theme/dist/",
    build: {
        outDir: "dist",
        emptyDirOnBuildStart: true,
        manifest: true,
        rollupOptions: {
            input: {
                main: resolve(__dirname, "src/main.jsx"),
            },
            output: {
                entryFileNames: "js/[name]-[hash].js",
                chunkFileNames: "js/[name]-[hash].js",
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith(".css")) {
                        return "css/[name]-[hash][extname]";
                    }
                    return "assets/[name]-[hash][extname]";
                },
            },
        },
    },
    server: {
        origin: "http://localhost:5173",
        cors: true,
    },
});
