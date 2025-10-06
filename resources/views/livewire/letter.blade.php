<div>
    <div class="sm:p-6 space-y-4 sm:space-y-6 w-full mx-auto">
        <!-- Header Section -->
        <div
            class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
            <div class="flex items-center">
                <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-1 sm:mb-2">Manajemen Surat</h1>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 mx-1 sm:mx-0">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex">
                    <button wire:click="switchTab('incoming')"
                        class="flex-1 py-4 px-6 text-sm font-medium text-center border-b-2 transition-colors {{ $activeTab === 'incoming' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            Surat Masuk
                        </div>
                    </button>
                    <button wire:click="switchTab('outgoing')"
                        class="flex-1 py-4 px-6 text-sm font-medium text-center border-b-2 transition-colors {{ $activeTab === 'outgoing' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                </path>
                            </svg>
                            Surat Keluar
                        </div>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Search and Controls -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 mx-1 sm:mx-0">
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <!-- Search Input -->
                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" wire:model.live="search" placeholder="Cari surat..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                    </div>
                </div>

                <!-- Control Buttons -->
                <div class="flex gap-2">
                    <!-- Add Button -->
                    <button wire:click="openCreateModal('{{ $activeTab }}')"
                        class="bg-gradient-to-r from-blue-600 to-red-600 text-white hover:from-blue-700 hover:to-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 sm:px-4 py-2 text-center inline-flex items-center transition-colors whitespace-nowrap">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span
                            class="hidden sm:inline">{{ $activeTab === 'incoming' ? 'Tambah Surat Masuk' : 'Buat Surat Keluar' }}</span>
                        <span class="sm:hidden">Tambah</span>
                    </button>

                    <!-- Export PDF Button -->
                    <button wire:click="exportPdf"
                        class="bg-red-600 text-white hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 sm:px-4 py-2 text-center inline-flex items-center transition-colors whitespace-nowrap">
                        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="hidden sm:inline">Export PDF</span>
                        <span class="sm:hidden">PDF</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="flex items-center p-3 sm:p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 mx-1 sm:mx-0"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-2 sm:me-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 0 1 3 0v4a1.5 1.5 0 0 1-3 0V4Zm0 10a1.5 1.5 0 0 1 3 0v.5a1.5 1.5 0 0 1-3 0V14Z" />
                </svg>
                <div class="text-xs sm:text-sm">{{ session('message') }}</div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="flex items-center p-3 sm:p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 mx-1 sm:mx-0"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-2 sm:me-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 0 1 3 0v4a1.5 1.5 0 0 1-3 0V4Zm0 10a1.5 1.5 0 0 1 3 0v.5a1.5 1.5 0 0 1-3 0V14Z" />
                </svg>
                <div class="text-xs sm:text-sm">{{ session('error') }}</div>
            </div>
        @endif

        <!-- Letters Table -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 overflow-hidden mx-1 sm:mx-0">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            @if ($activeTab === 'incoming')
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    No
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Nomor Surat
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Tanggal Terima
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Tanggal Pelaksanaan
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Pengirim
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Penerima
                                </th>
                            @else
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    No
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Nomor Surat
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Tanggal Surat
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Dikirim Kepada
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Perihal
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                    Lampiran
                                </th>
                            @endif
                            <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($letters as $letter)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                @if ($activeTab === 'incoming')
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="px-3 sm:px-6 py-3 sm:py-4 font-medium text-gray-900 text-xs sm:text-sm text-center">
                                        {{ $letter['letter_number'] }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ \Carbon\Carbon::parse($letter['received_date'])->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $letter['execution_date'] ? \Carbon\Carbon::parse($letter['execution_date'])->locale('id')->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $letter['sender'] }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $letter['recipient'] }}
                                    </td>
                                @else
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="px-3 sm:px-6 py-3 sm:py-4 font-medium text-gray-900 text-xs sm:text-sm text-center">
                                        {{ $letter['letter_number'] }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ \Carbon\Carbon::parse($letter['letter_date'])->locale('id')->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $letter['sent_to'] }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $letter['subject'] }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 text-center">
                                        {{ $letter['attachments'] ?: '-' }}
                                    </td>
                                @endif
                                <td class="px-3 sm:px-6 py-3 sm:py-4 text-center">
                                    <div class="flex justify-center gap-1">
                                        <!-- Edit Button -->
                                        <button wire:click="openEditModal({{ $letter['id'] }})" type="button"
                                            class="text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-8 h-8 flex items-center justify-center transition-colors"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <!-- Delete Button -->
                                        <button onclick="confirmDeleteLetter({{ $letter['id'] }})" type="button"
                                            class="text-red-600 bg-red-50 hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg w-8 h-8 flex items-center justify-center transition-colors"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $activeTab === 'incoming' ? '7' : '7' }}"
                                    class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        @if ($activeTab === 'incoming')
                                            <svg class="w-8 h-8 sm:h-12 sm:w-12 text-gray-400 mb-2 sm:mb-4"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="text-xs sm:text-sm">Belum ada surat masuk</p>
                                        @else
                                            <svg class="w-8 h-8 sm:h-12 sm:w-12 text-gray-400 mb-2 sm:mb-4"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                                </path>
                                            </svg>
                                            <p class="text-xs sm:text-sm">Belum ada surat keluar</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($letters->hasPages())
                <div class="px-3 sm:px-6 py-3 sm:py-4 border-t border-gray-200">
                    {{ $letters->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Functions -->
    <script>
        function confirmDeleteLetter(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Surat ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', id);
                }
            });
        }

        // Listen for success message
        window.addEventListener('swal:success', event => {
            Swal.fire({
                title: 'Berhasil!',
                text: event.detail[0].message,
                icon: 'success',
                confirmButtonColor: '#059669',
                confirmButtonText: 'OK'
            });
        });

        // Listen for error message
        window.addEventListener('swal:error', event => {
            Swal.fire({
                title: 'Gagal!',
                text: event.detail[0].message,
                icon: 'error',
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'OK'
            });
        });
    </script>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Backdrop with blur transparent overlay -->
            <div class="fixed inset-0 bg-white/20 backdrop-blur-sm transition-all duration-300"
                wire:click="closeModal"></div>

            <!-- Modal positioning container -->
            <div class="fixed inset-0 flex items-center justify-center p-2 sm:p-4">
                <!-- Modal content -->
                <div class="relative bg-white rounded-xl shadow-2xl transform transition-all duration-300 w-full max-w-xs sm:max-w-lg md:max-w-2xl max-h-[90vh] overflow-hidden"
                    onclick="event.stopPropagation()" style="margin: 0 auto;">
                    <form wire:submit="save">
                        <!-- Modal Header -->
                        <div
                            class="bg-gradient-to-r from-blue-600 to-red-600 px-3 sm:px-4 md:px-6 py-3 sm:py-4 rounded-t-xl">
                            <div class="flex items-center justify-between">
                                <h3
                                    class="text-sm sm:text-base md:text-lg leading-6 font-semibold text-white truncate pr-2">
                                    @if ($editingId)
                                        Edit {{ $letter_type === 'incoming' ? 'Surat Masuk' : 'Surat Keluar' }}
                                    @else
                                        {{ $letter_type === 'incoming' ? 'Tambah Surat Masuk' : 'Buat Surat Keluar' }}
                                    @endif
                                </h3>
                                <button type="button" wire:click="closeModal"
                                    class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white/20 rounded-lg p-1 transition-colors">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="bg-white px-3 sm:px-4 md:px-6 py-4 sm:py-5 md:py-6 max-h-[70vh] overflow-y-auto">
                            <div class="w-full">

                                <div class="grid grid-cols-1 gap-4">
                                    <!-- Letter Type (Hidden but used for logic) -->
                                    <input type="hidden" wire:model="letter_type">

                                    @if ($letter_type === 'incoming')
                                        <!-- Incoming Letter Fields -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <span class="text-red-500">*</span> Nomor Surat
                                                </label>
                                                <input wire:model="letter_number" type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                    placeholder="Masukkan nomor surat">
                                                @error('letter_number')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <span class="text-red-500">*</span> Tanggal Terima
                                                </label>
                                                <input wire:model="received_date" type="date"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                @error('received_date')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Tanggal Pelaksanaan
                                                </label>
                                                <input wire:model="execution_date" type="date"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                @error('execution_date')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <span class="text-red-500">*</span> Pengirim
                                                </label>
                                                <input wire:model="sender" type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                    placeholder="Masukkan nama pengirim">
                                                @error('sender')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Penerima
                                            </label>
                                            <input wire:model="recipient" type="text"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Masukkan nama penerima">
                                            @error('recipient')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @else
                                        <!-- Outgoing Letter Fields -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <span class="text-red-500">*</span> Nomor Surat
                                                </label>
                                                <div class="flex gap-2">
                                                    <input wire:model="letter_number" type="text"
                                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                        placeholder="Masukkan nomor surat">
                                                </div>
                                                @error('letter_number')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    <span class="text-red-500">*</span> Tanggal Surat
                                                </label>
                                                <input wire:model="letter_date" type="date"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                @error('letter_date')
                                                    <span
                                                        class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Dikirim Kepada
                                            </label>
                                            <input wire:model="sent_to" type="text"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Masukkan nama penerima">
                                            @error('sent_to')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Perihal
                                            </label>
                                            <input wire:model="subject" type="text"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Masukkan perihal surat">
                                            @error('subject')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Lampiran
                                            </label>
                                            <textarea wire:model="attachments" rows="3"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                                placeholder="Daftar lampiran surat (opsional)"></textarea>
                                            @error('attachments')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div
                            class="bg-gray-50 px-3 sm:px-4 md:px-6 py-3 sm:py-4 border-t border-gray-200 rounded-b-xl">
                            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3">
                                <button type="button" wire:click="closeModal"
                                    class="w-full sm:w-auto inline-flex justify-center items-center rounded-lg border border-gray-300 shadow-sm px-3 sm:px-4 py-2 bg-white text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </button>
                                <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-3 sm:px-4 py-2 bg-gradient-to-r from-blue-600 to-red-600 text-xs sm:text-sm font-medium text-white hover:from-blue-700 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    {{ $editingId ? 'Perbarui' : 'Simpan' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    @endif
</div>
