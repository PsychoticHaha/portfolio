<section class=hero id=home>
    <div class="section-wrapper">
        <div class="content-container">
            <div class=left>
                <div class=rounded-border>
                    <span class=square-form></span>
                    <img src="./images/no_bg_avatar.webp" data-img="/images/no_bg_avatar.webp" class="profile-picture cursor-set" width="500" alt="Myself" title="Fanasina (R.A.F.)">
                    <script>
                        const myImage = document.querySelector(".profile-picture");
                        if (myImage.addEventListener("load", hideLoaderX), myImage.complete) {
                            document.querySelector(".load-overlay-container") && hideLoaderX()
                        }
                    </script>
                </div>
            </div>
            <div class=right>
                <div class="content">
                    <div class=intro-text translate=no>
                        <h1>
                            <span class="small">Hello, </span><!-- <br> -->
                            <span class="big"> I'm <span class=f-letter>F</span>anasina
                                <img src="/images/wave.png" data-img="/images/wave.png" width="50" alt="waving hand image">
                            </span>
                        </h1>
                    </div>
                    <div class=post-text aria-hidden=true>
                        <div class=line-container>
                            <span class=line></span>
                            <span>I'm</span>
                        </div>
                        <div class=effect-wrapper>
                            <p id=text class=js-changing-paragraph translate=no>
                            </p>
                            <div class=default-value style=display:none>a Front-End Developer</div>
                            <p></p>
                        </div>
                    </div>
                    <div class=cta>
                        <a href=#about-me-section class="item cursor-set resume">
                            <span class="icon download"></span>
                            <span class=text>More about me</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mouse-container cursor-set">
        <div class="mouse"></div>
    </div>
</section>
<?php require_once 'separator-line.php' ?>
