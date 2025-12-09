<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in-down">
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight flex items-center animate-slide-in-right">
                <i class="fas fa-shopping-cart mr-3 text-yellow-500 animate-bounce-slow"></i>
                {{ __('Create Order') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-gradient-to-br from-white to-yellow-50 shadow-2xl border border-yellow-100 rounded-3xl overflow-hidden animate-float hover:shadow-3xl transition-all duration-500">
                <div class="p-8">
                    <!-- Header Card -->
                    <div class="text-center mb-8 animate-slide-in-up">
                       
                        <h3 class="text-4xl font-bold bg-gradient-to-r from-yellow-600 to-yellow-800 bg-clip-text text-transparent mb-3 animate-pulse">
                            New Order
                        </h3>
                        <p class="text-gray-600 text-lg animate-fade-in-up">Fill in the details to create a new order</p>
                    </div>

                    <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                        @csrf

                        <!-- Customer Field -->
                        <div class="group animate-slide-in-left delay-100">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center group-hover:text-yellow-600 transition-all duration-300">
                                <i class="fas fa-user-circle mr-2 text-yellow-500 animate-pulse"></i>
                                Customer
                            </label>
                            <div class="relative">
                                <select name="customer_id" 
                                        class="w-full appearance-none bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-2xl px-5 py-5 text-lg shadow-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition-all duration-400 hover:border-yellow-300 hover:shadow-xl hover:scale-[1.02] hover:bg-white @error('customer_id') border-yellow-400 ring-2 ring-yellow-200 focus:ring-yellow-200 animate-shake @enderror">
                                    <option value="">👤 Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 group-hover:text-yellow-500 transition-colors duration-300">
                                    <i class="fas fa-chevron-down text-gray-400 group-hover:animate-pulse"></i>
                                </div>
                            </div>
                            @error('customer_id')
                                <p class="mt-2 text-yellow-500 text-sm flex items-center animate-bounce">
                                    <i class="fas fa-exclamation-circle mr-1 animate-spin"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Amount Field -->
                        <div class="group animate-slide-in-right delay-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center group-hover:text-yellow-600 transition-all duration-300">
                                <i class="fas fa-rupee-sign mr-2 text-yellow-500 animate-pulse"></i>
                                Amount
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-yellow-500 font-bold text-xl z-10">
                                    <i class="fas fa-rupee-sign"></i>
                                </div>
                                <input type="number" name="amount" step="0.01" 
                                       value="{{ old('amount') }}" 
                                       placeholder="0.00"
                                       class="w-full pl-12 bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-2xl px-5 py-5 text-lg shadow-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition-all duration-400 hover:border-yellow-300 hover:shadow-xl hover:scale-[1.02] hover:bg-white @error('amount') border-yellow-400 ring-2 ring-yellow-200 focus:ring-yellow-200 animate-shake @enderror">
                            </div>
                            @error('amount')
                                <p class="mt-2 text-yellow-500 text-sm flex items-center animate-bounce">
                                    <i class="fas fa-exclamation-circle mr-1 animate-spin"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="group animate-slide-in-left delay-300">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center group-hover:text-yellow-600 transition-all duration-300">
                                <i class="fas fa-toggle-on mr-2 text-yellow-500 animate-pulse"></i>
                                Status
                            </label>
                            <select name="status" 
                                    class="w-full appearance-none bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-2xl px-5 py-5 text-lg shadow-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition-all duration-400 hover:border-yellow-300 hover:shadow-xl hover:scale-[1.02] hover:bg-white @error('status') border-yellow-400 ring-2 ring-yellow-200 focus:ring-yellow-200 animate-shake @enderror">
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-yellow-500 text-sm flex items-center animate-bounce">
                                    <i class="fas fa-exclamation-circle mr-1 animate-spin"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Order Date Field -->
                        <div class="group animate-slide-in-right delay-400">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center group-hover:text-yellow-600 transition-all duration-300">
                                <i class="fas fa-calendar-alt mr-2 text-yellow-500 animate-pulse"></i>
                                Order Date
                            </label>
                            <input type="date" name="order_date" 
                                   value="{{ old('order_date', date('Y-m-d')) }}" 
                                   class="w-full bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-2xl px-5 py-5 text-lg shadow-lg focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 transition-all duration-400 hover:border-yellow-300 hover:shadow-xl hover:scale-[1.02] hover:bg-white @error('order_date') border-yellow-400 ring-2 ring-yellow-200 focus:ring-yellow-200 animate-shake @enderror">
                            @error('order_date')
                                <p class="mt-2 text-yellow-500 text-sm flex items-center animate-bounce">
                                    <i class="fas fa-exclamation-circle mr-1 animate-spin"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-yellow-100 animate-fade-in-up delay-500">
                            <button type="submit" 
                                    class="flex-1 group bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 hover:from-yellow-600 hover:via-yellow-700 hover:to-yellow-800 text-white font-bold py-5 px-8 rounded-2xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-2 active:scale-95 transition-all duration-300 flex items-center justify-center text-xl animate-bounce-slow hover:animate-none">
                                <i class="fas fa-plus-circle mr-3 group-hover:animate-bounce text-xl"></i>
                                Create Order
                            </button>
                            <a href="{{ route('orders.index') }}" 
                               class="flex-1 group bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-2 active:scale-95 transition-all duration-300 flex items-center justify-center text-xl animate-pulse hover:animate-none">
                                <i class="fas fa-arrow-left mr-3 group-hover:rotate-180"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}
@keyframes fade-in-down {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slide-in-right {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slide-in-left {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slide-in-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.animate-gradient-shift { 
    background: linear-gradient(-45deg, #fbbf24, #f59e0b, #d97706, #eab308);
    background-size: 400% 400%;
    animation: gradient-shift 8s ease infinite;
}
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-bounce-slow { animation: bounce-slow 4s infinite; }
.animate-spin-slow { animation: spin-slow 4s linear infinite; }
.animate-fade-in-down { animation: fade-in-down 0.8s ease-out; }
.animate-slide-in-right { animation: slide-in-right 0.7s ease-out; }
.animate-slide-in-left { animation: slide-in-left 0.7s ease-out; }
.animate-slide-in-up { animation: slide-in-up 0.7s ease-out; }
.animate-fade-in-up { animation: fade-in-up 0.8s ease-out 0.3s both; }
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
</style>
