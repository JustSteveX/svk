@if($mediaList?->filter?->isImage() !== null && count($mediaList?->filter?->isImage()) > 0)
  <div class="relative w-full max-w-2xl mx-auto" data-carousel="slide" id="animation-carousel">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden md:h-96">
      @foreach($mediaList->filter->isImage() as $mediaItem)
        <div class="hidden ease-in-out duration-2000" data-carousel-item="{{ $loop->first ? 'active' : '' }}">
          <x-image :media="$mediaItem" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"></x-image>
        </div>
      @endforeach

    </div>
    @if(count($mediaList->filter->isImage()) > 1)
      <!-- Slider controls -->
      <button
        class="absolute z-30 flex items-center justify-center px-4 cursor-pointer top-1/2 bottom-1/2 start-0 group focus:outline-none"
        data-carousel-prev type="button">
        <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg aria-hidden="true" class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" fill="none"
            viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 1 1 5l4 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              stroke="currentColor" />
          </svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button
        class="absolute z-30 flex items-center justify-center px-4 cursor-pointer top-1/2 bottom-1/2 end-0 group focus:outline-none"
        data-carousel-next type="button">
        <span
          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg aria-hidden="true" class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" fill="none"
            viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
            <path d="m1 9 4-4-4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              stroke="currentColor" />
          </svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    @endif
  </div>
@endif
