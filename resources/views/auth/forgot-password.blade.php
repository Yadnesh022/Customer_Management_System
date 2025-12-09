<x-guest-layout>
    <div class="max-w-md mx-auto p-6">
        <!-- Header -->
        <div class="text-center mb-8">
           
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h1>
            <p class="text-sm text-gray-600 max-w-sm mx-auto leading-relaxed">
                {{ __('Enter your email and we\'ll send you a link to reset your password.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6 p-3 bg-green-50 border border-green-200 rounded-xl text-green-800 text-sm" :status="session('status')" />

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                        {{ __('Email Address') }}
                    </label>
                    <div class="relative">
                        <x-text-input 
                            id="email" 
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 shadow-sm hover:shadow-md" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            placeholder="your.email@example.com"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm bg-red-50 p-2 rounded-lg border border-red-200" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl focus:ring-4 focus:ring-blue-500/50 transition-all duration-200 text-lg">
                        {{ __('Send Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Back to Login -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('Back to Login') }}
            </a>
        </div>
    </div>
</x-guest-layout>
