<x-layouts.app>
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="inline-flex items-center px-2.5 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold uppercase tracking-wider mb-2">
                My Registrations
            </div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Registered Events</h1>
        </div>
        <div>
            <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm text-sm">
                Browse More Events
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($events as $event)
            <x-event-card :event="$event" :registered="true" />
        @empty
            <div class="col-span-full py-16 bg-white rounded-2xl border border-gray-100 flex flex-col items-center justify-center text-center shadow-sm">
                <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center text-green-600 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">No Registered Events</h3>
                <p class="text-gray-500 max-w-sm mb-6">You haven't registered for any upcoming events yet. Discover what's happening on campus!</p>
                <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm text-sm">
                    Browse Events
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $events->links() }}
    </div>
</x-layouts.app>
