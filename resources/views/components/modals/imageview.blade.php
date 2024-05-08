<x-modal focusable name="imageModal" title="Bildansicht">
  <div class="flex items-center justify-center">
    <img :src="inputData.imageUrl" :alt="inputData.name">
  </div>

  <x-slot:action>
    <a :href="inputData.imageUrl" class="px-4 py-2 font-extrabold uppercase duration-150 ease-in-out bg-primary text-accent-50 hover:bg-accent" download>Datei runterladen</a>
  </x-slot>
</x-modal>
