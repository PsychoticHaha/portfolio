<section class=hero id=home>
    <div class="section-wrapper">
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
                <h1>
                    <span class="small">Hello, </span><br>
                    <span class="big"> I'm <span class=f-letter>F</span>anasina R.</span>
                </h1>
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
        <div class="mouse-container">
            <div class="mouse"></div>
        </div>
    </div>
</section>
<?php require_once 'separator-line.php' ?>