<?php

namespace App\Livewire\Tix\User;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Cari Event Seru')]
#[Layout('layouts.tix')]
class TixHome extends Component
{
    use WithPagination;

    public string $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $events = Event::query()
            ->where('is_active', true)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('event_start_date', 'desc')
            ->paginate(12);

        return view('livewire.tix.user.tix-home', [
            'events' => $events,
        ]);
    }
}
