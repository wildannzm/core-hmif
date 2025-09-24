<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array struktur departemen dan jabatan
        $departmentStructure = [
            'Badan Pengurus Harian' => [
                'Ketua',
                'Wakil Ketua',
                'Sekertaris',
                'Bendahara'
            ],
            'LITBANG' => [
                'Koordinator',
                'Anggota'
            ],
            'EKSTERNAL' => [
                'Koordinator',
                'Anggota'
            ],
            'DANUS' => [
                'Koordinator',
                'Anggota'
            ],
            'KOMINFO' => [
                'Koordinator',
                'Anggota'
            ]
        ];

        // Buat semua departemen
        foreach ($departmentStructure as $departmentName => $positions) {
            Department::firstOrCreate(['name' => $departmentName]);
        }

        // Kumpulkan semua posisi unik untuk menghindari duplikasi
        $allPositions = [];
        foreach ($departmentStructure as $positions) {
            foreach ($positions as $position) {
                if (!in_array($position, $allPositions)) {
                    $allPositions[] = $position;
                }
            }
        }

        // Buat semua posisi unik
        foreach ($allPositions as $positionName) {
            Position::firstOrCreate(['name' => $positionName]);
        }

        $this->command->info('Departments and positions seeded successfully!');
    }
}