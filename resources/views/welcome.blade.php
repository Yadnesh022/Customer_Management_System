<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 to-yellow-50 min-h-screen antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="text-2xl font-bold text-amber-900">CMS</div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-amber-700 hover:text-amber-900 font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-amber-700 hover:text-amber-900 font-semibold">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-semibold rounded-xl shadow-lg transition-all duration-200">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-amber-900 mb-6 leading-tight">
                Customer<br>
                <span class="gradient-text">Management</span>
            </h1>
            <p class="text-xl text-amber-700 mb-10 max-w-2xl mx-auto leading-relaxed">
                Simple CRM for managing customers and orders. Built with Laravel.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-semibold rounded-xl shadow-xl transition-all duration-200">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-semibold rounded-xl shadow-xl transition-all duration-200">
                        Start Free
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white hover:bg-amber-50 text-amber-900 font-semibold rounded-xl shadow-lg border border-amber-300 transition-all duration-200">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>
</body>
</html>
