<nav class="bg-white border-b border-gray-100 drop-shadow-2xl" x-data="{ open: false }">
		<!-- Primary Navigation Menu -->
		<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div class="flex justify-between h-20">
						<div class="flex mx-auto">

								<!-- Navigation Links -->
								<div class="hidden space-x-16 text-lg sm:-my-px sm:ml-10 sm:flex">
										<x-nav-link :active="request()->routeIs('startseite')" :href="route('startseite')">
												Startseite
										</x-nav-link>
										<x-nav-link :active="request()->routeIs('aktuelles')" :href="route('aktuelles')">
												Aktuelles
										</x-nav-link>
										<x-nav-link :active="request()->routeIs('verein')" :href="route('verein')">
												Verein
										</x-nav-link>
										<x-nav-link :active="Str::startsWith(request()->path(), 'galerie')" :href="route('galerie')">
												Galerie
										</x-nav-link>
										<x-nav-link :active="request()->routeIs('termine')" :href="route('termine')">
												Termine
										</x-nav-link>
										<x-nav-link :active="request()->routeIs('kontakt')" :href="route('kontakt')">
												Kontakt
										</x-nav-link>
										@if (Auth::check())
												<x-nav-link :active="request()->routeIs('dashboard')" :href="route('dashboard')">
														Dashboard
												</x-nav-link>
										@endif
								</div>
						</div>

						@auth
								<!-- Settings Dropdown -->
								<div class="hidden sm:flex sm:items-center sm:ml-6">
										<x-dropdown align="right" width="48">
												<x-slot name="trigger">
														<button
																class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
																<div>{{ Auth::user()->name }}</div>

																<div class="ml-1">
																		<svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
																				<path clip-rule="evenodd"
																						d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
																						fill-rule="evenodd" />
																		</svg>
																</div>
														</button>
												</x-slot>

												<x-slot name="content">
														<x-dropdown-link :active="request()->routeIs('dashboard')" :href="route('dashboard')">
																{{ __('Dashboard') }}
														</x-dropdown-link>

														<!-- Authentication -->
														<form action="{{ route('logout') }}" method="POST">
																@csrf
																<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
																		{{ __('Abmelden') }}
																</x-dropdown-link>
														</form>
												</x-slot>
										</x-dropdown>
								</div>
						@endauth

						<!-- Hamburger -->
						<div class="flex items-center -mr-2 sm:hidden">
								<button @click="open = ! open"
										class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
										<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" d="M4 6h16M4 12h16M4 18h16"
														stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
												<path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" d="M6 18L18 6M6 6l12 12"
														stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
										</svg>
								</button>
						</div>
				</div>
		</div>

		<!-- Responsive Navigation Menu -->
		<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
				@auth

						<div class="pt-2 pb-3 space-y-1">
								<x-responsive-nav-link :active="request()->routeIs('dashboard')" :href="route('dashboard')">
										{{ __('Dashboard') }}
								</x-responsive-nav-link>
						</div>
						<!-- Responsive Settings Options -->
						<div class="pt-4 pb-1 border-t border-gray-200">
								<div class="px-4">
										<div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
										<div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
								</div>

								<div class="mt-3 space-y-1">
										<!-- Authentication -->
										<form action="{{ route('logout') }}" method="POST">
												@csrf

												<x-responsive-nav-link :href="route('logout')"
														onclick="event.preventDefault();
                                        this.closest('form').submit();">
														{{ __('Abmelden') }}
												</x-responsive-nav-link>
										</form>
								</div>
						</div>
						@endif
				</div>
		</nav>
