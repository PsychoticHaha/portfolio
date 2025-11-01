import { messageEndpoint, reactionBackendPoint, feedbackEndpoint } from './endpoints.js';

const ROOT_EL = document.querySelector(':root');
const themeToggler = document.querySelector('.theme-toggler');
let themeBtn = document.querySelector("header.header .right .theme-toggle-btn"),
  nav_links = document.querySelectorAll("nav.desktop-menu .links .link");

function animateIcon() {
  let icons = document.querySelectorAll("header.header .right .theme-toggle-btn .svg");
  icons.forEach(icon => {
    icon.classList.add("off");
    setTimeout(() => icon.classList.remove("off"), 400);
  });
}

function toggleTheme() {
  const body = document.querySelector('body');

  animateIcon();
  body.classList.contains('dark') ? themeToggler.classList.replace('dark', 'light') : themeToggler.classList.contains('light') ? themeToggler.classList.replace('light', 'dark') : themeToggler.classList.add('dark');
  themeToggler.classList.add('progress');
  body.classList.add('neutral-bg');

  setTimeout(() => {
    themeBtn.firstElementChild.classList.toggle("dark");

    if (body.classList.contains("dark")) {
      body.classList.remove("dark");
      ROOT_EL.classList.remove("dark");
      localStorage.setItem("theme", "light");
    } else {
      body.classList.add("dark");
      ROOT_EL.classList.add("dark");
      localStorage.setItem("theme", "dark");
    }
  }, 600);

  setTimeout(() => {
    themeToggler.classList.remove('progress');
    body.classList.remove('neutral-bg');
  }, 1000);
}

document.addEventListener("DOMContentLoaded", (loadedEvent) => {
  themeBtn.addEventListener("click", toggleTheme);

  // HERO TEXT ANIMATION
  let texts = [
    "an Expert Front-End Developer",
    "an UI/UX Designer",
    "a Professional Web Integrator",
    "a React.js/NextJs Developer",
    "a WordPress Developer"
  ];

  let currentTextIndex = 0;

  function typeText(text, index) {
    if (index < text.length) {
      descParagraph.innerHTML += text.charAt(index);
      setTimeout(() => typeText(text, index + 1), 50);
    } else {
      setTimeout(() => deleteText(text, index), 1000);
    }
  }

  function deleteText(text, index) {
    if (index >= 0) {
      descParagraph.innerHTML = text.substring(0, index);
      setTimeout(() => deleteText(text, index - 1), 50);
    } else {
      currentTextIndex = (currentTextIndex + 1) % texts.length;
      setTimeout(() => typeText(texts[currentTextIndex], 0), 500);
    }
  }

  typeText(texts[currentTextIndex], 0);


  // Section navbar animation (active class)
  const sections = document.querySelectorAll("section");
  const aboutSectionBtn = document.querySelector('a.item.resume'),
    scrollCursorIcon = document.querySelector('.mouse-container .mouse');

  scrollCursorIcon.addEventListener('click', () => {
    aboutSectionBtn.click();
  })

  // Récupération des liens du menu principal et du menu mobile
  const menuLinks = document.querySelectorAll('header nav a');
  const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');

  // Fonction pour déterminer si une section est visible
  const isSectionVisible = (section) => {
    const rect = section.getBoundingClientRect();
    return rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2;
  };

  // Fonction pour mettre à jour les classes actives
  const updateActiveLinks = () => {
    menuLinks.forEach((link) => link.classList.remove('active'));
    mobileMenuLinks.forEach((link) => link.classList.remove('active'));

    sections.forEach((section) => {
      if (isSectionVisible(section)) {
        const id = section.id !== 'why-us-section' ?  section.id  : 'about-me-section';

        // Ajout de la classe active pour le menu principal
        const menuLink = document.querySelector(`header nav a[href="#${id}"]`);
        if (menuLink) menuLink.classList.add('active');

        // Ajout de la classe active pour le menu mobile
        const mobileLink = document.querySelector(`.mobile-menu a[href="#${id}"]`);
        if (mobileLink) mobileLink.classList.add('active');
        perfomLazyLoading('#' + id);
      }
    });
  };

  // Écoute de l'événement scroll sur le document
  document.addEventListener('scroll', updateActiveLinks);

  // Mise à jour initiale au chargement de la page
  updateActiveLinks();
  moveCustomCursor(loadedEvent);

  const feedbackControls = setupFeedbackForm();
  setupReactions(feedbackControls);
  setupContactForm();
  initialiseThemeState();

  let workLinksContainers = document.querySelectorAll(".my-works .works-container .links");
  workLinksContainers.forEach(container => {
    let links = container.querySelectorAll("a");
    links.forEach(link => {
      link.addEventListener("focus", () => {
        link.parentElement.classList.add("show");
      });
      link.addEventListener("focusout", () => {
        link.parentElement.classList.remove("show");
      });
    });
  });

});

