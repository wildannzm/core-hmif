<section class="w-full">
    <x-settings.layout heading="Ubah Kata Sandi"
        subheading="Pastikan akun Anda menggunakan kata sandi yang kuat dan acak untuk menjaga keamanan">
        <!-- Security Tips Card -->
        <div class="mb-6 bg-gradient-to-r from-blue-50 to-red-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-blue-500 to-red-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-1">Tips Keamanan Kata Sandi</h3>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li class="flex items-center space-x-2">
                            <div class="w-1 h-1 bg-blue-500 rounded-full"></div>
                            <span>Gunakan minimal 8 karakter</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-1 h-1 bg-red-500 rounded-full"></div>
                            <span>Kombinasi huruf besar, kecil, angka, dan simbol</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-1 h-1 bg-blue-500 rounded-full"></div>
                            <span>Hindari informasi pribadi yang mudah ditebak</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Password Form Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Perbarui Kata Sandi</h2>
                        <p class="text-sm text-gray-600">Masukkan kata sandi lama dan kata sandi baru Anda</p>
                    </div>
                </div>
            </div>


            <!-- Card Body -->
            <form method="POST" wire:submit="confirmPasswordUpdate" class="p-6 space-y-6">
                <!-- Current Password -->
                <div class="space-y-2">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                        Kata Sandi Saat Ini
                    </label>
                    <div class="relative" x-data="{ showCurrent: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input wire:model="current_password" :type="showCurrent ? 'text' : 'password'"
                            id="current_password"
                            class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('current_password') border-red-300 focus:ring-red-500 @enderror"
                            placeholder="Kata sandi saat ini" autocomplete="current-password" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showCurrent = !showCurrent"
                                class="password-toggle-btn text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition-all duration-200 p-2 rounded-lg hover:bg-blue-50 focus:bg-blue-50 border border-transparent hover:border-blue-200"
                                :title="showCurrent ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'">
                                <!-- Eye Open Icon -->
                                <svg x-show="!showCurrent" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- Eye Slash Icon -->
                                <svg x-show="showCurrent" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('current_password')
                        <p class="text-sm text-red-600 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Kata Sandi Baru
                    </label>
                    <div class="relative" x-data="{ showNew: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                </path>
                            </svg>
                        </div>
                        <input wire:model="password" :type="showNew ? 'text' : 'password'" id="password"
                            class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-300 focus:ring-red-500 @enderror"
                            placeholder="Kata sandi baru yang kuat" autocomplete="new-password" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showNew = !showNew"
                                class="password-toggle-btn text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition-all duration-200 p-2 rounded-lg hover:bg-blue-50 focus:bg-blue-50 border border-transparent hover:border-blue-200"
                                :title="showNew ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'">
                                <!-- Eye Open Icon -->
                                <svg x-show="!showNew" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- Eye Slash Icon -->
                                <svg x-show="showNew" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <div class="relative" x-data="{ showConfirm: false }">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <input wire:model="password_confirmation" :type="showConfirm ? 'text' : 'password'"
                            id="password_confirmation"
                            class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password_confirmation') border-red-300 focus:ring-red-500 @enderror"
                            placeholder="Masukkan ulang kata sandi baru" autocomplete="new-password" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showConfirm = !showConfirm"
                                class="password-toggle-btn text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition-all duration-200 p-2 rounded-lg hover:bg-blue-50 focus:bg-blue-50 border border-transparent hover:border-blue-200"
                                :title="showConfirm ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'">
                                <!-- Eye Open Icon -->
                                <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- Eye Slash Icon -->
                                <svg x-show="showConfirm" x-cloak class="w-5 h-5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <p class="text-sm text-red-600 flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-end pt-4 border-t border-gray-200 space-y-3 sm:space-y-0">

                    <!-- Loading State -->
                    <div wire:loading wire:target="updatePassword" class="text-blue-600 flex items-center space-x-2">
                        <svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span class="font-medium">Memperbarui kata sandi...</span>
                    </div>

                    <!-- Save Button -->
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-red-500 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none shadow-lg">
                        <svg wire:loading.remove wire:target="confirmPasswordUpdate,updatePassword"
                            class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <svg wire:loading wire:target="confirmPasswordUpdate,updatePassword"
                            class="animate-spin w-5 h-5 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="confirmPasswordUpdate,updatePassword">Ubah Kata
                            Sandi</span>
                        <span wire:loading wire:target="confirmPasswordUpdate,updatePassword">Memproses...</span>
                    </button>
                </div>
            </form>
        </div>

    </x-settings.layout>

    <!-- SweetAlert Integration -->
    <script>
        // Listen for SweetAlert events
        document.addEventListener('livewire:init', () => {
            // Confirmation dialog
            Livewire.on('swal:confirm-password-update', () => {
                Swal.fire({
                    title: 'Konfirmasi Perubahan',
                    text: 'Apakah Anda yakin ingin mengubah kata sandi?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3B82F6',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true,
                    showClass: {
                        popup: 'animate__animated animate__zoomIn animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__zoomOut animate__faster'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Sedang memperbarui kata sandi Anda',
                            icon: 'info',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        // Call the actual update method
                        @this.call('updatePassword');
                    }
                });
            });

            // Success notification
            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: data[0].icon,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10B981',
                    timer: 4000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__bounceIn'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            });

            // Error notification
            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    title: 'Oops!',
                    text: data[0].text || 'Terjadi kesalahan saat memperbarui kata sandi.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#EF4444',
                    showClass: {
                        popup: 'animate__animated animate__shakeX'
                    }
                });
            });
        });
    </script>

    <!-- Alpine.js Styling -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Password Toggle Button Enhancements */
        .password-toggle-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
        }

        .password-toggle-btn:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: scale(1.05);
        }

        .password-toggle-btn:active {
            transform: scale(0.95);
        }

        /* Eye Icon Styling */
        .eye-icon {
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
        }

        /* Eye Slash specific styling for better visibility */
        .eye-slash-icon {
            filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.2));
        }

        /* Animation for icon transitions */
        .password-toggle-btn svg {
            transition: all 0.2s ease-in-out;
        }

        .password-toggle-btn:hover svg {
            stroke-width: 2.5;
        }
    </style>
</section>
