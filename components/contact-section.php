<section class=contact-me id=contact-section>
  <div class="section-wrapper">
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
          <input type=email required aria-required=true autocomplete=off id=email
            placeholder="e.g : rakoto@example.com">
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
          <h3>Do you find my portfolio great ?</h3>
          <div class=reactions>
            <div class="item">
              <div class="icon love">
                <?php require_once('svg/heart.php') ?>
              </div>
              <div class="nbr">100%</div>
            </div>
            <div class="item">
              <div class="icon like">
                <?php require_once('svg/like.php') ?>
              </div>
              <div class="item">70% - 50%</div>
            </div>
            <div class="item">
              <div class="icon dislike">
                <?php require_once('svg/dislike.php') ?>
              </div>
              <div class="item">50% - 0%</div>
            </div>
          </div>
        </div>
        <div class="popup-wrapper">
          <div class=tell-me-why>
            <div class=close>❌</div>
            <h3>Can you tell me why, please ?</h3>
            <textarea id=feedback-message placeholder="e.g : It's very hard to for me to read texts inside."></textarea>
            <button>Send feedback <span class=angry-emoji> 😇</span></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
