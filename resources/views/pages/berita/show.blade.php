@extends('layouts.main')
@php
$navHitam = true; // Ini adalah pemicu agar Navbar di main.blade.php berubah warna
@endphp
@section('title', $berita->judul ?? 'Detail Berita')

@section('content')
<section class="pt-24 pb-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="mb-8">
            <a href="{{ url('/berita') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-green-600">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke daftar berita
            </a>
        </div>
        <article class="bg-white">
            <div class="mb-6">
                <span class="inline-flex items-center text-xs uppercase tracking-widest font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-full">
                    {{ $berita->kategori->nama ?? 'Berita Sekolah' }}
                </span>
                <h1 class="text-4xl font-bold text-gray-900 mt-4">{{ $berita->judul }}</h1>
                <div class="flex items-center gap-4 text-sm text-gray-500 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $berita->created_at?->translatedFormat('d F Y') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $berita->penulis ?? 'Admin Sekolah' }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11.5a6.5 6.5 0 10-13 0v2.658c0 .538-.214 1.055-.595 1.437L3 17h5m2 0v1a3 3 0 006 0v-1" />
                        </svg>
                        {{ number_format($berita->views ?? 0) }} kali dibaca
                    </div>
                </div>
            </div>

            @if($berita->gambar)
            <div class="mb-8 rounded-3xl overflow-hidden shadow-lg">
                <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-[460px] object-cover">
            </div>
            @endif

            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $berita->konten !!}
            </div>
        </article>
    </div>
</section>
@endsection