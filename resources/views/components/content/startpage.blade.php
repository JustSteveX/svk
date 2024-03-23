<x-app-layout>
  <div class="h-screen bg-center bg-auto bg-schuetzenhaus">
    <div class="flex flex-row justify-around max-w-6xl gap-32 pt-40 mx-auto">
      <x-application-logo class="w-[25%] fill-current text-gray-500" />
      <div class="bg-custom-green-900 bg-opacity-70 from-transparent p-3 max-w-[50%] flex">
        <p class="text-center text-white text-[54px] self-center drop-shadow-lg font-serif">Herzlich willkommen auf der
          Webseite
          des
          Schützenvereins Kommern!
        </p>
      </div>
    </div>
  </div>
  <div class="pt-10 pb-20 mx-auto max-w-7xl">
    <h1 class="pt-4 pb-12 text-2xl font-bold text-center">Aktuelle Highlights</h1>
    <x-image-showcase :mediaList="$mediaList"></x-image-showcase>
  </div>
</x-app-layout>
