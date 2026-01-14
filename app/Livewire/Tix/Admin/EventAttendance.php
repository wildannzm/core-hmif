<?php

namespace App\Livewire\Tix\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Kehadiran Event')]
#[Layout('components.layouts.app')]
class EventAttendance extends Component
{
    public function render()
    {
        return view('livewire.tix.admin.event-attendance');
    }
}
