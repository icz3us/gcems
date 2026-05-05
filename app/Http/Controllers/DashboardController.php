<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $upcomingEvents = Event::withCount('participants')
            ->upcoming()
            ->orderBy('starts_at')
            ->take(6)
            ->get();

        $stats = [
            'upcoming' => Event::upcoming()->count(),
            'week' => Event::upcoming()->whereBetween('starts_at', [now(), now()->endOfWeek()])->count(),
            'month' => Event::upcoming()->whereBetween('starts_at', [now(), now()->endOfMonth()])->count(),
        ];

        $registeredEvents = $request->user()->registeredEvents()
            ->withCount('participants')
            ->orderByPivot('registered_at', 'desc')
            ->take(4)
            ->get();

        return view('dashboard', compact('upcomingEvents', 'stats', 'registeredEvents'));
    }
}
