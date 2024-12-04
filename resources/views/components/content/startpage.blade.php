<x-app-layout>
  <!--  pt-60  justify-around -->
  <div class="flex flex-col-reverse items-center max-w-6xl min-h-screen gap-4 pt-20 mx-auto md:flex-row md:gap-64">
    <!-- w-[25%] fill-current text-gray-500 h-full -->
    <x-application-logo class="h-auto mx-auto w-full max-w-[15rem] md:max-w-full" />
    <div class="px-3 py-8 mx-4 md:mx-0 bg-primary bg-opacity-70 from-transparent">
      <!-- -->
      <p class="self-center font-serif text-4xl text-center text-accent-50 drop-shadow-lg md:text-[54px] leading-none md:py-10 md:px-4">Herzlich willkommen auf der
        Webseite
        des
        Schützenvereins Kommern!
      </p>
    </div>

  </div>
  <div class="pt-20 pb-40 mx-auto bg-accent-50 min-h-[50vh]">
    @if($mediaList)
      <h1 class="mb-16 text-2xl font-bold text-center">{{$album->name}}</h1>
      <x-image-showcase :mediaList="$mediaList"></x-image-showcase>
    @elseif($blogpost)
      <div class="mx-auto border border-primary container">
        <x-article :blogpost="$blogpost"></x-article>
      </div>
    @endif
  </div>
</x-app-layout>
