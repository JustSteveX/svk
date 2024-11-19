@if(Auth::user()->isSuperAdmin())
<div class="flex flex-row flex-wrap justify-between w-full gap-12">
    <div>
      <form action="{{route('media.synchronize')}}" method="POST">
        @csrf
        @method('post')
        <x-primary-button>Videos synchronisieren</x-primary-button>
      </form>
    </div>
</div>
@endif

<div class="py-4 ">
  <p>Zum Anpassen der Medien oder eines Albums, bitte das passende Album anklicken!</p>
  <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-4">
    <x-album-create></x-album-create>
    <x-album-preview :albumList="$albumList"></x-album-preview>
  </div>
</div>
