<?php

namespace App\Livewire\Tix\Admin;

use App\Models\Event as EventModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

#[Title('HMIF UNMA | Kelola Event')]
#[Layout('components.layouts.app')]
class Event extends Component
{
    use WithPagination;

    public string $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Hapus Event?',
            'text' => 'Event yang dihapus tidak dapat dikembalikan!',
        ]);
    }

    public function delete(int $id): void
    {
        try {
            // Authorization check - only BPH or Koordinator can delete
            $user = Auth::user();
            if (!$user->hasRole('bph') && 
                (!$user->position || $user->position->name !== 'Koordinator')) {
                $this->dispatch('swal:error', message: 'Anda tidak memiliki akses untuk menghapus event.');
                return;
            }
            
            $event = EventModel::findOrFail($id);
            
            // Delete banner image if exists
            if ($event->banner && Storage::disk('public')->exists($event->banner)) {
                Storage::disk('public')->delete($event->banner);
            }
            
            $event->delete();

            $this->dispatch('swal:success', message: 'Event berhasil dihapus!');
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus(int $id): void
    {
        try {
            // Authorization check - only BPH or Koordinator can toggle status
            $user = Auth::user();
            if (!$user->hasRole('bph') && 
                (!$user->position || $user->position->name !== 'Koordinator')) {
                $this->dispatch('swal:error', message: 'Anda tidak memiliki akses untuk mengubah status event.');
                return;
            }
            
            $event = EventModel::findOrFail($id);
            $event->update([
                'is_active' => !$event->is_active,
            ]);

            $status = $event->is_active ? 'diaktifkan' : 'dinonaktifkan';
            $this->dispatch('swal:success', message: "Event berhasil {$status}!");
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $events = EventModel::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.tix.admin.event', [
            'events' => $events,
        ]);
    }
}
