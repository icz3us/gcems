<x-layouts.app>
    <div class="mb-10">
        <div class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
            Event Management
        </div>
        <h1 class="gc-heading mt-5 text-5xl leading-tight sm:text-6xl">Edit Event</h1>
        <p class="mt-3 max-w-2xl text-lg gc-subtle">Update the event record while keeping the current image unless a replacement is selected.</p>
    </div>

    <div class="w-full">
        <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="gc-card rounded-[1.8rem] p-6 sm:p-8">
            @method('PUT')
            @include('events._form')
            
            <div class="mt-8 flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('events.show', $event) }}" class="inline-flex items-center justify-center rounded-2xl gc-btn-secondary px-6 py-3 font-black transition-colors hover:bg-slate-50 w-full sm:w-auto">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl gc-btn-primary px-6 py-3 font-black transition-colors w-full sm:w-auto">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
