<div class="flex flex-row flex-wrap justify-between w-full gap-12">
  <div>
    <form action="{{ route('media.create') }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('post')
      <label class="block mb-2 text-sm font-medium text-gray-900" for="multiple_files">Medien
        Upload</label>

      <input
        class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none"
        id="multiple_files" name="files[]" multiple required type="file" onchange="processFiles(this)">
        <small class="text-gray-500">Erlaubte Dateien: jp(e)g, png, gif, videos (mp4, avi, mov, wmv), pdf, docx, xlsx, pptx, odt, ods, odp</small>

      <label class="block mt-4 mb-2 text-sm font-medium text-gray-900" for="albumname">Wähle ein
        Album:</label>
      <select
        class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        id="albumname" name="album" required>
        @foreach ($albumList as $albumItem)
          <option value="{{ $albumItem->id }}">{{ $albumItem->name }}</option>
        @endforeach
      </select>
      <x-primary-button>Datei hochladen</x-primary-button>
    </form>
  </div>

  <div class="w-full">
    <form action="{{ route('album.create') }}" method="POST">
      @csrf
      @method('post')
      <label class="block mb-2 text-sm font-medium text-gray-900" for="small-input">Medienalbum
        anlegen</label>
      <input
        class="block w-full p-2 mb-4 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
        id="small-input" name="name" placeholder="Name" type="text">
      <x-primary-button>Erstellen</x-primary-button>
    </form>
  </div>

  <div>
    <form action="{{route('media.synchronize')}}" method="POST">
      @csrf
      @method('post')
      <x-primary-button>Videos synchronisieren</x-primary-button>
    </form>
  </div>

</div>

<div class="py-4 ">
  <p>Zum Anpassen der Medien oder eines Albums, bitte das passende Album anklicken!</p>
  <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-4">
    @foreach($albumList as $albumItem)
      <x-album :album="$albumItem" :albumList="$albumList"></x-album>
    @endforeach
  </div>
</div>
