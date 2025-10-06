<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white">
        <div class="flex items-start justify-between">
            <div class="flex-1 min-w-0">
                <div class="flex items-center mb-2">
                    <a href="{{ route('schedules') }}" wire:navigate
                        class="mr-2 sm:mr-3 hover:bg-white/20 rounded-lg p-1 transition-colors flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold truncate">Absensi -
                        {{ $schedule->name }}</h1>
                </div>
                <div class="text-white/90 text-xs sm:text-sm lg:text-base space-y-1 sm:space-y-0">
                    <div class="block sm:inline">
                        {{ $schedule->date->locale('id')->translatedFormat('d F Y') }}
                    </div>
                    <span class="hidden sm:inline"> • </span>
                    <div class="block sm:inline">
                        {{ $schedule->start_time->format('H:i') }} WIB
                    </div>
                    <span class="hidden sm:inline"> • </span>
                    <div class="block sm:inline">
                        {{ $schedule->location }}
                    </div>
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

    <!-- Attendance Statistics -->
    @if ($attendances->count() > 0)
        @php
            $stats = $attendances->groupBy('status');
        @endphp
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-4">
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-2 sm:p-4 text-center">
                <div class="text-lg sm:text-2xl font-bold text-green-600">{{ $stats->get('Hadir', collect())->count() }}
                </div>
                <div class="text-xs sm:text-sm text-green-600">Hadir</div>
            </div>
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-2 sm:p-4 text-center">
                <div class="text-lg sm:text-2xl font-bold text-yellow-600">
                    {{ $stats->get('Sakit', collect())->count() }}</div>
                <div class="text-xs sm:text-sm text-yellow-600">Sakit</div>
            </div>
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-2 sm:p-4 text-center">
                <div class="text-lg sm:text-2xl font-bold text-blue-600">{{ $stats->get('Izin', collect())->count() }}
                </div>
                <div class="text-xs sm:text-sm text-blue-600">Izin</div>
            </div>
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-2 sm:p-4 text-center">
                <div class="text-lg sm:text-2xl font-bold text-red-600">{{ $stats->get('Alfa', collect())->count() }}
                </div>
                <div class="text-xs sm:text-sm text-red-600">Tidak Hadir</div>
            </div>
        </div>
    @endif

    <!-- Attendance Table -->
    <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Mobile Card Layout -->
        <div class="block sm:hidden">
            @forelse($attendances as $index => $attendance)
                <div class="border-b border-gray-200 last:border-b-0 px-2 py-3 hover:bg-gray-50 transition-colors">
                    <!-- Header Row -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2 flex-1 min-w-0">
                            <span
                                class="text-xs font-medium text-white bg-blue-500 rounded-full px-2 py-1 flex-shrink-0">
                                {{ $index + 1 }}
                            </span>
                        </div>
                        <div class="flex space-x-1 flex-shrink-0">
                            @if (auth()->user()->hasSecretaryAccess())
                                @if ($editingAttendance === $attendance->id)
                                    <!-- Save/Cancel Buttons -->
                                    <button wire:click="saveEdit" type="button"
                                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-2 focus:ring-green-300 font-medium rounded-lg w-9 h-9 flex items-center justify-center transition-colors shadow-sm"
                                        title="Simpan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                    <button wire:click="cancelEdit" type="button"
                                        class="text-gray-600 bg-gray-100 hover:bg-gray-200 focus:ring-2 focus:ring-gray-300 font-medium rounded-lg w-9 h-9 flex items-center justify-center transition-colors shadow-sm"
                                        title="Batal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                @else
                                    <!-- Edit Button -->
                                    <button wire:click="startEdit({{ $attendance->id }})" type="button"
                                        class="text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg w-9 h-9 flex items-center justify-center transition-colors shadow-sm"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="font-semibold text-gray-900 text-base mb-2 break-words">{{ $attendance->user->name }}
                    </div>

                    <!-- Details Grid -->
                    <div class="space-y-2">
                        <!-- Position -->
                        <div class="flex justify-between items-start">
                            <span class="text-gray-600 text-xs">Jabatan:</span>
                            <span
                                class="font-medium text-gray-900 text-xs text-right flex-1 ml-2 break-words">{{ $this->getPositionText($attendance->user) }}</span>
                        </div>

                        <!-- Time -->
                        <div class="flex justify-between items-start">
                            <span class="text-gray-600 text-xs">Waktu Tiba:</span>
                            <div class="flex-1 ml-2 max-w-[120px]">
                                @if ($editingAttendance === $attendance->id)
                                    <input wire:model.live="editTapTime" type="time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 disabled:bg-gray-200 disabled:text-gray-500 disabled:cursor-not-allowed transition-colors"
                                        @if ($editStatus !== 'Hadir') disabled @endif>
                                @else
                                    <span class="text-gray-900 text-right block text-xs font-medium">
                                        @if ($attendance->tap_time)
                                            {{ \Carbon\Carbon::parse($attendance->tap_time)->format('H:i') }} WIB
                                        @else
                                            <span class="text-gray-400">Belum absen</span>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-xs">Status:</span>
                            <div class="flex-1 ml-2 max-w-[120px]">
                                @if ($editingAttendance === $attendance->id)
                                    <select wire:model.live="editStatus"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alfa">Alfa</option>
                                    </select>
                                @else
                                    <div class="text-right">
                                        <span
                                            class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full border {{ $this->getStatusColorClass($attendance->status) }}">
                                            {{ $attendance->status }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Notes -->
                        @if ($editingAttendance === $attendance->id || $attendance->notes)
                            <div class="flex flex-col space-y-1">
                                <span class="text-gray-600 text-xs">Keterangan:</span>
                                @if ($editingAttendance === $attendance->id)
                                    <textarea wire:model="editNotes" rows="2"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
                                        placeholder="Masukkan keterangan..."></textarea>
                                @else
                                    <div
                                        class="text-xs {{ $this->getNotesColorClass($attendance->notes, $attendance->lateness_duration_minutes) }} bg-gray-50 rounded p-2 break-words">
                                        {{ $attendance->notes ?: '-' }}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <div class="text-base font-medium text-gray-600 mb-1">Belum ada data absensi</div>
                    <div class="text-sm text-gray-400">Data absensi untuk kegiatan ini masih kosong</div>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table Layout -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">No</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Nama</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Jabatan</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Waktu Tiba</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Status</th>
                        <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold hidden lg:table-cell">
                            Keterangan</th>
                        @if (auth()->user()->hasSecretaryAccess())
                            <th scope="col" class="px-3 sm:px-6 py-3 sm:py-4 font-semibold">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $index => $attendance)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-3 sm:px-6 py-3 sm:py-4 font-medium text-gray-900 text-xs sm:text-sm">
                                {{ $index + 1 }}</td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                <div class="font-medium text-gray-900 text-xs sm:text-sm">
                                    {{ $attendance->user->name }}</div>
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-700 font-medium">
                                {{ $this->getPositionText($attendance->user) }}
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                @if ($editingAttendance === $attendance->id)
                                    <!-- Edit Mode -->
                                    <input wire:model.live="editTapTime" type="time"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 sm:p-2 disabled:bg-gray-200 disabled:text-gray-500 disabled:cursor-not-allowed transition-colors"
                                        @if ($editStatus !== 'Hadir') disabled @endif>
                                @else
                                    <!-- View Mode -->
                                    @if ($attendance->tap_time)
                                        <div class="font-medium text-gray-900 text-xs sm:text-sm">
                                            {{ \Carbon\Carbon::parse($attendance->tap_time)->format('H:i') }}
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs sm:text-sm">-</span>
                                    @endif
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4">
                                @if ($editingAttendance === $attendance->id)
                                    <!-- Edit Mode -->
                                    <select wire:model.live="editStatus"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 sm:p-2">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alfa">Alfa</option>
                                    </select>
                                @else
                                    <!-- View Mode -->
                                    <span
                                        class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full border {{ $this->getStatusColorClass($attendance->status) }}">
                                        {{ $attendance->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 hidden lg:table-cell">
                                @if ($editingAttendance === $attendance->id)
                                    <!-- Edit Mode -->
                                    <textarea wire:model="editNotes" rows="2"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 sm:p-2"
                                        placeholder="Masukkan keterangan..."></textarea>
                                @else
                                    <!-- View Mode -->
                                    @if ($attendance->notes)
                                        <div
                                            class="text-xs sm:text-sm {{ $attendance->lateness_duration_minutes > 0 ? 'mt-1' : '' }} {{ $this->getNotesColorClass($attendance->notes, $attendance->lateness_duration_minutes) }}">
                                            {{ $attendance->notes }}
                                        </div>
                                    @elseif ($attendance->lateness_duration_minutes <= 0)
                                        <span class="text-gray-400 text-xs sm:text-sm">-</span>
                                    @endif
                                @endif
                            </td>
                            @if (auth()->user()->hasSecretaryAccess())
                                <td class="px-3 sm:px-6 py-3 sm:py-4">
                                    @if ($editingAttendance === $attendance->id)
                                        <!-- Save/Cancel Buttons -->
                                        <div class="flex gap-1">
                                            <button wire:click="saveEdit" type="button"
                                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg w-8 h-8 flex items-center justify-center transition-colors"
                                                title="Simpan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                            <button wire:click="cancelEdit" type="button"
                                                class="text-gray-600 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg w-8 h-8 flex items-center justify-center transition-colors"
                                                title="Batal">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @else
                                        <!-- Edit Button -->
                                        <button wire:click="startEdit({{ $attendance->id }})" type="button"
                                            class="text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-8 h-8 flex items-center justify-center transition-colors"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->hasSecretaryAccess() ? '7' : '6' }}"
                                class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-500">
                                <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400 mb-2 sm:mb-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                <div class="text-xs sm:text-sm">Belum ada data absensi untuk kegiatan ini</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
