<div class="flex justify-between h-12 cursor-pointer" onclick="collapse('collapse')">
  <h1 class="text-2xl pt-2.5"> {{ $title }}
  </h1>
  <x-ri-arrow-down-s-line id="collapse-arrow" class="transition ease-in-out duration-300" />
</div>
<hr>
<div id="collapse" class="overflow-hidden transition-[max-height] ease-in-out duration-300 max-h-0">
  @if (strlen($content) > 0)
    <p>{{ $content }}</p>
  @endif
  @if (count($images) > 0)
    <x-collage :images="$images" />
  @endif
</div>
