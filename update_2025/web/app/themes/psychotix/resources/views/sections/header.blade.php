<header class="sticky top-0 z-50 border-b border-neutral-900/10 bg-white/90 backdrop-blur">
  <div class="container mx-auto flex items-center justify-between gap-6 py-4">
    <a class="text-xl font-semibold tracking-tight text-neutral-900" href="{{ home_url('/') }}">
      {!! $siteName !!}
    </a>

    <button
      class="inline-flex items-center rounded-full border border-neutral-900/20 px-4 py-2 text-sm font-semibold text-neutral-900 shadow-sm transition hover:border-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 lg:hidden"
      type="button"
      data-toggle-nav
      data-target="#mobile-nav"
      aria-expanded="false"
      aria-controls="mobile-nav"
    >
      {{ __('Menu', 'psychotix') }}
    </button>

    @if (has_nav_menu('primary_navigation'))
      <nav
        id="desktop-nav"
        class="hidden items-center gap-6 text-sm font-medium text-neutral-500 lg:flex"
        aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}"
      >
        {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'flex items-center gap-6',
            'container' => false,
            'echo' => false,
            'fallback_cb' => false,
        ]) !!}
      </nav>
    @endif
  </div>

  @if (has_nav_menu('primary_navigation'))
    <nav
      id="mobile-nav"
      class="container mx-auto hidden flex-col gap-4 pb-6 text-base font-medium text-neutral-900 lg:hidden"
      aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}"
    >
      {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'flex flex-col gap-3',
          'container' => false,
          'echo' => false,
          'fallback_cb' => false,
      ]) !!}
    </nav>
  @endif
</header>
