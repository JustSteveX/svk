@props(['subpageList' => [], 'mediaList' => []])
<h2>Jetzt eine neue Seite für den Teil "Verein" anlegen</h2>
<hr>
<form action="{{ route('subpage.create') }}" method="POST">
		@csrf
		@method('POST')

		<div class="my-2 ">
				<label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">Titel angeben</label>
				<input type="text" name="title" id="title" required class="w-full" maxlength="255">
		</div>
		<x-markdown-editor :compName="'content'" :subpageList="$subpageList"></x-markdown-editor>

		<div class="mb-4">
				<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="parentpage-select">Elternseite
						auswählen</label>
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
  <hr>

  @foreach($subpageList as $subpageItem)
  <div class="flex flex-row justify-between px-4 py-8">
    <p>{{$subpageItem->title}} erstellt am {{ $subpageItem->created_at->format('d.m.Y H:i:s') }} zuletzt bearbeitet am: {{$subpageItem->updated_at->format('d.m.Y H:i:s')}}</p> <a class="text-slate-600 hover:text-blue-700" target="_blank" href="{{$subpageItem->getUrlPath()}}">Link</a>
  </div>
  <hr>
  @endforeach
</div>
