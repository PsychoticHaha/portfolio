<section id=skills-section class=my-skills>
    <div class="section-wrapper">
        <h2><?= htmlspecialchars(t('skills.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
        <div class=intro-text>
            <div class=round></div>
            <p>
                <?= htmlspecialchars(t('skills.intro'), ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
        <div class=skills-container>
            <?php require_once('scripts/skills.php'); ?>
        </div>
    </div>
</section>
