<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Profil')]
#[Layout('components.layouts.app')]
class Profile extends Component
{
    public function render()
    {
        return view('livewire.settings.profile');
    }
}
