<x-app-layout>
  <div class="mx-auto my-4 max-w-7xl">
    <nav aria-label="Breadcrumb" class="flex">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li>
          <div class="flex items-center">
            <a class="text-sm font-medium text-gray-700 ms-1 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
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
              <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400">{{ $album->name }}</span>
            </div>
          </li>
        @endisset
      </ol>
    </nav>

    <div class="flex flex-wrap my-8">
      @isset($albumList)
        @foreach ($albumList as $albumItem)
          <div class="w-full px-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4">
            <div class="relative h-64 bg-gray-300">
              <a href="{{ Str::lower('galerie/' . $albumItem->name) }}">
                @if ($albumItem->thumbnail)
                  <img alt="" class="h-auto max-w-full" src="{{ asset($albumItem->thumbnail) }}">
                @else
                  <div class="flex items-center justify-center w-full h-full hover:bg-gray-600 hover:text-gray-100">
                    <h4 class="text-xl text-center ">{{ $albumItem->name }}</h4>
                  </div>
                @endif
              </a>
            </div>
          </div>
        @endforeach
      @endisset
      @isset($mediaList)
        @forelse ($mediaList->filter->isImage() as $mediaItem)
          <div class="w-full px-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4">
              <img alt="" class="w-full h-auto" src="{{ Storage::url('media/' . $mediaItem->name) }}">
          </div>
        @empty
          <p>Hier wurde noch nichts veröffentlicht...</p>
        @endforelse
      @endisset
    </div>
  </div>
</x-app-layout>
