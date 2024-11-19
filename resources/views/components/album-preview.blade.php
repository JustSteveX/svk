@props(['albumList' => []])
@foreach($albumList as $album)
<div
    {{ $attributes->merge(['class' => 'cursor-pointer bg-primary text-center text-white']) }}
    onclick="window.openModal('globalModal', null, {
        title: 'Album editieren',
        content: `
            <div class='flex flex-col gap-4' x-data='{ selectedMedia: [], thumbnail: @json($album->thumbnail ? $album->thumbnail->id : null) }'>
              <form action='{{route('album.update')}}' method='POST' id='editAlbumForm'>
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <input type='hidden' name='_method' value='patch'>
                <input type='hidden' name='id' value='{{$album->id}}'>
                <div class='flex flex-col gap-2'>
                  <div class='flex flex-row justify-between items-center'>
                    <label for='albumname'>Albumname:</label>
                    <input class='w-1/2' type='text' name='albumname' id='albumname' value='{{$album->name}}'>
                  </div>
                  <div class='flex flex-row justify-between items-center'>
                    <label for='thumbnail'>Vorschaubild:</label>
                    <select name='thumbnail_id' id='thumbnail' class='w-1/2' x-model='thumbnail'>
                      <option value=''>Kein Vorschaubild</option>
                      @foreach($album->media as $media)
                        <option value='{{$media->id}}'>{{$media->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </form>
              <hr class='border-accent'>
              <div class='flex flex-col gap-1'>
                <div class='flex flex-row gap-2'>
                  <div class='flex flex-row justify-between w-full max-w-[50%]'>
                    <button class='bg-accent p-2 rounded-md disabled:bg-gray-500 disabled:text-gray-400 text-white' x-on:click='thumbnail= selectedMedia[0]' :disabled='selectedMedia.length !== 1'>als Vorschaubild setzen</button>
                    <form action='{{route('media.delete')}}' method='POST'>
                      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                      <input type='hidden' name='_method' value='delete'>
                      <template x-for='mediaId in selectedMedia' :key='mediaId'>
                        <input type='hidden' name='medias[]' :value='mediaId'>
                      </template>
                      <button type='submit' class='bg-warning p-2 rounded-md disabled:bg-gray-500 disabled:text-gray-400 text-white' :disabled='selectedMedia.length === 0'>Entfernen</button>
                    </form>
                  </div>
                  <div class='flex flex-row justify-between w-full max-w-[50%]'>
                    <form action='{{route('media.update')}}' method='POST' class='w-full'>
                      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                      <input type='hidden' name='_method' value='patch'>
                      <div class='flex flex-row-reverse justify-between'>
                        <select name='album' :disabled='selectedMedia.length === 0' class='disabled:bg-gray-500 disabled:text-gray-400'>
                          <option value='{{$album->id}}' selected>{{$album->name}}</option>
                          @foreach($albumList->reject(fn($albumItem) => $albumItem->id == $album->id) as $albumItem)
                            <option value='{{$albumItem->id}}'>{{$albumItem->name}}</option>
                          @endforeach
                        </select>
                        <template x-for='mediaId in selectedMedia' :key='mediaId'>
                          <input type='hidden' name='medias[]' :value='mediaId'>
                        </template>
                        <button class='bg-warning-500 p-2 rounded-md disabled:bg-gray-500 disabled:text-gray-400 text-white' :disabled='selectedMedia.length === 0'>Verschieben nach</button>
                      </div>
                    </form>
                  </div>
                </div>
                <small>Für die Aktionen muss mind. 1 Bild ausgewählt sein</small>
              </div>
              <hr class='border-accent'>
              <div class='grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 overflow-x-hidden overflow-y-scroll'>
                <form action='{{ route('media.create') }}' method='POST' enctype='multipart/form-data' id='fileUploadForm'>
                  <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                  <input type='hidden' name='_method' value='post'>
                  <input type='hidden' name='album' value='{{$album->id}}'>
                  <div class='bg-gray-400 hover:bg-gray-500 hover:text-gray-400 rounded-lg text-center text-gray-300 text-7xl select-none py-[50%] px-0 cursor-pointer border-2 border-transparent' x-on:click='window.uploadFiles()'>
                    +
                  </div>
                  <input class='hidden' id='fileupload' name='files[]' multiple required type='file' onchange='window.processFiles(this)' accept='.jpg, .jpeg, .png, .gif, .pdf, .docx, .xlsx, .pptx, .odt, .ods, .odp'>
                  <!-- Die folgenden Videoformate werden NICHT erlaubt,
                    weil die potentiell zu groß sind, und daher über den ftplink Zugang hochgeladen werden sollen.
                  mp4, .avi, .mov, .wmv,  -->
                </form>
                @foreach($album->media as $media)
                    <div class='relative'>
                        <input type='checkbox' class='hidden peer' x-model='selectedMedia' :value='{{$media->id}}' id='select-media-{{$media->id}}'>
                        <label for='select-media-{{$media->id}}'
                            class='min-h-full flex items-center h-auto w-full border-4 border-transparent peer-checked:border-primary hover:border-gray-300 peer-checked:bg-primary/20 transition-all duration-200 overflow-hidden absolute'>
                            @if($media->isImage())
                              <img class='overflow-hidden text-ellipsis w-full h-auto'
                                src='{{ Storage::url('media/' . $media->name) }}' alt='{{$media->name}}'>
                            @else
                              <div class='flex justify-center items-center flex-col h-full w-full gap-4'>
                                {{$media->getIcon(true)}}
                                <span class='text-sm overflow-hidden text-ellipsis w-full text-center'>{{$media->shortenedName()}}</span>
                              </div>
                            @endif
                        </label>
                    </div>
                @endforeach

              </div>
            </div>
        `,
        action: `
          <div class='flex flex-row justify-end gap-2'>
            <button type='submit' form='editAlbumForm' class='px-4 py-2 bg-primary text-white rounded'>
              Speichern
            </button>
            <form action='{{route('album.delete')}}' method='POST'>
              <input type='hidden' name='_token' value='{{ csrf_token() }}'>
              <input type='hidden' name='_method' value='delete'>
              <input type='hidden' name='id' value='{{$album->id}}'>
              <button type='submit' class='px-4 py-2 bg-warning text-white rounded'>
                Löschen
              </button>
            </form>
            <button class='px-4 py-2 bg-warning-500 text-white rounded' @click='close()'>
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
@endforeach
