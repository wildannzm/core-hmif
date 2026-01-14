<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Page Header -->
    <div
        class="mb-6 sm:mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Detail Event</h1>
            </div>
            <a href="{{ route('admin.events.index') }}" wire:navigate
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span class="hidden sm:inline">Kembali</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mx-1 sm:mx-0">
        <!-- Total Orders Card -->
        <button wire:click="goToOrders"
            class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200 hover:border-blue-300 group text-left">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pemesanan</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalOrders }}</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Klik untuk lihat detail
                    </p>
                </div>
                <div
                    class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </button>

        <!-- Total Attendance Card -->
        <button wire:click="goToAttendance"
            class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200 hover:border-green-300 group text-left">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Kehadiran</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalAttendance }}</p>
                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Klik untuk lihat detail
                    </p>
                </div>
                <div
                    class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition-colors">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </button>
    </div>

    <!-- Event Information Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mx-1 sm:mx-0">
        <!-- Banner -->
        @if ($event->banner)
            <div class="w-full overflow-hidden bg-gray-100" style="aspect-ratio: 16/9;">
                <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}"
                    class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Content -->
        <div class="p-6">
            <!-- Title & Status -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $event->title }}</h2>
                    <p class="text-sm text-gray-500">Slug: <span class="font-mono">{{ $event->slug }}</span></p>
                </div>
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $event->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    @if ($event->is_active)
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Aktif
                    @else
                        Nonaktif
                    @endif
                </span>
            </div>

            <!-- Details Grid: 2 Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Row 1: Description | Location -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">Deskripsi</h3>
                    <p class="text-gray-600 whitespace-pre-line">{{ $event->description }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">Lokasi</h3>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-gray-900">{{ $event->location }}</span>
                    </div>
                </div>

                <!-- Row 2: Order Time | Event Time -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">📅 Waktu Pemesanan
                        Tiket</h3>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <div class="flex items-start mb-2">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-blue-900 font-medium text-sm">Buka:</p>
                                <p class="text-blue-800">{{ $event->start_date->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-blue-900 font-medium text-sm">Tutup:</p>
                                <p class="text-blue-800">{{ $event->end_date->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">🎉 Waktu Event
                        Berlangsung</h3>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="flex items-start mb-2">
                            <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-green-900 font-medium text-sm">Mulai:</p>
                                <p class="text-green-800">{{ $event->event_start_date->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-green-900 font-medium text-sm">Selesai:</p>
                                <p class="text-green-800">{{ $event->event_end_date->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Ticket Price | Ticket Quota -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">Harga Tiket</h3>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="text-2xl font-bold text-gray-900">Rp
                            {{ number_format($event->price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">Kuota Tiket</h3>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                            </path>
                        </svg>
                        <div>
                            <p class="text-gray-600">
                                <span class="text-2xl font-bold text-blue-600">{{ $event->available_quota }}</span>
                                <span class="text-gray-500">/ {{ $event->quota }}</span>
                            </p>
                            <p class="text-xs text-gray-500">Tersedia / Total</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
