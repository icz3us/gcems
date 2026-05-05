<a class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" href="{{ route('dashboard') }}">Dashboard</a>
<a class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" href="{{ route('events.index') }}">Events</a>
@if (auth()->user()->canManageEvents())
    <a class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" href="{{ route('events.create') }}">Add Event</a>
    @if (auth()->user()->isSuperAdmin())
        <a class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" href="{{ route('users.index') }}">Users</a>
    @endif
@else
    <a class="block rounded-md px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100" href="{{ route('registrations.index') }}">My Events</a>
@endif
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="block w-full rounded-md px-3 py-2 text-left text-sm font-semibold text-slate-700 hover:bg-slate-100" type="submit">Log Out</button>
</form>
