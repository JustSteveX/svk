@props(['roleList' => []])
<h1 class="mb-8">Neuen Benutzer einladen</h1>
<form action="{{route('storeInvitation')}}" method="POST" class="flex flex-col gap-4">
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
