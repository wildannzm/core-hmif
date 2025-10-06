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
        // Create member role if it doesn't exist

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
                'name' => 'Wildan Zhilal Manafi',
                'nim' => '2314101009',
                'email' => '2314101009@unma.ac.id',
                'department_id' => $bph->id,
                'position_id' => $ketua->id,
            ],
            [
                'name' => 'Siti Nurrahma Dewi',
                'nim' => '2314101053',
                'email' => '2314101053@unma.ac.id',
                'department_id' => $bph->id,
                'position_id' => $wakilKetua->id,
            ],
            [
                'name' => 'Mira Yunisa',
                'nim' => '2314101024',
                'email' => '2314101024@unma.ac.id',
                'department_id' => $bph->id,
                'position_id' => $sekretaris->id,
            ],
            [
                'name' => 'Afifah Puteri Gumilar',
                'nim' => '2414101042',
                'email' => '2414101042@unma.ac.id',
                'department_id' => $bph->id,
                'position_id' => $sekretaris->id,
            ],
            [
                'name' => 'Hegar Zalekania',
                'nim' => '2314101064',
                'email' => '2314101064@unma.ac.id',
                'department_id' => $bph->id,
                'position_id' => $bendahara->id,
            ],
            [
                'name' => 'Zahwa Zundia Agni Darmawan',
                'nim' => '2414101027',
                'email' => '2414101027@unma.ac.id',
                'department_id' => $bph->id,
                'position_id' => $bendahara->id,
            ],

            // LITBANG
            [
                'name' => 'Khoerul Anwar',
                'nim' => '2314101023',
                'email' => '2314101023@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $koordinator->id,
            ],
            [
                'name' => 'Rintan Nurhaliza',
                'nim' => '2314101036',
                'email' => '2314101036@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Puput Risna',
                'nim' => '2314101003',
                'email' => '2314101003@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Siti Solihah',
                'nim' => '2414101004',
                'email' => '2414101004@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Riska Nurul Fajriani',
                'nim' => '2414101056',
                'email' => '2414101056@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Muhamad Anugrah Aidil Akbar',
                'nim' => '2414101039',
                'email' => '2414101039@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Muhammad Hibban Al Faqih',
                'nim' => '2414101018',
                'email' => '2414101018@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Faris Ahmad Fauzi',
                'nim' => '2414101038',
                'email' => '2414101038@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Erdin Maulana',
                'nim' => '2414101106',
                'email' => '2414101106@unma.ac.id',
                'department_id' => $litbang->id,
                'position_id' => $anggota->id,
            ],

            // EKSTERNAL
            [
                'name' => 'Muhammad Fathu Rohman',
                'nim' => '2314101034',
                'email' => '2314101034@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $koordinator->id,
            ],
            [
                'name' => 'Nabhani Fathin',
                'nim' => '2314101056',
                'email' => '2314101056@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Sunarjo',
                'nim' => '2314101098',
                'email' => '2314101098@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Alma Karismatusyfa',
                'nim' => '2414101031',
                'email' => '2414101031@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Yuda Tri Putra',
                'nim' => '2414101008',
                'email' => '2414101008@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Muhamad Rizki Maulana',
                'nim' => '2414101063',
                'email' => '2414101063@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Kimi Raihan Fathin',
                'nim' => '2414101040',
                'email' => '2414101040@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Ibnu Restu Pamungkas',
                'nim' => '2314101049',
                'email' => '2314101049@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Joan Aryoadi',
                'nim' => '2414101002',
                'email' => '2414101002@unma.ac.id',
                'department_id' => $eksternal->id,
                'position_id' => $anggota->id,
            ],

            // DANUS
            [
                'name' => 'Dia Nuriah',
                'nim' => '2314101040',
                'email' => '2314101040@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $koordinator->id,
            ],
            [
                'name' => 'Tri Maryani',
                'nim' => '2314101037',
                'email' => '2314101037@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Ilham Fadilah',
                'nim' => '2314101087',
                'email' => '2314101087@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Wiwi Yulianah',
                'nim' => '2414101015',
                'email' => '2414101015@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Rezza Dinulhaq',
                'nim' => '2414101050',
                'email' => '2414101050@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Fauzan Zachary',
                'nim' => '2414101028',
                'email' => '2414101028@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Irfa Atin Rijanah',
                'nim' => '2414101051',
                'email' => '2414101051@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Aril Muhamad Nazih Arib Ardabil',
                'nim' => '2414101005',
                'email' => '2414101005@unma.ac.id',
                'department_id' => $danus->id,
                'position_id' => $anggota->id,
            ],

            // KOMINFO
            [
                'name' => 'Salma Nurrisa',
                'nim' => '2314101026',
                'email' => '2314101026@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $koordinator->id,
            ],
            [
                'name' => 'Muhamad Farhan Fadila',
                'nim' => '2314101011',
                'email' => '2314101011@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Maulana Nur Rafli',
                'nim' => '2314101068',
                'email' => '2314101068@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Faizal Anugrah Pratama',
                'nim' => '2314101013',
                'email' => '2314101013@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Putri Maulidia',
                'nim' => '2314101072',
                'email' => '2314101072@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Dika Alfaizal Akbar',
                'nim' => '2314101094',
                'email' => '2314101094@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Faris Ilham Rabbani',
                'nim' => '2414101092',
                'email' => '2414101092@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Anna Miftakhul Khoiriah',
                'nim' => '2414101019',
                'email' => '2414101019@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
            ],
            [
                'name' => 'Annisa Aprilia Lestari',
                'nim' => '2414101025',
                'email' => '2414101025@unma.ac.id',
                'department_id' => $kominfo->id,
                'position_id' => $anggota->id,
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

            // Assign member role to the user

            // Assign department-specific role based on department
            if ($memberData['department_id'] === $bph->id) {
                $user->assignRole($bphRole);
            } elseif ($memberData['department_id'] === $litbang->id) {
                $user->assignRole($litbangRole);
            } elseif ($memberData['department_id'] === $eksternal->id) {
                $user->assignRole($eksternalRole);
            }elseif ($memberData['department_id'] === $danus->id) {
                $user->assignRole($danusRole);
            } elseif ($memberData['department_id'] === $kominfo->id) {
                $user->assignRole($kominfoRole);
            }
        }

        $this->command->info('All HMIF members seeded successfully!');
        $this->command->info('Password format: [firstname]123 (lowercase)');
        $this->command->info('Example: Wildan -> wildan123');
    }
}