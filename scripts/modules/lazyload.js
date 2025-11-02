export function performLazyLoading(selector) {
  if (!selector) {
    return;
  }

  const images = document.querySelectorAll(`${selector} img`);

  images.forEach((img) => {
    const dataSrc = img.getAttribute('data-img');
    if (dataSrc) {
      img.src = dataSrc;
      img.removeAttribute('data-img');
    }
  });
}
