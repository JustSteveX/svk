<x-app-layout>
  <div class="py-10">
    <div class="max-w-6xl mx-auto">
      @foreach ($groupedBlogposts as $year => $blogpostYearList)
        @foreach ($blogpostYearList as $blogpostItem)
          <x-article :blogpost="$blogpostItem"></x-article>
          {{-- Weitere Datenfelder entsprechend deiner Datenstruktur --}}
        @endforeach
        <div class="flex items-center justify-center w-16 h-16 mx-auto my-4 bg-black rounded-full">
          <p class="text-center text-white">{{ $year }}</p>
        </div>
      @endforeach

      <!--
        TODO: Legende einbauen
        div id="date-map flex flex-col">
        <div class="flex flex-col my-10 date-map-year">
          <p class="flex justify-center w-16 h-16 pt-4 text-white bg-black rounded-full">2021</p>
          <div class="w-20 h-20 text-center text-white bg-black rounded-full date-map-item">
            <p class="p-8">November</p>
          </div>
          <div class="w-20 h-20 pt-6 text-center text-white bg-black rounded-full date-map-item">Juli</div>
        </div>
        <div class="flex flex-col my-10 date-map-year">
          <p class="flex justify-center w-16 h-16 pt-4 text-white bg-black rounded-full">2020</p>
          <div class="w-20 h-20 pt-6 text-center text-white bg-black rounded-full date-map-item">Dezember</div>
          <div class="w-20 h-20 pt-6 text-center text-white bg-black rounded-full date-map-item">September</div>
          <div class="w-20 h-20 pt-6 text-center text-white bg-black rounded-full date-map-item">Februar</div>
          <div class="w-20 h-20 pt-6 text-center text-white bg-black rounded-full date-map-item">Januar</div>
        </div>
      </div-->
    </div>
  </div>

</x-app-layout>
