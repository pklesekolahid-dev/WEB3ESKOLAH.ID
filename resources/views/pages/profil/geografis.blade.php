@extends('layouts.main')

@section('title', 'Geografis Sekolah')

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
                ● Profil Sekolah
            </span>
        </div>

        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Geografis Sekolah
        </h1>

        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            {{ $geografis?->hero_desc ?? '' }}
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 md:py-20 bg-white" x-data="{ shown: false }" x-intersect.threshold.10="shown = true">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12">

            <div class="reveal-on-scroll transform duration-1000 translate-y-10 opacity-0"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                <div class="bg-white p-2 rounded-2xl shadow-xl border border-gray-100">
                    <div class="relative h-[300px] md:h-[400px] rounded-xl overflow-hidden [&>iframe]:w-full [&>iframe]:h-full">
                        {!! $geografis?->maps_embed_url ?? '' !!}
                    </div>
                </div>
                <p class="text-center text-gray-400 text-xs md:text-sm mt-4 italic">
                    *Peta wilayah Sekolah via Google Maps
                </p>
            </div>

            <div class="reveal-on-scroll transform duration-1000 translate-y-10 opacity-0 delay-200"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $geografis?->maps_caption ?? '' }}</h2>
                <p class="text-gray-500 mb-8 leading-relaxed text-base md:text-lg">
                    {{ $geografis?->letak_desc ?? '' }}
                </p>

                <div class="grid grid-cols-1 gap-4">
                    @foreach($geografis?->batas ?? [] as $item)
                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border-l-4 border-{{ $item['warna'] }}-500 hover:shadow-md transition">
                        <div class="w-10 h-10 bg-{{ $item['warna'] }}-100 text-{{ $item['warna'] }}-600 rounded-full flex items-center justify-center font-bold shrink-0">{{ $item['singkatan'] }}</div>
                        <div>
                            <p class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wide">{{ $item['arah'] }}</p>
                            <h4 class="font-bold text-gray-900 text-sm md:text-base">{{ $item['nama'] }}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 md:py-20 bg-green-600 text-white" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">{{ $geografis?->topografi_title ?? '' }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center reveal-on-scroll transform duration-1000 translate-y-10 opacity-0"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            @foreach($geografis?->topografi ?? [] as $item)
            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl hover:bg-white/20 transition group">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition">
                    <i class="{{ $item['icon'] }}"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $item['judul'] }}</h3>
                <p class="text-green-100 text-sm">{{ $item['deskripsi'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
