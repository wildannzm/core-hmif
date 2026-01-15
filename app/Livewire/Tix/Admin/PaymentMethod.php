<?php

namespace App\Livewire\Tix\Admin;

use App\Models\PaymentMethod as PaymentMethodModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('HMIF UNMA | Metode Pembayaran')]
#[Layout('components.layouts.app')]
class PaymentMethod extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $editingId = null;
    public string $bank_name = '';
    public string $account_number = '';
    public string $account_name = '';
    public bool $is_active = true;
    public string $search = '';

    protected $paginationTheme = 'tailwind';

    protected array $rules = [
        'bank_name' => 'required|string|max:255',
        'account_number' => 'required|string|max:255',
        'account_name' => 'required|string|max:255',
        'is_active' => 'boolean',
    ];

    protected $validationAttributes = [
        'bank_name' => 'nama bank',
        'account_number' => 'nomor rekening',
        'account_name' => 'nama pemilik',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $id): void
    {
        $paymentMethod = PaymentMethodModel::findOrFail($id);
        
        $this->editingId = $paymentMethod->id;
        $this->bank_name = $paymentMethod->bank_name;
        $this->account_number = $paymentMethod->account_number;
        $this->account_name = $paymentMethod->account_name;
        $this->is_active = $paymentMethod->is_active;
        
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function save(): void
    {
        $this->validate();

        try {
            if ($this->editingId) {
                $paymentMethod = PaymentMethodModel::findOrFail($this->editingId);
                $paymentMethod->update([
                    'bank_name' => $this->bank_name,
                    'account_number' => $this->account_number,
                    'account_name' => $this->account_name,
                    'is_active' => $this->is_active,
                ]);

                $message = 'Metode pembayaran berhasil diperbarui!';
            } else {
                PaymentMethodModel::create([
                    'bank_name' => $this->bank_name,
                    'account_number' => $this->account_number,
                    'account_name' => $this->account_name,
                    'is_active' => $this->is_active,
                ]);

                $message = 'Metode pembayaran berhasil ditambahkan!';
            }

            $this->closeModal();
            $this->dispatch('swal:success', message: $message);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete(int $id): void
    {
        try {
            $paymentMethod = PaymentMethodModel::findOrFail($id);
            $paymentMethod->delete();

            $this->dispatch('swal:success', message: 'Metode pembayaran berhasil dihapus!');
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus(int $id): void
    {
        try {
            $paymentMethod = PaymentMethodModel::findOrFail($id);
            $paymentMethod->update([
                'is_active' => !$paymentMethod->is_active,
            ]);

            $status = $paymentMethod->is_active ? 'diaktifkan' : 'dinonaktifkan';
            $this->dispatch('swal:success', message: "Metode pembayaran berhasil {$status}!");
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->bank_name = '';
        $this->account_number = '';
        $this->account_name = '';
        $this->is_active = true;
    }

    public function render()
    {
        $paymentMethods = PaymentMethodModel::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('bank_name', 'like', '%' . $this->search . '%')
                        ->orWhere('account_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.tix.admin.payment-method', [
            'paymentMethods' => $paymentMethods,
        ]);
    }
}
