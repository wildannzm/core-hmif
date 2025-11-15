<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Schedule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Dashboard')]
#[Layout('components.layouts.app')]
class Dashboard extends Component
{
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
