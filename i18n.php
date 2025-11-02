<?php

$availableLanguages = [
    'en' => 'English',
    'fr' => 'Français',
];

$defaultLanguage = 'en';

$requestedLanguage = strtolower($_GET['lang'] ?? $_COOKIE['lang'] ?? $defaultLanguage);
$currentLanguage = array_key_exists($requestedLanguage, $availableLanguages) ? $requestedLanguage : $defaultLanguage;

if (!headers_sent()) {
    setcookie('lang', $currentLanguage, time() + (365 * 24 * 60 * 60), '/', '', isset($_SERVER['HTTPS']), true);
}

$translations = [
    'en' => [
        'meta' => [
            'title' => 'RAF | Web Developer',
            'description' => 'RAF stands for RAMALANDIMANANA Antso Fanasina, a front-end focused full-stack developer passionate about crafting tailored digital experiences.',
            'keywords' => 'Web Developer, Developer, Madagascar, Freelance, Fullstack, English, JavaScript Developer, Front-End Developer',
        ],
        'language' => [
            'label' => 'Language',
            'en' => 'EN',
            'fr' => 'FR',
        ],
        'nav' => [
            'home' => 'Home',
            'about' => 'About',
            'skills' => 'Skills',
            'works' => 'Works',
            'contact' => 'Contact',
            'themeToggleTitle' => 'Switch between light mode and dark mode',
            'darkModeOn' => 'Dark mode is on',
            'lightModeOn' => 'Light mode is on',
        ],
        'hero' => [
            'greetingSmall' => 'Hello,',
            'greetingPrefix' => "I'm",
            'imageAlt' => 'Portrait of Fanasina',
            'cta' => 'More about me',
            'linePrefix' => "I'm",
            'defaultRole' => 'a Front-End Developer',
            'roles' => [
                'an Expert Front-End Developer',
                'a UI/UX Designer',
                'a Professional Web Integrator',
                'a React.js / Next.js Developer',
                'a WordPress Developer',
            ],
            'socialPrompt' => 'Or contact me on one of the social networks below',
        ],
        'about' => [
            'title' => 'Who am I?',
            'paragraph' => "I am a self-taught web developer who began my coding journey in 2016. With almost four years of professional experience, I have successfully completed over thirty projects, ranging from personal initiatives to impactful contributions for businesses.\n\nThroughout my career, I have demonstrated an exceptional ability to adapt and innovate, always pushing the boundaries of frontend development with a strong focus on React. My dedication and hands-on approach have sharpened my technical expertise and earned me a reputation as a reliable and creative problem solver.\n\nIn the ever-evolving world of web development, my journey exemplifies resilience, passion, and a relentless drive to deliver excellence.",
            'ps' => 'P.S.: My initials, RAF, stand for Ramalandimanana Antso Fanasina.',
            'imageAlt' => 'Illustration representing who I am',
        ],
        'why' => [
            'title' => 'Why Choose to Work with Fanasina?',
            'intro' => 'There are six main reasons:',
            'items' => [
                [
                    'title' => 'Technical Proficiency',
                    'description' => 'Crafting seamless code and mastering cutting-edge technologies to bring your digital vision to life.',
                ],
                [
                    'title' => 'Clear Communication',
                    'description' => 'Articulating complex technical concepts with clarity, ensuring a shared understanding for successful collaboration.',
                ],
                [
                    'title' => 'Design Sense',
                    'description' => 'Infusing creativity into every pixel, ensuring visually stunning and user-centric design that captivates and engages.',
                ],
                [
                    'title' => 'Responsiveness',
                    'description' => 'Swiftly adapting to client needs, maintaining open channels for real-time feedback, and ensuring project agility.',
                ],
                [
                    'title' => 'Proactivity',
                    'description' => 'Anticipating challenges, providing solutions before they arise, and taking initiative to enhance project outcomes.',
                ],
                [
                    'title' => 'Professional Ethics',
                    'description' => 'Adhering to the highest standards of integrity, confidentiality, and transparency in every aspect of project execution.',
                ],
            ],
            'otherReasonsTitle' => 'Other reasons that are also interesting:',
            'slides' => [
                'Mobile-friendly Design',
                'Performance Optimization',
                'Responsive Design',
                'Well-Structured Codebase',
                'SEO Optimization',
                'Testing and Debugging',
                'User-Centered Design',
            ],
        ],
        'skills' => [
            'title' => 'Want to discover my skills?',
            'intro' => "Let's take a look at part of my cutting-edge development and design toolkit...",
            'categories' => [
                'markup' => 'Markup Languages and Preprocessors',
                'programming' => 'Programming Languages',
                'dbms' => 'Database Management Systems (DBMS)',
                'cms' => 'Content Management Systems (CMS)',
                'frameworks' => 'Frameworks and Libraries',
                'tools' => 'Development Tools',
                'design' => 'Design Tools',
                'packages' => 'Package Managers',
            ],
        ],
        'works' => [
            'title' => 'What Kind of Work Can I Do?',
            'intro' => 'Here you can find a selection of projects I have worked on...',
            'links' => [
                'about' => 'About',
                'aboutTitle' => 'About this project',
                'code' => 'Code',
                'codeTitle' => 'See on GitHub',
                'demo' => 'Demo',
                'demoTitle' => 'See project',
            ],
        ],
        'contact' => [
            'title' => 'Write something to me here',
            'intro' => 'Simply add your email address and send your message right away...',
            'form' => [
                'fullnameLabel' => 'Full name or organization',
                'fullnamePlaceholder' => 'e.g. Rakoto Doe or RakotoBrand.org',
                'emailLabel' => 'E-mail',
                'emailPlaceholder' => 'e.g. rakoto@example.com',
                'messageLabel' => 'Message',
                'messagePlaceholder' => 'Write your message here...',
                'send' => 'Send',
                'recaptchaMissing' => 'Google reCAPTCHA is not configured yet.',
            ],
            'reactions' => [
                'title' => 'Do you find my portfolio great?',
                'feedbackTitle' => 'Can you tell me why, please?',
                'feedbackPlaceholder' => "e.g. It’s a bit difficult for me to read some texts.",
                'feedbackSend' => 'Send feedback',
            ],
        ],
        'footer' => [
            'quote' => 'Great results come along with great work.',
            'location' => 'Madagascar',
            'phone' => '+261344970553',
            'linkedin' => 'Fanasina Ramalandimanana',
            'skype' => 'Fanasina Ramalandimanana',
            'github' => 'My GitHub',
        ],
        'socials' => [
            'prompt' => 'Or contact me on one of the social networks below',
        ],
        'js' => [
            'formInvalid' => 'Please provide a valid email and a message with at least 6 characters.',
            'thanksMessage' => 'Thanks for your message!',
            'formError' => 'Sorry, I could not send your message. Please try again later.',
            'verificationUnavailable' => 'Verification service is unavailable. Please reload the page.',
            'verificationFailed' => 'Verification failed. Please try again.',
            'feedbackPrompt' => 'Please tell me a little bit more so I can improve.',
            'feedbackThanks' => 'Thanks for the feedback!',
            'feedbackError' => 'Unable to save your feedback right now.',
            'reactionError' => 'Unable to save your reaction.',
        ],
    ],
    'fr' => [
        'meta' => [
            'title' => 'RAF | Développeur Web',
            'description' => "RAF signifie RAMALANDIMANANA Antso Fanasina, un développeur full-stack à dominante front-end passionné par la création d'expériences numériques sur mesure.",
            'keywords' => 'Développeur Web, Développeur, Madagascar, Freelance, Fullstack, Français, Développeur JavaScript, Développeur Front-End',
        ],
        'language' => [
            'label' => 'Langue',
            'en' => 'EN',
            'fr' => 'FR',
        ],
        'nav' => [
            'home' => 'Accueil',
            'about' => 'À propos',
            'skills' => 'Compétences',
            'works' => 'Projets',
            'contact' => 'Contact',
            'themeToggleTitle' => 'Basculer entre le mode clair et le mode sombre',
            'darkModeOn' => 'Le mode sombre est activé',
            'lightModeOn' => 'Le mode clair est activé',
        ],
        'hero' => [
            'greetingSmall' => 'Bonjour,',
            'greetingPrefix' => 'Je suis',
            'imageAlt' => 'Portrait de Fanasina',
            'cta' => 'En savoir plus sur moi',
            'linePrefix' => 'Je suis',
            'defaultRole' => 'développeur Front-End',
            'roles' => [
                'un développeur Front-End expert',
                'un Designer UI/UX',
                'un Intégrateur Web professionnel',
                'un développeur React.js / Next.js',
                'un développeur WordPress',
            ],
            'socialPrompt' => 'Ou contactez-moi sur l’un des réseaux sociaux ci-dessous',
        ],
        'about' => [
            'title' => 'Qui suis-je ?',
            'paragraph' => "Je suis un développeur web autodidacte qui a commencé son parcours en 2016. Fort de presque quatre années d'expérience professionnelle, j'ai mené à bien plus d'une trentaine de projets, allant d'initiatives personnelles à des contributions à fort impact pour des entreprises.\n\nTout au long de ma carrière, j'ai démontré une capacité exceptionnelle à m'adapter et à innover, en repoussant sans cesse les limites du développement front-end avec un fort accent sur React. Mon implication et mon approche pragmatique ont affûté mon expertise technique et m'ont valu la réputation d'un solveur de problèmes fiable et créatif.\n\nDans l'univers en constante évolution du développement web, mon parcours incarne la résilience, la passion et une volonté incessante de livrer l'excellence.",
            'ps' => 'P.-S. : Mes initiales, RAF, signifient Ramalandimanana Antso Fanasina.',
            'imageAlt' => "Illustration représentant qui je suis",
        ],
        'why' => [
            'title' => 'Pourquoi travailler avec Fanasina ?',
            'intro' => 'Il y a six raisons principales :',
            'items' => [
                [
                    'title' => 'Maîtrise technique',
                    'description' => 'Un code soigné et des technologies de pointe pour donner vie à votre vision digitale.',
                ],
                [
                    'title' => 'Communication claire',
                    'description' => 'Des concepts techniques expliqués avec clarté pour assurer une collaboration fluide.',
                ],
                [
                    'title' => 'Sens du design',
                    'description' => 'Chaque pixel est pensé pour offrir une expérience visuelle séduisante et centrée utilisateur.',
                ],
                [
                    'title' => 'Réactivité',
                    'description' => 'Une adaptation rapide aux besoins, des échanges continus et une agilité assurée.',
                ],
                [
                    'title' => 'Proactivité',
                    'description' => 'Anticiper les défis, proposer des solutions et prendre les devants pour faire progresser vos projets.',
                ],
                [
                    'title' => 'Éthique professionnelle',
                    'description' => 'Respect des standards les plus élevés en termes d’intégrité, de confidentialité et de transparence.',
                ],
            ],
            'otherReasonsTitle' => 'D’autres raisons tout aussi intéressantes :',
            'slides' => [
                'Design adapté au mobile',
                'Optimisation des performances',
                'Design responsive',
                'Code et structure bien organisés',
                'Optimisation SEO',
                'Tests et débogage',
                'Design centré utilisateur',
            ],
        ],
        'skills' => [
            'title' => 'Envie de découvrir mes compétences ?',
            'intro' => "Découvrons une partie de mon arsenal d’outils de développement et de design...",
            'categories' => [
                'markup' => 'Langages de balisage et préprocesseurs',
                'programming' => 'Langages de programmation',
                'dbms' => 'Systèmes de gestion de bases de données (SGBD)',
                'cms' => 'Systèmes de gestion de contenu (CMS)',
                'frameworks' => 'Frameworks et bibliothèques',
                'tools' => 'Outils de développement',
                'design' => 'Outils de design',
                'packages' => 'Gestionnaires de packages',
            ],
        ],
        'works' => [
            'title' => 'Quels types de projets puis-je réaliser ?',
            'intro' => 'Voici une sélection de projets sur lesquels j’ai travaillé...',
            'links' => [
                'about' => 'Détails',
                'aboutTitle' => 'À propos de ce projet',
                'code' => 'Code',
                'codeTitle' => 'Voir sur GitHub',
                'demo' => 'Démo',
                'demoTitle' => 'Voir le projet',
            ],
        ],
        'contact' => [
            'title' => 'Écrivez-moi ici',
            'intro' => 'Indiquez votre adresse e-mail et envoyez votre message en toute simplicité...',
            'form' => [
                'fullnameLabel' => 'Nom complet ou organisation',
                'fullnamePlaceholder' => 'ex. Rakoto Doe ou RakotoBrand.org',
                'emailLabel' => 'E-mail',
                'emailPlaceholder' => 'ex. rakoto@example.com',
                'messageLabel' => 'Message',
                'messagePlaceholder' => 'Écrivez votre message ici...',
                'send' => 'Envoyer',
                'recaptchaMissing' => "Google reCAPTCHA n'est pas encore configuré.",
            ],
            'reactions' => [
                'title' => 'Vous trouvez mon portfolio super ?',
                'feedbackTitle' => 'Pouvez-vous me dire pourquoi ?',
                'feedbackPlaceholder' => 'ex. Certains textes sont un peu difficiles à lire.',
                'feedbackSend' => 'Envoyer un feedback',
            ],
        ],
        'footer' => [
            'quote' => 'De grands résultats naissent d’un travail remarquable.',
            'location' => 'Madagascar',
            'phone' => '+261344970553',
            'linkedin' => 'Fanasina Ramalandimanana',
            'skype' => 'Fanasina Ramalandimanana',
            'github' => 'Mon GitHub',
        ],
        'socials' => [
            'prompt' => 'Ou contactez-moi sur l’un des réseaux sociaux ci-dessous',
        ],
        'js' => [
            'formInvalid' => "Veuillez fournir un e-mail valide et un message d'au moins 6 caractères.",
            'thanksMessage' => 'Merci pour votre message !',
            'formError' => "Désolé, votre message n'a pas pu être envoyé. Veuillez réessayer plus tard.",
            'verificationUnavailable' => 'Le service de vérification est indisponible. Veuillez recharger la page.',
            'verificationFailed' => 'La vérification a échoué. Veuillez réessayer.',
            'feedbackPrompt' => 'Merci de me donner un peu plus de détails pour que je puisse m’améliorer.',
            'feedbackThanks' => 'Merci pour votre retour !',
            'feedbackError' => "Impossible d’enregistrer votre feedback pour le moment.",
            'reactionError' => 'Impossible de sauvegarder votre réaction.',
        ],
    ],
];

