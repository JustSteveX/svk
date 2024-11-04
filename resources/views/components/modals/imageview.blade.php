<x-modal focusable name="imageModal" title="Bildansicht">
  <div class="flex items-center justify-center">
    <img :src="inputData.imageUrl" class="min-h-[200px] max-h-[80vh]" :alt="inputData.name">
  </div>

  <x-slot:action>

  <hr class="border-accent">
  <div class="flex flex-row justify-end gap-4 px-4 py-2 modal-actions">
    <a :href="inputData.imageUrl" class="px-4 py-2 font-extrabold uppercase duration-150 ease-in-out bg-primary text-accent-50 hover:bg-accent" download>Datei herunterladen</a>
  </div>
  </x-slot>
</x-modal>
