<button
  {{ $attributes->merge(['type' => 'reset', 'class' => 'inline-flex items-center hover:bg-accent-700 px-4 py-2 bg-accent border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-accent-700 active:bg-accent-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>
