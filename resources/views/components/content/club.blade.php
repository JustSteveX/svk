<x-app-layout>

		<div class="min-h-screen mx-auto bg-slate-300 max-w-7xl">
				<nav aria-label="Breadcrumb" class="flex pt-4">
						<ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">

								@foreach ($subpage->allParentPages(true) as $parentPage)
										@if ($parentPage->parent_id === null)
												<li>
														<div class="flex items-center">
																<a class="text-sm font-medium text-gray-700 ms-1 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
																		href="{{ $parentPage->getUrlPath() }}">Übersicht</a>
														</div>
												</li>
										@else
												<li aria-current="page">
														<div class="flex items-center">
																<svg aria-hidden="true" class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" fill="none"
																		viewBox="0 0 6 10" xmlns="http://www.w3.org/2000/svg">
																		<path d="m1 9 4-4-4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
																				stroke="currentColor" />
																</svg>
																<!-- wenn es der aktuelle pfad ist, sollte dieser den span anwenden
																<span
																		class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400"></span> -->
																<a class="text-sm font-medium text-gray-700 ms-1 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
																		href="{{ $parentPage->getUrlPath() }}">{{ $parentPage->title }}</a>
														</div>
												</li>
										@endif
								@endforeach
						</ol>
				</nav>

				<hr class="my-4">
				<div class="px-4 pb-4">
						<div class="min-w-full prose">
								{{ new Illuminate\Support\HtmlString(Str::of($subpage->content)->markdown(['html_input' => 'escape', 'allow_unsafe_links' => true])) }}
						</div>
				</div>

		</div>

</x-app-layout>
