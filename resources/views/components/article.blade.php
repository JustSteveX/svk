<article class="flex flex-col p-8 my-4 bg-accent-50">
  <header>
    <h1 class="text-lg font-bold">{{ $blogpost->title }}</h1>
    <address class="text-gray-600">Autor: <span>{{ $blogpost->author }}</span></address>
    <p class="text-gray-600">Erstellt am: <time
        datetime="{{ $blogpost->created_at }}">{{ $blogpost->created_at->format('d.m.Y') }}</time></p>
    <hr class="my-2 border-gray-400">
  </header>
  <section>
    <div class="inline-block w-full h-full">
      @if ($blogpost->media && $blogpost->media->isImage())
        <figure class="float-right max-w-sm ml-4">
          <img alt="" src="{{ Storage::url('media/' . $blogpost->media->name) }}">
          @if ($blogpost->media->caption)
            <figcaption>{{ $blogpost->media->caption }}</figcaption>
          @endif
        </figure>
      @endif

      <p class="text-justify">
        {{ $blogpost->content }}
      </p>
    </div>
    @isset($blogpost->album)
      <hr class="my-4 border-gray-400">
      @if(count($blogpost->album->media->filter->isImage())>0)
        <x-image-showcase :mediaList="$blogpost->album->media->filter->isImage()"></x-image-showcase>
      @else
      <div class="flex flex-row flex-wrap justify-end gap-2">
        @foreach($blogpost->album->media->reject->isImage() as $mediaItem)

          <x-button-download :media="$mediaItem"></x-button-download>

        @endforeach
      </div>
      @endif
    @endisset
  </section>
</article>
