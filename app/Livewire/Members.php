<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Livewire\Component;

class Members extends Component
{
    public $selectedMember = null;
    public $editingMember = false;
    public $showEditModal = false;
    
    // Form properties for editing
    public $editName = '';
    public $editNim = '';
    public $editEmail = '';
    public $editRfidUid = '';
    public $editDepartmentId = '';
    public $editPositionId = '';

    protected $rules = [
        'editName' => 'required|string|max:255',
        'editNim' => 'required|string|max:20|unique:users,nim',
        'editEmail' => 'required|email|unique:users,email',
        'editRfidUid' => 'nullable|string|max:255',
        'editDepartmentId' => 'required|exists:departments,id',
        'editPositionId' => 'required|exists:positions,id',
    ];

    public function mount()
    {
        // Component initialization
    }

    public function getMembersProperty()
    {
        // Get all members organized by department in the specified order
        $departmentOrder = [
            'Badan Pengurus Harian',
            'LITBANG',
            'EKSTERNAL', 
            'DANUS',
            'KOMINFO'
        ];

        $members = collect();
        
        foreach ($departmentOrder as $deptName) {
            $department = Department::where('name', $deptName)->first();
            if ($department) {
                $deptMembers = User::with(['department', 'position'])
                    ->where('department_id', $department->id)
                    ->whereDoesntHave('roles', function($query) {
                        $query->where('name', 'administrator');
                    })
                    ->get()
                    ->sortBy(function($user) {
                        // Custom sorting for BPH positions
                        if ($user->department->name === 'Badan Pengurus Harian') {
                            $positionOrder = ['Ketua', 'Wakil Ketua', 'Sekertaris', 'Bendahara'];
                            return array_search($user->position->name, $positionOrder);
                        } else {
                            // For other departments, Koordinator first, then Anggota
                            return $user->position->name === 'Koordinator' ? 0 : 1;
                        }
                    });
                
                $members->put($deptName, $deptMembers);
            }
        }

        return $members;
    }

    public function getDepartmentsProperty()
    {
        return Department::all();
    }

    public function getPositionsProperty()
    {
        return Position::all();
    }

    public function editMember($userId)
    {
        $this->resetErrorBag();
        $this->selectedMember = User::find($userId);
        
        if ($this->selectedMember) {
            $this->editName = $this->selectedMember->name;
            $this->editNim = $this->selectedMember->nim;
            $this->editEmail = $this->selectedMember->email;
            $this->editRfidUid = $this->selectedMember->rfid_uid ?? '';
            $this->editDepartmentId = $this->selectedMember->department_id;
            $this->editPositionId = $this->selectedMember->position_id;
            
            $this->showEditModal = true;
        }
    }

    public function updateMember()
    {
        if (!$this->selectedMember) {
            return;
        }

        // Update validation rules to exclude current member
        $rules = [
            'editName' => 'required|string|max:255',
            'editNim' => 'required|string|max:20|unique:users,nim,' . $this->selectedMember->id,
            'editEmail' => 'required|email|unique:users,email,' . $this->selectedMember->id,
            'editRfidUid' => 'nullable|string|max:255',
            'editDepartmentId' => 'required|exists:departments,id',
            'editPositionId' => 'required|exists:positions,id',
        ];
        
        $this->validate($rules);

        $this->selectedMember->update([
            'name' => $this->editName,
            'nim' => $this->editNim,
            'email' => $this->editEmail,
            'rfid_uid' => $this->editRfidUid ?: null,
            'department_id' => $this->editDepartmentId,
            'position_id' => $this->editPositionId,
        ]);

        $this->closeEditModal();
        session()->flash('message', 'Data anggota berhasil diperbarui!');
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->selectedMember = null;
        $this->resetForm();
        $this->resetErrorBag();
    }

    private function resetForm()
    {
        $this->editName = '';
        $this->editNim = '';
        $this->editEmail = '';
        $this->editRfidUid = '';
        $this->editDepartmentId = '';
        $this->editPositionId = '';
    }

    public function getPositionDisplayName($user)
    {
        if ($user->department->name === 'Badan Pengurus Harian') {
            return $user->position->name;
        } else {
            return $user->position->name . ' ' . $user->department->name;
        }
    }

    public function render()
    {
        return view('livewire.members', [
            'members' => $this->members,
            'departments' => $this->departments,
            'positions' => $this->positions,
        ]);
    }
}