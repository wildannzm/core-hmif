<div class="p-6" x-data="{}">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-red-600 rounded-xl shadow-lg p-6 lg:p-8 mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <!-- Title Section -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight">
                            Pemesanan Event
                        </h1>
                    </div>
                </div>
                <p class="text-sm sm:text-base text-white/90 font-medium">Kelola semua pemesanan tiket event dengan
                    mudah</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pesanan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Terverifikasi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['verified'] }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-200">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pesanan</label>
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Invoice, nama, email, atau event..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                <select wire:model.live="statusFilter"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="all">Semua Status</option>
                    <option value="pending">Menunggu Verifikasi</option>
                    <option value="verified">Terverifikasi</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full" style="min-width: 1200px;">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 60px; min-width: 60px;">
                            No</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 180px; min-width: 180px;">
                            Invoice</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 200px; min-width: 200px;">
                            Event</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 220px; min-width: 220px;">
                            Pembeli</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 100px; min-width: 100px;">
                            Qty
                        </th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 140px; min-width: 140px;">
                            Total</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 140px; min-width: 140px;">
                            Status</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 130px; min-width: 130px;">
                            Tanggal</th>
                        <th class="px-6 py-5 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider"
                            style="width: 140px; min-width: 140px;">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $index => $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-6 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-600">{{ $orders->firstItem() + $index }}</p>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-900">{{ $order->invoice_code }}</p>
                            </td>
                            <td class="px-6 py-6">
                                <p class="text-sm font-medium text-gray-900">{{ $order->event->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $order->event->event_start_date->format('d M Y') }}
                                </p>
                            </td>
                            <td class="px-6 py-6">
                                <p class="text-sm font-medium text-gray-900">{{ $order->buyer_name }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->buyer_email }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $order->buyer_phone }}</p>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    {{ $order->quantity }} tiket
                                </span>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                <p class="text-sm font-bold text-gray-900">Rp
                                    {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                @if ($order->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @elseif ($order->status === 'verified')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                <p class="text-sm text-gray-900">{{ $order->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap">
                                @if (auth()->user()->hasRole('bph') ||
                                        (auth()->user()->position && in_array(auth()->user()->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara'])))
                                    <div class="flex items-center justify-center gap-2">
                                        <button wire:click="viewPaymentProof({{ $order->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Lihat Bukti">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>

                                        @if ($order->status === 'pending')
                                            <button type="button" x-on:click="confirmVerify({{ $order->id }})"
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                title="Verifikasi">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>

                                            <button type="button" x-on:click="confirmReject({{ $order->id }})"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                title="Tolak">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        @elseif ($order->status === 'verified')
                                            <button type="button" wire:click="downloadTickets({{ $order->id }})"
                                                class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors"
                                                title="Download E-Ticket">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <button type="button" wire:click="sendToWhatsApp({{ $order->id }})"
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                title="Kirim ke WhatsApp">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <div class="flex items-center justify-center">
                                        <span class="text-xs text-gray-400">-</span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 font-medium">Tidak ada pesanan ditemukan</p>
                                    <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau kata kunci pencarian
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <!-- Mobile/Tablet Card View -->
    <div class="lg:hidden space-y-4">
        @forelse ($orders as $order)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-3">
                    <p class="text-xs text-blue-100">Invoice</p>
                    <p class="text-sm font-bold text-white">{{ $order->invoice_code }}</p>
                </div>

                <!-- Content -->
                <div class="p-4 space-y-3">
                    <!-- Event Info -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Event</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $order->event->title }}</p>
                        <p class="text-xs text-gray-600">{{ $order->event->event_start_date->format('d M Y, H:i') }}
                            WIB</p>
                    </div>

                    <!-- Payment Status -->
                    <div class="pt-3 border-t border-gray-100">
                        <p class="text-xs text-gray-500 mb-2">Status Pembayaran</p>
                        @if ($order->status === 'pending')
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                                Menunggu Verifikasi
                            </span>
                        @elseif ($order->status === 'verified')
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Terverifikasi
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Ditolak
                            </span>
                        @endif
                    </div>

                    <!-- Buyer Info -->
                    <div class="pt-3 border-t border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Pembeli</p>
                        <p class="text-sm font-medium text-gray-900">{{ $order->buyer_name }}</p>
                        <p class="text-xs text-gray-600">{{ $order->buyer_email }}</p>
                        <p class="text-xs text-gray-600">{{ $order->buyer_phone }}</p>
                    </div>

                    <!-- Order Details -->
                    <div class="pt-3 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500">Jumlah Tiket</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $order->quantity }} tiket</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Total Pembayaran</p>
                                <p class="text-lg font-bold text-blue-600">Rp
                                    {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="pt-3 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Tanggal Pesanan:
                            {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    @if (auth()->user()->hasRole('bph') ||
                            (auth()->user()->position && in_array(auth()->user()->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara'])))
                        <div class="flex gap-2">
                            <button wire:click="viewPaymentProof({{ $order->id }})"
                                class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Lihat Bukti
                            </button>

                            @if ($order->status === 'pending')
                                <button type="button" x-on:click="confirmVerify({{ $order->id }})"
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>

                                <button type="button" x-on:click="confirmReject({{ $order->id }})"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            @elseif ($order->status === 'verified')
                                <button wire:click="downloadTickets({{ $order->id }})"
                                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Download
                                </button>

                                <button wire:click="sendToWhatsApp({{ $order->id }})"
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                    </svg>
                                    WhatsApp
                                </button>
                            @endif
                        </div>
                    @else
                        <p class="text-center text-xs text-gray-400 py-2">Aksi tidak tersedia</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <p class="text-gray-500 font-medium">Tidak ada pesanan ditemukan</p>
                <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau kata kunci pencarian</p>
            </div>
        @endforelse

        @if ($orders->hasPages())
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <!-- Payment Proof Modal -->
    @if ($selectedOrder)
        <div x-data="{ open: false }" x-on:open-payment-modal.window="open = true"
            x-on:close-payment-modal.window="open = false" x-show="open" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <!-- Backdrop -->
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/60 backdrop-blur-md transition-all" @click="open = false">
            </div>

            <!-- Modal -->
            <div class="flex min-h-screen items-center justify-center p-4">
                <div x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">

                    <!-- Close Button -->
                    <button @click="open = false"
                        class="absolute top-4 right-4 z-10 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 rounded-t-2xl">
                        <h3 class="text-xl font-bold text-white">Detail Pesanan</h3>
                        <p class="text-sm text-blue-100 mt-1">{{ $selectedOrder->invoice_code }}</p>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Left Column - Order Info -->
                            <div class="space-y-4">
                                <!-- Event Info -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Informasi Event</h4>
                                    <div class="space-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Nama Event</p>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $selectedOrder->event->title }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Tanggal Event</p>
                                            <p class="text-sm text-gray-900">
                                                {{ $selectedOrder->event->event_start_date->format('d M Y, H:i') }} WIB
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Lokasi</p>
                                            <p class="text-sm text-gray-900">{{ $selectedOrder->event->location }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buyer Info -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Informasi Pembeli</h4>
                                    <div class="space-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Nama</p>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $selectedOrder->buyer_name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Email</p>
                                            <p class="text-sm text-gray-900">{{ $selectedOrder->buyer_email }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Telepon</p>
                                            <p class="text-sm text-gray-900">{{ $selectedOrder->buyer_phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Summary -->
                                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                    <h4 class="text-sm font-semibold text-blue-900 mb-3">Ringkasan Pesanan</h4>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <p class="text-sm text-gray-700">Jumlah Tiket</p>
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $selectedOrder->quantity }} tiket</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-sm text-gray-700">Harga per Tiket</p>
                                            <p class="text-sm font-semibold text-gray-900">Rp
                                                {{ number_format($selectedOrder->event->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="flex justify-between pt-2 border-t border-blue-300">
                                            <p class="text-sm font-semibold text-blue-900">Total Pembayaran</p>
                                            <p class="text-lg font-bold text-blue-600">Rp
                                                {{ number_format($selectedOrder->total_amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="flex justify-between pt-2">
                                            <p class="text-xs text-gray-600">Metode Pembayaran</p>
                                            <p class="text-xs font-medium text-gray-900">
                                                {{ $selectedOrder->paymentMethod->name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Attendees List -->
                                @if ($selectedOrder->attendees->count() > 0)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Daftar Peserta</h4>
                                        <div class="space-y-1">
                                            @foreach ($selectedOrder->attendees as $index => $attendee)
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-semibold">
                                                        {{ $index + 1 }}
                                                    </span>
                                                    <p class="text-sm text-gray-900">{{ $attendee->name }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Right Column - Payment Proof -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Bukti Pembayaran</h4>
                                @if ($selectedOrder->payment_proof)
                                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                                        <img src="{{ Storage::url($selectedOrder->payment_proof) }}"
                                            alt="Bukti Pembayaran" class="w-full h-auto">
                                    </div>
                                    <a href="{{ Storage::url($selectedOrder->payment_proof) }}" target="_blank"
                                        class="mt-3 block text-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                        Buka di Tab Baru
                                    </a>
                                @else
                                    <div class="bg-gray-100 rounded-lg p-8 text-center">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-sm text-gray-500">Tidak ada bukti pembayaran</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if ($selectedOrder->status === 'pending')
                            <div class="mt-6 pt-6 border-t border-gray-200 flex gap-3">
                                <button type="button" @click="confirmVerify({{ $selectedOrder->id }})"
                                    wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                                    class="flex-1 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span wire:loading.remove>
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Verifikasi Pembayaran
                                    </span>
                                    <span wire:loading>
                                        <svg class="animate-spin h-5 w-5 inline mr-2"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Memproses...
                                    </span>
                                </button>
                                <button type="button" @click="confirmReject({{ $selectedOrder->id }})"
                                    wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                                    class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span wire:loading.remove>
                                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Tolak Pembayaran
                                    </span>
                                    <span wire:loading>
                                        <svg class="animate-spin h-5 w-5 inline mr-2"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Memproses...
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @script
        <script>
            // Make functions globally accessible
            window.confirmVerify = function(orderId) {
                Swal.fire({
                    title: 'Verifikasi Pembayaran?',
                    text: 'Pesanan ini akan diverifikasi dan tiket akan dikirim ke pembeli.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="fas fa-check mr-2"></i> Ya, Verifikasi',
                    cancelButtonText: '<i class="fas fa-times mr-2"></i> Batal',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-lg px-6 py-2.5 font-semibold',
                        cancelButton: 'rounded-lg px-6 py-2.5 font-semibold'
                    },
                    buttonsStyling: true,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.verifyPayment(orderId);
                    }
                });
            }

            window.confirmReject = function(orderId) {
                Swal.fire({
                    title: 'Tolak Pembayaran?',
                    text: 'Pesanan ini akan ditolak dan kuota akan dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="fas fa-times mr-2"></i> Ya, Tolak',
                    cancelButtonText: '<i class="fas fa-ban mr-2"></i> Batal',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-lg px-6 py-2.5 font-semibold',
                        cancelButton: 'rounded-lg px-6 py-2.5 font-semibold'
                    },
                    buttonsStyling: true,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.rejectPayment(orderId);
                    }
                });
            }

            // Listen for alert events
            window.addEventListener('alert', event => {
                Swal.fire({
                    title: event.detail[0].title,
                    text: event.detail[0].text,
                    icon: event.detail[0].type,
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-lg px-6 py-2.5 font-semibold'
                    }
                });
            });

            // Listen for open-whatsapp event
            Livewire.on('open-whatsapp', (event) => {
                const url = event.url || event[0]?.url;
                if (url) {
                    window.open(url, '_blank', 'noopener,noreferrer');
                }
            });
        </script>
    @endscript
</div>
