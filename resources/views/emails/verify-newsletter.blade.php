<!DOCTYPE html>
<html>

<head>
  <title>Newsletter Schützenverein Kommern</title>
</head>

<body>
  <p>Vielen Dank, dass Sie sich für unseren Newsletter interessieren!</p>
  <p>Sie müssen nur noch Ihre Email Adresse bestätigen</p>
  <a href="{{ url(route('newsletter.verify', ['token' => $token])) }}" style="padding: 8px 16px; color: white; background-color: #357960">JETZT EMAIL BESTÄTIGEN</a>
</body>

</html>
