<?php

use App\Livewire\Members;
use App\Models\Attendance;
use App\Livewire\Dashboard;
use App\Livewire\Schedules;
use App\Livewire\Departments;
use App\Livewire\AttendanceReport;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Attendance\ScheduleAttendance;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('departemen', Departments::class)->name('departments');
    Route::get('anggota', Members::class)->name('members');
    Route::get('jadwal', Schedules::class)->name('schedules');
    Route::get('absensi/{scheduleId}', ScheduleAttendance::class)->name('schedules.attendance');
    Route::get('absensi', AttendanceReport::class)->name('absensi');
    
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
