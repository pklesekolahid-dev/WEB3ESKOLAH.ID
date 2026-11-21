@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

@php
$slideImages = $banners->count() > 0
? $banners->map(function($banner) { return asset($banner->gambar); })->toArray()
: [asset('bg1.jpg'), asset('bg2.jpg'), asset('bg3.jpg')];
@endphp

<section class="relative flex min-h-screen w-full items-center overflow-hidden overflow-x-hidden"
    x-data='{
                activeSlide: 0,
                slides: @json($slideImages),
                loaded: false
             }'
    x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000); setTimeout(() => loaded = true, 100)">

    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index"
            x-transition:enter="transition duration-1000 transform ease-in-out"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-1000 transform ease-in-out"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-105"
            class="absolute inset-0 z-0">
            <img :src="slide" class="w-full h-full object-cover" alt="Background Sekolah">
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/50 to-transparent"></div>
        </div>
    </template>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid grid-cols-1 items-center gap-12 pt-24 md:grid-cols-2">

        <div class="text-white space-y-6 transition-all duration-1000 transform text-center md:text-left"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <span class="inline-flex items-center gap-2 py-1 px-3 rounded-full bg-green-500/20 border border-green-400/30 text-green-300 text-xs font-bold tracking-wider uppercase mb-2">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Website Resmi
            </span>

            <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold leading-tight drop-shadow-lg">
                Selamat Datang di Website <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">{{informasi_umum('nama_sekolah')}}</span>
            </h1>

            <p class="text-lg text-gray-300 max-w-xl leading-relaxed drop-shadow-md delay-200 mx-auto md:mx-0">
                {{informasi_umum('slogan')}}
            </p>

            <div class="flex flex-col items-center justify-center gap-4 pt-4 sm:flex-row md:justify-start">
                <a href="#statistik" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-full font-bold transition shadow-lg shadow-green-600/40 flex items-center gap-2 group">
                    Jelajahi Sekolah
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition">
                        <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="{{ url('/layanan') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/20 px-8 py-3 rounded-full font-bold transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Layanan Online
                </a>
            </div>
        </div>

        <div class="hidden md:grid gap-4 w-full max-w-sm ml-auto transition-all duration-1000 delay-300 transform"
            :class="loaded ? 'translate-x-0 opacity-100' : 'translate-x-10 opacity-0'">

            <div class="group p-4 rounded-xl bg-white/10 border border-white/10 backdrop-blur-md hover:bg-green-600/90 transition cursor-pointer hover:-translate-y-1 duration-300">
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg group-hover:text-white">Profil Sekolah</h3>
                        <p class="text-gray-300 text-sm group-hover:text-green-100">Sejarah & Visi Misi</p>
                        <a href="profil/informasi-umum" class="text-sm text-green-200 underline mt-1 inline-block group-hover:text-green-100">Lihat Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="group p-4 rounded-xl bg-white/10 border border-white/10 backdrop-blur-md hover:bg-green-600/90 transition cursor-pointer hover:-translate-y-1 duration-300">
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg group-hover:text-white">Produk Murid</h3>
                        <p class="text-gray-300 text-sm group-hover:text-green-100">Belanja produk lokal</p>
                        <a href="produk" class="text-sm text-green-200 underline mt-1 inline-block group-hover:text-green-100">Lihat Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="group p-4 rounded-xl bg-white/10 border border-white/10 backdrop-blur-md hover:bg-green-600/90 transition cursor-pointer hover:-translate-y-1 duration-300">
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg group-hover:text-white">Berita Terkini</h3>
                        <p class="text-gray-300 text-sm group-hover:text-green-100">Info kegiatan murid</p>
                        <a href="berita" class="text-sm text-green-200 underline mt-1 inline-block group-hover:text-green-100">Lihat Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@if($pengumumans->isNotEmpty())
