<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="m-auto max-w-7xl">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
      <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" data-tabs-toggle="#default-tab-content"
        id="default-tab" role="tablist">
        <li class="me-2" role="presentation">
          <button aria-controls="home" aria-selected="false" class="inline-block p-4 border-b-2 rounded-t-lg"
            data-tabs-target="#home" id="home-tab" role="tab" type="button">Startseite</button>
        </li>
        <li class="me-2" role="presentation">
          <button aria-controls="blogpost" aria-selected="false"
            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            data-tabs-target="#blogpost" id="blogpost-tab" role="tab" type="button">Beiträge</button>
        </li>
        <li class="me-2" role="presentation">
          <button aria-controls="club" aria-selected="false"
            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            data-tabs-target="#club" id="club-tab" role="tab" type="button">Vereinsinfos</button>
        </li>
        <li role="presentation">
          <button aria-controls="media" aria-selected="false"
            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            data-tabs-target="#media" id="media-tab" role="tab" type="button">Medien / Dateien</button>
        </li>
        <li role="presentation">
          <button aria-controls="event" aria-selected="false"
            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            data-tabs-target="#event" id="event-tab" role="tab" type="button">Termine</button>
        </li>
        <li role="presentation">
          <button aria-controls="email" aria-selected="false"
            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            data-tabs-target="#email" id="email-tab" role="tab" type="button">Abonennten</button>
        </li>
        <li role="presentation">
          <button aria-controls="users" aria-selected="false"
            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            data-tabs-target="#users" id="users-tab" role="tab" type="button">Benutzer</button>
        </li>
      </ul>
    </div>
    <div id="default-tab-content" class="mb-12 bg-gray-300">
      <div aria-labelledby="home-tab" class="hidden p-4 rounded-lg" id="home" role="tabpanel">
        <p class="text-sm text-gray-500 dark:text-gray-400">Dashboard:Startseite -> Work in progress...</p>
      </div>
      <div aria-labelledby="blogpost-tab" class="hidden p-4 rounded-lg" id="blogpost" role="tabpanel">

        <form action="{{ route('blogpost.create') }}" method="POST">
          @csrf
          @method('post')
          <div>
            <div class="flex flex-row justify-between gap-14" id="blogpost-header">
              <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">Title</label>
                <input
                  class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  id="title" name="title" type="text">
              </div>
              <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  for="author">Author</label>
                <input
                  class="block w-full p-2 mb-4 text-xs font-medium text-gray-900 border border-gray-300 md:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  id="author" name="author" type="text">
              </div>
            </div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="content">Beitrag</label>
            <textarea class="w-full p-2 mb-8 text-sm font-medium text-gray-900 border border-gray-300 dark:text-white"
              id="content" name="content" rows="8"></textarea>

            <div class="flex flex-row items-end justify-between">
              <div class="flex flex-col gap-2">
                <div>
                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="albumselection">Album
                    auswählen</label>
                  <select class="w-full text-sm font-medium text-gray-900 dark:text-white" id="albumselection"
                    name="album">
                    <option selected>Kein Album</option>
                    @foreach ($albumList as $albumItem)
                      <option value="{{ $albumItem->id }}">{{ $albumItem->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div>
                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="mediaselection">Datei
                    auswählen</label>
                  <select class="w-full text-sm font-medium text-gray-900 dark:text-white" id="mediaselection"
                    name="media">
                    <option selected>Keine Datei</option>
                    @foreach ($mediaList as $mediaItem)
                      <option value="{{ $mediaItem->id }}">{{ $mediaItem->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <x-primary-button>Beitrag erstellen</x-primary-button>
            </div>
          </div>
        </form>

        <div class="mt-8">
          <h3>Veröffentlichte Beiträge</h3>
          <hr>
          @foreach ($blogpostList as $blogpostItem)
            <div class="relative mt-2">
              <span
                class="block w-full py-4 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="update-album" name="name" readonly required type="text">
                {{ $blogpostItem->title }} <small class="text-neutral-500">veröffentlicht am:</small>
                {{ $blogpostItem->created_at->format('d.m.Y H:i:s') }} <small class="text-neutral-500">von:</small>
                {{ $blogpostItem->author }}
              </span>
            </div>
          @endforeach
        </div>

      </div>
      <div aria-labelledby="club-tab" class="hidden p-4 rounded-lg " id="club" role="tabpanel">
        <p class="text-sm text-gray-500 dark:text-gray-400">Dashboard:Vereinsinfo -> Work in progress...</p>
      </div>
      <div aria-labelledby="media-tab" class="hidden p-4 rounded-lg " id="media" role="tabpanel">
        <!--p class="text-sm text-gray-500 dark:text-gray-400">Dashboard:Medien -> Work in progress...</p-->

        <div class="flex flex-row justify-between w-full gap-12">
          <div class="w-1/2">
            <form action="{{ route('media.create') }}" enctype="multipart/form-data" method="POST">
              @csrf
              @method('post')
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Medien
                Upload</label>
              <input
                class="block w-full mb-4 text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="multiple_files" multiple name="files[]" required type="file">

              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="albumname">Wähle ein
                Album:</label>
              <select
                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="albumname" name="album" required>
                @foreach ($albumList as $albumItem)
                  <option value="{{ $albumItem->id }}">{{ $albumItem->name }}</option>
                @endforeach
              </select>
              <x-primary-button>Datei hochladen</x-primary-button>
            </form>
          </div>

          <div class="w-1/2">
            <form action="{{ route('album.create') }}" method="POST">
              @csrf
              @method('post')
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="small-input">Medienalbum
                anlegen</label>
              <input
                class="block w-full p-2 mb-4 text-gray-900 border border-gray-300 bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="small-input" name="name" placeholder="Name" type="text">
              <x-primary-button>Erstellen</x-primary-button>
            </form>
          </div>

        </div>

        <div class="mt-8">
          <hr class="mb-4">
          <h4>Alben verwalten</h4>
          @foreach ($albumList as $albumItem)
            @if ($albumItem->name === 'Highlights')
              <div class="relative mt-2">
                <label
                  class="block w-full py-4 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  id="update-album" name="name" readonly required type="text">
                  {{ $albumItem->name }} <small class="ml-8 text-gray-500">Dieses Album ist nicht editierbar</small>
                </label>
              </div>
            @else
              <form action="{{ route('album.update') }}" class="mt-2 " method="POST">
                @csrf
                @method('patch')

                <div class="relative">
                  <input class="hidden" name="id" type="text" value="{{ $albumItem->id }}">
                  <input
                    class="block w-full py-4 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="update-album" name="name" required type="text" value="{{ $albumItem->name }}">
                  <button
                    class="disabled:bg-slate-800 text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">Name ändern</button>
                </div>
              </form>
            @endif
          @endforeach
        </div>

        @if (isset($mediaList) && count($mediaList) > 0)
          <div class="mt-8">
            <hr class="mb-4">
            <h4>Medien verwalten</h4>
            @foreach ($mediaList as $mediaItem)
              <form action="{{ route('media.delete') }}" class="mt-2" method="POST">
                @csrf
                @method('delete')

                <div
                  class="relative flex items-center justify-between w-full py-2 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <input class="hidden" name="id" readonly type="text" value="{{ $mediaItem->id }}">
                  <label class="border-none bg-inherit" id="update-album" required
                    type="text">{{ $mediaItem->name }}</label>

                  <div class="flex flex-row items-center gap-4">
                    <small class="text-gray-500">Aus dem Album: {{ $mediaItem->album->name }}</small>
                    <x-danger-button
                      class="mr-4 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                      type="submit">Datei löschen</x-danger-button>
                  </div>
                </div>
              </form>
            @endforeach
          </div>
        @endif
      </div>

      <div aria-labelledby="event-tab" class="hidden p-4 rounded-lg " id="event" role="tabpanel">

        <x-dashboard.events></x-dashboard.events>

      </div>
      <div aria-labelledby="email-tab" class="hidden p-4 rounded-lg " id="email" role="tabpanel">

        <div>Editor zum erstellen neuer Emails:</div>
        <p>Vielleicht mit checkbox für alle benachrichtigungen oder nur wichtiges</p>
        <div>Email Verteiler:</div>

      </div>

      <div aria-labelledby="users-tab" class="hidden p-4 rounded-lg " id="users" role="tabpanel">

        <x-dashboard.users></x-dashboard.users>

      </div>
    </div>
  </div>
</x-app-layout>
