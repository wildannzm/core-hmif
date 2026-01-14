<div class="container mx-auto p-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">E-Tickets untuk Pesanan #{{ $order->invoice_code }}</h2>

            <div class="mb-6">
                <p class="text-gray-700"><strong>Event:</strong> {{ $order->event->title }}</p>
                <p class="text-gray-700"><strong>Pembeli:</strong> {{ $order->buyer_name }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ $order->buyer_email }}</p>
                <p class="text-gray-700"><strong>Total Tiket:</strong> {{ count($ticketPaths) }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Download E-Tickets:</h3>
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($ticketPaths as $index => $path)
                        @php
                            $filename = basename($path);
                            $url = asset('storage/' . str_replace('tickets/', 'tickets/', $path));
                        @endphp
                        <div class="border rounded-lg p-4 flex items-center justify-between">
                            <div>
                                <p class="font-medium">Ticket #{{ $index + 1 }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->attendees[$index]->name ?? 'Attendee ' . ($index + 1) }}</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ $url }}" target="_blank"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Lihat
                                </a>
                                <a href="{{ $url }}" download="E-Ticket-{{ $index + 1 }}.png"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                    Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h4 class="font-semibold text-yellow-800 mb-2">Cara Kirim via WhatsApp:</h4>
                <ol class="list-decimal list-inside text-sm text-yellow-700 space-y-1">
                    <li>Download semua e-ticket dengan klik tombol "Download"</li>
                    <li>Buka WhatsApp dan pilih kontak pembeli</li>
                    <li>Kirim semua file e-ticket ({{ count($ticketPaths) }} gambar)</li>
                    <li>Tambahkan pesan: "Terima kasih telah membeli tiket {{ $order->event->title }}. Tunjukkan QR
                        code saat check-in."</li>
                </ol>
            </div>

            <div class="mt-6">
                <button wire:click="$dispatch('close-ticket-preview')"
                    class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
