<!doctype html>
<html lang=fr>

<head>
  <script>
    ! function(e, t, a, n, g) {
      e[n] = e[n] || [], e[n].push({
        "gtm.start": (new Date).getTime(),
        event: "gtm.js"
      });
      var m = t.getElementsByTagName(a)[0],
        r = t.createElement(a);
      r.async = !0, r.src = "https://www.googletagmanager.com/gtm.js?id=GTM-WJZZCZ58", m.parentNode.insertBefore(r, m)
    }(window, document, "script", "dataLayer")
  </script>
  <meta charset=UTF-8>
  <!-- <meta http-equiv=Cache-Control content="no-cache, no-store, must-revalidate"> -->
  <meta http-equiv="Cache-Control" content="max-age=31536000, public">
  <meta name=description content="RAF is an acronym for (initials of)  RAMALANDIMANANA Antso Fanasina, who is a Front-End Web Developer. Web development was always a passion for him because he is an autodidact">
  <meta name=keywords content="Web Developer, Developer, Madagascar, Freelance, Fullstack, English, Javascript Developper, Front-End Developer">
  <base href= />
  <meta name=viewport content="width=device-width,initial-scale=1">
  <script src=/scripts/checkUserPreferences.js async></script>
  <title>RAF | Web Developer</title>
  <link rel="shortcut icon" href=./images/favicon.png type=image/x-icon>
  <style id=scrollbar-style>
    ::-webkit-scrollbar-thumb {
      background-color: #0a1a52;
      border-radius: 20px
    }
  </style>
</head>

<body class=dark onload="">
  <div class=mouse-cursor aria-hidden=true></div>
  <div class=load-overlay-container aria-hidden=true>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
    <div class=line-overlay></div>
  </div>
  <script id=animation-loading-script>
    const lightblue = "#0077ff",
      darkblue = "#020083",
      loadingOverlay = document.querySelector(".load-overlay-container"),
      styleTag = document.createElement("style");
    document.head.appendChild(styleTag), generateCards(), createAnimation();
    const cards = document.querySelectorAll(".animate-card");

    function generateCards() {
      for (let n = 0; n <= 5; n++) {
        let a = 10 * n > 10 ? 10 * n - 5 : 10 * n;
        loadingOverlay.innerHTML += `\n            <div class="animate-card" style="animation:scaling 2s ${a}0ms 1 forwards;">\n            <p class="inside">...</p>\n            <p class="inside2">...</p>\n            </div>\n          `
      }
    }

    function createAnimation() {
      styleTag.innerHTML = `\n          @keyframes scaling{\n          0%{transform:translate(0);}\n          20%{transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});}\n          40%{transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});}\n          60%{\n            transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});\n            perspective:${1e3*Math.random()}px;\n          }\n          80%{transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});}\n          80%{transform:rotate(${sign()}${Math.round(10*randomNbr())}deg);}\n          }`
    }

    function sign() {
      return Math.ceil(10 * Math.random()) > 5 ? "" : "-"
    }

    function randomNbr() {
      return "" + 100 * Math.random()
    }

    function moveRandom() {
      return `${sign()}${Math.round(10*Math.random())+60}px`
    }
    cards[cards.length - 1].addEventListener("webkitAnimationEnd", (() => {
      cards.forEach((n => {
        n.style.animationName = "", setTimeout((() => {
          n.style.animationName = "scaling", createAnimation()
        }), 200)
      }))
    }))
  </script>
  <script>
    function hideLoaderX() {
      if (document.querySelector(".load-overlay-container")) {
        const e = document.querySelectorAll(".animate-card");
        setTimeout((() => {
          setTimeout((() => {
            loadingOverlay.classList.add("moveUp"), setTimeout((() => {
              loadingOverlay.style = "display:none;", loadingOverlay.remove()
            }), 1e3)
          }), 4e3);
          const t = document.querySelectorAll(".line-overlay");
          for (let o = 0; o < t.length; o++) setTimeout((() => {
            if (t[o].classList.add("remove"), t[o].style.animationDelay = `${o+1}00ms`, 8 == o)
              for (let t = 0; t < e.length; t++) setTimeout((() => {
                e[t].classList.add("zoom"), setTimeout((() => {
                  e[t].remove()
                }), 500)
              }), 100);
            setTimeout((() => {
              t[o].remove()
            }), 2e3), setTimeout((() => {
              if (o == t.length - 1) {
                const e = document.getElementById("animation-loading-script");
                e && (e.remove(), loadingOverlay.remove())
              }
            }), 2e3)
          }), 2e3)
        }), 500)
      }
    }
  </script>
  <div class=bottom-info></div>
  <?php require_once 'components/navbar.php'; ?>
  <main>
    <section class=hero id=home>
      <div class="mouse-container">
        <div class=mouse></div>
      </div>
      <div class=horizontal-line></div>
      <div class=left>
        <div class=rounded-border>
          <span class=square-form></span>
          <img src=./images/no_bg_avatar.webp class=profile-picture width=500 alt=Myself title=RAF>
          <script>
            const myImage = document.querySelector(".profile-picture");
            if (myImage.addEventListener("load", hideLoaderX), myImage.complete) {
              document.querySelector(".load-overlay-container") && hideLoaderX()
            }
          </script>
        </div>
      </div>
      <div class=right>
        <div class=intro-text translate=no>
          <h1>Hello, I'm RA<span class=f-letter>F</span>.</h1>
          <div class=post-text aria-hidden=true>
            <div class=line-container>
              <span class=line></span> I'm
            </div>
            <div class=effect-wrapper>
              <p id=text class=js-changing-paragraph translate=no>
              </p>
              <div class=default-value style=display:none>a Front-End Developer</div>
              <p></p>
            </div>
          </div>
        </div>
        <div class=cta>
          <a href=#contact-section class="item hire">
            <div class="icon partner"></div>
            <div class=text>Hire me</div>
          </a>
          <a href=#about-me-section class="item resume">
            <span class="icon download"></span>
            <span class=text>About me</span>
          </a>
        </div>
      </div>
    </section>
    <section class=about-me id=about-me-section>
      <h2 class=whois>Who is RAF ?</h2>
      <div class=text id=about-paragraph>
        <p class=full-text>
          RAF, a talented self-taught web developer who embarked on his coding journey in 2016. Despite taking a hiatus between 2018 and 2022, his passion for programming and development has remained unwavering. Always on the lookout for fresh challenges, RAF specializes in frontend development with a mastery of React JS.
        </p>
        <p class=full-text>
          In the dynamic world of web development, RAF stands out as an individual who not only embraces challenges but thrives on them. His journey showcases resilience and a continuous pursuit of excellence, evident in his commitment to honing his skills.
        </p>
        <p>
          P.S : My initials, RAF, stand for Ramalandimanana Antso Fanasina.
        </p>
        <div class=source>--- *** ---</div>
      </div>
      <div class=btn-container>
        <div class=more-less-btn id=read-more-about-me>Read less</div>
      </div>
    </section>
    <section class=why-us id=why-us-section>
      <h2>Why Choose to Work with RAF ?</h2>
      <div class=text>
        <div class=round></div>
        <p>There are six main reasons :</p>
      </div>
      <div class=container>
        <div class="item item1" data-aos=fade-in>
          <h3>
            <div class="icon code"></div>
            Technical Proficiency
          </h3>
          <p class=text>
            Crafting seamless code and mastering cutting-edge technologies to bring your digital vision to life.
          </p>
        </div>
        <div class="item item2" data-aos=fade-right>
          <h3>
            <div class="icon comments"></div>
            Clear Communication
          </h3>
          <p class=text>
            Articulating complex technical concepts with clarity, ensuring a shared understanding for successful project collaboration.
          </p>
        </div>
        <div class="item item3" data-aos=fade-left>
          <h3>
            <div class="icon brush"></div>
            Design Sense
          </h3>
          <p class=text>
            Infusing creativity into every pixel, ensuring visually stunning and user-centric design that captivates and engages.
          </p>
        </div>
        <div class="item item4">
          <h3>
            <div class="icon clock"></div>
            Responsiveness
          </h3>
          <p class=text>
            Swiftly adapting to client needs, maintaining open channels for real-time feedback, and ensuring project agility.
          </p>
        </div>
        <div class="item item5">
          <h3>
            <div class="icon lightbulb"></div>
            Proactivity
          </h3>
          <p class=text>
            Anticipating challenges, providing solutions before they arise, and taking initiative to enhance project outcomes.
          </p>
        </div>
        <div class="item item6">
          <h3>
            <div class="icon shield"></div>
            Professional Ethics
          </h3>
          <p class=text>
            Adhering to the highest standards of integrity, confidentiality, and transparency in every aspect of project execution.
          </p>
        </div>
        <div class="box other-reasons">
          <div class=text>
            <div class=round></div>
            <p> Other reasons that may be interesting : </p>
          </div>
          <div class=scrolling-content>
            <div class="overlay left"></div>
            <div class="overlay right"></div>
            <div class="element element1">
              <div class="icon mobile"></div>
              <div class=text>Mobile-friendy Design</div>
            </div>
            <div class="element element2">
              <div class="icon rocket"></div>
              <div class=text>Performance Optimization</div>
            </div>
            <div class="element element3">
              <div class="icon phone-pc-link"></div>
              <div class=text>Responsive Design</div>
            </div>
            <div class="element element4">
              <div class="icon structure"></div>
              <div class=text>Well Structured Codes and Folders</div>
            </div>
            <div class="element element4">
              <div class="icon search-engin"></div>
              <div class=text>SEO Optimization</div>
            </div>
            <div class="element element5">
              <div class="icon bug"></div>
              <div class=text>Test and debugging</div>
            </div>
            <div class="element element6">
              <div class="icon users"></div>
              <div class=text>User-Centered Design</div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id=skills-section class=my-skills>
      <h2> Want to know My Skills ?</h2>
      <div class=intro-text>
        <div class=round></div>
        <p>
          Let's take a look at a part of my arsenal of cutting-edge Development and Design Tools...
        </p>
      </div>
      <div class=skills-container>
        <?php require_once('scripts/skills.php'); ?>
      </div>
    </section>
    <section id=works-section class=my-works>
      <h2>What Kind of Work Can I Do ?</h2>
      <div class=text>
        <div class=round></div>
        <p>Here you can find some projects that I worked on...</p>
      </div>
      <div class=works-container>
        <?php require_once('scripts/works.php'); ?>
      </div>
    </section>
    <section class=contact-me id=contact-section>
      <h2>Write something to me here</h2>
      <div class=text>
        <div class=round></div>
        <p>You just have to write your email address and directly send your message...</p>
      </div>
      <div class=wrapper>
        <div class=left>
          <div class=popup-message>
            <p class=popup-content id=popup-content>This is a test popup message</p>
            <div class=close-popup-btn>&times;</div>
            <div class=loader></div>
          </div>
          <form id=contact-form>
            <label for=fullname class=name>Fullname or Organization name</label>
            <input id=fullname required aria-required=true placeholder="e.g : Rakoto Doe or RakotoBrand.org" class=name>
            <label for=email>E-mail</label>
            <input type=email required aria-required=true autocomplete=off id=email placeholder="e.g : rakoto@example.com">
            <label for=message>Message</label>
            <textarea id=message required aria-required=true placeholder="Write your message here..."></textarea>
            <div class=g-captcha></div>
            <button id=send-message-btn>
              <div class="icon send"></div> Send
            </button>
          </form>
        </div>
        <div class=right>
          <div class=container>
            <h3>How do you find my portfolio ?</h3>
            <div class=reactions>
              <div class="icon love"></div>
              <div class="icon like"></div>
              <div class="icon dislike"></div>
            </div>
          </div>
          <div class=tell-me-why>
            <div class=close>❌</div>
            <h3>Tell me Why ?</h3>
            <textarea id=feedback-message placeholder="e.g : It's very hard to use for me."></textarea>
            <button>Send feedback <span class=angry-emoji> 😇</span></button>
          </div>
        </div>
      </div>
    </section>
    <section class=socials>
      <div class=text>
        <div class=round></div>
        <p>Or contact me at one of the social networks below</p>
      </div>
    </section>
    <footer>
      <div class=copyright>
        <div class=text>© &nbsp;<span class=year>
            <?php echo date("Y"); ?>
          </span> &nbsp; RAF</div>
      </div>
      <div class=container>
        <div class=footer-section>
          <img src=./images/raf_logo_white.png alt="RAF Logo" width=50>
          <div class=quote>
            "Great results comes along with a great work."
          </div>
        </div>
        <div class="footer-section middle">
          <div class=item>
            <div class="icon location"></div>
            <div class=text>Madagascar</div>
          </div>
          <a href=tel:+261344970553 class="item phone" target=_blank>
            <div class="icon phone"></div>
            <div class=text>+261344970553</div>
          </a>
        </div>
        <div class=footer-section>
          <a href=https://https://www.linkedin.com/in/fanasina-ramalandimanana-75110a236/ class=item target=_blank>
            <div class="icon linkedin"></div>
            <div class=text>Fanasina Ramalandimanana</div>
          </a>
          <a href=https://join.skype.com/invite/J4LXJ8KvFWf6 class=item target=_blank>
            <div class="icon skype"></div>
            <div class=text>Fanasina Ramalandimanana</div>
          </a>
          <a href=https://github.com/PsychoticHaha class="item github" target=_blank>
            <div class="icon github"></div>
            <div class=text>My Github</div>
          </a>
          <a href=mailto:hope.fanasina2@gmail.com class="item gmail" target=_blank>
            <div class="icon gmail"></div>
            <div class=text>hope.fanasina2@gmail.com</div>
          </a>
        </div>
      </div>
    </footer>
  </main>
  <link rel=stylesheet href=./stylesheets/All-style.css>
  <script src=./scripts/index.js type=module></script>
</body>

</html>