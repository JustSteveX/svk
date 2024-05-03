<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="{{ csrf_token() }}" name="csrf-token">
		<meta content="JustSteve" name="author">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- vite assets --->
		@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/svk.js'])

		<!-- Scripts -->
		<link href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>

<body class="font-sans antialiased">
		<div class="min-h-screen bg-fixed bg-center bg-no-repeat bg-auto bg-schuetzenhaus">
				@include('components.navigation')

				<!-- Page Content -->
				<main>
						{{ $slot }}
				</main>
		</div>
    @if(session()->has('error') || session()->has('success'))
      @include('components.alert')
    @endif
    @include('components.modals.image')
		@include('components.footer')
</body>

</html>
