// Élément racine
const ROOT_EL = document.querySelector(':root');

// Bouton de bascule de thème et liens de navigation
let themeBtn = document.querySelector("header.header .right .theme-toggle-btn"),
  nav_links = document.querySelectorAll("nav.desktop-menu .links .link");

// Animation de l'icône du thème
function animateIcon() {
  let icons = document.querySelectorAll("header.header .right .theme-toggle-btn .svg");
  icons.forEach(icon => {
    icon.classList.add("off");
    setTimeout(() => icon.classList.remove("off"), 400);
  });
}

// Bascule du thème clair/sombre
function toggleTheme() {
  // Animation de l'icône
  setTimeout(() => {
    themeBtn.firstElementChild.classList.toggle("dark");
  }, 400);

  animateIcon();

  if (document.body.classList.contains("dark")) {
    // Passer au thème clair
    document.body.classList.remove("dark");
    ROOT_EL.classList.remove("dark");

    localStorage.setItem("theme", "light");
  } else {
    // Passer au thème sombre
    document.body.classList.add("dark");
    ROOT_EL.classList.add("dark");
    localStorage.setItem("theme", "dark");
  }
}

// Initialisation des événements à DOMContentLoaded
document.addEventListener("DOMContentLoaded", () => {
  // Événement de clic pour le bouton de thème
  themeBtn.addEventListener("click", toggleTheme);
});

// Ajout d'un effet de style sur les liens de navigation
nav_links.forEach(link => {
  let linkText = link.innerHTML;
  link.innerHTML = `
        <span class="link-text">${linkText}</span>
        <span class="border-span"></span>`;
});

// Gestion du texte changeant dans un paragraphe
let descParagraph = document.querySelector(".js-changing-paragraph");

document.addEventListener("DOMContentLoaded", () => {
  let texts = [
    "an Expert Front-End Developer",
    "an UI/UX Designer",
    "a Professional Web Integrator",
    "a React.js/Next.js Developer"
  ];

  let currentTextIndex = 0;

  // Fonction pour afficher le texte caractère par caractère
  function typeText(text, index) {
    if (index < text.length) {
      descParagraph.innerHTML += text.charAt(index);
      setTimeout(() => typeText(text, index + 1), 50);
    } else {
      // Une fois le texte affiché, lancer l'effacement
      setTimeout(() => deleteText(text, index), 1000);
    }
  }

  // Fonction pour effacer le texte caractère par caractère
  function deleteText(text, index) {
    if (index >= 0) {
      descParagraph.innerHTML = text.substring(0, index);
      setTimeout(() => deleteText(text, index - 1), 50);
    } else {
      // Passer au texte suivant
      currentTextIndex = (currentTextIndex + 1) % texts.length;
      setTimeout(() => typeText(texts[currentTextIndex], 0), 500);
    }
  }

  // Démarrer l'animation avec le premier texte
  typeText(texts[currentTextIndex], 0);
});

// Variables principales
let hamburger_menu = document.querySelector(".hamburger-menu"),
  mobileMenu = document.querySelector(".mobile-menu"),
  links = mobileMenu.querySelectorAll("a");

// Fonction pour afficher/masquer le menu mobile
function toggleMobileMenu() {
  mobileMenu.classList.toggle("show");
  hamburger_menu.classList.toggle("clicked");
}

// Fonction pour gérer le loader
function hideLoader() {
  let loaderOverlay = document.querySelector(".load-overlay-container");
  if (loaderOverlay) {
    let animateCards = document.querySelectorAll(".animate-card");
    setTimeout(() => {
      setTimeout(() => {
        loaderOverlay.classList.add("moveUp");
        setTimeout(() => {
          loaderOverlay.style.display = "none";
          loaderOverlay.remove();
        }, 1000);
      }, 4000);

      let lineOverlays = document.querySelectorAll(".line-overlay");
      lineOverlays.forEach((overlay, index) => {
        setTimeout(() => {
          overlay.classList.add("remove");
          overlay.style.animationDelay = `${index + 1}00ms`;

          if (index === 8) {
            animateCards.forEach((card, cardIndex) => {
              setTimeout(() => {
                card.classList.add("zoom");
                setTimeout(() => card.remove(), 500);
              }, 100);
            });
          }

          setTimeout(() => overlay.remove(), 2000);
          setTimeout(() => {
            if (index === lineOverlays.length - 1) {
              let animationScript = document.getElementById("animation-loading-script");
              if (animationScript) {
                animationScript.remove();
                loaderOverlay.remove();
              }
            }
          }, 2000);
        }, 2000);
      });
    }, 500);
  }
}

// Gestion des événements
hamburger_menu.addEventListener("click", toggleMobileMenu);

links.forEach(link => {
  link.addEventListener("click", toggleMobileMenu);
});

