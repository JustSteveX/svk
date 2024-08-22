@props(['roleList' => [], 'invitationList' => [], 'userList' => []])
<h1 class="text-lg font-bold">Benutzerverwaltung</h1>
<div class="flex flex-col gap-16">
  <div>
    <h2>Neuen Benutzer einladen</h1>
    <hr class="border-accent">
    <form action="{{route('invitation.create')}}" method="POST" class="flex flex-col gap-4 mt-4">
      @csrf
      <div>
        <label for="email">Email:</label>
        <input id="email" name="email" type="email">
      </div>
      <div>
        <label for="roles">Rolle:</label>
        <select name="role_id" id="roles">
          @foreach($roleList as $roleItem)
            <option value="{{$roleItem->id}}">{{$roleItem->rolename}}</option>
          @endforeach
        </select>
      </div>

      <x-primary-button>Einladung versenden</x-primary-button>
    </form>
  </div>
  <div>
    <h2>Offene Einladungen</h2>
    <hr class="border-accent">
    @if(count($invitationList) > 0)
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                      Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Rolle
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Eingeladen am
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Aktionen
                    </th>
                </tr>
            </thead>
            <tbody>
              @foreach($invitationList?->filter->isNotRegistered() as $invitationItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{$invitationItem->email}}
                    </th>
                    <td class="px-6 py-4">
                      {{$invitationItem->role->rolename}}
                    </td>
                    <td class="px-6 py-4">
                      {{\Carbon\Carbon::parse($invitationItem->created_at)->format('d.m.Y')}}
                    </td>
                    <td class="px-6 py-4">
                      <form action="{{route('invitation.update')}}" method="POST">
                        @csrf
                        @method('patch')
                        <input type="text" hidden name="email" value="{{$invitationItem->email}}">
                        <input type="text" hidden name="token" value="{{$invitationItem->invitation_token}}">
                        <input type="text" hidden name="reinvite" value="true">
                        <x-primary-button>Mail erneut senden</x-primary-button>
                      </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>

    @endif
  </div>

  <div>
    <h2>Registrierte Benutzer</h2>
    <hr class="border-accent">

    <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      Name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Email
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Gruppe
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Registriert am
                  </th>
              </tr>
          </thead>
          <tbody>
      @foreach($userList as $userItem)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{$userItem->name}}
        </th>
        <td class="px-6 py-4">
          {{$userItem->email}}
        </td>
        <td class="px-6 py-4">
          {{$userItem->role->rolename}}
        </td>
        <td class="px-6 py-4">
          {{ $userItem->created_at !== null ? \Carbon\Carbon::parse($userItem->created_at)->format('d.m.Y') : 'Manuell'}}
        </td>
    </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </div>



</div>
