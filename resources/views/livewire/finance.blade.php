<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Header Section -->
    <div
        class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center">
            <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-1 sm:mb-2">Manajemen Keuangan</h1>
        </div>
    </div>



    <!-- Financial Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-green-100 text-sm">Total Pemasukan</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
                <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12">
                    </path>
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-red-100 text-sm">Total Pengeluaran</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
                <svg class="w-8 h-8 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                </svg>
            </div>
        </div>

        <div
            class="bg-gradient-to-r {{ $balance >= 0 ? 'from-blue-500 to-blue-600' : 'from-orange-500 to-orange-600' }} rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-blue-100 text-sm">Saldo</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                </div>
                <svg class="w-8 h-8 text-blue-200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M10.5 8C8.84315 8 7.5 9.34315 7.5 11C7.5 12.6569 8.84315 14 10.5 14C12.1569 14 13.5 12.6569 13.5 11C13.5 9.34315 12.1569 8 10.5 8ZM9 11C9 10.1716 9.67157 9.5 10.5 9.5C11.3284 9.5 12 10.1716 12 11C12 11.8284 11.3284 12.5 10.5 12.5C9.67157 12.5 9 11.8284 9 11Z" fill="currentColor"/>
                        <path d="M2 7.25C2 6.00736 3.00736 5 4.25 5H16.75C17.9926 5 19 6.00736 19 7.25V14.75C19 15.9926 17.9926 17 16.75 17H4.25C3.00736 17 2 15.9926 2 14.75V7.25ZM4.25 6.5C3.83579 6.5 3.5 6.83579 3.5 7.25V8H4.25C4.66421 8 5 7.66421 5 7.25V6.5H4.25ZM3.5 12.5H4.25C5.49264 12.5 6.5 13.5074 6.5 14.75V15.5H14.5V14.75C14.5 13.5074 15.5074 12.5 16.75 12.5H17.5V9.5H16.75C15.5074 9.5 14.5 8.49264 14.5 7.25V6.5H6.5V7.25C6.5 8.49264 5.49264 9.5 4.25 9.5H3.5V12.5ZM17.5 8V7.25C17.5 6.83579 17.1642 6.5 16.75 6.5H16V7.25C16 7.66421 16.3358 8 16.75 8H17.5ZM17.5 14H16.75C16.3358 14 16 14.3358 16 14.75V15.5H16.75C17.1642 15.5 17.5 15.1642 17.5 14.75V14ZM3.5 14.75C3.5 15.1642 3.83579 15.5 4.25 15.5H5V14.75C5 14.3358 4.66421 14 4.25 14H3.5V14.75Z" fill="currentColor"/>
                        <path d="M4.40137 18.5C4.92008 19.3967 5.8896 20 7.00002 20H17.25C19.8734 20 22 17.8734 22 15.25V10C22 8.8896 21.3967 7.92008 20.5 7.40137V15.25C20.5 17.0449 19.0449 18.5 17.25 18.5H4.40137Z" fill="currentColor"/>
                    </g>
                </svg>
            </div>
        </div>
    </div>

    <!-- Search and Controls -->
    <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 mx-1 sm:mx-0">
        <div class="flex flex-col gap-3 lg:flex-row lg:gap-4 lg:items-center lg:justify-between">
            <!-- Search Input -->
            <div class="w-full lg:flex-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" wire:model.live="search" placeholder="Cari transaksi..."
                        class="w-full pl-10 pr-4 py-2.5 border focus:outline-none border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                </div>
            </div>

            <!-- Control Section -->
            <div class="flex flex-col gap-3 lg:flex-row lg:gap-3 lg:items-center">
                <!-- Filter Dropdowns -->
                <div class="grid grid-cols-2 gap-2 lg:flex lg:gap-2">
                    <select wire:model.live="filterType"
                        class="w-full px-3 py-2.5 focus:outline-none border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm lg:min-w-[130px]">
                        <option value="">Semua Jenis</option>
                        <option value="income">Pemasukan</option>
                        <option value="expense">Pengeluaran</option>
                    </select>

                    <select wire:model.live="filterPeriod"
                        class="w-full px-3 py-2.5 focus:outline-none border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm lg:min-w-[140px]">
                        <option value="all">Semua Periode</option>
                        <option value="today">Harian</option>
                        <option value="week">Mingguan</option>
                        <option value="month">Bulanan</option>
                        <option value="year">Tahunan</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-2 lg:flex lg:gap-2">
                    <!-- Export PDF Button -->
                    <button wire:click="exportReport"
                        class="w-full bg-red-600 text-white hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 inline-flex items-center justify-center transition-colors lg:whitespace-nowrap lg:w-auto">
                        <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-xs sm:text-sm">Export PDF</span>
                    </button>

                    <!-- Add Button -->
                    <button wire:click="openCreateModal"
                        class="w-full bg-gradient-to-r from-blue-600 to-red-600 text-white hover:from-blue-700 hover:to-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 inline-flex items-center justify-center transition-colors lg:whitespace-nowrap lg:w-auto">
                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-xs sm:text-sm">Tambah</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif



    <!-- Transactions Table -->
    <div
        class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 overflow-hidden mx-1 sm:mx-0 relative">

        <!-- Mobile Card Layout -->
        <div class="block sm:hidden">
            @forelse ($transactions as $transaction)
                <div class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors">
                    <!-- Card Body -->
                    <div class="px-4 py-4">
                        <!-- Header Row -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <span class="text-xs font-medium text-white bg-blue-500 rounded-full px-2.5 py-1">
                                    {{ $loop->iteration }}
                                </span>
                                <span class="text-sm font-medium text-gray-500">
                                    {{ \Carbon\Carbon::parse($transaction['transaction_date'])->locale('id')->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <span
                                class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                {{ $transaction['transaction_type'] === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $transaction['transaction_type'] === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                            </span>
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <div
                                class="text-2xl font-bold {{ $transaction['transaction_type'] === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction['transaction_type'] === 'income' ? '+' : '-' }}Rp
                                {{ number_format($transaction['amount'], 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="space-y-2">
                            <!-- Description -->
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Deskripsi:</span>
                                <div class="text-sm font-medium text-gray-900 break-words">
                                    {{ $transaction['description'] }}
                                </div>
                            </div>

                            <!-- Funding Source -->
                            <div class="flex justify-between items-center py-1">
                                <span class="text-sm text-gray-500 font-medium">Sumber Dana:</span>
                                <span class="text-sm font-medium text-gray-900 text-right break-words ml-2">
                                    {{ $transaction['funding_source'] ?? 'Sumber Dana Umum' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                        <div class="flex justify-end items-center space-x-2">
                            <!-- Edit Button -->
                            <button wire:click="openEditModal({{ $transaction['id'] }})" type="button"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-2 focus:ring-blue-300 transition-colors shadow-sm"
                                title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
                            <!-- Delete Button -->
                            <button onclick="confirmDeleteTransaction({{ $transaction['id'] }})" type="button"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 focus:ring-2 focus:ring-red-300 transition-colors shadow-sm"
                                title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <div class="text-base font-medium text-gray-600 mb-1">Belum ada transaksi keuangan</div>
                    <div class="text-sm text-gray-400">Data transaksi keuangan masih kosong</div>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[40px]">
                            No
                        </th>
                        <th scope="col"
                            class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[80px] sm:min-w-[100px]">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[70px] sm:min-w-[80px]">
                            Jenis
                        </th>
                        <th scope="col"
                            class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[120px] sm:min-w-[150px]">
                            Deskripsi
                        </th>
                        <th scope="col"
                            class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[100px] sm:min-w-[120px]">
                            Sumber Dana
                        </th>
                        <th scope="col"
                            class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[90px] sm:min-w-[120px]">
                            Jumlah
                        </th>
                        <th scope="col"
                            class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-center min-w-[70px] sm:min-w-[80px]">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs text-gray-700 text-center font-medium">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs text-gray-700 text-center">
                                <div class="whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($transaction['transaction_date'])->locale('id')->translatedFormat('d F Y') }}
                                </div>
                            </td>
                            <td class="px-2 sm:px-6 py-2 sm:py-4 text-center">
                                <span
                                    class="inline-flex px-1 sm:px-2 py-0.5 sm:py-1 text-xs font-semibold rounded-full whitespace-nowrap
                                            {{ $transaction['transaction_type'] === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <span
                                        class="sm:hidden">{{ $transaction['transaction_type'] === 'income' ? 'In' : 'Out' }}</span>
                                    <span
                                        class="hidden sm:inline">{{ $transaction['transaction_type'] === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</span>
                                </span>
                            </td>
                            <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs text-gray-700 text-center">
                                <div class="max-w-[120px] sm:max-w-none overflow-hidden">
                                    <div class="truncate" title="{{ $transaction['description'] }}">
                                        {{ $transaction['description'] }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 sm:px-6 py-2 sm:py-4 text-xs text-gray-700 text-center">
                                <div class="max-w-[100px] sm:max-w-none overflow-hidden">
                                    <div class="truncate"
                                        title="{{ $transaction['funding_source'] ?? 'Sumber Dana Umum' }}">
                                        {{ $transaction['funding_source'] ?? 'Umum' }}
                                    </div>
                                </div>
                            </td>
                            <td
                                class="px-2 sm:px-6 py-2 sm:py-4 text-xs text-gray-700 text-center font-medium {{ $transaction['transaction_type'] === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                <div class="whitespace-nowrap">
                                    <div class="sm:hidden">
                                        {{ $transaction['transaction_type'] === 'income' ? '+' : '-' }}{{ number_format($transaction['amount'] / 1000, 0) }}K
                                    </div>
                                    <div class="hidden sm:block">
                                        {{ $transaction['transaction_type'] === 'income' ? '+' : '-' }}Rp
                                        {{ number_format($transaction['amount'], 0, ',', '.') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 sm:px-6 py-2 sm:py-4 text-center">
                                <div class="flex justify-center gap-1">
                                    <!-- Edit Button -->
                                    <button wire:click="openEditModal({{ $transaction['id'] }})" type="button"
                                        class="text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center transition-colors"
                                        title="Edit">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <!-- Delete Button -->
                                    <button onclick="confirmDeleteTransaction({{ $transaction['id'] }})"
                                        type="button"
                                        class="text-red-600 bg-red-50 hover:bg-red-100 focus:ring-2 focus:outline-none focus:ring-red-300 font-medium rounded-lg w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center transition-colors"
                                        title="Hapus">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
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
                            <td colspan="7" class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-8 h-8 sm:h-12 sm:w-12 text-gray-400 mb-2 sm:mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <p class="text-xs sm:text-sm">Belum ada transaksi keuangan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-gray-50 border-t sm:px-6">
            <div wire:loading.delay class="flex justify-center py-4">
                <svg class="animate-spin h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
            <div wire:loading.remove>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>



    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Backdrop with blur transparent overlay -->
            <div class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-all duration-300"
                wire:click="closeModal">
            </div>

            <!-- Modal positioning container -->
            <div class="fixed inset-0 flex items-center justify-center p-2 sm:p-4">
                <!-- Modal content -->
                <div class="relative bg-white rounded-xl shadow-2xl transform transition-all duration-300 w-full max-w-xs sm:max-w-lg md:max-w-2xl max-h-[90vh] overflow-hidden"
                    onclick="event.stopPropagation()" style="margin: 0 auto;">
                    <form wire:submit="save">
                        <!-- Modal Header -->
                        <div class="bg-white border-b border-gray-200 px-3 sm:px-4 md:px-6 py-3 sm:py-4 rounded-t-xl">
                            <div class="flex items-center justify-between">
                                <h3
                                    class="text-sm sm:text-base md:text-lg leading-6 font-semibold text-gray-900 truncate pr-2">
                                    {{ $editingId ? 'Edit Transaksi Keuangan' : 'Tambah Transaksi Keuangan' }}
                                </h3>
                                <button type="button" wire:click="closeModal"
                                    class="text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-lg p-1 transition-colors">
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
                                    <!-- Transaction Type and Amount -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Jenis Transaksi
                                            </label>
                                            <select wire:model.live="type"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                                <option value="income">Pemasukan</option>
                                                <option value="expense">Pengeluaran</option>
                                            </select>
                                            @error('type')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Jumlah (Rp)
                                            </label>
                                            <input wire:model="amount" type="number" step="1000" min="0"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Masukkan jumlah">
                                            @error('amount')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Date and Funding Source -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Tanggal
                                            </label>
                                            <input wire:model="transaction_date" type="date"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                            @error('transaction_date')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="text-red-500">*</span> Sumber Dana
                                            </label>
                                            <input wire:model="funding_source" type="text"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                placeholder="Masukkan sumber dana">
                                            @error('funding_source')
                                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <span class="text-red-500">*</span> Deskripsi
                                        </label>
                                        <textarea wire:model="description" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                            placeholder="Deskripsi transaksi"></textarea>
                                        @error('description')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>
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
        </div>
    @endif

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Custom CSS for Horizontal Chart -->
    <style>
        .chart-container {
            position: relative;
            overflow: visible !important;
        }

        .group:hover .tooltip {
            opacity: 1 !important;
            transform: translateX(-50%) translateY(-5px) !important;
            z-index: 9999 !important;
        }

        .tooltip {
            pointer-events: none;
            z-index: 9999 !important;
        }

        .group:hover .chart-bar {
            transform: scaleX(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .chart-bar {
            transition: all 0.3s ease;
        }

        .value-label {
            font-size: 11px;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Simple Chart Animation Script -->
    <script>
        // Add smooth animations to chart bars when page loads or updates
        document.addEventListener('DOMContentLoaded', function() {
            animateChartBars();
        });

        // Re-animate when Livewire updates data changes
        document.addEventListener('livewire:updated', function() {
            setTimeout(animateChartBars, 100);
        });

        function animateChartBars() {
            const chartBars = document.querySelectorAll('.chart-bar');
            chartBars.forEach((bar, index) => {
                // Reset animation
                const currentWidth = bar.style.width;
                bar.style.width = '0%';
                bar.style.transition = 'none';

                // Trigger animation after brief delay
                setTimeout(() => {
                    bar.style.transition = 'width 0.8s ease-out';
                    bar.style.width = currentWidth;
                }, 100 + (index * 80));
            });
        }
    </script>

    <!-- SweetAlert Functions -->
    <script>
        function confirmDeleteTransaction(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Transaksi ini akan dihapus secara permanen!',
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

        // Listen for PDF download event
        window.addEventListener('download-pdf', event => {
            const {
                url,
                filename
            } = event.detail[0];
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    </script>
</div>
