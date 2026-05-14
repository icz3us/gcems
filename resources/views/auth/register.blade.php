<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GCEP - Sign-Up</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans text-zinc-900 antialiased bg-white flex">
    <div class="hidden lg:flex w-1/2 relative bg-green-900 overflow-hidden items-center justify-center">
        <div class="absolute inset-0">
            <img src="{{ asset('assets/gc.jpg') }}" alt="Background" class="object-cover w-full h-full opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-green-950/90 via-green-900/60 to-green-800/10"></div>
        </div>

        <div class="relative z-10 p-12 text-center text-white max-w-lg">
            <img src="{{ asset('assets/gclogo.png') }}" onerror="this.style.display='none'" alt="Gordon College"
                class="w-32 h-32 mx-auto mb-8 drop-shadow-2xl">
            <h1 class="text-4xl font-extrabold tracking-tight mb-4 drop-shadow">Gordon College Event Portal</h1>
            <p class="text-green-100 text-lg">Create an account to join events, register for activities, and get
                involved.</p>
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

        <div class="w-full max-w-md my-auto pt-12 lg:pt-0">
            <h2 class="text-3xl font-extrabold text-zinc-900 mb-2">Sign up for an account</h2>
            <p class="text-zinc-500 mb-8">Fill out the details below to complete your registration</p>

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-100 p-4 text-sm text-red-600 font-medium">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1.5">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Juan Dela Cruz" required
                        class="w-full border border-zinc-300 focus:border-green-600 focus:ring-2 focus:ring-green-600/20 rounded-xl px-4 py-3.5 text-zinc-900 placeholder-zinc-400 transition-all outline-none text-sm font-medium">
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="your-email@example.com"
                        required
                        class="w-full border border-zinc-300 focus:border-green-600 focus:ring-2 focus:ring-green-600/20 rounded-xl px-4 py-3.5 text-zinc-900 placeholder-zinc-400 transition-all outline-none text-sm font-medium">
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1.5">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full border border-zinc-300 focus:border-green-600 focus:ring-2 focus:ring-green-600/20 rounded-xl px-4 py-3.5 text-zinc-900 placeholder-zinc-400 transition-all outline-none text-sm font-medium">
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required
                        class="w-full border border-zinc-300 focus:border-green-600 focus:ring-2 focus:ring-green-600/20 rounded-xl px-4 py-3.5 text-zinc-900 placeholder-zinc-400 transition-all outline-none text-sm font-medium">
                </div>

                <div class="flex items-start gap-3">
                    <input type="checkbox" id="termsCheck" required
                        class="mt-1 rounded border-zinc-300 text-green-600 focus:ring-green-600 focus:ring-2 cursor-pointer w-4 h-4">
                    <label for="termsCheck" class="text-sm text-zinc-600 cursor-pointer">
                        By creating this account, you agree to our <a href="{{ route('terms') }}" target="_blank"
                            class="text-green-600 hover:text-green-700 font-bold hover:underline">Terms and
                            Conditions</a> and <a href="{{ route('privacy') }}" target="_blank"
                            class="text-green-600 hover:text-green-700 font-bold hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-md">
                        Sign Up
                    </button>
                </div>
            </form>

            <p class="text-center text-zinc-600 mt-6 font-medium text-sm">
                Already have an account?
                <a href="{{ route('login') }}"
                    class="text-green-600 hover:text-green-700 font-bold ml-1 hover:underline">Sign in</a>
            </p>
        </div>

        <div class="w-full flex justify-end text-xs text-zinc-400 mt-12 pt-8">
            <span>Gordon College Event Portal</span>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>