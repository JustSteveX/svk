<x-modal focusable name="mediaSelection" title="Medien-Auswahl">

		<div class="grid grid-cols-4 gap-2">
				@foreach ($mediaList as $mediaItem)
						<div  class="relative flex items-center justify-center h-40 border border-slate-700 basis-1/4" x-data="{selected: false}" x-on:modal-data-returned="{selected: false}">
              <div @click="selected = !selected; selectedData = selected ? [...selectedData, {'name': '{{ $mediaItem->name }}', 'mime_type': '{{$mediaItem->mime_type}}' }] : selectedData.filter(item => item.name !== '{{ $mediaItem->name }}')">
								<div class="absolute inset-0 transition-opacity duration-300 bg-black opacity-50" x-show="selected">
                  <x-eos-check class="text-white" />
                </div>
                <img class="" src="{{ $mediaItem->url() }}" alt="{{ $mediaItem->name }}">
              </div>
            </div>
				@endforeach
		</div>

</x-modal>
