<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Schedule;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;

#[Title('Laporan Absensi')]
#[Layout('components.layouts.app')]
class AttendanceReport extends Component
{
    use WithPagination;

    public $search = '';
    public $dateFilter = '';
    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        Carbon::setLocale('id');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedDateFilter()
    {
        $this->resetPage();
    }

    public function exportPDF($scheduleId)
    {
        $schedule = Schedule::with(['attendances.user.position', 'attendances.user.department'])
            ->findOrFail($scheduleId);

        // Sort attendances by position order (BPH first, then coordinators, then members)
        $sortedAttendances = $schedule->attendances->sortBy(function ($attendance) {
            $position = $attendance->user->position->name ?? '';
            $department = $attendance->user->department->name ?? '';
            
            // BPH positions get priority (0-10)
            $bphPositions = ['Ketua' => 1, 'Wakil Ketua' => 2, 'Sekretaris' => 3, 'Sekertaris' => 3, 'Bendahara' => 4];
            
            if (isset($bphPositions[$position]) || $department === 'Badan Pengurus Harian' || $department === 'BPH') {
                return $bphPositions[$position] ?? 10;
            }
            
            // Regular members get lowest priority (999)
            return 999;
        });

        $data = [
            'schedule' => $schedule,
            'attendances' => $sortedAttendances,
            'exportDate' => Carbon::now()->locale('id')->translatedFormat('d F Y H:i')
        ];

        $pdf = PDF::loadView('pdf.attendance-report', $data);
        
        $filename = 'Absensi_' . str_replace(' ', '_', $schedule->name) . '_' . $schedule->date->format('Y-m-d') . '.pdf';
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function getPositionText($user)
    {
        $position = $user->position->name ?? 'Anggota';
        $department = $user->department->name ?? '';
        
        // Definisi jabatan BPH
        $bphPositions = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Sekertaris', 'Bendahara', 'Kominfo'];
        
        $isBPH = in_array($position, $bphPositions) || 
                 $department === 'Badan Pengurus Harian' ||
                 $department === 'BPH';
        
        if ($isBPH) {
            return $position === 'Sekertaris' ? 'Sekretaris' : $position;
        }
        
        if ($position === 'Koordinator' && $department && !in_array($department, ['HMIF', 'Badan Pengurus Harian', 'BPH'])) {
            return "Koordinator {$department}";
        }
        
        if ($department && !in_array($department, ['HMIF', 'Badan Pengurus Harian', 'BPH'])) {
            return "Anggota {$department}";
        }
        
        return 'Anggota';
    }

    public function render()
    {
        $query = Schedule::with(['attendances.user'])
            ->where('has_attendance', true) // Only schedules that have attendance enabled
            ->whereHas('attendances'); // Only schedules that have attendance records

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->dateFilter) {
            $query->whereDate('date', $this->dateFilter);
        }

        $schedules = $query->orderBy('date', 'desc')->paginate($this->perPage);

        return view('livewire.attendance-report', compact('schedules'));
    }
}