nav_links.forEach(link => {
  let linkText = link.innerHTML;
  link.innerHTML = `
        <span class="link-text">${linkText}</span>
        <span class="border-span"></span>`;
});

let descParagraph = document.querySelector(".js-changing-paragraph");

let hamburger_menu = document.querySelector(".hamburger-menu"),
  mobileMenu = document.querySelector(".mobile-menu"),
  links = mobileMenu.querySelectorAll("a");

function toggleMobileMenu() {
  mobileMenu.classList.toggle("show");
  hamburger_menu.classList.toggle("clicked");
}

hamburger_menu.addEventListener("click", toggleMobileMenu);

links.forEach(link => {
  link.addEventListener("click", toggleMobileMenu);
});

let customCursor = document.querySelector(".mouse-cursor");
document.addEventListener("mousemove", (e) => {
  moveCustomCursor(e);
});

const allLinks = document.querySelectorAll('.cursor-set');

allLinks.forEach(link => {
  link.addEventListener('mouseover', () => {
    customCursor.style.scale = '0.1';
    customCursor.style.transition = ".2s ease-out;";
  });

  link.addEventListener('mouseout', (e) => {
    customCursor.style.scale = '';
    customCursor.style.transition = '';
    moveCustomCursor(e);
  })
});

function moveCustomCursor(event) {
  const isTouchDevice = 'ontouchstart' in window ||
    navigator.maxTouchPoints > 0 ||
    window.matchMedia('(pointer: coarse)').matches;

  if (window.innerWidth > 700 && !isTouchDevice) {
    let cursorSize = { width: customCursor.offsetWidth, height: customCursor.offsetHeight };
    customCursor.style.left = `${event.clientX - cursorSize.width / 2}px`;
    customCursor.style.top = `${event.clientY - cursorSize.height / 2}px`;
  }
}

function perfomLazyLoading(selector) {
  let lazyImages = document.querySelectorAll(`${selector} img`);

  lazyImages.forEach((img) => {
    const dataSrc = img.getAttribute("data-img");
    dataSrc && (img.src = dataSrc);
    img.removeAttribute('data-img');
  });
}

const popupDiv = document.querySelector('.popup-message');
const popupContent = popupDiv ? popupDiv.querySelector('#popup-content') : null;
const closePopupBtn = document.querySelector('.close-popup-btn');
let popupTimeoutHandle = null;

if (closePopupBtn) {
  closePopupBtn.addEventListener('click', closePopup);
}

function showPopup(type, message = '') {
  if (!popupDiv) return;

  popupDiv.classList.remove('success', 'error');
  if (message && popupContent) {
    popupContent.textContent = message;
  }

  popupDiv.classList.add(type);

  if (popupTimeoutHandle) {
    clearTimeout(popupTimeoutHandle);
  }

  popupTimeoutHandle = setTimeout(() => {
    closePopup();
  }, 2500);
}

function closePopup() {
  if (!popupDiv) return;
  if (popupTimeoutHandle) {
    clearTimeout(popupTimeoutHandle);
    popupTimeoutHandle = null;
  }
  popupDiv.classList.remove('success', 'error');
}

