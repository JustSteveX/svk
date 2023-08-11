<div {{ $attributes->merge(['class' => 'mx-auto my-12 w-[90%] max-w-[80rem] max-h-[50rem] flex gap-[4rem]']) }}>
    <button class="self-center" onclick="scrollCarousel(this)" id="back">
        <x-gmdi-arrow-back-ios-r class="max-w-[6rem] w-full h-auto" />
    </button>
    <section class="carousel-wrapper flex gap-[1rem] overflow-hidden scroll-smooth">
        <article
            class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
            <img class="pointer-events-none absolute w-full h-full object-cover"
                src="{{ asset('images/aktuelles/20190915_122257.jpg') }}" alt="">
        </article>
        <article
            class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
            <img class="pointer-events-none absolute w-full h-full object-cover"
                src="{{ asset('images/aktuelles/20190912_223339.jpg') }}" alt="">
        </article>
        <article
            class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
            <img class="pointer-events-none absolute w-full h-full object-cover"
                src="{{ asset('images/aktuelles/20190914_102742.jpg') }}" alt="">
        </article>
        <article
            class="carousel-container h-full w-[30%] transition-all ease-in-out duration-[450ms] cursor-pointer relative min-w-[350px]">
            <img class="pointer-events-none absolute w-full h-full object-cover"
                src="{{ asset('images/aktuelles/IMG_20220410_110552 (3).jpg') }}" alt="">
        </article>
    </section>
    <button class="self-center" onclick="scrollCarousel(this)" id="forward">
        <x-gmdi-arrow-forward-ios-r class="max-w-[6rem] w-full h-auto" />
    </button>
</div>
