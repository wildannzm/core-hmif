@extends('errors.layout')

@section('title', 'Too Many Requests')
@section('code', '429')

@section('message')
    Whoa! Anda terlalu cepat! Silakan tunggu sebentar ya. 🚀
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl animate-bounce-soft">🐌</div>
        <p class="text-gray-600">
            Anda telah mengirim terlalu banyak request dalam waktu singkat. Mohon tunggu sebentar.
        </p>

        <!-- Rate limit Info -->
        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-orange-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-sm text-orange-800 font-medium mb-1">Rate Limit Exceeded</p>
                    <p class="text-sm text-orange-700">
                        Sistem melindungi server dari overload dengan membatasi jumlah request per menit.
                    </p>
                </div>
            </div>
        </div>

        <!-- Cooldown Timer -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="text-center">
                <h4 class="font-medium text-blue-900 mb-2">Waktu tunggu</h4>
                <div class="text-3xl font-bold text-blue-600 mb-2" id="cooldown-timer">--</div>
                <p class="text-sm text-blue-700">detik lagi untuk mencoba kembali</p>
            </div>

            <!-- Progress bar -->
            <div class="mt-4">
                <div class="w-full bg-blue-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000" style="width: 0%"
                        id="cooldown-progress"></div>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <h4 class="font-medium text-green-900 mb-2">Tips untuk kedepannya:</h4>
            <ul class="text-sm text-green-800 space-y-1">
                <li>• Tunggu sejenak sebelum klik tombol berulang kali</li>
                <li>• Jangan refresh halaman terlalu sering</li>
                <li>• Pastikan koneksi internet stabil</li>
            </ul>
        </div>

        <!-- Auto retry button -->
        <button onclick="window.location.reload()" id="retry-button" disabled
            class="btn-interactive w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-400 bg-gray-100 cursor-not-allowed">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                </path>
            </svg>
            <span id="retry-text">Menunggu...</span>
        </button>
    </div>

    <script>
        // Get retry after from response headers or default to 60 seconds
        let cooldownTime = {{ $retryAfter ?? 60 }};
        const totalTime = cooldownTime;

        const timerElement = document.getElementById('cooldown-timer');
        const progressElement = document.getElementById('cooldown-progress');
        const retryButton = document.getElementById('retry-button');
        const retryText = document.getElementById('retry-text');

        function updateCooldown() {
            timerElement.textContent = cooldownTime;

            // Update progress bar
            const progress = ((totalTime - cooldownTime) / totalTime) * 100;
            progressElement.style.width = progress + '%';

            if (cooldownTime <= 0) {
                // Enable retry button
                retryButton.disabled = false;
                retryButton.classList.remove('text-gray-400', 'bg-gray-100', 'cursor-not-allowed');
                retryButton.classList.add('text-gray-700', 'bg-white', 'hover:bg-gray-50');
                retryText.textContent = 'Coba Lagi';

                return;
            }

            cooldownTime--;
            setTimeout(updateCooldown, 1000);
        }

        // Start countdown
        updateCooldown();
    </script>
@endsection
