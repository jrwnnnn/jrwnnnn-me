import type { APIRoute } from "astro";
import { env } from "cloudflare:workers";

export const POST: APIRoute = async ({ request }) => {
	const formData = await request.formData();
	const slug = formData.get("slug");

	if (!slug) {
		return new Response("Missing slug", { status: 400 });
	}

	await env.DB.prepare("DELETE FROM articles WHERE slug = ?").bind(slug).run();

	return new Response(null, { status: 204 });
};
