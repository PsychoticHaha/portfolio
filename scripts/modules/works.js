export function initWorksInteractions() {
  const containers = document.querySelectorAll('.my-works .works-container .links');

  containers.forEach((container) => {
    const links = container.querySelectorAll('a');
    links.forEach((link) => {
      link.addEventListener('focus', () => {
        container.classList.add('show');
      });
      link.addEventListener('blur', () => {
        container.classList.remove('show');
      });
    });
  });
}
