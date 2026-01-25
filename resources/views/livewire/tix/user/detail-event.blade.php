<div class="min-h-screen bg-gray-50 pb-20 lg:pb-8">
    <!-- Desktop & Tablet Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Left Column - Event Image & Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Event Banner -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative" style="aspect-ratio: 16/9;">
                        @if ($event->banner)
                            <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                                <svg class="w-24 h-24 text-blue-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Event Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>

                    <!-- Event Metadata -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <!-- Date & Time -->
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal & Waktu Event</p>
                                <p class="text-gray-900 font-semibold">{{ $event->event_start_date->format('d M Y') }}
                                </p>
                                <p class="text-gray-600 text-sm">{{ $event->event_start_date->format('H:i') }} -
                                    {{ $event->event_end_date->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Lokasi</p>
                                <p class="text-gray-900 font-semibold">{{ $event->location }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Period -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-blue-900 mb-2">📅 Periode Pemesanan Tiket</h3>
                        <p class="text-sm text-blue-800">
                            <span class="font-medium">Dibuka:</span> {{ $event->start_date->format('d M Y, H:i') }} WIB
                        </p>
                        <p class="text-sm text-blue-800">
                            <span class="font-medium">Ditutup:</span> {{ $event->end_date->format('d M Y, H:i') }} WIB
                        </p>
                    </div>

                    <!-- Description -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3">Deskripsi Event</h2>
                        <div class="prose prose-blue max-w-none">
                            <p class="text-gray-700 whitespace-pre-line">{{ $event->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile/Tablet Booking Card (Separate Section) -->
            <div class="lg:hidden mt-6 bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
                <!-- Header with gradient -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-5 py-5">
                    <p class="text-sm text-blue-100 mb-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Harga Tiket
                    </p>
                    <p class="text-4xl font-bold text-white tracking-tight">
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                    </p>
                </div>

                <div class="px-5 py-6">
                    <!-- Quota Status with improved design -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                    </path>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">Ketersediaan</span>
                            </div>
                            <span class="text-lg font-bold text-blue-600">
                                {{ $event->available_quota }}<span
                                    class="text-gray-400 text-sm font-normal">/{{ $event->quota }}</span>
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 shadow-inner">
                            <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600 h-4 rounded-full transition-all duration-500 shadow-sm relative overflow-hidden"
                                style="width: {{ ($event->available_quota / $event->quota) * 100 }}%">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse">
                                </div>
                            </div>
                        </div>
                        @if ($event->available_quota <= 10 && $event->available_quota > 0)
                            <div
                                class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg px-3 py-2.5 flex items-start gap-2">
                                <span class="text-lg">⚡</span>
                                <p class="text-sm text-yellow-800 font-medium flex-1">
                                    Segera habis! Hanya <span class="font-bold">{{ $event->available_quota }}
                                        tiket</span> tersisa
                                </p>
                            </div>
                        @elseif ($event->available_quota > 10)
                            <p class="text-xs text-green-600 mt-2 text-center font-medium">✓ Masih banyak tiket tersedia
                            </p>
                        @endif
                    </div>

                    <!-- CTA Button -->
                    @if ($event->available_quota > 0)
                        <a href="{{ route('tix.event.checkout', $event->slug) }}" wire:navigate
                            class="group block w-full bg-gradient-to-r from-blue-600 to-blue-700 active:from-blue-700 active:to-blue-800 text-white text-center font-bold py-4 rounded-xl transition-all duration-200 shadow-lg active:shadow-xl text-lg relative overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6 group-active:scale-110 transition-transform" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z">
                                    </path>
                                </svg>
                                Beli Tiket
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-active:opacity-20 transition-opacity">
                            </div>
                        </a>
                    @else
                        <button disabled
                            class="block w-full bg-gray-300 text-gray-500 text-center font-bold py-4 rounded-xl cursor-not-allowed text-lg">
                            Tiket Habis
                        </button>
                    @endif

                </div>
            </div>



            <!-- Right Column - Sticky Booking Card (Desktop) -->
            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-8">
                    <div
                        class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <!-- Header with gradient -->
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5">
                            <p class="text-sm text-blue-100 mb-1 flex items-center gap-1">
                                Harga Tiket
                            </p>
                            <p class="text-4xl font-bold text-white tracking-tight">
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="px-6 py-6">
                            <!-- Quota Status with improved design -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-semibold text-gray-700">Ketersediaan</span>
                                    </div>
                                    <span class="text-lg font-bold text-blue-600">
                                        {{ $event->available_quota }}<span
                                            class="text-gray-400 text-sm font-normal">/{{ $event->quota }}</span>
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-4 shadow-inner">
                                    <div class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-600 h-4 rounded-full transition-all duration-500 shadow-sm relative overflow-hidden"
                                        style="width: {{ ($event->available_quota / $event->quota) * 100 }}%">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-pulse">
                                        </div>
                                    </div>
                                </div>
                                @if ($event->available_quota <= 10 && $event->available_quota > 0)
                                    <div
                                        class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg px-3 py-2.5 flex items-start gap-2">
                                        <span class="text-lg">⚡</span>
                                        <p class="text-sm text-yellow-800 font-medium flex-1">
                                            Segera habis! Hanya <span class="font-bold">{{ $event->available_quota }}
                                                tiket</span> tersisa
                                        </p>
                                    </div>
                                @elseif ($event->available_quota > 10)
                                    <p class="text-xs text-green-600 mt-2 text-center font-medium">✓ Masih banyak tiket
                                        tersedia</p>
                                @endif
                            </div>

                            <!-- CTA Button -->
                            @if ($event->available_quota > 0)
                                <a href="{{ route('tix.event.checkout', $event->slug) }}" wire:navigate
                                    class="group block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-center font-bold py-4 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl text-lg relative overflow-hidden">
                                    <span class="relative z-10 flex items-center justify-center gap-2">
                                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z">
                                            </path>
                                        </svg>
                                        Beli Tiket
                                    </span>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transition-opacity">
                                    </div>
                                </a>
                            @else
                                <button disabled
                                    class="block w-full bg-gray-300 text-gray-500 text-center font-bold py-4 rounded-xl cursor-not-allowed text-lg">
                                    Tiket Habis
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
