@extends('layouts.main')

@section('title', 'Visi & Misi')

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
            Visi & Misi
        </h1>

        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            {{ $visiMisi?->header_subtitle ?? 'Informasi visi dan misi belum tersedia.' }}
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
        <div class="max-w-4xl mx-auto text-center reveal-on-scroll transform duration-1000 scale-95 opacity-0"
            :class="shown ? 'scale-100 opacity-100' : 'scale-95 opacity-0'">

            <div class="relative">
                <svg class="hidden sm:block absolute -top-8 -left-8 w-16 h-16 text-gray-100 transform -scale-x-100" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21L14.017 18C14.017 16.896 14.353 16.04 15.025 15.432C15.697 14.824 16.93 13.972 18.724 12.876C19.396 12.428 19.732 11.556 19.732 10.26C19.732 8.796 19.264 7.612 18.328 6.708C17.392 5.804 16.208 5.352 14.776 5.352C13.24 5.352 11.996 5.86 11.044 6.876C10.092 7.892 9.616 9.224 9.616 10.872L9.616 21L14.017 21ZM5.417 21L5.417 18C5.417 16.896 5.753 16.04 6.425 15.432C7.097 14.824 8.33 13.972 10.124 12.876C10.796 12.428 11.132 11.556 11.132 10.26C11.132 8.796 10.664 7.612 9.728 6.708C8.792 5.804 7.608 5.352 6.176 5.352C4.64 5.352 3.396 5.86 2.444 6.876C1.492 7.892 1.016 9.224 1.016 10.872L1.016 21L5.417 21Z" />
                </svg>

                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight relative z-10">
                    {{ $visiMisi?->visi ?? 'Visi sekolah belum diatur.' }}
                </h2>
            </div>

            <p class="mt-8 text-gray-500 text-base md:text-lg max-w-2xl mx-auto">
                {{ $visiMisi?->visi_subtitle ?? '' }}
            </p>
        </div>
    </div>
</section>

<section class="py-16 md:py-20 bg-gray-50" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-900">Misi Sekolah</h3>
            <p class="text-gray-500 mt-2">Langkah strategis yang kami lakukan untuk mencapai visi.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">

            @foreach($visiMisi?->misi ?? [] as $item)
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border-l-4 border-green-500 reveal-on-scroll transform duration-1000 translate-y-10 opacity-0"
                :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                <div class="flex items-start gap-4">
                    <div class="bg-{{ $item['warna'] }}-100 p-3 rounded-lg text-{{ $item['warna'] }}-600 shrink-0">
                        <i class="{{ $item['icon'] }} {{ $item['warna'] }}-200"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $item['judul'] }}</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            {{ $item['deskripsi'] }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-white" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="container mx-auto px-6 text-center reveal-on-scroll transform duration-1000 translate-y-10 opacity-0"
        :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
        <h2 class="text-2xl font-bold mb-8 uppercase tracking-widest text-green-600">Nilai & Motto Sekolah</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            @foreach($visiMisi?->nilai ?? [] as $data)
            <div class="p-6 bg-gray-50 border border-gray-100 rounded-xl hover:shadow-md hover:border-green-500 hover:bg-white transition duration-300">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $data['judul'] }}</h3>
                <p class="text-sm text-gray-500">{{ $data['deskripsi'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
