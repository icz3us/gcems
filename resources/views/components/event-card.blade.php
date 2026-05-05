@props(['event', 'registered' => false, 'title' => null, 'date' => null, 'venue' => null, 'remaining' => null, 'status' => null, 'imageUrl' => null])

@php
    // If $event object is passed, extract properties from it
    if (isset($event)) {
        $isFull = $event->isFull();
        $isCancelled = $event->is_cancelled;
        $titleText = $event->title;
        $dateText = $event->starts_at->format('M d, Y - g:i A');
        $venueText = $event->venue;
        $remainingCount = $event->remaining_slots;
        $imageSrc = $event->image_url;
        
        if ($isCancelled) {
            $statusText = 'Cancelled';
            $statusColor = 'bg-red-100 text-red-700';
            $barColor = 'bg-red-500';
        } elseif ($isFull) {
            $statusText = 'Full';
            $statusColor = 'bg-gray-100 text-gray-600';
            $barColor = 'bg-gray-300';
        } else {
            $statusText = 'Open';
            $statusColor = 'bg-green-100 text-green-700';
            $barColor = 'bg-green-500';
        }
    } else {
        // Use explicitly passed props
        $titleText = $title;
        $dateText = $date;
        $venueText = $venue;
        $remainingCount = $remaining;
        $imageSrc = $imageUrl;
        $isFull = $remaining == 0;
        $isCancelled = false;
        $statusText = $status ?? ($isFull ? 'Full' : 'Open');
        $statusColor = $isFull ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-700';
        $barColor = $isFull ? 'bg-gray-300' : 'bg-green-500';
    }
@endphp

<div class="gc-card rounded-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full relative group">
    <!-- Top banner/color bar -->
    <div class="h-1.5 w-full {{ $barColor }}"></div>

    @if($imageSrc)
        <div class="aspect-video w-full overflow-hidden bg-gray-100">
            <img src="{{ $imageSrc }}" alt="{{ $titleText }} event image" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
        </div>
    @else
        <div class="aspect-video w-full bg-gray-100 flex items-center justify-center text-gray-300">
            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path></svg>
        </div>
    @endif
    
    <div class="p-5 flex flex-col flex-grow relative">
        @if($registered)
            <div class="absolute -right-12 top-4 bg-green-500 text-white text-[10px] font-bold uppercase tracking-wider py-1 px-12 rotate-45 shadow-sm z-10">
                Registered
            </div>
        @endif

        <div class="flex justify-between items-start mb-4 gap-3 pr-4">
            <h3 class="text-lg font-black text-slate-950 leading-tight group-hover:text-[#007a34] transition-colors">{{ $titleText }}</h3>
            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-black uppercase {{ $statusColor }} shrink-0">
                {{ $statusText }}
            </span>
        </div>
        
        <div class="space-y-3 mb-6 flex-grow">
            <!-- Date & Time -->
            <div class="flex items-start text-sm font-semibold text-slate-500">
                <svg class="w-5 h-5 mr-3 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>{{ $dateText }}</span>
            </div>
            
            <!-- Venue -->
            <div class="flex items-start text-sm font-semibold text-slate-500">
                <svg class="w-5 h-5 mr-3 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="line-clamp-2">{{ $venueText }}</span>
            </div>
            
            <!-- Slots Remaining -->
            <div class="flex items-center text-sm font-semibold text-slate-500">
                <svg class="w-5 h-5 mr-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span><strong class="text-slate-950">{{ $remainingCount }}</strong> slots remaining</span>
            </div>
        </div>
        
        <div class="mt-auto">
            @if(isset($event))
                <a href="{{ route('events.show', $event) }}" class="block w-full rounded-xl px-4 py-3 text-center text-sm font-black transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $isCancelled ? 'bg-gray-100 text-gray-500 hover:bg-gray-200 focus:ring-gray-500' : 'bg-white text-[#007a34] border border-green-200 hover:bg-green-50 focus:ring-green-500' }}">
                    View Details
                </a>
            @else
                <button class="w-full py-2.5 px-4 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $isFull ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : 'bg-white text-green-700 border border-green-200 hover:bg-green-50 focus:ring-green-500' }}" {{ $isFull ? 'disabled' : '' }}>
                    {{ $isFull ? 'Fully Booked' : 'View Details' }}
                </button>
            @endif
        </div>
    </div>
</div>
