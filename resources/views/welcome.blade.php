<x-layouts.guest>
    <section class="bg-[#f3f9ef]">
        <div class="mx-auto grid min-h-[720px] max-w-7xl grid-cols-1 items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-[1fr_0.9fr] lg:px-8">
            <div>
                <h1 class="max-w-2xl text-5xl font-medium uppercase leading-[0.98] tracking-normal text-slate-950 sm:text-6xl lg:text-7xl">
                    Coordinate.<br>
                    Schedule.<br>
                    Excel.
                </h1>
                <p class="mt-8 max-w-xl text-base leading-7 text-slate-600">
                    A focused event workspace for Gordon College organizers, students, and campus teams to plan, publish, and track activities in one place.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#events" class="rounded-2xl gc-btn-primary px-6 py-3 text-sm font-bold transition-colors">
                        Browse Events
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="rounded-2xl gc-btn-secondary px-6 py-3 text-sm font-bold transition-colors hover:bg-slate-50">
                            Portal Login
                        </a>
                    @endguest
                </div>

                <div class="mt-14 grid max-w-xl grid-cols-2 gap-6 sm:grid-cols-4">
                    <div>
                        <p class="text-3xl font-black text-slate-950">150+</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500">Active records</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-slate-950">5.0</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500">Portal rating</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-slate-950">24/7</p>
                        <p class="mt-1 text-xs font-semibold text-slate-500">System uptime</p>
                    </div>
                    <div class="rounded-2xl bg-[#007a34] p-4 text-white">
                        <p class="text-2xl font-black">99%</p>
                        <p class="mt-1 text-[11px] font-semibold text-white/80">Campus ready</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-[2rem] border-[8px] border-white bg-gradient-to-br from-sky-300 via-slate-100 to-slate-900 p-6 shadow-2xl shadow-slate-900/15">
                    <div class="relative aspect-[4/3] overflow-hidden rounded-[1.4rem] bg-[#dff3ff]">
                        <div class="absolute inset-x-0 bottom-0 h-2/5 bg-gradient-to-t from-slate-900 to-transparent"></div>
                        <div class="absolute bottom-10 left-8 right-8 grid grid-cols-3 gap-4">
                            <div class="h-48 rounded-t-[4rem] bg-white/85 shadow-lg"></div>
                            <div class="h-72 rounded-t-full bg-white shadow-xl"></div>
                            <div class="h-52 rounded-t-[4rem] bg-white/80 shadow-lg"></div>
                        </div>
                        <div class="absolute left-10 top-16 h-4 w-36 rounded-full bg-white/60"></div>
                        <div class="absolute right-14 top-24 h-3 w-28 rounded-full bg-white/50"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="platform" class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-14 px-4 sm:px-6 lg:grid-cols-[0.9fr_1fr] lg:px-8">
            <div>
                <h2 class="max-w-lg text-4xl font-medium uppercase leading-tight tracking-normal text-slate-950 sm:text-5xl">
                    A platform designed for institutional success
                </h2>
                <p class="mt-6 max-w-xl text-base leading-7 text-slate-600">
                    GC-EMS supports event creation, participant registration, venue visibility, and role-based workflows for campus operations.
                </p>
                <a href="{{ route('login') }}" class="mt-7 inline-flex rounded-2xl gc-btn-secondary px-5 py-3 text-sm font-bold transition-colors hover:bg-slate-50">
                    Learn about the process
                </a>
            </div>
            <div class="relative overflow-hidden rounded-2xl bg-[linear-gradient(135deg,#f8fafc,#dfeee3)] p-8 shadow-xl shadow-slate-900/10">
                <div class="aspect-[16/9] overflow-hidden rounded-xl bg-[linear-gradient(180deg,#8d6b3d,#f0c36a_48%,#0f766e_49%,#0f766e_58%,#d19b45_59%)]">
                    <div class="grid h-full grid-rows-6 gap-2 p-8">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="rounded bg-white/25"></div>
                        @endfor
                    </div>
                </div>
                <div class="absolute bottom-8 right-8 rounded-2xl bg-white p-5 shadow-xl">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Capacity</p>
                    <p class="mt-2 text-sm font-black text-slate-950">Smart registration</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white pb-20">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 md:grid-cols-3 lg:px-8">
            <article class="rounded-2xl bg-[#0b1328] p-8 text-white shadow-xl shadow-slate-900/10">
                <div class="mb-16 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-black">Unified Scheduling</h3>
                <p class="mt-3 text-sm leading-6 text-slate-300">Turn scattered campus activity into a clear event pipeline.</p>
            </article>
            <article class="rounded-2xl bg-slate-100 p-8 text-slate-950">
                <div class="mb-16 flex h-12 w-12 items-center justify-center rounded-xl bg-white text-[#007a34]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.828 0l-4.243-4.243a8 8 0 1 1 11.314 0z"></path></svg>
                </div>
                <h3 class="text-xl font-black">Venue Management</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Keep event locations visible and easy to scan.</p>
            </article>
            <article class="rounded-2xl bg-[#007a34] p-8 text-white shadow-xl shadow-green-900/10">
                <div class="mb-16 flex -space-x-2">
                    <span class="h-9 w-9 rounded-full border-2 border-white bg-slate-800"></span>
                    <span class="h-9 w-9 rounded-full border-2 border-white bg-slate-500"></span>
                    <span class="h-9 w-9 rounded-full border-2 border-white bg-emerald-400"></span>
                </div>
                <h3 class="text-xl font-black">Deep Analytics</h3>
                <p class="mt-3 text-sm leading-6 text-white/75">Monitor registration demand and upcoming event capacity.</p>
            </article>
        </div>
    </section>

    <section class="bg-slate-50 py-20">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-4xl font-medium uppercase tracking-normal text-slate-950">Browse Categories</h2>
            <p class="mt-3 text-sm text-slate-500">Explore common event groups across campus operations.</p>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Academic', 'Seminars & workshops', 'bg-emerald-50 border-emerald-100'],
                    ['Cultural', 'Exhibits & arts', 'bg-sky-50 border-sky-100'],
                    ['Institutional', 'Meetings & briefings', 'bg-violet-50 border-violet-100'],
                    ['Athletic', 'Sports & fitness', 'bg-orange-50 border-orange-100'],
                ] as [$name, $copy, $tone])
                    <article class="rounded-2xl border {{ $tone }} p-8">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-slate-900 shadow-sm">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"></path></svg>
                        </div>
                        <h3 class="mt-6 text-sm font-black text-slate-950">{{ $name }}</h3>
                        <p class="mt-2 text-xs text-slate-500">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="events" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex items-end justify-between gap-6">
                <div>
                    <h2 class="text-4xl font-medium uppercase tracking-normal text-slate-950">Upcoming Events</h2>
                    <p class="mt-3 text-sm text-slate-500">Live updates from the Gordon College event registry.</p>
                </div>
                <a href="{{ route('login') }}" class="hidden text-xs font-black uppercase tracking-wider text-[#007a34] hover:text-[#00662b] sm:inline-flex">View all</a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @forelse ($upcomingEvents->take(3) as $event)
                    <x-event-card :event="$event" />
                @empty
                    <div class="col-span-full rounded-2xl border border-slate-100 bg-slate-50 py-16 text-center">
                        <h3 class="text-lg font-black text-slate-950">No upcoming events</h3>
                        <p class="mt-2 text-slate-500">Check back later for new activities.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-white pb-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] bg-[#007a34] px-8 py-16 text-center text-white">
                <h2 class="text-4xl font-medium uppercase leading-tight tracking-normal">Ready to organize<br class="hidden sm:block"> your next event?</h2>
                <p class="mx-auto mt-5 max-w-2xl text-sm leading-6 text-white/75">Join campus teams using GC-EMS to coordinate schedules, registrations, and event logistics.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('login') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-black text-[#007a34]">Create Your First Event</a>
                    <a href="#" class="rounded-xl border border-white/25 px-6 py-3 text-sm font-black text-white">Contact Support</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.guest>
