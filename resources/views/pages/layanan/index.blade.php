@extends('layouts.main')

@section('title', 'Layanan Sekolah')

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
                ● Pelayanan Publik
            </span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Layanan Sekolah Online
        </h1>
        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Akses berbagai informasi sekolah, pengumuman, dan layanan pendidikan dengan mudah dan cepat bagi seluruh siswa, orang tua, dan masyarakat.
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#f9fafb" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 bg-gray-50 min-h-screen relative z-20"
    x-data="{ activeFilter: 'Semua', animateBody: false, searchQuery: '' }"
    x-init="setTimeout(() => animateBody = true, 500)">

    <div class="container mx-auto px-6 max-w-7xl">

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
                    class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition-all duration-300 shadow-sm"
                    placeholder="Cari layanan, contoh: KTP, Pengantar, BPJS...">

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

        <div class="flex flex-nowrap overflow-x-auto gap-3 mb-12 pb-4 px-1 md:flex-wrap md:justify-center md:pb-0 scrollbar-hide transform transition-all duration-700 ease-out delay-200"
            :class="animateBody ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">

            <button @click="activeFilter = 'Semua'"
                :class="activeFilter === 'Semua' 
            ? 'bg-green-600 text-white shadow-lg shadow-green-600/30 scale-105' 
            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="flex-shrink-0 px-5 py-2 rounded-full text-xs md:text-sm font-bold transition-all duration-300 transform whitespace-nowrap">
                Semua
            </button>

            @foreach($kategoriLayanan as $cat)
            <button @click="activeFilter = '{{ $cat->nama }}'"
                :class="activeFilter === '{{ $cat->nama }}' 
                                ? 'bg-green-600 text-white shadow-lg shadow-green-600/30 scale-105' 
                                : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-100'"
                class="flex-shrink-0 px-5 py-2 rounded-full text-xs md:text-sm font-bold transition-all duration-300 transform whitespace-nowrap">
                {{ $cat->nama }}
            </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($layanans as $index => $layanan)
            <div x-show="(activeFilter === 'Semua' || activeFilter === '{{ $layanan->kategori->nama }}') && ('{{ strtolower($layanan->judul) }}'.includes(searchQuery.toLowerCase()))"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="layanan-card bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg hover:border-green-500 transition-all duration-300 group flex flex-col h-full transform opacity-0"
                :class="animateBody ? 'opacity-100 translate-y-0' : 'translate-y-12'"
                style="transition-delay: {{ $index * 50 }}ms">

                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-lg bg-green-50 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        @if(strtolower($layanan->kategori) == 'kesehatan')
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        @elseif(strtolower($layanan->kategori) == 'pendidikan')
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        @else
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        @endif
                    </div>

                    <span class="bg-gray-100 text-gray-600 border border-gray-200 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $layanan->kategori->nama }}
                    </span>
                </div>

                <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors">{{ $layanan->judul }}</h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    {{ $layanan->deskripsi_singkat }}
                </p>

                <div class="mt-auto bg-gray-50 rounded-lg p-4 mb-6 border border-gray-100">
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-700 font-medium">Biaya: {{ $layanan->biaya ?? 'Gratis' }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-700 font-medium">Estimasi: {{ $layanan->durasi ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('layanan.show', $layanan->slug) }}" class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition">
                        Detail
                    </a>

                    @php
                    $cleanPhone = preg_replace('/[^0-9]/', '', $layanan->kontak_wa);
                    if (str_starts_with($cleanPhone, '0')) {
                    $cleanPhone = '62' . substr($cleanPhone, 1);
                    } elseif (str_starts_with($cleanPhone, '8')) {
                    $cleanPhone = '62' . $cleanPhone;
                    }
                    @endphp

                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="flex items-center justify-center gap-2 border border-gray-300 text-gray-600 hover:border-green-500 hover:text-green-600 hover:bg-green-50 text-sm font-semibold py-2.5 px-4 rounded-lg transition group/wa">
                        <svg class="w-5 h-5 text-gray-400 group-hover/wa:text-green-500 transition-colors" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        Hubungi
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Belum Ada Layanan</h3>
                <p class="text-gray-500 mt-2">Daftar layanan online warga akan muncul di sini setelah ditambahkan oleh admin.</p>
            </div>
            @endforelse

            @if(count($layanans) > 0)
            <div x-show="!Array.from(document.querySelectorAll('.layanan-card')).some(el => el.style.display !== 'none')"
                style="display: none;"
                class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white border border-gray-200 shadow-sm mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-lg mb-1">Layanan Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm">Coba gunakan kata kunci lain, misalnya: <strong class="text-gray-800">KTP</strong> atau <strong class="text-gray-800">Surat Pengantar</strong></p>
            </div>
            @endif

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