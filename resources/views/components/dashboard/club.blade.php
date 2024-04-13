@props(['subpageList' => []])
<h2>Jetzt eine neue Seite für den Teil "Verein" anlegen</h2>
<hr>
<form action="{{ route('subpage.create') }}" method="POST">
		@csrf
		@method('POST')

		<div class="my-2 ">
				<label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">Titel angeben</label>
				<input type="text" name="title" id="title" required class="w-full" maxlength="255">
		</div>
		<x-markdown-editor :compName="'content'"></x-markdown-editor>

		<div class="mb-4">
				<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="parentpage-select">Elternseite
						auswählen</label>
				<select class="w-full text-sm font-medium text-gray-900 dark:text-white" id="parentpage-select" name="parent_id">
						<option selected>Keine Seite auswählen</option>
						@foreach ($subpageList as $subpageItem)
								<option value="{{ $subpageItem->id }}">{{ $subpageItem->title }}</option>
						@endforeach
				</select>
		</div>

		<x-primary-button>Neue Seite anlegen</x-primary-button>

</form>
