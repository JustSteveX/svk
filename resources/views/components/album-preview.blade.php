@props(['album' => null])
<div
    {{ $attributes->merge(['class' => 'cursor-pointer bg-primary text-center text-white']) }}
    onclick="window.openModal('globalModal', null, {
        title: 'Album editieren',
        content: `
            <div class='flex flex-col gap-4' x-data='{ selectedImages: [], thumbnail: @json($album->thumbnail ? $album->thumbnail->id : null) }'>
              <div class='flex flex-col gap-2'>
                <div class='flex flex-row justify-between items-center'>
                  <label for='albumname'>Albumname:</label>
                  <input class='w-1/2' type='text' name='albumname' id='albumname' value='{{$album->name}}'>
                </div>
                <div class='flex flex-row justify-between items-center'>
                  <label for='thumbnail'>Vorschaubild:</label>
                  <select name='thumbnail' id='thumbnail' class='w-1/2' x-model='thumbnail'>
                    <option value=''>Kein Vorschaubild</option>
                    @foreach($album->media as $media)
                      <option value='{{$media->id}}'>{{$media->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <hr class='border-accent'>
              <div class='flex flex-col gap-1'>
                <div class='flex flex-row gap-2'>
                  <button class='bg-accent p-2 rounded-md disabled:bg-gray-500 disabled:text-gray-400 text-white' x-on:click='thumbnail= selectedImages[0]' :disabled='selectedImages.length !== 1'>als Vorschaubild setzen</button>
                  <button class='bg-warning-500 p-2 rounded-md disabled:bg-gray-500 disabled:text-gray-400 text-white' :disabled='selectedImages.length === 0'>Verschieben</button>
                  <button class='bg-warning p-2 rounded-md disabled:bg-gray-500 disabled:text-gray-400 text-white' :disabled='selectedImages.length === 0'>Entfernen</button>
                </div>
                <small>Für die Aktionen muss mind. 1 Bild ausgewählt sein</small>
              </div>
              <hr class='border-accent'>
              <div class='grid gap-4 sm:grid-cols-2 md:grid-cols-4'>
                <div class='bg-gray-400 rounded-lg text-center text-gray-300 text-7xl select-none py-[50%] px-0 cursor-pointer'>
                  +
                </div>
                @foreach($album->media as $media)
                  <input type='checkbox' class='hidden peer/media' x-model='selectedImages' :value='{{$media->id}}' id='select-media-{{$media->id}}'>
                  <label for='select-media-{{$media->id}}' class='border-2 border-transparent transition-colors duration-200'>
                    <img class='w-full h-auto' src='{{ Storage::url('media/' . $media->name) }}' alt='{{$media->name}}'>
                  </label>
                @endforeach
              </div>
            </div>
        `,
        action: `
          <div class='flex flex-row justify-end gap-4'>
            <button type='submit' form='exampleForm' class='px-4 py-2 bg-primary text-white rounded'>
              Speichern
            </button>
            <button type='submit' form='exampleForm' class='px-4 py-2 bg-warning text-white rounded'>
              Löschen
            </button>
            <button form='exampleForm' class='px-4 py-2 bg-warning-500 text-white rounded'>
              Abbrechen
            </button>
          </div>
        `,
        inputData: {
        }
    })"
>
  <div class="py-16 flex flex-col justify-center items-center gap-4">
    <p>{{$album->name}}</p>
  </div>
</div>
