<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.main')

    @livewireStyles

    <style>
        :root {
            --color-primary: #0071bc;
            --color-secondary: #00e1ff;
            --color-third: #e00000;
        }

        .bg-primary {
            background-color: var(--color-primary);
        }

        .bg-secondary {
            background-color: var(--color-secondary);
        }

        .bg-third {
            background-color: var(--color-third);
        }

        .text-primary {
            color: var(--color-primary);
        }

        .text-secondary {
            color: var(--color-secondary);
        }

        .text-third {
            color: var(--color-third);
        }

        .border-primary {
            border-color: var(--color-primary);
        }

        .hover\:bg-primary:hover {
            background-color: var(--color-primary);
        }

        .hover\:text-secondary:hover {
            color: var(--color-secondary);
        }

        /* Custom scrollbar untuk tema gelap */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--color-primary);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-secondary);
        }

        /* Navbar sticky with blur effect */
        .navbar-blur {
            backdrop-filter: blur(10px);
            background-color: rgba(17, 24, 39, 0.8);
        }

        /* Smooth transition untuk menu mobile */
        .mobile-menu {
            transition: max-height 0.3s ease-in-out;
        }

        /* SPA Page Transition */
        [x-cloak] {
            display: none !important;
        }

        /* Loading indicator untuk SPA navigation */
        .livewire-progress-bar {
            height: 3px;
            background-color: var(--color-secondary);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 font-sans antialiased">

    <!-- Header/Navbar -->
    <nav class="fixed w-full top-0 z-50 navbar-blur border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 md:h-24">
                <!-- Logo Section -->
                <div class="flex items-center space-x-4 w-full md:w-auto justify-center md:justify-start">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('images/Logo HMIF.png') }}" alt="Logo HMIF" class="h-12 md:h-14 w-auto">
                        <div class="hidden md:block w-px h-14 bg-gray-700"></div>
                        <img src="{{ asset('images/Logo Kabinet Vistara Abhiyasa.png') }}" alt="Logo Kabinet"
                            class="h-12 md:h-14 w-auto">
                        <div class="hidden lg:block">
                            <h1 class="text-white font-bold text-sm xl:text-base leading-tight">
                                HIMPUNAN MAHASISWA INFORMATIKA
                            </h1>
                            <p class="text-secondary text-xs xl:text-sm font-semibold">
                                UNIVERSITAS MAJALENGKA
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('main.home') }}" wire:navigate
                        class="text-gray-300 hover:text-secondary transition-colors duration-300 font-medium text-lg relative group {{ request()->routeIs('main.home') ? 'text-secondary' : '' }}">
                        Beranda
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-secondary transition-all duration-300 {{ request()->routeIs('main.home') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="{{ route('main.structure') }}" wire:navigate
                        class="text-gray-300 hover:text-secondary transition-colors duration-300 font-medium text-lg relative group {{ request()->routeIs('main.structure') ? 'text-secondary' : '' }}">
                        Struktural
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-secondary transition-all duration-300 {{ request()->routeIs('main.structure') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="{{ route('main.community') }}" wire:navigate
                        class="text-gray-300 hover:text-secondary transition-colors duration-300 font-medium text-lg relative group {{ request()->routeIs('main.community') ? 'text-secondary' : '' }}">
                        Komunitas
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-secondary transition-all duration-300 {{ request()->routeIs('main.community') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden absolute right-4">
                    <button id="mobile-menu-button" class="text-gray-300 hover:text-secondary focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden mobile-menu overflow-hidden max-h-0">
                <div class="py-4 space-y-3">
                    <a href="{{ route('main.home') }}" wire:navigate
                        class="block px-4 py-2 text-gray-300 hover:bg-primary hover:text-white rounded-lg transition-all duration-300 {{ request()->routeIs('main.home') ? 'bg-primary text-white' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('main.structure') }}" wire:navigate
                        class="block px-4 py-2 text-gray-300 hover:bg-primary hover:text-white rounded-lg transition-all duration-300 {{ request()->routeIs('main.structure') ? 'bg-primary text-white' : '' }}">
                        Struktural
                    </a>
                    <a href="{{ route('main.community') }}" wire:navigate
                        class="block px-4 py-2 text-gray-300 hover:bg-primary hover:text-white rounded-lg transition-all duration-300 {{ request()->routeIs('main.community') ? 'bg-primary text-white' : '' }}">
                        Komunitas
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 md:pt-24 min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Logo & Copyright -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/Logo HMIF.png') }}" alt="Logo HMIF" class="h-16 w-auto">
                        <div class="w-px h-16 bg-gray-700"></div>
                        <img src="{{ asset('images/Logo Kabinet Vistara Abhiyasa.png') }}" alt="Logo Kabinet"
                            class="h-16 w-auto">
                    </div>
                    <h3 class="text-xl font-bold text-white">HMIF UNMA</h3>
                    <p class="text-gray-400 text-sm">
                        Himpunan Mahasiswa Informatika<br />
                        Universitas Majalengka
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">Menu</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('main.home') }}" wire:navigate
                                class="text-gray-400 hover:text-secondary transition-colors duration-300">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('main.structure') }}" wire:navigate
                                class="text-gray-400 hover:text-secondary transition-colors duration-300">
                                Struktural
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('main.community') }}" wire:navigate
                                class="text-gray-400 hover:text-secondary transition-colors duration-300">
                                Komunitas
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">Ikuti Kami</h4>
                    <p class="text-gray-400 text-sm">Tetap terhubung dengan kami melalui media sosial</p>
                    <div class="flex space-x-4">
                        <a href="https://facebook.com/hmif.unma" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="https://instagram.com/hmifunma" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="https://tiktok.com/@hmifunma" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-black transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-tiktok text-white"></i>
                        </a>
                        <a href="https://youtube.com/@hmifunma" target="_blank"
                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-third transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="mt-8 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-500 text-sm text-center md:text-left">
                        Made With <span class="text-third">❤</span> By HMIF Dev
                    </p>
                    <p class="text-gray-500 text-sm">
                        &copy; {{ date('Y') }} HMIF UNMA. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            mobileMenuButton.addEventListener('click', function() {
                if (mobileMenu.style.maxHeight === '0px' || mobileMenu.style.maxHeight === '') {
                    mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    mobileMenu.style.maxHeight = '0px';
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInside = mobileMenuButton.contains(event.target) || mobileMenu.contains(event
                    .target);

                if (!isClickInside && mobileMenu.style.maxHeight !== '0px') {
                    mobileMenu.style.maxHeight = '0px';
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
