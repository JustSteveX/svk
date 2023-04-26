<x-app-layout>
  <div class="bg-auto bg-center h-screen" style="background-image: url('{{asset('/images/schuetzenplatz.png')}}')">
    <div class="pt-40 mx-auto max-w-6xl flex flex-row justify-around gap-32">
      <x-application-logo class="w-[25%] fill-current text-gray-500" />
      <div class="bg-custom-green-900 bg-opacity-70 from-transparent p-3 max-w-[50%]">
        <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos blanditiis eum minus.
          Aspernatur dignissimos
          assumenda quae, hic quas numquam neque nihil maiores voluptatum, doloremque voluptatem rerum dolorem dolor,
          magni fuga. Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum soluta commodi blanditiis saepe
          itaque temporibus numquam facere ad nobis beatae cumque magni dolorum consequatur atque, sapiente ipsa odit
          vero tempora? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi, quas cum esse dolorem
          exercitationem architecto! Incidunt, fugiat distinctio quis recusandae numquam possimus dolore. Velit facilis
          accusamus magni perspiciatis quis rem!</p>
      </div>
    </div>
  </div>
  <div class="pt-10 pb-20 max-w-7xl mx-auto">
    <h1 class="text-center pb-12 pt-4 text-2xl font-bold">Aktuelle Highlights</h1>
    <x-slider :gap="'gap-44'" class="min-h-[6rem]"></x-slider>
  </div>
</x-app-layout>
