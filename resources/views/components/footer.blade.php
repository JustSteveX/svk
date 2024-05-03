<footer class="flex flex-col justify-between w-full bg-accent-900 h-72 text-accent-50">
		<div id="newsletter-container" class="max-w-6xl pt-10 mx-auto text-center">
				<p class="text-white">Du möchtest alle neuen Beiträge per Mail erhalten?<br> Dann abonniere jetzt, kostenlos,
						unseren
						Newsletter!</p>
				<form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-row pt-2">
						@csrf
						@method('post')
						<x-input id="email" class="rounded-none bg-accent-50 text-accent-900" type="email" name="email" :value="old('email')" required
								placeholder="E-Mail" />
						<x-button class="box-content w-full rounded-none bg-primary place-content-center">
								Anmelden
						</x-button>
				</form>
		</div>
		<div class="max-w-6xl pb-2 mx-auto text-center text-white">
				<p>Erstellt von <a href="mailto:kontakt@steve-designs.de" class="text-accent-200 hover:underline hover:text-accent-50">Stefan
								von Drehle</a></p>
                <div>
                  <a class="text-accent-200 hover:text-accent-50 hover:underline" href="{{ route('impressum') }}">Impressum</a> |
                  <a class="text-accent-200 hover:text-accent-50 hover:underline" href="{{ route('datenschutz') }}">Datenschutz</a>
              </div>
				<p>Copyright © {{ date('Y') }} Schützenverein Kommern e.V. Alle Rechte vorbehalten.</p>

				v{{ app()->version() }}
				@if (!Auth::check())
						<a class="text-accent-200 hover:underline hover:text-accent-50"
								href="/login">{{ __('navigation.tologin') }}</a>
				@endif

		</div>
</footer>
