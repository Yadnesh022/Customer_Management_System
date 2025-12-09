<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">
            <div>
                <h2 class="font-black text-4xl text-amber-900 leading-tight flex items-center tracking-tight">
                    <svg class="w-10 h-10 mr-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Customers
                </h2>
                <p class="text-lg text-amber-700 mt-2 font-semibold">Manage and track all your customers</p>
            </div>
            <a href="{{ route('customers.create') }}" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-bold rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-[1.02] hover:-translate-y-1 border-2 border-amber-400">
                <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Customer
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-amber-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 p-6 rounded-3xl shadow-xl backdrop-blur-sm border border-emerald-200/50">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-emerald-500 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-emerald-800 text-lg font-bold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-amber-100/50 hover:shadow-3xl transition-all duration-500">
                <!-- Search and Export Section -->
                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-8 py-8 border-b border-amber-200/50">
                    <div class="flex flex-col lg:flex-row lg:justify-between gap-6">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('customers.index') }}" class="flex-1 max-w-2xl">
                            <div class="flex gap-3">
                                <div class="relative flex-1 group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-6 w-6 text-amber-400 group-focus-within:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" placeholder="Search by name, email or phone..." 
                                           value="{{ request('search') }}"
                                           class="pl-14 w-full border-2 border-amber-200/70 rounded-3xl px-6 py-4 text-lg focus:ring-4 focus:ring-amber-400/50 focus:border-amber-500 transition-all duration-300 bg-gradient-to-r from-amber-50/80 to-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover:border-amber-300 group-hover:border-amber-300">
                                </div>
                                <button type="submit" class="px-10 py-4 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] hover:-translate-y-1 border border-amber-400 whitespace-nowrap">
                                    Search
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('customers.index') }}" class="px-10 py-4 bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-800 font-bold rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] whitespace-nowrap">
                                        Clear
                                    </a>
                                @endif
                            </div>
                        </form>

                        <!-- Export Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('customers.export', ['format' => 'pdf'] + request()->all()) }}" 
                               class="group inline-flex items-center px-6 py-4 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] hover:-translate-y-1 border border-amber-400">
                                <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                PDF Export
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Customers Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-amber-100/50">
                        <thead class="bg-gradient-to-r from-amber-50 to-yellow-50">
                            <tr>
                                <th class="px-8 py-6 text-left text-sm font-black text-amber-900 uppercase tracking-widest">Customer</th>
                                <th class="px-8 py-6 text-left text-sm font-black text-amber-900 uppercase tracking-widest">Email</th>
                                <th class="px-8 py-6 text-left text-sm font-black text-amber-900 uppercase tracking-widest">Phone</th>
                                <th class="px-8 py-6 text-left text-sm font-black text-amber-900 uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-amber-100/30">
                            @forelse($customers as $customer)
                                <tr class="hover:bg-amber-50/50 transition-all duration-300 hover:shadow-md group">
                                    <td class="px-8 py-8 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($customer->profile_image)
                                                <img src="{{ asset('storage/' . $customer->profile_image) }}" 
                                                     alt="{{ $customer->name }}" 
                                                     class="w-16 h-16 rounded-3xl object-cover ring-4 ring-amber-300/50 shadow-2xl group-hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-yellow-400 rounded-3xl flex items-center justify-center text-white font-bold text-xl ring-4 ring-amber-300/50 shadow-2xl group-hover:scale-105 transition-transform duration-300">
                                                    {{ substr($customer->name, 0, 2) }}
                                                </div>
                                            @endif
                                            <div class="ml-6">
                                                <div class="text-xl font-black text-amber-900">{{ $customer->name }}</div>
                                                <div class="text-sm text-amber-600 font-semibold">ID: {{ $customer->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 whitespace-nowrap">
                                        <div class="flex items-center text-lg text-amber-800 font-semibold">
                                            <svg class="w-6 h-6 mr-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $customer->email }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 whitespace-nowrap">
                                        <div class="flex items-center text-lg text-amber-800 font-semibold">
                                            <svg class="w-6 h-6 mr-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $customer->phone }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 whitespace-nowrap text-lg font-bold">
                                        <div class="flex gap-3">
                                            <a href="{{ route('customers.show', $customer) }}" 
                                               class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-800 hover:from-amber-200 hover:to-yellow-200 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] font-bold border border-amber-300">
                                                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('customers.edit', $customer) }}" 
                                               class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 hover:from-emerald-200 hover:to-teal-200 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] font-bold border border-emerald-300">
                                                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <form method="POST" action="{{ route('customers.destroy', $customer) }}" 
                                                      onsubmit="return confirm('Are you sure you want to delete this customer?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-100 to-rose-100 text-red-800 hover:from-red-200 hover:to-rose-200 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] font-bold border border-red-300">
                                                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <svg class="mx-auto h-24 w-24 text-amber-300 mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <p class="text-2xl font-black text-amber-500 mb-2">No customers found</p>
                                        <p class="text-amber-600 text-lg mb-8 font-semibold">Get started by adding your first customer</p>
                                        <a href="{{ route('customers.create') }}" class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-bold rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-[1.05] hover:-translate-y-2">
                                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Add Your First Customer
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($customers->hasPages())
                    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-8 py-8 border-t border-amber-200/50">
                        {{ $customers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
