<x-auth-card title="Create student account">
    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-100 p-4 text-sm text-red-600 font-medium">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        
        <div class="space-y-1">
            <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors"
                placeholder="Juan Dela Cruz">
        </div>
        
        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-700">Student Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors"
                placeholder="juan@gordoncollege.edu.ph">
        </div>
        
        <div class="space-y-1">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors"
                placeholder="••••••••">
        </div>
        
        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 transition-colors"
                placeholder="••••••••">
        </div>
        
        <div class="pt-2">
            <button type="submit" class="w-full rounded-lg bg-green-600 px-4 py-3 font-semibold text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                Register
            </button>
        </div>
    </form>
    
    <div class="mt-6 text-center text-sm text-gray-600">
        Already have an account? 
        <a href="{{ route('login') }}" class="font-semibold text-green-600 hover:text-green-700 transition-colors">Log In</a>
    </div>
</x-auth-card>
