<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center animate-fade-in-down">
            <a href="{{ route('orders.index') }}" class="mr-4 text-gray-600 hover:text-gray-900 transition-all duration-300 hover:scale-110">
                <svg class="w-6 h-6 transition-transform duration-300 hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div class="animate-pulse">
                <h2 class="font-bold text-3xl text-gray-900 leading-tight flex items-center animate-slide-in-right">
                    <svg class="w-8 h-8 mr-3 text-yellow-500 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Order
                </h2>
                <p class="text-sm text-gray-600 mt-1 animate-fade-in">Update order information below</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-float hover:shadow-2xl transition-all duration-500">
                <div class="bg-gradient-to-r from-yellow-500 via-yellow-500 to-yellow-600 px-6 py-4 animate-gradient-shift">
                    <h3 class="text-white font-bold text-xl flex items-center animate-slide-in-up">
                        <svg class="w-6 h-6 mr-2 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Order Information
                    </h3>
                    <p class="text-yellow-100 text-sm mt-1 animate-pulse">Order #{{ $order->order_number }}</p>
                </div>

                <form method="POST" action="{{ route('orders.update', $order) }}" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Selection -->
                        <div class="col-span-2 group">
                            <label class="block text-gray-700 text-sm font-bold mb-2 group-hover:text-yellow-600 transition-colors duration-300">
                                <svg class="w-4 h-4 inline mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Customer <span class="text-yellow-500 animate-ping">*</span>
                            </label>
                            <select name="customer_id" 
                                    class="w-full border-2 @error('customer_id') border-yellow-500 animate-shake @else border-gray-300 focus:border-yellow-500 @enderror rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-200 transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" 
                                            {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p class="text-yellow-500 text-xs mt-1 flex items-center animate-bounce">
                                    <svg class="w-4 h-4 mr-1 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Order Number (Read-only) -->
                        <div class="col-span-2 md:col-span-1 animate-slide-in-left delay-100">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Order Number
                            </label>
                            <input type="text" value="{{ $order->order_number }}" readonly
                                   class="w-full border-2 border-gray-300 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg px-4 py-3 text-gray-600 cursor-not-allowed hover:bg-yellow-100 transition-all duration-300">
                            <p class="text-xs text-gray-500 mt-1 animate-fade-in">Order number cannot be changed</p>
                        </div>

                        <!-- Amount -->
                        <div class="col-span-2 md:col-span-1 animate-slide-in-right delay-200">
                            <label class="block text-gray-700 text-sm font-bold mb-2 hover:text-yellow-600 transition-colors duration-300">
                                <svg class="w-4 h-4 inline mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Amount (₹) <span class="text-yellow-500 animate-ping">*</span>
                            </label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold group-hover:text-yellow-500 transition-colors duration-300">₹</span>
                                <input type="number" name="amount" step="0.01" min="0" 
                                       value="{{ old('amount', $order->amount) }}" 
                                       placeholder="0.00"
                                       class="w-full pl-8 border-2 @error('amount') border-yellow-500 animate-shake @else border-gray-300 focus:border-yellow-500 @enderror rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-200 transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            </div>
                            @error('amount')
                                <p class="text-yellow-500 text-xs mt-1 flex items-center animate-bounce">
                                    <svg class="w-4 h-4 mr-1 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-2 md:col-span-1 animate-slide-in-left delay-300">
                            <label class="block text-gray-700 text-sm font-bold mb-2 hover:text-yellow-600 transition-colors duration-300">
                                <svg class="w-4 h-4 inline mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Order Status <span class="text-yellow-500 animate-ping">*</span>
                            </label>
                            <select name="status" 
                                    class="w-full border-2 @error('status') border-yellow-500 animate-shake @else border-gray-300 focus:border-yellow-500 @enderror rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-200 transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>
                                    ⏳ Pending
                                </option>
                                <option value="completed" {{ old('status', $order->status) === 'completed' ? 'selected' : '' }}>
                                    ✅ Completed
                                </option>
                                <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>
                                    ❌ Cancelled
                                </option>
                            </select>
                            @error('status')
                                <p class="text-yellow-500 text-xs mt-1 flex items-center animate-bounce">
                                    <svg class="w-4 h-4 mr-1 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Order Date -->
                        <div class="col-span-2 md:col-span-1 animate-slide-in-right delay-400">
                            <label class="block text-gray-700 text-sm font-bold mb-2 hover:text-yellow-600 transition-colors duration-300">
                                <svg class="w-4 h-4 inline mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Order Date <span class="text-yellow-500 animate-ping">*</span>
                            </label>
                            <input type="date" name="order_date" 
                                   value="{{ old('order_date', $order->order_date->format('Y-m-d')) }}" 
                                   class="w-full border-2 @error('order_date') border-yellow-500 animate-shake @else border-gray-300 focus:border-yellow-500 @enderror rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-200 transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            @error('order_date')
                                <p class="text-yellow-500 text-xs mt-1 flex items-center animate-bounce">
                                    <svg class="w-4 h-4 mr-1 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

               

                    <!-- Action Buttons -->
                    <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:rotate-1 active:scale-95 group animate-bounce-slow">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Order
                        </button>
                        <a href="{{ route('orders.show', $order) }}" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:rotate-[-2deg] active:scale-95 animate-pulse">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex-1 inline-flex justify-center items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:rotate-1 active:scale-95 animate-bounce">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
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
    50% { transform: translateY(-10px); }
}
@keyframes fade-in-down {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slide-in-right {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slide-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slide-in-left {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes gradient-flow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}
.fade-in { animation: fade-in-down 0.6s ease-out; }
.slide-in-right { animation: slide-in-right 0.6s ease-out; }
.slide-in-up { animation: slide-in-up 0.6s ease-out; }
.slide-in-left { animation: slide-in-left 0.6s ease-out 0.2s both; }
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-gradient-shift { 
    background: linear-gradient(-45deg, #fbbf24, #f59e0b, #d97706, #fbbf24);
    background-size: 400% 400%;
    animation: gradient-shift 15s ease infinite;
}
.animate-gradient-flow {
    background: linear-gradient(90deg, #fef3c7, #fde68a, #fcd34d, #fef3c7);
    background-size: 400% 400%;
    animation: gradient-flow 8s ease infinite;
}
.animate-spin-slow { animation: spin-slow 3s linear infinite; }
.animate-bounce-slow { animation: bounce-slow 3s infinite; }
.hover\:scale-105:hover { transform: scale(1.05); }
.group:hover .group-hover\:text-yellow-600 { color: #ca8a04; }
</style>
