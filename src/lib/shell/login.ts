export async function login(args: string[]): Promise<HTMLElement> {
	const p = document.createElement("p");
	const password = args[0]?.trim();

	if (!password) {
		p.textContent = "Usage: login <password>";
		return p;
	}
	const res = await fetch("/api/login", {
		method: "POST",
		headers: { "Content-Type": "application/json" },
		body: JSON.stringify({ password }),
	});

	if (res.status === 200) {
		p.textContent = "Login successful.";
		setTimeout(() => window.location.reload(), 500);
	} else if (res.status === 401) {
		p.textContent = "Invalid password.";
		p.classList.add("text-red-500");
	} else {
		p.textContent = "Server error.";
		p.classList.add("text-red-500");
	}

	return p;
}
