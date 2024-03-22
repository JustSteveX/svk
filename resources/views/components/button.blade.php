<button
  {{ $attributes->merge([
      'type' => 'submit',
      'class' => 'block items-center px-4 bg-black border-none h-auto
            min-h-[3rem]
            box-border
            font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700
            active:bg-gray-900 focus:outline-none focus:ring-0disabled:opacity-25 transition ease-in-out duration-150',
  ]) }}>
  {{ $slot }}
</button>
