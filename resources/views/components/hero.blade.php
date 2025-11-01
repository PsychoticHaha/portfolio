@props([
    'eyebrow' => null,
    'headline',
    'subheadline' => null,
    'actions' => [],
    'media' => null,
])

<section {{ $attributes->merge(['class' => 'relative overflow-hidden']) }}>
  <div class="container mx-auto grid gap-12 py-20 lg:grid-cols-2 lg:items-center">
    <div class="space-y-6">
      @if ($eyebrow)
        <p class="uppercase tracking-[0.2em] text-sm font-semibold text-primary-500">
          {{ $eyebrow }}
        </p>
      @endif

      <h1 class="text-4xl font-bold tracking-tight text-surface sm:text-5xl">
        {{ $headline }}
      </h1>

      @if ($subheadline)
        <p class="text-lg text-muted-foreground max-w-xl">
          {{ $subheadline }}
        </p>
      @endif

      @if (! empty($actions))
        <div class="flex flex-wrap gap-3">
          @foreach ($actions as $action)
            @php($style = $action['style'] ?? 'primary')
            <a
              class="@class([
                'inline-flex items-center rounded-full px-5 py-2.5 text-sm font-semibold transition',
                'bg-primary-500 text-white hover:bg-primary-600' => $style === 'primary',
                'border border-primary-500 text-primary-500 hover:bg-primary-50' => $style === 'secondary',
                'border border-transparent text-muted-foreground hover:text-primary-600' => $style === 'ghost',
              ])"
              href="{{ $action['url'] ?? '#' }}"
              target="{{ $action['target'] ?? '_self' }}"
              rel="noopener">
              {{ $action['label'] ?? 'Learn more' }}
            </a>
          @endforeach
        </div>
      @endif
    </div>

    @if ($media)
      <div class="relative">
        <div class="aspect-video overflow-hidden rounded-3xl border border-surface/20 bg-surface shadow-lg">
          <img
            class="h-full w-full object-cover"
            src="{{ $media['url'] ?? null }}"
            alt="{{ $media['alt'] ?? '' }}"
            loading="lazy">
        </div>
      </div>
    @endif
  </div>
</section>