function initialiseThemeState() {
  const body = document.body;
  const themeToggleBtn = document.querySelector('.theme-toggle-btn');
  const theme = localStorage.getItem('theme');

  if (!themeToggleBtn) {
    return;
  }

  if (theme === 'dark') {
    body.classList.add('dark');
    themeToggler.classList.add('dark');
    ROOT_EL.classList.add('dark');
  } else {
    body.classList.remove('dark');
    themeToggler.classList.remove('dark');
    themeToggler.classList.add('light');
    ROOT_EL.classList.remove('dark');
  }

  const iconWrapper = themeToggleBtn.firstElementChild;
  if (iconWrapper) {
    iconWrapper.classList.toggle('dark', theme !== 'dark');
  }
}

function setupContactForm() {
  const contactForm = document.getElementById('contact-form');
  const sendBtn = document.getElementById('send-message-btn');
  const fullnameInput = document.getElementById('fullname');
  const emailInput = document.getElementById('email');
  const messageInput = document.getElementById('message');

  if (!contactForm || !sendBtn || !fullnameInput || !emailInput || !messageInput) {
    return;
  }

  const siteKey = contactForm.dataset.recaptchaSitekey || '';

  const resetForm = () => {
    contactForm.reset();
    const tokenInput = document.getElementById('recaptcha-token');
    if (tokenInput) {
      tokenInput.value = '';
    }
  };

  const requestRecaptchaToken = () => new Promise((resolve, reject) => {
    if (!siteKey) {
      resolve(null);
      return;
    }

    const ensureRecaptcha = () => new Promise((innerResolve, innerReject) => {
      if (typeof grecaptcha !== 'undefined') {
        innerResolve();
        return;
      }

      const maxAttempts = 20;
      let attempts = 0;
      const interval = setInterval(() => {
        attempts += 1;

        if (typeof grecaptcha !== 'undefined') {
          clearInterval(interval);
          innerResolve();
        } else if (attempts >= maxAttempts) {
          clearInterval(interval);
          innerReject(new Error('Verification service is unavailable. Please reload the page.'));
        }
      }, 250);
    });

    ensureRecaptcha()
      .then(() => {
        grecaptcha.ready(() => {
          grecaptcha.execute(siteKey, { action: 'contact_form' })
            .then((token) => resolve(token))
            .catch(() => reject(new Error('Verification failed. Please try again.')));
        });
      })
      .catch((error) => reject(error));
  });

  contactForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const fullname = fullnameInput.value.trim();
    const email = emailInput.value.trim();
    const message = messageInput.value.trim();

    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    if (!fullname || !email || !isEmail || message.length < 6) {
      showPopup('error', 'Please provide a valid email and a message with at least 6 characters.');
      return;
    }

    sendBtn.disabled = true;
    sendBtn.classList.add('loading');

    try {
      const token = await requestRecaptchaToken();

      const formData = new FormData();
      formData.append('fullname', fullname);
      formData.append('email', email);
      formData.append('message', message);

      if (token) {
        formData.append('g-recaptcha-response', token);
        formData.append('recaptcha_action', 'contact_form');
        const hiddenToken = document.getElementById('recaptcha-token');
        if (hiddenToken) {
          hiddenToken.value = token;
        }
      }

      const response = await fetch(messageEndpoint, {
        method: 'POST',
        body: formData,
      });

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }

      let payload = null;

      try {
        payload = await response.json();
      } catch (parseError) {
        throw new Error('Unexpected response from the server.');
      }

      if (payload === 'sent' || (payload && payload.status === 'sent')) {
        showPopup('success', 'Thanks for your message!');
        resetForm();
      } else {
        const messageText = payload && payload.message ? payload.message : 'Sorry, I could not send your message. Please try again later.';
        throw new Error(messageText);
      }
    } catch (error) {
      console.error('Contact form error:', error);
      showPopup('error', error.message || 'Sorry, I could not send your message. Please try again later.');
    } finally {
      sendBtn.disabled = false;
      sendBtn.classList.remove('loading');
    }
  });
}

