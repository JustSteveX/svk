<x-app-layout>
  <div class="pt-20">
		<div class="min-h-screen m-auto max-w-7xl bg-accent-50">
				<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
						<ul class="flex flex-wrap -mb-px text-sm font-medium text-center" data-tabs-toggle="#default-tab-content"
								id="default-tab" role="tablist">
                @if(Auth::user()->role->hasPermission('manage_startpage'))
								<li class="me-2" role="presentation">
										<button aria-controls="home" aria-selected="{{ request()->get('tab') === 'home' || !!request()->get('tab') ? 'true' : 'false' }}" class="inline-block p-4 border-b-2 rounded-t-lg"
												data-tabs-target="#home" id="home-tab" role="tab" type="button">Startseite</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_blogposts'))
								<li class="me-2" role="presentation">
										<button aria-controls="blogpost" aria-selected="{{ request()->get('tab') === 'blogpost' ? 'true' : 'false' }}"
												class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
												data-tabs-target="#blogpost" id="blogpost-tab" role="tab" type="button">Beiträge</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_club_pages'))
								<li class="me-2" role="presentation">
										<button aria-controls="club" aria-selected="{{ request()->get('tab') === 'club' ? 'true' : 'false' }}"
												class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
												data-tabs-target="#club" id="club-tab" role="tab" type="button">Vereinsinfos</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_media'))
								<li role="presentation">
										<button aria-controls="media" aria-selected="{{ request()->get('tab') === 'media' ? 'true' : 'false' }}"
												class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
												data-tabs-target="#media" id="media-tab" role="tab" type="button">Medien / Dateien</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_events'))
								<li role="presentation">
										<button aria-controls="event" aria-selected="{{ request()->get('tab') === 'events' ? 'true' : 'false' }}"
												class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
												data-tabs-target="#event" id="event-tab" role="tab" type="button">Termine</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_subscribers'))
								<li role="presentation">
										<button aria-controls="email" aria-selected="{{ request()->get('tab') === 'subscribers' ? 'true' : 'false' }}"
												class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
												data-tabs-target="#email" id="email-tab" role="tab" type="button">Abonennten</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_users') || Auth::user()->role->hasPermission('manage_roles'))
								<li role="presentation">
										<button aria-controls="users" aria-selected="{{ request()->get('tab') === 'users' ? 'true' : 'false' }}"
												class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
												data-tabs-target="#users" id="users-tab" role="tab" type="button">Benutzer & Rollen</button>
								</li>
                @endif
                @if(Auth::user()->role->hasPermission('manage_contacts'))
                <li role="presentation">
                  <button aria-controls="contact" aria-selected="{{ request()->get('tab') === 'contacts' ? 'true' : 'false' }}"
                      class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                      data-tabs-target="#contact" id="contact-tab" role="tab" type="button">Kontakte</button>
                </li>
                @endif
						</ul>
				</div>
				<div id="default-tab-content">
            @if(Auth::user()->role->hasPermission('manage_startpage'))
						<div aria-labelledby="home-tab" class="hidden p-4 rounded-lg" id="home" role="tabpanel">

                <x-dashboard.startpage :configList="$configList" :albumList="$albumList" :blogpostList="$blogpostList" :mediaList="$mediaList"></x-dashboard.startpage>
						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_blogposts'))
						<div aria-labelledby="blogpost-tab" class="hidden p-4 rounded-lg" id="blogpost" role="tabpanel">

								<x-dashboard.blogposts :blogpostList="$blogpostList" :albumList="$albumList" :mediaList="$mediaList"></x-dashboard.blogposts>

						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_club_pages'))
						<div aria-labelledby="club-tab" class="hidden p-4 rounded-lg " id="club" role="tabpanel">

								<x-dashboard.club :subpageList="$subpageList" :mediaList="$mediaList"></x-dashboard.club>

						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_media'))
						<div aria-labelledby="media-tab" class="hidden p-4 rounded-lg " id="media" role="tabpanel">

								<x-dashboard.media :albumList="$albumList" :mediaList="$mediaList"></x-dashboard.media>

						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_events'))
						<div aria-labelledby="event-tab" class="hidden p-4 rounded-lg " id="event" role="tabpanel">

								<x-dashboard.events :eventList="$eventList"></x-dashboard.events>

						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_subscribers'))
						<div aria-labelledby="email-tab" class="hidden p-4 rounded-lg " id="email" role="tabpanel">

								<x-dashboard.subscriber :subscriberList="$subscriberList"></x-dashboard.subscriber>

						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_users') || Auth::user()->role->hasPermission('manage_roles'))
						<div aria-labelledby="users-tab" class="hidden p-4 rounded-lg" id="users" role="tabpanel">

                <div class="flex flex-col gap-8">
                  @if(Auth::user()->role->hasPermission('manage_roles'))
                  <x-dashboard.roles :roleList="$roleList"></x-dashboard.roles>
                  @endif
                  @if(Auth::user()->role->hasPermission('manage_users'))
                  <x-dashboard.users :roleList="$roleList" :invitationList="$invitationList" :userList="$userList"></x-dashboard.users>
                  @endif
                </div>
						</div>
            @endif
            @if(Auth::user()->role->hasPermission('manage_contacts'))
            <div aria-labelledby="contacts-tab" class="hidden p-4 rounded-lg " id="contact" role="tabpanel">

              <x-dashboard.contacts :contactList="$contactList"></x-dashboard.contacts>

            </div>
            @endif
				</div>
		</div>
  </div>
</x-app-layout>
