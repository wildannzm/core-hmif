<?php

namespace App\Livewire;

use App\Models\Finance as FinanceModel;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Barryvdh\DomPDF\Facade\Pdf;

#[Title('HMIF UNMA | Keuangan')]
#[Layout('components.layouts.app')]
class Finance extends Component
{
    use WithPagination;
    
    public $search = '';
    public $perPage = 10;
    public $sortField = 'transaction_date';
    public $sortDirection = 'asc';
    public $filterType = '';
    public $filterPeriod = 'all';
    
    // Keep these properties in sync
    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterPeriod' => ['except' => 'all'],
    ];
    
    // Form properties
    public $showModal = false;
    public $editingId = null;
    public $type = 'income';
    public $description = '';
    public $amount = '';
    public $transaction_date = '';
    public $funding_source = '';
    
    // Financial summary
    public $totalIncome = 0;
    public $totalExpense = 0;
    public $balance = 0;
    
    // Chart data
    public $chartLabels = [];
    public $chartIncomeData = [];
    public $chartExpenseData = [];
    
    protected $rules = [
        'type' => 'required|in:income,expense',
        'description' => 'required|string|max:500',
        'amount' => 'required|numeric|min:0',
        'transaction_date' => 'required|date',
        'funding_source' => 'required|string|max:255',
    ];
    
    protected $messages = [
        'type.required' => 'Jenis transaksi wajib dipilih.',
        'description.required' => 'Deskripsi wajib diisi.',
        'amount.required' => 'Jumlah wajib diisi.',
        'amount.numeric' => 'Jumlah harus berupa angka.',
        'amount.min' => 'Jumlah tidak boleh negatif.',
        'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
        'funding_source.required' => 'Sumber dana wajib diisi.',
    ];
    
    public function mount()
    {
        $this->calculateSummary();

    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatedFilterType()
    {
        $this->resetPage();
    }
    
    public function updatedFilterPeriod()
    {
        $this->resetPage();
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
    
    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->transaction_date = now()->format('Y-m-d');
    }
    
    public function openEditModal($id)
    {
        $finance = FinanceModel::findOrFail($id);
        $this->editingId = $id;
        $this->type = $finance->type;
        $this->description = $finance->description;
        $this->amount = $finance->amount;
        $this->transaction_date = $finance->transaction_date->format('Y-m-d');
        $this->funding_source = $finance->funding_source;
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
    
    public function resetForm()
    {
        $this->editingId = null;
        $this->type = 'income';
        $this->description = '';
        $this->amount = '';
        $this->transaction_date = '';
        $this->funding_source = '';
        $this->resetErrorBag();
    }
    
    public function save()
    {
        $this->validate();
        
        try {
            $data = [
                'type' => $this->type,
                'description' => $this->description,
                'amount' => (float) $this->amount,
                'transaction_date' => $this->transaction_date,
                'funding_source' => $this->funding_source,
            ];
            
            if ($this->editingId) {
                $finance = FinanceModel::findOrFail($this->editingId);
                $finance->update($data);
                session()->flash('message', 'Data keuangan berhasil diupdate.');
            } else {
                FinanceModel::create($data);
                session()->flash('message', 'Data keuangan berhasil ditambahkan.');
            }
            
            $this->closeModal();
            $this->calculateSummary();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function delete($id)
    {
        try {
            $finance = FinanceModel::findOrFail($id);
            $finance->delete();
            
            $this->calculateSummary();
            session()->flash('message', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function exportReport()
    {
        try {
            // Build query based on current filters
            $query = FinanceModel::query();
            
            // Apply search filter
            if ($this->search) {
                $query->where(function($q) {
                    $q->where('description', 'like', '%' . $this->search . '%')
                      ->orWhere('funding_source', 'like', '%' . $this->search . '%');
                });
            }
            
            // Apply type filter
            if ($this->filterType) {
                $query->where('type', $this->filterType);
            }
            
            // Apply period filter
            if ($this->filterPeriod !== 'all') {
                $now = Carbon::now();
                switch ($this->filterPeriod) {
                    case 'today':
                        $query->whereDate('transaction_date', $now->toDateString());
                        break;
                    case 'week':
                        $query->whereBetween('transaction_date', [$now->startOfWeek(), $now->endOfWeek()]);
                        break;
                    case 'month':
                        $query->whereMonth('transaction_date', $now->month)
                              ->whereYear('transaction_date', $now->year);
                        break;
                    case 'year':
                        $query->whereYear('transaction_date', $now->year);
                        break;
                }
            }
            
            // Get all transactions (not paginated for PDF)
            $transactions = $query->orderBy('transaction_date', 'asc')->get();
            
            // Calculate totals
            $totalIncome = $transactions->where('type', 'income')->sum('amount');
            $totalExpense = $transactions->where('type', 'expense')->sum('amount');
            $balance = $totalIncome - $totalExpense;
            
            // Determine report title based on filter
            $title = 'Laporan Keuangan HMIF Periode 2025/2026';
            if ($this->filterType === 'income') {
                $title = 'Laporan Keuangan Pemasukan HMIF Periode 2025/2026';
            } elseif ($this->filterType === 'expense') {
                $title = 'Laporan Keuangan Pengeluaran HMIF Periode 2025/2026';
            }
            
            // Determine filename based on filter
            $filename = 'laporan-keuangan-';
            if ($this->filterType === 'income') {
                $filename .= 'pemasukan-';
            } elseif ($this->filterType === 'expense') {
                $filename .= 'pengeluaran-';
            }
            $filename .= date('Y-m-d') . '.pdf';
            
            // Generate PDF
            $pdf = Pdf::loadView('pdf.finance-report', [
                'transactions' => $transactions,
                'title' => $title,
                'filter_type' => $this->filterType,
                'show_type_column' => empty($this->filterType), // Only show type column when no filter
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $balance,
                'generated_at' => now()->locale('id')->translatedFormat('d F Y H:i')
            ]);
            
            // Use JavaScript to trigger download
            $this->dispatch('download-pdf', [
                'url' => 'data:application/pdf;base64,' . base64_encode($pdf->output()),
                'filename' => $filename
            ]);
            
            $this->dispatch('swal:success', ['message' => 'Laporan PDF berhasil diunduh']);
            
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['message' => 'Gagal mengekspor laporan: ' . $e->getMessage()]);
        }
    }
    
    private function calculateSummary()
    {
        $this->totalIncome = FinanceModel::where('type', 'income')->sum('amount');
        $this->totalExpense = FinanceModel::where('type', 'expense')->sum('amount');
        $this->balance = $this->totalIncome - $this->totalExpense;
    }
    
    public function render()
    {
        // Always ensure we have fresh summary data
        $this->calculateSummary();
        
        // Always prepare transactions regardless of active tab
        $query = FinanceModel::query();
        
        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                  ->orWhere('funding_source', 'like', '%' . $this->search . '%');
            });
        }
        
        // Apply type filter
        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }
        
        // Apply period filter
        if ($this->filterPeriod !== 'all') {
            $startDate = match($this->filterPeriod) {
                'today' => now()->startOfDay(),
                'week' => now()->startOfWeek(),
                'month' => now()->startOfMonth(),
                'year' => now()->startOfYear(),
                default => null
            };
            
            if ($startDate) {
                $query->where('transaction_date', '>=', $startDate);
            }
        }
        
        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);
        
        // Get paginated results - always get transactions for both tabs
        $transactions = $query->paginate($this->perPage);
        
        // Debug: Check if we have transactions
        if ($transactions->isEmpty() && !$this->search && !$this->filterType && $this->filterPeriod === 'all') {
            // If no transactions and no filters, check if there are any records in DB
            $totalCount = FinanceModel::count();
            if ($totalCount > 0) {
                // There are records but pagination might be off, reset to page 1
                $this->resetPage();
                $transactions = $query->paginate($this->perPage);
            }
        }
        
        // Transform for compatibility with view
        $transactions->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'transaction_type' => $item->type,
                'description' => $item->description,
                'amount' => $item->amount,
                'transaction_date' => $item->transaction_date->format('Y-m-d'),
                'funding_source' => $item->funding_source
            ];
        });
        
        return view('livewire.finance', compact('transactions'));
    }
    
    public function resetSearch()
    {
        $this->search = '';
        $this->resetPage();
    }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->filterType = '';
        $this->filterPeriod = 'all';
        $this->resetPage();
    }
    
    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', $id);
    }

    // Method to force refresh data

}