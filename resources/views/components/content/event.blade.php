<x-app-layout>
  <div class="px-4 pt-20">
  <div class="min-h-screen px-4 pt-4 mx-auto bg-accent-50 max-w-7xl">
    <h1>Alle bevorstehenden Termine in der Übersicht: </h1>
    @forelse ($eventList as $index => $eventItem)
      <!-- Grid Layout datumsbox und textbox nebeneinander in der mobile version kommen die buttons drunter und in der größeren version daneben  -->
      <div class="grid grid-cols-2 grid-rows-2 my-4 bg-gray-900 md:grid-cols-4 md:grid-rows-1 bg-opacity-80">
        <div class="order-1 py-2 text-center text-white bg-gray-900">
          <span
            class="text-6xl">{{ $eventItem->starts_on->format('j') }}</span><br><span>{{ $eventItem->starts_on->format('F') }}</span><br><span>{{ $eventItem->starts_on->format('Y') }}</span>
        </div>
        <div class="order-3 col-span-2 p-2 text-white bg-transparent md:order-2">
          <h3 class="text-base md:text-xl">{{ $eventItem->name }}</h3>
          <p class="text-sm md:text-base">{{ $eventItem->location }}</p>
        </div>
        <div class="flex flex-col justify-center order-2 gap-2 bg-gray-900 md:order-3">
          @if ($eventItem->fb_link)
            <a href="{{ $eventItem->fb_link }}" target="_blank" class="mx-auto rounded" data-tooltip-style="light"
              data-tooltip-target="tooltip-facebook-{{ $index }}">
              <x-entypo-facebook class="w-8 h-8 text-white hover:text-blue-600" />
            </a>
          @endif
          <!--
          <button class="mx-auto rounded" data-tooltip-style="light"
            data-tooltip-target="tooltip-calender-{{ $index }}">
            <x-bi-calendar-plus class="w-8 h-8 text-white" />
          </button>
        -->
          @if ($eventItem->gmap_link)
            <a href="{{ $eventItem->gmap_link }}" target="_blank" class="mx-auto rounded" data-tooltip-style="light"
              data-tooltip-target="tooltip-gmaps-{{ $index }}">
              <x-si-googlemaps class="w-8 h-8 text-white hover:text-red-500" />
            </a>
          @endif
        </div>
      </div>

      <div
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 transition-all bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip"
        id="tooltip-facebook-{{ $index }}" role="tooltip">
        Zur Facebook Veranstaltung weiterleiten
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>
      <div
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 transition-all bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip"
        id="tooltip-calender-{{ $index }}" role="tooltip">
        In den lokalen Kalender importieren
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>
      <div
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 transition-all bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip"
        id="tooltip-gmaps-{{ $index }}" role="tooltip">
        Auf Google Maps anzeigen
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>

    @empty
      <p>Derzeit sind keine Veranstaltungen geplant...</p>
    @endforelse
  </div>
</div>
</x-app-layout>
