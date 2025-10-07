@extends('errors.layout')

@section('title', 'Halaman Tidak Ditemukan')
@section('code', '404')

@section('message')
    Ups! Halaman yang Anda cari sepertinya sedang bermain petak umpet. 🙈
@endsection

@section('content')
    <div class="space-y-4">
        <div class="text-6xl">🔍</div>
        <p class="text-gray-600">
            Mungkin URL yang Anda masukkan salah, atau halaman ini telah dipindahkan ke tempat lain.
        </p>
    </div>
@endsection
