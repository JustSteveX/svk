<!DOCTYPE html>
<html>

<head>
  <title>Newsletter Schützenverein Kommern</title>
</head>

<body>
  <h1>{{ $title }}</h1>
  <p>Erstellt von: {{ $author }} am {{ $created_at->format('d.m.Y') }}</p>
  <p>{{ $content }}</p>
</body>

</html>
