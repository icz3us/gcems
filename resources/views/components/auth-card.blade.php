@props(['title'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'GC-EMS') }} - {{ $title }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-50 px-4 py-6 text-gray-900 font-sans selection:bg-green-100 selection:text-green-900">
        <main class="mx-auto flex min-h-[calc(100vh-3rem)] w-full max-w-md flex-col justify-center">
            <div class="mb-8 flex flex-col items-center">
                <a href="{{ url('/') }}" class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center text-white mb-4 shadow-sm hover:scale-105 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </a>
                <h1 class="text-2xl font-black text-black tracking-tight text-center">{{ $title }}</h1>
                <p class="text-sm font-medium text-gray-500 mt-1">Gordon College Event Management System</p>
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
