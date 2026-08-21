(() => {
  const selector = 'a.rk-lightbox[href$=".jpg"], a.rk-lightbox[href$=".jpeg"], a.rk-lightbox[href$=".png"], .rk-gallery a[href$=".jpg"], .rk-gallery a[href$=".jpeg"], .rk-gallery a[href$=".png"]';
  let overlay, img, caption;

  function ensureOverlay() {
    if (overlay) return overlay;
    overlay = document.createElement('div');
    overlay.className = 'rk-lightbox-overlay';
    overlay.innerHTML = '<button class="rk-lightbox-close" type="button" aria-label="Zavřít">×</button><button class="rk-lightbox-prev" type="button" aria-label="Předchozí">‹</button><img alt=""><button class="rk-lightbox-next" type="button" aria-label="Další">›</button><div class="rk-lightbox-caption"></div>';
    document.body.appendChild(overlay);
    img = overlay.querySelector('img');
    caption = overlay.querySelector('.rk-lightbox-caption');
    overlay.addEventListener('click', (event) => {
      if (event.target === overlay || event.target.classList.contains('rk-lightbox-close')) close();
      if (event.target.classList.contains('rk-lightbox-prev')) move(-1);
      if (event.target.classList.contains('rk-lightbox-next')) move(1);
    });
    document.addEventListener('keydown', (event) => {
      if (!overlay.classList.contains('is-open')) return;
      if (event.key === 'Escape') close();
      if (event.key === 'ArrowLeft') move(-1);
      if (event.key === 'ArrowRight') move(1);
    });
    return overlay;
  }

  function groupLinks(current) {
    const gallery = current.closest('.rk-gallery');
    return Array.from((gallery || document).querySelectorAll(gallery ? 'a[href]' : selector))
      .filter(a => /\.(jpe?g|png|webp)(\?.*)?$/i.test(a.href));
  }

  function open(link) {
    ensureOverlay();
    overlay.links = groupLinks(link);
    overlay.index = Math.max(0, overlay.links.indexOf(link));
    render();
    overlay.classList.add('is-open');
    document.documentElement.classList.add('rk-lightbox-open');
  }

  function render() {
    const link = overlay.links[overlay.index];
    img.src = link.href;
    const nested = link.querySelector('img');
    caption.textContent = nested?.alt || link.title || '';
  }

  function move(delta) {
    if (!overlay?.links?.length) return;
    overlay.index = (overlay.index + delta + overlay.links.length) % overlay.links.length;
    render();
  }

  function close() {
    if (!overlay) return;
    overlay.classList.remove('is-open');
    document.documentElement.classList.remove('rk-lightbox-open');
    img.removeAttribute('src');
  }

  document.addEventListener('click', (event) => {
    const link = event.target.closest(selector);
    if (!link) return;
    event.preventDefault();
    event.stopPropagation();
    if (typeof event.stopImmediatePropagation === 'function') event.stopImmediatePropagation();
    open(link);
  }, true);
})();
