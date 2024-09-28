@props(['contactList' => []])
<div>
  <h1>Kontaktverwaltung</h1>
  <small>(Die Kontakte werden einfach nur nach Eintragungsdatum sortiert!)</small>
  <hr class="my-4 border-gray-400">
  <form action="{{ route('contact.create') }}" method="POST">
    @csrf
    @method('post')
    <div class="flex flex-col gap-2">
      <input type="text" name="title" placeholder="Titel" id="" required>
      <input type="text" name="firstname" placeholder="Vorname" id="" required>
      <input type="text" name="lastname" placeholder="Nachname" id="" required>
      <input type="email" name="email" placeholder="E-Mail" id="">
      <input type="text" name="phonenumber" placeholder="Telefonnummer" id="">
      <x-primary-button>Kontakt anlegen</x-primary-button>
    </div>
  </form>
</div>

<div>
  @if(count($contactList) > 0)
    <hr class="my-4 border-gray-400">
    <h1>Übersicht:</h1>
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                      Rolle
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Nachname
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Vorname
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Aktionen
                    </th>
                </tr>
            </thead>
            <tbody>
              @foreach($contactList as $contactItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{$contactItem->title}}
                    </th>
                    <td class="px-6 py-4">
                      {{$contactItem->lastname}}
                    </td>
                    <td class="px-6 py-4">
                      {{$contactItem->firstname}}
                    </td>
                    <td class="px-6 py-4">
                      <form action="{{route('contact.delete')}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="text" hidden name="id" value="{{$contactItem->id}}">
                        <x-primary-button>Entfernen</x-primary-button>
                      </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>

    @endif
</div>
