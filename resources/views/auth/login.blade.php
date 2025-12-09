<x-guest-layout>
    <style>
        @keyframes floatUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-float-up {
            animation: floatUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        /* Hide scrollbar for cleaner look if needed */
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>

    <x-auth-session-status class="mb-8 p-4 bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-200/50 rounded-2xl text-amber-800 backdrop-blur-sm shadow-sm animate-float-up" :status="session('status')" />

    <div class="max-w-sm mx-auto">
        <div class="text-center mb-10 animate-float-up" style="animation-delay: 0.1s;">
            <h1 class="text-3xl font-black text-amber-900 tracking-tight mb-2">Sign In</h1>
            <p class="text-sm text-amber-600 font-medium">Access your account securely</p>
        </div>

        <div class="bg-white/90 border border-amber-100/50 shadow-xl rounded-3xl p-10 backdrop-blur-sm hover:shadow-2xl hover:border-amber-200/70 transition-all duration-500 animate-float-up" style="animation-delay: 0.2s;">
            <form method="POST" action="{{ route('login') }}" class="space-y-8">
                @csrf

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                        <svg class="w-5 h-5 text-amber-400 group-focus-within:text-amber-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>

                    <x-text-input 
                        id="email" 
                        class="block w-full pl-12 pr-5 pt-6 pb-2 text-base border-2 border-amber-200/70 rounded-2xl focus:ring-4 focus:ring-amber-400/40 focus:border-amber-400 transition-all duration-300 bg-gradient-to-r from-amber-50/50 to-yellow-50/50 backdrop-blur-sm shadow-inner peer placeholder-transparent" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="Email Address" 
                    />

                    <label for="email" 
                        class="absolute left-12 top-4 text-amber-700/70 font-bold text-sm transition-all duration-300 transform -translate-y-3 scale-75 origin-[0] 
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:text-base peer-placeholder-shown:text-amber-600/60
                        peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:text-amber-800 cursor-text pointer-events-none">
                        Email Address
                    </label>

                    <x-input-error :messages="$errors->get('email')" class="mt-3 text-red-600 text-xs bg-red-50/80 border border-red-200/50 px-3 py-2 rounded-xl backdrop-blur-sm font-medium" />
                </div>

                <div class="relative group" x-data="{ show: false }">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                        <svg class="w-5 h-5 text-amber-400 group-focus-within:text-amber-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>

                    <x-text-input 
                        id="password" 
                        class="block w-full pl-12 pr-12 pt-6 pb-2 text-base border-2 border-amber-200/70 rounded-2xl focus:ring-4 focus:ring-amber-400/40 focus:border-amber-400 transition-all duration-300 bg-gradient-to-r from-amber-50/50 to-yellow-50/50 backdrop-blur-sm shadow-inner peer placeholder-transparent" 
                        x-bind:type="show ? 'text' : 'password'"
                        name="password"
                        required 
                        autocomplete="current-password"
                        placeholder="Password"
                    />

                    <label for="password" 
                        class="absolute left-12 top-4 text-amber-700/70 font-bold text-sm transition-all duration-300 transform -translate-y-3 scale-75 origin-[0] 
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:text-base peer-placeholder-shown:text-amber-600/60
                        peer-focus:-translate-y-3 peer-focus:scale-75 peer-focus:text-amber-800 cursor-text pointer-events-none">
                        Password
                    </label>

                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-amber-400 hover:text-amber-600 focus:outline-none transition-colors duration-200 z-20">
                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="show" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        </svg>
                    </button>

                    <x-input-error :messages="$errors->get('password')" class="mt-3 text-red-600 text-xs bg-red-50/80 border border-red-200/50 px-3 py-2 rounded-xl backdrop-blur-sm font-medium" />
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-amber-200/50 animate-float-up" style="animation-delay: 0.3s;">
                    <label for="remember_me" class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex-shrink-0">
                            <input id="remember_me" type="checkbox" class="w-6 h-6 border-2 border-amber-300 rounded-xl focus:ring-amber-400 focus:ring-2 bg-white shadow-sm transition-all duration-200 peer" name="remember">
                            <div class="absolute inset-0 w-6 h-6 border-2 border-amber-500 rounded-xl bg-amber-500/20 opacity-0 peer-checked:opacity-100 peer-focus:opacity-100 transition-all duration-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <span class="text-sm text-amber-700 font-semibold group-hover:text-amber-900 transition-colors">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-bold text-amber-700 hover:text-amber-900 transition-all duration-200 hover:underline hover:decoration-amber-300 group/link inline-flex items-center gap-1" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <div class="animate-float-up" style="animation-delay: 0.4s;">
                    <x-primary-button class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-bold py-5 px-6 rounded-2xl text-lg shadow-2xl hover:shadow-3xl hover:scale-[1.02] active:scale-[0.98] transform transition-all duration-300 focus:ring-4 focus:ring-amber-500/40 border-0 tracking-wide uppercase">
                        Sign In
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="mt-10 text-center animate-float-up" style="animation-delay: 0.5s;">
            <p class="text-sm text-amber-600 font-medium">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-amber-900 hover:text-amber-700 transition-all duration-200 hover:underline decoration-amber-300 ml-1 tracking-wide">Create Account</a>
            </p>
        </div>
    </div>
</x-guest-layout>