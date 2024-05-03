<x-app-layout>
  <div class="flex flex-row justify-around max-w-6xl min-h-screen gap-32 mx-auto pt-60">
    <x-application-logo class="w-[25%] fill-current text-gray-500 h-full" />
    <div class="bg-custom-green-900 bg-opacity-70 from-transparent px-3 max-w-[50%] flex h-full py-8">
      <p class="text-center text-white text-[54px] self-center drop-shadow-lg font-serif">Herzlich willkommen auf der
        Webseite
        des
        Schützenvereins Kommern!
      </p>
    </div>
  </div>
  <div class="pt-20 pb-40 mx-auto bg-white">
    <h1 class="mb-16 text-2xl font-bold text-center">Aktuelle Highlights</h1>
    <x-image-showcase :mediaList="$mediaList"></x-image-showcase>
  </div>
</x-app-layout>
