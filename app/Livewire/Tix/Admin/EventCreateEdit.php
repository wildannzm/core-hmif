<?php

namespace App\Livewire\Tix\Admin;

use App\Models\Event as EventModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

#[Title('Form Event')]
#[Layout('components.layouts.app')]
class EventCreateEdit extends Component
{
    use WithFileUploads;

    public ?int $eventId = null;
    public string $title = '';
    public string $slug = '';
    public string $description = '';
    public $banner = null;
    public ?string $existingBanner = null;
    public string $location = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $event_start_date = '';
    public string $event_end_date = '';
    public string $price = '';
    public string $quota = '';
    public bool $is_active = true;

    protected array $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:events,slug',
        'description' => 'required|string',
        'banner' => 'nullable|image|max:2048|dimensions:min_width=800,min_height=450,max_width=1920,max_height=1080,ratio=16/9',
        'location' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'event_start_date' => 'required|date',
        'event_end_date' => 'date|after:event_start_date',
        'price' => 'required|numeric|min:0',
        'quota' => 'required|integer|min:1',
        'is_active' => 'boolean',
    ];

    protected $validationAttributes = [
        'title' => 'judul event',
        'slug' => 'slug',
        'description' => 'deskripsi',
        'banner' => 'banner',
        'location' => 'lokasi',
        'start_date' => 'tanggal mulai pemesanan',
        'end_date' => 'tanggal tutup pemesanan',
        'event_start_date' => 'tanggal mulai event',
        'event_end_date' => 'tanggal selesai event',
        'price' => 'harga',
        'quota' => 'kuota',
    ];

    public function mount(?int $id = null): void
    {
        if ($id) {
            $event = EventModel::findOrFail($id);
            $this->eventId = $event->id;
            $this->title = $event->title;
            $this->slug = $event->slug;
            $this->description = $event->description;
            $this->existingBanner = $event->banner;
            $this->location = $event->location;
            $this->start_date = $event->start_date->format('Y-m-d\TH:i');
            $this->end_date = $event->end_date->format('Y-m-d\TH:i');
            $this->event_start_date = $event->event_start_date->format('Y-m-d\TH:i');
            $this->event_end_date = $event->event_end_date->format('Y-m-d\TH:i');
            $this->price = $event->price;
            $this->quota = $event->quota;
            $this->is_active = $event->is_active;
        }
    }

    public function updatedTitle(): void
    {
        $this->slug = Str::slug($this->title);
    }

    public function save(): void
    {
        // Modify validation rules for update
        if ($this->eventId) {
            $this->rules['slug'] = 'required|string|max:255|unique:events,slug,' . $this->eventId;
            $this->rules['banner'] = 'nullable|image|max:2048|dimensions:min_width=800,min_height=450,max_width=1920,max_height=1080,ratio=16/9';
        }

        $this->validate();

        try {
            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'location' => $this->location,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'event_start_date' => $this->event_start_date,
                'event_end_date' => $this->event_end_date,
                'price' => $this->price,
                'quota' => $this->quota,
                'is_active' => $this->is_active,
            ];

            // Handle banner upload
            if ($this->banner) {
                // Delete old banner if exists
                if ($this->existingBanner && Storage::disk('public')->exists($this->existingBanner)) {
                    Storage::disk('public')->delete($this->existingBanner);
                }
                
                $data['banner'] = $this->banner->store('events/banners', 'public');
            }

            if ($this->eventId) {
                $event = EventModel::findOrFail($this->eventId);
                $event->update($data);
                $message = 'Event berhasil diperbarui!';
            } else {
                $data['available_quota'] = $this->quota;
                EventModel::create($data);
                $message = 'Event berhasil ditambahkan!';
            }

            session()->flash('success', $message);
            $this->redirect(route('admin.events.index'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.tix.admin.event-create-edit');
    }
}
