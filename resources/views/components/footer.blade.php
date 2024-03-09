<footer class="flex flex-col justify-between w-full bg-gray-800 h-72">
  <div id="newsletter-container" class="max-w-6xl pt-10 mx-auto text-center">
    <p class="text-white">Du möchtest alle Neuigkeiten per Mail erhalten?<br> Dann abonniere jetzt, kostenlos,
      unseren
      Newsletter!</p>
    <form action="subscribe" method="POST" class="flex flex-row pt-2">
      <x-input id="email" class="rounded-none" type="email" name="email" :value="old('email')" required
        placeholder="E-Mail" />
      <x-button class="box-content w-full bg-black rounded-none place-content-center">
        Anmelden
      </x-button>
    </form>
  </div>
  <div class="max-w-6xl pb-2 mx-auto text-center text-white">
    <p>Erstellt von <a href="mailto:kontakt@steve-designs.de" class="hover:underline hover:text-gray-400">Stefan
        von Drehle</a> und
      Georg
      Abel</p>
    <p>Copyright © Schützenverein Kommern e.V.</p>
    {{ app()->version() }}
  </div>
</footer>
