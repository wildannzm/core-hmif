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
        return view('livewire.main.structure', [
            'seoTitle' => 'Struktur Organisasi HMIF UNMA | Kabinet Vistara Abhiyasa 2025',
            'seoDescription' => 'Struktur Organisasi dan Kepengurusan HMIF Universitas Majalengka Kabinet Vistara Abhiyasa Periode 2025. Kenali BPH dan departemen kami: LITBANG, DANUS, EKSTERNAL, dan KOMINFO.',
            'seoKeywords' => 'Struktur HMIF UNMA, Kepengurusan HMIF, Kabinet Vistara Abhiyasa, BPH HMIF, LITBANG, DANUS, EKSTERNAL, KOMINFO, Organisasi Mahasiswa Informatika'
        ]);
    }
}
