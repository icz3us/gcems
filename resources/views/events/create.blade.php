<x-layouts.app>
    <div class="mb-10">
        <div class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
            Event Management
        </div>
        <h1 class="gc-heading mt-5 text-5xl leading-tight sm:text-6xl">Create Event</h1>
        <p class="mt-3 max-w-2xl text-lg gc-subtle">Publish a campus event with registration details and a Cloudinary-hosted image.</p>
    </div>

    <div class="w-full">
        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="gc-card rounded-[1.8rem] p-6 sm:p-8">
            @include('events._form')
            
            <div class="mt-8 flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center rounded-2xl gc-btn-secondary px-6 py-3 font-black transition-colors hover:bg-slate-50 w-full sm:w-auto">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl gc-btn-primary px-6 py-3 font-black transition-colors w-full sm:w-auto">
                    Create Event
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
