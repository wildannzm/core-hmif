<div class="sm:p-6 lg:p-8 w-full mx-auto">
    <!-- Header Section -->
    <div
        class="mb-6 sm:mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-1 sm:mb-2 leading-tight">Content
                    Plan</h1>
            </div>
        </div>
    </div>

    <!-- Search and Controls -->
    <div class="mb-6 sm:mb-8 bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 mx-1 sm:mx-0">
        <div class="flex flex-col gap-3 lg:flex-row lg:gap-4 lg:items-center lg:justify-between">
            <!-- Search Input -->
            <div class="w-full lg:flex-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" wire:model.live="search" placeholder="Cari content plan..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                </div>
            </div>

            <!-- Control Section -->
            <div class="flex flex-col gap-3 lg:flex-row lg:gap-3 lg:items-center">
                <!-- Filter Dropdowns -->
                <div class="grid grid-cols-2 gap-2 lg:flex lg:gap-2">
                    <select wire:model.live="filterMonth"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm lg:min-w-[130px]">
                        <option value="">Pilih Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>

                    <select wire:model.live="filterYear"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm lg:min-w-[100px]">
                        <option value="">Pilih Tahun</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 gap-2 lg:flex lg:gap-2">
                    <button wire:click="create"
                        class="w-full bg-gradient-to-r from-blue-600 to-red-600 text-white hover:from-blue-700 hover:to-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 inline-flex items-center justify-center transition-colors lg:whitespace-nowrap lg:w-auto">
                        <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Content Plan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div
        class="mb-6 sm:mb-8 bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 overflow-hidden mx-1 sm:mx-0">
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Publish
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul/Topik
                        </th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Konten Pilar</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipe Konten</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Goals</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Eksekutor</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Hasil</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Publisher</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($contentPlans as $plan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- No -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $loop->index + 1 + ($contentPlans->currentPage() - 1) * $contentPlans->perPage() }}
                            </td>
                            <!-- Tanggal -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $plan->formatted_publish_date }}
                            </td>
                            <!-- Judul/Topik -->
                            <td class="px-3 py-4 text-center">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($plan->title, 30) }}</div>
                            </td>
                            <!-- Konten Pilar -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ Str::limit($plan->pillar, 20) }}
                            </td>
                            <!-- Tipe Konten -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $plan->content_type }}</td>
                            <!-- Goals -->
                            <td class="px-3 py-4 text-center">
                                <div class="text-sm text-gray-900">
                                    {{ $plan->goals ? Str::limit($plan->goals, 25) : '-' }}
                                </div>
                            </td>
                            <!-- Eksekutor -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $plan->executor?->name ?? '-' }}
                            </td>
                            <!-- Hasil -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                @if ($plan->result_url)
                                    <a href="{{ $plan->result_url }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 underline">
                                        Lihat Hasil
                                    </a>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <!-- Publisher -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                {{ $plan->publisher?->name ?? '-' }}
                            </td>
                            <!-- Status -->
                            <td class="px-3 py-4 whitespace-nowrap text-center">
                                @if ($plan->status)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if ($plan->status === 'Progress') bg-blue-100 text-blue-800
                                    @elseif($plan->status === 'Approved') bg-green-100 text-green-800
                                    @elseif($plan->status === 'Revision') bg-yellow-100 text-yellow-800
                                    @elseif($plan->status === 'Declined') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        {{ $plan->status }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">-</span>
                                @endif
                            </td>
                            <!-- Aksi -->
                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <div class="flex justify-center space-x-1">
                                    <button wire:click="showDetail({{ $plan->id }})"
                                        class="text-green-600 hover:text-green-900 transition-colors"
                                        title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button wire:click="edit({{ $plan->id }})"
                                        class="text-blue-600 hover:text-blue-900 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{ $plan->id }})"
                                        class="text-red-600 hover:text-red-900 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-gray-500 font-medium">Tidak ada content plan yang ditemukan</p>
                                    <p class="text-gray-400 text-sm">Buat content plan pertama Anda dengan mengklik
                                        tombol "Tambah Content Plan"</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="md:hidden space-y-3 p-3">
            @forelse($contentPlans as $index => $plan)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-100">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-2">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                                        #{{ $contentPlans->firstItem() + $index }}
                                    </span>
                                    @if ($plan->status)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if ($plan->status === 'Progress') bg-blue-100 text-blue-800
                                        @elseif($plan->status === 'Approved') bg-green-100 text-green-800
                                        @elseif($plan->status === 'Revision') bg-yellow-100 text-yellow-800
                                        @elseif($plan->status === 'Declined') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                            {{ $plan->status }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-900 text-sm leading-tight line-clamp-2">
                                    {{ $plan->title }}</h3>
                                <p class="text-xs text-gray-600 mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $plan->formatted_publish_date }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Content Info -->
                    <div class="p-4 space-y-3">
                        <!-- Konten Details -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-purple-600 uppercase tracking-wide">Pilar</div>
                                <div class="text-sm font-semibold text-purple-900 mt-1 truncate">{{ $plan->pillar }}
                                </div>
                            </div>
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-orange-600 uppercase tracking-wide">Tipe</div>
                                <div class="text-sm font-semibold text-orange-900 mt-1 truncate">
                                    {{ $plan->content_type }}</div>
                            </div>
                        </div>

                        <!-- Goals -->
                        @if ($plan->goals)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-yellow-600 uppercase tracking-wide">Goals</div>
                                <div class="text-sm font-semibold text-yellow-900 mt-1">{{ $plan->goals }}</div>
                            </div>
                        @endif

                        <!-- Tim -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-indigo-600 uppercase tracking-wide">Eksekutor
                                </div>
                                <div class="text-sm font-semibold text-indigo-900 mt-1 truncate">
                                    {{ $plan->executor?->name ?? '-' }}</div>
                            </div>
                            <div class="bg-pink-50 border border-pink-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-pink-600 uppercase tracking-wide">Publisher</div>
                                <div class="text-sm font-semibold text-pink-900 mt-1 truncate">
                                    {{ $plan->publisher?->name ?? '-' }}</div>
                            </div>
                        </div>

                        <!-- Result URL -->
                        @if ($plan->result_url)
                            <div class="bg-teal-50 border border-teal-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-teal-600 uppercase tracking-wide">Hasil Konten
                                </div>
                                <a href="{{ $plan->result_url }}" target="_blank"
                                    class="inline-flex items-center text-sm font-semibold text-teal-700 hover:text-teal-900 mt-1">
                                    <span>Lihat Hasil</span>
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        @endif

                        <!-- Caption Preview -->
                        @if ($plan->caption)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2">
                                <div class="text-xs font-medium text-blue-600 uppercase tracking-wide">Caption</div>
                                <div class="text-sm text-blue-900 mt-1 line-clamp-2">
                                    {{ Str::limit($plan->caption, 100) }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-gray-50 px-4 py-3 border-t border-gray-100">
                        <div class="flex justify-end items-center space-x-3">
                            <button wire:click="showDetail({{ $plan->id }})"
                                class="flex items-center justify-center w-9 h-9 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition-colors"
                                title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <button wire:click="edit({{ $plan->id }})"
                                class="flex items-center justify-center w-9 h-9 bg-green-100 text-green-700 rounded-full hover:bg-green-200 transition-colors"
                                title="Edit Content Plan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="confirmDelete({{ $plan->id }})"
                                class="flex items-center justify-center w-9 h-9 bg-red-100 text-red-700 rounded-full hover:bg-red-200 transition-colors"
                                title="Hapus Content Plan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 font-medium">Tidak ada content plan yang ditemukan</p>
                    <p class="text-gray-400 text-sm mt-1">Buat content plan pertama Anda</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($contentPlans->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $contentPlans->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Form -->
    @if ($showModal)
        <div class="fixed inset-0 bg-black/20 backdrop-blur-sm overflow-y-auto h-full w-full z-50"
            wire:click="closeModal">
            <div class="relative top-20 mx-auto border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white"
                wire:click.stop>
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t-lg">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $editingId ? 'Edit Content Plan' : 'Tambah Content Plan' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="p-5">

                    <form id="content-plan-form" wire:submit="save" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish <span
                                        class="text-red-500">*</span></label>
                                <input type="date" wire:model="publish_date"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('publish_date')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select wire:model="status"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Status</option>
                                    <option value="Progress">Progress</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Revision">Revision</option>
                                    <option value="Declined">Declined</option>
                                </select>
                                @error('status')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model="title"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan judul content plan">
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Konten Pilar <span
                                        class="text-red-500">*</span></label>
                                <select wire:model="pillar"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Konten Pilar</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Education">Education</option>
                                    <option value="News">News</option>
                                    <option value="Promotion">Promotion</option>
                                </select>
                                @error('pillar')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Konten <span
                                        class="text-red-500">*</span></label>
                                <select wire:model="content_type"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Tipe Konten</option>
                                    <option value="Post">Post</option>
                                    <option value="Story">Story</option>
                                    <option value="Reels">Reels</option>
                                    <option value="Video">Video</option>
                                </select>
                                @error('content_type')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Goals</label>
                            <select wire:model="goals"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Goals</option>
                                <option value="Education">Education</option>
                                <option value="Engagement">Engagement</option>
                                <option value="News">News</option>
                            </select>
                            @error('goals')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Executor</label>
                                <select wire:model="executor_id"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Executor</option>
                                    @foreach ($kominfoUsers as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('executor_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Publisher</label>
                                <select wire:model="publisher_id"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Publisher</option>
                                    @foreach ($kominfoUsers as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('publisher_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Referensi</label>
                            <textarea wire:model="reference" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan referensi atau inspirasi konten"></textarea>
                            @error('reference')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Result URL</label>
                            <input type="url" wire:model="result_url"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://...">
                            @error('result_url')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Caption</label>
                            <textarea wire:model="caption" rows="4"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan caption konten"></textarea>
                            @error('caption')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Revisi</label>
                            <textarea wire:model="revision_notes" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan catatan revisi jika diperlukan"></textarea>
                            @error('revision_notes')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <button type="submit" form="content-plan-form"
                        class="px-4 py-2 bg-gradient-to-r from-blue-600 to-red-600 text-white rounded-lg hover:from-blue-700 hover:to-red-700 focus:ring-2 focus:ring-blue-500">
                        {{ $editingId ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Detail Modal -->
    @if ($showDetailModal && $detailPlan)
        <div class="fixed inset-0 bg-black/20 backdrop-blur-sm overflow-y-auto h-full w-full z-50"
            wire:click="closeDetailModal">
            <div class="relative top-2 md:top-10 mx-2 md:mx-auto border w-auto md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-xl rounded-lg bg-white max-h-[96vh] md:max-h-[90vh]"
                wire:click.stop>
                <!-- Modal Header -->
                <div
                    class="flex items-center justify-between p-3 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-red-50 rounded-t-lg">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Detail Content Plan</h3>
                        <p class="text-sm text-gray-600 mt-0.5">{{ $detailPlan?->title ?? 'No Title' }}</p>
                    </div>
                    <button wire:click="closeDetailModal"
                        class="text-gray-400 hover:text-gray-600 p-1 hover:bg-gray-100 rounded">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="p-4 overflow-y-auto max-h-[calc(96vh-100px)] md:max-h-[calc(90vh-100px)] custom-scroll">
                    <div class="space-y-4">
                        <!-- Informasi Utama -->
                        <div class="bg-gray-50 rounded-lg p-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-0.5">Judul/Topik</label>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $detailPlan?->title ?? 'No Title' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-0.5">Tanggal
                                        Publish</label>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $detailPlan?->formatted_publish_date ?? 'No Date' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Info -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-1.5">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-purple-600 uppercase tracking-wide mb-0.5">Konten
                                    Pilar</label>
                                <p class="text-sm font-semibold text-purple-900">{{ $detailPlan?->pillar ?? '-' }}</p>
                            </div>
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-orange-600 uppercase tracking-wide mb-0.5">Tipe
                                    Konten</label>
                                <p class="text-sm font-semibold text-orange-900">
                                    {{ $detailPlan?->content_type ?? '-' }}</p>
                            </div>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-yellow-600 uppercase tracking-wide mb-0.5">Goals</label>
                                <p class="text-sm font-semibold text-yellow-900">{{ $detailPlan?->goals ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-gray-600 uppercase tracking-wide mb-0.5">Status</label>
                                @if ($detailPlan?->status)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if ($detailPlan?->status === 'Progress') bg-blue-100 text-blue-800
                                    @elseif($detailPlan?->status === 'Approved') bg-green-100 text-green-800
                                    @elseif($detailPlan?->status === 'Revision') bg-yellow-100 text-yellow-800
                                    @elseif($detailPlan?->status === 'Declined') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        {{ $detailPlan?->status ?? 'No Status' }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">-</span>
                                @endif
                            </div>
                        </div>

                        <!-- Tim & Hasil -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-1.5">
                            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-indigo-600 uppercase tracking-wide mb-0.5">Eksekutor</label>
                                <p class="text-sm font-semibold text-indigo-900">
                                    {{ $detailPlan->executor?->name ?? '-' }}</p>
                            </div>
                            <div class="bg-pink-50 border border-pink-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-pink-600 uppercase tracking-wide mb-0.5">Publisher</label>
                                <p class="text-sm font-semibold text-pink-900">
                                    {{ $detailPlan->publisher?->name ?? '-' }}</p>
                            </div>
                            <div class="bg-teal-50 border border-teal-200 rounded-lg p-2">
                                <label
                                    class="block text-xs font-medium text-teal-600 uppercase tracking-wide mb-0.5">Hasil</label>
                                @if ($detailPlan?->result_url)
                                    <a href="{{ $detailPlan?->result_url }}" target="_blank"
                                        class="text-teal-700 hover:text-teal-900 underline flex items-center space-x-1 text-sm font-semibold">
                                        <span>Lihat Hasil</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @else
                                    <p class="text-sm font-semibold text-teal-900">-</p>
                                @endif
                            </div>
                        </div>

                        <!-- Referensi -->
                        @if ($detailPlan?->reference)
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-2">
                                <div class="flex items-center mb-1.5">
                                    <svg class="w-3 h-3 mr-1 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    <span
                                        class="text-xs font-semibold text-gray-700 uppercase tracking-wide">Referensi</span>
                                </div>
                                <div class="bg-white rounded border p-3">
                                    <p class="text-sm text-gray-900 leading-tight">
                                        {{ $detailPlan?->reference }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Caption -->
                        @if ($detailPlan?->caption)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2">
                                <div class="flex items-center justify-between mb-1.5">
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        <span
                                            class="text-xs font-semibold text-blue-700 uppercase tracking-wide">Caption</span>
                                    </div>
                                    <button onclick="copyTextWithSweetAlert('caption-text')"
                                        class="text-blue-600 hover:text-blue-800 transition-colors p-0.5 rounded hover:bg-blue-100"
                                        title="Copy Caption">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="bg-white rounded border p-3">
                                    <p id="caption-text" class="text-sm text-gray-900 leading-tight">
                                        {{ $detailPlan?->caption }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Catatan Revisi -->
                        @if ($detailPlan?->revision_notes)
                            <div class="bg-red-50 border border-red-200 rounded-lg p-2">
                                <div class="flex items-center mb-1.5">
                                    <svg class="w-3 h-3 mr-1 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-xs font-semibold text-red-700 uppercase tracking-wide">Catatan
                                        Revisi</span>
                                </div>
                                <div class="bg-white rounded border p-3 border-red-200">
                                    <p class="text-sm text-gray-900 leading-tight">
                                        {{ $detailPlan?->revision_notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            {{ session('error') }}
        </div>
    @endif

    <!-- Custom Styles for Mobile -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .truncate-mobile {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        /* Custom scrollbar for mobile */
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>

    <!-- JavaScript for Clipboard -->
    <script>
        function copyTextWithSweetAlert(elementId) {
            const element = document.getElementById(elementId);
            const text = element.textContent || element.innerText;

            navigator.clipboard.writeText(text).then(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Teks berhasil disalin ke clipboard',
                    timer: 1500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true
                });
            }).catch(function(err) {
                console.error('Failed to copy text: ', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menyalin teks ke clipboard',
                    confirmButtonText: 'OK'
                });
            });
        }

        // SweetAlert confirmation for delete
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Content plan ini akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
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
    </script>
</div>
