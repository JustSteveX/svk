<div class="flex flex-row flex-wrap justify-between w-full gap-12">
  <div>
    <form action="{{ route('media.create') }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('post')
      <label class="block mb-2 text-sm font-medium text-gray-900" for="multiple_files">Medien
        Upload</label>

      <input
        class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none"
        id="multiple_files" multiple name="files[]" required type="file">
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

</div>

<div class="mt-8">
  <hr class="mb-4">
  <h4>Alben verwalten</h4>
  @foreach ($albumList as $albumItem)
    @if ($albumItem->name === 'Highlights')
      <div class="relative mt-2">
        <label
          class="flex flex-col w-full gap-1 py-4 text-sm text-gray-900 border border-gray-300 md:flex-row bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
          id="update-album" name="name" readonly required type="text">
          <span>{{ $albumItem->name }}</span> <small class="text-gray-500">Dieses Album ist nicht editierbar</small>
        </label>
      </div>
    @else
    <div class="flex flex-row items-center justify-center w-full gap-2">
      <form action="{{ route('album.update') }}" method="POST" class="w-full">
        @csrf
        @method('patch')

        <div class="relative">
          <input hidden name="id" type="text" value="{{ $albumItem->id }}">
          <input
            class="block w-full py-4 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            id="update-album" name="name" required type="text" value="{{ $albumItem->name }}">
          <button
            class="disabled:bg-slate-800 text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
            type="submit">Name ändern</button>
        </div>
      </form>
      <form action="{{route('album.delete')}}" method="POST">
        @csrf
        @method('delete')
        <input type="text" hidden name="id" type="text" value="{{$albumItem->id}}">
        <x-danger-button
              class="mr-4 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 "
              type="submit">Album löschen</x-danger-button>
      </form>
    </div>
    @endif
  @endforeach
</div>

@if (isset($mediaList) && count($mediaList) > 0)
  <div class="mt-8">
    <hr class="mb-4">
    <h4>Medien verwalten</h4>
    @foreach ($mediaList as $mediaItem)
      <form action="{{ route('media.delete') }}" class="mt-2" method="POST">
        @csrf
        @method('delete')

        <div
          class="relative flex flex-col items-center justify-between w-full gap-2 px-4 py-2 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
          <input class="hidden" name="id" readonly type="text" value="{{ $mediaItem->id }}">
          <label class="w-full overflow-hidden text-sm text-ellipsis">{{ $mediaItem->name }}</label>

          <div class="flex flex-col items-center justify-between gap-2 md:w-full md:flex-row md:gap-4">
            <small class="text-gray-500">Aus dem Album: {{ $mediaItem->album->name }}</small>
            <x-danger-button
              class="text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
              type="submit">Datei löschen</x-danger-button>
          </div>
        </div>
      </form>
    @endforeach
  </div>
@endif
