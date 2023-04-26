<x-app-layout>
  <div class="py-10">
    <div class="max-w-6xl mx-auto">
      <!--div class="bg-black h-72">

      </div-->
      <article class="flex flex-col my-8 bg-gray-300 p-8">
        <header>
          <h1 class="font-bold text-lg">Header</h1>
          <address>Autor: <span>Oberadmin</span></address>
          <p>Erstellt am: <time datetime="2022-01-01 19:00">01.01.2022</time></p>
          <hr class="my-2 border-gray-400">

        </header>
        <section>
          <figure class="float-right max-w-sm ml-8 mb-3">

            <img src="{{asset('images/schuetzenplatz.png')}}" alt="">
            <figcaption>Mehr lorem mehr ipsum</figcaption>
          </figure>

          <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis
            odit
            consequatur at
            rerum natus laborum
            possimus incidunt rem aliquam maxime odio suscipit qui itaque molestias inventore, quo id dolorum facere!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni animi architecto veniam excepturi! Nostrum
            exercitationem error eum dolorum ducimus nihil architecto. Dolore asperiores perspiciatis voluptatem, amet
            laborum porro distinctio minima? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Lorem ipsum
            dolor
            sit amet consectetur adipisicing elit. Officiis distinctio cupiditate porro nam error, nihil enim in.
            Explicabo veniam beatae omnis rerum repellendus? Itaque veniam voluptates quae, officia corrupti minima!
            Lorem
            ipsum dolor sit amet consectetur adipisicing elit. Facere, itaque tenetur necessitatibus aspernatur alias
            aliquid ullam, dolore dicta molestiae amet veritatis omnis sunt soluta ipsam! Quae harum non cum facilis!
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab vero quae sed, aliquam voluptate tempora
            saepe
            architecto necessitatibus, inventore cumque doloribus, at officia porro ea rem illum esse consequuntur
            atque. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem explicabo error est fuga quibusdam,
            optio necessitatibus, ratione reiciendis in quas vel voluptatem. Nesciunt quae temporibus voluptate dolor
            quia asperiores doloribus! Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium illum modi
            enim tempora, culpa veniam, mollitia iusto libero nobis ad voluptate, quis excepturi consectetur magni
            similique facere autem vel aliquid? Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit illo
            sapiente minima minus laudantium amet earum, ipsa doloribus, qui, voluptas nemo iste explicabo delectus
            consectetur nisi. Doloremque voluptas mollitia molestiae. Lorem ipsum dolor sit amet consectetur adipisicing
            elit.
          </p>
          <hr class="my-4 border-gray-400">
          <x-slider class="max-h-[16rem]"></x-slider>
        </section>
      </article>

      <div class="bg-black w-16 h-16 flex justify-center items-center rounded-full mx-auto my-4">
        <p class="text-white text-center">2022</p>
      </div>

      @forelse ($articles as $article)
      <x-article :article="$article"></x-article>
      @empty
      <p>Keine Beiträge gefunden. Versuchen Sie die Filter anzupassen oder erstellen Sie einen neuen Beitrag.</p>
      @endforelse


      <!--
        TODO: Legende einbauen
        div id="date-map flex flex-col">
        <div class="date-map-year my-10 flex flex-col">
          <p class="rounded-full text-white bg-black w-16 h-16 flex pt-4 justify-center">2021</p>
          <div class="date-map-item rounded-full text-white bg-black w-20 h-20 text-center">
            <p class="p-8">November</p>
          </div>
          <div class="date-map-item rounded-full text-white bg-black w-20 h-20 text-center pt-6">Juli</div>
        </div>
        <div class="date-map-year my-10 flex flex-col">
          <p class="rounded-full text-white bg-black w-16 h-16 flex pt-4 justify-center">2020</p>
          <div class="date-map-item rounded-full text-white bg-black w-20 h-20 text-center pt-6">Dezember</div>
          <div class="date-map-item rounded-full text-white bg-black w-20 h-20 text-center pt-6">September</div>
          <div class="date-map-item rounded-full text-white bg-black w-20 h-20 text-center pt-6">Februar</div>
          <div class="date-map-item rounded-full text-white bg-black w-20 h-20 text-center pt-6">Januar</div>
        </div>
      </div-->

    </div>
  </div>
</x-app-layout>
