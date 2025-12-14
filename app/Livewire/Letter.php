<?php

namespace App\Livewire;

use App\Models\IncomeLetter;
use App\Models\OutcomeLetter;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Barryvdh\DomPDF\Facade\Pdf;

#[Layout('components.layouts.app')]
#[Title('Surat Masuk & Keluar')]
class Letter extends Component
{
    use WithPagination;
    
    
    public $activeTab = 'incoming'; // 'incoming' or 'outgoing'
    public $search = '';
    public $perPage = 10;
    public $sortField = 'received_date';
    public $sortDirection = 'asc';
    public $filterPriority = '';
    public $filterStatus = '';
    
    // Form properties
    public $showModal = false;
    public $editingId = null;
    public $letter_type = 'incoming';
    public $letter_number = '';
    // Incoming letter fields
    public $received_date = '';
    public $execution_date = '';
    public $sender = '';
    public $recipient = '';
    // Outgoing letter fields
    public $letter_date = '';
    public $sent_to = '';
    public $subject = '';
    public $attachments = '';
    
    protected $rules = [
        'letter_type' => 'required|in:incoming,outgoing',
        'letter_number' => 'required|string|max:255',
        // Incoming letter validation
        'received_date' => 'required_if:letter_type,incoming|date',
        'execution_date' => 'nullable|date',
        'sender' => 'required_if:letter_type,incoming|string|max:255',
        'recipient' => 'required_if:letter_type,incoming|string|max:255',
        // Outgoing letter validation
        'letter_date' => 'required_if:letter_type,outgoing|date',
        'sent_to' => 'required_if:letter_type,outgoing|string|max:255',
        'subject' => 'required_if:letter_type,outgoing|string|max:500',
        'attachments' => 'nullable|string|max:1000',
    ];
    
    protected $messages = [
        'letter_type.required' => 'Jenis surat wajib dipilih.',
        'letter_number.required' => 'Nomor surat wajib diisi.',
        'received_date.required_if' => 'Tanggal terima wajib diisi untuk surat masuk.',
        'sender.required_if' => 'Pengirim wajib diisi untuk surat masuk.',
        'recipient.required_if' => 'Penerima wajib diisi untuk surat masuk.',
        'letter_date.required_if' => 'Tanggal surat wajib diisi untuk surat keluar.',
        'sent_to.required_if' => 'Penerima wajib diisi untuk surat keluar.',
        'subject.required_if' => 'Perihal surat wajib diisi untuk surat keluar.',
    ];
    
    public function mount()
    {
        // Determine tab based on route or query parameter
        if (request()->routeIs('surat-masuk')) {
            $this->activeTab = 'incoming';
        } elseif (request()->routeIs('surat-keluar')) {
            $this->activeTab = 'outgoing';
        } else {
            $this->activeTab = request()->get('tab', 'incoming');
        }
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatedActiveTab()
    {
        $this->resetPage();
        $this->resetFilters();
    }
    
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
        $this->resetFilters();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }
    
    public function openCreateModal($type = null)
    {
        $this->resetForm();
        $this->letter_type = $type ?? $this->activeTab;
        $this->showModal = true;
        
        if ($type === 'incoming') {
            $this->received_date = now()->format('Y-m-d');
        } else {
            $this->letter_date = now()->format('Y-m-d');
        }
    }
    
