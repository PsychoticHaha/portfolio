@props([
    'eyebrow' => null,
    'headline',
    'subheadline' => null,
    'actions' => [],
    'media' => null,
])

<section {{ $attributes->merge(['class' => 'relative overflow-hidden bg-white']) }}>
  <div class="container grid gap-12 py-20 lg:grid-cols-2 lg:items-center">
    <div class="space-y-6">
      @if ($eyebrow)
        <p class="uppercase tracking-[0.2em] text-sm font-semibold text-indigo-600">
          {{ $eyebrow }}
        </p>
      @endif

      <h1 class="text-4xl font-bold tracking-tight text-neutral-900 sm:text-5xl">
        {{ $headline }}
      </h1>

      @if ($subheadline)
        <p class="text-lg text-neutral-500 max-w-xl">
          {{ $subheadline }}
        </p>
      @endif

      @if (! empty($actions))
        <div class="flex flex-wrap gap-3">
          @foreach ($actions as $action)
            @php($style = $action['style'] ?? 'primary')
            <a
              class="inline-flex items-center rounded-full px-5 py-2.5 text-sm font-semibold transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              @class([
                'bg-indigo-600 text-white hover:bg-indigo-700' => $style === 'primary',
                'border border-indigo-600 text-indigo-600 hover:bg-indigo-50' => $style === 'secondary',
                'border border-transparent text-neutral-500 hover:text-indigo-700' => $style === 'ghost',
              ])
              href="{{ $action['url'] ?? '#' }}"
              target="{{ $action['target'] ?? '_self' }}"
              rel="noopener"
            >
              {{ $action['label'] ?? __('Learn more', 'psychotix') }}
            </a>
          @endforeach
        </div>
      @endif
    </div>

    @if ($media)
      <div class="relative">
        <div class="aspect-video overflow-hidden rounded-3xl border border-neutral-900/10 bg-white shadow-lg">
          <img
            class="h-full w-full object-cover"
            src="{{ $media['url'] ?? null }}"
            alt="{{ $media['alt'] ?? '' }}"
            loading="lazy"
          >
        </div>
      </div>
    @endif
  </div>
</section>
