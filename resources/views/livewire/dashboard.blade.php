<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Welcome Greeting Card -->
    <div
        class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-6 lg:p-8 mx-1 sm:mx-0">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <!-- Greeting Text -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <div>
                        @php
                            $hour = now()->hour;
                            $greeting = '';
                            if ($hour >= 0 && $hour < 12) {
                                $greeting = 'Selamat Pagi';
                            } elseif ($hour >= 12 && $hour < 15) {
                                $greeting = 'Selamat Siang';
                            } elseif ($hour >= 15 && $hour < 18) {
                                $greeting = 'Selamat Sore';
                            } else {
                                $greeting = 'Selamat Malam';
                            }
                        @endphp
                        <p class="text-xs sm:text-sm text-white/80 font-medium mb-1">{{ $greeting }}</p>
                        <h1 class="text-xl sm:text-2xl lg:text-4xl font-bold text-white leading-tight">
                            @php
                                $fullName = Auth::user()->name;
                                $firstName = explode(' ', $fullName)[0];
                            @endphp
                            <span class="hidden sm:inline">Halo, {{ $fullName }}</span>
                            <span class="sm:hidden">Halo, {{ $firstName }}</span>
                        </h1>
                    </div>
                </div>
                <div>
                    <p class="text-sm sm:text-base lg:text-lg text-white/90 font-medium flex items-center gap-2">
                        <span>Semoga Harimu Menyenangkan</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Schedule -->
    <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-4 mx-1 sm:mx-0">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
            <h2 class="text-base sm:text-lg font-bold text-gray-900 flex items-center mb-4 sm:mb-0">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span>Jadwal Kegiatan</span>
            </h2>

            <div class="flex items-center justify-center space-x-2 bg-gray-50 rounded-lg p-1">
                <button wire:click="previousMonth"
                    class="p-1 hover:bg-gray-200 rounded-md transition-colors text-gray-600">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <div class="text-xs sm:text-sm font-semibold text-gray-900 min-w-[100px] text-center capitalize">
                    {{ $currentMonth }}
                </div>
                <button wire:click="nextMonth" class="p-1 hover:bg-gray-200 rounded-md transition-colors text-gray-600">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="mb-6">
            <!-- Days Header -->
            <div class="grid grid-cols-7 mb-2">
                @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dayHeader)
                    <div
                        class="text-center text-xs font-medium {{ $dayHeader === 'Min' ? 'text-red-400' : 'text-gray-400' }} py-1">
                        {{ $dayHeader }}</div>
                @endforeach
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-1">
                @foreach ($calendar as $week)
                    @foreach ($week as $day)
                        @php
                            $dateString = $day->format('Y-m-d');
                            $isToday = $dateString === now()->format('Y-m-d');
                            $isSelected = $dateString === $selectedDate;
                            $dayEvents = $monthEvents->get($dateString);
                            // Check contents of events
                            $hasSchedule = $dayEvents && $dayEvents->contains(fn($e) => !isset($e->is_holiday));
                            $hasHoliday =
                                $dayEvents && $dayEvents->contains(fn($e) => isset($e->is_holiday) && $e->is_holiday);

                            $isCurrentMonth = $day->month === \Carbon\Carbon::parse($selectedDate)->month;
                            $isSunday = $day->isSunday();
                        @endphp

                        <div class="py-1">
                            @if ($isCurrentMonth)
                                <button wire:click="selectDate('{{ $dateString }}')"
                                    class="w-8 h-8 sm:w-9 sm:h-9 mx-auto flex items-center justify-center rounded-full text-xs font-medium transition-all relative
                                    {{ $isSelected ? 'ring-2 ring-offset-1 ring-blue-600 z-10' : '' }}
                                    {{ $hasSchedule
                                        ? 'bg-blue-500 text-white shadow-sm hover:bg-blue-600'
                                        : ($isToday
                                            ? 'bg-gray-200 text-gray-900 font-bold hover:bg-gray-300'
                                            : ($isSunday || $hasHoliday
                                                ? 'text-red-500 hover:bg-red-50 font-semibold'
                                                : 'hover:bg-gray-100 text-gray-700')) }}
                                    ">
                                    <span>{{ $day->format('j') }}</span>
                                </button>
                            @else
                                <div class="w-8 h-8 sm:w-9 sm:h-9 mx-auto"></div>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Month Agenda List -->
        <div class="border-t border-gray-100 pt-5">
            <h3 class="text-sm sm:text-base font-bold text-gray-900 mb-3 flex items-center">
                <span>Agenda Bulan {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('F Y') }}</span>
                @php
                    $activityCount = $monthEvents
                        ->flatten()
                        ->filter(fn($e) => !isset($e->is_holiday) || !$e->is_holiday)
                        ->count();
                @endphp
                @if ($activityCount > 0)
                    <span
                        class="ml-2 bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded-full">{{ $activityCount }}
                        Kegiatan</span>
                @endif
            </h3>

            @if ($monthEvents->isEmpty())
                <div class="text-center py-6 sm:py-8 bg-gray-50 rounded-xl border border-gray-100 border-dashed">
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Tidak ada kegiatan bulan ini</p>
                </div>
            @else
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1 custom-scrollbar">
                    @foreach ($monthEvents as $date => $events)
                        @php
                            $isDateHoliday =
                                \Carbon\Carbon::parse($date)->isSunday() ||
                                $events->contains(fn($e) => isset($e->is_holiday) && $e->is_holiday);
                        @endphp
                        <div
                            class="relative pl-4 border-l-2 {{ $isDateHoliday ? 'border-red-200' : 'border-gray-200' }}">
                            <div
                                class="absolute -left-[5px] top-0 w-2.5 h-2.5 rounded-full border-2 border-white {{ $isDateHoliday ? 'bg-red-200' : 'bg-gray-200' }}">
                            </div>
                            <div class="mb-2">
                                <span
                                    class="text-xs font-semibold {{ $isDateHoliday ? 'text-red-500' : 'text-gray-500' }} block mb-1">
                                    {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F') }}
                                </span>
                                <div class="space-y-2">
                                    @foreach ($events as $event)
                                        @php
                                            $isHoliday = isset($event->is_holiday) && $event->is_holiday;
                                        @endphp
                                        <div
                                            class="rounded-lg p-2 transition-colors border {{ $isHoliday ? 'bg-red-50/50 hover:bg-red-50 border-red-100/50 hover:border-red-100' : 'bg-blue-50/50 hover:bg-blue-50 border-blue-100/50 hover:border-blue-100' }}">
                                            <div class="flex items-start gap-2">
                                                <div
                                                    class="min-w-[40px] text-xs font-bold {{ $isHoliday ? 'text-red-600' : 'text-blue-600' }} mt-0.5">
                                                    @if ($isHoliday)
                                                        LIBUR
                                                    @elseif($event->start_time)
                                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h4
                                                        class="text-xs sm:text-sm font-semibold {{ $isHoliday ? 'text-red-900' : 'text-gray-900' }} leading-tight mb-0.5">
                                                        {{ $event->name }}</h4>
                                                    <p
                                                        class="text-[11px] sm:text-xs text-gray-500 line-clamp-1 {{ $isHoliday ? 'text-red-500' : '' }}">
                                                        {{ $event->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
