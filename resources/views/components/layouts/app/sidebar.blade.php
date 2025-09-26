<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head', ['title' => 'Dashboard'])
</head>

<body class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false }">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" x-cloak>
        <!-- Sidebar backdrop for mobile -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-25 lg:hidden"
            @click="sidebarOpen = false"></div>

        <!-- Sidebar content -->
        <div class="relative flex h-full flex-col bg-white border-r border-gray-200 shadow-lg z-50">

            <!-- Logo and Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse"
                    wire:navigate>
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-50 to-red-50 border">
                        <img src="{{ asset('images/Logo HMIF.png') }}" alt="Logo HMIF" class="h-8 w-8 object-contain">
                    </div>
                    <div>
                        <div class="text-lg font-bold text-gray-900">HMIF UNMA</div>
                        <div class="text-xs text-gray-600">Dashboard</div>
                    </div>
                </a>

                <!-- Close button (mobile) -->
                <button @click="sidebarOpen = false"
                    class="lg:hidden p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 space-y-2 p-4" x-data="{
                openMenus: {
                    keanggotaan: JSON.parse(localStorage.getItem('sidebar_keanggotaan') || 'false'),
                    kegiatan: JSON.parse(localStorage.getItem('sidebar_kegiatan') || 'false')
                },
                toggleMenu(menu) {
                    this.openMenus[menu] = !this.openMenus[menu];
                    localStorage.setItem('sidebar_' + menu, JSON.stringify(this.openMenus[menu]));
                }
            }">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700' }}">
                    <svg class="w-5 h-5 {{ !request()->routeIs('dashboard') ? 'text-blue-600' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>

                <!-- Keanggotaan Dropdown -->
                <div class="space-y-1">
                    <button @click="toggleMenu('keanggotaan')"
                        class="group flex w-full items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700 transition-all duration-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span class="ml-3 flex-1 text-left">Struktur Organisasi</span>
                        <svg class="w-4 h-4 transition-transform duration-200"
                            :class="{ 'rotate-180': openMenus.keanggotaan }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="openMenus.keanggotaan" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-8 space-y-1">
                        <a href="{{ route('departments') }}" wire:navigate
                            class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('departments') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('departments') ? 'text-white' : 'text-red-500' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="ml-2">Departemen</span>
                        </a>
                        <a href="{{ route('members') }}" wire:navigate
                            class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('members') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('members') ? 'text-white' : 'text-red-500' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="ml-2">Anggota</span>
                        </a>
                    </div>
                </div>

                <!-- Kegiatan Dropdown -->
                <div class="space-y-1">
                    <button @click="toggleMenu('kegiatan')"
                        class="group flex w-full items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700 transition-all duration-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="ml-3 flex-1 text-left">Kegiatan</span>
                        <svg class="w-4 h-4 transition-transform duration-200"
                            :class="{ 'rotate-180': openMenus.kegiatan }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="openMenus.kegiatan" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-8 space-y-1">
                        <a href="#"
                            class="group flex items-center px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="ml-2">Jadwal Kegiatan</span>
                        </a>
                        <a href="#"
                            class="group flex items-center px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            <span class="ml-2">Absensi</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- User Profile Section -->
            <div class="border-t border-gray-200 p-4" x-data="{ userMenuOpen: false }">
                <div class="relative">
                    <button @click="userMenuOpen = !userMenuOpen"
                        class="group flex w-full items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 transition-all duration-200">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-red-500 text-white text-sm font-semibold">
                            {{ auth()->user()->initials() }}
                        </div>
                        <div class="ml-3 flex-1 text-left">
                            <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-600">{{ auth()->user()->email }}</div>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': userMenuOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- User dropdown menu -->
                    <div x-show="userMenuOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        class="absolute bottom-full left-0 right-0 mb-2 bg-white border border-gray-200 rounded-lg shadow-lg">
                        <a href="{{ route('settings.profile') }}" wire:navigate
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center px-4 py-3 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4 text-red-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu button (fixed position) -->
    <button @click="sidebarOpen = true"
        class="lg:hidden fixed top-4 left-4 z-40 p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors bg-white shadow-md">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Page Content -->
        <main class="pt-16 lg:pt-0 p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
