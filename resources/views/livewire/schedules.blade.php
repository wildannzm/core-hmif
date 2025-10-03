<div class="sm:p-6 space-y-4 sm:space-y-6 w-full mx-auto">
    <!-- Header Section -->
    <div
        class="bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center">
            <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-1 sm:mb-2">Jadwal Kegiatan</h1>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="flex items-center p-3 sm:p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 mx-1 sm:mx-0"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-2 sm:me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 0 1 3 0v4a1.5 1.5 0 0 1-3 0V4Zm0 10a1.5 1.5 0 0 1 3 0v.5a1.5 1.5 0 0 1-3 0V14Z" />
            </svg>
            <div class="text-xs sm:text-sm">{{ session('message') }}</div>
        </div>
    @endif

    <!-- Search, Filter, and Add Controls -->
    <div class="bg-white rounded-lg sm:rounded-xl shadow-lg border border-gray-100 p-3 sm:p-6 mx-1 sm:mx-0">
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" wire:model.live="search" placeholder="Cari kegiatan..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                </div>
            </div>

            <!-- Filter and Add Button Container -->
            <div class="flex gap-2">
                <!-- Filter Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button"
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium rounded-lg transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-300 inline-flex items-center justify-between min-w-[120px]">
                        <span>
                            @if ($filter === 'all')
                                Semua
                            @elseif($filter === 'week')
                                Minggu Ini
                            @elseif($filter === 'month')
                                Bulan Ini
                            @endif
                        </span>
                        <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-1 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <button wire:click="setFilter('all')" @click="open = false" type="button"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $filter === 'all' ? 'bg-blue-50 text-blue-700' : '' }}">
                            Semua
                        </button>
                        <button wire:click="setFilter('week')" @click="open = false" type="button"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $filter === 'week' ? 'bg-blue-50 text-blue-700' : '' }}">
                            Minggu Ini
                        </button>
                        <button wire:click="setFilter('month')" @click="open = false" type="button"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $filter === 'month' ? 'bg-blue-50 text-blue-700' : '' }}">
                            Bulan Ini
                        </button>
                    </div>
                </div>

                <!-- Add Button -->
                <button wire:click="openCreateModal" type="button"
                    class="bg-gradient-to-r from-blue-600 to-red-600 text-white hover:from-blue-700 hover:to-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 sm:px-4 py-2 text-center inline-flex items-center transition-colors whitespace-nowrap">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="hidden sm:inline">Tambah Kegiatan</span>
                    <span class="sm:hidden">Tambah</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Schedule Cards Grid -->
    @if ($schedules->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mx-1 sm:mx-0">
            @foreach ($schedules as $schedule)
                <div class="bg-white border border-gray-200 rounded-lg shadow-lg">
                    <!-- Card Header with gradient -->
                    <div class="bg-gradient-to-r from-red-500 to-blue-600 p-3 sm:p-4 rounded-t-lg relative">
                        <!-- Actions Dropdown -->
                        <div class="absolute top-3 right-3" x-data="{ open: false }">
                            <button @click="open = !open" type="button"
                                class="text-white/80 hover:text-white p-1 rounded-md hover:bg-white/10 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-1 w-32 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                <button wire:click="openEditModal({{ $schedule->id }})" @click="open = false"
                                    type="button"
                                    class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center rounded-t-lg">
                                    <svg class="w-3 h-3 me-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                    Edit
                                </button>
                                <button onclick="confirmDeleteSchedule({{ $schedule->id }})" @click="open = false"
                                    type="button"
                                    class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center rounded-b-lg">
                                    <svg class="w-3 h-3 me-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </div>

                        <h3 class="text-base sm:text-lg lg:text-xl font-semibold text-white mb-2 pr-8">
                            {{ $schedule->name }}</h3>
                        <div class="flex items-center text-white text-xs sm:text-sm opacity-90">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $schedule->date->locale('id')->translatedFormat('d F Y') }}
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-3 sm:p-4">
                        <!-- Description -->
                        <p class="text-gray-700 text-xs sm:text-sm mb-3 sm:mb-4 leading-relaxed">
                            {{ $schedule->description }}</p>

                        <!-- Time Info -->
                        <div class="flex items-center mb-2 sm:mb-3 text-xs sm:text-sm text-gray-600">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 me-2 text-blue-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ $schedule->start_time->format('H:i') }}</span>
                            <span class="mx-1 sm:mx-2">s/d Selesai</span>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start mb-3 sm:mb-4 text-xs sm:text-sm text-gray-600">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 me-2 mt-0.5 text-red-500 flex-shrink-0"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="break-words">{{ $schedule->location }}</span>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="px-3 sm:px-4 pb-3 sm:pb-4">
                        <div class="flex flex-col sm:flex-row gap-2">
                            @if ($schedule->has_attendance)
                                <!-- View Attendance Button -->
                                <a href="{{ route('schedules.attendance', $schedule->id) }}" wire:navigate
                                    class="flex-1 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2.5 text-center inline-flex items-center justify-center">
                                    <svg class="w-3 h-3 me-1" fill="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="5" y="3" width="14" height="18" rx="1"
                                            style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;" />
                                        <path d="M9,6a1,1,0,0,0,1,1h4a1,1,0,0,0,1-1V3H9Zm0,8,2,2,4-4"
                                            style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;" />
                                    </svg>
                                    Lihat Absensi
                                </a>
                            @else
                                <!-- No Attendance Label -->
                                <div
                                    class="flex-1 text-gray-500 bg-gray-100 font-medium rounded-lg text-xs px-3 py-2.5 text-center inline-flex items-center justify-center">
                                    <svg class="w-3 h-3 me-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Tidak Ada Absensi
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg mx-1 sm:mx-0">
            <div class="text-center py-8 sm:py-12 px-4 sm:px-6">
                <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 512 512" xml:space="preserve" fill="currentColor">
                    <g>
                        <rect x="119.256" y="222.607" width="50.881" height="50.885"></rect>
                        <rect x="341.863" y="222.607" width="50.881" height="50.885"></rect>
                        <rect x="267.662" y="222.607" width="50.881" height="50.885"></rect>
                        <rect x="119.256" y="302.11" width="50.881" height="50.885"></rect>
                        <rect x="267.662" y="302.11" width="50.881" height="50.885"></rect>
                        <rect x="193.46" y="302.11" width="50.881" height="50.885"></rect>
                        <rect x="341.863" y="381.612" width="50.881" height="50.885"></rect>
                        <rect x="267.662" y="381.612" width="50.881" height="50.885"></rect>
                        <rect x="193.46" y="381.612" width="50.881" height="50.885"></rect>
                        <path
                            d="M439.277,55.046h-41.376v39.67c0,14.802-12.195,26.84-27.183,26.84h-54.025 c-14.988,0-27.182-12.038-27.182-26.84v-39.67h-67.094v39.297c0,15.008-12.329,27.213-27.484,27.213h-53.424 c-15.155,0-27.484-12.205-27.484-27.213V55.046H72.649c-26.906,0-48.796,21.692-48.796,48.354v360.246 c0,26.661,21.89,48.354,48.796,48.354h366.628c26.947,0,48.87-21.692,48.87-48.354V103.4 C488.147,76.739,466.224,55.046,439.277,55.046z M453.167,462.707c0,8.56-5.751,14.309-14.311,14.309H73.144 c-8.56,0-14.311-5.749-14.311-14.309V178.089h394.334V462.707z">
                        </path>
                        <path
                            d="M141.525,102.507h53.392c4.521,0,8.199-3.653,8.199-8.144v-73.87c0-11.3-9.27-20.493-20.666-20.493h-28.459 c-11.395,0-20.668,9.192-20.668,20.493v73.87C133.324,98.854,137.002,102.507,141.525,102.507z">
                        </path>
                        <path
                            d="M316.693,102.507h54.025c4.348,0,7.884-3.513,7.884-7.826V20.178C378.602,9.053,369.474,0,358.251,0H329.16 c-11.221,0-20.349,9.053-20.349,20.178v74.503C308.81,98.994,312.347,102.507,316.693,102.507z">
                        </path>
                    </g>
                </svg>
                <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Belum ada kegiatan</h3>
                <p class="mt-1 text-xs sm:text-sm text-gray-500">Mulai dengan membuat jadwal kegiatan baru.</p>
            </div>
        </div>
    @endif

    <!-- Create/Edit Modal -->
    @if ($showModal)
        <div
            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-2 sm:p-4">
            <div
                class="relative mx-auto border w-full max-w-sm sm:max-w-md lg:max-w-lg shadow-lg rounded-lg bg-white max-h-screen overflow-y-auto">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-3 sm:p-4 border-b rounded-t">
                    <h3 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900">
                        {{ $modalTitle }}
                    </h3>
                    <button wire:click="closeModal" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-7 h-7 sm:w-8 sm:h-8 ml-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form wire:submit.prevent="save" class="p-3 sm:p-4">
                    <div class="space-y-3 sm:space-y-4">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block mb-1 sm:mb-2 text-sm font-medium text-gray-900">Nama
                                Kegiatan</label>
                            <input wire:model="name" type="text" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 sm:p-2.5"
                                placeholder="Masukkan nama kegiatan">
                            @error('name')
                                <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div>
                            <label for="description"
                                class="block mb-1 sm:mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 sm:p-2.5"
                                placeholder="Masukkan deskripsi kegiatan"></textarea>
                            @error('description')
                                <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date and Time Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <label for="date"
                                    class="block mb-1 sm:mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                                <input wire:model="date" type="date" id="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 sm:p-2.5">
                                @error('date')
                                    <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="start_time"
                                    class="block mb-1 sm:mb-2 text-sm font-medium text-gray-900">Waktu
                                    Mulai (WIB)</label>
                                <input wire:model="start_time" type="time" id="start_time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 sm:p-2.5">
                                @error('start_time')
                                    <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Field -->
                        <div>
                            <label for="location"
                                class="block mb-1 sm:mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                            <input wire:model="location" type="text" id="location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 sm:p-2.5"
                                placeholder="Masukkan lokasi kegiatan">
                            @error('location')
                                <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Attendance Option -->
                        <div class="flex items-center">
                            <input wire:model="has_attendance" id="has_attendance" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="has_attendance" class="ml-2 text-sm font-medium text-gray-900">
                                Kegiatan ini memiliki absensi
                            </label>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end p-3 sm:p-4 border-t border-gray-200 rounded-b mt-4 sm:mt-6 gap-2 sm:gap-0">
                        <button wire:click="closeModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-4 sm:px-5 py-2 sm:py-2.5 hover:text-gray-900 focus:z-10 order-2 sm:order-1 sm:mr-2">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 sm:px-5 py-2 sm:py-2.5 text-center order-1 sm:order-2">
                            {{ $scheduleId ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert Functions -->
<script>
    function confirmDeleteSchedule(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Kegiatan ini akan dihapus secara permanen beserta data absensinya!',
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
