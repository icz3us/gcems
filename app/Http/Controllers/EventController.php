<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\CloudinaryUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class EventController extends Controller
{
    public function __construct(private readonly CloudinaryUploader $cloudinaryUploader) {}

    public function index(Request $request): View
    {
        $events = Event::withCount('participants')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('venue', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                match ($request->input('status')) {
                    'upcoming' => $query->upcoming(),
                    'cancelled' => $query->where('is_cancelled', true),
                    default => $query,
                };
            })
            ->orderBy('starts_at')
            ->paginate(9)
            ->withQueryString();

        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        return view('events.create', ['event' => new Event]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request, imageRequired: true);

        try {
            $validated['image_url'] = $this->cloudinaryUploader->uploadEventImage($request->file('event_image'));
        } catch (Throwable) {
            return back()
                ->withInput($request->except('event_image'))
                ->withErrors(['event_image' => 'The event image could not be uploaded. Please check your Cloudinary settings and try again.']);
        }

        $event = Event::create($validated);

        return redirect()->route('events.show', $event)->with('status', 'Event created successfully.');
    }

    public function show(Event $event): View
    {
        $event->loadCount('participants');

        if (auth()->user()->canManageEvents()) {
            $event->load(['participants' => fn ($query) => $query->orderBy('name')]);
        }

        return view('events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $this->validated($request, imageRequired: false);

        if ($request->hasFile('event_image')) {
            try {
                $validated['image_url'] = $this->cloudinaryUploader->uploadEventImage($request->file('event_image'));
            } catch (Throwable) {
                return back()
                    ->withInput($request->except('event_image'))
                    ->withErrors(['event_image' => 'The event image could not be uploaded. Please check your Cloudinary settings and try again.']);
            }
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('events.index')->with('status', 'Event deleted successfully.');
    }

    public function cancel(Event $event): RedirectResponse
    {
        $event->update(['is_cancelled' => true]);

        return back()->with('status', 'Event cancelled successfully.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'starts_at' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:255'],
            'maximum_capacity' => ['required', 'integer', 'min:1', 'max:100000'],
            'event_image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        unset($validated['event_image']);

        return $validated;
    }
}
