import type { APIRoute } from "astro";
import { createClient } from "@libsql/client";
import { safeAsync } from "@utils/safeAsync";

const turso = createClient({
	url: import.meta.env.TURSO_DATABASE_URL || process.env.TURSO_DATABASE_URL,
	authToken: import.meta.env.TURSO_AUTH_TOKEN || process.env.TURSO_AUTH_TOKEN,
});

export const POST: APIRoute = async ({ cookies }) => {
	cookies.delete("admin_session", { path: "/" });
	const result = await safeAsync(
		turso.execute({
			sql: "UPDATE site_settings SET value = null WHERE key = 'admin.session'",
		}),
	);
	if (result.error)
		return new Response(JSON.stringify({ success: false }), { status: 500 });
	return new Response(JSON.stringify({ success: true }), { status: 200 });
};
