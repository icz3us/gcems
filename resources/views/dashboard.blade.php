<x-layouts.app>
    @php
        $isAdmin = auth()->user()->canManageEvents();
        $isSuperAdmin = auth()->user()->isSuperAdmin();
        $roleTitle = $isSuperAdmin ? 'Super Admin Portal' : ($isAdmin ? 'Admin Portal' : 'Student Portal');
    @endphp

    <div class="mb-12">
        <p class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
            {{ $roleTitle }}
        </p>
        <div class="mt-5 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h1 class="gc-heading text-5xl leading-tight sm:text-6xl">
                    Good morning, {{ $isAdmin ? 'Admin' : auth()->user()->name }}
                </h1>
                <p class="mt-4 max-w-3xl text-lg leading-8 gc-subtle">
                    {{ $isAdmin ? 'Manage campus activity and streamline event scheduling across Gordon College.' : 'Browse upcoming campus events and track your registrations.' }}
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                @if ($isAdmin)
                    <a href="{{ route('events.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl gc-btn-primary px-6 py-4 text-sm font-black transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Event
                    </a>
                    <a href="{{ route('events.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl gc-btn-secondary px-6 py-4 text-sm font-black transition-colors hover:bg-slate-50">
                        View Registry
                    </a>
                @else
                    <a href="{{ route('events.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl gc-btn-primary px-6 py-4 text-sm font-black transition-colors">
                        Browse Events
                    </a>
                    <a href="{{ route('registrations.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl gc-btn-secondary px-6 py-4 text-sm font-black transition-colors hover:bg-slate-50">
                        My Registrations
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="mb-10 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <article class="gc-card rounded-[1.6rem] p-8">
            <div class="flex items-start justify-between">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50 text-[#007a34]">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700">+12%</span>
            </div>
            <p class="mt-8 text-sm font-bold text-slate-400">Total Upcoming</p>
            <p class="mt-2 text-5xl font-black text-slate-950">{{ $stats['upcoming'] ?? 0 }}</p>
        </article>

        <article class="gc-card rounded-[1.6rem] p-8">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="mt-8 text-sm font-bold text-slate-400">This Week</p>
            <p class="mt-2 text-5xl font-black text-slate-950">{{ $stats['week'] ?? 0 }}</p>
        </article>

        <article class="gc-card rounded-[1.6rem] p-8">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50 text-violet-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857">
                    </path>
                </svg>
            </div>
            <p class="mt-8 text-sm font-bold text-slate-400">This Month</p>
            <p class="mt-2 text-5xl font-black text-slate-950">{{ $stats['month'] ?? 0 }}</p>
        </article>

        <article class="rounded-[1.6rem] bg-[#007a34] p-8 text-white shadow-xl shadow-green-900/15">
            <div class="flex items-start justify-between">
                <svg class="h-10 w-10 text-white/85" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2v20m10-10H2m16.24-6.24L5.76 18.24m12.48 0L5.76 5.76"></path>
                </svg>
                <span
                    class="rounded-full bg-white px-4 py-2 text-xs font-black uppercase tracking-wider text-[#007a34]">Operational</span>
            </div>
            <h2 class="mt-10 text-2xl font-black">System Status</h2>
            <p class="mt-4 text-sm leading-6 text-white/75">Event registry, user access, and booking modules are online.
            </p>
        </article>
    </div>

    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[1fr_340px]">
        <section class="gc-card overflow-hidden rounded-[1.8rem]">
            <div class="flex items-center justify-between border-b border-slate-100 px-8 py-7">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-[#007a34]">Activity Monitor</p>
                    <h2 class="mt-3 text-3xl font-medium text-slate-950">Recent Event Records</h2>
                </div>
                <a href="{{ route('events.index') }}"
                    class="text-sm font-black text-[#007a34] hover:text-[#00662b]">View Full Registry</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse ($upcomingEvents ?? [] as $event)
                    <article class="grid gap-5 px-8 py-6 md:grid-cols-[1fr_170px_150px_120px] md:items-center">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-[#007a34] overflow-hidden">
                                <img src="{{ $event->image_url }}" 
                                    class="w-full h-full object-cover" 
                                    onerror="this.onerror=null; this.src='{{ asset('assets/gclogo.png') }}'; this.parentElement.classList.add('p-2')">
                            </div>
                            <div>
                                <h3 class="font-black text-slate-950">{{ $event->title }}</h3>
                                <p class="text-sm font-semibold text-slate-400">ID:
                                    #EVENT-{{ str_pad($event->id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        <p class="font-semibold text-slate-600">{{ $event->venue }}</p>
                        <p class="font-semibold text-slate-500">{{ $event->starts_at->format('M d, Y') }}</p>
                        <span
                            class="rounded-full bg-emerald-50 px-4 py-2 text-center text-xs font-black uppercase text-emerald-700">{{ $event->isFull() ? 'Full' : 'Open' }}</span>
                    </article>
                @empty
                    <div class="px-8 py-14 text-center text-slate-500">No upcoming event records.</div>
                @endforelse
            </div>
        </section>

        <aside class="space-y-8">
            <section class="gc-card rounded-[1.8rem] p-8">
                <p class="text-xs font-black uppercase tracking-[0.22em] text-slate-400">Master Schedule</p>
                <div class="mt-8 grid grid-cols-7 gap-3 text-center text-sm font-bold text-slate-400">
                    @foreach (['S', 'M', 'T', 'W', 'T', 'F', 'S'] as $day)
                        <span>{{ $day }}</span>
                    @endforeach
                    @for ($day = 1; $day <= 21; $day++)
                        <span
                            class="{{ $day === now()->day ? 'bg-[#007a34] text-white shadow-lg shadow-green-700/20' : 'text-slate-700' }} rounded-full py-2">{{ $day }}</span>
                    @endfor
                </div>
            </section>

            <section class="rounded-[1.8rem] bg-[#0b1328] p-8 text-white shadow-xl shadow-slate-900/15">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-emerald-300">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7h16M4 12h16M4 17h16"></path>
                    </svg>
                </div>
                <p class="mt-8 text-xs font-black uppercase tracking-[0.22em] text-emerald-300">Security Update</p>
                <h2 class="mt-4 text-2xl font-medium">Server Maintenance Scheduled</h2>
                <p class="mt-5 text-sm leading-7 text-slate-400">System synchronization notices and registry
                    availability updates appear here.</p>
            </section>
        </aside>
    </div>
</x-layouts.app>