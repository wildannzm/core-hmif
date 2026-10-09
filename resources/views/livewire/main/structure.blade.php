@php
    // Template only — no real personal data. Tambah/kurangi entri per kebutuhan.
    $bphLeaders = [
        ['role' => 'Ketua Himpunan', 'name' => 'Ketua Example'],
        ['role' => 'Wakil Ketua Himpunan', 'name' => 'Wakil Ketua Example'],
    ];
    $bphStaff = [
        ['role' => 'Sekretaris', 'name' => 'Sekretaris Example'],
        ['role' => 'Bendahara', 'name' => 'Bendahara Example'],
    ];
    $departments = [
        [
            'name' => 'LITBANG', 'desc' => 'Penelitian dan Pengembangan',
            'members' => [
                ['role' => 'Koordinator', 'name' => 'Koordinator Litbang'],
                ['role' => 'Anggota', 'name' => 'Anggota Litbang'],
            ],
        ],
        [
            'name' => 'DANUS', 'desc' => 'Dana dan Usaha',
            'members' => [
                ['role' => 'Koordinator', 'name' => 'Koordinator Danus'],
                ['role' => 'Anggota', 'name' => 'Anggota Danus'],
            ],
        ],
        [
            'name' => 'EKSTERNAL', 'desc' => 'Hubungan Eksternal',
            'members' => [
                ['role' => 'Koordinator', 'name' => 'Koordinator Eksternal'],
                ['role' => 'Anggota', 'name' => 'Anggota Eksternal'],
            ],
        ],
        [
            'name' => 'KOMINFO', 'desc' => 'Komunikasi dan Informasi',
            'members' => [
                ['role' => 'Koordinator', 'name' => 'Koordinator Kominfo'],
                ['role' => 'Anggota', 'name' => 'Anggota Kominfo'],
            ],
        ],
    ];
@endphp

<div class="min-h-screen bg-gray-900">
    <!-- Header Section -->
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                Struktur <span class="text-secondary">Organisasi</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto">
                Himpunan Mahasiswa Informatika
            </p>
            <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto">
                Kabinet Example
            </p>
            <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto">
                Periode 20XX/20XX
            </p>
        </div>
    </div>

    <!-- BPH Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Badan Pengurus Harian
            </h2>
            <div class="w-24 h-1 bg-primary mx-auto"></div>
        </div>

        <!-- Ketua & Wakil - 2 Columns -->
        <div class="flex justify-center mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl w-full">
                @foreach ($bphLeaders as $person)
                    <div
                        class="group relative overflow-hidden rounded-xl bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="aspect-[3/4] relative overflow-hidden bg-gray-700 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent">
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <p class="text-primary font-semibold text-sm md:text-base mb-1">{{ $person['role'] }}</p>
                            <h3 class="text-xl md:text-2xl font-bold">{{ $person['name'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sekretaris & Bendahara -->
        <div class="flex justify-center">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-4xl w-full">
                @foreach ($bphStaff as $person)
                    <div
                        class="group relative overflow-hidden rounded-xl bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="aspect-[3/4] relative overflow-hidden bg-gray-700 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent">
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <p class="text-primary font-semibold text-sm mb-1">{{ $person['role'] }}</p>
                            <h3 class="text-lg font-bold leading-tight">{{ $person['name'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Departemen -->
    @foreach ($departments as $index => $department)
        <div class="{{ $index % 2 === 0 ? 'bg-gray-800' : '' }} py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">
                        Departemen <span class="text-secondary">{{ $department['name'] }}</span>
                    </h2>
                    <p class="text-gray-400 text-lg">{{ $department['desc'] }}</p>
                    <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
                </div>

                <div class="flex justify-center">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-6xl">
                        @foreach ($department['members'] as $member)
                            <div
                                class="group relative overflow-hidden rounded-xl {{ $index % 2 === 0 ? 'bg-gray-900' : 'bg-gray-800' }} shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <div class="aspect-[3/4] relative overflow-hidden bg-gray-700 flex items-center justify-center">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-gray-900/30">
                                    </div>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                    <p class="text-secondary font-semibold text-xs mb-1">{{ $member['role'] }}</p>
                                    <h3 class="text-sm font-bold leading-tight">{{ $member['name'] }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
