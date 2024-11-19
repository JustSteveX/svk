<x-app-layout>
  <div class="px-4 py-20">
    <div class="min-h-screen px-2 pt-4 mx-auto bg-accent-50 max-w-7xl">
      <nav aria-label="Breadcrumb" class="flex">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li>
            <div class="flex items-center">
              <a class="text-sm font-medium text-gray-700 ms-1 hover:text-accent hover:underline md:ms-2"
                href="/galerie">Galerie</a>
            </div>
          </li>
          @isset($album)
            <li aria-current="page">
              <div class="flex items-center">
                <svg aria-hidden="true" class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" fill="none" viewBox="0 0 6 10"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="m1 9 4-4-4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    stroke="currentColor" />
                </svg>
                <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2">{{ $album->name }}</span>
              </div>
            </li>
          @endisset
        </ol>
      </nav>

      <div class="grid gap-4 px-2 py-4 sm:grid-cols-2 md:grid-cols-4">
        @isset($albumList)
          @foreach ($albumList as $albumItem)
              <x-album :album="$albumItem"></x-album>
          @endforeach
        @endisset
        @isset($mediaList)
          @forelse ($mediaList->filter(function($mediaItem) {
              return $mediaItem->isImage() || $mediaItem->isVideo();
          }) as $mediaItem)
              @if($mediaItem->isImage())
                <x-image-preview :media="$mediaItem" class="object-cover w-full h-auto border-2 border-transparent hover:border-accent"></x-image-preview>
              @elseif($mediaItem->isVideo())
                <x-video-preview :media="$mediaItem"></x-video-preview>
              @endif
            @empty
            <p>Hier wurde noch nichts veröffentlicht...</p>
          @endforelse
        @endisset
      </div>
    </div>
  </div>
</x-app-layout>
