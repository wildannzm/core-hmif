<section class="w-full">
    <x-settings.layout heading="Profil" subheading="Informasi akun dan data diri Anda">
        <!-- Profile Header Card -->
        <div
            class="bg-gradient-to-br from-blue-50 via-white to-red-50 rounded-2xl p-6 mb-8 border border-gray-100 shadow-lg">
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <!-- Basic Info -->
                <div class="text-center sm:text-left flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-600 mb-2">{{ auth()->user()->email }}</p>
                    @if (auth()->user()->nim)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            NPM: {{ auth()->user()->nim }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 gap-6 mb-8">
            <!-- Department Card -->
            <div
                class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Departemen</h3>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ auth()->user()->department ? auth()->user()->department->name : 'Belum Ditentukan' }}
                        </p>
                        @if (auth()->user()->department && auth()->user()->department->description)
                            <p class="text-sm text-gray-600 mt-1">{{ auth()->user()->department->description }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Position Card -->
            <div
                class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Jabatan</h3>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ auth()->user()->position ? auth()->user()->position->name : 'Belum Ditentukan' }}
                        </p>
                        @if (auth()->user()->position && auth()->user()->position->description)
                            <p class="text-sm text-gray-600 mt-1">{{ auth()->user()->position->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </x-settings.layout>
</section>
