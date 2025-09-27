<div class="p-4 sm:p-6 space-y-4 sm:space-y-6 max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-red-600 rounded-xl shadow-lg p-4 sm:p-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center mb-2">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold">Laporan Absensi</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 0 1 3 0v4a1.5 1.5 0 0 1-3 0V4Zm0 10a1.5 1.5 0 0 1 3 0v.5a1.5 1.5 0 0 1-3 0V14Z" />
            </svg>
            <div>{{ session('message') }}</div>
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Kegiatan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" id="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Nama kegiatan atau lokasi...">
                </div>
            </div>

            <!-- Date Filter -->
            <div>
                <label for="dateFilter" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input wire:model.live="dateFilter" type="date" id="dateFilter"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>
    </div>

    <!-- Schedules Table -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">No</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Nama Kegiatan</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Waktu</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Lokasi</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Jumlah Hadir</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $index => $schedule)
                        @php
                            $attendanceStats = $schedule->attendances->groupBy('status');
                            $totalAttendees = $schedule->attendances->count();
                            $presentCount = $attendanceStats->get('Hadir', collect())->count();
                        @endphp
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-3 sm:px-6 py-3 sm:py-4 font-medium text-gray-900 text-xs sm:text-sm">
                                {{ ($schedules->currentPage() - 1) * $schedules->perPage() + $index + 1 }}
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                <div class="font-medium text-gray-900 text-xs sm:text-sm">{{ $schedule->name }}</div>
                                <div class="text-xs text-gray-600 mt-1">
                                    {{ $schedule->description ? Str::limit($schedule->description, 60) : 'Tidak ada deskripsi' }}
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                <div class="text-xs sm:text-sm">
                                    <div class="font-medium text-gray-900">
                                        {{ $schedule->date->locale('id')->translatedFormat('d F Y') }}
                                    </div>
                                    <div class="text-gray-600">
                                        {{ $schedule->start_time->format('H:i') }} WIB
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700">
                                {{ $schedule->location }}
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $presentCount }}/{{ $totalAttendees }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('schedules.attendance', $schedule->id) }}" wire:navigate
                                        class="text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 border border-blue-200 transition-colors flex items-center justify-center"
                                        title="Lihat Detail">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        <span class="hidden sm:inline">Lihat</span>
                                    </a>

                                    <!-- Export PDF Button -->
                                    <button wire:click="exportPDF({{ $schedule->id }})" type="button"
                                        class="text-red-600 bg-red-50 hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-2 border border-red-200 transition-colors flex items-center justify-center"
                                        title="Unduh PDF">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <span class="hidden sm:inline">PDF</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-500">
                                <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400 mb-2 sm:mb-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                <div class="text-xs sm:text-sm">Belum ada data absensi kegiatan</div>
                                @if ($search || $dateFilter)
                                    <div class="text-xs text-gray-400 mt-1">Coba ubah filter pencarian</div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($schedules->hasPages())
            <div class="px-3 sm:px-6 py-3 sm:py-4 bg-gray-50 border-t">
                {{ $schedules->links() }}
            </div>
        @endif
    </div>
</div>
