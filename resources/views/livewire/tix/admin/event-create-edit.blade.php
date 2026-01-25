<div class="sm:p-6 space-y-3 sm:space-y-6 w-full mx-auto">
    <!-- Page Header -->
    <div
        class="mb-6 sm:mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">
                    {{ $eventId ? 'Edit Event' : 'Buat Event Baru' }}
                </h1>
            </div>
            <a href="{{ route('admin.events.index') }}" wire:navigate
                class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span class="hidden sm:inline">Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mx-1 sm:mx-0">
        <form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Judul Event <span class="text-red-500">*</span>
                    </label>
                    <input wire:model.live="title" type="text" id="title"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('title') border-red-500 @enderror"
                        placeholder="Contoh: Seminar Nasional Teknologi Informasi">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug (Auto-generated) -->
                <div class="md:col-span-2">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="slug" type="text" id="slug"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors bg-gray-50 @error('slug') border-red-500 @enderror"
                        placeholder="Auto-generated dari judul" readonly>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="description" id="description" rows="4"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('description') border-red-500 @enderror"
                        placeholder="Deskripsi lengkap tentang event..."></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Banner Upload -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Banner Event <span class="text-red-500">*</span>
                    </label>
                    <div class="mb-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Persyaratan Banner:</p>
                                <ul class="list-disc list-inside space-y-1 text-xs">
                                    <li>Rasio <strong>16:9</strong> (landscape)</li>
                                    <li>Ukuran minimal: <strong>800 x 450 px</strong></li>
                                    <li>Ukuran maksimal: <strong>1920 x 1080 px</strong></li>
                                    <li>Format: PNG, JPG, JPEG (Max 2MB)</li>
                                    <li>Rekomendasi: <strong>1920 x 1080 px</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <!-- Preview -->
                        <div class="flex-shrink-0 w-full sm:w-auto">
                            @if ($banner)
                                <img src="{{ $banner->temporaryUrl() }}"
                                    class="w-full sm:w-56 object-cover rounded-lg border-2 border-blue-500 shadow-sm"
                                    style="aspect-ratio: 16/9;">
                            @elseif($existingBanner)
                                <img src="{{ Storage::url($existingBanner) }}"
                                    class="w-full sm:w-56 object-cover rounded-lg border-2 border-gray-300 shadow-sm"
                                    style="aspect-ratio: 16/9;">
                            @else
                                <div class="w-full sm:w-56 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center bg-gray-50 py-8 sm:py-0"
                                    style="aspect-ratio: 16/9;">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-xs text-gray-500 mt-2">16:9</p>
                                </div>
                            @endif
                        </div>
                        <!-- Upload Button -->
                        <div class="flex-1 w-full sm:w-auto">
                            <input type="file" wire:model="banner" id="banner" class="hidden" accept="image/*">
                            <label for="banner"
                                class="w-full sm:w-auto cursor-pointer inline-flex justify-center items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                {{ $banner || $existingBanner ? 'Ganti Banner' : 'Upload Banner' }}
                            </label>
                            @error('banner')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="banner"
                                class="mt-2 text-sm text-blue-600 flex items-center justify-center sm:justify-start gap-2">
                                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Mengupload...
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="md:col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="location" type="text" id="location"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('location') border-red-500 @enderror"
                        placeholder="Contoh: Auditorium Universitas Majalengka">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divider: Waktu Pemesanan -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Waktu Pemesanan Tiket</h3>
                </div>

                <!-- Start Date (Pemesanan) -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Pemesanan Dibuka <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="start_date" type="datetime-local" id="start_date"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Date (Pemesanan) -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Pemesanan Ditutup <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="end_date" type="datetime-local" id="end_date"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divider: Waktu Event -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Waktu Event Berlangsung</h3>
                </div>

                <!-- Event Start Date -->
                <div>
                    <label for="event_start_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Event Mulai <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="event_start_date" type="datetime-local" id="event_start_date"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('event_start_date') border-red-500 @enderror">
                    @error('event_start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event End Date -->
                <div>
                    <label for="event_end_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Event Selesai <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="event_end_date" type="datetime-local" id="event_end_date"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('event_end_date') border-red-500 @enderror">
                    @error('event_end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Divider: Harga & Kuota -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Harga & Kuota</h3>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                        Harga Tiket (IDR) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input wire:model="price" type="number" id="price" min="0"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('price') border-red-500 @enderror"
                            placeholder="50000">
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quota -->
                <div>
                    <label for="quota" class="block text-sm font-medium text-gray-700 mb-1">
                        Total Kuota <span class="text-red-500">*</span>
                    </label>
                    <input wire:model.blur="quota" type="number" id="quota" min="1"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('quota') border-red-500 @enderror"
                        placeholder="100">
                    @error('quota')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if($eventId)
                <!-- Available Quota (Only on Edit) -->
                <div>
                    <label for="available_quota" class="block text-sm font-medium text-gray-700 mb-1">
                        Sisa Kuota <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="available_quota" type="number" id="available_quota" min="0" max="{{ $quota }}"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('available_quota') border-red-500 @enderror"
                        placeholder="100">
                    @error('available_quota')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- Is Active -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input wire:model="is_active" type="checkbox" id="is_active"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded outline-none transition-colors">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Aktifkan event ini
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:justify-end">
                <a href="{{ route('admin.events.index') }}" wire:navigate
                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 sm:px-6 py-2 sm:py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-300 transition-colors shadow-sm">
                    Batal
                </a>
                <button type="submit"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-blue-600 to-red-600 hover:from-blue-700 hover:to-red-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    {{ $eventId ? 'Perbarui Event' : 'Simpan Event' }}
                </button>
            </div>
        </form>
    </div>
</div>

@script
    <script>
        // SweetAlert Error Handler
        $wire.on('swal:error', (event) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: event.message,
                confirmButtonColor: '#3b82f6',
            });
        });

        // SweetAlert Success Handler
        $wire.on('swal:success', (event) => {
            Swal.fire({
                icon: 'success',
                title: event.title,
                text: event.text,
                confirmButtonColor: '#3b82f6',
            }).then(() => {
                if (event.redirect) {
                    Livewire.navigate(event.redirect);
                }
            });
        });
    </script>
@endscript
