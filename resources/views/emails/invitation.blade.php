<!DOCTYPE html>
<html>

<head>
  <title>Schützenverein Kommern</title>
</head>

<body>
  <div style="height: 100vh; display: flex; flex-direction: column; align-content: space-between">
    <div>
      <p>Du hast eine Einladung erhalten um dich auf der Seite des Schützenvereins Kommern zu registrieren</p>
      <a href="{{ url(route('register', ['invitation_token' => $invitation_token])) }}">JETZT REGISTRIEREN</a>
    </div>
  </div>
</body>

</html>
