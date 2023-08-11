<div class="max-h-[50vh]">
  <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
  @foreach ($images as $image)
    <div class="w-1/2 p-1 md:p-2">
      <img class="block object-cover object-center w-full h-full" src="{{ asset('storage/' . $image->name) }}"
        alt="{{ asset('storage/' . $image->name) }}" />
    </div>
  @endforeach
</div>
<div class="flex flex-wrap -m-1 md:-m-2">
  <div class="flex flex-wrap w-1/2">
    <div class="w-1/2 p-1 md:p-2">
      <img alt="gallery" class="block object-cover object-center w-full h-full"
        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(70).webp">
    </div>
    <div class="w-1/2 p-1 md:p-2">
      <img alt="gallery" class="block object-cover object-center w-full h-full"
        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp">
    </div>
    <div class="w-full p-1 md:p-2">
      <img alt="gallery" class="block object-cover object-center w-full h-full"
        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp">
    </div>
  </div>
  <div class="flex flex-wrap w-1/2">
    <div class="w-full p-1 md:p-2">
      <img alt="gallery" class="block object-cover object-center w-full h-full"
        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp">
    </div>
    <div class="w-1/2 p-1 md:p-2">
      <img alt="gallery" class="block object-cover object-center w-full h-full"
        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp">
    </div>
    <div class="w-1/2 p-1 md:p-2">
      <img alt="gallery" class="block object-cover object-center w-full h-full"
        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp">
    </div>
  </div>
</div>
