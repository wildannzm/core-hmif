<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.tix')

    @livewireStyles
</head>

<body class="antialiased bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center h-16 sm:h-20">
                <!-- Logo -->
                <a href="{{ route('tix.home') }}" wire:navigate
                    class="flex items-center space-x-3 hover:opacity-80 transition-opacity">
                    <img src="{{ asset('images/Logo HMIF.png') }}" alt="HMIF Logo" class="h-10 w-10 sm:h-12 sm:w-12">
                    <div>
                        <span class="text-xl sm:text-2xl font-bold text-blue-900">HMIF</span>
                        <span class="text-xl sm:text-2xl font-bold text-yellow-500">TIX</span>
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/Logo HMIF.png') }}" alt="HMIF Logo" class="h-12 w-12">
                        <div>
                            <span class="text-2xl font-bold">HMIF</span>
                            <span class="text-2xl font-bold text-yellow-400">TIX</span>
                        </div>
                    </div>
                    <p class="text-blue-100 text-sm">
                        Platform booking tiket event resmi Himpunan Mahasiswa Informatika Universitas Majalengka
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('tix.home') }}" wire:navigate
                                class="text-blue-100 hover:text-white transition-colors">
                                Browse Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('main.home') }}" class="text-blue-100 hover:text-white transition-colors">
                                Tentang HMIF
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm text-blue-100">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>hmif@unma.ac.id</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Universitas Majalengka, Jawa Barat</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-sm text-blue-100">
                <p>&copy; {{ date('Y') }} HMIF UNMA. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                });
            @endif

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                });
            @endif
        });

        // Handle Livewire events
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    icon: 'error',
                    title: data.title || 'Error',
                    text: data.message,
                });
            });

            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: data.title || 'Berhasil',
                    text: data.message,
                });
            });
        });
    </script>
</body>

</html>
