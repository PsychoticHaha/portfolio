<footer class="border-t border-neutral-900/10 bg-neutral-50">
  <div class="container mx-auto flex flex-col gap-6 py-10 text-sm text-neutral-500 md:flex-row md:items-center md:justify-between">
    <div>
      <p class="font-medium text-neutral-900">{!! $siteName !!}</p>
      <p class="mt-1">&copy; {{ gmdate('Y') }} {{ __('All rights reserved.', 'psychotix') }}</p>
    </div>

    <div class="flex flex-wrap gap-4">
      @php(dynamic_sidebar('sidebar-footer'))
    </div>
  </div>
</footer>
