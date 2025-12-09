<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between animate-fade-in-down">
            <div class="flex items-center animate-slide-in-left">
                <a href="{{ route('orders.index') }}" class="mr-4 text-gray-600 hover:text-yellow-500 transition-all duration-300 hover:scale-110 group">
                    <svg class="w-6 h-6 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-bold text-3xl text-gray-900 leading-tight flex items-center animate-pulse">
                        <svg class="w-8 h-8 mr-3 text-yellow-500 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Order Details
                    </h2>
                    <p class="text-sm text-gray-600 mt-1 animate-fade-in-up">Complete order information</p>
                </div>
            </div>
            <div class="flex gap-3 animate-slide-in-right delay-200">
                <a href="{{ route('orders.edit', $order) }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 hover:shadow-2xl animate-pulse hover:animate-none group">
                    <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Order
                </a>
                @if(auth()->user()->role === 'admin')
                    <form method="POST" action="{{ route('orders.destroy', $order) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this order?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 hover:shadow-2xl animate-bounce hover:animate-none group">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Order Information -->
                <div class="lg:col-span-2 animate-slide-in-up">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden animate-float hover:shadow-3xl transition-all duration-500">
                        <div class="bg-gradient-to-r from-yellow-500 via-yellow-500 to-yellow-600 px-6 py-5 animate-gradient-shift">
                            <h3 class="text-white font-bold text-2xl flex items-center animate-slide-in-up">
                                <svg class="w-7 h-7 mr-3 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Order Information
                            </h3>
                        </div>

                        <div class="p-8">
                            <!-- Order Number -->
                            <div class="mb-8 p-8 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-2xl border-l-6 border-yellow-500 hover:shadow-xl transition-all duration-300 group animate-slide-in-up delay-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-yellow-700 font-semibold uppercase tracking-wide animate-pulse">Order Number</p>
                                        <p class="text-4xl font-black text-yellow-900 mt-2 animate-fade-in-up">{{ $order->order_number }}</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-5 rounded-2xl shadow-lg animate-bounce-slow hover:animate-none group-hover:scale-110 transition-all duration-300">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Amount -->
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-2xl border-2 border-yellow-200 hover:border-yellow-300 hover:shadow-2xl transition-all duration-400 group animate-slide-in-left delay-200">
                                    <div class="flex items-center mb-4 group-hover:text-yellow-600 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-yellow-500 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-sm font-bold text-yellow-700 uppercase tracking-wide">Amount</p>
                                    </div>
                                    <p class="text-4xl font-black text-yellow-900 group-hover:scale-105 transition-transform duration-300">₹{{ number_format($order->amount, 2) }}</p>
                                </div>

                                <!-- Status -->
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-2xl border-2 border-yellow-200 hover:border-yellow-300 hover:shadow-2xl transition-all duration-400 group animate-slide-in-right delay-200">
                                    <div class="flex items-center mb-4 group-hover:text-yellow-600 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-yellow-500 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-sm font-bold text-yellow-700 uppercase tracking-wide">Status</p>
                                    </div>
                                    @if($order->status === 'completed')
                                        <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-black bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-4 border-green-400 shadow-lg animate-bounce-slow">
                                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Completed
                                        </span>
                                    @elseif($order->status === 'pending')
                                        <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-black bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border-4 border-yellow-400 shadow-lg animate-pulse">
                                            <svg class="w-6 h-6 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-black bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-4 border-red-400 shadow-lg animate-shake">
                                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Cancelled
                                        </span>
                                    @endif
                                </div>

                                <!-- Order Date -->
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-2xl border-2 border-yellow-200 hover:border-yellow-300 hover:shadow-2xl transition-all duration-400 group animate-slide-in-left delay-300">
                                    <div class="flex items-center mb-4 group-hover:text-yellow-600 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-yellow-500 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-sm font-bold text-yellow-700 uppercase tracking-wide">Order Date</p>
                                    </div>
                                    <p class="text-2xl font-black text-yellow-900 group-hover:scale-105 transition-transform duration-300">{{ $order->order_date->format('F d, Y') }}</p>
                                </div>

                                <!-- Created At -->
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-2xl border-2 border-yellow-200 hover:border-yellow-300 hover:shadow-2xl transition-all duration-400 group animate-slide-in-right delay-300">
                                    <div class="flex items-center mb-4 group-hover:text-yellow-600 transition-colors duration-300">
                                        <svg class="w-6 h-6 text-yellow-500 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-sm font-bold text-yellow-700 uppercase tracking-wide">Created At</p>
                                    </div>
                                    <p class="text-xl font-bold text-yellow-900 group-hover:scale-105 transition-transform duration-300">{{ $order->created_at->format('M d, Y H:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="lg:col-span-1 animate-slide-in-up delay-100">
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden animate-float hover:shadow-3xl transition-all duration-500">
                        <div class="bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-700 px-6 py-5 animate-gradient-shift">
                            <h3 class="text-white font-bold text-2xl flex items-center animate-slide-in-up">
                                <svg class="w-7 h-7 mr-3 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Customer Details
                            </h3>
                        </div>

                        <div class="p-8">
                            <div class="text-center mb-8 animate-fade-in-up">
                                @if($order->customer->profile_image)
                                    <img src="{{ asset('storage/' . $order->customer->profile_image) }}" 
                                         alt="{{ $order->customer->name }}" 
                                         class="w-28 h-28 rounded-full object-cover mx-auto ring-8 ring-yellow-400/50 shadow-2xl hover:scale-110 hover:rotate-3 transition-all duration-500 animate-pulse">
                                @else
                                    <div class="w-28 h-28 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-white font-black text-4xl mx-auto ring-8 ring-yellow-400/50 shadow-2xl hover:scale-110 hover:rotate-3 transition-all duration-500 animate-pulse">
                                        {{ substr($order->customer->name, 0, 2) }}
                                    </div>
                                @endif
                                <h4 class="text-2xl font-black text-gray-900 mt-6 animate-slide-in-up">{{ $order->customer->name }}</h4>
                                <p class="text-sm text-yellow-600 font-semibold bg-yellow-100 px-3 py-1 rounded-full inline-block animate-bounce-slow">Customer ID: #{{ $order->customer->id }}</p>
                            </div>

                            <div class="space-y-4">
                                <!-- Email -->
                                <div class="flex items-start p-6 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-2xl border-2 border-yellow-200 hover:shadow-lg transition-all duration-300 group animate-slide-in-up delay-400">
                                    <svg class="w-6 h-6 text-yellow-500 mr-4 mt-1 group-hover:animate-pulse transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <div class="flex-1 group-hover:text-yellow-900 transition-colors duration-300">
                                        <p class="text-xs text-yellow-600 uppercase font-bold tracking-wide">Email</p>
                                        <p class="text-sm text-gray-900 font-semibold break-all hover:text-yellow-600 transition-colors duration-300">{{ $order->customer->email }}</p>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="flex items-start p-6 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-2xl border-2 border-yellow-200 hover:shadow-lg transition-all duration-300 group animate-slide-in-up delay-500">
                                    <svg class="w-6 h-6 text-yellow-500 mr-4 mt-1 group-hover:animate-pulse transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <div class="flex-1 group-hover:text-yellow-900 transition-colors duration-300">
                                        <p class="text-xs text-yellow-600 uppercase font-bold tracking-wide">Phone</p>
                                        <p class="text-sm text-gray-900 font-semibold hover:text-yellow-600 transition-colors duration-300">{{ $order->customer->phone }}</p>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="flex items-start p-6 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-2xl border-2 border-yellow-200 hover:shadow-lg transition-all duration-300 group animate-slide-in-up delay-600">
                                    <svg class="w-6 h-6 text-yellow-500 mr-4 mt-1 group-hover:animate-pulse transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div class="flex-1 group-hover:text-yellow-900 transition-colors duration-300">
                                        <p class="text-xs text-yellow-600 uppercase font-bold tracking-wide">Address</p>
                                        <p class="text-sm text-gray-900 font-semibold hover:text-yellow-600 transition-colors duration-300">{{ $order->customer->address }}</p>
                                    </div>
                                </div>

                                <!-- View Customer Button -->
                                <a href="{{ route('customers.show', $order->customer) }}" 
                                   class="block w-full text-center px-6 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 active:scale-95 animate-bounce-slow hover:animate-none group">
                                    <svg class="w-6 h-6 inline mr-3 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Full Customer Profile
                                </a>
                            </div>
                        </div>
                    </div>
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
    50% { transform: translateY(-12px); }
}
@keyframes fade-in-down {
    from { opacity: 0; transform: translateY(-40px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slide-in-left {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slide-in-right {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slide-in-up {
    from { opacity: 0; transform: translateY(40px); }
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
    50% { transform: translateY(-8px); }
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    75% { transform: translateX(6px); }
}

.animate-gradient-shift { 
    background: linear-gradient(-45deg, #fbbf24, #f59e0b, #d97706, #eab308);
    background-size: 400% 400%;
    animation: gradient-shift 12s ease infinite;
}
.animate-float { animation: float 7s ease-in-out infinite; }
.animate-bounce-slow { animation: bounce-slow 4s infinite; }
.animate-spin-slow { animation: spin-slow 5s linear infinite; }
.animate-fade-in-down { animation: fade-in-down 0.8s ease-out; }
.animate-slide-in-left { animation: slide-in-left 0.8s ease-out; }
.animate-slide-in-right { animation: slide-in-right 0.8s ease-out; }
.animate-slide-in-up { animation: slide-in-up 0.8s ease-out; }
.animate-fade-in-up { animation: fade-in-up 0.8s ease-out; }
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }
</style>
