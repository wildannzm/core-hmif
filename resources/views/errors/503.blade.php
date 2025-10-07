@extends('errors.layout')

@section('title', 'Service Unavailable')
@section('code', '503')

@section('message')
    Aplikasi sedang dalam pemeliharaan. Mohon bersabar ya! 🔧
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl animate-bounce-soft">🚧</div>
        <p class="text-gray-600">
            Kami sedang melakukan pemeliharaan untuk meningkatkan kualitas aplikasi. Terima kasih atas kesabaran Anda.
        </p>

        <!-- Maintenance Info -->
        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-orange-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-sm text-orange-800 font-medium mb-1">Mode Pemeliharaan Aktif</p>
                    <p class="text-sm text-orange-700">
                        Aplikasi akan kembali normal setelah proses pemeliharaan selesai. Biasanya memakan waktu 15-30
                        menit.
                    </p>
                </div>
            </div>
        </div>

        <!-- Progress indicator -->
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Estimasi Progress</span>
                <span class="text-sm text-gray-500" id="progress-text">65%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-gradient-to-r from-blue-600 to-red-600 h-2 rounded-full transition-all duration-1000"
                    style="width: 65%" id="progress-bar"></div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="text-center">
            <p class="text-sm text-gray-500 mb-2">Butuh bantuan darurat?</p>
            <a href="mailto:hmif@unma.ac.id" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                hmif@unma.ac.id
            </a>
        </div>

        <!-- Auto refresh -->
        <div class="text-xs text-gray-400 text-center">
            Halaman akan otomatis refresh dalam <span id="countdown">30</span> detik
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto refresh countdown
        let countdown = 30;
        const countdownElement = document.getElementById('countdown');

        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown <= 0) {
                window.location.reload();
            }
        }, 1000);

        // Simulate progress
        let progress = 65;
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');

        const progressTimer = setInterval(() => {
            if (progress < 95) {
                progress += Math.random() * 2;
                progressBar.style.width = progress + '%';
                progressText.textContent = Math.round(progress) + '%';
            }
        }, 2000);
    </script>
@endsection
