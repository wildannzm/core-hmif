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
        return view('livewire.main.community', [
            'seoTitle' => 'Komunitas HMIF UNMA | KPM, Infordia, Windstand Robotics',
            'seoDescription' => 'Bergabunglah dengan komunitas HMIF UNMA: KPM (Komunitas Pemrograman), Infordia (Multimedia), dan Windstand Robotics. Kembangkan skill programming, desain grafis, animasi, robotika, dan IoT bersama kami.',
            'seoKeywords' => 'Komunitas HMIF, KPM HMIF, Infordia, Windstand Robotics, Komunitas Programming, Web Development, Mobile App, AI Machine Learning, Desain Grafis, Animasi, Photography, Videography, Robotika, IoT, Internet of Things'
        ]);
    }
}
