<article class="flex flex-row my-8 bg-gray-300 p-8">
  <figure class="float-left max-w-sm ml-8 mb-3">
    <img src="{{ asset('images/schuetzenplatz.png') }}" alt="">
    <figcaption>{{ $article->thumbnail_caption }}</figcaption>
  </figure>
  <article class="pl-8">
    <h1 class="font-bold text-lg">{{ $article->title }}</h1>
    <address>Autor: <span>{{ $article->author }}</span></address>
    <p>Erstellt am: <time datetime="{{ $article->created_at }}">{{ $article->created_at->format('d.m.Y') }}</time></p>
    <hr class="my-2 border-gray-400">
    <p class="text-justify">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis odit consequatur at
      rerum natus laborum
      possimus incidunt rem aliquam maxime odio suscipit qui itaque molestias inventore, quo id dolorum facere!
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni animi architecto veniam excepturi! Nostrum
      exercitationem error eum dolorum ducimus nihil architecto. Dolore asperiores perspiciatis voluptatem, amet
      laborum porro distinctio minima? Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis odit consequatur
      at
      rerum natus laborum
      possimus incidunt rem aliquam maxime odio suscipit qui itaque molestias inventore, quo id dolorum facere!
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni animi architecto veniam excepturi! Nostrum
      exercitationem error eum dolorum ducimus nihil architecto. Dolore asperiores perspiciatis voluptatem, amet
      laborum porro distinctio minima? Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis odit consequatur
      at
      rerum natus laborum
      possimus incidunt rem aliquam maxime odio suscipit qui itaque molestias inventore, quo id dolorum facere!
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni animi architecto veniam excepturi! Nostrum
      exercitationem error eum dolorum ducimus nihil architecto. Dolore asperiores perspiciatis voluptatem, amet
      laborum porro distinctio minima?
    </p>
  </article>
</article>
