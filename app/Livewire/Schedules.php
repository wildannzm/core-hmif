<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Schedule;
use Livewire\Component;
use App\Models\Attendance;

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

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'location' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->schedules = Schedule::with(['attendances.user.position', 'attendances.user.department'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function openCreateModal()
    {
        $this->reset(['scheduleId', 'name', 'description', 'date', 'start_time', 'location']);
        $this->modalTitle = 'Tambah Kegiatan Baru';
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
        ];

        if ($this->scheduleId) {
            // Update existing schedule
            Schedule::where('id', $this->scheduleId)->update($data);
            session()->flash('message', 'Kegiatan berhasil diupdate!');
        } else {
            // Create new schedule
            $schedule = Schedule::create($data);
            
            // Create attendance records for all users with default status 'Alfa'
            $users = User::all();
            foreach ($users as $user) {
                Attendance::create([
                    'user_id' => $user->id,
                    'schedule_id' => $schedule->id,
                    'status' => 'Alfa',
                ]);
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
        $this->reset(['scheduleId', 'name', 'description', 'date', 'start_time', 'location']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.schedules');
    }
}
