<div>
    @if ($show)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div
                class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white max-h-screen overflow-y-auto">
                <!-- Modal Header -->
                <div
                    class="flex items-center justify-between p-6 border-b rounded-t bg-gradient-to-r from-red-500 to-blue-600">
                    <div class="text-white">
                        <h3 class="text-xl font-semibold">
                            Absensi - {{ $schedule->name ?? '' }}
                        </h3>
                        <p class="text-sm opacity-90 mt-1">
                            {{ $schedule ? $schedule->date->format('d M Y') . ' • ' . $schedule->start_time->format('H:i') . ' • ' . $schedule->location : '' }}
                        </p>
                    </div>
                    <button wire:click="closeModal" type="button"
                        class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Flash Messages -->
                @if (session()->has('message'))
                    <div class="mx-6 mt-4 flex items-center p-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 0 1 3 0v4a1.5 1.5 0 0 1-3 0V4Zm0 10a1.5 1.5 0 0 1 3 0v.5a1.5 1.5 0 0 1-3 0V14Z" />
                        </svg>
                        <div>{{ session('message') }}</div>
                    </div>
                @endif

                <!-- Modal Body -->
                <div class="p-6">
                    <!-- Attendance Statistics -->
                    @if ($attendances->count() > 0)
                        @php
                            $stats = $attendances->groupBy('status');
                        @endphp
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-green-600">
                                    {{ $stats->get('Hadir', collect())->count() }}</div>
                                <div class="text-sm text-green-600">Hadir</div>
                            </div>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-yellow-600">
                                    {{ $stats->get('Sakit', collect())->count() }}</div>
                                <div class="text-sm text-yellow-600">Sakit</div>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-blue-600">
                                    {{ $stats->get('Izin', collect())->count() }}</div>
                                <div class="text-sm text-blue-600">Izin</div>
                            </div>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-red-600">
                                    {{ $stats->get('Alfa', collect())->count() }}</div>
                                <div class="text-sm text-red-600">Alfa</div>
                            </div>
                        </div>
                    @endif

                    <!-- Attendance Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border border-gray-200 rounded-lg">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">No</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Nama</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Jabatan</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Waktu Tiba</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Status Kehadiran</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Keterangan</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $index => $attendance)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-r from-red-500 to-blue-600 rounded-full flex items-center justify-center text-white font-medium text-xs mr-3">
                                                    {{ \Illuminate\Support\Str::of($attendance['user']['name'])->explode(' ')->take(2)->map(fn($word) => \Illuminate\Support\Str::substr($word, 0, 1))->implode('') }}
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">
                                                        {{ $attendance['user']['name'] }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $attendance['user']['nim'] ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border">
                                                {{ $attendance['user']['position']['name'] ?? 'Anggota' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($editingAttendance === $attendance['id'])
                                                <!-- Edit Mode -->
                                                <input wire:model="editTapTime" type="time"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                                    {{ $editStatus !== 'Hadir' ? 'disabled' : '' }}>
                                            @else
                                                <!-- View Mode -->
                                                @if ($attendance['tap_time'])
                                                    <div class="font-medium text-gray-900">
                                                        {{ \Carbon\Carbon::parse($attendance['tap_time'])->format('H:i') }}
                                                    </div>
                                                    @if ($attendance['lateness_duration_minutes'] > 0)
                                                        <div class="text-xs text-red-600">
                                                            Terlambat {{ $attendance['lateness_duration_minutes'] }}
                                                            menit
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($editingAttendance === $attendance['id'])
                                                <!-- Edit Mode -->
                                                <select wire:model="editStatus"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                                    <option value="Hadir">Hadir</option>
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Alfa">Alfa</option>
                                                </select>
                                            @else
                                                <!-- View Mode -->
                                                <span
                                                    class="px-2.5 py-0.5 text-xs font-medium rounded-full border {{ $this->getStatusColorClass($attendance['status']) }}">
                                                    {{ $attendance['status'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($editingAttendance === $attendance['id'])
                                                <!-- Edit Mode -->
                                                <textarea wire:model="editNotes" rows="2"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                                    placeholder="Masukkan keterangan..."></textarea>
                                            @else
                                                <!-- View Mode -->
                                                @if ($attendance['notes'])
                                                    <div
                                                        class="{{ $this->getNotesColorClass($attendance['notes'], $attendance['lateness_duration_minutes']) }}">
                                                        {{ $attendance['notes'] }}
                                                    </div>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($editingAttendance === $attendance['id'])
                                                <!-- Save/Cancel Buttons -->
                                                <div class="flex gap-1">
                                                    <button wire:click="saveEdit" type="button"
                                                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                    <button wire:click="cancelEdit" type="button"
                                                        class="text-gray-600 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-3 py-1.5">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @else
                                                <!-- Edit Button -->
                                                <button wire:click="startEdit({{ $attendance['id'] }})"
                                                    type="button"
                                                    class="text-blue-600 bg-blue-50 hover:bg-blue-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 border border-blue-200">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                            </svg>
                                            Belum ada data absensi untuk kegiatan ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-6 border-t border-gray-200 rounded-b">
                    <button wire:click="closeModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
