<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Schedule;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function getMemberCountProperty()
    {
        return User::count();
    }

    public function getWeeklySchedulesProperty()
    {
        // Get schedules for current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        return Schedule::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->groupBy(function($schedule) {
                return Carbon::parse($schedule->date)->format('l'); // Day name
            });
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'memberCount' => $this->memberCount,
            'weeklySchedules' => $this->weeklySchedules,
        ]);
    }
}
