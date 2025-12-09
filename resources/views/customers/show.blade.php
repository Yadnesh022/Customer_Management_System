<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-4xl text-amber-900 leading-tight tracking-tight flex items-center">
            <svg class="w-12 h-12 mr-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            Customer Details
        </h2>
    </x-slot>

    <div class="py-16 bg-gradient-to-br from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Customer Profile Card -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden mb-10 border border-amber-100/50 hover:shadow-4xl transition-all duration-500">
                <div class="bg-gradient-to-r from-amber-500 via-yellow-500 to-amber-600 px-10 py-8">
                    <h3 class="text-3xl font-black text-white flex items-center">
                        <svg class="w-12 h-12 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Profile Information
                    </h3>
                </div>
                <div class="p-12">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center gap-10 lg:gap-16">
                        @if($customer->profile_image)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $customer->profile_image) }}" 
                                     alt="{{ $customer->name }}" 
                                     class="w-40 h-40 rounded-3xl object-cover shadow-2xl ring-8 ring-amber-200/50 hover:scale-105 transition-all duration-500 border-8 border-white/50">
                            </div>
                        @else
                            <div class="w-40 h-40 bg-gradient-to-br from-amber-400 to-yellow-400 rounded-3xl flex items-center justify-center shadow-2xl ring-8 ring-amber-200/50 border-8 border-white/50 flex-shrink-0">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="flex-1 space-y-8">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div class="group">
                                    <p class="text-amber-600 text-lg font-bold mb-2 flex items-center tracking-wide">
                                        <svg class="w-6 h-6 mr-2 text-amber-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Email
                                    </p>
                                    <p class="text-2xl font-black text-amber-900">{{ $customer->email }}</p>
                                </div>
                                <div class="group">
                                    <p class="text-amber-600 text-lg font-bold mb-2 flex items-center tracking-wide">
                                        <svg class="w-6 h-6 mr-2 text-amber-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        Phone
                                    </p>
                                    <p class="text-2xl font-black text-amber-900">{{ $customer->phone }}</p>
                                </div>
                                <div class="lg:col-span-2 group">
                                    <p class="text-amber-600 text-lg font-bold mb-4 flex items-center tracking-wide">
                                        <svg class="w-6 h-6 mr-2 text-amber-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Address
                                    </p>
                                    <p class="text-xl font-black text-amber-900 leading-relaxed bg-gradient-to-r from-amber-50/50 to-yellow-50/50 p-6 rounded-3xl border border-amber-200/50 backdrop-blur-sm shadow-xl">{{ $customer->address }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-4 border-amber-200/50">
                                <a href="{{ route('customers.edit', $customer) }}" 
                                   class="group flex-1 inline-flex justify-center items-center px-10 py-5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-black text-xl rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-400 transform hover:scale-[1.02] hover:-translate-y-1 border-2 border-emerald-400">
                                    <svg class="w-7 h-7 mr-4 group-hover:rotate-12 transition-transform duration-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Customer
                                </a>
                                <a href="{{ route('customers.index') }}" 
                                   class="group flex-1 inline-flex justify-center items-center px-10 py-5 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-amber-900 font-black text-xl rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-400 transform hover:scale-[1.02] hover:-translate-y-1 border-2 border-amber-200">
                                    <svg class="w-7 h-7 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-amber-100/50 hover:shadow-4xl transition-all duration-500">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-10 py-8">
                    <h3 class="text-3xl font-black text-white flex items-center">
                        <svg class="w-12 h-12 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Order History
                    </h3>
                </div>
                <div class="p-12">
                    @if($customer->orders->count() > 0)
                        <div class="overflow-x-auto rounded-3xl border border-amber-200/50">
                            <table class="min-w-full divide-y divide-amber-100/50">
                                <thead class="bg-gradient-to-r from-amber-50 to-yellow-50">
                                    <tr>
                                        <th class="px-8 py-6 text-left text-lg font-black text-amber-900 uppercase tracking-widest">Order Number</th>
                                        <th class="px-8 py-6 text-left text-lg font-black text-amber-900 uppercase tracking-widest">Amount</th>
                                        <th class="px-8 py-6 text-left text-lg font-black text-amber-900 uppercase tracking-widest">Status</th>
                                        <th class="px-8 py-6 text-left text-lg font-black text-amber-900 uppercase tracking-widest">Order Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-amber-100/30">
                                    @foreach($customer->orders as $order)
                                        <tr class="hover:bg-amber-50/50 transition-all duration-300 group">
                                            <td class="px-8 py-8">
                                                <span class="text-2xl font-black text-amber-900">#{{ $order->order_number }}</span>
                                            </td>
                                            <td class="px-8 py-8">
                                                <span class="text-2xl font-black text-emerald-600">₹{{ number_format($order->amount, 2) }}</span>
                                            </td>
                                            <td class="px-8 py-8">
                                                <span class="inline-flex items-center px-6 py-3 rounded-2xl text-lg font-bold text-white shadow-lg
                                                    @if($order->status === 'completed') bg-gradient-to-r from-emerald-500 to-teal-500
                                                    @elseif($order->status === 'pending') bg-gradient-to-r from-amber-500 to-yellow-500
                                                    @else bg-gradient-to-r from-red-500 to-rose-500
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-8">
                                                <span class="text-xl font-bold text-amber-700">{{ $order->order_date->format('M d, Y') }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-20">
                            <svg class="mx-auto h-32 w-32 text-amber-200 mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h4 class="text-3xl font-black text-amber-500 mb-4">No Orders Yet</h4>
                            <p class="text-xl text-amber-600 font-semibold mb-8">This customer hasn't placed any orders</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
