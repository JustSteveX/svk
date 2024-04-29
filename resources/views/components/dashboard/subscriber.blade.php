<h2 class="text-lg">Alle Newsletter-Abonnenten im Überblick</h2>
<hr>
<div class="my-4 rounded-lg">
@foreach ($subscriberList as $subscriberItem)
  <div class="flex flex-row justify-between px-8 py-4 my-1 text-gray-100 bg-gray-500">
    <div class="flex flex-row">
      <p class="mr-4 font-semibold">{{$subscriberItem->email}}</p>
      <span>({{$subscriberItem->email_verified_at ? 'verifiziert' : 'nicht verifiziert'}})</span>
    </div>
    <div>
      @if(!$subscriberItem->email_verified_at)
      <a class="text-sm hover:underline" href="{{ url(route('newsletter.resend', ['email'=> $subscriberItem->email])) }}">Mail erneut senden</a>
      @else
      <a class="text-sm hover:underline" href="{{ url(route('newsletter.unsubscribe', ['email'=> $subscriberItem->email, 'token' => $subscriberItem->token])) }}">Vom Newsletter abmelden</a>
      @endif
    </div>
  </div>
@endforeach
</div>
