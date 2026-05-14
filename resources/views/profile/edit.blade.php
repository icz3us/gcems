<x-layouts.app>
    <div class="mb-10">
        <div class="gc-pill inline-flex rounded-full px-3 py-1 text-[11px] font-black uppercase">
            Account Settings
        </div>
        <h1 class="gc-heading mt-5 text-5xl leading-tight sm:text-6xl">My Profile</h1>
        <p class="mt-3 max-w-2xl text-lg gc-subtle">
            Update your personal information and upload a clean 2x2-style or professional profile photo.
        </p>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
        class="grid gap-8 xl:grid-cols-[360px_1fr]">
        @csrf
        @method('PATCH')

        <section class="gc-card rounded-[1.8rem] p-6 sm:p-8"
            x-data="{
                imagePreview: @js($user->profile_photo_path ? Storage::url($user->profile_photo_path) : null),
                previewFile(event) {
                    const file = event.target.files[0];
                    this.imagePreview = file ? URL.createObjectURL(file) : @js($user->profile_photo_path ? Storage::url($user->profile_photo_path) : null);
                }
            }">
            <p class="text-xs font-black uppercase tracking-[0.22em] text-[#007a34]">Profile Photo</p>

            <div class="mt-6 flex flex-col items-center text-center">
                <div class="h-48 w-48 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 shadow-inner">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Selected profile photo" class="h-full w-full object-cover">
                    </template>
                    <div x-show="! imagePreview"
                        class="flex h-full w-full items-center justify-center text-5xl font-black text-slate-300">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <label for="profile_photo"
                    class="mt-6 inline-flex cursor-pointer items-center justify-center rounded-2xl gc-btn-primary px-5 py-3 text-sm font-black transition-colors">
                    Choose Photo
                </label>
                <input id="profile_photo" type="file" name="profile_photo" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    class="sr-only" @change="previewFile($event)">

                <p class="mt-4 text-sm leading-6 text-slate-500">
                    Use a square 2x2-style headshot or a professional-looking photo. JPG, PNG, JPEG, or WEBP up to 2MB.
                </p>

                @error('profile_photo')
                    <p class="mt-3 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </section>

        <section class="gc-card rounded-[1.8rem] p-6 sm:p-8">
            <div class="grid gap-5 sm:grid-cols-2">
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-black text-slate-700">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors">
                    @error('name')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="username" class="block text-sm font-black text-slate-700">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                        class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors"
                        placeholder="Optional username">
                    @error('username')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5 space-y-1">
                <label for="email" class="block text-sm font-black text-slate-700">Email Address</label>
                <input id="email" type="email" value="{{ $user->email }}" disabled
                    class="block w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-500">
                <p class="mt-2 text-xs font-medium text-slate-500">Your email address is tied to your account and cannot be changed here.</p>
            </div>

            <div class="mt-8 border-t border-slate-100 pt-6">
                <h2 class="text-xl font-black text-slate-950">Change Password</h2>
                <p class="mt-2 text-sm text-slate-500">Leave these fields blank to keep your current password.</p>

                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-black text-slate-700">New Password</label>
                        <input id="password" type="password" name="password"
                            class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors">
                        @error('password')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-sm font-black text-slate-700">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="gc-input block w-full rounded-2xl px-4 py-3 text-slate-900 transition-colors">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex w-full items-center justify-center rounded-2xl gc-btn-secondary px-6 py-3 font-black transition-colors hover:bg-slate-50 sm:w-auto">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl gc-btn-primary px-6 py-3 font-black transition-colors sm:w-auto">
                    Save Profile
                </button>
            </div>
        </section>
    </form>
</x-layouts.app>
