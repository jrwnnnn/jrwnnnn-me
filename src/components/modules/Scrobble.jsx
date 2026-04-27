import { useEffect, useMemo, useState } from "react";

function Scrobble() {
	const [tracks, setTracks] = useState([]);
	const [loading, setLoading] = useState(true);

	const nowPlaying = useMemo(
		() => tracks[0]?.["@attr"]?.nowplaying === "true",
		[tracks],
	);

	const recentTracks = useMemo(
		() => (nowPlaying ? tracks.slice(1) : tracks),
		[tracks, nowPlaying],
	);

	useEffect(() => {
		let mounted = true;
		const fetchAndRender = async () => {
			try {
				const data = await (await fetch("/api/lastfm-endpoint")).json();
				const api = data?.recenttracks?.track ?? [];

				if (!mounted) return;
				setTracks(api);
				setLoading(false);
			} catch (error) {
				console.error(error);
			}
		};

		fetchAndRender();
		const intervalId = setInterval(fetchAndRender, 10000);

		return () => {
			mounted = false;
			clearInterval(intervalId);
		};
	}, []);

	return (
		<div className="space-y-5">
			<div className="flex items-center justify-between">
				<p className="text-lg font-bold tracking-widest">
					&gt; {loading ? "CONNECTING_TO_LASTFM" : "LAST_FM"}
				</p>
				<div
					className={`${nowPlaying ? "bg-primary" : "hidden"} animate-pulse px-3 py-px font-mono text-[12px] font-bold text-black`}
				>
					NOW PLAYING
				</div>
			</div>

			<hr className="border-primary/40 border" />

			<a
				className="flex cursor-pointer gap-5"
				href={nowPlaying ? tracks[0]?.url : undefined}
				target="_blank"
				rel="noreferrer"
			>
				<img
					src={
						nowPlaying
							? tracks[0]?.image?.[3]?.["#text"] ||
								"https://www.last.fm/static/images/lastfm_avatar_twitter.52a5d69a85ac.png"
							: "https://www.last.fm/static/images/lastfm_avatar_twitter.52a5d69a85ac.png"
					}
					alt={nowPlaying ? tracks[0]?.album?.["#text"] || "LastFM" : "LastFM"}
					className="phosphor-filter border-primary h-full w-30 border hover:filter-none!"
					loading="lazy"
				/>
				<div className="hover:brightness-120">
					<p className="line-clamp-2 text-lg font-bold tracking-wide">
						{nowPlaying
							? tracks[0]?.name
							: loading
								? "Loading..."
								: "Nothing is currently playing..."}
					</p>
					<p className="font-mono text-sm">
						{nowPlaying
							? `Artist: ${tracks[0]?.artist?.["#text"] || ""}`
							: loading
								? "Connecting to Last.FM"
								: "Offline"}
					</p>
					<p
						className={`font-mono text-sm ${!nowPlaying ? "hidden" : ""}`}
					>
						Album: {tracks[0]?.album?.["#text"]}
					</p>
				</div>
			</a>
			{!loading ? (
				<>
					<div className="flex items-center gap-2">
						<hr className="border-primary/40 grow border border-dashed" />
						<p className="text-primary/40 text-center font-mono text-xs tracking-widest">
							Recent Tracks
						</p>
						<hr className="border-primary/40 grow border border-dashed" />
					</div>

					<div className="flex flex-col gap-1">
						{recentTracks.map((track, index) => (
							<a
								key={`${track?.url || "track"}-${index}`}
								href={track?.url}
								target="_blank"
								rel="noreferrer"
								className="grid grid-cols-[2fr_1fr] gap-1 font-mono text-sm hover:brightness-120"
							>
								<p className="line-clamp-1 text-primary">{track?.name}</p>
								<p className="text-primary/50 line-clamp-1 text-right whitespace-nowrap">
									{track?.artist?.["#text"]}
								</p>
							</a>
						))}
					</div>
				</>
			) : null}
		</div>
	);
}

export default Scrobble;
