@extends('layouts.app') @section('title', $berita->judul)

@section('content')
<main class="pt-32 pb-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ url('/') }}" class="hover:text-green-600 transition">Beranda</a></li>
                <li><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 11 7.293 7.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                    </svg></li>
                <li><a href="{{ url('/berita') }}" class="hover:text-green-600 transition">Berita</a></li>
                <li><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 11 7.293 7.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                    </svg></li>
                <li class="text-gray-900 font-medium truncate max-w-[200px]">{{ $berita->judul }}</li>
            </ol>
        </nav>

        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase tracking-wider">
                    {{ $berita->kategori->nama }}
                </span>
                <span class="text-gray-400 text-sm">{{ $berita->created_at->format('d F Y') }}</span>
            </div>

            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-8">
                {{ $berita->judul }}
            </h1>

            <div class="flex items-center justify-between py-6 border-y border-gray-100 mb-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr($berita->penulis, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $berita->penulis }}</p>
                        <p class="text-xs text-gray-500">Kontributor Sekolah</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden mb-12 shadow-2xl">
                <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full object-cover">
            </div>

            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $berita->konten !!}
            </div>

            <div class="mt-16 pt-8 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500 font-medium">Bagikan:</span>
                    <button class="p-2 rounded-full bg-gray-50 text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg></button>
                </div>
                <a href="{{ url('/berita') }}" class="text-green-600 font-bold hover:underline">← Kembali ke Semua Berita</a>
            </div>
        </div>
    </div>
</main>
@endsection