@extends('layouts.main')

@section('title', 'Produk & Produk Murid')

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
                ● Ekonomi Murid
            </span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Galeri Produk
        </h1>
        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Dukung kreativitas siswa dengan menjelajahi berbagai produk hasil karya murid {{ informasi_umum('nama_sekolah') }}.
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
                    placeholder="Cari nama Produk atau produk...">

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

            @foreach($kategoriProduk as $cat)
            <button @click="activeFilter = '{{ $cat->nama }}'"
                :class="activeFilter === '{{ $cat->nama }}' 
            ? 'bg-green-600 text-white shadow-lg shadow-green-600/30 scale-105' 
            : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                class="flex-shrink-0 px-5 py-2 rounded-full text-xs md:text-sm font-bold transition-all duration-300 transform whitespace-nowrap">
                {{ $cat->nama }}
            </button>
            @endforeach
        </div>

        <div class="flex overflow-x-auto pb-8 -mx-4 px-4 snap-x snap-mandatory md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 md:overflow-visible md:pb-0 md:mx-0 md:px-0 scrollbar-hide">

            @forelse($produks as $index => $item)
            <div x-show="(activeFilter === 'Semua' || activeFilter === '{{ $item->kategori->nama }}') && ('{{ strtolower($item->nama_usaha) }}'.includes(searchQuery.toLowerCase()))"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="produk-card flex-shrink-0 w-[85vw] sm:w-[350px] md:w-auto snap-center bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden group flex flex-col h-full mx-2 md:mx-0">

                <a href="{{ route('produk.show', $item->id) }}" class="block relative h-64 overflow-hidden bg-gray-100">
                    <img src="{{ asset($item->foto) }}" alt="{{ $item->nama_usaha }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/95 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-3 py-1.5 rounded-full shadow-md uppercase tracking-wider">
                            {{ $item->kategori->nama }}
                        </span>
                    </div>
                </a>

                <div class="p-6 md:p-8 flex flex-col flex-1">
                    <div class="mb-3">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-300 line-clamp-1 mb-1">
                            <a href="{{ route('produk.show', $item->id) }}">
                                {{ $item->nama_usaha }}
                            </a>
                        </h3>
                        <p class="text-xs text-gray-400 flex items-center gap-1.5 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            {{ $item->pemilik }}
                        </p>
                    </div>

                    <p class="text-gray-500 text-sm line-clamp-2 mb-6 leading-relaxed">
                        {{ $item->deskripsi }}
                    </p>

                    <div class="border-t border-gray-50 my-auto"></div>

                    <div class="pt-5 flex flex-col sm:flex-row items-center justify-between mt-auto gap-4">

                        <div class="w-full sm:w-auto">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Harga Mulai</p>
                            <p class="text-lg font-bold text-green-600">
                                @if($item->harga_mulai)
                                Rp {{ number_format($item->harga_mulai, 0, ',', '.') }}
                                @else
                                Hubungi
                                @endif
                            </p>
                        </div>

                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('produk.show', $item->id) }}"
                                class="flex-1 sm:flex-none text-center px-4 py-2.5 rounded-xl bg-gray-100 text-gray-600 font-bold text-xs hover:bg-gray-200 transition-colors">
                                Detail
                            </a>

                            <a href="https://wa.me/{{ $item->no_wa }}?text=Halo%20{{ $item->pemilik }},%20saya%20tertarik%20dengan%20produk%20*{{ $item->nama_usaha }}*%20yang%20ada%20di%20Website%20Sekolah."
                                target="_blank"
                                class="flex-1 sm:flex-none group/btn flex justify-center items-center gap-2 bg-green-50 text-green-700 px-4 py-2.5 rounded-xl hover:bg-green-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-green-600/30">
                                <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                <span class="text-sm font-bold">Pesan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full w-full text-center py-24 bg-gray-50/50 rounded-3xl border-2 border-dashed border-gray-200 w-full mx-4 md:mx-0">
                <div class="bg-white p-5 rounded-full inline-block shadow-sm mb-4">
                    <svg class="w-12 h-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-xl">Belum Ada Produk</h3>
                <p class="text-gray-500 max-w-md mx-auto mt-2 text-sm">Data produk sedang disiapkan.</p>
            </div>
            @endforelse

            @if(count($produks) > 0)
            <div x-show="!Array.from(document.querySelectorAll('.produk-card')).some(el => el.style.display !== 'none')"
                style="display: none;"
                class="col-span-full w-full text-center py-16 px-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-lg mb-1">Produk Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm">Tidak ada usaha yang cocok dengan pencarian: <strong x-text="searchQuery" class="text-gray-800"></strong></p>
            </div>
            @endif

        </div>

        <div class="mt-16 flex justify-center transform transition-all duration-700 delay-300"
            :class="animateBody ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
            x-show="searchQuery === ''">
            {{ $produks->links() }}
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