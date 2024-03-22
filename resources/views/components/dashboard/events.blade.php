<form action="{{ route('event.create') }}" method="POST">
  @csrf
  @method('post')
  <div class="flex flex-col justify-between gap-2" id="events-header">
    <div class="w-1/3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="eventname">Veranstaltung</label>
      <input
        class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="eventname" name="eventname" type="text" required>
    </div>
    <div class="w-1/3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="location">Ort</label>
      <input
        class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="location" name="location" type="text" required>
    </div>
    <div class="w-1/3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="starts_on">Findet statt
        am</label>
      <x-datepicker :requestName="'starts_on'" :required="true"></x-datepicker>
    </div>
    <div class="w-1/3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fblink">Facebook
        Veranstaltungslink</label>
      <input
        class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="fblink" name="fblink" type="text">
    </div>
    <div class="w-1/3">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gmap-link">Google Maps
        Link</label>
      <input
        class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="gmap-link" name="gmap-link" type="text">
    </div>
  </div>
  <div class="flex flex-row justify-end gap-4 mt-5 form-actions">
    <x-primary-button class="">{{ __('Termin anlegen') }}</x-primary-button>
  </div>
</form>
