@props(['album' => null])
<div
    {{ $attributes->merge(['class' => 'bg-gray-400 rounded-lg text-gray-300 px-0 cursor-pointer flex items-center justify-center']) }}
    onclick="window.openModal('globalModal', null, {
        title: 'Album erstellen',
        content: `
          <form action='{{route('album.create')}}' method='POST' id='createAlbumForm'>
            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
            <input type='hidden' name='_method' value='post'>
            <div class='flex flex-row justify-between items-center'>
              <label for='albumname'>Albumname:</label>
              <input class='w-1/2' type='text' name='albumname' id='albumname'>
            </div>
          </form>
        `,
        action: `
          <div class='flex flex-row justify-end'>
            <button type='submit' form='createAlbumForm' class='px-4 py-2 bg-primary hover:bg-accent text-white rounded'>
              Album erstellen
            </button>
          </div>
        `,
        inputData: {
        }
    })"
>
    <x-bi-plus class="w-16 h-16" />
</div>
