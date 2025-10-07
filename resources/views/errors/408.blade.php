@extends('errors.layout')

@section('title', 'Request Timeout')
@section('code', '408')

@section('message')
    Request Anda memakan waktu terlalu lama dan timeout. ⏰
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl animate-pulse-soft">⌛</div>
        <p class="text-gray-600">
            Server tidak menerima request lengkap dalam batas waktu yang ditentukan.
        </p>

        <!-- Timeout Info -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-sm text-yellow-800 font-medium mb-1">Request Timeout</p>
                    <p class="text-sm text-yellow-700">
                        Koneksi internet lambat atau server sedang sibuk.
                    </p>
                </div>
            </div>
        </div>

        <!-- Solutions -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="font-medium text-blue-900 mb-2">Solusi yang bisa dicoba:</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Periksa koneksi internet Anda</li>
                <li>• Coba refresh halaman</li>
                <li>• Tunggu beberapa saat dan coba lagi</li>
                <li>• Gunakan koneksi yang lebih stabil</li>
            </ul>
        </div>

        <!-- Retry Button with Timer -->
        <button onclick="retryWithDelay()" id="retry-btn"
            class="btn-interactive w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                </path>
            </svg>
            <span id="retry-text">Coba Lagi</span>
        </button>
    </div>

    <script>
        function retryWithDelay() {
            const btn = document.getElementById('retry-btn');
            const text = document.getElementById('retry-text');

            btn.disabled = true;
            btn.classList.add('opacity-50');

            let countdown = 3;
            text.textContent = `Mencoba lagi dalam ${countdown}s`;

            const timer = setInterval(() => {
                countdown--;
                text.textContent = `Mencoba lagi dalam ${countdown}s`;

                if (countdown <= 0) {
                    clearInterval(timer);
                    window.location.reload();
                }
            }, 1000);
        }
    </script>
@endsection
