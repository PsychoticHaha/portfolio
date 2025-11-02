<section class=why-us id=why-us-section>
  <?php $whyItems = t('why.items');
  $whyItems = is_array($whyItems) ? $whyItems : [];
  ?>
  <div class="section-wrapper">
    <h2><?= htmlspecialchars(t('why.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
    <div class=text>
      <div class=round></div>
      <p><?= htmlspecialchars(t('why.intro'), ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
    <div class=container>
      <div class="left-items items-container">
        <div class="item cursor-set item1" data-aos=fade-in>
          <h3>
            <div class="icon code"></div>
            <?= htmlspecialchars($whyItems[0]['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </h3>
          <p class=text>
            <?= htmlspecialchars($whyItems[0]['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
        <div class="item cursor-set item3" data-aos=fade-left>
          <h3>
            <div class="icon brush"></div>
            <?= htmlspecialchars($whyItems[2]['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </h3>
          <p class=text>
            <?= htmlspecialchars($whyItems[2]['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
        <div class="item cursor-set item4">
          <h3>
            <div class="icon clock"></div>
            <?= htmlspecialchars($whyItems[3]['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </h3>
          <p class=text>
            <?= htmlspecialchars($whyItems[3]['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
      </div>
      <div class="right-items items-container">
        <div class="item cursor-set item2" data-aos=fade-right>
          <h3>
            <div class="icon comments"></div>
            <?= htmlspecialchars($whyItems[1]['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </h3>
          <p class=text>
            <?= htmlspecialchars($whyItems[1]['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
        <div class="item cursor-set item5">
          <h3>
            <div class="icon lightbulb"></div>
            <?= htmlspecialchars($whyItems[4]['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </h3>
          <p class=text>
            <?= htmlspecialchars($whyItems[4]['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
        <div class="item cursor-set item6">
          <h3>
            <div class="icon shield"></div>
            <?= htmlspecialchars($whyItems[5]['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </h3>
          <p class=text>
            <?= htmlspecialchars($whyItems[5]['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="box other-reasons">
    <div class="section-wrapper">
      <div class=text>
        <div class=round></div>
        <p> <?= htmlspecialchars(t('why.otherReasonsTitle'), ENT_QUOTES, 'UTF-8'); ?> </p>
      </div>
    </div>
    <div class="scrolling-content swiper-container">
      <div class="overlay left"></div>
      <div class="overlay right"></div>
      <div class="wrapper swiper-wrapper">
        <?php require('slides.php') ?>
        <?php require('slides.php') ?>
      </div>
    </div>
  </div>
</section>
