<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventRegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $events = $request->user()->registeredEvents()
            ->withCount('participants')
            ->orderByPivot('registered_at', 'desc')
            ->paginate(10);

        return view('registrations.index', compact('events'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $event->loadCount('participants');

        if ($event->is_cancelled || $event->starts_at->isPast()) {
            return back()->withErrors(['registration' => 'This event is not open for registration.']);
        }

        if ($request->user()->registeredEvents()->whereKey($event->id)->exists()) {
            return back()->withErrors(['registration' => 'You are already registered for this event.']);
        }

        if ($event->isFull()) {
            return back()->withErrors(['registration' => 'This event is already full.']);
        }

        $request->user()->registeredEvents()->attach($event, ['registered_at' => now()]);

        return back()->with('status', 'Registration confirmed.');
    }

    public function destroy(Request $request, Event $event): RedirectResponse
    {
        $request->user()->registeredEvents()->detach($event);

        return back()->with('status', 'Registration cancelled.');
    }
}
