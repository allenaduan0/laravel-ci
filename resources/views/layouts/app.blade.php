<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Allen Project CRUD')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>

<body class="bg-gray-900 min-h-screen">
    <nav class="bg-gray-800 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-white">
                        Allen Project CRUD
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profiles.index') }}"
                        class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        All Profiles
                    </a>
                    <a href="{{ route('profiles.create') }}"
                        class="bg-indigo-500 text-white hover:bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-1"></i>Create Profile
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-500 text-white p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        {{ session('info') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-800 border-t border-gray-700 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="text-center text-gray-400 text-sm">
                <p>Allen Project CRUD &copy; {{ date('Y') }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
