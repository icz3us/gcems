<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('role', 'desc')
            ->orderBy('name')
            ->paginate(12);

        return view('users.index', compact('users'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($user->isSuperAdmin()) {
            return back()->withErrors(['role' => 'The super admin account cannot be downgraded.']);
        }

        $validated = $request->validate([
            'role' => ['required', 'in:student,admin'],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('status', "{$user->name}'s role was updated.");
    }
}
