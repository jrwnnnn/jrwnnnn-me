import { env } from "cloudflare:workers";
import type { APIRoute } from "astro";

export const POST: APIRoute = async ({ request }) => {
	const file = (await request.formData()).get("file");

	if (!(file instanceof File)) {
		return new Response("Invalid file", { status: 400 });
	}

	if (!file.type.startsWith("image/")) {
		return new Response("Invalid file type.", {
			status: 400,
		});
	}

	const fileName = `gallery/${Date.now()}-${file.name.replaceAll(" ", "-")}`;

	const res = await env.BUCKET.put(fileName, file.stream());

	if (!res) {
		return new Response("Failed to upload file.", {
			status: 500,
		});
	}

	await env.DB.prepare("INSERT INTO gallery (fileName, link) VALUES (?, ?)")
		.bind(fileName, `https://r2.jrwnnnn.me/${fileName}`)
		.run();

	return new Response("File uploaded successfully.", {
		status: 200,
	});
};
