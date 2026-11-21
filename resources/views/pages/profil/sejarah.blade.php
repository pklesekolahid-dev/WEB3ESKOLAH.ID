@extends('layouts.main')

@section('title', 'Sejarah Sekolah')

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
            Sejarah Sekolah
        </h1>

        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            {{ $sejarah->hero_desc }}
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="bg-white pb-16 pt-8 md:pb-20" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div class="relative reveal-on-scroll transform duration-1000 translate-y-10 opacity-0"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                <div class="absolute inset-0 bg-green-600 rounded-2xl transform rotate-3 scale-100 opacity-20"></div>

                <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                    <img src="{{ asset($sejarah->hero_img) }}"
                        alt="Sejarah Sekolah"
                        class="w-full h-[300px] md:h-[500px] object-cover transition duration-700 group-hover:scale-105 filter sepia-[.3]">

                    <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent p-6 w-full">
                        <p class="text-white/80 text-sm italic">"{{ $sejarah->hero_caption }}"</p>
                    </div>
                </div>
            </div>

            <div class="reveal-on-scroll transform duration-1000 translate-y-10 opacity-0 delay-200"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                <span class="text-green-600 font-bold tracking-wider uppercase text-sm">{{ $sejarah->asal_tag }}</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-6">{{ $sejarah->asal_title }}</h2>

                <div class="space-y-4 text-gray-500 text-base md:text-lg leading-relaxed text-justify">
                    @foreach($sejarah->paragraf as $item)
                    <p>{!! $item !!}</p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

@if(!empty($sejarah->timeline))
<section class="py-16 md:py-20 bg-gray-50" x-data="{ shown: false }" x-intersect.threshold.10="shown = true">
    <div class="container mx-auto px-6">
        @if(!empty($sejarah->timeline))
        <section class="py-16 md:py-20 bg-gray-50" x-data="{ shown: false }" x-intersect.threshold.10="shown = true">
            <div class="container mx-auto px-6">

                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $sejarah->timeline_title ?? 'Jejak Langkah Sekolah' }}
                    </h2>
                    @if($sejarah->timeline_sub)
                    <p class="text-gray-500 mt-2">{{ $sejarah->timeline_sub }}</p>
                    @endif
                </div>

                <div class="max-w-3xl mx-auto relative pl-8 md:pl-0">
                    <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gray-200 transform -translate-x-1/2"></div>

                    <div class="space-y-12">
                        @foreach($sejarah->timeline as $i => $item)

                        @php $isEven = $i % 2 === 0; @endphp

                        <div class="relative flex flex-col md:flex-row items-center transform transition-all duration-1000"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                            style="transition-delay: {{ $i * 100 }}ms">

                            {{-- Kiri (item genap di desktop) --}}
                            <div class="md:w-1/2 md:pr-12 pl-12 md:pl-0 w-full mb-4 md:mb-0 {{ $isEven ? 'order-2 md:order-1' : 'order-1' }}">
                                @if(!$isEven)
                                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 md:border-l-0 md:border-r-4 border-green-600 md:text-right">
                                    <span class="text-green-600 font-bold text-xl block mb-2">{{ $item['tahun'] }}</span>
                                    <h3 class="font-bold text-gray-900 mb-2">{{ $item['judul'] }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $item['deskripsi'] }}</p>
                                </div>
                                @endif
                            </div>

                            {{-- Dot tengah --}}
                            <div class="absolute left-8 md:left-1/2 w-8 h-8 bg-green-600 rounded-full border-4 border-white shadow-lg transform -translate-x-1/2 flex items-center justify-center text-white text-xs font-bold z-10 top-0 md:top-auto">
                                {{ $i + 1 }}
                            </div>

                            {{-- Kanan (item ganjil di desktop) --}}
                            <div class="md:w-1/2 md:pl-12 pl-12 w-full {{ $isEven ? 'order-1 md:order-2' : 'order-2' }}">
                                @if($isEven)
                                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-600">
                                    <span class="text-green-600 font-bold text-xl block mb-2">{{ $item['tahun'] }}</span>
                                    <h3 class="font-bold text-gray-900 mb-2">{{ $item['judul'] }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $item['deskripsi'] }}</p>
                                </div>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
        @endif
</section>
@endif

@if(!empty($sejarah->kepala))
<section class="py-16 md:py-20 bg-white" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-6">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">
                {{ $sejarah->kepala_title ?? 'Pimpinan Sekolah dari Masa ke Masa' }}
            </h2>
            @if($sejarah->kepala_sub)
            <p class="text-gray-500 mt-2">{{ $sejarah->kepala_sub }}</p>
            @endif
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 transform transition-all duration-1000"
            :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">

            @foreach($sejarah->kepala as $kepala)
            @php $aktif = $kepala['aktif'] ?? false; @endphp
            <div class="text-center group">
                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto rounded-full overflow-hidden border-4 shadow-lg mb-4 transition duration-500
                                {{ $aktif ? 'border-green-500' : 'border-gray-100 grayscale group-hover:grayscale-0' }}">
                    <img src="{{ $kepala['foto_url'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($kepala['nama']) . '&background=16a34a&color=fff' }}"
                        alt="{{ $kepala['nama'] }}"
                        class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-sm md:text-base {{ $aktif ? 'text-green-700' : 'text-gray-900' }}">
                    {{ $kepala['nama'] }}
                </h4>
                <p class="text-[10px] md:text-xs inline-block px-2 py-1 rounded mt-1
                              {{ $aktif ? 'text-white bg-green-600' : 'text-gray-500 bg-gray-100' }}">
                    {{ $kepala['periode'] }}
                </p>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
@endsection