import eslintPluginAstro from "eslint-plugin-astro";
import tseslint from "typescript-eslint";

export default [
	{
		ignores: [
			".astro/**",
			".wrangler/**",
			"dist/**",
			"node_modules/**",
			"worker-configuration.d.ts",
		],
	},
	...tseslint.configs.recommended,
	...eslintPluginAstro.configs.recommended,
];
