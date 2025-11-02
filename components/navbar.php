<?php
global $availableLanguages, $currentLanguage;
?>
<div class="header-container">
  <header class="header">
    <a href="#" data-scroll-target="#home" class="logo-link" tabindex="-999" aria-hidden='true'>
      <div class="logo"></div>
    </a>
    <nav class="desktop-menu">
      <div class="links">
        <a href="#" data-scroll-target="#home" class="link"><?= htmlspecialchars(t('nav.home'), ENT_QUOTES, 'UTF-8'); ?></a>
        <a href="#" data-scroll-target="#about-me-section" class="link"><?= htmlspecialchars(t('nav.about'), ENT_QUOTES, 'UTF-8'); ?></a>
        <a href="#" data-scroll-target="#skills-section" class="link"><?= htmlspecialchars(t('nav.skills'), ENT_QUOTES, 'UTF-8'); ?></a>
        <a href="#" data-scroll-target="#works-section" class="link"><?= htmlspecialchars(t('nav.works'), ENT_QUOTES, 'UTF-8'); ?></a>
        <a href="#" data-scroll-target="#contact-section" class="link"><?= htmlspecialchars(t('nav.contact'), ENT_QUOTES, 'UTF-8'); ?></a>
      </div>
    </nav>
    <div class="right">
      <div class="language-switcher desktop-only" role="group"
        aria-label="<?= htmlspecialchars(t('language.label'), ENT_QUOTES, 'UTF-8'); ?>">
        <?php foreach ($availableLanguages as $code => $label): ?>
          <a href="<?= htmlspecialchars(buildLanguageUrl($code), ENT_QUOTES, 'UTF-8'); ?>"
            class="lang-option<?= $currentLanguage === $code ? ' active' : ''; ?>"
            lang="<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?>">
            <span class="flag flag-<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></span>
            <?= htmlspecialchars(t('language.' . $code), ENT_QUOTES, 'UTF-8'); ?>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="theme-toggle-btn" title="<?= htmlspecialchars(t('nav.themeToggleTitle'), ENT_QUOTES, 'UTF-8'); ?>">
        <div class="icons-container">
          <div class="light" title="<?= htmlspecialchars(t('nav.darkModeOn'), ENT_QUOTES, 'UTF-8'); ?>">
            <svg class="svg moon" width="80%" height="80%" viewBox="0 0 24 24" fill="#e8e8e8"
              xmlns="http://www.w3.org/2000/svg" stroke="#e8e8e8" stroke-width="0.00024000000000000003">
              <g id="SVGRepo_bgCrrier" stroke-width="0"></g>
              <g id="SVRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconarrier">
                <path
                  d="M19.9001 2.30719C19.7392 1.8976 19.1616 1.8976 19.0007 2.30719L18.5703 3.40247C18.5212 3.52752 18.4226 3.62651 18.298 3.67583L17.2067 4.1078C16.7986 4.26934 16.7986 4.849 17.2067 5.01054L18.298 5.44252C18.4226 5.49184 18.5212 5.59082 18.5703 5.71587L19.0007 6.81115C19.1616 7.22074 19.7392 7.22074 19.9001 6.81116L20.3305 5.71587C20.3796 5.59082 20.4782 5.49184 20.6028 5.44252L21.6941 5.01054C22.1022 4.849 22.1022 4.26934 21.6941 4.1078L20.6028 3.67583C20.4782 3.62651 20.3796 3.52752 20.3305 3.40247L19.9001 2.30719Z"
                  fill="#e8e8e8"></path>
                <path
                  d="M16.0328 8.12967C15.8718 7.72009 15.2943 7.72009 15.1333 8.12967L14.9764 8.52902C14.9273 8.65407 14.8287 8.75305 14.7041 8.80237L14.3062 8.95987C13.8981 9.12141 13.8981 9.70107 14.3062 9.86261L14.7041 10.0201C14.8287 10.0694 14.9273 10.1684 14.9764 10.2935L15.1333 10.6928C15.2943 11.1024 15.8718 11.1024 16.0328 10.6928L16.1897 10.2935C16.2388 10.1684 16.3374 10.0694 16.462 10.0201L16.8599 9.86261C17.268 9.70107 17.268 9.12141 16.8599 8.95987L16.462 8.80237C16.3374 8.75305 16.2388 8.65407 16.1897 8.52902L16.0328 8.12967Z"
                  fill="#e8e8e8"></path>
                <path opacity="9"
                  d="M12 22C17.5228 22 22 17.5228 22 12C22 11.5373 21.3065 11.4608 21.0672 11.8568C19.9289 13.7406 17.8615 15 15.5 15C11.9101 15 9 12.0899 9 8.5C9 6.13845 10.2594 4.07105 12.1432 2.93276C12.5392 2.69347 12.4627 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                  fill="#e8e8e8"></path>
              </g>
            </svg>
          </div>
          <div class="dark" title="<?= htmlspecialchars(t('nav.lightModeOn'), ENT_QUOTES, 'UTF-8'); ?>">
            <svg class="svg sun" width="80%" height="80%" viewBox="0 0 24 24" fill="#e8e8e8"
              xmlns="http://www.w3.org/2000/svg" stroke="#e8e8e8" stroke-width="0.00024000000000000003">
              <g id="SVGepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCrrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRpo_iconCarrier">
                <path
                  d="M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z"
                  fill="#e8e8e8"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M12 1.25C12.4142 1.25 12.75 1.58579 12.75 2V4C12.75 4.41421 12.4142 4.75 12 4.75C11.5858 4.75 11.25 4.41421 11.25 4V2C11.25 1.58579 11.5858 1.25 12 1.25ZM1.25 12C1.25 11.5858 1.58579 11.25 2 11.25H4C4.41421 11.25 4.75 11.5858 4.75 12C4.75 12.4142 4.41421 12.75 4 12.75H2C1.58579 12.75 1.25 12.4142 1.25 12ZM19.25 12C19.25 11.5858 19.5858 11.25 20 11.25H22C22.4142 11.25 22.75 11.5858 22.75 12C22.75 12.4142 22.4142 12.75 22 12.75H20C19.5858 12.75 19.25 12.4142 19.25 12ZM12 19.25C12.4142 19.25 12.75 19.5858 12.75 20V22C12.75 22.4142 12.4142 22.75 12 22.75C11.5858 22.75 11.25 22.4142 11.25 22V20C11.25 19.5858 11.5858 19.25 12 19.25Z"
                  fill="#e8e8e8"></path>
                <g opacity="0.5">
                  <path
                    d="M3.66919 3.7156C3.94869 3.4099 4.42309 3.38867 4.72879 3.66817L6.95081 5.69975C7.25651 5.97925 7.27774 6.45365 6.99824 6.75935C6.71874 7.06505 6.24434 7.08629 5.93865 6.80679L3.71663 4.7752C3.41093 4.4957 3.38969 4.0213 3.66919 3.7156Z"
                    fill="#e8e8e8"></path>
                  <path
                    d="M20.3319 3.7156C20.6114 4.0213 20.5902 4.4957 20.2845 4.7752L18.0624 6.80679C17.7567 7.08629 17.2823 7.06505 17.0028 6.75935C16.7233 6.45365 16.7446 5.97925 17.0503 5.69975L19.2723 3.66817C19.578 3.38867 20.0524 3.4099 20.3319 3.7156Z"
                    fill="#e8e8e8"></path>
                  <path
                    d="M17.0261 17.0247C17.319 16.7318 17.7938 16.7319 18.0867 17.0248L20.3087 19.2471C20.6016 19.54 20.6016 20.0148 20.3087 20.3077C20.0158 20.6006 19.5409 20.6006 19.248 20.3076L17.026 18.0854C16.7331 17.7924 16.7332 17.3176 17.0261 17.0247Z"
                    fill="#e8e8e8"></path>
                  <path
                    d="M6.97521 17.0249C7.2681 17.3177 7.2681 17.7926 6.97521 18.0855L4.75299 20.3077C4.46009 20.6006 3.98522 20.6006 3.69233 20.3077C3.39943 20.0148 3.39943 19.54 3.69233 19.2471L5.91455 17.0248C6.20744 16.732 6.68232 16.732 6.97521 17.0249Z"
                    fill="#e8e8e8"></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
      </div>
      <div class="hamburger-menu">
        <div class="top bar"></div>
        <div class="middle bar"></div>
        <div class="bottom bar"></div>
      </div>
    </div>
  </header>
