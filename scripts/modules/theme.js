const TRANSITION_DURATION = 600;
const RESET_DURATION = 1000;

export function initThemeControls() {
  const rootEl = document.documentElement;
  const body = document.body;
  const themeOverlay = document.querySelector('.theme-toggler');
  const themeButton = document.querySelector('header.header .right .theme-toggle-btn');

  if (!themeOverlay || !themeButton) {
    return {
      toggleTheme: () => {},
      initialiseThemeState: () => {}
    };
  }

  function animateIcon() {
    const icons = themeButton.querySelectorAll('.svg');
    icons.forEach((icon) => {
      icon.classList.add('off');
      setTimeout(() => icon.classList.remove('off'), 400);
    });
  }

  function toggleTheme() {
    animateIcon();

    if (body.classList.contains('dark')) {
      themeOverlay.classList.replace('dark', 'light');
    } else if (themeOverlay.classList.contains('light')) {
      themeOverlay.classList.replace('light', 'dark');
    } else {
      themeOverlay.classList.add('dark');
    }

    themeOverlay.classList.add('progress');
    body.classList.add('neutral-bg');

    setTimeout(() => {
      themeButton.firstElementChild?.classList.toggle('dark');

      if (body.classList.contains('dark')) {
        body.classList.remove('dark');
        rootEl.classList.remove('dark');
        localStorage.setItem('theme', 'light');
      } else {
        body.classList.add('dark');
        rootEl.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      }
    }, TRANSITION_DURATION);

    setTimeout(() => {
      themeOverlay.classList.remove('progress');
      body.classList.remove('neutral-bg');
    }, RESET_DURATION);
  }

  function initialiseThemeState() {
    const storedTheme = localStorage.getItem('theme');

    if (storedTheme === 'dark') {
      body.classList.add('dark');
      themeOverlay.classList.add('dark');
      rootEl.classList.add('dark');
    } else {
      body.classList.remove('dark');
      themeOverlay.classList.remove('dark');
      themeOverlay.classList.add('light');
      rootEl.classList.remove('dark');
    }

    const iconWrapper = themeButton.firstElementChild;
    if (iconWrapper) {
      iconWrapper.classList.toggle('dark', storedTheme !== 'dark');
    }
  }

  themeButton.addEventListener('click', toggleTheme);

  return {
    toggleTheme,
    initialiseThemeState
  };
}
