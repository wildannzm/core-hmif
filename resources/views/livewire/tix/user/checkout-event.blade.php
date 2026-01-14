<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout Tiket</h1>
            <p class="text-gray-600">{{ $event->title }}</p>
        </div>

        <form wire:submit="submit">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8">
                <!-- Main Form Column -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Step 1: Quantity Selection -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">1. Jumlah Tiket</h2>
                        <div class="flex items-center justify-between max-w-xs">
                            <button type="button" wire:click="decrementQuantity"
                                class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors {{ $quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $quantity <= 1 ? 'disabled' : '' }}>
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                    </path>
                                </svg>
                            </button>
                            <div class="flex-1 text-center">
                                <span class="text-3xl font-bold text-gray-900">{{ $quantity }}</span>
                                <p class="text-sm text-gray-500">Tiket</p>
                            </div>
                            <button type="button" wire:click="incrementQuantity"
                                class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors {{ $quantity >= $event->available_quota ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $quantity >= $event->available_quota ? 'disabled' : '' }}>
                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-3">
                            Tersedia {{ $event->available_quota }} tiket
                        </p>
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Step 2: Buyer Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">2. Data Pembeli</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="buyerName" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="buyerName" type="text" id="buyerName"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('buyerName') border-red-500 @enderror"
                                    placeholder="Nama lengkap Anda">
                                @error('buyerName')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="buyerEmail" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="buyerEmail" type="email" id="buyerEmail"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('buyerEmail') border-red-500 @enderror"
                                    placeholder="email@example.com">
                                @error('buyerEmail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="buyerPhone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="buyerPhone" type="text" id="buyerPhone"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('buyerPhone') border-red-500 @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('buyerPhone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Attendee Details -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">3. Data Peserta</h2>
                        <p class="text-sm text-gray-600 mb-4">
                            Masukkan nama setiap peserta yang akan mengikuti event ini
                        </p>
                        <div class="space-y-3">
                            @foreach ($attendees as $index => $attendee)
                                <div>
                                    <label for="attendee-{{ $index }}"
                                        class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Peserta {{ $index + 1 }} <span class="text-red-500">*</span>
                                    </label>
                                    <input wire:model="attendees.{{ $index }}" type="text"
                                        id="attendee-{{ $index }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('attendees.' . $index) border-red-500 @enderror"
                                        placeholder="Nama lengkap peserta {{ $index + 1 }}">
                                    @error('attendees.' . $index)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Step 4: Payment Method -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">4. Metode Pembayaran</h2>
                        <div class="space-y-3">
                            @foreach ($paymentMethods as $method)
                                <label
                                    class="block p-4 border-2 rounded-lg cursor-pointer transition-all {{ $selectedPaymentMethodId == $method->id ? 'border-blue-600 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                                    <div class="flex items-start">
                                        <input type="radio" wire:model.live="selectedPaymentMethodId"
                                            value="{{ $method->id }}" class="mt-1 w-5 h-5 text-blue-600">
                                        <div class="ml-3 flex-1">
                                            <p class="font-semibold text-gray-900">{{ $method->bank_name }}</p>
                                            @if ($selectedPaymentMethodId == $method->id)
                                                <div class="mt-2 p-3 bg-white rounded border border-blue-200">
                                                    <p class="text-sm text-gray-600">Nomor Rekening:</p>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <p class="text-lg font-bold text-gray-900"
                                                            id="account-{{ $method->id }}">
                                                            {{ $method->account_number }}</p>
                                                        <button type="button"
                                                            onclick="copyAccountNumber('{{ $method->account_number }}', {{ $method->id }})"
                                                            class="p-2 hover:bg-blue-100 rounded-lg transition-colors group"
                                                            title="Salin nomor rekening">
                                                            <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600"
                                                                fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-2">Atas Nama:</p>
                                                    <p class="font-medium text-gray-900">{{ $method->account_name }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('selectedPaymentMethodId')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Step 5: Payment Proof -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">5. Upload Bukti Pembayaran</h2>
                        <div class="space-y-4">
                            @if ($paymentProof)
                                <div class="relative">
                                    <img src="{{ $paymentProof->temporaryUrl() }}" alt="Bukti Pembayaran"
                                        class="w-full max-w-sm rounded-lg border-2 border-blue-500">
                                    <button type="button" wire:click="$set('paymentProof', null)"
                                        class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            @else
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                                    <input type="file" wire:model="paymentProof" id="paymentProof" class="hidden"
                                        accept="image/*">
                                    <label for="paymentProof" class="cursor-pointer">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600">Klik untuk upload bukti pembayaran</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG (Max. 2MB)</p>
                                    </label>
                                </div>
                            @endif
                            <div wire:loading wire:target="paymentProof" class="text-sm text-blue-600">
                                Mengupload...
                            </div>
                            @error('paymentProof')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Order Summary (Sticky Sidebar) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-6 lg:sticky lg:top-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                        <!-- Event Banner Preview -->
                        <div class="mb-4">
                            <div class="relative rounded-lg overflow-hidden" style="aspect-ratio: 16/9;">
                                @if ($event->banner)
                                    <img src="{{ Storage::url($event->banner) }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Event</span>
                                <span class="font-medium text-gray-900 text-right">{{ $event->title }}</span>
                            </div>

                            <!-- Event Details -->
                            <div class="space-y-2 py-3 border-t border-gray-100">
                                <div class="flex items-start text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $event->event_start_date->format('d M Y, H:i') }} WIB</span>
                                </div>
                                <div class="flex items-start text-xs text-gray-600">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $event->location }}</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-3"></div>

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Tiket</span>
                                <span class="font-medium text-gray-900">Rp
                                    {{ number_format($event->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Jumlah Tiket</span>
                                <span class="font-medium text-gray-900">{{ $quantity }}</span>
                            </div>

                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-base lg:text-lg font-bold text-gray-900">Total Pembayaran</span>
                                    <span class="text-xl lg:text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($event->price * $quantity, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl"
                            wire:loading.attr="disabled" wire:target="submit">
                            <span wire:loading.remove wire:target="submit">
                                Bayar & Buat Pesanan
                            </span>
                            <span wire:loading wire:target="submit" class="flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                        </button>

                        <p class="text-xs text-gray-500 text-center mt-4">
                            Dengan melanjutkan, Anda menyetujui syarat dan ketentuan yang berlaku
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Copy Account Number Function (Global Scope) -->
<script>
    // Copy Account Number to Clipboard
    function copyAccountNumber(accountNumber, methodId) {
        navigator.clipboard.writeText(accountNumber).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Nomor rekening telah disalin ke clipboard',
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
            });
        }).catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak dapat menyalin nomor rekening',
                confirmButtonColor: '#3b82f6',
            });
        });
    }
</script>

@script
    <script>
        // SweetAlert Success Handler
        $wire.on('swal:success', (event) => {
            Swal.fire({
                icon: 'success',
                title: event.title,
                html: `
                    <p class="text-gray-700 mb-4">${event.message}</p>
                `,
                confirmButtonText: 'Kembali ke Beranda',
                confirmButtonColor: '#2563eb',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('tix.home') }}';
                }
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
    </script>
@endscript
