<?php

namespace App\Livewire\Attendance;

use Carbon\Carbon;
use App\Models\Schedule;
use Livewire\Component;
use App\Models\Attendance;
use Livewire\Attributes\On;

class AttendanceModal extends Component
{
    public $show = false;
    public $schedule;
    public $attendances = [];
    public $editingAttendance = null;
    public $editStatus = '';
    public $editNotes = '';
    public $editTapTime = '';

    protected $rules = [
        'editStatus' => 'required|in:Hadir,Sakit,Izin,Alfa',
        'editNotes' => 'nullable|string|max:500',
        'editTapTime' => 'nullable|date_format:H:i',
    ];

    #[On('open-attendance-modal')]
    public function openModal($scheduleId)
    {
        $this->schedule = Schedule::with(['attendances.user.position', 'attendances.user.department'])
            ->findOrFail($scheduleId);
        
        // Sort attendances by position order (Ketua to Kominfo)
        $positionOrder = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'];
        
        $this->attendances = $this->schedule->attendances->sortBy(function ($attendance) use ($positionOrder) {
            $position = $attendance->user->position->name ?? '';
            $index = array_search($position, $positionOrder);
            return $index !== false ? $index : 999; // Put unknown positions at the end
        })->values();

        $this->show = true;
    }

    public function closeModal()
    {
        $this->show = false;
        $this->reset(['schedule', 'attendances', 'editingAttendance', 'editStatus', 'editNotes', 'editTapTime']);
    }

    public function startEdit($attendanceId)
    {
        $attendance = collect($this->attendances)->firstWhere('id', $attendanceId);
        
        $this->editingAttendance = $attendanceId;
        $this->editStatus = $attendance['status'];
        $this->editNotes = $attendance['notes'] ?? '';
        $this->editTapTime = $attendance['tap_time'] ? Carbon::parse($attendance['tap_time'])->format('H:i') : '';
    }

    public function saveEdit()
    {
        $this->validate();
        
        $attendance = Attendance::findOrFail($this->editingAttendance);
        
        $tapTime = null;
        if ($this->editTapTime && $this->editStatus === 'Hadir') {
            $tapTime = Carbon::createFromFormat('Y-m-d H:i', 
                $this->schedule->date->format('Y-m-d') . ' ' . $this->editTapTime);
        }

        // Calculate lateness if present
        $latenessDuration = 0;
        if ($tapTime && $this->editStatus === 'Hadir') {
            $scheduledTime = $this->schedule->start_time;
            if ($tapTime->gt($scheduledTime)) {
                $latenessDuration = $tapTime->diffInMinutes($scheduledTime);
                
                // Auto add lateness note if more than 15 minutes late
                if ($latenessDuration > 15 && empty($this->editNotes)) {
                    $this->editNotes = "Terlambat {$latenessDuration} menit";
                }
            }
        }

        $attendance->update([
            'status' => $this->editStatus,
            'notes' => $this->editNotes,
            'tap_time' => $tapTime,
            'lateness_duration_minutes' => $latenessDuration,
        ]);

        // Refresh the modal data
        $this->openModal($this->schedule->id);
        $this->cancelEdit();
        
        // Emit event to refresh parent component
        $this->dispatch('attendance-updated');
        
        session()->flash('message', 'Absensi berhasil diupdate!');
    }

    public function cancelEdit()
    {
        $this->reset(['editingAttendance', 'editStatus', 'editNotes', 'editTapTime']);
        $this->resetValidation();
    }

    public function getStatusColorClass($status)
    {
        return match($status) {
            'Hadir' => 'bg-green-100 text-green-800 border-green-200',
            'Sakit' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'Izin' => 'bg-blue-100 text-blue-800 border-blue-200',
            'Alfa' => 'bg-red-100 text-red-800 border-red-200',
            default => 'bg-gray-100 text-gray-800 border-gray-200'
        };
    }

    public function getNotesColorClass($notes, $lateness)
    {
        if ($lateness > 15 || str_contains(strtolower($notes), 'terlambat')) {
            return 'text-red-600 font-medium';
        }
        return 'text-gray-600';
    }

    public function render()
    {
        return view('livewire.attendance.attendance-modal');
    }
}
