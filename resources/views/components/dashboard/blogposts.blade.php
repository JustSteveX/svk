<form action="{{ route('blogpost.create') }}" method="POST">
  @csrf
  @method('post')
  <div>
    <div class="flex flex-row justify-between gap-14" id="blogpost-header">
      <div class="w-1/2">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Title</label>
        <input
          class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          id="title" name="title" type="text">
      </div>
      <div class="w-1/2">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="author">Author</label>
        <input
          class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          id="author" name="author" type="text">
      </div>
    </div>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="content">Beitrag</label>
    <textarea class="w-full p-2 mb-8 text-sm font-medium text-gray-900 border border-gray-300 dark:text-white"
      id="content" name="content" rows="8"></textarea>

    <div class="flex flex-row items-end justify-between">
      <div class="flex flex-col gap-2">
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="albumselection">Album
            auswählen</label>
          <select class="w-full text-sm font-medium text-gray-900 dark:text-white" id="albumselection" name="album">
            <option selected>Kein Album</option>
            @foreach ($albumList as $albumItem)
              <option value="{{ $albumItem->id }}">{{ $albumItem->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="mediaselection">Datei
            auswählen</label>
          <select class="w-full text-sm font-medium text-gray-900 dark:text-white" id="mediaselection" name="media">
            <option selected>Keine Datei</option>
            @foreach ($mediaList as $mediaItem)
              <option value="{{ $mediaItem->id }}">{{ $mediaItem->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <x-primary-button>Beitrag erstellen</x-primary-button>
    </div>
  </div>
</form>

<div class="mt-8">
  <h3>Veröffentlichte Beiträge</h3>
  <hr>
  @foreach ($blogpostList as $blogpostItem)
    <div class="relative mt-2">
      <span
        class="block w-full py-4 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="update-album" name="name" readonly required type="text">
        {{ $blogpostItem->title }} <small class="text-neutral-500">veröffentlicht am:</small>
        {{ $blogpostItem->created_at->format('d.m.Y H:i:s') }} <small class="text-neutral-500">von:</small>
        {{ $blogpostItem->author }}
      </span>
    </div>
  @endforeach
</div>
