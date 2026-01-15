<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Position;
use App\Models\Department;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;


#[Title('Departemen & Jabatan')]
#[Layout('components.layouts.app')]
class Departments extends Component
{
    use WithPagination;

    public $name = '';
    public $selectedDepartmentId = null;
    public $showModal = false;
    public $isEditing = false;
    public $search = '';
    public $activeTab = 'departments';
    
    // Position fields
    public $positionName = '';
    public $showPositionModal = false;
    public $selectedPositionId = null;
    public $isEditingPosition = false;
    public $selectedDepartmentForPosition = null;

    protected $rules = [
        'name' => 'required|min:3|max:255',
    ];

    protected $positionRules = [
        'positionName' => 'required|min:3|max:255',
    ];

    public function render()
    {
        $departments = collect();
        $positions = collect();

        if ($this->activeTab === 'departments') {
            // Define custom department order as requested
            // Order: LITBANG, EKSTERNAL, DANUS, KOMINFO (BPH excluded as it's not a department)
            $departmentOrder = [
                'LITBANG' => 1,
                'EKSTERNAL' => 2,
                'DANUS' => 3,
                'KOMINFO' => 4
            ];

            // Get all departments and apply custom sorting using DB orderByRaw
            // Hide HMIF (admin only) and Badan Pengurus Harian (not a department)
            $departments = Department::query()
                ->whereNotIn('name', ['HMIF', 'Badan Pengurus Harian'])
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderByRaw("
                    CASE name
                        WHEN 'LITBANG' THEN 1
                        WHEN 'EKSTERNAL' THEN 2
                        WHEN 'DANUS' THEN 3
                        WHEN 'KOMINFO' THEN 4
                        ELSE 999
                    END
                ")
                ->paginate(10);
        } else {
            // Define custom position order as requested  
            // Order: Ketua, Wakil Ketua, Sekertaris, Bendahara, Koordinator, Anggota
            // Note: Both "Kordinator" and "Koordinator" are handled for flexibility
            $positions = Position::query()
                ->where('name', '!=', 'administrator') // Hide administrator position (admin only)
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderByRaw("
                    CASE name
                        WHEN 'Ketua' THEN 1
                        WHEN 'Wakil Ketua' THEN 2
                        WHEN 'Sekertaris' THEN 3
                        WHEN 'Bendahara' THEN 4
                        WHEN 'Kordinator' THEN 5
                        WHEN 'Koordinator' THEN 5
                        WHEN 'Anggota' THEN 6
                        ELSE 999
                    END
                ")
                ->paginate(10);
        }

        return view('livewire.departments', [
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->selectedDepartmentId = null;
        $this->isEditing = false;
        $this->resetErrorBag();
    }

    public function store()
    {
        // Custom validation to prevent admin-only names
        if (strtolower($this->name) === 'hmif') {
            $this->addError('name', 'Nama "HMIF" tidak dapat digunakan karena khusus untuk admin.');
            return;
        }

        $this->validate();

        Department::create([
            'name' => $this->name,
        ]);

        $this->closeModal();
        session()->flash('message', 'Departemen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $this->selectedDepartmentId = $id;
        $this->name = $department->name;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->update();
        } else {
            $this->store();
        }
    }

    public function update()
    {
        // Custom validation to prevent admin-only names
        if (strtolower($this->name) === 'hmif') {
            $this->addError('name', 'Nama "HMIF" tidak dapat digunakan karena khusus untuk admin.');
            return;
        }

        $this->validate();

        $department = Department::findOrFail($this->selectedDepartmentId);
        $department->update([
            'name' => $this->name,
        ]);

        $this->closeModal();
        session()->flash('message', 'Departemen berhasil diperbarui!');
    }

    public function delete($id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();
            
            $this->dispatch('swal:success', ['message' => 'Departemen berhasil dihapus!']);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Gagal menghapus departemen. Silakan coba lagi.']);
        }
    }

    // Position methods
    public function openPositionModal()
    {
        $this->resetPositionForm();
        $this->showPositionModal = true;
    }

    public function closePositionModal()
    {
        $this->showPositionModal = false;
        $this->resetPositionForm();
    }

    public function resetPositionForm()
    {
        $this->positionName = '';
        $this->selectedPositionId = null;
        $this->isEditingPosition = false;
        $this->selectedDepartmentForPosition = null;
        $this->resetErrorBag(['positionName']);
    }

    public function storePosition()
    {
        // Custom validation to prevent admin-only names
        if (strtolower($this->positionName) === 'administrator') {
            $this->addError('positionName', 'Nama "Administrator" tidak dapat digunakan karena khusus untuk admin.');
            return;
        }

        $this->validate($this->positionRules);

        Position::create([
            'name' => $this->positionName,
        ]);

        $this->closePositionModal();
        session()->flash('message', 'Jabatan berhasil ditambahkan!');
    }

    public function editPosition($positionId)
    {
        $position = Position::findOrFail($positionId);
        $this->selectedPositionId = $positionId;
        $this->positionName = $position->name;
        $this->isEditingPosition = true;
        $this->showPositionModal = true;
    }

    public function updatePosition()
    {
        // Custom validation to prevent admin-only names
        if (strtolower($this->positionName) === 'administrator') {
            $this->addError('positionName', 'Nama "Administrator" tidak dapat digunakan karena khusus untuk admin.');
            return;
        }

        $this->validate($this->positionRules);

        $position = Position::findOrFail($this->selectedPositionId);
        $position->update([
            'name' => $this->positionName,
        ]);

        $this->closePositionModal();
        session()->flash('message', 'Jabatan berhasil diperbarui!');
    }

    public function savePosition()
    {
        if ($this->isEditingPosition) {
            $this->updatePosition();
        } else {
            $this->storePosition();
        }
    }

    public function deletePosition($id)
    {
        try {
            $position = Position::findOrFail($id);
            $position->delete();
            
            $this->dispatch('swal:success', ['message' => 'Jabatan berhasil dihapus!']);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Gagal menghapus jabatan. Silakan coba lagi.']);
        }
    }
}
