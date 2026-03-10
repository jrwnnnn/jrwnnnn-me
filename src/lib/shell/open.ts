export async function open(args: string[]): Promise<HTMLElement> {
	const path = args[0];
	const p = document.createElement("p");

	if (!path) {
		p.textContent = "Usage: open <path>";
		return p;
	}

	const url = `${window.location.origin}/${path}`;
	p.textContent = `Opening ${url}...`;
	setTimeout(() => {
		window.open(url, "_parent");
	}, 1000);
	return p;
}