function setupFeedbackForm() {
  const wrapper = document.querySelector('.popup-wrapper');
  const closeBtn = wrapper ? wrapper.querySelector('.close') : null;
  const textarea = wrapper ? wrapper.querySelector('#feedback-message') : null;
  const submitBtn = document.getElementById('send-feedback-btn');

  const close = () => {
    if (wrapper) {
      wrapper.classList.remove('show');
    }
  };

  const open = () => {
    if (wrapper) {
      wrapper.classList.add('show');
      if (textarea) {
        textarea.focus();
      }
    }
  };

  if (closeBtn) {
    closeBtn.addEventListener('click', (event) => {
      event.stopPropagation();
      close();
    });
  }

  if (wrapper) {
    wrapper.addEventListener('click', (event) => {
      if (event.target === wrapper) {
        close();
      }
    });
  }

  if (submitBtn && textarea) {
    submitBtn.addEventListener('click', async () => {
      const feedbackMessage = textarea.value.trim();

      if (feedbackMessage.length < 3) {
        showPopup('error', 'Please tell me a little bit more so I can improve.');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.classList.add('loading');

      try {
        const formData = new FormData();
        formData.append('message', feedbackMessage);

        const response = await fetch(feedbackEndpoint, {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          throw new Error(`HTTP ${response.status}`);
        }

        const payload = await response.json();
        if (payload && payload.status === 'saved') {
          showPopup('success', 'Thanks for the feedback!');
          textarea.value = '';
          close();
        } else {
          throw new Error('Unexpected response');
        }
      } catch (error) {
        console.error('Feedback error:', error);
        showPopup('error', 'Unable to save your feedback right now.');
      } finally {
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
      }
    });
  }

  return { open, close };
}

function setupReactions(feedbackControls = { open: () => {}, close: () => {} }) {
  const reactionButtons = document.querySelectorAll('.reactions .icon');
  if (!reactionButtons.length) {
    return;
  }

  const reactionCounters = Array.from(document.querySelectorAll('[data-reaction-count]')).reduce((acc, element) => {
    const reactionType = element.getAttribute('data-reaction-count');
    if (reactionType) {
      acc[reactionType] = element;
    }
    return acc;
  }, {});

  const setActiveReaction = (type) => {
    reactionButtons.forEach((button) => {
      button.classList.toggle('clicked', button.dataset.reaction === type);
    });
  };

  const storedReaction = localStorage.getItem('reaction');
  if (storedReaction) {
    setActiveReaction(storedReaction);
  }

  const renderStats = (stats) => {
    if (!stats) {
      return;
    }

    const total = typeof stats.total === 'number' ? stats.total : 0;

    ['love', 'like', 'dislike'].forEach((type) => {
      const counter = reactionCounters[type];
      if (!counter) return;
      const values = stats[type];
      if (total === 0) {
        counter.textContent = '--%';
        return;
      }

      if (values && typeof values.percentage === 'number') {
        counter.textContent = `${values.percentage}%`;
      } else {
        counter.textContent = '0%';
      }
    });
  };

  const fetchStats = async () => {
    try {
      const response = await fetch(`${reactionBackendPoint}?stats=1`);
      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }
      const payload = await response.json();
      renderStats(payload.stats || payload);
    } catch (error) {
      console.error('Failed to load reaction stats:', error);
    }
  };

  reactionButtons.forEach((button) => {
    button.addEventListener('click', async () => {
      const reactionType = button.dataset.reaction;
      if (!reactionType) {
        return;
      }

      if (reactionType === localStorage.getItem('reaction')) {
        return;
      }

      if (reactionType === 'dislike') {
        feedbackControls.open();
      }

      button.classList.add('animate');
      setTimeout(() => button.classList.remove('animate'), 500);

      try {
        const formData = new FormData();
        formData.append('reaction', reactionType);
        formData.append('date', new Date().toISOString());

        const response = await fetch(reactionBackendPoint, {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          throw new Error(`HTTP ${response.status}`);
        }

        const payload = await response.json();
        const stats = payload.stats || payload;

        setActiveReaction(reactionType);
        localStorage.setItem('reaction', reactionType);
        renderStats(stats);
      } catch (error) {
        console.error('Reaction error:', error);
        showPopup('error', 'Unable to save your reaction.');
      }
    });
  });

  fetchStats();
}

const swiper = new Swiper('.swiper-container', {
  slidesPerView: 'auto',
  spaceBetween: 15,
  autoplay: {
    delay: 500,
    disableOnInteraction: false,
  },
  freeMode: true,
  loop: true,
  reverseDirection: true,
  pauseOnMouseEnter: true,
  speed: 2500,
});
