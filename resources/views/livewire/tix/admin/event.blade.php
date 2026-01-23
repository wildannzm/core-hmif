<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Page Header -->
    <div
        class="mb-6 sm:mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div>
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">Kelola Event</h1>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="mx-1 sm:mx-0 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Search & Action Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 mx-1 sm:mx-0">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Search Bar -->
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors outline-none"
                    placeholder="Cari berdasarkan judul atau lokasi event...">
            </div>
            <!-- Add Button -->
            @if (auth()->user()->hasRole('bph') || (auth()->user()->position && auth()->user()->position->name === 'Koordinator'))
                <a href="{{ route('admin.events.create') }}" wire:navigate
                    class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-red-600 hover:from-blue-700 hover:to-red-700 text-white px-4 sm:px-6 py-2.5 rounded-lg transition-all duration-200 font-medium flex items-center justify-center gap-2 shadow-lg text-sm sm:text-base whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Event Baru
                </a>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mx-1 sm:mx-0">
        @if ($events->count() > 0)
            <!-- Desktop Table View (hidden on mobile/tablet) -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Banner
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Informasi Event
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kuota
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($events as $event)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex-shrink-0 w-28">
                                        @if ($event->banner)
                                            <img class="w-28 rounded-lg object-cover" style="aspect-ratio: 16/9;"
                                                src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}">
                                        @else
                                            <div class="w-28 rounded-lg bg-gray-200 flex items-center justify-center"
                                                style="aspect-ratio: 16/9;">
                                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                    <div class="text-sm text-gray-500 flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $event->location }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs text-gray-500 font-medium mb-1">📅 Waktu Pemesanan:</div>
                                    <div class="text-sm text-gray-900">{{ $event->start_date->format('d M Y, H:i') }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $event->end_date->format('d M Y, H:i') }}
                                    </div>

                                    <div class="text-xs text-gray-500 font-medium mt-2 mb-1">🎉 Waktu Event:</div>
                                    <div class="text-sm text-gray-900">
                                        {{ $event->event_start_date->format('d M Y, H:i') }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $event->event_end_date->format('d M Y, H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        <span class="text-blue-600">{{ $event->available_quota }}</span> /
                                        {{ $event->quota }}
                                    </div>
                                    <div class="text-xs text-gray-500">Tersedia / Total</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button wire:click="toggleStatus({{ $event->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors {{ $event->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                        @if ($event->is_active)
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Aktif
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Nonaktif
                                        @endif
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.events.show', $event->id) }}" wire:navigate
                                            class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        @if (auth()->user()->hasRole('bph') || (auth()->user()->position && auth()->user()->position->name === 'Koordinator'))
                                            <a href="{{ route('admin.events.edit', $event->id) }}" wire:navigate
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition-colors"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <button wire:click="confirmDelete({{ $event->id }})"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition-colors"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile/Tablet Card View (visible on mobile/tablet only) -->
            <div class="lg:hidden divide-y divide-gray-200">
                @foreach ($events as $event)
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <!-- Banner & Title -->
                        <div class="flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                @if ($event->banner)
                                    <img class="w-32 rounded-lg object-cover" style="aspect-ratio: 16/9;"
                                        src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}">
                                @else
                                    <div class="w-32 rounded-lg bg-gray-200 flex items-center justify-center"
                                        style="aspect-ratio: 16/9;">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1 line-clamp-2">{{ $event->title }}
                                </h3>
                                <div class="flex items-center text-xs text-gray-500 mb-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                                <button wire:click="toggleStatus({{ $event->id }})"
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium transition-colors {{ $event->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    @if ($event->is_active)
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Aktif
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Nonaktif
                                    @endif
                                </button>
                            </div>
                        </div>

                        <!-- Event Info Grid -->
                        <div class="space-y-3 mb-3 text-xs">
                            <!-- Booking Period -->
                            <div class="bg-blue-50 p-2 rounded-lg">
                                <span class="text-blue-700 font-medium block mb-1">📅 Waktu Pemesanan:</span>
                                <p class="text-gray-900 font-medium">{{ $event->start_date->format('d M Y, H:i') }}
                                </p>
                                <p class="text-gray-600">{{ $event->end_date->format('d M Y, H:i') }}</p>
                            </div>

                            <!-- Event Period -->
                            <div class="bg-green-50 p-2 rounded-lg">
                                <span class="text-green-700 font-medium block mb-1">🎉 Waktu Event:</span>
                                <p class="text-gray-900 font-medium">
                                    {{ $event->event_start_date->format('d M Y, H:i') }}</p>
                                <p class="text-gray-600">{{ $event->event_end_date->format('d M Y, H:i') }}</p>
                            </div>

                            <!-- Price & Quota -->
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-gray-500 block mb-1">Kuota:</span>
                                    <p class="text-gray-900 font-medium">
                                        <span class="text-blue-600">{{ $event->available_quota }}</span> /
                                        {{ $event->quota }}
                                    </p>
                                </div>
                                <div>
                                    <span class="text-gray-500 block mb-1">Harga:</span>
                                    <p class="text-gray-900 font-semibold">Rp
                                        {{ number_format($event->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.events.show', $event->id) }}" wire:navigate
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-50 text-green-700 hover:bg-green-100 rounded-lg transition-colors text-xs font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Detail
                            </a>
                            @if (auth()->user()->hasRole('bph') || (auth()->user()->position && auth()->user()->position->name === 'Koordinator'))
                                <a href="{{ route('admin.events.edit', $event->id) }}" wire:navigate
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition-colors text-xs font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>
                                <button wire:click="confirmDelete({{ $event->id }})"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg transition-colors text-xs font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $events->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada event</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat event baru untuk HMIF TIX.</p>
                @if (auth()->user()->hasRole('bph') || (auth()->user()->position && auth()->user()->position->name === 'Koordinator'))
                    <div class="mt-6">
                        <a href="{{ route('admin.events.create') }}" wire:navigate
                            class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-blue-600 to-red-600 hover:from-blue-700 hover:to-red-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Buat Event Baru
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

@script
    <script>
        // SweetAlert Success Handler
        $wire.on('swal:success', (event) => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: event.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        });

        // SweetAlert Error Handler
        $wire.on('swal:error', (event) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: event.message,
                confirmButtonColor: '#3b82f6',
            });
        });

        // SweetAlert Confirm Delete Handler
        $wire.on('swal:confirm', (event) => {
            const data = Array.isArray(event) ? event[0] : event;
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.call('delete', data.id);
                }
            });
        });
    </script>
@endscript
