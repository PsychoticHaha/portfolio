<section id=works-section class=my-works>
    <div class="section-wrapper">
        <h2><?= htmlspecialchars(t('works.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
        <div class=text>
            <div class=round></div>
            <p><?= htmlspecialchars(t('works.intro'), ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class=works-container>
            <?php require_once('scripts/works.php'); ?>
        </div>
    </div>
</section>
