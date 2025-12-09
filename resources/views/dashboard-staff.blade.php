<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-4xl text-amber-900 leading-tight tracking-tight">
                    Dashboard Overview
                </h2>
                <p class="text-lg text-amber-700 mt-2 font-semibold">Welcome back, {{ Auth::user()->name }}! </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Role Badge -->
            <div class="mb-8">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-800 border-2 border-amber-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"></path>
                    </svg>
                    {{ ucfirst(Auth::user()->role) }} Dashboard
                </span>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Total Customers Card -->
                <div class="group bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-amber-100/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 hover:border-amber-200/70">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-amber-700 text-sm font-bold uppercase tracking-wider mb-3">Total Customers</p>
                            <p class="text-5xl font-black text-amber-900 mb-3 group-hover:text-amber-800 transition-colors">{{ $totalCustomers }}</p>
                            <a href="{{ route('customers.index') }}" class="text-amber-600 text-sm font-bold hover:text-amber-800 transition-colors inline-flex items-center">
                                View all 
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-amber-400 to-yellow-400 p-5 rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-300">
                            
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="group bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-amber-100/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 hover:border-amber-200/70">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-amber-700 text-sm font-bold uppercase tracking-wider mb-3">Total Orders</p>
                            <p class="text-5xl font-black text-amber-900 mb-3 group-hover:text-amber-800 transition-colors">{{ $totalOrders }}</p>
                            <a href="{{ route('orders.index') }}" class="text-amber-600 text-sm font-bold hover:text-amber-800 transition-colors inline-flex items-center">
                                View all 
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-400 to-teal-400 p-5 rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-300">
                           
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="group bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-amber-100/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 hover:border-amber-200/70">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-amber-700 text-sm font-bold uppercase tracking-wider mb-3">Total Revenue</p>
                            <p class="text-5xl font-black text-amber-900 mb-3 group-hover:text-amber-800 transition-colors">₹{{ number_format($totalRevenue, 0) }}</p>
                            <p class="text-amber-600 text-sm font-medium mt-1">Completed orders</p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-400 to-pink-400 p-5 rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-300">
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Status Cards -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl mb-12 overflow-hidden border border-amber-100/50">
                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-8 py-6 border-b border-amber-200/50">
                    <h3 class="text-2xl font-black text-amber-900 flex items-center">
                       
                        Orders Overview
                    </h3>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Pending -->
                        <div class="group bg-gradient-to-br from-amber-50 to-yellow-50 rounded-2xl p-8 border-2 border-amber-200/50 hover:shadow-xl hover:border-amber-400/70 transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-yellow-400 rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">
                                   
                                </div>
                                <p class="text-amber-800 text-lg font-bold">Pending Orders</p>
                            </div>
                            <p class="text-6xl font-black text-amber-600 mb-4">{{ $ordersByStatus['pending'] ?? 0 }}</p>
                            <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="text-amber-700 text-sm font-bold hover:text-amber-900 transition-colors inline-flex items-center">
                                View pending 
                            </a>
                        </div>

                        <!-- Completed -->
                        <div class="group bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-8 border-2 border-emerald-200/50 hover:shadow-xl hover:border-emerald-400/70 transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-400 rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">

                                </div>
                                <p class="text-emerald-800 text-lg font-bold">Completed Orders</p>
                            </div>
                            <p class="text-6xl font-black text-emerald-600 mb-4">{{ $ordersByStatus['completed'] ?? 0 }}</p>
                            <a href="{{ route('orders.index', ['status' => 'completed']) }}" class="text-emerald-700 text-sm font-bold hover:text-emerald-900 transition-colors inline-flex items-center">
                                View completed 
                            </a>
                        </div>

                        <!-- Cancelled -->
                        <div class="group bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl p-8 border-2 border-red-200/50 hover:shadow-xl hover:border-red-400/70 transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-rose-400 rounded-2xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform">
                                    
                                </div>
                                <p class="text-red-800 text-lg font-bold">Cancelled Orders</p>
                            </div>
                            <p class="text-6xl font-black text-red-600 mb-4">{{ $ordersByStatus['cancelled'] ?? 0 }}</p>
                            <a href="{{ route('orders.index', ['status' => 'cancelled']) }}" class="text-red-700 text-sm font-bold hover:text-red-900 transition-colors inline-flex items-center">
                                View cancelled 
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Customers -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-amber-100/50">
                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-8 py-6 border-b border-amber-200/50 flex justify-between items-center">
                    <h3 class="text-2xl font-black text-amber-900 flex items-center">
                        <svg class="w-8 h-8 mr-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Recent Customers
                    </h3>
                    <a href="{{ route('customers.index') }}" class="text-lg text-amber-700 hover:text-amber-900 font-bold transition-colors">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-amber-100/50">
                        <thead class="bg-amber-50/50">
                            <tr>
                                <th class="px-8 py-4 text-left text-sm font-bold text-amber-800 uppercase tracking-wider">Customer</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-amber-800 uppercase tracking-wider">Contact</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-amber-800 uppercase tracking-wider">Joined</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-amber-800 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-amber-100/30">
                            @forelse($recentCustomers as $customer)
                                <tr class="hover:bg-amber-50/50 transition-all duration-200 hover:shadow-sm">
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($customer->profile_image)
                                                <img class="h-12 w-12 rounded-2xl object-cover ring-3 ring-amber-300/50 shadow-lg" src="{{ asset('storage/' . $customer->profile_image) }}" alt="{{ $customer->name }}">
                                            @else
                                                <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-amber-400 to-yellow-400 flex items-center justify-center text-white font-bold text-lg ring-3 ring-amber-300/50 shadow-lg">
                                                    {{ substr($customer->name, 0, 2) }}
                                                </div>
                                            @endif
                                            <div class="ml-5">
                                                <div class="text-lg font-bold text-amber-900">{{ $customer->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="text-lg text-amber-800 font-semibold">{{ $customer->email }}</div>
                                        <div class="text-sm text-amber-600">{{ $customer->phone }}</div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <span class="text-sm text-amber-600 font-medium">{{ $customer->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm font-bold">
                                        <a href="{{ route('customers.show', $customer) }}" class="text-amber-600 hover:text-amber-800 bg-amber-100 hover:bg-amber-200 px-5 py-2 rounded-xl transition-all duration-200 inline-flex items-center font-semibold">
                                            View Details → 
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-12 text-center text-amber-500">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <p class="text-xl font-semibold">No customers yet</p>
                                        <p class="text-amber-400 mt-2">Get started by adding your first customer</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
