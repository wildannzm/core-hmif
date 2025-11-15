<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Struktural')]
#[Layout('layouts.main')]

class Structure extends Component
{
    public function render()
    {
        return view('livewire.main.structure');
    }
}
