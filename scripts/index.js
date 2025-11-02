import { messageEndpoint, reactionBackendPoint, feedbackEndpoint } from './endpoints.js';
import { heroRoles, messages } from './modules/translations.js';
import { initThemeControls } from './modules/theme.js';
import { initHeroTextAnimation } from './modules/heroText.js';
import { initNavigation } from './modules/navigation.js';
import { initCustomCursor } from './modules/cursor.js';
import { performLazyLoading } from './modules/lazyload.js';
import { initWorksInteractions } from './modules/works.js';
import { createPopupController } from './modules/popup.js';
import { setupContactForm } from './modules/contactForm.js';
import { setupFeedbackForm } from './modules/feedbackForm.js';
import { setupReactions } from './modules/reactions.js';
import { initSwiper } from './modules/swiper.js';

document.addEventListener('DOMContentLoaded', (event) => {
  const themeControls = initThemeControls();
  themeControls.initialiseThemeState();

  initHeroTextAnimation(heroRoles);
  initNavigation({ performLazyLoading });

  const moveCustomCursor = initCustomCursor();
  if (typeof moveCustomCursor === 'function') {
    moveCustomCursor(event);
  }

  initWorksInteractions();

  const popupController = createPopupController();

  setupContactForm({
    messageEndpoint,
    messages,
    popup: popupController
  });

  const feedbackControls = setupFeedbackForm({
    feedbackEndpoint,
    messages,
    popup: popupController
  });

  setupReactions({
    reactionEndpoint: reactionBackendPoint,
    messages,
    popup: popupController,
    feedbackControls
  });

  initSwiper();

  if (window.AOS && typeof window.AOS.init === 'function') {
    window.AOS.init({
      duration: 800,
      once: false,
      offset: 120,
      easing: 'ease-out-cubic'
    });
  }
});
