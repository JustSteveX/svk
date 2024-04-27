<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="{{ csrf_token() }}" name="csrf-token">
		<meta content="JustSteve" name="author">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

		<!-- vite assets --->
		@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/svk.js'])

		<!-- Scripts -->
		<link href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>

<body class="font-sans antialiased">
		<div class="min-h-screen bg-gray-100">
				@include('components.navigation')

				<!-- Page Content -->
				<main>
						{{ $slot }}
				</main>
		</div>
    @include('components.alert')
		@include('components.footer')
</body>

</html>
