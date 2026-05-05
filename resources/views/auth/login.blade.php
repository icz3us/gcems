<x-auth-card title="Sign in to your account">
    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-100 p-4 text-sm text-red-600 font-medium">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        
        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
            <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus
                class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors" 
                placeholder="student@gordoncollege.edu.ph">
        </div>
        
        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-green-600 hover:text-green-700">Forgot password?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required
                class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors"
                placeholder="••••••••">
        </div>
        
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-600">
            <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me</label>
        </div>
        
        <button type="submit" class="w-full rounded-lg bg-green-600 px-4 py-3 font-semibold text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
            Log In
        </button>
    </form>
    
    <div class="mt-6 text-center text-sm text-gray-600">
        Don't have an account? 
        <a href="{{ route('register') }}" class="font-semibold text-green-600 hover:text-green-700 transition-colors">Register as Student</a>
    </div>
</x-auth-card>
