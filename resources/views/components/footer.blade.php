<footer class="flex flex-col justify-between w-full px-2 bg-accent-900 h-72 text-accent-50">
		<div id="newsletter-container" class="w-full max-w-sm pt-10 mx-auto text-center">
				<p class="text-sm text-white md:text-base">Du möchtest alle neuen Beiträge per Mail erhalten?<br> Dann abonniere jetzt, kostenlos,
						unseren
						Newsletter!</p>
				<form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-row pt-2 text-sm">
						@csrf
						@method('post')
						<x-input id="email" class="w-full px-2 py-1 text-sm rounded-none md:text-base md:py-2 md:px-3 bg-accent-50 text-accent-900" type="email" name="email" :value="old('email')" required
								placeholder="E-Mail" />
						<x-button class="box-content text-sm rounded-none md:text-base bg-primary place-content-center w-fit">
								Anmelden
						</x-button>
				</form>
		</div>
		<div class="max-w-sm pb-2 mx-auto text-xs font-extrabold text-left text-white md:text-sm">
				<p>Erstellt von <a href="mailto:kontakt@steve-designs.de" class="text-accent-200 hover:underline hover:text-accent-50">Stefan
								von Drehle</a></p>

				<p>© {{ date('Y') }} Schützenverein Kommern e.V. Alle Rechte vorbehalten.</p>

        <ul class="flex list-['|'] justify-between">
          <li class="hidden list-none md:block"><p>v{{ app()->version() }}</p></li>
          <li class="list-none md:list-['|']"><a class="text-accent-200 hover:text-accent-50 hover:underline" href="{{ route('impressum') }}">Impressum</a></li>
          <li class=""><a class="text-accent-200 hover:text-accent-50 hover:underline" href="{{ route('datenschutz') }}">Datenschutz</a></li>
          <li class="">
            @if (!Auth::check())
              <a class="text-accent-200 hover:underline hover:text-accent-50"
                  href="/login">{{ __('navigation.tologin') }}</a>
            @else
                <!-- Authentication -->
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  @method('post')
                  <a href="{{route('logout')}}" class="text-accent-200 hover:text-accent-50 hover:underline" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Abmelden') }}</a>
              </form>
            @endif
          </li>
        </ul>


		</div>
</footer>
