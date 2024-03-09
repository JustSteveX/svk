<div class="flex justify-between h-12 cursor-pointer" onclick="collapse('collapse')">
  <h1 class="text-2xl pt-2.5"> {{ $title }}
  </h1>
  <x-eos-keyboard-arrow-down-o class="transition duration-300 ease-in-out" id="collapse-arrow" />

</div>
<hr>
<div class="overflow-hidden transition-[max-height] ease-in-out duration-300 max-h-0" id="collapse">
  @if (strlen($content) > 0)
    <p>{{ $content }}</p>
  @endif
  @if (count($images) > 0)
    <x-collage :images="$images" />
  @endif
</div>
