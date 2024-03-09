<x-app-layout>
  <div class="pt-10">
    <div class="max-w-6xl mx-auto my-8">
      <div class="flex flex-row h-32 my-4 bg-gray-900 bg-opacity-80">
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] text-white text-center pt-3">
          <span class="text-6xl">3</span><br><span>September</span><br><span>2022</span>
        </div>
        <div class="h-full p-2 text-white bg-transparent grow">
          <h3 class="text-xl">Schützenfest Euskirchen</h3>
          <p>53193 Euskirchen, Schützenplatz 2</p>
        </div>
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] flex flex-col justify-center gap-2">
          <button class="mx-auto rounded" data-tooltip-style="light" data-tooltip-target="tooltip-facebook">
            <x-entypo-facebook class="w-8 h-8 text-white" />
          </button>
          <button class="mx-auto rounded" data-tooltip-style="light" data-tooltip-target="tooltip-calender">
            <x-bi-calendar-plus class="w-8 h-8 text-white " />
          </button>
          <button class="mx-auto rounded" data-tooltip-style="light" data-tooltip-target="tooltip-gmaps">
            <x-si-googlemaps class="w-8 h-8 text-white" />
          </button>
        </div>
      </div>
      <div class="flex flex-row h-32 max-w-6xl mx-auto my-4 bg-gray-900 bg-opacity-80">
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] text-neutral-100 text-center pt-3">
          <span class="text-6xl">3</span><br><span>September</span><br><span>2022</span>
        </div>
        <div class="h-full p-2 bg-transparent grow">
          <h3 class="text-xl text-neutral-100">Schützenfest Euskirchen</h3>
          <p class="text-neutral-300">53193 Euskirchen, Schützenplatz 2</p>
        </div>
        <div class="bg-gray-900 h-full grow-0 min-w-[8rem] flex flex-col justify-evenly">
          <button class="mx-auto rounded" data-tooltip-style="light" data-tooltip-target="tooltip-facebook">
            <x-entypo-facebook class="w-6 h-6 text-white" />
          </button>
          <button class="mx-auto rounded" data-tooltip-style="light" data-tooltip-target="tooltip-calender">
            <x-bi-calendar-plus class="w-6 h-6 text-white " />
          </button>
          <button class="mx-auto rounded" data-tooltip-style="light" data-tooltip-target="tooltip-gmaps">
            <x-si-googlemaps class="w-6 h-6 text-white" />
          </button>
        </div>
      </div>
    </div>
    <div
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip"
      id="tooltip-facebook" role="tooltip">
      Zur Facebook Veranstaltung weiterleiten
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip"
      id="tooltip-calender" role="tooltip">
      In den lokalen Kalender importieren
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div
      class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip"
      id="tooltip-gmaps" role="tooltip">
      Auf Google Maps anzeigen
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
  </div>
</x-app-layout>