/**
 * Retrieve a translation by key for the current language.
 */
function t(string $key, $default = null)
{
    global $translations, $currentLanguage, $defaultLanguage;

    $value = getTranslationValue($translations[$currentLanguage] ?? [], $key);

    if ($value === null && $currentLanguage !== $defaultLanguage) {
        $value = getTranslationValue($translations[$defaultLanguage] ?? [], $key);
    }

    if ($value === null) {
        return $default ?? $key;
    }

    return $value;
}

function getTranslationValue(array $translations, string $key)
{
    $segments = explode('.', $key);
    $value = $translations;

    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return null;
        }
        $value = $value[$segment];
    }

    return $value;
}

function buildLanguageUrl(string $language): string
{
    $path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
    $query = $_GET;
    $query['lang'] = $language;
    return $path . '?' . http_build_query($query);
}

function getClientTranslations(): array
{
    return [
        'lang' => $GLOBALS['currentLanguage'],
        'heroRoles' => t('hero.roles'),
        'heroDefaultRole' => t('hero.defaultRole'),
        'heroLinePrefix' => t('hero.linePrefix'),
        'messages' => [
            'formInvalid' => t('js.formInvalid'),
            'thanksMessage' => t('js.thanksMessage'),
            'formError' => t('js.formError'),
            'verificationUnavailable' => t('js.verificationUnavailable'),
            'verificationFailed' => t('js.verificationFailed'),
            'feedbackPrompt' => t('js.feedbackPrompt'),
            'feedbackThanks' => t('js.feedbackThanks'),
            'feedbackError' => t('js.feedbackError'),
            'reactionError' => t('js.reactionError'),
        ],
    ];
}

