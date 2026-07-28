<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from "vue";

interface Data {
	recenttracks: [
		track: {
			artist: { "#text": string };
			image: {
				size: "small" | "medium" | "large" | "extralarge";
				"#text": string;
			}[];
			album: { "#text": string };
			name: string;
			"@attr"?: { nowplaying: boolean };
			url: string;
		}[],
	];
}

const lastfm = ref();
const error = ref<Error | null>(null);
let fetchInterval: ReturnType<typeof setInterval>;

async function fetchAndRender() {
	try {
		const res = await fetch("/api/lastfm-endpoint");
		if (!res.ok) throw new Error("Failed to connect to LastFM");
		const data: Data = await res.json();
		lastfm.value = data.recenttracks;
	} catch (e) {
		error.value = e as Error;
	}
}

const isPlaying = computed(
	() => lastfm.value?.track?.[0]?.["@attr"]?.nowplaying === "true",
);

onMounted(() => {
	fetchAndRender();
	fetchInterval = setInterval(fetchAndRender, 5000);
});

onBeforeUnmount(() => {
	if (fetchInterval) clearInterval(fetchInterval);
});

const COLS = 20;
const SEGS = 14;
const PEAK_DECAY = 0.35;
const levels = ref<number[]>(Array.from({ length: COLS }, () => 1));
const peaks = ref<number[]>(Array.from({ length: COLS }, () => 1));
let meterInterval: ReturnType<typeof setInterval>;

function tickMeter() {
	levels.value = levels.value.map((_, i) => {
		const next = isPlaying.value
			? 1 + Math.floor(Math.random() * (SEGS - 1))
			: 1;

		peaks.value[i] =
			next >= peaks.value[i]
				? next
				: Math.max(next, peaks.value[i] - PEAK_DECAY);

		return next;
	});
}

onMounted(() => {
	tickMeter();
	meterInterval = setInterval(tickMeter, 220);
});

onBeforeUnmount(() => {
	if (meterInterval) clearInterval(meterInterval);
});
</script>

<template>
	<div v-if="lastfm" class="space-y-3.5">
		<div class="flex items-baseline justify-between">
			<p class="text-lg font-bold tracking-widest">&gt; LAST_FM</p>
			<p
				class="text-primary flex items-center gap-1 font-mono text-[9px] tracking-[0.1em]"
			>
				<span
					class="bg-primary h-1.5 w-1.5 rounded-full"
					:class="{ 'opacity-30': !isPlaying }"
				></span>
				{{ isPlaying ? "SCROBBLING" : "IDLE" }}
			</p>
		</div>

		<div class="flex h-40 gap-1">
			<div
				v-for="(level, colIdx) in levels"
				:key="colIdx"
				class="relative flex flex-1 flex-col-reverse gap-[3px]"
			>
				<div
					v-for="seg in SEGS"
					:key="seg"
					class="min-h-1 flex-1"
					:class="[
						seg <= level ? 'bg-primary' : 'bg-primary/10',
						seg <= level && seg > SEGS - 3 ? 'bg-primary' : '',
					]"
					:style="
						seg <= level && seg === level
							? { boxShadow: '0 0 3px var(--color-primary)' }
							: {}
					"
				/>

				<span
					class="bg-primary absolute left-0 h-[2px] w-full"
					:style="{
						bottom: `calc(${(peaks[colIdx] / SEGS) * 100}% - 1px)`,
						boxShadow: '0 0 4px var(--color-primary)',
						opacity: isPlaying ? 1 : 0.25,
					}"
				/>
			</div>
		</div>

		<a
			v-if="isPlaying"
			class="flex gap-3 pt-3 font-mono"
			:href="lastfm.track[0].url"
			target="_blank"
			rel="noreferrer"
		>
			<img
				:src="lastfm.track[0].image[1]['#text']"
				:alt="lastfm.track[0].album['#text']"
				:title="lastfm.track[0].album['#text']"
				class="h-15 w-15 shrink-0 object-cover"
				loading="lazy"
			/>
			<div class="min-w-0">
				<p class="text-primary mb-0.5 line-clamp-2 font-bold text-balance">
					{{ lastfm.track[0].name }}
				</p>
				<p class="text-primary/70 truncate text-xs text-ellipsis">
					{{ lastfm.track[0].artist["#text"] }}
					<span class="text-primary/40 font-bold">&middot;</span>
					{{ lastfm.track[0].album["#text"] }}
				</p>
			</div>
		</a>

		<div v-if="error">
			<p class="font-mono text-sm text-red-500">{{ error.stack }}</p>
		</div>
	</div>
</template>
