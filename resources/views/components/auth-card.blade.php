@props(['title'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'GCEP - Gordon College Event Portal') }} - {{ $title }}</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/gcef1.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-50 px-4 py-6 text-gray-900 font-sans selection:bg-green-100 selection:text-green-900">
        <main class="mx-auto flex min-h-[calc(100vh-3rem)] w-full max-w-md flex-col justify-center">
            <div class="mb-8 flex flex-col items-center">
                <a href="{{ url('/') }}" class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-4 shadow-sm hover:scale-105 transition-transform overflow-hidden p-1">
                    <img src="{{ asset('assets/gclogo.png') }}" alt="Gordon College Logo" class="w-full h-full object-contain">
                </a>
                <h1 class="text-2xl font-black text-black tracking-tight text-center">{{ $title }}</h1>
                <p class="text-sm font-medium text-gray-500 mt-1">Gordon College Event Portal</p>
            </div>
            
            <div class="rounded-2xl border border-gray-100 bg-white p-6 sm:p-8 shadow-sm">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors font-medium">
                    &larr; Back to Home
                </a>
            </div>
        </main>
    </body>
</html>
