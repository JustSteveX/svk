<x-modal focusable name="albumModal" title="Album verwalten">

  <div x-data="modalComponent()" x-init="init()">
    <div class="flex flex-col">
      <input type="text" x-model="inputData.id" hidden>

      <label for="albumname">Albumname</label>
      <input type="text" name="albumname" x-model="inputData.name">

      <label for="thumbnail-selection">Vorschaubild wählen</label>
      <select name="thumbnail" id="thumbnail-selection" x-model="thumbnailId">
        <option value="">Kein Vorschaubild</option>
        <template x-for="mediaItem in inputData.media" :key="mediaItem.id">
          <option :value="mediaItem.id" x-text="mediaItem.shortName"></option>
        </template>
      </select>
      <x-primary-button class="mt-2 w-fit" x-show="selectedMedia.length === 1" @click.prevent="thumbnailId = selectedMedia[0]">Auswahl als Vorschaubild</x-primary-button>
      <hr class="my-2 border-primary">
        <div x-show="selectedMedia.length > 0">
          <div class="flex flex-col gap-2">

            <form action="{{route('media.update')}}" method="POST">
              @csrf
              @method('PATCH')
              <template x-for="mediaId in selectedMedia" :key="mediaId">
                <input type="hidden" name="medias[]" :value="mediaId">
              </template>
              <input type="hidden" name="album" :value="selectedAlbum">
              <x-accent-button type="submit">Ausgewählte Verschieben</x-accent-button>
            </form>
            <select name="newalbum" x-model="selectedAlbum">
              <template x-for="albumItem in inputData.albums" :key="albumItem.id">
                <option :value="albumItem.id" x-text="albumItem.name"></option>
              </template>
            </select>
            <form action="{{route('media.delete')}}" method="POST">
              @csrf
              @method('DELETE')
              <template x-for="mediaId in selectedMedia" :key="mediaId">
                <input type="hidden" name="medias[]" :value="mediaId">
              </template>
              <x-danger-button type="submit">Ausgewählte löschen</x-danger-button>
            </form>
            <p x-text="selectedMedia.length + ' Medien ausgewählt'"></p>
          </div>
        </div>
      <hr class="my-2 border-primary" x-show="selectedMedia.length > 0">
      <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-4">
        <template x-for="mediaItem in inputData.media" :key="mediaItem.id">
          <div class="flex flex-col items-center">
            <input type="checkbox" :value="mediaItem.id" x-model="selectedMedia" class="hidden peer" :id="'media-'+mediaItem.id">
            <label :for="'media-'+mediaItem.id" class="flex flex-col items-center w-full h-auto border-4 border-transparent cursor-pointer peer-checked:border-primary">
              <img
                :alt="mediaItem.name"
                :src="'{{ Storage::url('media/') }}' + mediaItem.name"
                class="w-full h-auto"
                x-show="isImage(mediaItem.name)"
                >
              <span class="w-full mt-2 overflow-hidden text-center text-ellipsis" x-text="mediaItem.shortName"></span>
            </label>
          </div>
        </template>
      </div>
    </div>

    <hr class="border-accent">

    <div class="flex flex-row justify-end gap-4 pt-2 modal-actions">
      <form action="{{route('album.update')}}" method="POST" x-show="thumbnailId !== null">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" x-model="inputData.id">
        <input type="hidden" name="name" x-model="inputData.name">
        <input type="hidden" name="thumbnail_id" :value="thumbnailId">
        <x-primary-button>Speichern</x-primary-button>
      </form>
      <x-accent-button @click.prevent="reset(); $dispatch('close-all-modals')">Verwerfen</x-accent-button>
      <form action="{{route('album.delete')}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" x-model="inputData.id">
        <x-danger-button type="submit">Album Löschen</x-danger-button>
      </form>
    </div>
  </div>
</x-modal>

<script>
  function modalComponent() {
    return {
      selectedMedia: [],
      thumbnailId: 0,
      selectedAlbum: null,

      reset(){
        this.selectedAlbum = null;
        this.selectedMedia = [];
        this.thumbnailId = 0;
      },
      init(){
        this.reset();
      },

      /** steuert nur die sichtbarkeit der html tags, juckt nicht wenn das public ist */
      isImage(fileName){
        const fileExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
        fileName = fileName.toLowerCase();
        const fileExtension = fileName.slice(fileName.lastIndexOf('.')+1)

        return fileExtensions.includes(fileExtension);
      },
      isVideo(fileName){
        const fileExtensions = ['mp4'];
        fileName = fileName.toLowerCase();
        const fileExtension = fileName.slice(fileName.lastIndexOf('.')+1)

        return fileExtensions.includes(fileExtension);
      }
    }
  }
</script>
