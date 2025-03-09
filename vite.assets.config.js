import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
  root: ".",
  build: {
    outDir: "dist",
    emptyOutDir: false,
    rollupOptions: {
      input: {
        main: "assets/js/load.js",
        style: "assets/scss/load.scss",
      },
      output: {
        entryFileNames: (chunk) => (chunk.name === "main" ? "main.min.js" : "[name].js"),
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.includes("style")) return "style.min.css";
          if (/\.(woff2?|ttf|eot|otf)$/.test(assetInfo.name)) return "assets/fonts/[name][extname]";
          if (/\.(png|jpe?g|gif|svg|webp)$/.test(assetInfo.name)) return "assets/images/[name][extname]";
          return "assets/[name][extname]";
        },
      },
    },
  },
  css: {
    preprocessorOptions: {
      scss: {},
    },
  },
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "assets"),
    },
  },
  server: {
    watch: {
      usePolling: true,
    },
  },
});
