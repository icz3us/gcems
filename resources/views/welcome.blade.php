@extends('layouts.app')
@section('title', 'GCEP - Gordon College Event Portal')
@push('styles')
    <style>
        .home-hero-bg {
            background:
                linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)),
                url('{{ asset('assets/gc.jpg') }}') center / cover no-repeat;
        }

        .home-bg {
            background:
                linear-gradient(rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.45)),
                url('{{ asset('assets/regCTA.jpg') }}') center / cover;
        }
    </style>
@endpush
@section('content')
    <header class="home-hero-bg relative overflow-hidden min-h-screen flex items-center text-white">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center w-full">
            <div class="home-animate-fade-in">
                <div class="flex justify-center mb-8">
                    <div
                        class="w-26 h-26 rounded-full overflow-hidden shadow-2xl border-4 border-white/80 bg-white flex items-center justify-center">
                        <img src="{{ asset('assets/gcep.png') }}" alt="Gordon College Logo"
                            class="w-25 h-25 object-contain">
                    </div>
                </div>

                <h1 class="text-6xl md:text-7xl font-black mb-4 drop-shadow-lg tracking-tight">GCEP</h1>
                <h2 class="text-2xl md:text-3xl font-semibold mb-6 leading-tight text-white/90">
                    Welcome to the Gordon College Event Portal
                </h2>
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    Your gateway to all school events, schedules, and activities.<br>
                    Stay informed and connected with us.
                </p>

            </div>

            <div class="mt-10 home-animate-fade-in-delay">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-3 bg-gradient-to-r from-green-800 to-emerald-600 hover:from-green-500 hover:to-emerald-400 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all duration-300 shadow-[0_8px_20px_rgba(34,197,94,0.4)] hover:shadow-[0_12px_25px_rgba(34,197,94,0.6)]">
                    <span>Sign up for Upcoming Events</span>
                </a>
            </div>
            <p class="text-md md:text-xs text-white/80 max-w-2xl mx-auto leading-relaxed mt-8">Sign up now to view upcoming
                activities,seminars, and school events!</p>
        </div>
    </header>
    <main id="portals" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

        <div class="text-center mb-14 home-animate-fade-in-delay">
            <h3 class="text-3xl font-bold text-gray-900 mb-3">Select Your Portal</h3>
            <p class="text-lg text-gray-500 max-w-xl mx-auto">
                Access features designed for students and administrators.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $portals = [
                    [
                        'href' => route('login'),
                        'icon' => 'fa-user-graduate',
                        'label' => 'Student Portal',
                        'desc' => 'Discover events, register for activities, and manage your schedule easily!',
                    ],
                    [
                        'href' => route('login', ['portal' => 'admin']),
                        'icon' => 'fa-cog',
                        'label' => 'Admin Portal',
                        'desc' => 'Full control over event management, user access, and system configurations.',
                    ],
                    [
                        'href' => route('login', ['portal' => 'superadmin']),
                        'icon' => 'fa-user-shield',
                        'label' => 'Super Admin Portal',
                        'desc' => 'Highest level access for system overrides, role management, and logs.',
                    ],
                ];
            @endphp

            @foreach ($portals as $portal)
                <a href="{{ $portal['href'] }}"
                    class="group block bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-400 ease-in-out border border-gray-100 home-animate-fade-in-item">
                    <div class="p-8 text-center">
                        <div
                            class="mx-auto mb-5 p-4 bg-white rounded-2xl w-20 h-20 flex items-center justify-center transition-colors">
                            <i class="fas {{ $portal['icon'] }} text-3xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600">
                            {{ $portal['label'] }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            {{ $portal['desc'] }}
                        </p>
                    </div>
                </a>
            @endforeach

        </div>
    </main>
    <section id="how-it-works" class="home-bg relative overflow-hidden min-h-[34rem] flex items-center text-white">
        <div class="max-w-7xl mx-auto px-4 py-5 sm:px-6 lg:px-8">

            <div class="text-center mb-14">
                <h3 class="text-3xl font-bold text-gray-100 mb-3">How It Works</h3>
                <p class="text-lg text-gray-400 max-w-xl mx-auto">Get started in four simple steps.</p>
            </div>

            @php
                $steps = [
                    ['icon' => 'fa-user-plus', 'title' => 'Register', 'desc' => 'Create your account using your official school credentials to get started.'],
                    ['icon' => 'fa-sign-in-alt', 'title' => 'Login', 'desc' => 'Access your personalized portal to see features tailored for you.'],
                    ['icon' => 'fa-search', 'title' => 'Browse Events', 'desc' => 'Explore the event feed to find upcoming school activities, seminars, and more.'],
                    ['icon' => 'fa-check', 'title' => 'Join & Participate', 'desc' => 'Join an event and enjoy the experience.'],
                ];
            @endphp

            <div class="flex flex-col lg:flex-row lg:flex-nowrap items-stretch justify-center gap-y-8 gap-x-4">

                @foreach ($steps as $index => $step)

                    <div class="relative text-center w-full max-w-xs mx-auto lg:max-w-none lg:w-1/4">
                        <div
                            class="bg-white/80 rounded-2xl shadow-md p-7 border border-gray-100 h-full flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="mx-auto mb-5 flex items-center justify-center w-16 h-16 bg-green-50 rounded-2xl">
                                <i class="fas {{ $step['icon'] }} text-2xl text-green-600"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $step['title'] }}</h4>
                            <p class="text-gray-800 text-sm px-1 flex-grow leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>

                    @if ($index < count($steps) - 1)
                        <div class="hidden lg:flex items-center justify-center text-gray-300">
                            <i class="fas fa-arrow-right text-3xl"></i>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>
    <section id="faq" class="bg-gray-100 py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12 home-animate-fade-in-delay">
                <h3 class="text-3xl font-bold text-gray-900 mb-3">Frequently Asked Questions</h3>
                <p class="text-lg text-gray-500">Have questions? We've got answers.</p>
            </div>

            @php
                $faqs = [
                    [
                        'q' => 'What is GCEP?',
                        'a' => 'GCEP (Gordon College Event Portal) is the centralized platform for managing and viewing all campus events. It keeps students and administrators connected and informed.',
                    ],
                    [
                        'q' => 'Who can create events on the platform?',
                        'a' => 'Events can be created by authorized admin only. ',
                    ],
                    [
                        'q' => 'Can I see events from other departments?',
                        'a' => "Yes! The main feed shows all public campus-wide events. You can also filter events by department to find what's most relevant to you.",
                    ],
                ];
            @endphp

            <div class="space-y-4">
                @foreach ($faqs as $index => $faq)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <button onclick="homeToggleFaq(this)" id="faq-btn-{{ $index }}" aria-expanded="false"
                            aria-controls="faq-panel-{{ $index }}"
                            class="w-full flex justify-between items-center text-left px-6 py-5 font-semibold text-gray-800 hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#7cb93c] transition-colors">
                            <span class="text-base">{{ $faq['q'] }}</span>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300 shrink-0 ml-4"
                                aria-hidden="true"></i>
                        </button>
                        <div id="faq-panel-{{ $index }}" role="region" aria-labelledby="faq-btn-{{ $index }}"
                            class="grid grid-rows-[0fr] opacity-0 transition-all duration-300 ease-in-out overflow-hidden">
                            <div class="overflow-hidden">
                                <p class="px-6 pb-5 text-gray-500 text-sm leading-relaxed">{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <section id="gallery" class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 home-animate-fade-in-delay">
                <h3 class="text-3xl font-bold text-gray-900 mb-3">Moments on Campus</h3>
                <p class="text-lg text-gray-500 max-w-xl mx-auto">
                    Discover highlights from campus life and student activities.
                </p>
            </div>

            @php
                $gallery = [
                    ['img' => 'assets/APERTURA.png', 'label' => 'Apertura Event'],
                    ['img' => 'assets/SPORTSFEST.png', 'label' => 'SportsFest'],
                    ['img' => 'assets/campusEvent.jpg', 'label' => 'Campus Activity'],
                    ['img' => 'assets/gcAct.jpg', 'label' => 'Fun run'],
                    ['img' => 'assets/gcSeminar.jpg', 'label' => 'GC Seminar'],
                    ['img' => 'assets/socialGc.jpg', 'label' => 'Social Gathering'],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($gallery as $item)
                    <div
                        class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 h-64">
                        <img src="{{ asset($item['img']) }}" alt="{{ $item['label'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/65 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                            <h4 class="text-white font-bold text-base">{{ $item['label'] }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection