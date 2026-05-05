<x-layouts.app>
    <div x-data="{
        confirmModalOpen: false,
        modalTitle: '',
        modalMessage: '',
        modalActionText: '',
        modalActionColor: 'bg-green-600 hover:bg-green-700',
        formToSubmit: null,

        openConfirmModal(event, title, message, actionText, actionColorClass) {
            event.preventDefault();
            this.formToSubmit = event.target.closest('form');
            this.modalTitle = title;
            this.modalMessage = message;
            this.modalActionText = actionText;
            this.modalActionColor = actionColorClass;
            this.confirmModalOpen = true;
        },

        submitForm() {
            if (this.formToSubmit) {
                this.formToSubmit.submit();
            }
        }
    }">

        <!-- Header -->
        <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
            <div>
                <div class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
                    Event Details
                </div>
                <h1 class="gc-heading mt-5 text-5xl leading-tight sm:text-6xl">{{ $event->title }}</h1>
                <p class="mt-3 text-lg gc-subtle">{{ $event->venue }} · {{ $event->starts_at->format('M d, Y g:i A') }}</p>
            </div>

            @if (auth()->user()->canManageEvents())
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center justify-center rounded-2xl gc-btn-secondary px-5 py-3 text-sm font-black transition-colors hover:bg-slate-50">
                        Edit
                    </a>
                    
                    @unless ($event->is_cancelled)
                        <form method="POST" action="{{ route('events.cancel', $event) }}">
                            @csrf
                            @method('PATCH')
                            <button type="button" @click="openConfirmModal($event, 'Cancel Event', 'Are you sure you want to cancel this event? This action will mark it as cancelled for all participants.', 'Cancel Event', 'bg-amber-500 hover:bg-amber-600')" class="inline-flex items-center justify-center rounded-2xl border border-amber-200 bg-white px-5 py-3 text-sm font-black text-amber-700 transition-colors hover:bg-amber-50">
                                Cancel Event
                            </button>
                        </form>
                    @endunless

                    <form method="POST" action="{{ route('events.destroy', $event) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" @click="openConfirmModal($event, 'Delete Event', 'Are you sure you want to permanently delete this event? This action cannot be undone.', 'Delete Permanently', 'bg-red-600 hover:bg-red-700')" class="inline-flex items-center justify-center rounded-2xl border border-red-200 bg-white px-5 py-3 text-sm font-black text-red-600 transition-colors hover:bg-red-50">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <section class="grid grid-cols-1 lg:grid-cols-[1fr_320px] xl:grid-cols-[1fr_380px] gap-6">
            
            <!-- Left Column: Description -->
            <article class="gc-card rounded-[1.8rem] overflow-hidden">
                @if ($event->image_url)
                    <div class="aspect-video w-full bg-gray-100">
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }} event image" class="h-full w-full object-cover">
                    </div>
                @endif

                <div class="p-6 sm:p-8">
                @if ($event->is_cancelled)
                    <div class="mb-6 inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm font-bold">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Event Cancelled
                    </div>
                @endif

                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-4">About this Event</h2>
                <div class="prose prose-green max-w-none text-gray-600 leading-relaxed">
                    {{ $event->description }}
                </div>
                </div>
            </article>

            <!-- Right Column: Details & Actions -->
            <aside class="space-y-6">
                <!-- Info Card -->
                <div class="gc-card rounded-[1.8rem] p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Event Details</h3>
                    <dl class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                <dd class="mt-0.5 font-semibold text-gray-900">{{ $event->starts_at->format('M d, Y') }} <br><span class="text-sm text-gray-600 font-normal">{{ $event->starts_at->format('g:i A') }}</span></dd>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Venue</dt>
                                <dd class="mt-0.5 font-semibold text-gray-900">{{ $event->venue }}</dd>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Registered</dt>
                                <dd class="mt-0.5 font-semibold text-gray-900">{{ $event->participants_count }} <span class="text-sm font-normal text-gray-500">/ {{ $event->maximum_capacity }}</span></dd>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Remaining Slots</dt>
                                <dd class="mt-0.5 font-semibold text-gray-900">{{ $event->remaining_slots }}</dd>
                            </div>
                        </div>
                    </dl>
                </div>

                <!-- Registration Actions (Student Only) -->
                @if (! auth()->user()->canManageEvents())
                    @php($registered = auth()->user()->registeredEvents()->whereKey($event->id)->exists())
                    <div class="gc-card rounded-[1.8rem] p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Registration</h3>
                        
                        @if ($registered)
                            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <div>
                                    <p class="text-sm font-bold text-green-800">You are registered!</p>
                                    <p class="text-xs text-green-700 mt-1">We look forward to seeing you there.</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('events.unregister', $event) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" @click="openConfirmModal($event, 'Cancel Registration', 'Are you sure you want to cancel your registration for this event?', 'Cancel My Registration', 'bg-gray-800 hover:bg-gray-900')" class="w-full rounded-lg bg-white border border-gray-300 px-4 py-3 font-semibold text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    Cancel Registration
                                </button>
                            </form>
                        @else
                            @if ($event->is_cancelled)
                                <div class="text-center p-4 bg-gray-50 rounded-lg text-gray-500 font-medium">Event is Cancelled</div>
                            @elseif ($event->starts_at->isPast())
                                <div class="text-center p-4 bg-gray-50 rounded-lg text-gray-500 font-medium">Event has Ended</div>
                            @elseif ($event->isFull())
                                <div class="text-center p-4 bg-gray-50 rounded-lg text-gray-500 font-medium">Event is Fully Booked</div>
                            @else
                                <form method="POST" action="{{ route('events.register', $event) }}">
                                    @csrf
                                    <button type="button" @click="openConfirmModal($event, 'Confirm Registration', 'Are you sure you want to register for this event?', 'Confirm Registration', 'bg-green-600 hover:bg-green-700')" class="w-full rounded-lg bg-green-600 px-4 py-3 font-semibold text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                                        Register Now
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                @endif
            </aside>
        </section>

        <!-- Participants List (Admin Only) -->
        @if (auth()->user()->canManageEvents())
            <section class="gc-card mt-8 rounded-[1.8rem] overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-white">
                    <h2 class="text-lg font-bold text-gray-900">Registered Participants <span class="ml-2 text-sm font-medium text-gray-500 bg-gray-100 px-2.5 py-0.5 rounded-full">{{ $event->participants_count }} total</span></h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-left text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Name</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Email</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs text-right">Registered At</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($event->participants as $participant)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">{{ $participant->name }}</td>
                                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ $participant->email }}</td>
                                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap text-right">{{ \Carbon\Carbon::parse($participant->pivot->registered_at)->format('M d, Y g:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-8 text-center text-gray-500" colspan="3">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            <p>No participants registered yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        <!-- General Action Confirmation Modal -->
        <div x-show="confirmModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="confirmModalOpen" x-transition.opacity class="fixed inset-0 z-0 bg-gray-900/75 transition-opacity" aria-hidden="true" @click="confirmModalOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="confirmModalOpen" x-transition.scale.origin.bottom.sm class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full border border-gray-100">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title" x-text="modalTitle"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500" x-text="modalMessage"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="button" @click="submitForm()" :class="modalActionColor" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors" x-text="modalActionText"></button>
                        <button type="button" @click="confirmModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