<div class="container mx-auto px-4 sm:px-6 mb-8 mt-12">
    <div class="bg-gradient-to-r from-emerald-900 to-green-800 shadow-lg rounded-2xl overflow-hidden flex items-center p-1 border border-white/10">

        <div class="flex-shrink-0 bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-xl font-bold text-[10px] sm:text-xs tracking-wider uppercase flex items-center gap-2 border border-white/20 z-10">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
            INFO SEKOLAH
        </div>

        <div class="marquee-container flex-1 overflow-hidden whitespace-nowrap px-4">
            <div class="marquee-content inline-block text-sm font-semibold text-emerald-50 py-2">
                @foreach($pengumumans as $item)
                <span class="mx-6">📢 {{ $item->teks }}</span>
                <span class="mx-6 text-white/30">•</span>
                @endforeach

                @foreach($pengumumans as $item)
                <span class="mx-6">📢 {{ $item->teks }}</span>
                <span class="mx-6 text-white/30">•</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<style>
    .marquee-container {
        /* Efek fade di pinggir agar teks tidak terpotong kaku */
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }

    .marquee-content {
        padding-left: 100%;
        animation: marquee 25s linear infinite;
    }

    .marquee-content:hover {
        animation-play-state: paused;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>

<section id="statistik" class="py-20 bg-gray-50 overflow-x-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto reveal-on-scroll transform duration-1000"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-green-600 text-xs font-bold tracking-wider uppercase mb-4">
                ● Data Statistik
            </span>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Informasi Sekolah dalam Angka</h2>
            <p class="text-gray-500">
                Update terkini statistik {{$kategoriDemografi->nama_1}}, {{$kategoriDemografi->nama_2}}, {{$kategoriDemografi->nama_3}}, dan {{$kategoriDemografi->nama_4}}.
            </p>
        </div>

        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">

            <div class="bg-white w-full rounded-2xl p-6 shadow-sm hover:shadow-xl transition duration-300 border-b-4 border-green-500 group reveal-on-scroll transform duration-1000 delay-100"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-50 text-green-600 p-3 rounded-lg group-hover:bg-green-600 group-hover:text-white transition">
                        <i class="{{ $kategoriDemografi->icon_1 }}"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800 mb-1 flex items-baseline gap-1"
                    x-data="{ current: 0, target: {{ $statistics['kategori_demografi_nama_1'] ?? 0 }} }"
                    x-effect="if(shown) { let interval = setInterval(() => { if(current < target) { current += Math.ceil(target/40); } else { current = target; clearInterval(interval); } }, 10); }">
                    <span x-text="current.toLocaleString()">0</span>
                </h3>
                <p class="text-gray-500 text-sm">{{$kategoriDemografi->nama_1}}</p>
            </div>

            <div class="bg-white w-full rounded-2xl p-6 shadow-sm hover:shadow-xl transition duration-300 border-b-4 border-blue-500 group reveal-on-scroll transform duration-1000 delay-200"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-50 text-blue-600 p-3 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition">
                        <i class="{{ $kategoriDemografi->icon_2 }}"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800 mb-1 flex items-baseline gap-1"
                    x-data="{ current: 0, target: {{ $statistics['kategori_demografi_nama_2'] ?? 0 }} }"
                    x-effect="if(shown) { let interval = setInterval(() => { if(current < target) { current += Math.ceil(target/40); } else { current = target; clearInterval(interval); } }, 50); }">
                    <span x-text="current">0</span>
                </h3>
                <p class="text-gray-500 text-sm">{{$kategoriDemografi->nama_2}}</p>
            </div>

            <div class="bg-white w-full rounded-2xl p-6 shadow-sm hover:shadow-xl transition duration-300 border-b-4 border-yellow-500 group reveal-on-scroll transform duration-1000 delay-300"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-yellow-50 text-yellow-600 p-3 rounded-lg group-hover:bg-yellow-600 group-hover:text-white transition">
                        <i class="{{ $kategoriDemografi->icon_3 }}"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800 mb-1 flex items-baseline gap-1"
                    x-data="{ current: 0, target: {{ $statistics['kategori_demografi_nama_3'] ?? 0 }} }"
                    x-effect="if(shown) { let interval = setInterval(() => { if(current < target) { current += Math.ceil(target/40); } else { current = target; clearInterval(interval); } }, 60); }">
                    <span x-text="current">0</span>
                </h3>
                <p class="text-gray-500 text-sm">{{$kategoriDemografi->nama_3}}</p>
            </div>

            <div class="bg-white w-full rounded-2xl p-6 shadow-sm hover:shadow-xl transition duration-300 border-b-4 border-purple-500 group reveal-on-scroll transform duration-1000 delay-500"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-50 text-purple-600 p-3 rounded-lg group-hover:bg-purple-600 group-hover:text-white transition">
                        <i class="{{ $kategoriDemografi->icon_4 }}"></i>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800 mb-1 flex items-baseline gap-1"
                    x-data="{ current: 0, target: {{ $statistics['kategori_demografi_nama_4'] ?? 0 }} }"
                    x-effect="if(shown) { let interval = setInterval(() => { if(current < target) { current += Math.ceil(target/40); } else { current = target; clearInterval(interval); } }, 100); }">
                    <span x-text="current">0</span>
                </h3>
                <p class="text-gray-500 text-sm">{{$kategoriDemografi->nama_4}}</p>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-white overflow-hidden overflow-x-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 items-center md:grid-cols-2">

            <div class="relative group w-full reveal-on-scroll transform duration-1000 -translate-x-10 opacity-0"
                :class="shown ? 'translate-x-0 opacity-100' : '-translate-x-10 opacity-0'">
                <div class="absolute -top-10 -left-10 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s"></div>

                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-[6px] border-white transform transition duration-500 hover:scale-[1.02]">
                    <img src="{{ isset($kepsek) && $kepsek->foto ? asset($kepsek->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kepsek->nama ?? 'Kepala Sekolah') . '&background=064E3B&color=fff&size=600' }}"
                        alt="{{ $kepsek->nama ?? 'Kepala Sekolah' }}"
                        class="w-full h-[600px] object-cover object-top">

                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-green-900/95 via-green-900/80 to-transparent p-8 pt-24 text-white">
                        <h3 class="font-bold text-3xl mb-1">{{ $kepsek->nama ?? 'Nama Belum Diisi' }}</h3>
                        <p class="text-green-300 font-medium text-lg mb-3">Kepala Sekolah</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 w-full px-4 sm:px-6 md:px-10 flex flex-col items-center text-center reveal-on-scroll transform duration-1000 translate-y-10 opacity-0 delay-200"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">

                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="h-1 w-10 bg-green-600 rounded-full"></span>
                    <span class="text-green-600 font-bold text-sm tracking-wider uppercase">Visi & Misi</span>
                    <span class="h-1 w-10 bg-green-600 rounded-full"></span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $visiMisi->visi }}
                </h2>

                <p class="text-gray-500 mb-8 leading-relaxed italic max-w-2xl mx-auto">
                    {{ $visiMisi->visi_subtitle }}
                </p>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8 w-full text-left shadow-sm">
                    <h4 class="font-bold text-gray-800 mb-6 flex items-center justify-center md:justify-start gap-2 border-b border-gray-200 pb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Misi Sekolah
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                        @foreach($visiMisi->misi as $item)
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-green-100 p-2 rounded-full text-green-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-sm text-gray-800">{{ $item['judul'] }}</h5>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $item['deskripsi'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="w-full flex justify-center">
                    <a href="{{ url('/profil/kepala-sekolah') }}" class="inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transition shadow-lg shadow-green-600/30 transform hover:-translate-y-1">
                        Lihat Profil Lengkap
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-24 bg-gray-50 overflow-x-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex w-full flex-col md:flex-row justify-between items-end mb-12 gap-4 reveal-on-scroll transform duration-1000"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <div class="max-w-2xl">
                <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-green-600 text-xs font-bold tracking-wider uppercase mb-2">
                     Kabar Sekolah
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                    Berita & Kegiatan <br>
                    <span class="text-green-600">Terbaru</span>
                </h2>
                <p class="text-gray-500 mt-4 text-lg">
                    Update informasi kegiatan sekolah, pengumuman akademik, serta berbagai aktivitas siswa dan guru.
                </p>
            </div>

            <a href="{{ url('/berita') }}" class="hidden md:inline-flex items-center gap-2 text-green-600 font-bold hover:text-green-700 transition group">
                Lihat Berita Lainnya
                <span class="bg-green-100 p-2 rounded-full group-hover:bg-green-600 group-hover:text-white transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
            </a>
        </div>

        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

            @forelse($beritas as $index => $item)
            <article class="bg-white w-full rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 group flex flex-col h-full reveal-on-scroll transform duration-1000"
                style="transition-delay: {{ ($index + 1) * 100 }}ms"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'">

                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset($item->gambar) }}"
                        alt="{{ $item->judul }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">

                    <div class="absolute top-4 left-4">
                        <span class="bg-green-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            {{ $item->kategori->nama }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-4 text-xs text-gray-400 mb-3">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $item->penulis }}</span>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition leading-snug">
                        <a href="{{ url('/berita/'.$item->slug) }}">{{ $item->judul }}</a>
                    </h3>

                    <p class="text-gray-500 text-sm mb-4 line-clamp-3">
                        {!! Str::limit(strip_tags($item->konten), 120) !!}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ url('/berita/'.$item->slug) }}" class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-800 transition">
                            Baca Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-400">Belum ada berita terbaru.</p>
            </div>
            @endforelse

        </div>

        <div class="mt-8 w-full text-center md:hidden">
            <a href="{{ url('/berita') }}" class="inline-block w-full py-3 px-6 bg-white border border-gray-200 rounded-lg text-green-600 font-bold hover:bg-gray-50 transition">
                Lihat Berita Lainnya
            </a>
        </div>

    </div>
