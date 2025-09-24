<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head', ['title' => 'Login'])
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 to-red-50 antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center gap-8 p-6 md:p-10">
        <div class="w-full max-w-md">
            <!-- HMIF Logo -->
            <div class="flex flex-col items-center gap-4 mb-8">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-lg">
                    <img src="{{ asset('images/Logo HMIF.png') }}" alt="Logo HMIF" class="h-16 w-16 object-contain">
                </div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-900">HMIF UNMA</h1>
                    <p class="text-sm text-gray-600">Himpunan Mahasiswa Informatika</p>
                </div>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
