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
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full text-sm font-bold">1</span>
                            <span>Jumlah Tiket</span>
                        </h2>
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
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full text-sm font-bold">2</span>
                            <span>Data Pembeli</span>
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label for="buyerName" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="buyerName" type="text" id="buyerName"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('buyerName') border-red-500 @enderror"
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
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('buyerEmail') border-red-500 @enderror"
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
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('buyerPhone') border-red-500 @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('buyerPhone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Attendee Details -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full text-sm font-bold">3</span>
                            <span>Data Peserta</span>
                        </h2>
                        <p class="text-sm text-gray-600 mb-4">
                            Masukkan nama setiap peserta yang akan mengikuti event ini
                        </p>
                        <div class="space-y-3">
                            @foreach ($attendees as $index => $attendee)
                                <div>
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                        <label for="attendee-{{ $index }}"
                                            class="block text-sm font-medium text-gray-700">
                                            Nama Peserta {{ $index + 1 }} <span class="text-red-500">*</span>
                                        </label>
                                        @if ($index === 0)
                                            <div
                                                class="flex items-center self-start sm:self-auto bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 transition-colors hover:bg-blue-100">
                                                <input wire:model.live="sameAsBuyer" type="checkbox" id="sameAsBuyer"
                                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                                                <label for="sameAsBuyer"
                                                    class="ml-2 text-xs sm:text-sm text-blue-700 cursor-pointer font-medium select-none">
                                                    Sama dengan data pembeli
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <input wire:model="attendees.{{ $index }}" type="text"
                                        id="attendee-{{ $index }}"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none @error('attendees.' . $index) border-red-500 @enderror"
                                        placeholder="Nama lengkap peserta {{ $index + 1 }}">
                                    @error('attendees.' . $index)
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($event->price > 0)
                    <!-- Step 4: Payment Method -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full text-sm font-bold">4</span>
                            <span>Metode Pembayaran</span>
                        </h2>
                        <p class="text-sm text-gray-600 mb-5">Pilih metode pembayaran untuk menyelesaikan transaksi</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($paymentMethods as $method)
                                <div wire:key="payment-method-{{ $method->id }}" class="relative">
                                    <input type="radio" wire:model.live="selectedPaymentMethodId"
                                        value="{{ $method->id }}" id="payment-{{ $method->id }}" class="sr-only">

                                    <label for="payment-{{ $method->id }}"
                                        class="relative flex flex-col h-full p-5 border-2 rounded-xl cursor-pointer transition-all duration-200
                                        {{ $selectedPaymentMethodId == $method->id ? 'border-blue-600 bg-gradient-to-br from-blue-50 to-transparent shadow-lg' : 'border-gray-200 bg-white hover:border-blue-300 hover:shadow-md' }}">

                                        <!-- Check Icon Badge -->
                                        @if ($selectedPaymentMethodId == $method->id)
                                            <span
                                                class="absolute -top-2 -right-2 w-7 h-7 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        @endif

                                        <!-- Bank Icon -->
                                        <div class="flex items-center gap-3 mb-3">
                                            <div
                                                class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-sm">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-bold text-gray-900 text-base leading-tight">
                                                    {{ $method->bank_name }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    {{ $method->is_cash ? 'Tunai (Bayar Di Tempat)' : 'Transfer Bank' }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Account Details (Expanded when selected) -->
                                        @if ($selectedPaymentMethodId == $method->id && !$method->is_cash)
                                            <div class="mt-2 pt-3 border-t border-gray-200">
                                                <div class="space-y-3">
                                                    <!-- Account Number -->
                                                    <div
                                                        class="bg-white/80 backdrop-blur-sm rounded-lg p-3 border border-blue-100">
                                                        <p class="text-xs text-gray-600 mb-1">Nomor Rekening</p>
                                                        <div class="flex items-center justify-between gap-2">
                                                            <p class="font-mono font-bold text-gray-900 text-lg tracking-wider"
                                                                id="account-{{ $method->id }}">
                                                                {{ $method->account_number }}
                                                            </p>
                                                            <button type="button"
                                                                onclick="copyAccountNumber('{{ $method->account_number }}', {{ $method->id }})"
                                                                class="flex-shrink-0 p-2 hover:bg-blue-50 rounded-lg transition-colors group/copy"
                                                                title="Salin nomor rekening">
                                                                <svg class="w-5 h-5 text-gray-500 group-hover/copy:text-blue-600 transition-colors"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Account Name -->
                                                    <div
                                                        class="bg-white/80 backdrop-blur-sm rounded-lg p-3 border border-blue-100">
                                                        <p class="text-xs text-gray-600 mb-1">Atas Nama</p>
                                                        <p class="font-semibold text-gray-900">
                                                            {{ $method->account_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        @error('selectedPaymentMethodId')
                            <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Step 5: Payment Proof -->
                    @if(!$isCashPayment)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full text-sm font-bold">5</span>
                            <span>Upload Bukti Pembayaran</span>
                        </h2>
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
                    @endif
                    @endif
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
                                <div class="flex flex-col items-end">
                                    @if($event->strike_price)
                                        <span class="text-xs text-gray-400 line-through">Rp {{ number_format($event->strike_price, 0, ',', '.') }}</span>
                                    @endif
                                    <span class="font-medium text-gray-900">{{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Jumlah Tiket</span>
                                <span class="font-medium text-gray-900">{{ $quantity }}</span>
                            </div>

                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-base lg:text-lg font-bold text-gray-900">Total Pembayaran</span>
                                    <span class="text-xl lg:text-2xl font-bold text-blue-600">
                                        {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price * $quantity, 0, ',', '.') }}
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
        Livewire.on('checkout-success', (event) => {
            Swal.fire({
                icon: 'success',
                title: event.title,
                html: `
                <p class="text-gray-700 mb-4">${event.message}</p>
                `,
                confirmButtonText: 'Kembali ke Beranda',
                confirmButtonColor: '#2563eb',
                allowOutsideClick: false,
                timer: 2500,
                timerProgressBar: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.redirectHome();
                }
            });
        });

        Livewire.on('redirect-checkout-success', () => {
            setTimeout(() => {
                @this.redirectHome();
            }, 2500);
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
