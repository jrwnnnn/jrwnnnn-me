import type { APIRoute } from "astro";
import { env } from "cloudflare:workers";

export const POST: APIRoute = async ({ request }) => {
	const formData = await request.formData();
	const id = formData.get("id");
	const fileName = formData.get("fileName");

	if (!id || !fileName) {
		return new Response("Missing id or fileName", { status: 400 });
	}

	await env.BUCKET.delete(fileName as string);
	await env.DB.prepare("DELETE FROM gallery WHERE id = ?").bind(id).run();

	return new Response(null, { status: 204 });
};
