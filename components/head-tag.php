<?php
$clientTranslations = getClientTranslations();

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$requestPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
$canonicalUrl = rtrim($scheme . '://' . $host . $requestPath, '/') ?: $scheme . '://' . $host;

if ($requestPath !== '/' && substr($canonicalUrl, -strlen($requestPath)) !== $requestPath) {
    $canonicalUrl .= $requestPath;
}

global $availableLanguages, $currentLanguage;
$alternateUrls = [];
foreach ($availableLanguages as $code => $label) {
    $alternatePath = buildLanguageUrl($code);
    $alternateUrls[$code] = htmlspecialchars($scheme . '://' . $host . $alternatePath, ENT_QUOTES, 'UTF-8');
}

$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => 'RAMALANDIMANANA Antso Fanasina',
    'givenName' => 'Antso Fanasina',
    'familyName' => 'RAMALANDIMANANA',
    'jobTitle' => 'Full-Stack Developer',
    'url' => $canonicalUrl,
    'sameAs' => [
        'https://www.linkedin.com/in/fanasina-ramalandimanana-48a743144/',
        'https://github.com/PsychoticHaha'
    ],
    'knowsAbout' => ['Web Development', 'Front-End', 'React', 'Next.js', 'Laravel', 'PHP'],
    'worksFor' => [
        [
            '@type' => 'Organization',
            'name' => 'Freelance'
        ]
    ]
];
?>
<head>
    <script>
        ! function (e, t, a, n, g) {
            e[n] = e[n] || [], e[n].push({
                "gtm.start": (new Date).getTime(),
                event: "gtm.js"
            });
            var m = t.getElementsByTagName(a)[0],
                r = t.createElement(a);
            r.async = !0, r.src = "https://www.googletagmanager.com/gtm.js?id=GTM-WJZZCZ58", m.parentNode.insertBefore(r, m)
        }(window, document, "script", "dataLayer")
    </script>
    <meta charset="UTF-8">
    <!-- <meta http-equiv=Cache-Control content="no-cache, no-store, must-revalidate"> -->
    <meta http-equiv="Cache-Control" content="max-age=31536000, public">
    <meta name="description" content="<?= htmlspecialchars(t('meta.description'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?= htmlspecialchars(t('meta.keywords'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="RAMALANDIMANANA Antso Fanasina">
    <meta name="theme-color" content="#070119">
    <base href="/" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars(t('meta.title'), ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <?php foreach ($alternateUrls as $langCode => $url) : ?>
      <link rel="alternate" hreflang="<?= htmlspecialchars($langCode, ENT_QUOTES, 'UTF-8'); ?>" href="<?= $url; ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($alternateUrls[$currentLanguage] ?? $canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= htmlspecialchars(str_replace('_', '-', $currentLanguage === 'fr' ? 'fr_FR' : 'en_US'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="RAF Portfolio">
    <meta property="og:title" content="<?= htmlspecialchars(t('meta.title'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars(t('meta.description'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= htmlspecialchars($scheme . '://' . $host . '/images/no_bg_avatar.webp', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars(t('meta.title'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars(t('meta.description'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($scheme . '://' . $host . '/images/no_bg_avatar.webp', ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./stylesheets/style.css">
    <script type="text/javascript">
        window.APP_LANG = <?= json_encode($currentLanguage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        window.APP_I18N = <?= json_encode($clientTranslations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    </script>
    <script type="application/ld+json">
        <?= json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
</head>
