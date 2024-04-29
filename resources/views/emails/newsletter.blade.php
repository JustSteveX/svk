<!DOCTYPE html>
<html>

<head>
  <title>Newsletter Schützenverein Kommern</title>
</head>

<body>
  <div style="height: 100vh; display: flex; flex-direction: column; align-content: space-between">
    <div>
      <h3>{{ $title }}</h3>
      <p>Erstellt von: {{ $author }} am {{ $created_at->format('d.m.Y') }}</p>
      <hr>
      <p>{{ $content }}</p>
    </div>
    <div>
      <hr>
      <p class="font-size: 10px">Du willst dich von unserem Newsletter <a href="{{ url(route('newsletter.unsubscribe', ['email'=>$email, 'token' => $token])) }}">abmelden</a>?</p>
    </div>
  </div>
</body>

</html>
