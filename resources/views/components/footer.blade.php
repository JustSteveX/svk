<footer class="w-full bg-gray-800 h-72 flex flex-col justify-between">
  <div id="newsletter-container" class="max-w-6xl mx-auto text-center pt-10">
    <p class="text-white">Du möchtest alle Neuigkeiten per Mail erhalten?<br> Dann abonniere jetzt, kostenlos,
      unseren
      Newsletter!</p>
    <form action="subscribe" method="POST" class="flex flex-row pt-2">
      <x-input id="email" class="rounded-none" type="email" name="email" :value="old('email')" required
        placeholder="E-Mail" />
      <x-button class="box-content w-full rounded-none bg-black place-content-center">
        Anmelden
      </x-button>
    </form>
  </div>
  <div class="text-center text-white mx-auto max-w-6xl pb-2">
    <p>Erstellt von <a href="mailto:stefanvdrehle@gmail.com" class="hover:underline hover:text-gray-400">Stefan
        von Drehle</a> und
      Georg
      Abel</p>
    <p>Copyright © Schützenverein Kommern e.V.</p>
    {{ app()->version() }}
  </div>
</footer>
