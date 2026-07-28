// @ts-check
import { defineConfig } from "astro/config";
import cloudflare from "@astrojs/cloudflare";
import tailwindcss from "@tailwindcss/vite";
import vue from "@astrojs/vue";

export default defineConfig({
	output: "server",
	adapter: cloudflare({
		remoteBindings: !process.env.CI,
	}),
	vite: {
		plugins: [tailwindcss()],
	},
	integrations: [vue()],
});
