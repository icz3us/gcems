<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GCEP - Gordon College Event Portal') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-slate-900 bg-[#f7fbf4] overflow-hidden" x-data="{ 
          sidebarOpen: false, 
          logoutModalOpen: false,
          globalSuccessModalOpen: {{ session('status') ? 'true' : 'false' }},
          globalErrorModalOpen: {{ $errors->any() ? 'true' : 'false' }}
      }">

    <div class="flex h-screen overflow-hidden">

        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/50 lg:hidden"
            @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            class="fixed inset-y-0 left-0 z-30 w-72 bg-white border-r border-slate-200/70 transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0 flex flex-col">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between px-7 py-8 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-15 h-15 flex items-center justify-center shrink-0">
                        <img src="{{ asset('assets/gcep.png') }}" alt="Gordon College Logo"
                            class="w-full h-full object-contain">
                    </div>
                    <span>
                        <span class="block text-lg font-black leading-tight tracking-tight text-[#007a34]">Gordon
                            College</span>
                        <span class="block text-xs font-bold uppercase tracking-[0.1em] text-slate-400">Event
                            Portal</span>
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Links -->
            <nav class="flex-1 px-6 py-4 space-y-2 overflow-y-auto">
                <p class="px-3 pb-2 text-[11px] font-bold uppercase tracking-[0.22em] text-slate-400">Main Menu</p>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl border border-transparent transition-colors {{ request()->routeIs('dashboard') ? 'gc-nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-[#007a34]' : 'text-slate-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z"></path>
                    </svg>
                    Dashboard
                </a>

                @php $isAdmin = auth()->check() && in_array(auth()->user()->role ?? '', ['admin', 'super_admin']); @endphp
                @php $isSuperAdmin = auth()->check() && (auth()->user()->role ?? '') === 'super_admin'; @endphp

                <a href="{{ route('events.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl border border-transparent transition-colors {{ request()->routeIs('events.*') ? 'gc-nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('events.*') ? 'text-[#007a34]' : 'text-slate-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ $isAdmin ? 'Manage Events' : 'Browse Events' }}
                </a>

                @if(!$isAdmin)
                    <a href="{{ route('registrations.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl border border-transparent transition-colors {{ request()->routeIs('registrations.*') ? 'gc-nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('registrations.*') ? 'text-[#007a34]' : 'text-slate-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        My Registrations
                    </a>
                @endif

                @if($isSuperAdmin)
                    <a href="{{ route('users.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-bold rounded-2xl border border-transparent transition-colors {{ request()->routeIs('users.*') ? 'gc-nav-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-[#007a34]' : 'text-slate-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                        User Management
                    </a>
                @endif
            </nav>

            <!-- User Profile & Logout -->
            <div class="p-6 border-t border-slate-100 shrink-0">
                @if($isAdmin)
                    <a href="{{ route('events.create') }}"
                        class="mb-5 flex w-full items-center justify-center gap-2 rounded-2xl gc-btn-primary px-5 py-4 text-sm font-bold transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Event
                    </a>
                @endif
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-11 h-11 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 font-black">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-slate-900 truncate max-w-[160px]">
                            {{ auth()->user()->name ?? 'User Name' }}
                        </p>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            {{ auth()->user()->role ?? 'Student' }}
                        </p>
                    </div>
                </div>
                <button @click="logoutModalOpen = true"
                    class="mt-4 w-full flex items-center justify-center px-4 py-2.5 border border-slate-200 text-sm font-bold rounded-xl text-slate-600 bg-white hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Log out
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Mobile Header -->
            <header
                class="bg-white border-b border-slate-200/70 lg:hidden flex items-center justify-between h-16 px-4 shrink-0">
                <a href="{{ route('dashboard') }}"
                    class="text-xl font-black tracking-tighter text-black flex items-center gap-2">
                    <img src="{{ asset('assets/gclogo.png') }}" alt="Gordon College Logo"
                        class="w-8 h-8 object-contain">
                    GCEP
                </a>
                <button @click="sidebarOpen = true"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>

            <!-- Main Scrollable Area -->
            <div
                class="hidden lg:flex h-[86px] items-center justify-between gap-6 border-b border-slate-200/70 bg-white px-10">
                <div class="relative max-w-2xl flex-1">
                    <svg class="pointer-events-none absolute left-5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input class="gc-input h-12 w-full rounded-2xl pl-12 pr-4 text-sm" type="search"
                        placeholder="Search for events, users, or registrations...">
                </div>
                <div class="flex items-center gap-5">
                    <button class="relative rounded-xl p-2 text-slate-500 hover:bg-slate-50 hover:text-slate-900">
                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 01-6 0">
                            </path>
                        </svg>
                    </button>
                    <div class="h-8 w-px bg-slate-200"></div>
                    <div class="text-right">
                        <p class="text-sm font-black text-slate-900">{{ auth()->user()->name ?? 'Admin Portal' }}</p>
                        <p class="text-xs font-semibold text-slate-400 capitalize">
                            {{ str_replace('_', ' ', auth()->user()->role ?? 'User') }}
                        </p>
                    </div>
                </div>
            </div>

            <main class="gc-shell flex-1 overflow-y-auto p-4 sm:p-6 lg:p-10">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Global Success Modal -->
    <div x-show="globalSuccessModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="globalSuccessModalOpen" x-transition.opacity
                class="fixed inset-0 z-0 bg-gray-900/75 transition-opacity" aria-hidden="true"
                @click="globalSuccessModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="globalSuccessModalOpen" x-transition.scale.origin.bottom.sm
                class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full border border-gray-100">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Success
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    {{ session('status') ?? 'Operation completed successfully.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <button type="button" @click="globalSuccessModalOpen = false"
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:w-auto sm:text-sm transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Error Modal -->
    <div x-show="globalErrorModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="globalErrorModalOpen" x-transition.opacity
                class="fixed inset-0 z-0 bg-gray-900/75 transition-opacity" aria-hidden="true"
                @click="globalErrorModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="globalErrorModalOpen" x-transition.scale.origin.bottom.sm
                class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-gray-100">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Something went wrong
                            </h3>
                            <div class="mt-2 text-sm text-gray-500">
                                @if($errors->any())
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <button type="button" @click="globalErrorModalOpen = false"
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm transition-colors">
                        Okay
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="logoutModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="logoutModalOpen" x-transition.opacity
                class="fixed inset-0 z-0 bg-gray-900/75 transition-opacity" aria-hidden="true"
                @click="logoutModalOpen = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="logoutModalOpen" x-transition.scale.origin.bottom.sm
                class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full border border-gray-100">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Confirm Logout
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to log out of your account?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <form method="POST" action="{{ route('logout') }}" class="sm:ml-3 sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm transition-colors">
                            Logout
                        </button>
                    </form>
                    <button type="button" @click="logoutModalOpen = false"
                        class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>