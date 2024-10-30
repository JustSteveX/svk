<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="{{ csrf_token() }}" name="csrf-token">
		<meta content="JustSteve" name="author">

		<title>{{ config('app.name', 'Laravel') }}</title>

    @bukStyles(true)
		<!-- vite assets --->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
		<div class="min-h-screen bg-fixed bg-center bg-no-repeat bg-auto" style="background-image: url({{ asset('images/schuetzenhaus.jpg') }})">
				@include('components.navigation')

				<!-- Page Content -->
				<main>
						{{ $slot }}
				</main>
		</div>
    @if(session()->has('error') || $errors->any() || session()->has('success'))
      @include('components.alert')
    @endif
    @include('components.modals.imageview')
    @include('components.modals.album')
		@include('components.footer')
    @bukScripts(true)
</body>

</html>
