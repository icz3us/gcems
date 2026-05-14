<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\UserManagementController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $upcomingEvents = Event::upcoming()
        ->withCount('participants')
        ->orderBy('starts_at')
        ->take(6)
        ->get();

    return view('welcome', compact('upcomingEvents'));
})->name('landing');

Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('events', [EventController::class, 'index'])->name('events.index');

    Route::middleware('role:admin,super_admin')->group(function () {
        Route::get('events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('events', [EventController::class, 'store'])->name('events.store');
        Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::patch('events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');
        Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });

    Route::middleware('role:super_admin')->group(function () {
        Route::get('users', [UserManagementController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/role', [UserManagementController::class, 'update'])->name('users.update-role');
    });

    Route::middleware('role:student')->group(function () {
        Route::get('registered-events', [EventRegistrationController::class, 'index'])->name('registrations.index');
        Route::post('events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');
        Route::delete('events/{event}/register', [EventRegistrationController::class, 'destroy'])->name('events.unregister');
    });

    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
});
