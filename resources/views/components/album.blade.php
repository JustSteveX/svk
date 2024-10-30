@props(['album', 'albumList' => []])
<div class="relative h-64 bg-gray-300">
  @if(Request::is('dashboard'))
      <div class="flex w-full h-full border-2 border-transparent cursor-pointer hover:border-primary" onclick="openModal('albumModal', null, {
              closeAll: true,
              inputData: {
                  id: '{{ $album->id }}',
                  name: '{{ $album->name }}',
                  thumbnail: '{{ $album->thumbnail ? Storage::url('media/' . $album->thumbnail->name) : null }}',
                  // DAS HIER NICHT MEHR ANFASSEN, KÖNNTE KAPUTT GEHEN!
                  media: {!! str_replace('"', "'", json_encode($album->media->map(fn($m) => ['id' => $m->id, 'name' => $m->name, 'shortName' => $m->shortenedName(true)]))) !!},
                  albums: {!! str_replace('"', "'", json_encode($albumList->map(fn($a) => ['id' => $a->id, 'name' => $a->name]))) !!},
                  selectedData: []
              }
          })">
          @if ($album->thumbnail)
              <img alt="{{ $album->name }}" class="w-full h-auto" src="{{ Storage::url('media/' . $album->thumbnail->name) }}">
          @else
              <div class="flex items-center justify-center w-full h-full duration-150 ease-linear hover:bg-primary hover:text-gray-100">
                  <h4 class="text-xl text-center">{{ $album->name }}</h4>
              </div>
          @endif
      </div>
  @else
      <a href="{{ Str::lower('galerie/' . $album->name) }}" class="flex w-full h-full border-2 border-transparent hover:border-primary">
          @if ($album->thumbnail)
              <img alt="{{ $album->name }}" class="w-full h-auto" src="{{ Storage::url('media/' . $album->thumbnail->name) }}">
          @else
              <div class="flex items-center justify-center w-full h-full duration-150 ease-linear hover:bg-primary hover:text-gray-100">
                  <h4 class="text-xl text-center">{{ $album->name }}</h4>
              </div>
          @endif
      </a>
      @if($album->thumbnail)
        <p class="text-center">{{$album->name}}</p>
      @endif
  @endif
</div>

