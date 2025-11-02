<script>
document.body.style.overflow = "hidden";

function hideLoader() {
  let loaderOverlay = document.querySelector(".load-overlay-container");
  if (loaderOverlay) {
    const curtain = loaderOverlay.querySelector('.curtain');

    if (curtain) {
      requestAnimationFrame(() => {
        curtain.classList.add('open');
      });
    }

    setTimeout(() => {
      loaderOverlay.remove();
    }, 900);
  }

  document.body.removeAttribute('style');
}
</script>
