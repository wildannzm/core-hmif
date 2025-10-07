<div class="min-h-screen bg-gray-50">
    <!-- Mobile Header -->
    <div class="lg:hidden bg-white border-b border-gray-200 px-4 py-4">
        <h1 class="text-xl font-semibold text-gray-900">Pengaturan</h1>
    </div>

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar Navigation -->
        <div class="w-full lg:w-64 bg-white border-r border-gray-200 lg:h-fit rounded">
            <!-- Desktop Header - Simplified -->
            <div class="hidden lg:block p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Pengaturan</h2>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('settings.profile') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.profile')
                        ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-blue-700' }}">
                    <svg class="w-4 h-4 mr-2 {{ request()->routeIs('settings.profile') ? 'text-white' : 'text-blue-600' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil
                </a>

                <a href="{{ route('settings.password') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('settings.password')
                        ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-blue-700' }}">
                    <svg class="w-4 h-4 mr-2 {{ request()->routeIs('settings.password') ? 'text-white' : 'text-red-600' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Kata Sandi
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 lg:overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                <!-- Page Header -->
                <div class="mb-8">
                    <div class="flex items-center space-x-4 mb-2">
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ $heading ?? '' }}</h1>
                            @if ($subheading ?? '')
                                <p class="text-gray-600 mt-1">{{ $subheading ?? '' }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="w-full">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
