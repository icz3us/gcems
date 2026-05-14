<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'GCEP'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .home-faq-content.open {
            grid-template-rows: 1fr;
            opacity: 1;
        }

        /* Smooth fade-in animations */
        .home-animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .home-animate-fade-in-delay {
            opacity: 0;
            animation: fadeIn 0.8s ease-out 0.3s forwards;
        }

        .home-animate-fade-in-item {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased text-gray-900 bg-white">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-green-600 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center gap-2">
                    <img src="{{ asset('assets/gcep.png') }}" alt="Gordon College Event Portal"
                        class="w-12 h-12 object-contain">
                    <span class="font-extrabold text-xl text-white hidden sm:block tracking-wide">GCEP</span>
                </a>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#portals"
                        class="text-white hover:bg-green-700  px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        Portals
                    </a>
                    <a href="#how-it-works"
                        class="text-white hover:bg-green-700  px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        How It Works
                    </a>
                    <a href="#faq"
                        class="text-white hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                        FAQ
                    </a>
                    <a href="#gallery"
                        class="text-white hover:bg-green-700 block px-4 py-2.5 rounded-lg text-base font-medium transition-colors">
                        Gallery
                    </a>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-btn" onclick="toggleMobileMenu()"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/20 transition-colors focus:outline-none"
                        aria-label="Open menu">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="md:hidden hidden overflow-hidden transition-all duration-300">
                <div class="text-center justify-center px-2 pt-2 pb-4 space-y-1 border-t border-white/20">
                    <a href="#portals" onclick="toggleMobileMenu()"
                        class="text-white hover:bg-white/20 block px-4 py-2.5 rounded-lg text-base font-medium transition-colors">
                        Portals
                    </a>
                    <a href="#how-it-works" onclick="toggleMobileMenu()"
                        class="text-white hover:bg-white/20 block px-4 py-2.5 rounded-lg text-base font-medium transition-colors">
                        How It Works
                    </a>
                    <a href="#faq" onclick="toggleMobileMenu()"
                        class="text-white hover:bg-white/20 block px-4 py-2.5 rounded-lg text-base font-medium transition-colors">
                        FAQ
                    </a>
                    <a href="#gallery" onclick="toggleMobileMenu()"
                        class="text-white hover:bg-white/20 block px-4 py-2.5 rounded-lg text-base font-medium transition-colors">
                        Gallery
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-auto border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left">
                <div>
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                        <img src="{{ asset('assets/gclogo.png') }}" alt="Gordon College Logo"
                            class="w-12 h-12 object-contain">
                        <h4 class="text-xl font-bold text-green-600">Gordon College Event Portal</h4>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Your Official Guide to Gordon College Event Portal. <br>
                        Stay informed, stay connected.
                    </p>
                    <ul class="flex flex-row justify-center md:justify-start pt-3 space-x-5">
                        <li>
                            <a href="{{ route('privacy') }}"
                                class="text-gray-400 hover:text-green-600 transition-colors text-sm underline">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}"
                                class="text-gray-400 hover:text-green-600 transition-colors text-sm underline">
                                Terms and Conditions
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold text-white mb-4 text-base uppercase tracking-wider">Quick Links</h5>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ url('#portals') }}"
                                class="text-gray-400 hover:text-green-600 transition-colors text-sm">
                                Portals
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('#how-it-works') }}"
                                class="text-gray-400 hover:text-green-600 transition-colors text-sm">
                                How It Works
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('#faq') }}"
                                class="text-gray-400 hover:text-green-600 transition-colors text-sm">
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/registration') }}"
                                class="text-gray-400 hover:text-green-600 transition-colors text-sm">
                                Sign-Up
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold text-white mb-4 text-base uppercase tracking-wider">Developed By
                        <span class="text-green-600">Powerpuff Bois </span>
                    </h5>
                    <p class="text-gray-400 text-sm leading-relaxed cursor-default">
                        Lingad <br>
                        Gonzales <br>
                        Aca-ac <br>
                        Diwa
                    </p>
                    <p class="text-gray-600 text-xs mt-4">
                        © {{ date('Y') }} Gordon College. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function homeToggleFaq(btn) {
            const panel = btn.nextElementSibling;
            const icon = btn.querySelector('i');
            const expanded = btn.getAttribute('aria-expanded') === 'true';

            btn.setAttribute('aria-expanded', !expanded);
            if (!expanded) {
                panel.classList.remove('grid-rows-[0fr]', 'opacity-0');
                panel.classList.add('grid-rows-[1fr]', 'opacity-100');
                icon.classList.add('rotate-180');
            } else {
                panel.classList.remove('grid-rows-[1fr]', 'opacity-100');
                panel.classList.add('grid-rows-[0fr]', 'opacity-0');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
    @stack('scripts')
</body>

</html>