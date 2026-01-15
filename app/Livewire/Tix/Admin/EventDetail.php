<?php

namespace App\Livewire\Tix\Admin;

use App\Models\Event as EventModel;
use App\Models\EventOrder;
use App\Models\EventAttendee;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Detail Event')]
#[Layout('components.layouts.app')]
class EventDetail extends Component
{
    public EventModel $event;
    public int $totalOrders = 0;
    public int $totalAttendance = 0;

    public function mount(int $id): void
    {
        $this->event = EventModel::findOrFail($id);
        $this->loadStats();
    }

    public function loadStats(): void
    {
        $this->totalOrders = EventOrder::where('event_id', $this->event->id)->count();
        
        // Get event attendees count using direct join to avoid relationship issues
        $this->totalAttendance = EventAttendee::join('event_orders', 'event_attendees.event_order_id', '=', 'event_orders.id')
            ->where('event_orders.event_id', $this->event->id)
            ->where('event_attendees.is_checked_in', true)
            ->count();
    }

    public function goToOrders(): void
    {
        $this->redirect(route('admin.events.orders', ['eventId' => $this->event->id]), navigate: true);
    }

    public function goToAttendance(): void
    {
        $this->redirect(route('admin.events.attendance', ['eventId' => $this->event->id]), navigate: true);
    }

    public function render()
    {
        return view('livewire.tix.admin.event-detail');
    }
}
