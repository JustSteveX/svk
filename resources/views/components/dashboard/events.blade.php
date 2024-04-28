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

<div class="mt-8">
  <h2 class="mt-2 text-lg">Alle Termine im Überblick:</h2>
  <hr>

  @foreach($eventList as $eventItem)
  <div class="flex flex-row items-center justify-between px-4 py-8">
    <p class="text-gray-500"><span class="text-gray-900">{{$eventItem->name}}</span> erstellt am {{ $eventItem->created_at->format('d.m.Y H:i:s') }} zuletzt bearbeitet am: {{$eventItem->updated_at->format('d.m.Y H:i:s')}}</p>
    <span class="flex flex-row items-center justify-between gap-2 leading-none list-actions">
      <form action="{{route('subpage.delete')}}" method="POST">
        @csrf
        @method('delete')
        <input name="id" type="text" hidden value="{{$eventItem->id}}">
        <button class="text-red-900 hover:text-red-600">
          <x-bi-trash-fill class="w-6 h-6" />
        </button>
      </form>
    </span>
  </div>
  <hr>
  @endforeach
</div>
