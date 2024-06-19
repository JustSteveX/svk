@props(['active'])

@php
  $classes =
      $active ?? false
          ? 'font-ubuntu-sans font-bold text-2xl px-6 inline-flex items-center px-1 border-b-2 border-accent text-primary
focus:outline-none focus:border-accent-900 transition duration-150 ease-in-out'
          : 'font-ubuntu-sans text-2xl px-6 inline-flex items-center px-1 border-b-2 border-accent-50 text-accent-50
hover:text-primary hover:border-gray-300 focus:outline-none transition
duration-150 ease-in-out font-bold text-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
