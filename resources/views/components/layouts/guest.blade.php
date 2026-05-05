<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GC-EMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js (if not bundled, though typically included in Laravel) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans text-slate-950 antialiased bg-white flex flex-col min-h-screen selection:bg-green-100 selection:text-green-900">
    <!-- Navbar -->
    <nav x-data="{ open: false }" class="bg-white/95 backdrop-blur border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-14">
                <div class="flex items-center gap-8">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-sm font-black tracking-tight text-slate-950 flex items-center gap-2">
                            <div class="w-8 h-8 bg-[#007a34] rounded-xl flex items-center justify-center text-white shadow-md shadow-green-700/15">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            GC-EMS
                        </a>
                    </div>
                    <div class="hidden md:flex items-center gap-6 text-xs font-semibold text-slate-600">
                        <a href="{{ url('/') }}" class="border-b-2 border-[#007a34] py-5 text-slate-950">Home</a>
                        <a href="#events" class="py-5 hover:text-[#007a34]">Browse Events</a>
                        <a href="#platform" class="py-5 hover:text-[#007a34]">Workflows</a>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                    <div class="relative hidden lg:block">
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input class="gc-input h-8 w-64 rounded-lg pl-9 pr-3 text-xs" type="search" placeholder="Search events...">
                    </div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-lg bg-[#007a34] px-4 py-2 text-xs font-bold text-white shadow-sm hover:bg-[#00662b] transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-600 hover:text-[#007a34] transition-colors">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-lg bg-[#007a34] px-4 py-2 text-xs font-bold text-white shadow-sm hover:bg-[#00662b] transition-colors">Sign in</a>
                        @endif
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 bg-white">
            <div class="pt-2 pb-3 space-y-1">
                @auth
                    <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 hover:border-green-600 transition duration-150 ease-in-out">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-green-600 hover:bg-green-50 hover:border-green-600 transition duration-150 ease-in-out">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-green-600 hover:text-green-700 hover:bg-green-50 hover:border-green-600 transition duration-150 ease-in-out">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#070d1d] py-12 mt-auto text-slate-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-4">
                <div>
                    <p class="text-sm font-black text-white">GC-EMS</p>
                    <p class="mt-4 max-w-xs text-sm leading-6 text-slate-400">Campus event coordination for Gordon College.</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-white">System</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-400">
                        <a href="#events" class="block hover:text-white">Browse Events</a>
                        <a href="{{ route('login') }}" class="block hover:text-white">Portal Login</a>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-white">Help</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-400">
                        <a href="#" class="block hover:text-white">Documentation</a>
                        <a href="#" class="block hover:text-white">Support Desk</a>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-white">Legal</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-400">
                        <a href="#" class="block hover:text-white">Privacy Policy</a>
                        <a href="#" class="block hover:text-white">Terms of Use</a>
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-white/10 pt-6 text-xs text-slate-500">
                &copy; {{ date('Y') }} Gordon College Event Management System. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
