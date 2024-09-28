@props(['subpageList' => [], 'mediaList' => []])
<h2>Jetzt eine neue Seite für den Teil "Verein" anlegen</h2>
<hr>
<form action="{{ route('subpage.create') }}" method="POST">
		@csrf
		@method('post')

		<div class="my-2 ">
				<label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">Titel angeben</label>
				<input type="text" name="title" id="title" required class="w-full" maxlength="255">
		</div>
		<x-markdown-editor :compName="'content'" :subpageList="$subpageList"></x-markdown-editor>

		<div class="mb-4">
				<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="parentpage-select">Elternseite
						auswählen (wenn keine Seite gewählt wird, wird die Vereins - Startseite editiert)</label>
				<select class="w-full text-sm font-medium text-gray-900 dark:text-white" id="parentpage-select" name="parent_id">
						<option selected value="">Keine Seite auswählen</option>
						@foreach ($subpageList as $subpageItem)
								<option value="{{ $subpageItem->id }}">{{ $subpageItem->title }}</option>
						@endforeach
				</select>
		</div>

		<x-primary-button>Neue Seite anlegen</x-primary-button>

</form>

<div x-init="''">
		@include('components.modals.media-selection', ['mediaList' => $mediaList])
</div>

<div class="mt-8">
  <h2 class="mt-2 text-lg">Alle Seiten im Überblick:</h2>
  <hr class="mb-4 border-accent-200">

  @foreach($subpageList as $subpageItem)
  <div class="flex flex-col gap-1 px-4 py-2 mt-2 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
    <div class="relative flex flex-row items-center justify-between w-full gap-4 md:gap-0">
      <p>
        <span class="text-gray-900">{{$subpageItem->title}}</span>
        <span class="hidden md:block">
          <small class="text-neutral-500">erstellt am: {{ $subpageItem->created_at->format('d.m.Y') }}</small>
          <small class="text-neutral-500">zuletzt bearbeitet am: {{$subpageItem->updated_at->format('d.m.Y')}}</small>
        </span>
      </p>

      <span class="flex flex-row gap-2 leading-none list-actions">
        <a class="text-accent hover:text-accent-200 hover:underline" target="_blank" href="{{$subpageItem->getUrlPath()}}">Link</a>
        @if($subpageItem->id !== 1)
        <span class="select-none">|</span>
        <form action="{{route('subpage.delete')}}" method="POST">
          @csrf
          @method('delete')
          <input name="id" type="text" hidden value="{{$subpageItem->id}}">
          <button class="text-red-900 hover:text-red-600">
            <x-bi-trash-fill class="w-6 h-6" />
          </button>
        </form>
        @endif
      </span>

    </div>
  </div>
  @endforeach
</div>
