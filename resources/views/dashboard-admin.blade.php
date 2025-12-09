<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight flex items-center">
                   
                    Admin Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Welcome back, {{ auth()->user()?->name ?? 'Admin' }}! 
                    You have full system access.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        

            <!-- Main Statistics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Customers Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-blue-100 text-xs font-medium uppercase tracking-wide">Total Customers</p>
                            <p class="text-4xl font-bold mt-2">{{ $totalCustomers }}</p>
                            <p class="text-blue-100 text-xs mt-2">All registered</p>
                        </div>
                        <div class="bg-white bg-opacity-30 p-3 rounded-full">
                           
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-green-100 text-xs font-medium uppercase tracking-wide">Total Orders</p>
                            <p class="text-4xl font-bold mt-2">{{ $totalOrders }}</p>
                            <p class="text-green-100 text-xs mt-2">All time orders</p>
                        </div>
                       
                    </div>
                </div>

                <!-- Pending Orders Card -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-yellow-100 text-xs font-medium uppercase tracking-wide">Pending</p>
                            <p class="text-4xl font-bold mt-2">{{ $pendingOrders }}</p>
                            <p class="text-yellow-100 text-xs mt-2">Needs attention</p>
                        </div>
                       
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-purple-100 text-xs font-medium uppercase tracking-wide">Total Revenue</p>
                            <p class="text-4xl font-bold mt-2">₹{{ number_format($totalRevenue, 0) }}</p>
                            <p class="text-purple-100 text-xs mt-2">Completed orders</p>
                        </div>
                      
                    </div>
                </div>
            </div>

            <!-- Today's Performance -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Today's Performance
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                            <div>
                                <p class="text-sm text-green-700 font-semibold">Orders Completed Today</p>
                                <p class="text-3xl font-bold text-green-900">{{ $completedToday }}</p>
                            </div>
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg border border-purple-200">
                            <div>
                                <p class="text-sm text-purple-700 font-semibold">Revenue Generated Today</p>
                                <p class="text-3xl font-bold text-purple-900">₹{{ number_format($revenueToday, 2) }}</p>
                            </div>
                            <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Order Status Distribution -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Order Status Breakdown
                    </h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <p class="text-3xl font-bold text-yellow-700">{{ $ordersByStatus['pending'] ?? 0 }}</p>
                            <p class="text-xs text-yellow-600 mt-1 font-semibold">Pending</p>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                            <p class="text-3xl font-bold text-green-700">{{ $ordersByStatus['completed'] ?? 0 }}</p>
                            <p class="text-xs text-green-600 mt-1 font-semibold">Completed</p>
                        </div>
                        <div class="text-center p-4 bg-red-50 rounded-lg border border-red-200">
                            <p class="text-3xl font-bold text-red-700">{{ $ordersByStatus['cancelled'] ?? 0 }}</p>
                            <p class="text-xs text-red-600 mt-1 font-semibold">Cancelled</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Recent Orders
                        </h3>
                        <a href="{{ route('orders.index') }}" class="text-sm text-green-600 hover:text-green-800 font-semibold">View All →</a>
                    </div>
                    <div class="p-6">
                        @forelse($recentOrders as $order)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                <div class="flex items-center flex-1">
                                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center text-white font-bold text-xs mr-3">
                                        #{{ substr($order->order_number, -4) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ optional($order->customer)->name ?? 'Unknown Customer' }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">₹{{ number_format($order->amount, 2) }}</p>
                                    @if($order->status === 'completed')
                                        <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">✓ Completed</span>
                                    @elseif($order->status === 'pending')
                                        <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">⏳ Pending</span>
                                    @else
                                        <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">✗ Cancelled</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-8">No recent orders</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Customers -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Recent Customers
                        </h3>
                        <a href="{{ route('customers.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold">View All →</a>
                    </div>
                    <div class="p-6">
                        @forelse($recentCustomers as $customer)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                <div class="flex items-center flex-1">
                                    @if($customer->profile_image)
                                        <img class="h-10 w-10 rounded-full object-cover ring-2 ring-indigo-500 mr-3" src="{{ asset('storage/' . $customer->profile_image) }}" alt="{{ $customer->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-indigo-500 mr-3">
                                            {{ substr($customer->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">{{ $customer->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $customer->email }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">{{ $customer->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('customers.show', $customer) }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold">View →</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-8">No customers yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