    public function openEditModal($id)
    {
        $this->resetForm();
        $this->editingId = $id;
        
        if ($this->activeTab === 'incoming') {
            $letter = IncomeLetter::find($id);
            if ($letter) {
                $this->letter_type = 'incoming';
                $this->letter_number = $letter->letter_number;
                $this->received_date = $letter->received_date?->format('Y-m-d');
                $this->execution_date = $letter->execution_date?->format('Y-m-d');
                $this->sender = $letter->sender;
                $this->recipient = $letter->recipient;
            }
        } else {
            $letter = OutcomeLetter::find($id);
            if ($letter) {
                $this->letter_type = 'outgoing';
                $this->letter_number = $letter->letter_number;
                $this->letter_date = $letter->letter_date?->format('Y-m-d');
                $this->sent_to = $letter->sent_to;
                $this->subject = $letter->subject;
                $this->attachments = $letter->attachments;
            }
        }
        
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
    
    public function save()
    {
        $this->validate();
        
        try {
            if ($this->letter_type === 'incoming') {
                $data = [
                    'letter_number' => $this->letter_number,
                    'received_date' => $this->received_date,
                    'execution_date' => $this->execution_date ?: null,
                    'sender' => $this->sender,
                    'recipient' => $this->recipient,
                ];
                
                if ($this->editingId) {
                    IncomeLetter::find($this->editingId)->update($data);
                    $message = 'Surat masuk berhasil diperbarui.';
                } else {
                    IncomeLetter::create($data);
                    $message = 'Surat masuk berhasil ditambahkan.';
                }
            } else {
                $data = [
                    'letter_number' => $this->letter_number,
                    'letter_date' => $this->letter_date,
                    'sent_to' => $this->sent_to,
                    'subject' => $this->subject,
                    'attachments' => $this->attachments,
                ];
                
                if ($this->editingId) {
                    OutcomeLetter::find($this->editingId)->update($data);
                    $message = 'Surat keluar berhasil diperbarui.';
                } else {
                    OutcomeLetter::create($data);
                    $message = 'Surat keluar berhasil ditambahkan.';
                }
            }
            
            $this->dispatch('swal:success', ['message' => $message]);
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    public function delete($id)
    {
        try {
            if ($this->activeTab === 'incoming') {
                IncomeLetter::find($id)?->delete();
                $message = 'Surat masuk berhasil dihapus.';
            } else {
                OutcomeLetter::find($id)?->delete();
                $message = 'Surat keluar berhasil dihapus.';
            }
            
            $this->dispatch('swal:success', ['message' => $message]);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    public function exportPdf()
    {
        try {
            if ($this->activeTab === 'incoming') {
                // Get all incoming letters
                $query = IncomeLetter::query();
                
                // Apply search filter if exists
                if ($this->search) {
                    $query->where(function($q) {
                        $q->where('letter_number', 'like', '%' . $this->search . '%')
                          ->orWhere('sender', 'like', '%' . $this->search . '%')
                          ->orWhere('recipient', 'like', '%' . $this->search . '%');
                    });
                }
                
                $letters = $query->orderBy('received_date', 'desc')->get();
                $title = 'Rekap Surat Masuk HMIF 2025/2026';
                $filename = 'rekap-surat-masuk-' . date('Y-m-d') . '.pdf';
                
            } else {
                // Get all outgoing letters
                $query = OutcomeLetter::query();
                
                // Apply search filter if exists
                if ($this->search) {
                    $query->where(function($q) {
                        $q->where('letter_number', 'like', '%' . $this->search . '%')
                          ->orWhere('sent_to', 'like', '%' . $this->search . '%')
                          ->orWhere('subject', 'like', '%' . $this->search . '%')
                          ->orWhere('attachments', 'like', '%' . $this->search . '%');
                    });
                }
                
                $letters = $query->orderBy('letter_date', 'desc')->get();
                $title = 'Rekap Surat Keluar HMIF 2025/2026';
                $filename = 'rekap-surat-keluar-' . date('Y-m-d') . '.pdf';
            }
            
            // Generate PDF directly
            $pdf = Pdf::loadView('pdf.letter-recap', [
                'letters' => $letters,
                'title' => $title,
                'type' => $this->activeTab,
                'generated_at' => now()->locale('id')->translatedFormat('d F Y H:i')
            ]);
            
            // Use JavaScript to trigger download
            $this->dispatch('download-pdf', [
                'url' => 'data:application/pdf;base64,' . base64_encode($pdf->output()),
                'filename' => $filename
            ]);
            
            $this->dispatch('swal:success', ['message' => 'PDF berhasil diunduh']);
            
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Gagal mengekspor PDF: ' . $e->getMessage()]);
        }
    }
    
    public function duplicate($id)
    {
        try {
            if ($this->activeTab === 'outgoing') {
                $original = OutcomeLetter::find($id);
                if ($original) {
                    $duplicate = $original->replicate();
                    $duplicate->letter_number = $this->generateUniqueLetterNumber();
                    $duplicate->save();
                    
                    $this->dispatch('swal:success', ['message' => 'Surat keluar berhasil diduplikasi.']);
                }
            }
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    public function generateLetterNumber()
    {
        $this->letter_number = $this->generateUniqueLetterNumber();
    }
    
    private function generateUniqueLetterNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        // Get next sequence number from database
        $lastLetter = OutcomeLetter::whereYear('letter_date', $year)
                                  ->whereMonth('letter_date', $month)
                                  ->orderBy('id', 'desc')
                                  ->first();
        
        $sequence = 1;
        if ($lastLetter) {
            // Extract sequence from last letter number (format: SK/XXX/MM/YYYY)
            if (preg_match('/SK\/(\d+)\//', $lastLetter->letter_number, $matches)) {
                $sequence = (int)$matches[1] + 1;
            }
        }
        
        return sprintf("SK/%03d/%s/%s", $sequence, $month, $year);
    }
    
    private function resetForm()
    {
        $this->editingId = null;
        $this->letter_type = $this->activeTab;
        $this->letter_number = '';
        // Reset incoming letter fields
        $this->received_date = '';
        $this->execution_date = '';
        $this->sender = '';
        $this->recipient = '';
        // Reset outgoing letter fields
        $this->letter_date = '';
        $this->sent_to = '';
        $this->subject = '';
        $this->attachments = '';
        $this->resetErrorBag();
    }
    
    private function resetFilters()
    {
        $this->search = '';
        $this->filterPriority = '';
        $this->filterStatus = '';
        $this->sortField = 'received_date';
        $this->sortDirection = 'asc';
    }
    

    
    public function render()
    {
        if ($this->activeTab === 'incoming') {
            $query = IncomeLetter::query();
            
            // Apply search filter
            if ($this->search) {
                $query->where(function($q) {
                    $q->where('letter_number', 'like', '%' . $this->search . '%')
                      ->orWhere('sender', 'like', '%' . $this->search . '%')
                      ->orWhere('recipient', 'like', '%' . $this->search . '%');
                });
            }
            
            // Apply sorting
            $sortField = $this->sortField === 'received_date' ? 'received_date' : $this->sortField;
            $query->orderBy($sortField, $this->sortDirection);
            
            $letters = $query->paginate($this->perPage);
            
        } else {
            $query = OutcomeLetter::query();
            
            // Apply search filter
            if ($this->search) {
                $query->where(function($q) {
                    $q->where('letter_number', 'like', '%' . $this->search . '%')
                      ->orWhere('sent_to', 'like', '%' . $this->search . '%')
                      ->orWhere('subject', 'like', '%' . $this->search . '%')
                      ->orWhere('attachments', 'like', '%' . $this->search . '%');
                });
            }
            
            // Apply sorting
            $sortField =($this->sortField === 'received_date' || $this->sortField === 'letter_date') 
                         ? 'letter_date' 
                         : $this->sortField;
            $query->orderBy($sortField, $this->sortDirection);
            
            $letters = $query->paginate($this->perPage);
        }
        
        return view('livewire.letter', compact('letters'));
    }
}
