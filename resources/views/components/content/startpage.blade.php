<x-app-layout>
  <!--  pt-60  justify-around -->
  <div class="flex flex-col max-w-6xl min-h-screen gap-4 pt-20 mx-auto sm:flex-row md:gap-32">
    <!-- w-[25%] fill-current text-gray-500 h-full -->
    <x-application-logo class="h-auto mx-auto w-60" />
    <div class="bg-custom-green-900 bg-opacity-70 from-transparent px-3 max-w-full sm:max-w-[50%] flex h-full py-8 mx-4">
      <p class="text-center text-white text-[54px] self-center drop-shadow-lg font-serif">Herzlich willkommen auf der
        Webseite
        des
        Schützenvereins Kommern!
      </p>
    </div>
  </div>
  <div class="min-h-screen pt-20 pb-40 mx-auto bg-white">
    <h1 class="mb-16 text-2xl font-bold text-center">Aktuelle Highlights</h1>
    <x-image-showcase :mediaList="$mediaList"></x-image-showcase>
  </div>
</x-app-layout>
