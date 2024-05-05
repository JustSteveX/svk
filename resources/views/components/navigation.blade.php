<nav class="fixed z-50 w-full bg-fixed bg-center bg-schuetzenhaus" x-data="{ open: false }">
		<!-- Primary Navigation Menu -->
		<div class="mx-auto max-w-7xl">
				<div class="flex justify-between h-20">
						<div class="flex w-full">

								<!-- Navigation Links -->
								<div class="justify-between hidden w-full text-lg sm:flex">
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

						<!-- Hamburger -->
						<div class="flex items-center mr-3 sm:hidden">
								<button @click="open = ! open"
										class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-md bg-blackish text-accent-50 hover:text-primary hover:bg-accent-50">
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
