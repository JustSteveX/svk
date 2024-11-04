<x-app-layout>
  <div class="w-full px-4 pt-20">
		<div class="min-h-screen mx-auto bg-accent-50 max-w-7xl">
      @if($subpage)
				<nav aria-label="Breadcrumb" class="flex pt-4">
						<ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
              <li>
                  <div class="flex items-center">
                      <a class="text-sm font-medium text-gray-700 ms-1 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                          href="{{ route('verein') }}">Übersicht</a>
                  </div>
              </li>
						</ol>
				</nav>

				<hr class="my-4 border-accent-200">
				<div class="px-4 pb-4">
						<div class="min-w-full prose prose-md">
              {!! Illuminate\Support\Str::of($subpage->content)->replace("\t", '&nbsp;')->markdown(['html_input'=>'strip', 'allow_unsafe_links' => true]) !!}
						</div>
				</div>
        @endif

		</div>
  </div>
</x-app-layout>
