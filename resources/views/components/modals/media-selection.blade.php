<x-modal focusable name="mediaSelection" title="Medien-Auswahl">

		<div class="grid grid-cols-4 gap-2">
				@foreach ($mediaList as $mediaItem)
						<div :class="{'border-slate-700': selected}" class="relative flex items-center justify-center h-40 border border-transparent hover:border-slate-700 basis-1/4" x-data="{selected: false}" x-on:modal-data-returned="{selected: false}">
              <div class="flex items-center justify-center w-full h-full overflow-hidden" @click="selected = !selected; selectedData = selected ? [...selectedData, {'name': '{{ $mediaItem->name }}', 'mime_type': '{{$mediaItem->mime_type}}' }] : selectedData.filter(item => item.name !== '{{ $mediaItem->name }}')">
								<div class="absolute inset-0 transition-opacity duration-300 bg-black opacity-50" x-show="selected">
                  <x-eos-check class="text-white" />
                </div>
                @if($mediaItem->isImage())
                  <img class="pointer-events-none select-none" src="{{ $mediaItem->url() }}" alt="{{ $mediaItem->name }}">
                @else
                  <div class="flex flex-col items-center justify-center w-full h-full">
                    <p class="text-base border-b-2 border-solid select-none ">{{ $mediaItem->shortenedName() }}</p>
                    <small class="text-sm font-extrabold select-none text-slate-700">{{strtoupper(pathinfo($mediaItem->name, PATHINFO_EXTENSION)) }}</small>
                  </div>
                @endif
              </div>
            </div>
				@endforeach
		</div>

</x-modal>
