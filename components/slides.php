<?php
$slideIcons = [
    'mobile',
    'rocket',
    'phone-pc-link',
    'structure',
    'search-engin',
    'bug',
    'users',
];
$slides = t('why.slides');
$slides = is_array($slides) ? $slides : [];

foreach ($slides as $index => $label) :
    $icon = $slideIcons[$index] ?? 'mobile';
    $elementClass = 'element' . ($index + 1);
?>
<div class="element cursor-set swiper-slide <?= htmlspecialchars($elementClass, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="icon <?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8'); ?>"></div>
    <div class=text><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></div>
</div>
<?php endforeach; ?>
