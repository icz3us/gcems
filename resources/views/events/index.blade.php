<x-layouts.app>
    <div class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
                {{ auth()->user()->canManageEvents() ? 'Event Management' : 'Event Browsing' }}
            </div>
            <h1 class="gc-heading mt-5 text-5xl leading-tight sm:text-6xl">Event Registry</h1>
            <p class="mt-3 max-w-2xl text-lg gc-subtle">Search, filter, and review campus event records.</p>
        </div>
        @if (auth()->user()->canManageEvents())
            <a href="{{ route('events.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl gc-btn-primary px-6 py-4 text-sm font-black transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Event
            </a>
        @endif
    </div>

    <form method="GET" class="gc-card mb-8 grid grid-cols-1 gap-4 rounded-[1.7rem] p-5 md:grid-cols-[1fr_220px_auto]">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input class="gc-input block w-full rounded-2xl py-3 pl-10 pr-3 text-slate-900 transition-colors" type="search" name="search" value="{{ request('search') }}" placeholder="Search title or venue...">
        </div>
        <select class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors" name="status">
            <option value="">All Events</option>
            <option value="upcoming" @selected(request('status') === 'upcoming')>Upcoming Only</option>
            <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled Only</option>
        </select>
        <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-[#0b1328] px-6 py-3 font-black text-white transition-colors hover:bg-slate-800 md:w-auto">
            Filter
        </button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($events as $event)
            <x-event-card :event="$event" :registered="auth()->user()->registeredEvents->contains($event)" />
        @empty
            <div class="col-span-full py-16 bg-white rounded-2xl border border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">No events found</h3>
                <p class="text-gray-500 max-w-sm">We couldn't find any events matching your current filters.</p>
                @if(request('search') || request('status'))
                    <a href="{{ route('events.index') }}" class="mt-4 text-green-600 font-medium hover:text-green-700">Clear filters</a>
                @endif
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $events->links() }}
    </div>
</x-layouts.app>
