<script>
document.body.style.overflow = "hidden";

function hideLoader() {
  let loaderOverlay = document.querySelector(".load-overlay-container");
  if (loaderOverlay) {
    const lines = loaderOverlay.querySelectorAll('.line-overlay');

    lines.forEach((line, index) => {
        index % 2 === 0 ? line.style.transform = 'translateY(-100vh)' : line.style.transform = 'translateY(100vh)';
    })

    setTimeout(() => {
        loaderOverlay.remove();
    }, 1000);
  }

  document.body.removeAttribute('style');
}
</script>
