export async function logout(): Promise<HTMLElement> {
	const p = document.createElement("p");

	const res = await fetch("/api/logout", { method: "POST" });

	if (res.ok) {
		p.textContent = "Logged out.";
		setTimeout(() => window.location.reload(), 500);
	} else {
		p.textContent = "Logout failed.";
		p.classList.add("text-red-500");
	}

	return p;
}
