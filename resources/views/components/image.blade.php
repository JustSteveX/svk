@props([$imageUrl => ''])
<div class="relative overflow-hidden">
  <img class="object-cover w-full h-full" src="{{ asset($imageUrl) }}" alt="no image found">
  <!-- Bild soll modal öffnen, dafür muss das modal noch aufgeräumt werden. -->
</div>
