<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Welcome Header -->
    <div
        class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-sm sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-1 sm:mb-2 leading-tight">Selamat
                    Datang di Dashboard HMIF UNMA</h1>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6 mx-1 sm:mx-0">
        <!-- Total Members Card -->
        <div
            class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-2 sm:mb-4">
                <div class="bg-gradient-to-r from-blue-100 to-red-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-600 font-medium">Total Anggota</p>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">{{ $memberCount }}</p>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-blue-600 font-medium">Semua aktif</span>
                <span class="text-gray-500 ml-1 sm:ml-2">periode ini</span>
            </div>
        </div>

        <!-- Active Departments Card -->
        <div
            class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-2 sm:mb-4">
                <div class="bg-gradient-to-r from-red-100 to-blue-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-red-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-600 font-medium">Departemen Aktif</p>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">5</p>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-blue-600 font-medium">Semua aktif</span>
                <span class="text-gray-500 ml-1 sm:ml-2">periode ini</span>
            </div>
        </div>

        <!-- This Week Activities Card -->
        <div
            class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between mb-2 sm:mb-4">
                <div class="bg-gradient-to-r from-blue-100 to-red-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-600 font-medium">Kegiatan Minggu Ini</p>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">
                        {{ $weeklySchedules->flatten()->count() }}
                    </p>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-red-600 font-medium">{{ $weeklySchedules->count() }} kegiatan</span>
                <span class="text-gray-500 ml-1 sm:ml-2">terjadwal</span>
            </div>
        </div>
    </div>

    <!-- Weekly Schedule -->
    <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 mx-1 sm:mx-0">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 sm:mb-6">
            <h2 class="text-base sm:text-lg lg:text-xl font-bold text-gray-900 flex items-center mb-2 sm:mb-0">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-blue-600 mr-1 sm:mr-2" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="hidden sm:inline">Jadwal Kegiatan Minggu Ini</span>
                <span class="sm:hidden text-sm">Jadwal Minggu Ini</span>
            </h2>
            <div class="text-xs text-gray-500">
                @php
                    $monthNames = [
                        'Jan' => 'Jan',
                        'Feb' => 'Feb',
                        'Mar' => 'Mar',
                        'Apr' => 'Apr',
                        'May' => 'Mei',
                        'Jun' => 'Jun',
                        'Jul' => 'Jul',
                        'Aug' => 'Ags',
                        'Sep' => 'Sep',
                        'Oct' => 'Okt',
                        'Nov' => 'Nov',
                        'Dec' => 'Des',
                    ];
                    $startDate = now()->startOfWeek()->format('d M');
                    $endDate = now()->endOfWeek()->format('d M Y');

                    // Replace English month with Indonesian
                    foreach ($monthNames as $eng => $ind) {
                        $startDate = str_replace($eng, $ind, $startDate);
                        $endDate = str_replace($eng, $ind, $endDate);
                    }
                @endphp
                {{ $startDate }} - {{ $endDate }}
            </div>
        </div>

        @if ($weeklySchedules->isEmpty())
            <div class="text-center py-6 sm:py-8 lg:py-12">
                <svg class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 text-gray-300 mx-auto mb-3 sm:mb-4" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <h3 class="text-sm sm:text-base lg:text-lg font-medium text-gray-900 mb-1 sm:mb-2">Belum Ada Kegiatan
                </h3>
                <p class="text-xs sm:text-sm lg:text-base text-gray-500 mb-3 sm:mb-4">Tidak ada kegiatan yang
                    dijadwalkan untuk minggu ini
                </p>
            </div>
        @else
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-2 sm:gap-3 lg:gap-4">
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
                        class="border border-gray-200 rounded-lg p-2 sm:p-3 {{ $daySchedules->isEmpty() ? 'bg-gray-50' : 'bg-blue-50' }} min-h-[120px] sm:min-h-[160px] flex flex-col">
                        <h3 class="font-semibold text-xs sm:text-sm text-gray-900 mb-1 sm:mb-2 text-center">
                            {{ $dayNames[$day] }}
                        </h3>

                        @if ($daySchedules->isEmpty())
                            <div
                                class="text-xs text-gray-400 text-center py-1 sm:py-2 flex-1 flex items-center justify-center">
                                Tidak ada kegiatan
                            </div>
                        @else
                            <div class="space-y-1 sm:space-y-2 flex-1">
                                @foreach ($daySchedules as $schedule)
                                    <div class="bg-white rounded-md p-1.5 sm:p-2 shadow-sm border-l-4 border-blue-500">
                                        <h4 class="text-xs font-medium text-gray-900 mb-0.5 sm:mb-1 leading-tight">
                                            {{ Str::limit($schedule->name, 15) }}</h4>
                                        <p
                                            class="text-xs text-gray-600 mb-0.5 sm:mb-1 leading-tight line-clamp-1 sm:line-clamp-2">
                                            {{ Str::limit($schedule->description, 25) }}</p>
                                        <div class="flex items-center text-xs text-blue-600">
                                            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 mr-1 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @if ($schedule->start_time)
                                                <span
                                                    class="truncate text-xs">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</span>
                                            @else
                                                <span class="truncate text-xs">TBD</span>
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
