@extends('errors.layout')

@section('title', 'Validation Error')
@section('code', '422')

@section('message')
    Data yang Anda kirim tidak dapat diproses karena tidak valid. 📝
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl">📋</div>
        <p class="text-gray-600">
            Terdapat kesalahan dalam validasi data yang Anda kirimkan.
        </p>

        <!-- Validation Error Info -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                    </path>
                </svg>
                <div>
                    <p class="text-sm text-red-800 font-medium mb-1">Validation Error</p>
                    <p class="text-sm text-red-700">
                        Data yang dikirimkan tidak memenuhi kriteria validasi yang diperlukan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Common Issues -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <h4 class="font-medium text-yellow-900 mb-2">Kemungkinan penyebab:</h4>
            <ul class="text-sm text-yellow-800 space-y-1">
                <li>• Field wajib tidak diisi</li>
                <li>• Format data tidak sesuai</li>
                <li>• File terlalu besar atau format tidak didukung</li>
                <li>• Email atau nomor sudah terdaftar</li>
                <li>• Password tidak memenuhi kriteria</li>
            </ul>
        </div>

        <!-- Action -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="font-medium text-blue-900 mb-2">Yang perlu dilakukan:</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Kembali ke form dan periksa semua field</li>
                <li>• Pastikan data sudah sesuai format</li>
                <li>• Coba kirim ulang dengan data yang benar</li>
            </ul>
        </div>
    </div>
@endsection
