<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <script src="https://cdn.tailwindcss.com">
        < /script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-gray-800">404</h1>
            <p class="text-2xl text-gray-600 mb-4">Page Not Found</p>
            <p class="text-gray-500 mb-8">The page you're looking for doesn't exist.</p>
            <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Go to Dashboard
            </a>
        </div>
    </div>
</body>
</html>