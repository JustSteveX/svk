<x-app-layout>
  <div class="pt-20">
  <div class="min-h-screen px-4 pt-4 mx-auto bg-accent-50 max-w-7xl">
    @forelse ($eventList as $index => $eventItem)
      <div class="flex flex-row h-32 my-4 bg-gray-900 bg-opacity-80">
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] text-white text-center pt-3">
          <span
            class="text-6xl">{{ $eventItem->starts_on->format('j') }}</span><br><span>{{ $eventItem->starts_on->format('F') }}</span><br><span>{{ $eventItem->starts_on->format('Y') }}</span>
        </div>
        <div class="h-full p-2 text-white bg-transparent grow">
          <h3 class="text-xl">{{ $eventItem->name }}</h3>
          <p>{{ $eventItem->location }}</p>
        </div>
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] flex flex-col justify-center gap-2">
          @if ($eventItem->fb_link)
            <a href="{{ $eventItem->fb_link }}" target="_blank" class="mx-auto rounded" data-tooltip-style="light"
              data-tooltip-target="tooltip-facebook-{{ $index }}">
              <x-entypo-facebook class="w-8 h-8 text-white" />
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
              <x-si-googlemaps class="w-8 h-8 text-white" />
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
