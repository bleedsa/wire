document.querySelectorAll(".unixtime").forEach((x) => {
	let d = new Date(1000 * parseInt(x.innerHTML, 10));
	let o = {
		weekday: "short", month: "short", day: "numeric",
		hour: "numeric", minute: "numeric", second: "numeric",
	};
	let s = d.toLocaleString('en-US', o);

	x.innerHTML = s;
});
