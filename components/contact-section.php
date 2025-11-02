<?php
$recaptchaSiteKey = defined('RECAPTCHA_SITEKEY') ? RECAPTCHA_SITEKEY : (getenv('RECAPTCHA_SITEKEY') ?? '');
?>

<section class=contact-me id=contact-section>
  <div class="section-wrapper">
    <h2><?= htmlspecialchars(t('contact.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
    <div class=text>
      <div class=round></div>
      <p><?= htmlspecialchars(t('contact.intro'), ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
    <div class=wrapper>
      <div class=left>
        <div class=popup-message aria-live="polite">
          <p class=popup-content id=popup-content><?= htmlspecialchars(t('js.formInvalid'), ENT_QUOTES, 'UTF-8'); ?></p>
          <div class=close-popup-btn>&times;</div>
          <div class=loader></div>
        </div>
        <form id=contact-form <?= $recaptchaSiteKey ? 'data-recaptcha-sitekey="' . htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
          <label for="fullname" class="name"><?= htmlspecialchars(t('contact.form.fullnameLabel'), ENT_QUOTES, 'UTF-8'); ?></label>
          <input id="fullname" required aria-required="true" placeholder="<?= htmlspecialchars(t('contact.form.fullnamePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" class="name cursor-set">
          <label for="email"><?= htmlspecialchars(t('contact.form.emailLabel'), ENT_QUOTES, 'UTF-8'); ?></label>
          <input class="cursor-set" type="email" required aria-required="true" autocomplete="off" id="email"
            placeholder="<?= htmlspecialchars(t('contact.form.emailPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>">
          <label for=message><?= htmlspecialchars(t('contact.form.messageLabel'), ENT_QUOTES, 'UTF-8'); ?></label>
          <textarea id="message" class=" cursor-set" required aria-required="true" placeholder="<?= htmlspecialchars(t('contact.form.messagePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"></textarea>
          <input type="hidden" name="g-recaptcha-response" id="recaptcha-token">
          <?php if ($recaptchaSiteKey) : ?>
            <div class="recaptcha-container" aria-live="polite"></div>
          <?php else : ?>
            <p class="recaptcha-missing" role="status">
              <?= htmlspecialchars(t('contact.form.recaptchaMissing'), ENT_QUOTES, 'UTF-8'); ?>
            </p>
          <?php endif; ?>
          <button id=send-message-btn class="cursor-set" type="submit">
            <div class="icon send"></div> <?= htmlspecialchars(t('contact.form.send'), ENT_QUOTES, 'UTF-8'); ?>
          </button>
        </form>
      </div>
      <div class=right>
        <div class=container>
          <h3><?= htmlspecialchars(t('contact.reactions.title'), ENT_QUOTES, 'UTF-8'); ?></h3>
          <div class=reactions>
            <div class="item">
              <div class="icon cursor-set love" data-reaction="love">
                <?php require_once('svg/heart.php') ?>
              </div>
              <div class="nbr" data-reaction-count="love">--%</div>
            </div>
            <div class="item">
              <div class="icon cursor-set like" data-reaction="like">
                <?php require_once('svg/like.php') ?>
              </div>
              <div class="nbr" data-reaction-count="like">--%</div>
            </div>
            <div class="item">
              <div class="icon cursor-set dislike" data-reaction="dislike">
                <?php require_once('svg/dislike.php') ?>
              </div>
              <div class="nbr" data-reaction-count="dislike">--%</div>
            </div>
          </div>
        </div>
        <div class="popup-wrapper">
          <div class=tell-me-why>
            <div class=close>❌</div>
            <h3><?= htmlspecialchars(t('contact.reactions.feedbackTitle'), ENT_QUOTES, 'UTF-8'); ?></h3>
            <textarea id=feedback-message placeholder="<?= htmlspecialchars(t('contact.reactions.feedbackPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"></textarea>
            <button type="button" id="send-feedback-btn"><?= htmlspecialchars(t('contact.reactions.feedbackSend'), ENT_QUOTES, 'UTF-8'); ?> <span class=angry-emoji> 😇</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if ($recaptchaSiteKey) : ?>
  <script src="https://www.google.com/recaptcha/api.js?render=<?= htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>" async defer></script>
<?php endif; ?>
