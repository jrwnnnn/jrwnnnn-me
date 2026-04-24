import { marked } from "marked";

marked.use({
	extensions: [
		{
			name: "embed",
			level: "block",
			start: (src) => src.indexOf("::embed["),
			tokenizer(src) {
				const match = /^::embed\[([^\]]+)\]\n?/.exec(src);
				if (match) return { type: "embed", raw: match[0], url: match[1] };
			},
			renderer: (token) => {
				let url = token.url.trim();
				try {
					const parsedUrl = new URL(url);
					if (parsedUrl.hostname === "drive.google.com") {
						url = url.replace("/view", "/preview").replace("/edit", "/preview");
					}
				} catch {
					// Leave url unchanged if it cannot be parsed as an absolute URL.
				}
				return `<div id="embed-container"><iframe src="${url}" allowfullscreen frameBorder="0">Your browser does not support iframes.</iframe></div>`;
			},
		},
	],
});
