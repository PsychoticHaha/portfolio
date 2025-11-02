<footer>
    <div class=copyright>
        <div class=text>© &nbsp;<span class=year>
                <?php echo date("Y"); ?>
            </span> &nbsp; RAF</div>
    </div>
    <div class=container>
        <div class=footer-section>
            <img src="./images/raf_logo_white.png" data-img="/images/raf_logo_white.png" alt="RAF Logo" width=50>
            <div class=quote>
                "<?= htmlspecialchars(t('footer.quote'), ENT_QUOTES, 'UTF-8'); ?>"
            </div>
        </div>
        <div class="footer-section middle">
            <div class=item>
                <div class="icon location"></div>
                <div class=text><?= htmlspecialchars(t('footer.location'), ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <a href=tel:+261344970553 class="item phone" target=_blank>
                <div class="icon phone"></div>
                <div class=text><?= htmlspecialchars(t('footer.phone'), ENT_QUOTES, 'UTF-8'); ?></div>
            </a>
        </div>
        <div class=footer-section>
            <a href=https://https://www.linkedin.com/in/fanasina-ramalandimanana-75110a236/ class=item target=_blank>
                <div class="icon linkedin"></div>
                <div class=text><?= htmlspecialchars(t('footer.linkedin'), ENT_QUOTES, 'UTF-8'); ?></div>
            </a>
            <a href=https://join.skype.com/invite/J4LXJ8KvFWf6 class=item target=_blank>
                <div class="icon skype"></div>
                <div class=text><?= htmlspecialchars(t('footer.skype'), ENT_QUOTES, 'UTF-8'); ?></div>
            </a>
            <a href=https://github.com/PsychoticHaha class="item github" target=_blank>
                <div class="icon github"></div>
                <div class=text><?= htmlspecialchars(t('footer.github'), ENT_QUOTES, 'UTF-8'); ?></div>
            </a>
            <a href=mailto:hope.fanasina2@gmail.com class="item gmail" target=_blank>
                <div class="icon gmail"></div>
                <div class=text>hope.fanasina2@gmail.com</div>
            </a>
        </div>
    </div>
</footer>
