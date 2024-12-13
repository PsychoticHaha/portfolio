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
    "a React.js/Next.js Developer"
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

  const reaction = localStorage.getItem("reaction");
  const likeIcon = document.querySelector(".reactions .icon.like"),
    dislikeIcon = document.querySelector(".reactions .icon.dislike"),
    loveIcon = document.querySelector(".reactions .icon.love");
  const feedbackForm = document.querySelector(".popup-wrapper");

  if (reaction) {
    switch (reaction) {
      case "like":
        likeIcon.classList.add("clicked");
        break;
      case "love":
        loveIcon.classList.add("clicked");
        break;
      case "dislike":
        dislikeIcon.classList.add("dislike");
        break;
      default:
        break;
    }
  }

  const reactionBtns = document.querySelectorAll(".reactions .icon");

  reactionBtns.forEach(btn => {
    btn.addEventListener("click", () => handleReactionClick(btn));
  });

  function handleReactionClick(btnEl) {
    if (btnEl === dislikeIcon && !dislikeIcon.classList.contains('clicked')) {
      feedbackForm.classList.add('show');
    }

    btnEl.classList.add('clicked', 'animate');
    setTimeout(() => {
      btnEl.classList.remove('animate');
    }, 500);

    reactionBtns.forEach(btn => {
      if (btn !== btnEl) {
        btn.classList.remove('clicked');
      }
    });
    localStorage.setItem('reaction', btnEl.classList[1]);
    const url = new URL(window.location.href);
    console.log('URL', url);

  }

  feedbackForm.querySelector('.close').addEventListener('click', (event) => {
    event.stopPropagation();
    feedbackForm.classList.remove('show');
  });

  let themeToggleBtn = document.querySelector(".theme-toggle-btn"),
    theme = localStorage.getItem("theme"),
    body = document.body;

  if (theme === "dark") {
    body.classList.add("dark");
    themeToggler.classList.add("dark");
    ROOT_EL.classList.add("dark");
  } else {
    body.classList.remove("dark");
    themeToggler.classList.remove("dark");
    themeToggler.classList.add('light');
    ROOT_EL.classList.remove("dark");
  }
  themeToggleBtn.firstElementChild.classList.toggle("dark", theme !== "dark");

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

let contactForm = document.getElementById("contact-form");
let sendBtn = document.getElementById("send-message-btn");
let fullnameInput = document.getElementById("fullname");
let emailInput = document.getElementById("email");
let messageInput = document.getElementById("message");
let popupDiv = document.querySelector(".popup-message");
let closePopupBtn = document.querySelector(".close-popup-btn");

function checkMessageAndEmail() {
  let message = messageInput.value.trim();
  let email = emailInput.value;
  return message && email && message.length >= 6;
}

function showPopup(type) {
  popupDiv.classList.add(type);
  setTimeout(() => popupDiv.classList.remove(type), 2500);
}

function closePopup() {
  popupDiv.classList.remove("success", "error");
}

contactForm.addEventListener("submit", (event) => {
  event.preventDefault();
  let formData = new FormData();
  formData.append("fullname", fullnameInput.value);
  formData.append("email", emailInput.value);
  formData.append("message", messageInput.value.trim());

  if (checkMessageAndEmail()) {
    fetch(e, { method: "POST", body: formData })
      .then(response => response.json())
      .then(data => {
        if (data === "sent") {
          popupDiv.firstElementChild.textContent = "Thanks for your message!";
          showPopup("success");
          fullnameInput.value = "";
          emailInput.value = "";
          messageInput.value = "";
        } else {
          popupDiv.firstElementChild.textContent = "Sorry, cannot perform the task.";
          showPopup("error");
        }
      });
  } else {
    popupDiv.firstElementChild.textContent = "Please fill the content!";
    showPopup("error");
  }
});

closePopupBtn.addEventListener("click", closePopup);

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


