<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GCEP - Sign-In</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/gcef1.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans text-zinc-900 antialiased bg-white flex">
    <div class="hidden lg:flex w-1/2 relative bg-green-900 overflow-hidden items-center justify-center">
        <div class="absolute inset-0">
            <img src="{{ asset('assets/gc.jpg') }}" alt="Background" class="object-cover w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-green-950/90 via-green-900/60 to-green-800/10"></div>
        </div>

        <div class="relative z-10 p-12 text-center text-white max-w-lg">
            <img src="{{ asset('assets/gcep.png') }}" onerror="this.style.display='none'" alt="Gordon College"
                class="w-32 h-32 mx-auto mb-8 drop-shadow-2xl">
            <h1 class="text-4xl font-extrabold tracking-tight mb-4 drop-shadow">Gordon College Event Portal</h1>
            <p class="text-green-100 text-lg">Discover events, register for activities, and manage your schedule easily.
            </p>
        </div>
    </div>
    <div
        class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 md:p-12 relative min-h-screen overflow-y-auto">
        <div class="absolute top-8 left-8">
            <a href="{{ route('landing') }}"
                class="inline-flex items-center gap-2 text-zinc-500 hover:text-green-700 transition-colors font-medium text-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Home
            </a>
        </div>

        <div class="w-full max-w-md my-auto">
            @php
                $currentPortal = request()->query('portal', 'student');
            @endphp

            <h2 class="text-3xl font-extrabold text-zinc-900 mb-2">
                @if($currentPortal === 'admin')
                    Admin Login
                @elseif($currentPortal === 'superadmin')
                    Super Admin Login
                @else
                    Student Login
                @endif
            </h2>
            <p class="text-zinc-500 mb-8">Enter your credentials to access the portal</p>

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-100 p-4 text-sm text-red-600 font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required
                        class="w-full border border-zinc-300 focus:border-green-600 focus:ring-2 focus:ring-green-600/20 rounded-xl px-4 py-3 text-zinc-900 placeholder-zinc-400 transition-all outline-none text-sm font-medium">
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1.5">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full border border-zinc-300 focus:border-green-600 focus:ring-2 focus:ring-green-600/20 rounded-xl px-4 py-3 text-zinc-900 placeholder-zinc-400 transition-all outline-none text-sm font-medium">
                </div>

                <button
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-md">
                    Sign In
                </button>
            </form>

            <div class="mt-6 rounded-2xl border border-green-100 bg-green-50/60 p-5 shadow-sm">
                <div class="text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-green-700">Switch Portal</p>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">
                        Select the login page that matches your account role.
                    </p>
                </div>

                <div class="mt-4 flex flex-wrap justify-center gap-3 text-sm font-bold">
                    @if($currentPortal !== 'student')
                        <a href="{{ route('login') }}"
                            class="inline-flex min-w-32 items-center justify-center gap-2 whitespace-nowrap rounded-xl border border-zinc-200 bg-white px-5 py-3 text-zinc-700 transition-colors hover:border-green-300 hover:bg-white hover:text-green-700">
                            <i data-lucide="graduation-cap" class="h-4 w-4"></i>
                            Student
                        </a>
                    @endif
                    @if($currentPortal !== 'admin')
                        <a href="{{ route('login', ['portal' => 'admin']) }}"
                            class="inline-flex min-w-32 items-center justify-center gap-2 whitespace-nowrap rounded-xl border border-zinc-200 bg-white px-5 py-3 text-zinc-700 transition-colors hover:border-green-300 hover:bg-white hover:text-green-700">
                            <i data-lucide="calendar-plus" class="h-4 w-4"></i>
                            Admin
                        </a>
                    @endif
                    @if($currentPortal !== 'superadmin')
                        <a href="{{ route('login', ['portal' => 'superadmin']) }}"
                            class="inline-flex min-w-32 items-center justify-center gap-2 whitespace-nowrap rounded-xl border border-zinc-200 bg-white px-5 py-3 text-zinc-700 transition-colors hover:border-green-300 hover:bg-white hover:text-green-700">
                            <i data-lucide="shield-check" class="h-4 w-4"></i>
                            Super Admin
                        </a>
                    @endif
                </div>
            </div>

            @if($currentPortal === 'student')
                <p class="text-center text-zinc-600 mt-8 font-medium text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="text-green-600 hover:text-green-700 font-bold ml-1 hover:underline">Sign up</a>
                </p>
            @endif
        </div>

        <div class="w-full flex justify-between text-xs text-zinc-600 mt-auto pt-8">
            <div class="flex gap-4">
                <a href="{{ route('privacy') }}" class="hover:text-green-600 transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-green-600 transition-colors">Terms of Service</a>
            </div>
            <span>@Gordon College Event Portal</span>
        </div>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
