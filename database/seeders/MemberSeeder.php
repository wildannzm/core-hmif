<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create department-specific roles
        $bphRole = Role::firstOrCreate(['name' => 'bph']);
        $litbangRole = Role::firstOrCreate(['name' => 'litbang']);
        $danusRole = Role::firstOrCreate(['name' => 'danus']);
        $eksternalRole = Role::firstOrCreate(['name' => 'eksternal']);
        $kominfoRole = Role::firstOrCreate(['name' => 'kominfo']);

        // Get departments
        $bph = Department::where('name', 'Badan Pengurus Harian')->first();
        $litbang = Department::where('name', 'LITBANG')->first();
        $danus = Department::where('name', 'DANUS')->first();
        $eksternal = Department::where('name', 'EKSTERNAL')->first();
        $kominfo = Department::where('name', 'KOMINFO')->first();

        // Get positions
        $ketua = Position::where('name', 'Ketua')->first();
        $wakilKetua = Position::where('name', 'Wakil Ketua')->first();
        $sekretaris = Position::where('name', 'Sekertaris')->first();
        $bendahara = Position::where('name', 'Bendahara')->first();
        $koordinator = Position::where('name', 'Koordinator')->first();
        $anggota = Position::where('name', 'Anggota')->first();

        // Members data
        $members = [
            // Badan Pengurus Harian
            [
                'name' => 'Ketua Example',
                'nim' => '0000000001',
                'email' => 'ketua@example.com',
                'department_id' => $bph->id,
                'position_id' => $ketua->id,
            ],
            [
                'name' => 'Wakil Ketua Example',
                'nim' => '0000000002',
                'email' => 'wakil.ketua@example.com',
                'department_id' => $bph->id,
                'position_id' => $wakilKetua->id,
            ],
            [
                'name' => 'Sekretaris Example',
                'nim' => '0000000003',
                'email' => 'sekretaris@example.com',
                'department_id' => $bph->id,
                'position_id' => $sekretaris->id,
            ],
            [
                'name' => 'Bendahara Example',
                'nim' => '0000000004',
                'email' => 'bendahara@example.com',
                'department_id' => $bph->id,
                'position_id' => $bendahara->id,
            ],
            // LITBANG
            [
                'name' => 'Litbang Example',
                'nim' => '0000000005',
                'email' => 'litbang@example.com',
                'department_id' => $litbang->id,
                'position_id' => $koordinator->id,
            ],
            // DANUS
            [
                'name' => 'Danus Example',
                'nim' => '0000000006',
                'email' => 'danus@example.com',
                'department_id' => $danus->id,
                'position_id' => $koordinator->id,
            ],
            // EKSTERNAL
            [
                'name' => 'Eksternal Example',
                'nim' => '0000000007',
                'email' => 'eksternal@example.com',
                'department_id' => $eksternal->id,
                'position_id' => $koordinator->id,
            ],
            // KOMINFO
            [
                'name' => 'Kominfo Example',
                'nim' => '0000000008',
                'email' => 'kominfo@example.com',
                'department_id' => $kominfo->id,
                'position_id' => $koordinator->id,
            ],
        ];

        // Create members
        foreach ($members as $memberData) {
            // Generate password from first name
            $firstName = explode(' ', $memberData['name'])[0];
            $password = strtolower($firstName) . '123';

            $user = User::create([
                'name' => $memberData['name'],
                'nim' => $memberData['nim'],
                'email' => strtolower(str_replace(' ', '.', $memberData['email'])),
                'password' => Hash::make($password),
                'email_verified_at' => now(),
                'department_id' => $memberData['department_id'],
                'position_id' => $memberData['position_id'],
            ]);

            // Assign department-specific role based on department
            if ($memberData['department_id'] === $bph->id) {
                $user->assignRole($bphRole);
            } elseif ($memberData['department_id'] === $litbang->id) {
                $user->assignRole($litbangRole);
            } elseif ($memberData['department_id'] === $eksternal->id) {
                $user->assignRole($eksternalRole);
            } elseif ($memberData['department_id'] === $danus->id) {
                $user->assignRole($danusRole);
            } elseif ($memberData['department_id'] === $kominfo->id) {
                $user->assignRole($kominfoRole);
            }
        }

        $this->command->info('All HMIF members seeded successfully!');
        $this->command->info('Password format: [firstname]123 (lowercase)');
        $this->command->info('Example: John -> john123');
    }
}
