<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Custom Styles for QR Scanner -->
    <style>
        #qr-reader {
            width: 100% !important;
        }

        #qr-reader video {
            width: 100% !important;
            height: auto !important;
            display: block !important;
            border-radius: 0.5rem;
            object-fit: cover;
        }

        #qr-reader__dashboard_section {
            display: none !important;
        }

        #qr-reader__scan_region {
            width: 100% !important;
            border-radius: 0.5rem !important;
        }

        #qr-reader__camera_permission_button {
            background-color: #2563eb !important;
            color: white !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 0.5rem !important;
            font-weight: 600 !important;
        }
    </style>

    <!-- Header Section -->
    <div
        class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-6 lg:p-8 mx-1 sm:mx-0">
        <div class="flex items-center gap-3">
            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                </path>
            </svg>
            <div>
                <h1 class="text-xl sm:text-2xl lg:text-4xl font-bold text-white leading-tight">Kehadiran Event</h1>
                <p class="text-sm sm:text-base text-white/90 mt-1">{{ $event->title }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-6 mx-1 sm:mx-0">
        <!-- Total Peserta -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Peserta</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Sudah Check-in -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Sudah Check-in</p>
                    <p class="text-2xl sm:text-3xl font-bold text-green-600 mt-2">{{ $stats['checked_in'] }}</p>
                    @if ($stats['total'] > 0)
                        <p class="text-xs text-gray-500 mt-1">
                            {{ number_format(($stats['checked_in'] / $stats['total']) * 100, 1) }}%</p>
                    @endif
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Belum Check-in -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Belum Check-in</p>
                    <p class="text-2xl sm:text-3xl font-bold text-orange-600 mt-2">{{ $stats['not_checked_in'] }}</p>
                    @if ($stats['total'] > 0)
                        <p class="text-xs text-gray-500 mt-1">
                            {{ number_format(($stats['not_checked_in'] / $stats['total']) * 100, 1) }}%</p>
                    @endif
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Check-in Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 mx-1 sm:mx-0">
        <button wire:click="openModal('qr')" type="button"
            class="flex items-center justify-center gap-3 p-6 bg-white rounded-lg sm:rounded-xl shadow-lg border-2 border-blue-500 hover:bg-blue-50 transition-all duration-200 group">
            <div class="bg-blue-100 p-3 rounded-lg group-hover:bg-blue-200 transition-colors">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                    </path>
                </svg>
            </div>
            <div class="text-left">
                <h3 class="font-bold text-gray-900 text-lg">Scan QR Code</h3>
                <p class="text-sm text-gray-600">Scan kode QR dari e-ticket</p>
            </div>
        </button>

        <button wire:click="openModal('manual')" type="button"
            class="flex items-center justify-center gap-3 p-6 bg-white rounded-lg sm:rounded-xl shadow-lg border-2 border-green-500 hover:bg-green-50 transition-all duration-200 group">
            <div class="bg-green-100 p-3 rounded-lg group-hover:bg-green-200 transition-colors">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                    </path>
                </svg>
            </div>
            <div class="text-left">
                <h3 class="font-bold text-gray-900 text-lg">Input Kode Tiket</h3>
                <p class="text-sm text-gray-600">Masukkan kode tiket manual</p>
            </div>
        </button>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6 mx-1 sm:mx-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama atau kode tiket..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select wire:model.live="filterStatus"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                    <option value="all">Semua Status</option>
                    <option value="checked_in">Sudah Check-in</option>
                    <option value="not_checked_in">Belum Check-in</option>
                </select>
            </div>

            <!-- Export PDF -->
            @if (auth()->user()->position && in_array(auth()->user()->position->name, ['Ketua', 'Wakil Ketua', 'Sekertaris']))
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Export</label>
                    <button wire:click="exportPdf" type="button"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export PDF
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Desktop Table View -->
    <div
        class="hidden lg:block bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 overflow-hidden mx-1 sm:mx-0">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Waktu Check-in</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($attendees as $attendee)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="font-mono text-sm font-bold text-gray-900">{{ $attendee->ticket_code }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $attendee->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $attendee->order->event->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($attendee->is_checked_in)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Check-in
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Belum
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attendee->checked_in_at ? $attendee->checked_in_at->format('d M Y H:i') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <p class="mt-4 text-gray-500 font-medium">Tidak ada data peserta</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile/Tablet Card View -->
    <div class="lg:hidden space-y-3 mx-1 sm:mx-0">
        @forelse($attendees as $attendee)
            <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 text-lg">{{ $attendee->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $attendee->order->event->title }}</p>
                    </div>
                    @if ($attendee->is_checked_in)
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Check-in
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Belum
                        </span>
                    @endif
                </div>

                <div class="border-t border-gray-200 pt-3 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Kode Tiket</span>
                        <span class="font-mono text-sm font-bold text-gray-900">{{ $attendee->ticket_code }}</span>
                    </div>
                    @if ($attendee->checked_in_at)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Waktu Check-in</span>
                            <span
                                class="text-sm text-gray-900">{{ $attendee->checked_in_at->format('d M Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                    </path>
                </svg>
                <p class="mt-4 text-gray-500 font-medium">Tidak ada data peserta</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mx-1 sm:mx-0">
        {{ $attendees->links() }}
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" wire:key="check-in-modal">
            <div class="flex items-center justify-center min-h-screen px-2 sm:px-4 pt-4 pb-20 text-center sm:p-0">
                <!-- Backdrop with Blur -->
                <div class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" wire:click="closeModal">
                </div>

                <!-- Modal Content -->
                <div
                    class="relative inline-block w-full max-w-lg p-4 sm:p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <div class="flex items-center gap-2 sm:gap-3">
                            @if ($scanMode === 'qr')
                                <div class="bg-blue-100 p-1.5 sm:p-2 rounded-lg">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Scan QR Code</h3>
                            @else
                                <div class="bg-green-100 p-1.5 sm:p-2 rounded-lg">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Input Kode Tiket</h3>
                            @endif
                        </div>
                        <button wire:click="closeModal" type="button"
                            class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="space-y-3">
                        @if ($scanMode === 'qr')
                            <!-- QR Scanner -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl px-2 pb-2 pt-1 text-center border-2 border-blue-200">
                                <div class="relative mx-auto w-full rounded-lg overflow-hidden">
                                    <!-- QR Scanner Container -->
                                    <div id="qr-reader" class="w-full h-full"></div>
                                </div>
                                <p class="text-blue-700 mt-1 font-semibold text-base sm:text-lg">Arahkan kamera
                                    ke QR Code</p>
                                <p class="text-xs sm:text-sm text-blue-600" id="qr-status">Memulai
                                    kamera...</p>
                            </div>

                            <!-- Switch to Manual -->
                            <div class="text-center">
                                <button wire:click="$set('scanMode', 'manual')" type="button"
                                    class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 font-medium underline">
                                    Atau masukkan kode tiket
                                </button>
                            </div>
                        @else
                            <!-- Manual Input with 6 Boxes -->
                            <div>
                                <label
                                    class="block text-xs sm:text-sm font-medium text-gray-700 mb-3 sm:mb-4 text-center">
                                    Masukkan 6 Digit Kode Tiket
                                </label>
                                <div class="flex justify-center gap-1.5 sm:gap-2 md:gap-3">
                                    <input type="text" wire:model.live="digit1" maxlength="1"
                                        class="w-10 h-12 sm:w-12 sm:h-14 md:w-14 md:h-16 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 uppercase transition-all"
                                        id="digit-1" autocomplete="off" inputmode="text">
                                    <input type="text" wire:model.live="digit2" maxlength="1"
                                        class="w-10 h-12 sm:w-12 sm:h-14 md:w-14 md:h-16 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 uppercase transition-all"
                                        id="digit-2" autocomplete="off" inputmode="text">
                                    <input type="text" wire:model.live="digit3" maxlength="1"
                                        class="w-10 h-12 sm:w-12 sm:h-14 md:w-14 md:h-16 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 uppercase transition-all"
                                        id="digit-3" autocomplete="off" inputmode="text">
                                    <input type="text" wire:model.live="digit4" maxlength="1"
                                        class="w-10 h-12 sm:w-12 sm:h-14 md:w-14 md:h-16 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 uppercase transition-all"
                                        id="digit-4" autocomplete="off" inputmode="text">
                                    <input type="text" wire:model.live="digit5" maxlength="1"
                                        class="w-10 h-12 sm:w-12 sm:h-14 md:w-14 md:h-16 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 uppercase transition-all"
                                        id="digit-5" autocomplete="off" inputmode="text">
                                    <input type="text" wire:model.live="digit6" maxlength="1"
                                        class="w-10 h-12 sm:w-12 sm:h-14 md:w-14 md:h-16 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500 uppercase transition-all"
                                        id="digit-6" autocomplete="off" inputmode="text">
                                </div>
                                <p class="text-xs text-gray-500 text-center mt-3 sm:mt-4 px-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 inline-block mr-1" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Masukkan kode tiket yang tertera pada e-ticket
                                </p>
                            </div>

                            <!-- Switch to QR -->
                            <div class="text-center">
                                <button wire:click="$set('scanMode', 'qr')" type="button"
                                    class="text-xs sm:text-sm text-green-600 hover:text-green-800 font-medium underline">
                                    Atau scan QR Code
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Auto-focus Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('focus-digit', (event) => {
                const digit = event.digit || event[0]?.digit;
                if (digit) {
                    const input = document.getElementById(`digit-${digit}`);
                    if (input) {
                        input.focus();
                    }
                }
            });
        });

        // Auto-focus first input when modal opens in manual mode
        document.addEventListener('livewire:update', () => {
            const firstInput = document.getElementById('digit-1');
            if (firstInput && document.activeElement !== firstInput) {
                setTimeout(() => firstInput.focus(), 100);
            }
        });
    </script>

    <!-- QR Scanner Script - Using jsQR for faster scanning -->
    <script src="https://unpkg.com/jsqr@1.4.0/dist/jsQR.js"></script>
    <script>
        let videoStream = null;
        let isScanning = false;
        let lastScanTime = 0;
        let scanAnimationFrame = null;
        let livewireComponent = null;
        let scanLinePosition = 0;
        let scanLineDirection = 1;

        // Function to setup event listeners
        function setupEventListeners() {
            if (!window.Livewire) return;

            Livewire.on('show-modal', () => {
                setTimeout(() => {
                    try {
                        const component = livewireComponent || @this;
                        if (component && component.scanMode === 'qr') {
                            startQRScanner();
                        }
                    } catch (e) {
                        console.error('Error accessing component:', e);
                    }
                }, 300);
            });

            Livewire.on('close-modal', () => {
                stopQRScanner();
            });
        }

        // Initialize on Livewire load
        document.addEventListener('livewire:init', () => {
            try {
                livewireComponent = @this;
                setupEventListeners();
            } catch (e) {
                console.error('Livewire component not ready:', e);
            }
        });

        // Reinitialize on SPA navigation
        document.addEventListener('livewire:navigated', () => {
            stopQRScanner();
            setTimeout(() => {
                try {
                    livewireComponent = @this;
                    setupEventListeners();
                } catch (e) {
                    console.error('Failed to reinitialize:', e);
                }
            }, 100);
        });

        // Watch for component updates
        document.addEventListener('livewire:update', () => {
            try {
                const component = livewireComponent || @this;
                if (!component) return;

                const scanMode = component.scanMode;
                const showModal = component.showModal;

                if (scanMode === 'qr' && showModal && !isScanning) {
                    setTimeout(() => startQRScanner(), 300);
                } else if (scanMode !== 'qr' || !showModal) {
                    stopQRScanner();
                }
            } catch (e) {
                // Component not ready yet
            }
        });

        // Start QR Scanner with jsQR
        function startQRScanner() {
            if (isScanning) {
                return;
            }

            const qrReader = document.getElementById('qr-reader');
            const qrStatus = document.getElementById('qr-status');

            if (!qrReader) {
                return;
            }

            if (qrStatus) {
                qrStatus.textContent = 'Meminta izin kamera...';
            }

            // Create video element
            const video = document.createElement('video');
            video.style.width = '100%';
            video.style.height = 'auto';
            video.style.borderRadius = '0.5rem';
            video.setAttribute('playsinline', true);

            // Create canvas for QR detection
            const canvas = document.createElement('canvas');
            const canvasContext = canvas.getContext('2d');

            // Create overlay canvas for visual feedback (scanning box)
            const overlayCanvas = document.createElement('canvas');
            overlayCanvas.style.position = 'absolute';
            overlayCanvas.style.top = '0';
            overlayCanvas.style.left = '0';
            overlayCanvas.style.width = '100%';
            overlayCanvas.style.height = '100%';
            overlayCanvas.style.pointerEvents = 'none';
            const overlayContext = overlayCanvas.getContext('2d');

            // Clear and add elements to container
            qrReader.innerHTML = '';
            qrReader.style.position = 'relative';
            qrReader.appendChild(video);
            qrReader.appendChild(overlayCanvas);

            // Request camera access
            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment",
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        }
                    }
                })
                .then(stream => {
                    videoStream = stream;
                    video.srcObject = stream;
                    video.play();

                    isScanning = true;
                    if (qrStatus) {
                        qrStatus.textContent = 'Kamera aktif - Arahkan ke QR Code';
                    }

                    // Start scanning loop
                    video.addEventListener('loadedmetadata', () => {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        overlayCanvas.width = video.videoWidth;
                        overlayCanvas.height = video.videoHeight;
                        scanQRCode();
                    });

                    function scanQRCode() {
                        if (!isScanning) return;

                        if (video.readyState === video.HAVE_ENOUGH_DATA) {
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                            overlayCanvas.width = video.videoWidth;
                            overlayCanvas.height = video.videoHeight;

                            canvasContext.drawImage(video, 0, 0, canvas.width, canvas.height);

                            const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
                            const code = jsQR(imageData.data, imageData.width, imageData.height, {
                                inversionAttempts: "dontInvert",
                            });

                            // Clear overlay
                            overlayContext.clearRect(0, 0, overlayCanvas.width, overlayCanvas.height);

                            if (code) {
                                // Draw lines connecting all four corners (GREEN)
                                overlayContext.beginPath();
                                overlayContext.moveTo(code.location.topLeftCorner.x, code.location.topLeftCorner.y);
                                overlayContext.lineTo(code.location.topRightCorner.x, code.location.topRightCorner.y);
                                overlayContext.lineTo(code.location.bottomRightCorner.x, code.location.bottomRightCorner
                                    .y);
                                overlayContext.lineTo(code.location.bottomLeftCorner.x, code.location.bottomLeftCorner
                                    .y);
                                overlayContext.closePath();
                                overlayContext.lineWidth = 4;
                                overlayContext.strokeStyle = '#10b981';
                                overlayContext.stroke();

                                // Draw corner dots on all four corners
                                overlayContext.fillStyle = '#10b981';
                                const dotRadius = 8;
                                [code.location.topLeftCorner, code.location.topRightCorner,
                                    code.location.bottomLeftCorner, code.location.bottomRightCorner
                                ].forEach(corner => {
                                    overlayContext.beginPath();
                                    overlayContext.arc(corner.x, corner.y, dotRadius, 0, 2 * Math.PI);
                                    overlayContext.fill();
                                });

                                // Prevent duplicate scans within 3 seconds
                                const currentTime = Date.now();
                                if (currentTime - lastScanTime < 3000) {
                                    // Still show the green box but don't process
                                    scanAnimationFrame = requestAnimationFrame(scanQRCode);
                                    return;
                                }
                                lastScanTime = currentTime;

                                // QR Code detected
                                if (qrStatus) {
                                    qrStatus.textContent = 'QR Code terdeteksi! Memproses...';
                                }

                                // Send to Livewire (keep scanner running)
                                const component = livewireComponent || @this;
                                if (component && component.call) {
                                    component.call('scanQRCode', code.data).then((result) => {
                                        // Reset status after processing
                                        setTimeout(() => {
                                            if (qrStatus && isScanning) {
                                                qrStatus.textContent =
                                                    'Kamera aktif - Arahkan ke QR Code';
                                            }
                                        }, 2000);
                                    }).catch((err) => {
                                        if (qrStatus && isScanning) {
                                            qrStatus.textContent = 'Error! Kamera aktif - Arahkan ke QR Code';
                                        }
                                    });
                                }

                                // IMPORTANT: Continue scanning - do NOT return here
                            } else {
                                // Draw scanning area box - Perfect square in center
                                const padding = 50; // Padding from edges
                                const maxBoxSize = Math.min(canvas.width, canvas.height) - (padding * 2);
                                const scanBoxSize = Math.min(maxBoxSize, 350); // Max 350px or fit to screen
                                const scanBoxX = (canvas.width - scanBoxSize) / 2;
                                const scanBoxY = (canvas.height - scanBoxSize) / 2;

                                // Draw corner dots (BLUE)
                                overlayContext.fillStyle = '#3b82f6';
                                const dotRadius = 8;
                                const corners = [{
                                        x: scanBoxX,
                                        y: scanBoxY
                                    }, // top-left
                                    {
                                        x: scanBoxX + scanBoxSize,
                                        y: scanBoxY
                                    }, // top-right
                                    {
                                        x: scanBoxX,
                                        y: scanBoxY + scanBoxSize
                                    }, // bottom-left
                                    {
                                        x: scanBoxX + scanBoxSize,
                                        y: scanBoxY + scanBoxSize
                                    } // bottom-right
                                ];

                                corners.forEach(corner => {
                                    overlayContext.beginPath();
                                    overlayContext.arc(corner.x, corner.y, dotRadius, 0, 2 * Math.PI);
                                    overlayContext.fill();
                                });

                                // Draw corner brackets (L-shaped lines)
                                overlayContext.strokeStyle = '#3b82f6';
                                overlayContext.lineWidth = 3;
                                const bracketLength = 30;

                                // Top-left corner
                                overlayContext.beginPath();
                                overlayContext.moveTo(scanBoxX, scanBoxY);
                                overlayContext.lineTo(scanBoxX + bracketLength, scanBoxY);
                                overlayContext.moveTo(scanBoxX, scanBoxY);
                                overlayContext.lineTo(scanBoxX, scanBoxY + bracketLength);
                                overlayContext.stroke();

                                // Top-right corner
                                overlayContext.beginPath();
                                overlayContext.moveTo(scanBoxX + scanBoxSize, scanBoxY);
                                overlayContext.lineTo(scanBoxX + scanBoxSize - bracketLength, scanBoxY);
                                overlayContext.moveTo(scanBoxX + scanBoxSize, scanBoxY);
                                overlayContext.lineTo(scanBoxX + scanBoxSize, scanBoxY + bracketLength);
                                overlayContext.stroke();

                                // Bottom-left corner
                                overlayContext.beginPath();
                                overlayContext.moveTo(scanBoxX, scanBoxY + scanBoxSize);
                                overlayContext.lineTo(scanBoxX + bracketLength, scanBoxY + scanBoxSize);
                                overlayContext.moveTo(scanBoxX, scanBoxY + scanBoxSize);
                                overlayContext.lineTo(scanBoxX, scanBoxY + scanBoxSize - bracketLength);
                                overlayContext.stroke();

                                // Bottom-right corner
                                overlayContext.beginPath();
                                overlayContext.moveTo(scanBoxX + scanBoxSize, scanBoxY + scanBoxSize);
                                overlayContext.lineTo(scanBoxX + scanBoxSize - bracketLength, scanBoxY + scanBoxSize);
                                overlayContext.moveTo(scanBoxX + scanBoxSize, scanBoxY + scanBoxSize);
                                overlayContext.lineTo(scanBoxX + scanBoxSize, scanBoxY + scanBoxSize - bracketLength);
                                overlayContext.stroke();
                            }
                        }

                        // Always continue the scan loop
                        if (isScanning) {
                            scanAnimationFrame = requestAnimationFrame(scanQRCode);
                        }
                    }
                })
                .catch(err => {
                    isScanning = false;
                    const errorMsg = err.toString();
                    if (qrStatus) {
                        if (errorMsg.includes('Permission') || errorMsg.includes('NotAllowed')) {
                            qrStatus.textContent = 'Izin kamera ditolak. Mohon izinkan akses kamera.';
                        } else if (errorMsg.includes('NotFound')) {
                            qrStatus.textContent = 'Kamera tidak ditemukan.';
                        } else {
                            qrStatus.textContent = 'Gagal mengakses kamera.';
                        }
                    }
                });
        }

        // Stop QR Scanner
        function stopQRScanner() {
            if (scanAnimationFrame) {
                cancelAnimationFrame(scanAnimationFrame);
                scanAnimationFrame = null;
            }

            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
                videoStream = null;
            }

            const qrReader = document.getElementById('qr-reader');
            if (qrReader) {
                qrReader.innerHTML = '';
            }

            isScanning = false;
            scanLinePosition = 0;
            scanLineDirection = 1;
        }
    </script>

    <!-- SweetAlert Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-alert', (event) => {
                const data = event[0] || event;

                // Tunggu sebentar untuk memastikan modal sudah tertutup
                setTimeout(() => {
                    Swal.fire({
                        icon: data.type, // 'success', 'error', 'warning', 'info'
                        title: data.title,
                        text: data.message,
                        confirmButtonColor: data.type === 'success' ? '#10b981' : data
                            .type === 'error' ?
                            '#ef4444' : '#f59e0b',
                        confirmButtonText: 'OK',
                        timer: data.type === 'success' ? 3000 : undefined,
                        timerProgressBar: data.type === 'success',
                    });
                }, 300);
            });
        });
    </script>
</div>
