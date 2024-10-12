<x-app-layout>
  <div class="px-4 pt-20">
    <!--  flex-row -->
    <div class="box-content min-h-screen px-2 pt-4 mx-auto border-l-2 bg-accent-50 max-w-7xl md:px-8 border-accent-900 md:pl-8">
      <div class="flex flex-col gap-8 mb-4 md:flex-row">
        <!--  w-1/2 -->
        <section class="md:max-w-[50%] md:w-full text-sm md:text-base flex flex-col h-fit gap-4 justify-evenly mt-2">
          <h1 class="text-xl">Adresse</h1>
          <hr class="border-accent-900">
          <p>St. Seb. Schützenbruderschaft e.V. Kommern</p>
          <p>Straße: Schützenweg</p>
          <p>PLZ - Ort: 53894 - Mechernich / Kommern</p>
          <p>Vereinslokal: Schützenhaus Kommern</p>
          <p>Gründungsjahr: 1859</p>
        </section>
        <section class="md:w-full">
          <iframe width="100%" height="400px"
            src="https://www.openstreetmap.org/export/embed.html?bbox=6.644631028175355%2C50.606229475621554%2C6.648171544075013%2C50.60790786867022&amp;layer=mapnik&amp;marker=50.60706867962972%2C6.646401286125183"
            style="border: 1px solid black"></iframe>
          <small><a class="text-accent hover:text-accent-200 hover:underline" href="https://www.openstreetmap.org/?mlat=50.60707&amp;mlon=6.64640#map=19/50.60707/6.64640">In
              OpenStreetMap öffnen</a></small>
        </section>
      </div>
      <h1 class="text-xl">Kontaktmöglichkeiten</h1>
      <hr class="border-accent-900">
      <div class="flex flex-col gap-8 py-8">
        @isset($contactList)
          @forelse($contactList as $contactItem)
            <address>
              <h2 class="text-lg">{{$contactItem->title}}</h2>
              <p><b>{{$contactItem->firstname}} {{$contactItem->lastname}}</b></p>
              @if($contactItem->phonenumber)
                <p>Tel.: <a class="text-accent hover:text-accent-200 hover:underline" href="tel:{{$contactItem->phonenumber}}">{{$contactItem->phonenumber}}</a></p>
              @endif
              @if($contactItem->email)
                <p>E-Mail: <a class="text-accent hover:text-accent-200 hover:underline" href="mailto:{{$contactItem->email}}">{{$contactItem->email}}</a></p>
              @endif
            </address>
          @empty
            <p>Aktuell gibt es keine Kontaktmöglichkeiten. Bitte in dringenden Fällen die Kontaktdaten aus dem Impressum verwenden.</p>
          @endforelse
        @endisset
      </div>
    </div>
  </div>
</x-app-layout>
