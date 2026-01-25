<div class="min-h-screen bg-gray-50 font-sans">
    <div class="relative bg-blue-900 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 opacity-95"></div>

        <div
            class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-blue-800 border border-blue-700 text-blue-200 text-sm font-semibold mb-6">
                    Official Platform Tiket HMIF
                </span>
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                    Temukan Event Seru di
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-500">HMIF
                        TIX</span>
                </h1>
                <p class="text-lg sm:text-xl text-blue-100 mb-10 leading-relaxed">
                    Satu platform untuk semua kegiatan mahasiswa. Booking tiket seminar, workshop, dan pameran dengan
                    mudah, cepat, dan aman.
                </p>

                <div class="max-w-2xl mx-auto relative z-20 group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative bg-white rounded-xl shadow-2xl flex items-center p-2">
                        <div class="pl-4 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text"
                            class="flex-1 p-3 text-gray-900 placeholder-gray-500 focus:outline-none text-lg bg-transparent border-none focus:ring-0"
                            placeholder="Cari event...">
                        <button
                            class="hidden sm:block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" id="events">
        <div class="flex items-center justify-center mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 text-center">
                Daftar Event
                <div class="h-1 w-48 bg-blue-600 mt-2 rounded-full mx-auto"></div>
            </h2>
        </div>

        @if ($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($events as $event)
                    <div
                        class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group flex flex-col h-full">

                        <a href="{{ route('tix.event.detail', $event->slug) }}" wire:navigate
                            class="relative block overflow-hidden aspect-video">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors z-10">
                            </div>

                            <div class="relative w-full aspect-video overflow-hidden bg-gray-100">
                                @if ($event->banner)
                                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="mb-4 flex-1">
                                <a href="{{ route('tix.event.detail', $event->slug) }}" wire:navigate>
                                    <h3
                                        class="text-xl font-bold text-gray-900 leading-snug mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                        {{ $event->title }}
                                    </h3>
                                </a>

                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <svg class="w-5 h-5 mr-2 text-gray-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="truncate">
                                        @if ($event->event_end_date)
                                            @if ($event->event_start_date->isSameDay($event->event_end_date))
                                                {{ $event->event_start_date->format('d M Y') }},
                                                {{ $event->event_start_date->format('H:i') }} -
                                                {{ $event->event_end_date->format('H:i') }} WIB
                                            @else
                                                {{ $event->event_start_date->format('d M') }} -
                                                {{ $event->event_end_date->format('d M Y') }}
                                            @endif
                                        @else
                                            {{ $event->event_start_date->format('d M Y, H:i') }} WIB
                                        @endif
                                    </span>
                                </div>

                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="w-5 h-5 mr-2 text-gray-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                                <div class="text-blue-700 font-bold text-xl">
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
                                </div>
                                @if ($event->start_date->isFuture())
                                    <button disabled
                                        class="px-5 py-2.5 bg-gray-100 text-gray-400 text-sm font-semibold rounded-lg cursor-not-allowed">
                                        Belum Dibuka
                                    </button>
                                @elseif ($event->end_date->isPast())
                                    <button disabled
                                        class="px-5 py-2.5 bg-red-100 text-red-500 text-sm font-semibold rounded-lg cursor-not-allowed">
                                        Ditutup
                                    </button>
                                @elseif ($event->available_quota <= 0)
                                    <button disabled
                                        class="px-5 py-2.5 bg-gray-100 text-gray-400 text-sm font-semibold rounded-lg cursor-not-allowed">
                                        Tiket Habis
                                    </button>
                                @else
                                    <a href="{{ route('tix.event.detail', $event->slug) }}" wire:navigate
                                        class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                        Beli Tiket
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-6">
                    <svg class="h-10 w-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada event ditemukan</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-8">
                    @if ($search)
                        Kami tidak menemukan event dengan kata kunci "{{ $search }}". Coba kata kunci lain.
                    @else
                        Saat ini belum ada event yang aktif. Silakan kembali lagi nanti.
                    @endif
                </p>
                @if ($search)
                    <button wire:click="$set('search', '')" class="text-blue-600 font-semibold hover:underline">
                        Reset Pencarian
                    </button>
                @endif
            </div>
        @endif
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Kenapa Beli di HMIF TIX?</h2>
                <p class="mt-4 text-gray-600">Nikmati pengalaman pemesanan tiket yang lebih baik</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="p-6 bg-gray-50 rounded-2xl hover:bg-blue-50 transition-colors duration-300 border border-gray-100 hover:border-blue-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Booking Cepat</h3>
                    <p class="text-gray-600">Proses pemesanan tiket kurang dari 2 menit. Tanpa ribet, langsung dapat
                        E-Ticket.</p>
                </div>
                <div
                    class="p-6 bg-gray-50 rounded-2xl hover:bg-blue-50 transition-colors duration-300 border border-gray-100 hover:border-blue-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Akses Mudah & Praktis</h3>
                    <p class="text-gray-600">
                        Tidak perlu download aplikasi tambahan. Akses tiket langsung dari browser
                        HP-mu.
                    </p>
                </div>
                <div
                    class="p-6 bg-gray-50 rounded-2xl hover:bg-blue-50 transition-colors duration-300 border border-gray-100 hover:border-blue-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">QR E-Ticket</h3>
                    <p class="text-gray-600">Tiket digital dengan QR Code unik. Cukup scan di lokasi event untuk masuk.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
