<x-app-layout>
  <div class="pt-10">
    <div class="my-8 max-w-6xl mx-auto">
      <div class="flex content-end justify-end mb-8">
        <!-- Wechselt die Ansicht in einen Kalender -->
        <span>
          <x-button>Ansichtswechsel</x-button>
        </span>
      </div>
      <div class="h-32 flex flex-row my-4 bg-gray-900 bg-opacity-80">
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] text-white text-center pt-3">
          <span class="text-6xl">3</span><br><span>September</span><br><span>2022</span>
        </div>
        <div class="bg-transparent h-full grow p-2 text-white">
          <h3 class="text-xl">Schützenfest Euskirchen</h3>
          <p>53193 Euskirchen, Schützenplatz 2</p>
        </div>
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] flex flex-col justify-center gap-2">
          <button data-tooltip-target="tooltip-facebook" data-tooltip-style="light" class="mx-auto rounded">
            <x-entypo-facebook class="text-white w-8 h-8" />
          </button>
          <button data-tooltip-target="tooltip-calender" data-tooltip-style="light" class="mx-auto rounded">
            <x-bi-calendar-plus class=" text-white w-8 h-8" />
          </button>
          <button data-tooltip-target="tooltip-gmaps" data-tooltip-style="light" class="mx-auto rounded">
            <x-si-googlemaps class="text-white w-8 h-8" />
          </button>
        </div>
      </div>
      <div class="max-w-6xl h-32 mx-auto flex flex-row my-4 bg-gray-900 bg-opacity-80">
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] text-white text-center pt-3">
          <span class="text-6xl">3</span><br><span>September</span><br><span>2022</span>
        </div>
        <div class="bg-transparent h-full grow p-2 text-white">
          <h3 class="text-xl">Schützenfest Euskirchen</h3>
          <p>53193 Euskirchen, Schützenplatz 2</p>
        </div>
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] flex flex-col justify-center gap-2">
          <button data-tooltip-target="tooltip-facebook" data-tooltip-style="light" class="mx-auto rounded">
            <x-entypo-facebook class="text-white w-6 h-6" />
          </button>
          <button data-tooltip-target="tooltip-calender" data-tooltip-style="light" class="mx-auto rounded">
            <x-bi-calendar-plus class=" text-white w-6 h-6" />
          </button>
          <button data-tooltip-target="tooltip-gmaps" data-tooltip-style="light" class="mx-auto rounded">
            <x-si-googlemaps class="text-white w-6 h-6" />
          </button>
        </div>
      </div>
    </div>
    <div id="tooltip-facebook" role="tooltip"
      class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
      Zur Facebook Veranstaltung weiterleiten
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tooltip-calender" role="tooltip"
      class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
      In den lokalen Kalender importieren
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tooltip-gmaps" role="tooltip"
      class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
      Auf Google Maps anzeigen
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
  </div>
</x-app-layout>
