@php($heading = $section['heading'] ?? null)
@php($body = $section['body'] ?? null)
@php($cta = $section['cta'] ?? null)

<x-section background="bg-indigo-700">
  <div class="mx-auto max-w-3xl text-center text-white">
    @if ($heading)
      <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">
        {{ $heading }}
      </h2>
    @endif

    @if ($body)
      <p class="mt-4 text-lg text-indigo-100">
        {{ $body }}
      </p>
    @endif

    @if ($cta && ! empty($cta['url']))
      <a
        href="{{ $cta['url'] }}"
        target="{{ $cta['target'] ?? '_self' }}"
        class="mt-8 inline-flex rounded-full bg-white px-6 py-2.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100"
      >
        {{ $cta['title'] ?? __('Learn more', 'psychotix') }}
      </a>
    @endif
  </div>
</x-section>