</section>

<section class="py-24 bg-white overflow-x-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll transform duration-1000"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-green-600 text-xs font-bold tracking-wider uppercase mb-2">
                ● Ekonomi Kreatif
            </span>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Produk Unggulan <span class="text-green-600">Murid</span>
            </h2>
            <p class="text-gray-500 text-lg">
                Dukung kreativitas siswa dengan membeli produk karya murid. Dibuat dengan penuh kreativitas, berkualitas, dan harga terjangkau.
            </p>
        </div>

        <div class="grid w-full grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">

            @forelse($produk as $index => $item)
            <div class="group bg-white w-full rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden flex flex-col reveal-on-scroll transform duration-1000"
                style="transition-delay: {{ ($index + 1) * 100 }}ms"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0'">

                <div class="relative h-64 overflow-hidden bg-gray-100">
                    <img src="{{ asset($item->foto) }}"
                        alt="{{ $item->nama_usaha }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-gray-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        {{ $item->kategori->nama }}
                    </span>
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <p class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Oleh: {{ $item->pemilik }}
                    </p>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-1" title="{{ $item->nama_usaha }}">
                        {{ $item->nama_usaha }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                        {{ $item->deskripsi }}
                    </p>

                    <div class="mt-auto flex items-center justify-between">
                        <span class="text-green-600 font-bold text-lg">
                            @if($item->harga_mulai)
                            Rp {{ number_format($item->harga_mulai, 0, ',', '.') }}
                            @else
                            Chat
                            @endif
                        </span>
                        <a href="https://wa.me/{{ $item->no_wa }}?text=Halo%20{{ $item->pemilik }},%20saya%20tertarik%20dengan%20{{ $item->nama_usaha }}%20yang%20dilihat%20di%20website%20Sekolah."
                            target="_blank"
                            class="p-2 bg-green-100 text-green-600 rounded-full hover:bg-[#25D366] hover:text-white transition shadow-sm"
                            title="Hubungi Penjual via WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.883 1.056 4.024 1.61 6.199 1.61h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                <p class="text-gray-500 italic">Belum ada produk yang ditampilkan.</p>
            </div>
            @endforelse

        </div>

        <div class="mt-12 text-center reveal-on-scroll transform duration-1000 delay-500"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <a href="{{ url('/produk') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white border border-green-600 text-green-600 font-bold rounded-full hover:bg-green-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-lg">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4-4 4M3 12h18" />
                </svg>
            </a>
        </div>

    </div>

    <div class="mt-16 w-full bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-8 md:p-12 text-center md:text-left relative overflow-hidden reveal-on-scroll transform duration-1000 scale-95 opacity-0"
        :class="shown ? 'scale-100 opacity-100' : 'scale-95 opacity-0'">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-black opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="text-white">
                <h3 class="text-2xl md:text-3xl font-bold mb-2">Punya Produk?</h3>
                <p class="text-green-100 max-w-xl">
                    Daftarkan produk Anda sekarang di website sekolah secara gratis dan jangkau lebih banyak pembeli secara digital.
                </p>
            </div>
            <a href="https://wa.me/{{informasi_umum('kontak_wa')}}?text=Halo%20Admin%20Sekolah%2C%20saya%20ingin%20mendaftarkan%20produk%20saya%20di%20website%20sekolah.%0A%0ANama%20Usaha%3A%20%0APemilik%3A%20%0AKategori%3A%20%0ADeskripsi%3A%20%0A%0AMohon%20bantuannya%20untuk%20diproses.%20Terima%20kasih."
                target="_blank"
                class="inline-flex items-center gap-3 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold py-3 px-6 rounded-xl transition shadow-lg shadow-green-600/20 group">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="transition-transform group-hover:scale-110">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.883 1.056 4.024 1.61 6.199 1.61h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                <span>Daftar Produk Sekarang</span>
            </a>
        </div>
    </div>

    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Galeri Sekolah</h2>
            <p class="mt-4 text-lg text-gray-500">Dokumentasi berbagai kegiatan sekolah, prestasi siswa, serta momen kebersamaan di {{informasi_umum('nama_sekolah')}}.</p>
        </div>

        <div x-data="{ active: 3 }" class="flex flex-col md:flex-row w-full h-[600px] md:h-[500px] gap-2 md:gap-4 transition-all duration-300">

            @foreach($galleries as $index => $gallery)
            <div
                @mouseenter="active = {{ $index + 1 }}"
                @click="active = {{ $index + 1 }}"
                class="relative overflow-hidden rounded-2xl transition-all duration-700 ease-in-out cursor-pointer group"
                :class="active === {{ $index + 1 }} ? 'h-[40%] md:h-full md:w-[60%]' : 'h-[15%] md:h-full md:w-[10%]'">
                @if($gallery->image)
                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700"
                    :class="active === {{ $index + 1 }} ? 'scale-100' : 'scale-110'">
                @else
                <div class="absolute inset-0 w-full h-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-camera text-gray-400 text-3xl"></i>
                </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent transition-opacity duration-500"
                    :class="active === {{ $index + 1 }} ? 'opacity-100' : 'opacity-60 md:opacity-40'"></div>

                <div class="absolute bottom-0 left-0 w-full h-full p-4 md:p-6 flex flex-col justify-end pointer-events-none">
                    <div class="transition-all duration-500 transform"
                        :class="active === {{ $index + 1 }} ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-100 md:opacity-0'">
                        <h3 class="text-white font-bold text-lg md:text-2xl flex items-center gap-2 drop-shadow-md">
                            <span class="bg-blue-500 w-6 h-1 rounded-full inline-block transition-all duration-500"
                                :class="active === {{ $index + 1 }} ? 'opacity-100' : 'opacity-0 w-0'"></span>
                            {{ $gallery->title }}
                        </h3>
                        <p class="text-gray-200 text-sm mt-2 line-clamp-2 transition-all duration-500 delay-100 overflow-hidden drop-shadow-md"
                            :class="active === {{ $index + 1 }} ? 'max-h-20 opacity-100' : 'max-h-0 opacity-0'">
                            {{ $gallery->description }}
                        </p>
                    </div>

                    <div class="hidden md:flex absolute inset-0 items-center justify-center transition-all duration-500 pointer-events-none"
                        :class="active === {{ $index + 1 }} ? 'opacity-0 z-[-1]' : 'opacity-100 z-10'">
                        <h3 class="text-white font-bold text-lg md:text-xl tracking-widest uppercase transform -rotate-90 whitespace-nowrap drop-shadow-[0_4px_4px_rgba(0,0,0,0.8)]">
                            {{ $gallery->title }}
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-white relative z-20" x-data="{ shown: false }" x-intersect.threshold.10="shown = true">
    <div class="container mx-auto px-4 sm:px-6 max-w-4xl">

        <div class="text-center mb-12 sm:mb-16 transform transition-all duration-700 opacity-0"
            :class="shown ? 'opacity-100 translate-y-0' : 'translate-y-8'">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tanya Jawab <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-500">Seputar Sekolah</span></h2>
            <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto">
                Informasi cepat untuk pertanyaan yang sering diajukan terkait layanan, jadwal, dan program sekolah.
            </p>
        </div>

        <div class="space-y-4 transform transition-all duration-700 delay-200 opacity-0"
            :class="shown ? 'opacity-100 translate-y-0' : 'translate-y-12'"
            x-data="{ activeTab: 0 }">

            @forelse($faqs as $faq)
            <div class="bg-gray-50 border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300 hover:border-green-200"
                :class="activeTab === {{ $loop->iteration }} ? 'ring-2 ring-green-500/20 bg-white shadow-md' : ''">
                <button @click="activeTab === {{ $loop->iteration }} ? activeTab = 0 : activeTab = {{ $loop->iteration }}"
                    class="flex items-center justify-between w-full p-5 sm:p-6 text-left focus:outline-none">
                    <span class="text-base sm:text-lg font-bold text-gray-900 transition-colors pr-4" :class="activeTab === {{ $loop->iteration }} ? 'text-green-600' : ''">
                        {{ $faq->pertanyaan }}
                    </span>
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center shrink-0 transition-transform duration-300"
                        :class="activeTab === {{ $loop->iteration }} ? 'bg-green-50 border-green-200 rotate-180' : ''">
                        <svg class="w-4 h-4 text-gray-500" :class="activeTab === {{ $loop->iteration }} ? 'text-green-600' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>
                <div x-show="activeTab === {{ $loop->iteration }}"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="px-5 sm:px-6 pb-5 sm:pb-6" style="display: none;">
                    <p class="text-gray-500 text-sm leading-relaxed border-t border-gray-100 pt-4 whitespace-pre-line">
                        {{ $faq->jawaban }}
                    </p>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-8 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                Belum ada data Tanya Jawab yang ditambahkan.
            </div>
            @endforelse

        </div>
    </div>
</section>

<section class="py-24 bg-gray-50 overflow-x-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid w-full grid-cols-1 gap-12 items-center md:grid-cols-2">

            <div class="w-full reveal-on-scroll transform duration-1000 -translate-x-10 opacity-0"
                :class="shown ? 'translate-x-0 opacity-100' : '-translate-x-10 opacity-0'">
                <span class="inline-block py-1 px-3 rounded-full bg-green-100 text-green-600 text-xs font-bold tracking-wider uppercase mb-2">
                    ● Hubungi Kami
                </span>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    Datang & Kunjungi <br>
                    <span class="text-green-600">{{informasi_umum('nama_sekolah')}}</span>
                </h2>
                <p class="text-gray-500 mb-8 text-lg">
                    Kami siap memberikan informasi dan pelayanan kepada siswa, orang tua, serta masyarakat pada jam kerja. Silakan hubungi kami melalui kontak di bawah ini.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="bg-white p-3 rounded-full shadow-md text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Alamat Kantor</h4>
                            <p class="text-gray-500 text-sm">{{ $profil->alamat ?? 'Alamat sekolah belum diatur.' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-white p-3 rounded-full shadow-md text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Kontak Resmi</h4>
                            <p class="text-gray-500 text-sm">{{ $profil->email ?? 'email@sekolah.id' }}</p>
                            <p class="text-gray-500 text-sm">{{ $profil->telepon ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-white p-3 rounded-full shadow-md text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Jam Pelayanan</h4>
                            <div class="text-gray-500 text-sm">{!! nl2br(e($profil->jam_pelayanan ?? 'Senin - Jumat: 08.00 - 15.00')) !!}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-[300px] md:h-[400px] w-full max-w-2xl mx-auto rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative reveal-on-scroll transform duration-1000 translate-y-10 opacity-0 delay-200"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">

                @if($profil && $profil->iframe_google_maps)
                <div class="w-full h-full min-h-[300px] rounded-xl overflow-hidden shadow-sm">
                    {!! $profil->iframe_google_maps !!}
                </div>
                @else
                <div class="w-full h-full min-h-[300px] bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
                    Peta Google Maps belum diatur di Admin.
                </div>
                @endif

                <div class="absolute inset-0 pointer-events-none border-4 border-black/5 rounded-3xl"></div>
            </div>

        </div>
    </div>
</section>

@endsection