<x-layouts.app>
    <div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
        <div>
            <div class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
                Super Admin
            </div>
            <h1 class="gc-heading mt-5 text-5xl leading-tight sm:text-6xl">User Management</h1>
            <p class="mt-3 max-w-3xl text-lg gc-subtle">Administer identity and access control across the campus digital ecosystem.</p>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <article class="gc-card rounded-[1.6rem] p-7">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <p class="mt-7 text-xs font-black uppercase tracking-[0.18em] text-slate-400">Total Residents</p>
            <p class="mt-2 text-4xl font-black text-slate-950">{{ number_format($users->total()) }}</p>
        </article>
        <article class="gc-card rounded-[1.6rem] p-7">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50 text-[#007a34]">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944 11.955 11.955 0 013.382 5.984 12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <p class="mt-7 text-xs font-black uppercase tracking-[0.18em] text-slate-400">Administrative</p>
            <p class="mt-2 text-4xl font-black text-slate-950">{{ $users->whereIn('role', ['admin', 'super_admin'])->count() }}</p>
        </article>
        <article class="gc-card rounded-[1.6rem] p-7">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"></path></svg>
            </div>
            <p class="mt-7 text-xs font-black uppercase tracking-[0.18em] text-slate-400">Pending Sync</p>
            <p class="mt-2 text-4xl font-black text-slate-950">0</p>
        </article>
        <article class="gc-card rounded-[1.6rem] p-7">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-slate-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="mt-7 text-xs font-black uppercase tracking-[0.18em] text-slate-400">Active Now</p>
            <p class="mt-2 text-4xl font-black text-slate-950">{{ $users->count() }}</p>
        </article>
    </div>

    <!-- User Management List -->
    <div x-data="{ 
            confirmModalOpen: false, 
            userIdToUpdate: null, 
            userNameToUpdate: '', 
            newRoleValue: '',
            formToSubmit: null,
            
            confirmRoleUpdate(event, userId, userName, selectElement) {
                event.preventDefault();
                this.formToSubmit = event.target.closest('form');
                this.userIdToUpdate = userId;
                this.userNameToUpdate = userName;
                this.newRoleValue = selectElement.options[selectElement.selectedIndex].text;
                this.confirmModalOpen = true;
            },
            
            submitRoleUpdate() {
                if (this.formToSubmit) {
                    this.formToSubmit.submit();
                }
            }
        }">

        <!-- Mobile Filter -->
        <div class="mb-6 space-y-3 md:hidden">
            <form method="GET" action="{{ route('users.index') }}" class="space-y-3">
                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input name="search" value="{{ request('search') }}" class="gc-input w-full rounded-2xl py-3.5 pl-12 pr-4 text-sm" type="search" placeholder="Search users...">
                </div>
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <select name="role" onchange="this.form.submit()" class="gc-input w-full appearance-none rounded-2xl py-3.5 pl-4 pr-10 text-sm bg-white">
                            <option value="">All Roles</option>
                            <option value="student" @selected(request('role') === 'student')>Student</option>
                            <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                            <option value="super_admin" @selected(request('role') === 'super_admin')>Super Admin</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @if(request('search') || request('role'))
                        <a href="{{ route('users.index') }}" class="flex items-center justify-center rounded-2xl bg-red-50 px-5 text-sm font-bold text-red-500">Clear</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Mobile View (Cards) -->
        <section class="space-y-4 md:hidden">
            @foreach ($users as $user)
                <article class="gc-card rounded-2xl p-5">
                    <div class="space-y-1 mb-4 border-b border-gray-50 pb-4">
                        <div class="flex justify-between items-start">
                            <h2 class="text-lg font-bold text-gray-900">{{ $user->name }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ Illuminate\Support\Str::headline($user->role) }}
                            </span>
                        </div>
                        <p class="break-all text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('users.update-role', $user) }}" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col gap-3">
                            <label class="block">
                                <span class="sr-only">Role</span>
                                <select x-ref="select_{{ $user->id }}" class="block w-full rounded-lg border border-gray-200 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors disabled:bg-gray-50 disabled:text-gray-400" name="role" @disabled($user->isSuperAdmin())>
                                    <option value="student" @selected($user->role === 'student')>Student</option>
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                </select>
                            </label>
                            <button 
                                @click="confirmRoleUpdate($event, {{ $user->id }}, '{{ addslashes($user->name) }}', $refs.select_{{ $user->id }})" 
                                class="w-full rounded-lg bg-green-600 px-4 py-2.5 font-semibold text-white transition-colors hover:bg-green-700 disabled:cursor-not-allowed disabled:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" 
                                type="button" 
                                @disabled($user->isSuperAdmin())>
                                Save Role
                            </button>
                        </div>
                    </form>
                </article>
            @endforeach
        </section>

        <!-- Desktop View (Table) -->
        <section class="gc-card hidden overflow-hidden rounded-[1.8rem] md:block">
            <div class="border-b border-slate-100 p-6">
                <form method="GET" action="{{ route('users.index') }}" class="flex items-center gap-4">
                    <div class="relative flex-1 max-w-lg">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input name="search" value="{{ request('search') }}" class="gc-input w-full rounded-2xl py-3 pl-12 pr-4 text-sm" type="search" placeholder="Filter by name, campus ID, or email...">
                    </div>
                    
                    <div class="relative w-48">
                        <select name="role" onchange="this.form.submit()" class="gc-input w-full appearance-none rounded-2xl py-3 pl-4 pr-10 text-sm bg-white">
                            <option value="">All Roles</option>
                            <option value="student" @selected(request('role') === 'student')>Student</option>
                            <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                            <option value="super_admin" @selected(request('role') === 'super_admin')>Super Admin</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    @if(request('search') || request('role'))
                        <a href="{{ route('users.index') }}" class="text-sm font-bold text-red-500 hover:text-red-600 transition-colors">Clear</a>
                    @endif
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-left text-sm">
                    <thead class="bg-white text-slate-400">
                        <tr>
                            <th class="px-8 py-5 font-black uppercase tracking-[0.18em] text-xs">Identified User</th>
                            <th class="px-8 py-5 font-black uppercase tracking-[0.18em] text-xs">Email</th>
                            <th class="px-8 py-5 font-black uppercase tracking-[0.18em] text-xs">Access Role</th>
                            <th class="px-8 py-5 font-black uppercase tracking-[0.18em] text-xs text-right">Controls</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach ($users as $user)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-sm font-black text-blue-700">
                                            {{ collect(explode(' ', $user->name))->map(fn ($part) => substr($part, 0, 1))->take(2)->implode('') }}
                                        </div>
                                        <span class="font-black text-slate-950">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-slate-500 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-xs font-black uppercase tracking-wider text-slate-700">
                                        {{ Illuminate\Support\Str::headline($user->role) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right">
                                    <form method="POST" action="{{ route('users.update-role', $user) }}" class="flex items-center justify-end gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select x-ref="select_dt_{{ $user->id }}" class="rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors disabled:bg-gray-50 disabled:text-gray-400" name="role" @disabled($user->isSuperAdmin())>
                                            <option value="student" @selected($user->role === 'student')>Student</option>
                                            <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                        </select>
                                        <button 
                                            @click="confirmRoleUpdate($event, {{ $user->id }}, '{{ addslashes($user->name) }}', $refs.select_dt_{{ $user->id }})" 
                                            class="rounded-lg bg-green-600 px-4 py-2 font-medium text-white hover:bg-green-700 disabled:cursor-not-allowed disabled:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" 
                                            type="button" 
                                            @disabled($user->isSuperAdmin())>
                                            Save
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>

        <!-- Role Update Confirmation Modal -->
        <div x-show="confirmModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="confirmModalOpen" x-transition.opacity class="fixed inset-0 z-0 bg-gray-900/75 transition-opacity" aria-hidden="true" @click="confirmModalOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="confirmModalOpen" x-transition.scale.origin.bottom.sm class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full border border-gray-100">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    Confirm Role Update
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to change <span class="font-semibold text-gray-900" x-text="userNameToUpdate"></span>'s role to <span class="font-semibold text-green-700" x-text="newRoleValue"></span>?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="button" @click="submitRoleUpdate()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Confirm Update
                        </button>
                        <button type="button" @click="confirmModalOpen = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
