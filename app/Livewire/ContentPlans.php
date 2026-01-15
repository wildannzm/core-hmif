<?php

namespace App\Livewire;

use App\Models\ContentPlan;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Content Plan')]
#[Layout('components.layouts.app')]
class ContentPlans extends Component
{
    use WithPagination;
    
    public $search = '';
    public $perPage = 10;
    public $filterMonth; // Default dinamis berdasarkan bulan sekarang
    public $filterYear;  // Default dinamis berdasarkan tahun sekarang
    
    protected $queryString = [
        'search' => ['except' => ''],
        'filterMonth' => ['except' => ''],
        'filterYear' => ['except' => ''],
    ];
    
    // Form properties
    public $showModal = false;
    public $editingId = null;
    
    // Detail modal properties
    public $showDetailModal = false;
    public $detailPlan = null;
    public $publish_date = '';
    public $title = '';
    public $pillar = '';
    public $reference = '';
    public $content_type = '';
    public $goals = '';
    public $executor_id = null;
    public $result_url = '';
    public $publisher_id = null;
    public $caption = '';
    public $status = null;
    public $revision_notes = '';
    
    protected function rules()
    {
        return [
            'publish_date' => 'required|date',
            'title' => 'required|string|max:255',
            'pillar' => 'required|string|max:255',
            'reference' => 'nullable|string',
            'content_type' => 'required|string|max:255',
            'goals' => 'nullable|string|max:255',
            'executor_id' => 'nullable|exists:users,id',
            'result_url' => 'nullable|string|max:255',
            'publisher_id' => 'nullable|exists:users,id',
            'caption' => 'nullable|string',
            'status' => 'nullable|in:Progress,Approved,Revision,Declined',
            'revision_notes' => 'nullable|string',
        ];
    }
    
    public function mount()
    {
        // Access check is now handled by middleware
        // Set default filter ke bulan dan tahun sekarang
        $this->filterMonth = now()->format('n'); // 1-12 format
        $this->filterYear = now()->format('Y');
    }
    
    public function render()
    {
        $query = ContentPlan::query()
            ->with(['executor', 'publisher']);
        
        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('pillar', 'like', '%' . $this->search . '%')
                  ->orWhere('content_type', 'like', '%' . $this->search . '%')
                  ->orWhere('goals', 'like', '%' . $this->search . '%')
                  ->orWhere('caption', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply filters berdasarkan bulan dan tahun
        if ($this->filterMonth && $this->filterYear) {
            $query->whereYear('publish_date', $this->filterYear)
                  ->whereMonth('publish_date', $this->filterMonth);
        } elseif ($this->filterYear) {
            $query->whereYear('publish_date', $this->filterYear);
        } elseif ($this->filterMonth) {
            $query->whereMonth('publish_date', $this->filterMonth);
        }
        
        // Default ordering by publish_date descending
        $query->orderBy('publish_date', 'asc');
        
        $contentPlans = $query->paginate($this->perPage);
        $kominfoUsers = User::whereHas('department', function ($q) {
            $q->where('name', 'like', '%kominfo%');
        })->get();
        
        return view('livewire.content-plans', compact('contentPlans', 'kominfoUsers'));
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingFilterMonth()
    {
        $this->resetPage();
    }
    
    public function updatingFilterYear()
    {
        $this->resetPage();
    }
    
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }
    
    public function edit($id)
    {
        // Close detail modal if open
        $this->closeDetailModal();
        
        $contentPlan = ContentPlan::findOrFail($id);
        
        $this->editingId = $id;
        $this->publish_date = $contentPlan->publish_date?->format('Y-m-d');
        $this->title = $contentPlan->title;
        $this->pillar = $contentPlan->pillar;
        $this->reference = $contentPlan->reference;
        $this->content_type = $contentPlan->content_type;
        $this->goals = $contentPlan->goals;
        $this->executor_id = $contentPlan->executor_id;
        $this->result_url = $contentPlan->result_url;
        $this->publisher_id = $contentPlan->publisher_id;
        $this->caption = $contentPlan->caption;
        $this->status = $contentPlan->status;
        $this->revision_notes = $contentPlan->revision_notes;
        
        $this->showModal = true;
    }
    
    public function save()
    {
        $this->validate();
        
        $data = [
            'publish_date' => $this->publish_date,
            'title' => $this->title,
            'pillar' => $this->pillar,
            'reference' => $this->reference,
            'content_type' => $this->content_type,
            'goals' => $this->goals,
            'executor_id' => $this->executor_id,
            'result_url' => $this->result_url,
            'publisher_id' => $this->publisher_id,
            'caption' => $this->caption,
            'status' => $this->status ?: null,
            'revision_notes' => $this->revision_notes,
        ];
        
        if ($this->editingId) {
            ContentPlan::findOrFail($this->editingId)->update($data);
            session()->flash('success', 'Content plan berhasil diperbarui!');
        } else {
            ContentPlan::create($data);
            session()->flash('success', 'Content plan berhasil dibuat!');
        }
        
        $this->resetForm();
        $this->showModal = false;
    }
    
    public function delete($id)
    {
        ContentPlan::findOrFail($id)->delete();
        session()->flash('success', 'Content plan berhasil dihapus!');
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
    
    public function showDetail($id)
    {
        try {
            $this->detailPlan = ContentPlan::with(['executor', 'publisher'])->findOrFail($id);
            $this->showDetailModal = true;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            session()->flash('error', 'Content Plan tidak ditemukan.');
            $this->detailPlan = null;
            $this->showDetailModal = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengambil data.');
            $this->detailPlan = null;
            $this->showDetailModal = false;
        }
    }
    
    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailPlan = null;
    }
    
    private function resetForm()
    {
        $this->editingId = null;
        $this->publish_date = '';
        $this->title = '';
        $this->pillar = '';
        $this->reference = '';
        $this->content_type = '';
        $this->goals = '';
        $this->executor_id = null;
        $this->result_url = '';
        $this->publisher_id = null;
        $this->caption = '';
        $this->status = null;
        $this->revision_notes = '';
        
        $this->resetValidation();
    }
}