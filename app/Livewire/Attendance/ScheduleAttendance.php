<?php

namespace App\Livewire\Attendance;

use Carbon\Carbon;
use App\Models\Schedule;
use Livewire\Component;
use App\Models\Attendance;

class ScheduleAttendance extends Component
{
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

    public function mount($scheduleId)
    {
        $this->schedule = Schedule::findOrFail($scheduleId);
        
        // Check if schedule has attendance enabled
        if (!$this->schedule->has_attendance) {
            abort(404, 'Kegiatan ini tidak memiliki absensi.');
        }
        
        $this->loadAttendances();
    }

    public function loadAttendances()
    {
        // Sort attendances by position order (Ketua to Kominfo, then others)
        $positionOrder = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'];
        
        $this->attendances = $this->schedule->attendances()
            ->with(['user.position', 'user.department'])
            ->get()
            ->sortBy(function ($attendance) use ($positionOrder) {
                $position = $attendance->user->position->name ?? '';
                $department = $attendance->user->department->name ?? '';
                
                // Normalize position for sorting
                $normalizedPosition = $position;
                if ($position === 'Sekertaris') {
                    $normalizedPosition = 'Sekretaris';
                }
                
                // BPH positions get priority in sorting
                if ($department === 'Badan Pengurus Harian' || $department === 'BPH') {
                    $index = array_search($normalizedPosition, $positionOrder);
                    return $index !== false ? $index : 10; // BPH but unknown position
                }
                
                
                // Regular members last
                return 999;
            })
            ->values();
    }

    public function startEdit($attendanceId)
    {
        $attendance = Attendance::with(['user.position', 'user.department'])->findOrFail($attendanceId);
        
        $this->editingAttendance = $attendanceId;
        $this->editStatus = $attendance->status;
        $this->editNotes = $attendance->notes ?? '';
        $this->editTapTime = $attendance->tap_time ? Carbon::parse($attendance->tap_time)->format('H:i') : '';
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

        // Refresh the data
        $this->loadAttendances();
        $this->cancelEdit();
        
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

    public function getNotesColorClass($notes, $lateness_duration_minutes)
    {
        if ($lateness_duration_minutes > 0) {
            return 'text-red-600 font-medium';
        }
        
        return 'text-gray-600';
    }

    public function getPositionText($user)
    {
        $position = $user->position->name ?? 'Anggota';
        $department = $user->department->name ?? '';
        
        // Definisi jabatan BPH yang benar (termasuk variasi ejaan)
        $bphPositions = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Sekertaris', 'Bendahara', 'Kominfo'];
        
        // Cek apakah user adalah BPH (baik dari position maupun department)
        $isBPH = in_array($position, $bphPositions) || 
                 $department === 'Badan Pengurus Harian' ||
                 $department === 'BPH';
        
        // Jika adalah BPH, return posisi dengan normalisasi ejaan
        if ($isBPH) {
            // Normalisasi ejaan Sekertaris menjadi Sekretaris
            if ($position === 'Sekertaris') {
                return 'Sekretaris';
            }
            // Jika posisi ada dalam list BPH, return sebagaimana mestinya
            if (in_array($position, $bphPositions)) {
                return $position;
            }
            // Jika department BPH tapi position tidak dikenali, tampilkan position asli
            return $position;
        }
        
        // Untuk koordinator departemen (bukan BPH), tampilkan "Koordinator + Department"
        if ($position === 'Koordinator' && $department && !in_array($department, ['HMIF', 'Badan Pengurus Harian', 'BPH'])) {
            return "Koordinator {$department}";
        }
        
        // Jika bukan BPH dan ada department selain HMIF/BPH, tampilkan Anggota + Department
        if ($department && !in_array($department, ['HMIF', 'Badan Pengurus Harian', 'BPH'])) {
            return "Anggota {$department}";
        }
        
        // Default untuk anggota biasa
        return 'Anggota';
    }

    public function render()
    {
        return view('livewire.attendance.schedule-attendance');
    }
}
