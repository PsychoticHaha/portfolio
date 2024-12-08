
const hamburger_menu = document.querySelector('.hamburger-menu');
const mobileMenu = document.querySelector('.mobile-menu');

function toggleMobileMenu() {
  hamburger_menu.classList.toggle('clicked')
}

// This function can be called on a button click or any other user action
function closeCurrentTab() {
  window.close();
}
hamburger_menu.addEventListener('click', closeCurrentTab);


// THEME TOGGLING
const themeBtn = document.querySelector('.theme-toggle-btn');
themeBtn.addEventListener('click', () => {
  setTimeout(() => {
    themeBtn.firstElementChild.classList.toggle('dark');
  }, 400);
  animateIcon();
  if (!document.body.classList.contains('dark')) {
    document.body.classList.add('dark');
  } else {
    document.body.classList.remove('dark');
  };
})

function animateIcon() {
  const themeIcon = document.querySelectorAll('header .theme-toggle-btn .svg');
  themeIcon.forEach(icon => {
    icon.classList.add('off');
    setTimeout(() => {
      icon.classList.remove('off');
    }, 400);
  });
}