@php($title = $section['title'] ?? null)
@php($content = $section['content'] ?? '')

<x-section :title="$title">
  <div class="prose prose-lg mx-auto w-full max-w-3xl text-left">
    {!! $content !!}
  </div>
</x-section>
