<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-xl shadow-lg p-4 sm:p-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">
                    Departemen & Jabatan
                </h1>
            </div>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center text-green-800">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 mb-6">
        <nav class="flex space-x-8 px-6 py-4 border-b border-gray-200">
            <button wire:click="$set('activeTab', 'departments')"
                class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $activeTab === 'departments' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Departemen
            </button>
            <button wire:click="$set('activeTab', 'positions')"
                class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $activeTab === 'positions' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Posisi/Jabatan
            </button>
        </nav>
    </div>

    <!-- Controls -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-4 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" wire:model.live="search"
                        placeholder="{{ $activeTab === 'departments' ? 'Cari departemen...' : 'Cari posisi...' }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>
            </div>

            <!-- Add Button -->
            @if ($activeTab === 'departments')
                <button wire:click="openModal"
                    class="bg-gradient-to-r from-blue-500 to-red-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium flex items-center gap-2 shadow-lg whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Departemen
                </button>
            @else
                <button wire:click="openPositionModal"
                    class="bg-gradient-to-r from-blue-500 to-red-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium flex items-center gap-2 shadow-lg whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Posisi
                </button>
            @endif
        </div>
    </div>

    <!-- Departments Table -->
    @if ($activeTab === 'departments')
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Departemen</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($departments as $department)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $department->name }}</div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex gap-2">
                                        <button wire:click="edit({{ $department->id }})"
                                            class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button onclick="confirmDelete({{ $department->id }}, 'department')"
                                            class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 sm:px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Departemen</h3>
                                    <p class="text-gray-500 mb-4">
                                        @if ($search)
                                            Tidak ada departemen yang cocok dengan pencarian "{{ $search }}"
                                        @else
                                            Mulai dengan menambahkan departemen pertama
                                        @endif
                                    </p>
                                    @if (!$search)
                                        <button wire:click="openModal"
                                            class="bg-gradient-to-r from-blue-500 to-red-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium">
                                            Tambah Departemen
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination for Departments -->
            @if ($departments->hasPages())
                <div class="px-4 sm:px-6 py-3 border-t border-gray-200">
                    {{ $departments->links() }}
                </div>
            @endif
        </div>
    @endif

    <!-- Positions Table -->
    @if ($activeTab === 'positions')
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Posisi/Jabatan</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($positions as $position)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $position->name }}</div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex gap-2">
                                        <button wire:click="editPosition({{ $position->id }})"
                                            class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button onclick="confirmDelete({{ $position->id }}, 'position')"
                                            class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 sm:px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Posisi</h3>
                                    <p class="text-gray-500 mb-4">
                                        @if ($search)
                                            Tidak ada posisi yang cocok dengan pencarian "{{ $search }}"
                                        @else
                                            Mulai dengan menambahkan posisi pertama
                                        @endif
                                    </p>
                                    @if (!$search)
                                        <button wire:click="openPositionModal"
                                            class="bg-gradient-to-r from-blue-500 to-red-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium">
                                            Tambah Posisi
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination for Positions -->
            @if ($positions->hasPages())
                <div class="px-4 sm:px-6 py-3 border-t border-gray-200">
                    {{ $positions->links() }}
                </div>
            @endif
        </div>
    @endif

    <!-- Department Modal -->
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-xl shadow-xl max-w-lg w-full max-h-screen overflow-y-auto">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $isEditing ? 'Edit Departemen' : 'Tambah Departemen' }}
                    </h3>
                </div>

                <form wire:submit.prevent="save" class="p-6">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Departemen
                        </label>
                        <input type="text" wire:model="name" id="name"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @else border-gray-300 @enderror"
                            placeholder="Masukkan nama departemen">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-500 to-red-500 text-white py-2 px-4 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium">
                            {{ $isEditing ? 'Update' : 'Simpan' }}
                        </button>
                        <button type="button" wire:click="closeModal"
                            class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Position Modal -->
    @if ($showPositionModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-xl shadow-xl max-w-lg w-full max-h-screen overflow-y-auto">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $isEditingPosition ? 'Edit Posisi' : 'Tambah Posisi' }}
                    </h3>
                </div>

                <form wire:submit.prevent="savePosition" class="p-6">
                    <div class="mb-4">
                        <label for="positionName" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Posisi/Jabatan
                        </label>
                        <input type="text" wire:model="positionName" id="positionName"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('positionName') border-red-500 @else border-gray-300 @enderror"
                            placeholder="Masukkan nama posisi">
                        @error('positionName')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-500 to-red-500 text-white py-2 px-4 rounded-lg hover:from-blue-600 hover:to-red-600 transition-all duration-200 font-medium">
                            {{ $isEditingPosition ? 'Update' : 'Simpan' }}
                        </button>
                        <button type="button" wire:click="closePositionModal"
                            class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            Batal
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
    function confirmDelete(id, type) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: type === 'department' ? 'Departemen ini akan dihapus secara permanen!' :
                'Posisi ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                if (type === 'department') {
                    @this.call('delete', id);
                } else {
                    @this.call('deletePosition', id);
                }
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
