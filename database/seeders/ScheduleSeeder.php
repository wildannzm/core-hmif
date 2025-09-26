<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentWeek = Carbon::now()->startOfWeek();
        
        // Sample schedules for current week
        $schedules = [
            [
                'name' => 'Rapat Pengurus Harian',
                'description' => 'Rapat rutin pengurus untuk membahas kegiatan mingguan',
                'date' => $currentWeek->copy()->addDays(0), // Monday
                'start_time' => $currentWeek->copy()->addDays(0)->setTime(9, 0),
                'location' => 'Ruang HMIF',
            ],
            [
                'name' => 'Workshop Web Development',
                'description' => 'Pelatihan pengembangan web untuk anggota',
                'date' => $currentWeek->copy()->addDays(1), // Tuesday
                'start_time' => $currentWeek->copy()->addDays(1)->setTime(13, 0),
                'location' => 'Lab Komputer 1',
            ],
            [
                'name' => 'Diskusi Proyek Akhir',
                'description' => 'Bimbingan dan diskusi proyek akhir mahasiswa',
                'date' => $currentWeek->copy()->addDays(2), // Wednesday
                'start_time' => $currentWeek->copy()->addDays(2)->setTime(10, 0),
                'location' => 'Ruang HMIF',
            ],
            [
                'name' => 'Seminar Teknologi',
                'description' => 'Seminar tentang tren teknologi terkini',
                'date' => $currentWeek->copy()->addDays(3), // Thursday
                'start_time' => $currentWeek->copy()->addDays(3)->setTime(14, 0),
                'location' => 'Auditorium',
            ],
            [
                'name' => 'Kegiatan Bakti Sosial',
                'description' => 'Kegiatan sosial HMIF di masyarakat',
                'date' => $currentWeek->copy()->addDays(4), // Friday
                'start_time' => $currentWeek->copy()->addDays(4)->setTime(8, 0),
                'location' => 'Desa Binaan',
            ],
            [
                'name' => 'Turnamen E-Sport',
                'description' => 'Kompetisi game antar mahasiswa informatika',
                'date' => $currentWeek->copy()->addDays(5), // Saturday
                'start_time' => $currentWeek->copy()->addDays(5)->setTime(9, 0),
                'location' => 'Lab Komputer 2',
            ],
            [
                'name' => 'Kajian Ilmiah',
                'description' => 'Diskusi dan pembahasan topik ilmiah terkini',
                'date' => $currentWeek->copy()->addDays(6), // Sunday
                'start_time' => $currentWeek->copy()->addDays(6)->setTime(15, 0),
                'location' => 'Ruang Seminar',
            ],
        ];

        // Add schedules for next week as well
        $nextWeek = Carbon::now()->addWeek()->startOfWeek();
        $nextWeekSchedules = [
            [
                'name' => 'Rapat Koordinasi',
                'description' => 'Koordinasi kegiatan antar departemen',
                'date' => $nextWeek->copy()->addDays(0), // Monday
                'start_time' => $nextWeek->copy()->addDays(0)->setTime(10, 0),
                'location' => 'Ruang HMIF',
            ],
            [
                'name' => 'Pelatihan Database',
                'description' => 'Workshop pengelolaan database MySQL',
                'date' => $nextWeek->copy()->addDays(2), // Wednesday
                'start_time' => $nextWeek->copy()->addDays(2)->setTime(13, 30),
                'location' => 'Lab Komputer 3',
            ],
            [
                'name' => 'Seminar Karir',
                'description' => 'Tips dan trik membangun karir di bidang IT',
                'date' => $nextWeek->copy()->addDays(4), // Friday
                'start_time' => $nextWeek->copy()->addDays(4)->setTime(16, 0),
                'location' => 'Auditorium',
            ],
        ];

        // Combine all schedules
        $allSchedules = array_merge($schedules, $nextWeekSchedules);

        foreach ($allSchedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
