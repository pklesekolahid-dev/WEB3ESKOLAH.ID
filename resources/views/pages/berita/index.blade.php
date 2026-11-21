@extends('layouts.main')

@section('title', 'Berita & Agenda Sekolah')

@section('content')

<header class="relative pt-24 pb-32 md:pt-28 md:pb-40 bg-gradient-to-br from-green-600 to-emerald-700 text-white overflow-hidden"
    x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)">

    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0"></div>
    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-10 w-48 h-48 bg-black/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10 text-center -mt-4">
        <div class="inline-block mb-3 transform transition-all duration-700 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <span class="bg-white/20 backdrop-blur-md border border-white/30 text-green-50 text-[10px] font-bold px-3 py-1 rounded-full tracking-wider uppercase shadow-lg">
                ● Kabar Sekolah
            </span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Berita & Agenda
        </h1>
        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Dapatkan informasi terkini mengenai kegiatan sekolah, prestasi siswa, serta berbagai pengumuman penting di {{ informasi_umum('nama_sekolah') }}.
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 bg-white min-h-screen relative z-20"
    x-data="{ activeFilter: 'Semua', animateBody: false, searchQuery: '' }"
    x-init="setTimeout(() => animateBody = true, 500)">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

        <div class="max-w-xl mx-auto mb-8 transform transition-all duration-700 ease-out delay-100"
            :class="animateBody ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text"
                    x-model="searchQuery"
                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-300 shadow-sm"
                    placeholder="Cari judul berita atau agenda...">

                <button type="button"
                    x-show="searchQuery.length > 0"
                    @click="searchQuery = ''"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-red-500 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-nowrap overflow-x-auto gap-3 mb-12 pb-4 -mx-4 px-4 md:flex-wrap md:justify-center md:pb-0 md:mx-0 md:px-0 scrollbar-hide transform transition-all duration-700 ease-out delay-200"
            :class="animateBody ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">

            <button @click="activeFilter = 'Semua'"
                :class="activeFilter === 'Semua' 
            ? 'bg-green-600 text-white shadow-lg shadow-green-600/30 scale-105' 
            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="flex-shrink-0 px-5 py-2 rounded-full text-xs md:text-sm font-bold transition-all duration-300 transform whitespace-nowrap">
                Semua
            </button>

            @foreach($kategoriBerita as $cat)
            <button @click="activeFilter = '{{ $cat->nama }}'"
                :class="activeFilter === '{{ $cat->nama }}' 
                                ? 'bg-green-600 text-white shadow-lg shadow-green-600/30 scale-105' 
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="flex-shrink-0 px-5 py-2 rounded-full text-xs md:text-sm font-bold transition-all duration-300 transform whitespace-nowrap">
                {{ $cat->nama }}
            </button>
            @endforeach
        </div>

        <div class="flex overflow-x-auto pb-8 -mx-4 px-4 snap-x snap-mandatory md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-10 md:overflow-visible md:pb-0 md:mx-0 md:px-0 scrollbar-hide">

            @forelse($beritas as $index => $item)
            <article x-show="(activeFilter === 'Semua' || activeFilter === '{{ $item->kategori->nama }}') && ('{{ strtolower($item->judul) }}'.includes(searchQuery.toLowerCase()))"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-95 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="flex-shrink-0 w-[85vw] sm:w-[350px] md:w-auto snap-center bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden group flex flex-col h-full mx-2 md:mx-0 transform delay-[{{ $index * 100 }}ms]">

                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $item->gambar ? asset($item->gambar) : 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=900&q=60' }}"
                        alt="{{ $item->judul }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/95 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-3 py-1.5 rounded-full shadow-md uppercase tracking-wider">
                            {{ $item->kategori->nama ?? 'Umum' }}
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-8 flex flex-col flex-1">
                    <div class="flex items-center gap-3 text-[10px] md:text-xs text-gray-400 mb-3 font-medium">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $item->created_at?->translatedFormat('d M Y') }}
                        </span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $item->penulis ?? 'Admin' }}
                        </span>
                    </div>

                    <h3 class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-300 mb-3 line-clamp-2 leading-snug">
                        <a href="{{ url('/berita/' . $item->slug) }}">
                            {{ $item->judul }}
                        </a>
                    </h3>

                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed line-clamp-3 mb-6">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 110) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <a href="{{ url('/berita/' . $item->slug) }}" class="inline-flex items-center gap-2 text-green-600 font-bold text-xs md:text-sm hover:gap-3 transition-all duration-300">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4-4 4M3 12h18" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full w-full text-center py-20 px-4">
                <div class="bg-gray-50 inline-block p-6 rounded-full mb-4 border border-gray-100 shadow-inner">
                    <svg class="w-12 h-12 text-gray-300 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-lg mb-1">Belum Ada Berita</h3>
                <p class="text-gray-400 text-xs md:text-sm">Admin belum mempublikasikan berita apapun.</p>
            </div>
            @endforelse

            @if(count($beritas) > 0)
            <div x-show="!Array.from(document.querySelectorAll('article')).some(el => el.style.display !== 'none')"
                style="display: none;"
                class="col-span-full w-full text-center py-16 px-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-lg mb-1">Pencarian Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm">Tidak ada berita yang cocok dengan kata kunci: <strong x-text="searchQuery" class="text-gray-800"></strong></p>
            </div>
            @endif

        </div>

        <div class="mt-8 mb-4 flex justify-center transform transition-all duration-700 delay-300"
            :class="animateBody ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            x-show="searchQuery === ''"> {{ $beritas->links() }}
        </div>

    </div>
</section>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection