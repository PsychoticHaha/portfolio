<section class=hero id=home>
    <div class="section-wrapper">
        <div class="content-container">
            <div class=left>
                <div class=rounded-border>
                    <span class=square-form></span>
                    <img src="./images/no_bg_avatar.webp" data-img="/images/no_bg_avatar.webp" class="profile-picture cursor-set" width="500" alt="<?= htmlspecialchars(t('hero.imageAlt'), ENT_QUOTES, 'UTF-8'); ?>" title="Fanasina (R.A.F.)">
                    <script>
                        const myImage = document.querySelector(".profile-picture");
                        if (myImage.addEventListener("load", hideLoader), myImage.complete) {
                            document.querySelector(".load-overlay-container") && hideLoader();
                        }
                    </script>
                </div>
            </div>
            <div class=right>
                <div class="content">
                    <div class=intro-text translate=no>
                        <h1>
                            <span class="small"><?= htmlspecialchars(t('hero.greetingSmall'), ENT_QUOTES, 'UTF-8'); ?></span><!-- <br> -->
                            <span class="big"><?= htmlspecialchars(t('hero.greetingPrefix'), ENT_QUOTES, 'UTF-8'); ?> <span class=f-letter>F</span>anasina
                                <img src="/images/wave.png" data-img="/images/wave.png" width="50" alt="waving hand image">
                            </span>
                        </h1>
                    </div>
                    <div class=post-text aria-hidden=true>
                        <div class=line-container>
                            <span class=line></span>
                            <span><?= htmlspecialchars(t('hero.linePrefix'), ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <div class=effect-wrapper>
                            <p id=text class=js-changing-paragraph translate=no>
                            </p>
                            <div class=default-value style=display:none><?= htmlspecialchars(t('hero.defaultRole'), ENT_QUOTES, 'UTF-8'); ?></div>
                            <p></p>
                        </div>
                    </div>
                    <div class=cta>
                        <a href=#about-me-section class="item cursor-set resume">
                            <span class="icon download"></span>
                            <span class=text><?= htmlspecialchars(t('hero.cta'), ENT_QUOTES, 'UTF-8'); ?></span>
                        </a>
                    </div>
<!--                     <div class="hero-socials" aria-label="Social media links">
                        <a class="cursor-set" href="https://www.linkedin.com/in/fanasina-ramalandimanana-75110a236/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <span class="icon linkedin"></span>
                            <span class="label">LinkedIn</span>
                        </a>
                        <a class="cursor-set" href="https://github.com/PsychoticHaha" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                            <span class="icon github"></span>
                            <span class="label">GitHub</span>
                        </a>
                        <a class="cursor-set" href="mailto:hope.fanasina2@gmail.com" aria-label="Email">
                            <span class="icon gmail"></span>
                            <span class="label">Gmail</span>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="mouse-container cursor-set">
        <div class="mouse"></div>
    </div>
</section>
<?php require_once 'separator-line.php' ?>
