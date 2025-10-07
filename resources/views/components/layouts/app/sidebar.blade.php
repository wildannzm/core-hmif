<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')

    <!-- Custom Scrollbar Styles -->
    <style>
        /* Custom scrollbar for navigation area */
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
            transition: background-color 0.2s ease;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background-color: rgba(156, 163, 175, 0.8);
        }

        /* Ensure proper height calculation */
        .sidebar-container {
            height: 100vh;
            max-height: 100vh;
        }
    </style>
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
        <div class="sidebar-container relative flex flex-col bg-white border-r border-gray-200 shadow-lg z-50">

            <!-- Logo and Header -->
            <div class="flex-shrink-0 flex items-center justify-between p-4 border-b border-gray-200">
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

            <!-- Navigation Menu - Scrollable Area -->
            <nav class="flex-1 overflow-y-auto sidebar-scroll space-y-2 p-4" x-data="{
                openMenus: {
                    keanggotaan: JSON.parse(localStorage.getItem('sidebar_keanggotaan') || 'false'),
                    kegiatan: JSON.parse(localStorage.getItem('sidebar_kegiatan') || 'false'),
                    sekretaris: JSON.parse(localStorage.getItem('sidebar_sekretaris') || 'false'),
                    bendahara: JSON.parse(localStorage.getItem('sidebar_bendahara') || 'false'),
                    kominfo: JSON.parse(localStorage.getItem('sidebar_kominfo') || 'false')
                },
                toggleMenu(menu) {
                    this.openMenus[menu] = !this.openMenus[menu];
                    localStorage.setItem('sidebar_' + menu, JSON.stringify(this.openMenus[menu]));
                }
            }">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700' }}">
                    <svg class="w-5 h-5 {{ !request()->routeIs('dashboard') ? 'text-blue-600' : '' }}"
                        viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>

                <!-- Keanggotaan Dropdown -->
                @if (auth()->user()->hasOrganizationalAccess())
                    <div class="space-y-1">
                        <button @click="toggleMenu('keanggotaan')"
                            class="group flex w-full items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700 transition-all duration-200">
                            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 28 28" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14 1.99774C11.6528 1.99774 9.75 3.90053 9.75 6.24774C9.75 8.33903 11.2605 10.0775 13.25 10.4318V13.5H8.75C7.50736 13.5 6.5 14.5074 6.5 15.75V17.566C4.51049 17.9202 3 19.6587 3 21.75C3 24.0972 4.90279 26 7.25 26C9.59721 26 11.5 24.0972 11.5 21.75C11.5 19.6587 9.98951 17.9202 8 17.566V15.75C8 15.3358 8.33579 15 8.75 15H19.25C19.6642 15 20 15.3358 20 15.75V17.566C18.0105 17.9202 16.5 19.6587 16.5 21.75C16.5 24.0972 18.4028 26 20.75 26C23.0972 26 25 24.0972 25 21.75C25 19.6587 23.4895 17.9202 21.5 17.566V15.75C21.5 14.5074 20.4926 13.5 19.25 13.5H14.75V10.4318C16.7395 10.0775 18.25 8.33904 18.25 6.24774C18.25 3.90053 16.3472 1.99774 14 1.99774ZM11.25 6.24774C11.25 4.72896 12.4812 3.49774 14 3.49774C15.5188 3.49774 16.75 4.72896 16.75 6.24774C16.75 7.76652 15.5188 8.99774 14 8.99774C12.4812 8.99774 11.25 7.76652 11.25 6.24774ZM4.5 21.75C4.5 20.2312 5.73122 19 7.25 19C8.76878 19 10 20.2312 10 21.75C10 23.2688 8.76878 24.5 7.25 24.5C5.73122 24.5 4.5 23.2688 4.5 21.75ZM20.75 19C22.2688 19 23.5 20.2312 23.5 21.75C23.5 23.2688 22.2688 24.5 20.75 24.5C19.2312 24.5 18 23.2688 18 21.75C18 20.2312 19.2312 19 20.75 19Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="ml-3 flex-1 text-left">Struktur Organisasi</span>
                            <svg class="w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': openMenus.keanggotaan }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
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
                @endif

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
                        <a href="{{ route('schedules') }}" wire:navigate
                            class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('schedules') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                            <svg class="w-4 h-4 {{ request()->routeIs('schedules') ? 'text-white' : 'text-red-500' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="ml-2">Jadwal Kegiatan</span>
                        </a>
                        @if (auth()->user()->hasAttendanceReportAccess())
                            <a href="{{ route('attendance') }}" wire:navigate
                                class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('attendance') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('attendance') ? 'text-white' : 'text-red-500' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                <span class="ml-2">Absensi</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Sekretaris Dropdown -->
                @if (auth()->user()->hasSecretaryAccess())
                    <div class="space-y-1">
                        <button @click="toggleMenu('sekretaris')"
                            class="group flex w-full items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700 transition-all duration-200">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span class="ml-3 flex-1 text-left">Sekretaris</span>
                            <svg class="w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': openMenus.sekretaris }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="openMenus.sekretaris" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-8 space-y-1">
                            <a href="{{ route('surat') }}" wire:navigate
                                class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('surat') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('surat') ? 'text-white' : 'text-red-500' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <span class="ml-2">Manajemen Surat</span>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Bendahara Dropdown -->
                @if (auth()->user()->hasTreasurerAccess())
                    <div class="space-y-1">
                        <button @click="toggleMenu('bendahara')"
                            class="group flex w-full items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700 transition-all duration-200">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="ml-3 flex-1 text-left">Bendahara</span>
                            <svg class="w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': openMenus.bendahara }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="openMenus.bendahara" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-8 space-y-1">
                            <a href="{{ route('finance') }}" wire:navigate
                                class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('finance') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('finance') ? 'text-white' : 'text-red-500' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="ml-2">Keuangan</span>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Kominfo Dropdown -->
                @if (auth()->user()->hasKominfoAccess())
                    <div class="space-y-1">
                        <button @click="toggleMenu('kominfo')"
                            class="group flex w-full items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 hover:text-blue-700 transition-all duration-200">
                            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.42091 4.83828C2.43562 4.07194 1 4.77409 1 6.02231V17.9777C1 19.2259 2.43562 19.928 3.42091 19.1617L11.6139 12.7893C11.8575 12.5999 12 12.3086 12 12V17.9777C12 19.2259 13.4356 19.928 14.4209 19.1617L22.6139 12.7893C22.8575 12.5999 23 12.3086 23 12C23 11.6914 22.8575 11.4001 22.6139 11.2106L14.4209 4.83828C13.4356 4.07194 12 4.77409 12 6.02231V12C12 11.6914 11.8575 11.4001 11.6139 11.2106L3.42091 4.83828ZM9.37118 12L3 16.9553V7.04463L9.37118 12ZM20.3712 12L14 16.9553V7.04463L20.3712 12Z"
                                    fill="currentColor"></path>
                            </svg>
                            <span class="ml-3 flex-1 text-left">Kominfo</span>
                            <svg class="w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': openMenus.kominfo }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="openMenus.kominfo" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-8 space-y-1">
                            <a href="{{ route('content-plan') }}" wire:navigate
                                class="group flex items-center px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('content-plan') ? 'bg-gradient-to-r from-blue-500 to-red-500 text-white shadow-md' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-700' }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('content-plan') ? 'text-white' : 'text-red-500' }}"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.37 8.87988H17.62" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12.37 15.8799H17.62" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <span class="ml-2">Content Plan</span>
                            </a>
                        </div>
                    </div>
                @endif
            </nav>

            <!-- User Profile Section - Fixed at Bottom -->
            <div class="flex-shrink-0 border-t border-gray-200 p-4" x-data="{ userMenuOpen: false }">
                <div class="relative">
                    <button @click="userMenuOpen = !userMenuOpen"
                        class="group flex w-full items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-red-50 transition-all duration-200">
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

    <!-- Mobile Header -->
    <header class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-white border-b border-gray-200 shadow-sm">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Hamburger Menu Button -->
            <button @click="sidebarOpen = true"
                class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Logo Center -->
            <div class="flex items-center justify-center flex-1">
                <div
                    class="flex h-13 w-13 items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-red-50 border-2 border-blue-200 shadow-sm">
                    <img src="{{ asset('images/Logo HMIF.png') }}" alt="Logo HMIF" class="h-13 w-13 object-contain">
                </div>
            </div>

            <!-- Empty space for balance -->
            <div class="w-10"></div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Page Content -->
        <main class="pt-16 lg:pt-0 p-0 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
