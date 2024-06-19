<button
  {{ $attributes->merge([
      'type' => 'submit',
      'class' => 'block items-center px-2 md:px-4 bg-accent border-none h-auto min-h-[3rem] box-border font-semibold text-sm text-accent-50 uppercase tracking-widest hover:bg-accent-700 active:bg-gray-900 focus:outline-none focus:ring-0 disabled:opacity-25 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>
