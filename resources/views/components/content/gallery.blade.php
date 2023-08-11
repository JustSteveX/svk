<x-app-layout>
  <div class="py-10">
    <section class="overflow-hidden text-gray-700">
      <div class="container px-5 mx-auto lg:pb-10 lg:px-32">
        @foreach ($albums as $album)
          <x-collapsible :title="$album->name" :images="$album->images" />
        @endforeach
      </div>
    </section>
  </div>
</x-app-layout>
