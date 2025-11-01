import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

document.addEventListener('DOMContentLoaded', () => {
  const toggles = document.querySelectorAll('[data-toggle-nav]');

  toggles.forEach((toggle) => {
    toggle.addEventListener('click', () => {
      const targetSelector = toggle.dataset.target || '#mobile-nav';
      const target = document.querySelector(targetSelector);

      if (target) {
        target.classList.toggle('hidden');
      }
    });
  });
});
