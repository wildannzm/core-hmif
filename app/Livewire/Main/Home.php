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
        return view('livewire.main.home', [
            'seoTitle' => 'HMIF UNMA - Himpunan Mahasiswa Informatika Universitas Majalengka',
            'seoDescription' => 'Website resmi Himpunan Mahasiswa Informatika (HMIF) Universitas Majalengka. Bergabunglah dengan komunitas mahasiswa IT terbaik untuk mengembangkan skill programming, desain, dan robotika.',
            'seoKeywords' => 'HMIF UNMA, Himpunan Mahasiswa Informatika, Universitas Majalengka, Mahasiswa Informatika, Programming, Web Development, Mobile App, AI, Machine Learning, Desain Grafis, Robotika, IoT, KPM, Infordia, Windstand'
        ]);
    }
}
