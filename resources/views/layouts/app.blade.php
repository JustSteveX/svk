<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf-token">
  <meta content="JustSteve" name="author">

  <link href="{{ asset('favicon.svg') }}" rel="icon" type="image/svg+xml">
  <link href="{{ asset('favicon.ico') }}" rel="icon">

  <title>{{ config('app.name', 'Laravel') }}</title>

  @bukStyles(true)
  <!-- vite assets --->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-fixed bg-center bg-no-repeat bg-cover"
    style="background-image: url({{ $backgroundImageUrl }})">
    @include('components.navigation')

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>
  @if (session()->has('error') || $errors->any() || session()->has('success'))
    @include('components.alert')
  @endif
  @include('components.modal')
  @include('components.footer')
  @bukScripts(true)
</body>

</html>
