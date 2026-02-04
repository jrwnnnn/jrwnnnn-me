document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll(
    ".glitch",
  ) as NodeListOf<HTMLElement>;

  elements.forEach((el) => {
    if (el.dataset.init) return;
    el.dataset.init = "1";

    const wrapper = document.createElement("div");
    wrapper.style.cssText =
      "position:relative; width:100%; height:100%; isolation:isolate;";

    const childNodes = [...el.childNodes];
    el.innerHTML = "";
    childNodes.forEach((n) => wrapper.appendChild(n));
    el.appendChild(wrapper);

    const layers = [0, 1].map(() => {
      const l = wrapper.cloneNode(true) as HTMLElement;

      l.style.cssText =
        "position:absolute; top:0; left:0; width:100%; height:100%; opacity:0; pointer-events:none; z-index:10; mix-blend-mode:hard-light;";

      l.querySelectorAll("[id]").forEach((n) => n.removeAttribute("id"));

      el.appendChild(l);
      return l;
    });

    let f = 0;
    const loop = () => {
      f++;
      if (f % 10 === 0) {
        const active = Math.random() < 0.05;
        layers.forEach((l) => {
          if (!active) {
            l.style.opacity = "0";
            return;
          }

          const h = el.offsetHeight;
          const t = Math.random() * h;
          const s = Math.random() * (h * 0.2) + 5;

          l.style.display = "block";
          l.style.opacity = "1";
          l.style.clipPath = `inset(${t}px 0 ${h - (t + s)}px 0)`;
          l.style.transform = `translateX(${(Math.random() - 0.5) * 20}px) scale(1.01)`;

          if (Math.random() < 0.5) {
            l.style.filter = `hue-rotate(${Math.random() * 360}deg) contrast(1.5)`;
          } else {
            l.style.filter = "none";
          }
        });
      }
      requestAnimationFrame(loop);
    };
    loop();
  });
});
