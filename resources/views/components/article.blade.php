<article class="flex flex-col p-8 my-8 bg-gray-300">
  <header>
    <h1 class="text-lg font-bold">{{ $blogpost->title }}</h1>
    <address class="text-gray-600">Autor: <span>{{ $blogpost->author }}</span></address>
    <p class="text-gray-600">Erstellt am: <time
        datetime="2022-01-01 19:00">{{ $blogpost->created_at->format('d.m.Y') }}</time></p>
    <hr class="my-2 border-gray-400">
  </header>
  <section>
    <div class="inline-block w-full h-full">
      @if ($blogpost->media)
        <figure class="float-right max-w-sm ml-4">
          <img alt="" src="{{ Storage::url('media/' . $blogpost->media->name) }}">
          <figcaption>Mehr lorem mehr ipsum</figcaption>
        </figure>
      @endif

      <p class="text-justify">
        {{ $blogpost->content }}
      </p>
    </div>
    @isset($blogpost->album)
      <hr class="my-4 border-gray-400">
      <x-image-showcase :mediaList="$blogpost->album->media"></x-image-showcase>
    @endisset
  </section>
</article>
