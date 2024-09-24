<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="{{ csrf_token() }}" name="csrf-token">
		<meta content="JustSteve" name="author">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- vite assets --->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="relative flex justify-center min-h-screen bg-gray-900 items-top sm:items-center sm:pt-0">
  <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
        <main>
          <div class="px-4 text-lg tracking-wider text-gray-500 uppercase">{{$slot}}</div>
        </main>
      </div>
  </div>
</div>

</body>
</html>
