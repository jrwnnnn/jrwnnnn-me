import piexif from "piexifjs";

export async function stripGPS(file: File): Promise<Blob> {
	const dataUrl = await new Promise<string>((resolve) => {
		const reader = new FileReader();
		reader.onload = () => resolve(reader.result as string);
		reader.readAsDataURL(file);
	});

	const exif = piexif.load(dataUrl);
	delete exif["GPS"];
	const stripped = piexif.insert(piexif.dump(exif), dataUrl);

	const res = await fetch(stripped);
	return res.blob();
}
