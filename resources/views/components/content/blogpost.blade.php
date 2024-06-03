<x-app-layout>
    <div class="px-4 pt-20 pb-4 mx-auto max-w-7xl">
      @foreach ($groupedBlogposts as $year => $blogpostYearList)
        @foreach ($blogpostYearList as $blogpostItem)
          <x-article :blogpost="$blogpostItem"></x-article>
        @endforeach
        <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full bg-accent">
          <p class="text-center text-white">{{ $year }}</p>
        </div>
      @endforeach
    </div>

</x-app-layout>
