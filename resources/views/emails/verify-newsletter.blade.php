<!DOCTYPE html>
<html>

<head>
  <title>Newsletter Schützenverein Kommern</title>
</head>

<body>
  <p>Vielen Dank, dass Sie sich für unseren Newsletter interessieren!</p>
  <p>Sie müssen nur noch Ihre Email-Adresse bestätigen.</p>
  <a href="{{ url(route('newsletter.verify', ['token' => $token])) }}" style="padding: 8px 16px; color: white; background-color: #357960; text-decoration: none;">
    JETZT EMAIL BESTÄTIGEN
  </a>

  <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

  <p style="font-size: 14px; color: #666;">
    Dies ist eine automatisch generierte E-Mail – bitte nicht darauf antworten. Falls Sie diese E-Mail irrtümlich erhalten haben und sich nicht für unseren Newsletter angemeldet haben, können Sie sie einfach ignorieren.
  </p>

  <p style="font-size: 14px; color: #666;">
    Bei weiteren Fragen besuchen Sie bitte unsere Website oder wenden Sie sich direkt an uns.
  </p>
</body>

</html>
