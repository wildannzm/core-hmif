<div class="sm:p-6 lg:p-8 w-full mx-auto">
    <!-- Header Section -->
    <div
        class="mb-6 sm:mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6 text-white mx-1 sm:mx-0">
        <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl xl:text-3xl font-bold mb-1 sm:mb-2 truncate">
                    Anggota HMIF
                </h1>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 sm:mb-6 mx-1 sm:mx-0">
            <div class="bg-green-50 border border-green-200 text-green-800 px-3 sm:px-4 py-3 rounded-lg" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-2 sm:ml-3">
                        <p class="text-xs sm:text-sm font-medium">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="px-1 sm:px-0 pb-4 sm:pb-6">
        @foreach ($members as $departmentName => $departmentMembers)
            @if ($departmentMembers->count() > 0)
                <!-- Department Section -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4 sm:mb-6 overflow-hidden mx-1 sm:mx-0">
                    <!-- Department Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-red-500 px-3 sm:px-6 py-3 sm:py-4">
                        <h2 class="text-base sm:text-lg font-semibold text-white">{{ $departmentName }}</h2>
                        <p class="text-blue-100 text-xs sm:text-sm">{{ $departmentMembers->count() }} anggota</p>
                    </div>

                    <!-- Mobile Card Layout -->
                    <div class="block sm:hidden">
                        @foreach ($departmentMembers as $index => $member)
                            <div class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors">
                                <!-- Card Body -->
                                <div class="px-4 py-4">
                                    <!-- Header Info -->
                                    <div class="mb-3">
                                        <h3 class="text-base font-semibold text-gray-900 mb-1">{{ $member->name }}</h3>
                                        <p class="text-sm text-gray-600">NPM: {{ $member->nim }}</p>
                                    </div>

                                    <!-- Card Content -->
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm text-gray-500 font-medium">Jabatan:</span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                                @if ($departmentName === 'Badan Pengurus Harian') bg-red-100 text-red-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ $this->getPositionDisplayName($member) }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm text-gray-500 font-medium">ID RFID:</span>
                                            @if ($member->rfid_uid)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $member->rfid_uid }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Belum diatur
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Footer -->
                                <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                                    <div class="flex justify-end items-center space-x-2">
                                        <button wire:click="editMember({{ $member->id }})"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-white bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 transition-colors shadow-sm"
                                            title="Edit anggota">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button
                                            onclick="confirmDeleteMember({{ $member->id }}, '{{ $member->name }}')"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 transition-colors shadow-sm"
                                            title="Hapus anggota">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table Layout -->
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NPM/NIM</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jabatan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID RFID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($departmentMembers as $index => $member)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $member->nim }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $member->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if ($departmentName === 'Badan Pengurus Harian') bg-red-100 text-red-800
                                                @else
                                                    bg-blue-100 text-blue-800 @endif">
                                                {{ $this->getPositionDisplayName($member) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if ($member->rfid_uid)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $member->rfid_uid }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Belum diatur
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <button wire:click="editMember({{ $member->id }})"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150"
                                                    title="Edit anggota">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button
                                                    onclick="confirmDeleteMember({{ $member->id }}, '{{ $member->name }}')"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-150"
                                                    title="Hapus anggota">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Edit Modal -->
    @if ($showEditModal && $selectedMember)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-black/20 backdrop-blur-sm transition-opacity" wire:click="closeEditModal">
            </div>

            <!-- Modal container -->
            <div class="flex items-center justify-center min-h-screen p-2 sm:p-4">
                <!-- Modal panel -->
                <div
                    class="relative bg-white rounded-lg shadow-xl max-w-sm sm:max-w-lg w-full max-h-screen overflow-y-auto">
                    <!-- Modal Header -->
                    <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="">
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900">Edit Data Anggota</h3>
                                    <p class="text-xs sm:text-sm text-gray-500">Perbarui informasi anggota
                                        {{ $selectedMember->name }}</p>
                                </div>
                            </div>
                            <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-4 sm:px-6 py-4">
                        <form wire:submit.prevent="updateMember" class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" wire:model="editName"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                @error('editName')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIM -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NPM/NIM</label>
                                <input type="text" wire:model="editNim"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                @error('editNim')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" wire:model="editEmail"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                @error('editEmail')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- RFID UID -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ID RFID</label>
                                <input type="text" wire:model="editRfidUid"
                                    placeholder="Opsional - kosongkan jika belum ada"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                @error('editRfidUid')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                                <select wire:model="editDepartmentId"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">Pilih Departemen</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                @error('editDepartmentId')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Position -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                                <select wire:model="editPositionId"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($positions as $pos)
                                        <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                    @endforeach
                                </select>
                                @error('editPositionId')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Modal Actions -->
                            <div
                                class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-2 sm:gap-3">
                                <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-red-500 text-white text-sm font-medium rounded-md hover:from-blue-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-150">
                                    Simpan Perubahan
                                </button>
                                <button wire:click="closeEditModal" type="button"
                                    class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteMember(memberId, memberName) {
            Swal.fire({
                title: 'Hapus Anggota?',
                html: `Apakah Anda yakin ingin menghapus anggota <strong>${memberName}</strong>?<br><span class="text-sm text-gray-600">Tindakan ini tidak dapat dibatalkan.</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'swal-popup-custom',
                    confirmButton: 'swal-confirm-delete',
                    cancelButton: 'swal-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Sedang menghapus data anggota',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Call Livewire method
                    @this.call('deleteMember', memberId);
                }
            });
        }

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            Livewire.on('member-deleted', (event) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: `Anggota ${event.memberName} berhasil dihapus`,
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true
                });
            });

            Livewire.on('delete-error', (event) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: event.message || 'Terjadi kesalahan saat menghapus anggota',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ef4444'
                });
            });
        });
    </script>

    <!-- Custom CSS for SweetAlert -->
    <style>
        .swal-popup-custom {
            border-radius: 12px !important;
        }

        .swal-confirm-delete {
            background: linear-gradient(45deg, #ef4444, #dc2626) !important;
            border: none !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
        }

        .swal-confirm-delete:hover {
            background: linear-gradient(45deg, #dc2626, #b91c1c) !important;
        }

        .swal-cancel-button {
            background: #f9fafb !important;
            color: #374151 !important;
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
            font-weight: 500 !important;
        }

        .swal-cancel-button:hover {
            background: #f3f4f6 !important;
        }
    </style>
</div>
