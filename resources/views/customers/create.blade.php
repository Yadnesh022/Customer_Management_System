<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('customers.index') }}" class="group mr-6 p-3 bg-amber-50 hover:bg-amber-100 rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 border border-amber-200">
                <svg class="w-6 h-6 text-amber-600 group-hover:text-amber-800 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-black text-4xl text-amber-900 leading-tight flex items-center tracking-tight">
                    <svg class="w-10 h-10 mr-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Add New Customer
                </h2>
                <p class="text-xl text-amber-700 mt-3 font-semibold">Fill in the details below to create a new customer</p>
            </div>
        </div>
    </x-slot>

    <div class="py-16 bg-gradient-to-br from-amber-50 to-yellow-50">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-amber-100/50 hover:shadow-4xl transition-all duration-500">
                <div class="bg-gradient-to-r from-amber-500 via-yellow-500 to-amber-600 px-10 py-8 border-b border-amber-400/50">
                    <h3 class="text-3xl font-black text-white flex items-center">
                        <svg class="w-10 h-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Customer Information
                    </h3>
                    <p class="text-yellow-100 text-lg mt-2 font-semibold">Please provide accurate customer details</p>
                </div>

                <form method="POST" action="{{ route('customers.store') }}" enctype="multipart/form-data" class="p-12">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Full Name -->
                        <div class="col-span-2 lg:col-span-1">
                            <label class="block text-amber-900 text-lg font-bold mb-4 flex items-center tracking-wide">
                                <svg class="w-6 h-6 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter customer full name"
                                   class="w-full border-2 @error('name') border-red-500 ring-4 ring-red-200/50 @else border-amber-200/70 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/50 @enderror rounded-3xl px-6 py-5 text-xl font-semibold focus:outline-none transition-all duration-400 bg-gradient-to-r from-amber-50/80 to-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover:border-amber-300">
                            @error('name')
                                <p class="text-red-500 text-sm mt-3 flex items-center font-semibold bg-red-50/80 border border-red-200/50 px-4 py-3 rounded-2xl backdrop-blur-sm shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-span-2 lg:col-span-1">
                            <label class="block text-amber-900 text-lg font-bold mb-4 flex items-center tracking-wide">
                                <svg class="w-6 h-6 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   placeholder="customer@example.com"
                                   class="w-full border-2 @error('email') border-red-500 ring-4 ring-red-200/50 @else border-amber-200/70 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/50 @enderror rounded-3xl px-6 py-5 text-xl font-semibold focus:outline-none transition-all duration-400 bg-gradient-to-r from-amber-50/80 to-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover:border-amber-300">
                            @error('email')
                                <p class="text-red-500 text-sm mt-3 flex items-center font-semibold bg-red-50/80 border border-red-200/50 px-4 py-3 rounded-2xl backdrop-blur-sm shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-span-2 lg:col-span-1">
                            <label class="block text-amber-900 text-lg font-bold mb-4 flex items-center tracking-wide">
                                <svg class="w-6 h-6 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}" 
                                   placeholder="+91 1234567890"
                                   class="w-full border-2 @error('phone') border-red-500 ring-4 ring-red-200/50 @else border-amber-200/70 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/50 @enderror rounded-3xl px-6 py-5 text-xl font-semibold focus:outline-none transition-all duration-400 bg-gradient-to-r from-amber-50/80 to-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover:border-amber-300">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-3 flex items-center font-semibold bg-red-50/80 border border-red-200/50 px-4 py-3 rounded-2xl backdrop-blur-sm shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Profile Image -->
                        <div class="col-span-2 lg:col-span-1">
                            <label class="block text-amber-900 text-lg font-bold mb-4 flex items-center tracking-wide">
                                <svg class="w-6 h-6 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Profile Image
                            </label>
                            <div class="relative group">
                                <input type="file" name="profile_image" accept="image/*" id="profile_image"
                                       class="hidden"
                                       onchange="previewImage(event)">
                                <label for="profile_image" class="flex flex-col items-center justify-center w-full border-2 border-dashed @error('profile_image') border-red-500 ring-4 ring-red-200/50 bg-red-50/50 @else border-amber-200/70 hover:border-amber-500 hover:ring-4 hover:ring-amber-400/50 @enderror rounded-3xl px-8 py-12 cursor-pointer transition-all duration-400 hover:bg-amber-50/50 shadow-xl hover:shadow-2xl group-hover:border-amber-400">
                                    <svg class="w-12 h-12 text-amber-400 mb-4 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span class="text-xl font-bold text-amber-700 group-hover:text-amber-900 transition-colors">Click to upload image</span>
                                    <span class="text-amber-500 mt-1 text-sm font-semibold">PNG, JPG up to 2MB</span>
                                </label>
                            </div>
                            <div id="image_preview" class="mt-6 hidden">
                                <img src="" alt="Preview" class="w-32 h-32 rounded-3xl object-cover shadow-2xl border-4 border-amber-200/50 mx-auto">
                            </div>
                            @error('profile_image')
                                <p class="text-red-500 text-sm mt-3 flex items-center font-semibold bg-red-50/80 border border-red-200/50 px-4 py-3 rounded-2xl backdrop-blur-sm shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-span-2">
                            <label class="block text-amber-900 text-lg font-bold mb-4 flex items-center tracking-wide">
                                <svg class="w-6 h-6 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Full Address <span class="text-red-500">*</span>
                            </label>
                            <textarea name="address" rows="5" 
                                      placeholder="Enter complete address including city, state, pincode..."
                                      class="w-full border-2 @error('address') border-red-500 ring-4 ring-red-200/50 @else border-amber-200/70 focus:border-amber-500 focus:ring-4 focus:ring-amber-400/50 @enderror rounded-3xl px-6 py-5 text-xl font-semibold focus:outline-none transition-all duration-400 bg-gradient-to-r from-amber-50/80 to-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover:border-amber-300 resize-vertical">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-3 flex items-center font-semibold bg-red-50/80 border border-red-200/50 px-4 py-3 rounded-2xl backdrop-blur-sm shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-6 mt-12 pt-10 border-t-4 border-amber-200/50">
                        <button type="submit" class="flex-1 group inline-flex justify-center items-center px-12 py-6 bg-gradient-to-r from-amber-500 via-yellow-500 to-amber-600 hover:from-amber-600 hover:via-yellow-600 hover:to-amber-700 text-white font-black text-xl rounded-3xl shadow-2xl hover:shadow-4xl transition-all duration-400 transform hover:scale-[1.02] hover:-translate-y-2 border-2 border-amber-400">
                            <svg class="w-7 h-7 mr-4 group-hover:rotate-12 transition-transform duration-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Create Customer
                        </button>
                        <a href="{{ route('customers.index') }}" class="flex-1 inline-flex justify-center items-center px-12 py-6 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-amber-900 font-black text-xl rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-400 transform hover:scale-[1.02] hover:-translate-y-1 border-2 border-amber-200">
                            <svg class="w-7 h-7 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Name: Only alphabets + spaces
    document.querySelector('input[name="name"]').addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        const val = this.value.trim();
        let error = '';
        if (!val) error = 'Name required';
        else if (val.length < 2) error = 'Min 2 characters';
        else if (!/^[a-zA-Z\s]+$/.test(val)) error = 'Only alphabets allowed';
        showError(this, error);
    });

    // Email validation
    document.querySelector('input[name="email"]').addEventListener('input', function() {
        const val = this.value.trim();
        let error = '';
        if (!val) error = 'Email required';
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) error = 'Invalid email';
        showError(this, error);
    });

    // Phone: Indian 10-digit
    document.querySelector('input[name="phone"]').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        const val = this.value;
        let error = '';
        if (!val) error = 'Phone required';
        else if (!/^[6-9]\d{9}$/.test(val)) error = 'Valid 10-digit mobile';
        showError(this, error);
    });

    // Address
    document.querySelector('textarea[name="address"]').addEventListener('input', function() {
        const val = this.value.trim();
        let error = '';
        if (!val) error = 'Address required';
        else if (val.length < 10) error = 'Min 10 characters';
        showError(this, error);
    });

    function showError(input, msg) {
        let errDiv = input.parentElement.querySelector('.err-msg');
        if (!errDiv) {
            errDiv = document.createElement('p');
            errDiv.className = 'err-msg text-red-500 text-sm mt-3 flex items-center font-semibold bg-red-50/80 border border-red-200/50 px-4 py-3 rounded-2xl backdrop-blur-sm shadow-md hidden';
            input.parentElement.appendChild(errDiv);
        }
        errDiv.innerHTML = msg ? `<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>${msg}` : '';
        errDiv.classList.toggle('hidden', !msg);
        if (msg) {
            input.classList.add('border-red-500', 'ring-4', 'ring-red-200/50');
            input.classList.remove('border-amber-200/70', 'focus:border-amber-500');
        } else {
            input.classList.remove('border-red-500', 'ring-4', 'ring-red-200/50');
            input.classList.add('border-amber-200/70');
        }
    }
});

function previewImage(event) {
    const input = event.target;
    const previewDiv = document.getElementById('image_preview');
    const previewImg = previewDiv.querySelector('img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        previewImg.src = '';
        previewDiv.classList.add('hidden');
    }
}
</script>
</x-app-layout>
