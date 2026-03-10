import helpText from "./help.txt?raw";

export function echo(args: string[]): HTMLElement {
	const p = document.createElement("p");
	p.textContent = args.join(" ");
	return p;
}

export function help(): HTMLElement {
	const pre = document.createElement("pre");
	pre.className = "font-mono";
	pre.textContent = helpText;
	return pre;
}

export function ping(): HTMLElement {
	const p = document.createElement("p");
	p.textContent = "pong";
	return p;
}

export function sudo(): HTMLElement {
	const p = document.createElement("p");
	p.textContent = "nice try mate";
	return p;
}
