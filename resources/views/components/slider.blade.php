<div class="mx-auto my-12 w-[90%] max-w-[80rem] h-[70vh] max-h-[50rem] flex gap-[5rem]">
  <button class="self-center" onclick="scrollCarousel('back')">
    <x-gmdi-arrow-back-ios-r class="max-w-[6rem] w-full h-auto" />
  </button>
  <section class="carousel-wrapper flex justify-between gap-[0.5rem] overflow-hidden">
    <article
      class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
      <img class="pointer-events-none absolute w-full h-full object-cover"
        src="{{asset('images/aktuelles/20190915_122257.jpg')}}" alt="">
    </article>
    <article
      class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
      <img class="pointer-events-none absolute w-full h-full object-cover"
        src="{{asset('images/aktuelles/20190915_122257.jpg')}}" alt="">
    </article>
    <article
      class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
      <img class="pointer-events-none absolute w-full h-full object-cover"
        src="{{asset('images/aktuelles/20190915_122257.jpg')}}" alt="">
    </article>
    <article
      class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
      <img class="pointer-events-none absolute w-full h-full object-cover"
        src="{{asset('images/aktuelles/20190915_122257.jpg')}}" alt="">
    </article>
  </section>
  <button class="self-center" onclick="scrollCarousel('forward')">
    <x-gmdi-arrow-forward-ios-r class="max-w-[6rem] w-full h-auto" />
  </button>
</div>