export const GET = async () => {
	const response = await fetch(
		`https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=KeiCantRead&api_key=${import.meta.env.LASTFM_API_KEY}&format=json&limit=5`,
		{ headers: { "User-Agent": "Mozilla/5.0" } },
	);
	const data = await response.json();
	return new Response(JSON.stringify(data), {
		headers: { "Content-Type": "application/json" },
	});
};
