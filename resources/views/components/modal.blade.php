@props(['name', 'show' => false, 'maxWidth' => '2xl', 'title' => null])

@php
		$maxWidth = [
		    'sm' => 'sm:max-w-sm',
		    'md' => 'sm:max-w-md',
		    'lg' => 'sm:max-w-lg',
		    'xl' => 'sm:max-w-xl',
		    '2xl' => 'sm:max-w-2xl',
		][$maxWidth];
@endphp

<div class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0" style="display: {{ $show ? 'block' : 'none' }};"
		x-ref="modal" x-data="{
    show: @js($show),
    selectedData: [],
    focusables() {
        // All focusable element types...
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            // All non-disabled elements...
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden');
    }
})" x-on:close-all-modals.window="show = false; selectedData.length = 0;"
		x-on:close.stop="show = false; selectedData.length = 0;" x-on:keydown.escape.window="show = false; selectedData.length = 0"
		x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
		x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
		x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null" x-show="show">
		<div class="fixed inset-0 transition-all transform" x-on:click="show = false; selectedData.length = 0" x-show="show"
				x-transition:enter-end="opacity-100" x-transition:enter-start="opacity-0" x-transition:enter="ease-out duration-300"
				x-transition:leave-end="opacity-0" x-transition:leave-start="opacity-100" x-transition:leave="ease-in duration-200">
				<div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"></div>
		</div>

		<div
				class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
				x-show="show" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
				x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-transition:enter="ease-out duration-300"
				x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200">
				<div class="flex flex-row justify-between p-4">
						<h3 class="text-lg">{{ $title }}</h3>
						<button type="button" class="text-gray-600 rounded-lg w-7 h-7 hover:text-gray-400 hover:bg-gray-300"
								x-on:click="show = false; selectedData.length = 0"><x-eos-close /></button>

				</div>
				<hr class="border-gray-300">
				<div class="p-4 text-sm">{{ $slot }}</div>

				<hr class="border-gray-300">

				<div class="flex flex-row justify-end gap-4 px-4 py-2 modal-actions">
						<button
								class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
								x-on:click="show = false; $dispatch('modal-data-returned', [...selectedData]); selectedData.length = 0;">Speichern</button>
				</div>
		</div>
</div>
