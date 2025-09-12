<header class="fixed top-0 right-0 h-16 bg-white shadow z-30 flex items-center px-6 transition-all duration-300 lg:left-16 lg:group-hover:left-64 left-16 justify-between">
    <!-- Left Section: App Name -->
    <div class="flex items-center">
        <h1 class="text-xl hidden md:flex font-semibold text-gray-800">
            Turn App
        </h1>
    </div>

    <!-- Center Section: Logo -->
    <div class="flex-grow flex justify-center">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="h-12">
    </div>

    <!-- Right Section: User Name & Avatar -->
    <div class="flex items-center space-x-4">
        <span class="text-gray-600">{{ Auth::user()->firstname ?? 'Usuário' }}</span>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->firstname ?? 'User') }}" class="w-8 h-8 rounded-full" alt="avatar">
    </div>
</header>