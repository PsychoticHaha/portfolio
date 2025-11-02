<section class="about-me-section" id=about-me-section>
  <div class="section-wrapper whoami">
    <div class="left-content">
      <h2 class="whois"><?= htmlspecialchars(t('about.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
      <div class="text " id="about-paragraph">
        <p class="full-text">
          <?= nl2br(htmlspecialchars(t('about.paragraph'), ENT_QUOTES, 'UTF-8')); ?>
        </p>
        <p>
          <?= htmlspecialchars(t('about.ps'), ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <div class=source></div>
      </div>
    </div>
    <div class="right-content">
      <img src="/images/who-am-i.webp" data-img="/images/who-am-i.webp" alt="<?= htmlspecialchars(t('about.imageAlt'), ENT_QUOTES, 'UTF-8'); ?>">
    </div>
  </div>
</section>
<?php require 'separator-line.php' ?>
