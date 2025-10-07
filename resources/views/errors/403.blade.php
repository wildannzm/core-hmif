@extends('errors.layout')

@section('title', 'Akses Ditolak')
@section('code', '403')

@section('message')
    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. 🚫
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl">🔒</div>
        <p class="text-gray-600">
            Halaman ini memerlukan hak akses khusus
        </p>
    </div>
@endsection
