@extends('errors.layout')

@section('title', 'Method Not Allowed')
@section('code', '405')

@section('message')
    Metode request yang Anda gunakan tidak diizinkan untuk endpoint ini. 🚷
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl">❌</div>
        <p class="text-gray-600">
            Request method yang Anda gunakan tidak didukung oleh resource ini.
        </p>

        <!-- Method Info -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                    </path>
                </svg>
                <p class="text-sm text-red-800">
                    <span class="font-medium">HTTP Method Error:</span> Metode request tidak sesuai dengan yang diharapkan
                    server.
                </p>
            </div>
        </div>

        <!-- Allowed Methods -->
        @if (isset($exception) && method_exists($exception, 'getHeaders') && isset($exception->getHeaders()['Allow']))
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-medium text-blue-900 mb-2">Metode yang diizinkan:</h4>
                <p class="text-sm text-blue-800 font-mono">
                    {{ $exception->getHeaders()['Allow'] }}
                </p>
            </div>
        @endif
    </div>
@endsection
