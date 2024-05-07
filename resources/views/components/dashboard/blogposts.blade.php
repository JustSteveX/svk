<h1 class="mb-4">Neuen Beitrag hinzufügen</h1>
<form action="{{ route('blogpost.create') }}" method="POST">
  @csrf
  @method('post')
  <div>
    <!--  flex-row  gap-14 -->
    <div class="flex flex-col justify-between" id="blogpost-header">
      <div class="">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="title">Title</label>
        <input
          class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500"
          id="title" name="title" type="text">
      </div>
      <div class="">
        <label class="block mb-2 text-sm font-medium text-gray-900" for="author">Author</label>
        <input
          class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500"
          id="author" name="author" type="text">
      </div>
    </div>
    <label class="block mb-2 text-sm font-medium text-gray-900" for="content">Beitrag</label>
    <textarea class="w-full p-2 mb-8 text-sm font-medium text-gray-900 border border-gray-300"
      id="content" name="content" rows="8"></textarea>

      <!--  flex-row -->
    <div class="flex flex-col justify-between gap-2">
      <div class="flex flex-col gap-2">
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900" for="albumselection">Album
            auswählen</label>
          <select class="w-full text-sm font-medium text-gray-900" id="albumselection" name="album">
            <option selected value="">Kein Album</option>
            @foreach ($albumList as $albumItem)
              <option value="{{ $albumItem->id }}">{{ $albumItem->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900" for="mediaselection">Bild
            auswählen</label>
          <select class="w-full text-sm font-medium text-gray-900" id="mediaselection" name="media">
            <option selected value="">Keine Datei</option>
            @foreach ($mediaList->filter->isImage() as $mediaItem)
              <option value="{{ $mediaItem->id }}">{{ $mediaItem->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <x-primary-button class="w-fit">Beitrag erstellen</x-primary-button>
    </div>
  </div>
</form>

<div class="mt-8">
  <h3>Veröffentlichte Beiträge</h3>
  <hr>
  @foreach ($blogpostList as $blogpostItem)
  <div class="flex flex-col gap-1 px-4 py-2 mt-2 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
    <div class="relative flex flex-row items-center justify-between w-full gap-4 md:gap-0">
      <p>
        {{ $blogpostItem->title }}
        <span class="hidden md:block">
          <small class="text-neutral-500">veröffentlicht am: {{ $blogpostItem->created_at->format('d.m.Y') }}</small>
          <small class="text-neutral-500">von: {{ $blogpostItem->author }}</small>
          @if($blogpostItem->archived)
            <small class="text-warning">(Archiviert)</small>
          @endif
        </span>
      </p>
      <span class="flex flex-row gap-2 leading-none list-actions">
        <form action="{{route('blogpost.archive')}}" method="POST">
          @csrf
          @method('post')
          <input name="id" type="text" value="{{$blogpostItem->id}}" hidden>
          <button class="text-gray-800 hover:text-gray-500">
            <x-bi-archive-fill class="w-6 h-6" />
          </button>
        </form>
        <form action="{{route('blogpost.delete')}}" method="POST">
          @csrf
          @method('delete')
          <input name="id" type="text" value="{{$blogpostItem->id}}" hidden>
          <button class="text-red-900 hover:text-red-600">
            <x-bi-trash-fill class="w-6 h-6" />
          </button>
        </form>
      </span>
    </div>
    <p class="flex flex-col pb-2 text-xs text-gray-500 md:hidden">
      <span>veröffentlicht am: {{ $blogpostItem->created_at->format('d.m.Y H:i:s') }}</span>
      <span>von: {{ $blogpostItem->author }}</span>
      @if($blogpostItem->archived)
        <span class="text-warning">(Archiviert)</span>
      @endif
    </p>
  </div>
  @endforeach
</div>
