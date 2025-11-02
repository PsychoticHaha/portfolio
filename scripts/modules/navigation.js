export function initNavigation({ performLazyLoading }) {
  const desktopLinks = document.querySelectorAll('nav.desktop-menu .links .link');
  desktopLinks.forEach((link) => {
    const rawHtml = link.innerHTML;
    link.innerHTML = `<span class="link-text">${rawHtml}</span><span class="border-span"></span>`;
  });

  const sections = document.querySelectorAll('section');
  const menuLinks = document.querySelectorAll('header nav a');
  const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');

  function isSectionVisible(section) {
    const rect = section.getBoundingClientRect();
    return rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2;
  }

  function updateActiveLinks() {
    menuLinks.forEach((link) => link.classList.remove('active'));
    mobileMenuLinks.forEach((link) => link.classList.remove('active'));

    sections.forEach((section) => {
      if (!isSectionVisible(section)) {
        return;
      }

      const id = section.id !== 'why-us-section' ? section.id : 'about-me-section';
      const desktopTarget = document.querySelector(`header nav a[href="#${id}"]`);
      const mobileTarget = document.querySelector(`.mobile-menu a[href="#${id}"]`);

      desktopTarget?.classList.add('active');
      mobileTarget?.classList.add('active');

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

  const links = mobileMenu.querySelectorAll('a');

  const toggleMobileMenu = () => {
    mobileMenu.classList.toggle('show');
    hamburgerMenu.classList.toggle('clicked');
  };

  hamburgerMenu.addEventListener('click', toggleMobileMenu);
  links.forEach((link) => link.addEventListener('click', toggleMobileMenu));
}
