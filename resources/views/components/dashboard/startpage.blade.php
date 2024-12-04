@props(['albumList' => [], 'blogpostList' => [],'configList' => [], 'mediaList' => []])

<form action="{{route('config.set')}}" method="POST">
  @csrf
  @method('post')
  <div class="flex flex-col gap-4">
    <div>
      <h1 class="text-lg">Album anzeigen</h1>
      <small>Wenn ein Album angezeigt wird, wird KEIN Beitrag angezeigt!</small><br>
      <select name="startpage_album" id="">
        <option value="" @if(!$configList->where('key', 'startpage_album')->first()) selected @endif>Kein Album anzeigen</option>
        @foreach($albumList as $albumItem)
          <option value="{{$albumItem->id}}" @if($configList->where('key', 'startpage_album')->first()?->value == $albumItem->id) selected @endif>{{$albumItem->name}}</option>
        @endforeach
      </select>
    </div>

    <div>
      <h1 class="text-lg">Beitrag anzeigen</h1>
      <small>Wenn ein Album angezeigt wird, wird KEIN Beitrag angezeigt!</small><br>
      <select name="startpage_blogpost" id="">
        <option value="" @if(!$configList->where('key', 'startpage_blogpost')->first()) selected @endif>Kein Beitrag anzeigen</option>
        @foreach($blogpostList as $blogpostItem)
          <option value="{{$blogpostItem->id}}" @if($configList->where('key', 'startpage_blogpost')->first()?->value == $blogpostItem->id) selected @endif>{{$blogpostItem->title}}</option>
        @endforeach
      </select>
    </div>

    <div>
      <h1 class="text-lg">Hintergrundbild setzen</h1>
      <small>Diese Einstellung setzt das Hintergrundbild für JEDE Ansicht!</small> <br>
      <select name="background_image" id="">
        <option value="" @if(!$configList->where('key', 'background_image')->first()) selected @endif>Standard</option>
        @foreach($mediaList->filter(fn($media) => $media->isImage()) as $mediaItem)
          <option value="{{$mediaItem->id}}" @if($configList->where('key', 'background_image')->first()?->value == $mediaItem->id) selected @endif>{{$mediaItem->name}}</option>
        @endforeach
      </select>
    </div>
    <x-primary-button class="w-fit">Änderungen übernehmen</x-primary-button>
  </div>
</form>
