<div class="p-4 sm:p-6 space-y-4 sm:space-y-6 max-w-7xl mx-auto">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-600 to-red-600 rounded-xl shadow-lg p-4 sm:p-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Selamat Datang di Dashboard HMIF UNMA</h1>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Total Members Card -->
        <div
            class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-r from-blue-100 to-red-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-xs sm:text-sm text-gray-600 font-medium">Total Anggota</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $memberCount - 1 }}</p>
                </div>
            </div>
            <div class="flex items-center text-xs sm:text-sm">
                <span class="text-blue-600 font-medium">Semua aktif</span>
                <span class="text-gray-500 ml-2">periode ini</span>
            </div>
        </div>

        <!-- Active Departments Card -->
        <div
            class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-r from-red-100 to-blue-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-xs sm:text-sm text-gray-600 font-medium">Departemen Aktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">5</p>
                </div>
            </div>
            <div class="flex items-center text-xs sm:text-sm">
                <span class="text-blue-600 font-medium">Semua aktif</span>
                <span class="text-gray-500 ml-2">periode ini</span>
            </div>
        </div>

        <!-- This Week Activities Card -->
        <div
            class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-gradient-to-r from-blue-100 to-red-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-xs sm:text-sm text-gray-600 font-medium">Kegiatan Minggu Ini</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $weeklySchedules->flatten()->count() }}
                    </p>
                </div>
            </div>
            <div class="flex items-center text-xs sm:text-sm">
                <span class="text-red-600 font-medium">{{ $weeklySchedules->count() }} kegiatan</span>
                <span class="text-gray-500 ml-2">terjadwal</span>
            </div>
        </div>
    </div>

    <!-- Weekly Schedule -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 flex items-center mb-2 sm:mb-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 mr-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="hidden sm:inline">Jadwal Kegiatan Minggu Ini</span>
                <span class="sm:hidden">Jadwal Minggu Ini</span>
            </h2>
            <div class="text-xs sm:text-sm text-gray-500">
                {{ now()->startOfWeek()->format('d M') }} - {{ now()->endOfWeek()->format('d M Y') }}
            </div>
        </div>

        @if ($weeklySchedules->isEmpty())
            <div class="text-center py-8 sm:py-12">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">Belum Ada Kegiatan</h3>
                <p class="text-sm sm:text-base text-gray-500 mb-4">Tidak ada kegiatan yang dijadwalkan untuk minggu ini
                </p>
                <button
                    class="bg-gradient-to-r from-blue-500 to-red-500 text-white px-4 sm:px-6 py-2 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium text-sm sm:text-base">
                    Tambah Kegiatan Baru
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-3 sm:gap-4">
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    @php
                        $daySchedules = $weeklySchedules->get($day, collect());
                        $dayNames = [
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu',
                            'Sunday' => 'Minggu',
                        ];
                    @endphp
                    <div
                        class="border border-gray-200 rounded-lg p-3 {{ $daySchedules->isEmpty() ? 'bg-gray-50' : 'bg-blue-50' }} min-h-[160px] flex flex-col">
                        <h3 class="font-semibold text-sm text-gray-900 mb-2 text-center">
                            {{ $dayNames[$day] }}
                        </h3>

                        @if ($daySchedules->isEmpty())
                            <div class="text-xs text-gray-400 text-center py-2 flex-1 flex items-center justify-center">
                                Tidak ada kegiatan
                            </div>
                        @else
                            <div class="space-y-2 flex-1">
                                @foreach ($daySchedules as $schedule)
                                    <div class="bg-white rounded-md p-2 shadow-sm border-l-4 border-blue-500">
                                        <h4 class="text-xs font-medium text-gray-900 mb-1 leading-tight">
                                            {{ $schedule->name }}</h4>
                                        <p class="text-xs text-gray-600 mb-1 leading-tight line-clamp-2">
                                            {{ $schedule->description }}</p>
                                        <div class="flex items-center text-xs text-blue-600">
                                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @if ($schedule->start_time)
                                                <span
                                                    class="truncate">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                    - selesai</span>
                                            @else
                                                <span class="truncate">Waktu TBD</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
