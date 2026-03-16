import type { APIRoute } from "astro";
import { createClient } from "@libsql/client";
import { safeAsync } from "@utils/safeAsync";
import bcrypt from "bcrypt";

const turso = createClient({
	url: import.meta.env.TURSO_DATABASE_URL || process.env.TURSO_DATABASE_URL,
	authToken: import.meta.env.TURSO_AUTH_TOKEN || process.env.TURSO_AUTH_TOKEN,
});

export const POST: APIRoute = async ({ request, cookies }) => {
	const { password } = await request.json();

	const realPassword = await safeAsync(
		turso.execute("SELECT value FROM site_settings WHERE key = 'admin.pass'"),
	);

	if (realPassword.data && realPassword.data.rows.length > 0) {
		const match = await bcrypt.compare(
			password,
			realPassword.data.rows[0].value as string,
		);
		if (match) {
			const sessionId = crypto.randomUUID();

			await turso.execute({
				sql: "UPDATE site_settings SET value = ? WHERE key = 'admin.session'",
				args: [sessionId],
			});

			cookies.set("admin_session", sessionId, {
				path: "/",
				httpOnly: true,
				secure: import.meta.env.PROD,
				sameSite: "strict",
				maxAge: 60 * 60 * 24 * 7,
			});

			return new Response(JSON.stringify({ success: true }), { status: 200 });
		}
	} else {
		return new Response(JSON.stringify({ success: false }), { status: 500 });
	}

	return new Response(JSON.stringify({ success: false }), { status: 401 });
};
