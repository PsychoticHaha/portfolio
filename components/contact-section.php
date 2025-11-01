<?php
$recaptchaSiteKey = defined('RECAPTCHA_SITEKEY') ? RECAPTCHA_SITEKEY : (getenv('RECAPTCHA_SITEKEY') ?? '');
?>

<section class=contact-me id=contact-section>
  <div class="section-wrapper">
    <h2>Write something to me here</h2>
    <div class=text>
      <div class=round></div>
      <p>You just have to write your email address and directly send your message...</p>
    </div>
    <div class=wrapper>
      <div class=left>
        <div class=popup-message aria-live="polite">
          <p class=popup-content id=popup-content>This is a test popup message</p>
          <div class=close-popup-btn>&times;</div>
          <div class=loader></div>
        </div>
        <form id=contact-form <?= $recaptchaSiteKey ? 'data-recaptcha-sitekey="' . htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
          <label for="fullname" class="name">Fullname or Organization name</label>
          <input id="fullname" required aria-required="true" placeholder="e.g : Rakoto Doe or RakotoBrand.org" class="name cursor-set">
          <label for="email">E-mail</label>
          <input class="cursor-set" type="email" required aria-required="true" autocomplete="off" id="email"
            placeholder="e.g : rakoto@example.com">
          <label for=message>Message</label>
          <textarea id="message" class=" cursor-set" required aria-required="true" placeholder="Write your message here..."></textarea>
          <input type="hidden" name="g-recaptcha-response" id="recaptcha-token">
          <?php if ($recaptchaSiteKey) : ?>
            <div class="recaptcha-container" aria-live="polite"></div>
          <?php else : ?>
            <p class="recaptcha-missing" role="status">
              Google reCAPTCHA is not configured yet.
            </p>
          <?php endif; ?>
          <button id=send-message-btn class="cursor-set" type="submit">
            <div class="icon send"></div> Send
          </button>
        </form>
      </div>
      <div class=right>
        <div class=container>
          <h3>Do you find my portfolio great ?</h3>
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
            <h3>Can you tell me why, please ?</h3>
            <textarea id=feedback-message placeholder="e.g : It's very hard to for me to read texts inside."></textarea>
            <button type="button" id="send-feedback-btn">Send feedback <span class=angry-emoji> 😇</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if ($recaptchaSiteKey) : ?>
  <script src="https://www.google.com/recaptcha/api.js?render=<?= htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>" async defer></script>
<?php endif; ?>