// DOMContentLoaded
document.addEventListener("DOMContentLoaded", () => {
  hideLoader();

  // Gestion des réactions stockées
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

  // Gestion des animations
  function handleReactionClick(btnEl) {
    if (btnEl === dislikeIcon && !dislikeIcon.classList.contains('clicked')) {
      feedbackForm.classList.add('show');
    }

    btnEl.classList.add('clicked', 'animate');
    setTimeout(() => {
      btnEl.classList.remove('animate');
    }, 500);

    // Remove clicked classList from others
    reactionBtns.forEach(btn => {
      if (btn !== btnEl) {
        btn.classList.remove('clicked');
      }
    });
    localStorage.setItem('reaction', btnEl.classList[1]);
    const url = new URL(window.location.href);
    console.log('URL', url);

  }

  // Hide the feedback form when the user clicks anywhere outside of it
  feedbackForm.querySelector('.close').addEventListener('click', (event) => {
    // Prevent the event from propagating to the document
    event.stopPropagation();
    feedbackForm.classList.remove('show');
  });

  // Gestion du thème
  let themeToggleBtn = document.querySelector(".theme-toggle-btn"),
    theme = localStorage.getItem("theme"),
    body = document.body;

  if (theme === "dark") {
    body.classList.add("dark");
    ROOT_EL.classList.add("dark");
  } else {
    body.classList.remove("dark");
    ROOT_EL.classList.remove("dark");
  }
  themeToggleBtn.firstElementChild.classList.toggle("dark", theme !== "dark");

  // Focus sur les liens de travaux
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

// Curseur personnalisé
let customCursor = document.querySelector(".mouse-cursor");
document.addEventListener("mousemove", event => {
  const isTouchDevice = 'ontouchstart' in window ||
    navigator.maxTouchPoints > 0 ||
    window.matchMedia('(pointer: coarse)').matches;

  if (window.innerWidth > 700 && !isTouchDevice) {
    let cursorSize = { width: customCursor.offsetWidth, height: customCursor.offsetHeight };
    customCursor.style.left = `${event.clientX - cursorSize.width / 2}px`;
    customCursor.style.top = `${event.clientY - cursorSize.height / 2}px`;
  }
});

// Gestion du bouton "Lire plus sur moi"
// let readMoreAboutBtn = document.getElementById("read-more-about-me"),
//   aboutMeParagraph = document.getElementById("about-paragraph");


// function toggleText() {
//   aboutMeParagraph.classList.contains("less") ? (aboutMeParagraph.classList.remove("less"), readMoreAboutBtn.innerHTML = "Read less", aboutMeParagraph.innerHTML = `
//     <p class="full-text">
//       RAF, a talented self-taught web developer who embarked on his coding journey in 2016. Despite taking a
//       hiatus
//       between 2018 and 2022, his passion for programming and development has remained unwavering. Always on the
//       lookout for fresh challenges, RAF specializes in frontend development with a mastery of React JS.
//     </p>
//     <p class="full-text">
//       In the dynamic world of web development, RAF stands out as an individual who not only embraces challenges
//       but thrives on them. His journey showcases resilience and a continuous pursuit of excellence, evident in
//       his
//       commitment to honing his skills.
//     </p>
//     <p>
//       P.S : My initials, RAF, stand for Ramalandimanana Antso Fanasina.
//     </p>
//     <div class="source"></div>`) : (aboutMeParagraph.classList.add("less"), readMoreAboutBtn.innerHTML = "Read more", aboutMeParagraph.innerHTML = `
//     <p class="full-text">
//       RAF, a talented self-taught web developer who ...
//     </p>`)
// };
// DOMContentLoaded pour gérer les interactions après le chargement de la page
document.addEventListener("DOMContentLoaded", () => {
  // Bouton "Lire plus" : ajouter un gestionnaire d'événements
  // readMoreAboutBtn.addEventListener("click", toggleText);

  // Gestion du défilement dans les sections pour mettre à jour la navigation active
  let sections = document.querySelectorAll("section");
  let navLinks = document.querySelectorAll("nav .links a");
  let mainElement = document.querySelector("main");

  let lastActiveSession = "";

  mainElement.addEventListener("scroll", () => {
    let activeSection = "";

    // Identifier la section visible
    sections.forEach(section => {
      let top = section.offsetTop - 10;
      let bottom = top + section.clientHeight;
      if (mainElement.scrollTop >= top && mainElement.scrollTop < bottom) {
        activeSection = "#" + section.id;
        lastActiveSession = activeSection;
      }
    });

    // Mettre à jour l'état actif des liens
    navLinks.forEach(link => {
      link.classList.remove("active");
      if (link.getAttribute("href") === activeSection || link.getAttribute("data-scroll") === activeSection) {
        link.classList.add("active");
      }
    });

    activeSection !== lastActiveSession && perfomLazyLoading(activeSection);
  });
});

function perfomLazyLoading(selector) {
  let lazyImages = document.querySelectorAll(`${selector} img`);

  lazyImages.forEach((img) => {
    const dataSrc = img.getAttribute("data-img");
    dataSrc && (img.src = dataSrc);
    img.removeAttribute('data-img');
  });
}

// Gestion du formulaire de contact
let contactForm = document.getElementById("contact-form");
let sendBtn = document.getElementById("send-message-btn");
let fullnameInput = document.getElementById("fullname");
let emailInput = document.getElementById("email");
let messageInput = document.getElementById("message");
let popupDiv = document.querySelector(".popup-message");
let closePopupBtn = document.querySelector(".close-popup-btn");

// Fonction pour valider les champs
function checkMessageAndEmail() {
  let message = messageInput.value.trim();
  let email = emailInput.value;
  return message && email && message.length >= 6;
}

// Fonction pour afficher une popup
function showPopup(type) {
  popupDiv.classList.add(type);
  setTimeout(() => popupDiv.classList.remove(type), 2500);
}

// Fonction pour fermer une popup
function closePopup() {
  popupDiv.classList.remove("success", "error");
}

// Soumission du formulaire
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

// Bouton pour fermer la popup
closePopupBtn.addEventListener("click", closePopup);

// Configuration Swiper
const swiper = new Swiper('.swiper-container', {
  slidesPerView: 'auto',           // Affiche plusieurs slides
  spaceBetween: 15,                // Espacement entre les slides
  autoplay: {
    delay: 500,                      // Pas de délai entre les animations
    disableOnInteraction: false,   // Continue même après une interaction
  },
  freeMode: true,                  // Active le mode libre sans snap
  loop: true,                     // Désactive le bouclage automatique
  reverseDirection: true,
  pauseOnMouseEnter: true,
  speed: 2500,
});