@csrf
<div class="space-y-5">
    <div
        x-data="{
            imagePreview: @js(old('image_url', $event->image_url ?? null)),
            fileName: '',
            previewFile(event) {
                const file = event.target.files[0];
                this.fileName = file ? file.name : '';

                if (! file) {
                    this.imagePreview = @js($event->image_url ?? null);
                    return;
                }

                this.imagePreview = URL.createObjectURL(file);
            }
        }"
        class="space-y-2"
    >
        <label for="event_image" class="block text-sm font-black text-slate-700">
            Event Image
            @if (! ($event->exists ?? false))
                <span class="text-red-600">*</span>
            @endif
        </label>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-[220px_1fr] sm:items-start">
            <div class="aspect-video overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                <template x-if="imagePreview">
                    <img :src="imagePreview" alt="Selected event image preview" class="h-full w-full object-cover">
                </template>
                <div x-show="! imagePreview" class="flex h-full w-full items-center justify-center px-4 text-center text-sm font-medium text-gray-400">
                    Image preview
                </div>
            </div>

            <div>
                <input
                    id="event_image"
                    type="file"
                    name="event_image"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    @change="previewFile($event)"
                    {{ ($event->exists ?? false) ? '' : 'required' }}
                    class="gc-input block w-full cursor-pointer rounded-2xl text-sm text-slate-700 file:mr-4 file:border-0 file:bg-green-50 file:px-4 file:py-3 file:text-sm file:font-black file:text-[#007a34] hover:file:bg-green-100"
                >
                <p class="mt-2 text-xs text-gray-500">JPG, PNG, JPEG, or WEBP. Maximum size: 2MB.</p>
                <p x-show="fileName" x-text="fileName" class="mt-2 truncate text-sm font-medium text-gray-700"></p>
                @if (($event->exists ?? false) && $event->image_url)
                    <p class="mt-2 text-xs text-gray-500">Leave this empty to keep the current image.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="space-y-1">
        <label for="title" class="block text-sm font-black text-slate-700">Event Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $event->title ?? '') }}" required
            class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors" 
            placeholder="e.g. Gordon College Foundation Day">
    </div>
    
    <div class="space-y-1">
        <label for="description" class="block text-sm font-black text-slate-700">Description</label>
        <textarea id="description" name="description" required rows="5"
            class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors"
            placeholder="Provide details about the event...">{{ old('description', $event->description ?? '') }}</textarea>
    </div>
    
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
        <div class="space-y-1">
            <label for="starts_at" class="block text-sm font-black text-slate-700">Date & Time</label>
            <input id="starts_at" type="datetime-local" name="starts_at" value="{{ old('starts_at', isset($event->starts_at) ? $event->starts_at->format('Y-m-d\TH:i') : '') }}" required
                class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors">
        </div>
        
        <div class="space-y-1">
            <label for="maximum_capacity" class="block text-sm font-black text-slate-700">Maximum Capacity</label>
            <input id="maximum_capacity" type="number" min="1" name="maximum_capacity" value="{{ old('maximum_capacity', $event->maximum_capacity ?? '') }}" required
                class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors"
                placeholder="e.g. 150">
        </div>
    </div>
    
    <div class="space-y-1">
        <label for="venue" class="block text-sm font-black text-slate-700">Venue</label>
        <input id="venue" type="text" name="venue" value="{{ old('venue', $event->venue ?? '') }}" required
            class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors"
            placeholder="e.g. Main Auditorium">
    </div>
</div>
