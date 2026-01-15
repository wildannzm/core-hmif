<?php

namespace App\Livewire\Tix\User;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Detail Event')]
#[Layout('layouts.tix')]
class DetailEvent extends Component
{
    public Event $event;

    public function mount(string $slug): void
    {
        $this->event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Security: Check if event is valid for viewing
        if (!$this->event->is_active) {
            abort(404, 'Event tidak ditemukan atau tidak aktif.');
        }
    }

    public function render()
    {
        return view('livewire.tix.user.detail-event');
    }
}
