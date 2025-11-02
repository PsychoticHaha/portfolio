export function initNavigation({ performLazyLoading }) {
  const desktopLinks = document.querySelectorAll('nav.desktop-menu .links [data-scroll-target]');
  desktopLinks.forEach((link) => {
    const rawHtml = link.innerHTML;
    link.innerHTML = `<span class="link-text">${rawHtml}</span><span class="border-span"></span>`;
  });

  const sections = document.querySelectorAll('section');
  const mobileMenuLinks = document.querySelectorAll('.mobile-menu [data-scroll-target]');
  const allScrollLinks = document.querySelectorAll('[data-scroll-target]');

  allScrollLinks.forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      const targetSelector = link.getAttribute('data-scroll-target');
      if (!targetSelector) {
        return;
      }
      const target = document.querySelector(targetSelector);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  function isSectionVisible(section) {
    const rect = section.getBoundingClientRect();
    return rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2;
  }

  function updateActiveLinks() {
    desktopLinks.forEach((link) => link.classList.remove('active'));
    mobileMenuLinks.forEach((link) => link.classList.remove('active'));

    sections.forEach((section) => {
      if (!isSectionVisible(section)) {
        return;
      }

      const id = section.id !== 'why-us-section' ? section.id : 'about-me-section';

      desktopLinks.forEach((link) => {
        link.classList.toggle('active', link.getAttribute('data-scroll-target') === `#${id}`);
      });

      mobileMenuLinks.forEach((link) => {
        link.classList.toggle('active', link.getAttribute('data-scroll-target') === `#${id}`);
      });

      if (typeof performLazyLoading === 'function') {
        performLazyLoading(`#${id}`);
      }
    });
  }

  document.addEventListener('scroll', updateActiveLinks);
  updateActiveLinks();

  initMobileMenu();

  return { updateActiveLinks };
}

function initMobileMenu() {
  const hamburgerMenu = document.querySelector('.hamburger-menu');
  const mobileMenu = document.querySelector('.mobile-menu');

  if (!hamburgerMenu || !mobileMenu) {
    return;
  }

  const links = mobileMenu.querySelectorAll('[data-scroll-target]');

  const toggleMobileMenu = () => {
    mobileMenu.classList.toggle('show');
    hamburgerMenu.classList.toggle('clicked');
  };

  hamburgerMenu.addEventListener('click', toggleMobileMenu);
  links.forEach((link) => link.addEventListener('click', toggleMobileMenu));
}
