<h2 class="text-base md:text-sm">Alle Newsletter-Abonnenten im Überblick</h2>
<hr>
<div class="my-4 rounded-lg">
@foreach ($subscriberList as $subscriberItem)
  <div class="flex flex-col items-start justify-between gap-4 px-8 py-4 my-1 md:gap-0 md:items-end md:flex-row text-accent-50 bg-accent-900">
    <div class="flex flex-col md:items-center md:flex-row">
      <p class="mr-4 font-semibold">{{$subscriberItem->email}}</p>
      <span class="text-xs">({{$subscriberItem->email_verified_at ? 'verifiziert' : 'nicht verifiziert'}})</span>
    </div>
    <div>
      @if(!$subscriberItem->email_verified_at)
        <a class="text-sm text-accent-200 hover:text-accent-50 hover:underline" href="{{ url(route('newsletter.resend', ['email'=> $subscriberItem->email])) }}">Mail erneut senden</a>
      @else
        <a class="text-sm text-accent-200 hover:text-accent-50 hover:underline" href="{{ url(route('newsletter.unsubscribe', ['email'=> $subscriberItem->email, 'token' => $subscriberItem->token])) }}">Vom Newsletter abmelden</a>
      @endif
    </div>
  </div>
@endforeach
</div>
