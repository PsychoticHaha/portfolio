@props([
    'title' => null,
    'lead' => null,
    'background' => 'bg-white',
])

<section {{ $attributes->merge(['class' => $background]) }}>
  <div class="container mx-auto max-w-5xl space-y-6 py-16">
    @if ($title)
      <div class="space-y-3 text-center">
        <h2 class="text-3xl font-semibold text-neutral-900 sm:text-4xl">
          {{ $title }}
        </h2>

        @if ($lead)
          <p class="text-lg text-muted-foreground">
            {{ $lead }}
          </p>
        @endif
      </div>
    @endif

    <div class="grid gap-8">
      {{ $slot }}
    </div>
  </div>
</section>
