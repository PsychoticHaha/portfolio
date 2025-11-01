{{
    /*
    Template Name: Psychotix Landing
    */
}}

@extends('layouts.app')

@section('content')
  @isset($hero)
    <x-hero
      :eyebrow="$hero['eyebrow'] ?? null"
      :headline="$hero['headline']"
      :subheadline="$hero['subheadline'] ?? null"
      :actions="$hero['hero_actions'] ?? []"
      :media="$hero['media'] ?? null"
      class="bg-gradient-to-b from-surface/5 via-white to-white"
    />
  @endisset

  @if (! empty($sections))
    @foreach ($sections as $section)
      @includeIf('sections.' . $section['acf_fc_layout'], [
          'section' => $section,
      ])
    @endforeach
  @endif
@endsection
