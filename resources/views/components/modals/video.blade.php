<x-modal focusable name="videoModal" title="Videoansicht" x-init="loadNewVideo(inputData.videoUrl)">
  <div class="flex items-center justify-center">
    <video id="video" controls>
      <source :src="inputData.videoUrl" type="video/mp4">
    </video>

  </div>

  <x-slot:action>

  <hr class="border-accent">
  <div class="flex flex-row justify-end gap-4 px-4 py-2 modal-actions">
    <a :href="inputData.videoUrl" class="px-4 py-2 font-extrabold uppercase duration-150 ease-in-out bg-primary text-accent-50 hover:bg-accent" download>Datei herunterladen</a>
  </div>
  </x-slot>
</x-modal>

<script>
  function loadNewVideo(videoUrl) {
    const videoElement = document.getElementById('video');
    const sourceElement = videoElement.querySelector('source'); // Holen des source-Tags

    // Setze den neuen Video-URL
    sourceElement.src = videoUrl;

    // Lade das Video nach der Änderung des src-Attributs
    videoElement.load();  // Lädt das Video mit der neuen Quelle
  }

  // Beispielaufruf
</script>
