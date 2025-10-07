<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-2px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(2px);
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes glitch {
            0% {
                transform: translate(0);
                filter: hue-rotate(0deg);
            }

            10% {
                transform: translate(-2px, -2px);
                filter: hue-rotate(90deg);
            }

            20% {
                transform: translate(2px, 2px);
                filter: hue-rotate(180deg);
            }

            30% {
                transform: translate(-2px, 2px);
                filter: hue-rotate(270deg);
            }

            40% {
                transform: translate(2px, -2px);
                filter: hue-rotate(360deg);
            }

            50% {
                transform: translate(0);
                filter: hue-rotate(0deg);
            }

            60% {
                transform: translate(-1px, 1px);
            }

            70% {
                transform: translate(1px, -1px);
            }

            80% {
                transform: translate(0);
            }

            100% {
                transform: translate(0);
                filter: hue-rotate(0deg);
            }
        }

        @keyframes glitchText {
            0% {
                text-shadow: 0 0 0 transparent;
            }

            5% {
                text-shadow: 2px 0 0 #ff0000, -2px 0 0 #00ffff;
            }

            10% {
                text-shadow: 0 0 0 transparent;
            }

            15% {
                text-shadow: -1px 0 0 #ff0000, 1px 0 0 #00ffff;
            }

            20% {
                text-shadow: 0 0 0 transparent;
            }
        }

        @keyframes scanline {
            0% {
                top: -10%;
            }

            100% {
                top: 110%;
            }
        }

        @keyframes typewriter {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes blink {

            0%,
            50% {
                opacity: 1;
            }

            51%,
            100% {
                opacity: 0;
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-bounce-soft {
            animation: bounce 2s infinite;
        }

        .animate-pulse-soft {
            animation: pulse 2s infinite;
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }

        .animate-glitch {
            animation: glitch 2s infinite;
        }

        .animate-glitch-text {
            animation: glitchText 1.5s infinite;
        }

        .status-code-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .status-code-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, #667eea, #764ba2);
            opacity: 0.1;
            animation: glitch 3s infinite;
        }

        .status-code-text {
            position: relative;
            z-index: 2;
            font-family: 'Courier New', monospace;
            font-weight: 900;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease infinite, glitchText 4s infinite;
        }

        .scanline {
            position: absolute;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            animation: scanline 2s linear infinite;
        }

        .github-style-code {
            position: relative;
            display: inline-block;
            font-family: 'Courier New', monospace;
            font-size: 8rem;
            font-weight: 900;
            line-height: 1;
            margin: 2rem 0;
            overflow: hidden;
        }

        @media (max-width: 640px) {
            .github-style-code {
                font-size: 6rem;
            }
        }

        .typewriter-container {
            overflow: hidden;
            white-space: nowrap;
            margin: 0 auto;
            border-right: 2px solid #667eea;
            animation: typewriter 2s steps(3, end) 1s 1 normal both, blink 1s steps(1, end) infinite;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .typewriter-container:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 20px rgba(102, 126, 234, 0.5));
        }

        /* Additional responsive adjustments */
        @media (max-width: 480px) {
            .github-style-code {
                font-size: 4rem;
                margin: 1rem 0;
            }
        }

        @media (max-width: 320px) {
            .github-style-code {
                font-size: 3rem;
            }
        }

        /* Enhanced glitch effects for different error types */
        .error-404 .status-code-text {
            animation-duration: 2s;
        }

        .error-500 .status-code-text {
            animation-duration: 1s;
        }

        .error-503 .status-code-container {
            animation-duration: 4s;
        }

        /* Pulse effect for loading states */
        .status-loading {
            animation: pulse 1.5s infinite;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 200% 200%;
            animation: gradientShift 4s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Interactive button effects */
        .btn-interactive {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-interactive:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-interactive:active {
            transform: translateY(0);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <!-- Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <!-- Floating geometric shapes -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-float"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-red-200 rounded-lg opacity-20 animate-float"
                style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 left-32 w-12 h-12 bg-yellow-200 rounded-full opacity-20 animate-float"
                style="animation-delay: 1s;"></div>
            <div class="absolute bottom-32 right-10 w-24 h-24 bg-green-200 rounded-lg opacity-20 animate-float"
                style="animation-delay: 1.5s;"></div>
            <div class="absolute top-1/2 left-5 w-8 h-8 bg-purple-200 rounded-full opacity-20 animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/4 right-1/4 w-14 h-14 bg-pink-200 rounded-lg opacity-20 animate-float"
                style="animation-delay: 2.5s;"></div>
        </div>

        <!-- Main Error Content -->
        <div class="max-w-4xl w-full space-y-8 text-center animate-slide-up">
            <!-- Large Status Code Section -->
            <div class="flex flex-col items-center space-y-6">
                <!-- Animated Status Code -->
                <div class="github-style-code status-code-container">
                    <div class="status-code-bg"></div>
                    <div class="scanline"></div>
                    <div class="typewriter-container">
                        <span class="status-code-text">@yield('code')</span>
                    </div>
                </div>

                <!-- Logo Section -->
                <div class="flex justify-center">
                    <div class="relative">
                        <!-- Main Logo -->
                        <div
                            class="flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-red-50 border-3 border-white shadow-lg animate-bounce-soft mx-auto">
                            <img src="{{ asset('images/Logo HMIF.png') }}" alt="Logo HMIF"
                                class="h-14 w-14 object-contain">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                        @yield('title')
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        @yield('message')
                    </p>
                </div>

                <!-- Additional Content -->
                @hasSection('content')
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        @yield('content')
                    </div>
                @endif

                <!-- Footer Info -->
                <div class="text-center">
                    <p class="text-sm text-gray-500">
                        Jika masalah terus berlanjut, silakan hubungi tim IT HMIF
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Interactive functions
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '{{ route('dashboard') }}';
            }
        }

        // Enhanced status code animations
        document.addEventListener('DOMContentLoaded', function() {
            const errorCode = '@yield('code')';
            const statusCodeElement = document.querySelector('.status-code-text');
            const statusContainer = document.querySelector('.status-code-container');

            // Add shake animation for server errors
            if (errorCode === '500' || errorCode === '503') {
                setTimeout(() => {
                    const logoElement = document.querySelector('.animate-bounce-soft');
                    if (logoElement) {
                        logoElement.classList.add('animate-shake');
                    }
                }, 1000);
            }

            // Add glitch effect for critical errors
            if (errorCode === '500' || errorCode === '404') {
                setTimeout(() => {
                    if (statusContainer) {
                        statusContainer.classList.add('animate-glitch');
                    }
                    if (statusCodeElement) {
                        statusCodeElement.classList.add('animate-glitch-text');
                    }
                }, 2000);
            }

            // Status code click interaction
            if (statusCodeElement) {
                statusCodeElement.addEventListener('click', function() {
                    this.style.transform = 'scale(1.1)';
                    this.style.transition = 'transform 0.2s ease';

                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);

                    // Add temporary glitch effect
                    this.classList.add('animate-glitch-text');
                    setTimeout(() => {
                        this.classList.remove('animate-glitch-text');
                    }, 1500);
                });
            }

            // Progressive enhancement for typewriter effect
            const typewriterElement = document.querySelector('.typewriter-container');
            if (typewriterElement) {
                // Remove the border after animation completes
                setTimeout(() => {
                    typewriterElement.style.borderRight = 'none';
                }, 4000);
            }
        });

        // Interactive hover effects for floating elements
        document.querySelectorAll('.animate-float').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
                this.style.transform = 'scale(1.1)';
                this.style.transition = 'transform 0.3s ease';
            });

            element.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
                this.style.transform = 'scale(1)';
            });
        });
    </script>

    @hasSection('scripts')
        @yield('scripts')
    @endif
</body>

</html>