</div>
<div class="mobile-menu">
  <div class="mobile-menu-inner">
    <div class="mobile-language-switcher" role="group"
      aria-label="<?= htmlspecialchars(t('language.label'), ENT_QUOTES, 'UTF-8'); ?>">
      <svg class="globe" fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" version="1.1"
        aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M32.032 16c0-8.501-6.677-15.472-15.072-15.969-0.173-0.019-0.346-0.032-0.523-0.032-0.052 0-0.104 0.005-0.156 0.007-0.093-0.002-0.186-0.007-0.281-0.007-8.84 0-16.032 7.178-16.032 16.001s7.192 16.001 16.032 16.001c0.094 0 0.188-0.006 0.281-0.008 0.052 0.002 0.104 0.008 0.156 0.008 0.176 0 0.349-0.012 0.523-0.032 8.395-0.497 15.072-7.468 15.072-15.969zM29.049 21.151c-0.551-0.16-1.935-0.507-4.377-0.794 0.202-1.381 0.313-2.84 0.313-4.357 0-1.196-0.069-2.354-0.197-3.469 3.094-0.37 4.45-0.835 4.54-0.867l-0.372-1.050c0.695 1.659 1.080 3.478 1.080 5.386 0 1.818-0.352 3.555-0.987 5.151zM8.921 16c0-1.119 0.074-2.212 0.21-3.263 1.621 0.127 3.561 0.222 5.839 0.243v6.939c-2.219 0.021-4.114 0.111-5.709 0.234-0.22-1.319-0.34-2.715-0.34-4.154zM16.967 2.132c2.452 0.711 4.552 4.115 5.492 8.628-1.512 0.12-3.332 0.209-5.492 0.229v-8.857zM14.971 2.156v8.832c-2.136-0.021-3.965-0.109-5.502-0.226 0.96-4.457 3.076-7.836 5.502-8.606zM14.971 21.913l0 7.929c-2.263-0.718-4.256-3.705-5.293-7.719 1.492-0.11 3.253-0.189 5.292-0.21zM16.967 29.868l-0-7.955c2.061 0.020 3.814 0.102 5.288 0.217-1.019 4.067-3 7.076-5.288 7.738zM16.967 19.92l0-6.939c2.291-0.021 4.218-0.118 5.818-0.25 0.131 1.053 0.203 2.147 0.203 3.268 0 1.442-0.116 2.84-0.329 4.16-1.575-0.128-3.462-0.219-5.692-0.24zM28.588 9.81c-0.302 0.094-1.564 0.453-4.094 0.751-0.564-2.998-1.584-5.561-2.91-7.412 3.048 1.325 5.535 3.697 7.005 6.661zM11.213 2.831c-1.632 1.873-2.963 4.568-3.691 7.754-2.265-0.245-3.623-0.534-4.166-0.665 1.585-3.27 4.407-5.836 7.856-7.088zM2.614 11.787c0.385 0.104 1.841 0.467 4.549 0.766-0.155 1.107-0.24 2.26-0.24 3.447 0 1.509 0.136 2.96 0.383 4.334-2.325 0.251-3.755 0.552-4.396 0.706-0.607-1.566-0.944-3.264-0.944-5.041 0-1.467 0.228-2.883 0.649-4.213zM3.784 22.886c0.727-0.154 2.029-0.39 3.956-0.591 0.759 2.803 1.993 5.175 3.473 6.874-3.16-1.148-5.79-3.398-7.429-6.282v0zM21.583 28.849c1.195-1.665 2.14-3.907 2.728-6.525 1.982 0.227 3.226 0.494 3.853 0.652-1.5 2.596-3.808 4.669-6.581 5.873z">
        </path>
      </svg>
      <?php foreach ($availableLanguages as $code => $label): ?>
        <a href="<?= htmlspecialchars(buildLanguageUrl($code), ENT_QUOTES, 'UTF-8'); ?>"
          class="lang-option<?= $currentLanguage === $code ? ' active' : ''; ?>"
          lang="<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?>">
          <span class="flag flag-<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></span>
          <?= htmlspecialchars(t('language.' . $code), ENT_QUOTES, 'UTF-8'); ?>
        </a>
      <?php endforeach; ?>
    </div>
    <nav class="links-container" aria-label="Main navigation">
      <a href="#" data-scroll-target="#home" class="link">
        <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-5h-4v5H5a1 1 0 0 1-1-1v-9.5Z" />
        </svg>
        <span class="label"><?= htmlspecialchars(t('nav.home'), ENT_QUOTES, 'UTF-8'); ?></span>
      </a>
      <a href="#" data-scroll-target="#about-me-section" class="link">
        <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm-8 8a8 8 0 0 1 16 0Z" />
        </svg>
        <span class="label"><?= htmlspecialchars(t('nav.about'), ENT_QUOTES, 'UTF-8'); ?></span>
      </a>
      <a href="#" data-scroll-target="#skills-section" class="link">
        <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M4 4h6v6H4Zm0 10h6v6H4Zm10-10h6v6h-6Zm0 10h6v6h-6Z" />
        </svg>
        <span class="label"><?= htmlspecialchars(t('nav.skills'), ENT_QUOTES, 'UTF-8'); ?></span>
      </a>
      <a href="#" data-scroll-target="#works-section" class="link">
        <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path
            d="M9 3h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 1 1v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a1 1 0 0 1 1-1h3V5a2 2 0 0 1 2-2Zm6 3V5H9v1h6Z" />
        </svg>
        <span class="label"><?= htmlspecialchars(t('nav.works'), ENT_QUOTES, 'UTF-8'); ?></span>
      </a>
      <a href="#" data-scroll-target="#contact-section" class="link">
        <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
          <path
            d="M20 4H4a2 2 0 0 0-2 2v.511l10 6.25 10-6.25V6a2 2 0 0 0-2-2Zm0 4.489-9 5.624a1 1 0 0 1-1 0L1.999 8.489V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2Z" />
        </svg>
        <span class="label"><?= htmlspecialchars(t('nav.contact'), ENT_QUOTES, 'UTF-8'); ?></span>
      </a>
    </nav>
  </div>
</div>
