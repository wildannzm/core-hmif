<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Komunitas')]
#[Layout('layouts.main')]

class Community extends Component
{
    public function render()
    {
        return view('livewire.main.community');
    }
}
