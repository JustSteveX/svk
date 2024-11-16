<footer class="py-8 text-gray-100 bg-primary">
  <div class="container px-4 mx-auto">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

          <!-- Newsletter-Anmeldung -->
          <div class="col-span-1 md:col-span-2">
              <h3 class="mb-4 text-xl font-semibold">Newsletter Anmeldung</h3>
              <p class="mb-4">Melden Sie sich zu unserem Newsletter an und bleiben Sie informiert!</p>
              <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-2 md:flex-row">
                  @csrf
                  <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}" name="g-recaptcha-response"></div>
                  <input type="email" name="email" placeholder="Ihre E-Mail-Adresse" required
                      class="flex-grow w-full p-2 text-slate-700 bg-accent-50 md:w-auto focus:outline-none focus:ring-2 focus:ring-accent">
                  <x-accent-button type="submit" class="text-lg font-semibold rounded-none">Anmelden</x-accent-button>
              </form>
          </div>

          <!-- Links -->
          <div class="flex flex-col mt-8 space-y-2 md:mt-0">
              <a href="{{ route('impressum') }}" class="hover:underline w-fit">Impressum</a>
              <a href="{{ route('datenschutz') }}" class="hover:underline w-fit">Datenschutz</a>

              @if (!Auth::check())
                <a class="hover:underline w-fit" href="{{ route('login') }}">{{ __('navigation.tologin') }}</a>
              @else
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('post')
                    <a href="{{route('logout')}}" class="hover:underline w-fit" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Abmelden') }}</a>
                </form>
              @endif
          </div>
      </div>

      <!-- Copyright -->
      <div class="pt-8 mt-8 text-sm text-center border-t border-accent-700">
          © {{ date('Y') }} Schützenverein Kommern e.V. Alle Rechte vorbehalten.<br>
          Erstellt von <a href="mailto:kontakt@steve-designs.de" class="text-accent-200 hover:underline">Stefan von Drehle</a>
      </div>
  </div>
</footer>
