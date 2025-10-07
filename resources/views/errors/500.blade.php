@extends('errors.layout')

@section('title', 'Server Error')
@section('code', '500')

@section('message')
    Oops! Ada sesuatu yang salah di server kami. 😵
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl animate-pulse-soft">⚡</div>
        <p class="text-gray-600">
            Tim kami sedang bekerja keras untuk memperbaiki masalah ini. Silakan coba lagi dalam beberapa menit.
        </p>

        <!-- Error Details -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-red-800">
                    <span class="font-medium">Error Internal Server:</span> Kesalahan tidak terduga terjadi pada aplikasi.
                </p>
            </div>
        </div>

        <!-- What to do -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="font-medium text-blue-900 mb-2">Yang dapat Anda lakukan:</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Refresh halaman ini</li>
                <li>• Tunggu beberapa menit dan coba lagi</li>
                <li>• Hubungi tim IT jika masalah berlanjut</li>
            </ul>
        </div>

        <!-- Refresh Button -->
        <button onclick="window.location.reload()"
            class="btn-interactive w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                </path>
            </svg>
            Refresh Halaman
        </button>
    </div>
@endsection
