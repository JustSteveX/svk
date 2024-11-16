<div class="mb-8">
  <form action="{{url(route('newsletter.clear'))}}" method="POST">
    @csrf
    @method('delete')
    <x-danger-button>Nicht verifizierte Abonnenten entfernen (>30 Tage)</x-danger-button>
  </form>
</div>
<h2 class="text-base md:text-sm">Alle Newsletter-Abonnenten im Überblick</h2>
<hr>
<div class="my-4 flex flex-col gap-2">
  @foreach ($subscriberList as $subscriberItem)
    <div class="w-full border border-gray-800 px-4 py-4 flex flex-row items-center justify-between">
      <div class="flex flex-col">
        <p class="text-sm">
          <span class="font-bold">{{$subscriberItem->email}}</span>
          <small class="{{$subscriberItem->email_verified_at ? 'text-primary' : 'text-warning'}}">({{$subscriberItem->email_verified_at ? 'verifiziert' : 'nicht verifiziert'}})</small>
        </p>
        <small class="text-neutral-500">
          Angemeldet am: {{$subscriberItem->created_at->format('d.m.Y H:i:s')}}{{$subscriberItem->email_verified_at ? ' | Verifiziert am: '.$subscriberItem->email_verified_at->format('d.m.Y H:i:s') : ''}}
        </small>
      </div>
      <div class="flex flex-col gap-2">
        @if(!$subscriberItem->email_verified_at)
          <a class="text-sm text-accent-200 hover:text-accent hover:underline" href="{{ url(route('newsletter.resend', ['email'=> $subscriberItem->email])) }}">Mail erneut senden</a>
        @endif
          <a class="text-sm text-accent-200 hover:text-accent hover:underline" href="{{ url(route('newsletter.unsubscribe', ['email'=> $subscriberItem->email, 'token' => $subscriberItem->token])) }}">Vom Newsletter abmelden</a>
      </div>
    </div>
  @endforeach
</div>
