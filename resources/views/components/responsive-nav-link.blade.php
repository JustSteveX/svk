@props(['active'])

@php
  $classes = $active ?? false ? 'block pl-3 pr-4 py-2 border-l-4 border-accent text-base font-medium text-accent transition duration-150 ease-in-out hover:text-primary hover:bg-accent-900' : 'hover:bg-accent-900 hover:text-primary block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
