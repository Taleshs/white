import { defineConfig } from "vite";
import path from "path";
import fg from "fast-glob";

const sectionFiles = fg.sync("assets/scss/sections/*.scss");

export default defineConfig({
  root: ".",
  build: {
    outDir: "dist/sections",
    emptyOutDir: false,
    rollupOptions: {
      input: sectionFiles.reduce((acc, file) => {
        const fileName = path.basename(file, ".scss");
        acc[fileName] = file;
        return acc;
      }, {}),
      output: {
        assetFileNames: ({ name }) => (name.endsWith(".css") ? "[name].css" : "[name][extname]"),
      },
    },
  },
  css: {
    preprocessorOptions: {
      scss: {
        charset: false,
        additionalData: '@use "sass:math";',
      },
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
