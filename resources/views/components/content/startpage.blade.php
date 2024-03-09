<x-app-layout>
  <div class="h-screen bg-center bg-auto bg-schuetzenhaus">
    <div class="flex flex-row justify-around max-w-6xl gap-32 pt-40 mx-auto">
      <x-application-logo class="w-[25%] fill-current text-gray-500" />
      <div class="bg-custom-green-900 bg-opacity-70 from-transparent p-3 max-w-[50%]">
        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos blanditiis eum minus.
          Aspernatur dignissimos
          assumenda quae, hic quas numquam neque nihil maiores voluptatum, doloremque voluptatem rerum dolorem
          dolor,
          magni fuga. Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum soluta commodi blanditiis
          saepe
          itaque temporibus numquam facere ad nobis beatae cumque magni dolorum consequatur atque, sapiente
          ipsa odit
          vero tempora? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi, quas cum esse
          dolorem
          exercitationem architecto! Incidunt, fugiat distinctio quis recusandae numquam possimus dolore.
          Velit facilis
          accusamus magni perspiciatis quis rem!</p>
      </div>
    </div>
  </div>
  <div class="pt-10 pb-20 mx-auto max-w-7xl">
    <h1 class="pt-4 pb-12 text-2xl font-bold text-center">Aktuelle Highlights</h1>
    <x-image-showcase :mediaList="$mediaList"></x-image-showcase>
  </div>
</x-app-layout>
