<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Beranda')]
#[Layout('layouts.main')]

class Home extends Component
{
    public function render()
    {
        return view('livewire.main.home');
    }
}
