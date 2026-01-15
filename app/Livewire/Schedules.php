<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\Attendance;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('HMIF UNMA | Jadwal Kegiatan')]
#[Layout('components.layouts.app')]
class Schedules extends Component
{
    public $schedules;
    public $showModal = false;
    public $modalTitle = '';
    public $scheduleId = null;
    public $name = '';
    public $description = '';
    public $date = '';
    public $start_time = '';
    public $location = '';
    public $has_attendance = true;
    public $search = '';
    public $filter = 'all';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'location' => 'required|string|max:255',
        'has_attendance' => 'boolean',
    ];

    public function mount()
    {
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $query = Schedule::with(['attendances.user.position', 'attendances.user.department']);

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply date filter
        if ($this->filter === 'week') {
            $query->whereBetween('date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } elseif ($this->filter === 'month') {
            $query->whereMonth('date', Carbon::now()->month)
                  ->whereYear('date', Carbon::now()->year);
        }

        $this->schedules = $query->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->loadSchedules();
    }

    public function updatedSearch()
    {
        $this->loadSchedules();
    }

    public function openCreateModal()
    {
        $this->reset(['scheduleId', 'name', 'description', 'date', 'start_time', 'location', 'has_attendance']);
        $this->has_attendance = true;
        $this->modalTitle = 'Tambah Kegiatan';
        $this->showModal = true;
    }

    public function openEditModal($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        
        $this->scheduleId = $schedule->id;
        $this->name = $schedule->name;
        $this->description = $schedule->description;
        $this->date = $schedule->date->format('Y-m-d');
        $this->start_time = $schedule->start_time->format('H:i');
        $this->location = $schedule->location;
        $this->has_attendance = $schedule->has_attendance;
        
        $this->modalTitle = 'Edit Kegiatan';
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'date' => $this->date,
            'start_time' => Carbon::createFromFormat('Y-m-d H:i', $this->date . ' ' . $this->start_time),
            'location' => $this->location,
            'has_attendance' => $this->has_attendance,
        ];

        if ($this->scheduleId) {
            // Update existing schedule
            $schedule = Schedule::findOrFail($this->scheduleId);
            $oldHasAttendance = $schedule->has_attendance;
            
            Schedule::where('id', $this->scheduleId)->update($data);
            
            // If attendance was enabled but now disabled, delete attendance records
            if ($oldHasAttendance && !$this->has_attendance) {
                Attendance::where('schedule_id', $this->scheduleId)->delete();
            }
            // If attendance was disabled but now enabled, create attendance records
            elseif (!$oldHasAttendance && $this->has_attendance) {
                $users = User::all();
                foreach ($users as $user) {
                    Attendance::create([
                        'user_id' => $user->id,
                        'schedule_id' => $this->scheduleId,
                        'status' => 'Alfa',
                    ]);
                }
            }
            
            session()->flash('message', 'Kegiatan berhasil diupdate!');
        } else {
            // Create new schedule
            $schedule = Schedule::create($data);
            
            // Create attendance records only if has_attendance is true
            if ($this->has_attendance) {
                $users = User::all();
                foreach ($users as $user) {
                    Attendance::create([
                        'user_id' => $user->id,
                        'schedule_id' => $schedule->id,
                        'status' => 'Alfa',
                    ]);
                }
            }
            
            session()->flash('message', 'Kegiatan berhasil ditambahkan!');
        }

        $this->closeModal();
        $this->loadSchedules();
    }

    public function delete($scheduleId)
    {
        try {
            $schedule = Schedule::findOrFail($scheduleId);
            $schedule->delete();
            
            $this->dispatch('swal:success', ['message' => 'Kegiatan berhasil dihapus!']);
            $this->loadSchedules();
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Gagal menghapus kegiatan. Silakan coba lagi.']);
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['scheduleId', 'name', 'description', 'date', 'start_time', 'location', 'has_attendance']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.schedules');
    }
}
