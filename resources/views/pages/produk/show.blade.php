@extends('layouts.main')

@section('title', $produk->nama_usaha)

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
            <a href="{{ url('/produk') }}" class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md border border-white/30 text-green-50 text-[10px] font-bold px-4 py-1.5 rounded-full tracking-wider uppercase shadow-lg hover:bg-white/30 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Galeri
            </a>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Detail Produk
        </h1>
        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Informasi lengkap mengenai produk unggulan Sekolah.
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 bg-white relative z-20 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                <div class="relative h-[400px] lg:h-auto bg-gray-100 overflow-hidden group">
                    <img src="{{ asset($produk->foto) }}"
                        alt="{{ $produk->nama_usaha }}"
                        class="w-full h-full object-cover object-center transform group-hover:scale-105 transition duration-700">

                    <div class="absolute top-6 left-6">
                        <span class="bg-white/90 backdrop-blur-md text-gray-900 text-xs font-bold px-4 py-2 rounded-full shadow-lg uppercase tracking-wider">
                            {{ $produk->kategori->nama }}
                        </span>
                    </div>
                </div>

                <div class="p-8 md:p-12 flex flex-col h-full">

                    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
                        <span>Produk</span>
                        <span>/</span>
                        <span class="text-green-600 font-medium">{{ $produk->kategori->nama }}</span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                        {{ $produk->nama_usaha }}
                    </h1>

                    <div class="flex items-center gap-3 mb-8 pb-8 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold">
                            {{ substr($produk->pemilik, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-bold">Pemilik Usaha</p>
                            <p class="text-gray-900 font-medium">{{ $produk->pemilik }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <p class="text-sm text-gray-500 mb-1">Harga Mulai</p>
                        <p class="text-4xl font-bold text-green-600">
                            @if($produk->harga_mulai)
                            Rp {{ number_format($produk->harga_mulai, 0, ',', '.') }}
                            @else
                            <span class="text-2xl">Hubungi Penjual</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-10">
                        <h3 class="font-bold text-gray-900 mb-3 text-lg">Deskripsi Produk</h3>
                        <div class="prose prose-green prose-sm text-gray-600 leading-relaxed">
                            <p>{{ $produk->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="mt-auto">
                        @php
                            $waNumProduk = preg_replace('/[^0-9]/', '', $produk->no_wa ?? '');
                            if (str_starts_with($waNumProduk, '0')) { $waNumProduk = '62' . substr($waNumProduk, 1); }
                            elseif (str_starts_with($waNumProduk, '8')) { $waNumProduk = '62' . $waNumProduk; }
                        @endphp
                        <a href="{{ $waNumProduk ? 'https://wa.me/' . $waNumProduk . '?text=Halo%20' . urlencode($produk->pemilik) . ',%20saya%20tertarik%20dengan%20produk%20*' . urlencode($produk->nama_usaha) . '*%20yang%20saya%20lihat%20di%20Website%20Sekolah.' : '#' }}"
                            target="_blank"
                            class="flex items-center justify-center gap-3 w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-green-600/30 transition-all transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Chat Penjual via WhatsApp
                        </a>
                        <p class="text-center text-xs text-gray-400 mt-3">
                            Transaksi dilakukan langsung dengan penjual.
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

@endsection