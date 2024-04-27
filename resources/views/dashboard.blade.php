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

								<x-dashboard.blogposts :blogpostList="$blogpostList" :albumList="$albumList" :mediaList="$mediaList"></x-dashboard.blogposts>

						</div>
						<div aria-labelledby="club-tab" class="hidden p-4 rounded-lg " id="club" role="tabpanel">

								<x-dashboard.club :subpageList="$subpageList" :mediaList="$mediaList"></x-dashboard.club>

						</div>
						<div aria-labelledby="media-tab" class="hidden p-4 rounded-lg " id="media" role="tabpanel">

								<x-dashboard.media :albumList="$albumList" :mediaList="$mediaList"></x-dashboard.media>

						</div>

						<div aria-labelledby="event-tab" class="hidden p-4 rounded-lg " id="event" role="tabpanel">

								<x-dashboard.events :eventList="$eventList"></x-dashboard.events>

						</div>
						<div aria-labelledby="email-tab" class="hidden p-4 rounded-lg " id="email" role="tabpanel">

								<x-dashboard.subscriber></x-dashboard.subscriber>

						</div>

						<div aria-labelledby="users-tab" class="hidden p-4 rounded-lg " id="users" role="tabpanel">

								<x-dashboard.users></x-dashboard.users>

						</div>
				</div>
		</div>
</x-app-layout>
