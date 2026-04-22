import type { APIRoute } from "astro";
import { env } from "cloudflare:workers";

export const DELETE: APIRoute = async ({ request }) => {
	const { id, fileName } = (await request.json()) as {
		id: string;
		fileName: string;
	};

	if (!id) {
		return new Response("Missing id", { status: 400 });
	}

	await env.BUCKET.delete(fileName);
	await env.DB.prepare("DELETE FROM gallery WHERE id = ?").bind(id).run();

	return new Response(null, { status: 204 });
};
