<div class="p-4 sm:p-6 lg:p-8">
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="mb-8 bg-gradient-to-r from-blue-600 to-red-600 rounded-xl shadow-lg p-4 sm:p-6 text-white">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">
                        Anggota HMIF
                    </h1>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mx-6 mb-6">
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="px-6 pb-6">
            @foreach ($members as $departmentName => $departmentMembers)
                @if ($departmentMembers->count() > 0)
                    <!-- Department Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 overflow-hidden">
                        <!-- Department Header -->
                        <div class="bg-gradient-to-r from-blue-500 to-red-500 px-6 py-4">
                            <h2 class="text-lg font-semibold text-white">{{ $departmentName }}</h2>
                            <p class="text-blue-100 text-sm">{{ $departmentMembers->count() }} anggota</p>
                        </div>

                        <!-- Members Table -->
                        <div class="overflow-x-auto">
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
                <div class="fixed inset-0 bg-gray-500 bg-opacity-30 transition-opacity" wire:click="closeEditModal">
                </div>

                <!-- Modal container -->
                <div class="flex items-center justify-center min-h-screen p-4">
                    <!-- Modal panel -->
                    <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full max-h-screen overflow-y-auto">
                        <!-- Modal Header -->
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-100 to-red-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-lg font-medium text-gray-900">Edit Data Anggota</h3>
                                        <p class="text-sm text-gray-500">Perbarui informasi anggota
                                            {{ $selectedMember->name }}</p>
                                    </div>
                                </div>
                                <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-4">
                            <form wire:submit.prevent="updateMember" class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" wire:model="editName"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('editName')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NIM -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NPM/NIM</label>
                                    <input type="text" wire:model="editNim"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('editNim')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" wire:model="editEmail"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('editEmail')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- RFID UID -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ID RFID</label>
                                    <input type="text" wire:model="editRfidUid"
                                        placeholder="Opsional - kosongkan jika belum ada"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('editRfidUid')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Department -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                                    <select wire:model="editDepartmentId"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Pilih Departemen</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('editDepartmentId')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Position -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                                    <select wire:model="editPositionId"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($positions as $pos)
                                            <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('editPositionId')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Modal Actions -->
                                <div
                                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row-reverse gap-3">
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
        @endif
    </div>
</div>
