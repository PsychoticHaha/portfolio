@php($columns = $section['columns'] ?? [])

@if (! empty($columns))
  <x-section>
    <div class="grid gap-6 md:grid-cols-{{ min(3, count($columns)) }}">
      @foreach ($columns as $column)
        <article class="rounded-3xl border border-neutral-900/10 bg-white p-6 shadow-sm">
          @if (! empty($column['heading']))
            <h3 class="text-xl font-semibold text-neutral-900">
              {{ $column['heading'] }}
            </h3>
          @endif

          @if (! empty($column['body']))
            <p class="mt-3 text-base text-muted-foreground">
              {{ $column['body'] }}
            </p>
          @endif
        </article>
      @endforeach
    </div>
  </x-section>
@endif
