@extends('layouts.main')

@section('title', 'Struktur Organisasi')

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
            Struktur Organisasi Sekolah
        </h1>

        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Keluarga besar {{ informasi_umum('nama_sekolah') }} yang berkomitmen memberikan pendidikan terbaik serta membimbing siswa menuju masa depan yang berprestasi.
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 px-4 bg-white relative z-10 -mt-2">
    <div class="container mx-auto max-w-6xl">

        <div class="flex flex-col items-center justify-center mb-12 relative z-10">

            <span class="bg-green-600 text-white text-[10px] font-bold px-4 py-1 rounded-t-lg uppercase tracking-widest mb-0 z-20 shadow-md">
                Pimpinan
            </span>

            <div class="w-80 bg-white rounded-2xl shadow-2xl border-t-4 border-green-600 overflow-hidden transform hover:-translate-y-2 transition duration-300 relative z-10">
                <div class="h-72 overflow-hidden bg-gray-100 relative group">
                    <img src="{{ isset($kepsek) && $kepsek->foto ? asset($kepsek->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kepsek->nama ?? 'Kepala Desa') . '&background=059669&color=fff&size=400' }}"
                        class="w-full h-full object-cover object-top transition duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                </div>

                <div class="p-6 text-center relative -mt-12">
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-1 leading-tight">{{ $kepsek->nama ?? 'Nama Belum Diisi' }}</h3>
                        <p class="text-green-600 font-bold text-sm uppercase tracking-wide">Kepala Sekolah</p>
                        @if(isset($kepsek->nip))
                        <div class="mt-3 flex items-center justify-center gap-1 text-gray-400 text-xs font-mono bg-gray-50 py-1 px-2 rounded">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.896 1.667-2 1.667a2.001 2.001 0 00-1.99 2m5.99-2c0 .884.896 1.667 2 1.667A2.001 2.001 0 0019.01 8" />
                            </svg>
                            NIP: {{ $kepsek->nip }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="h-16 w-0.5 bg-gray-300 mt-0 shadow-sm"></div>
        </div>

        <div class="relative mb-20">
            <div class="text-center mb-8 relative z-20">
                <span class="bg-white text-gray-400 text-[10px] font-bold px-4 py-1 uppercase tracking-widest border border-gray-200 rounded-full">
                    STAFF INTI
                </span>
            </div>

            <div class="absolute top-0 left-4 right-4 md:left-20 md:right-20 h-0.5 bg-gray-300 -mt-10 hidden md:block z-0"></div>

            <div class="absolute left-1/2 -ml-px top-0 h-10 w-0.5 bg-gray-300 -mt-10 z-0 hidden md:block"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 justify-center relative z-10">
                @forelse($staf as $p)
                <div class="flex flex-col items-center">
                    <div class="h-10 w-0.5 bg-gray-300 -mt-10 mb-0 hidden md:block"></div>

                    <div class="bg-white w-full max-w-[260px] rounded-xl shadow-lg hover:shadow-2xl border border-gray-100 overflow-hidden transition-all duration-300 group mt-4 md:mt-0">
                        <div class="p-5 flex flex-col items-center text-center">
                            <div class="w-20 h-20 mb-3 rounded-full overflow-hidden border-4 border-green-50 shadow-md group-hover:border-green-200 transition">
                                <img src="{{ $p->foto ? asset($p->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($p->nama) . '&background=random&color=fff' }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <h4 class="font-bold text-gray-800 text-sm mb-1 group-hover:text-green-700 transition line-clamp-1">{{ $p->nama }}</h4>
                            <p class="text-[11px] font-bold text-green-600 uppercase bg-green-50 px-2 py-0.5 rounded mb-2">{{ $p->jabatan }}</p>

                            @if($p->nip)
                            <p class="text-[10px] text-gray-400 font-mono border-t border-gray-100 pt-2 w-full">
                                {{ $p->nip }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                    <p class="text-gray-500 text-sm">Data Tenaga Pendidik dan Staf (Sekretariat) belum diinput.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="flex items-center gap-4 mb-10 mt-16">
            <div class="h-px bg-gray-200 flex-1"></div>
            <h2 class="text-lg font-bold text-gray-800 uppercase tracking-wider">
                Guru/Walikelas
            </h2>
            <div class="h-px bg-gray-200 flex-1"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($guru as $g)
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:border-green-400 transition flex items-center gap-4 group">
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-gray-100 shrink-0 group-hover:scale-105 transition">
                    <img src="{{ $g->foto ? asset($g->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($g->nama) . '&background=f97316&color=fff' }}"
                        class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">{{ $g->nama }}</h4>
                    <p class="text-xs font-bold text-orange-600 mt-0.5 mb-1">
                        {{ $g->jabatan }}
                    </p>
                    @if($g->nip)
                    <div class="flex items-center gap-1 text-[10px] text-gray-400 font-mono">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        {{ $g->nip }}
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-6 text-gray-400 text-sm bg-gray-50 rounded-lg">
                Belum ada data Guru/Walikelas.
            </div>
            @endforelse
        </div>

    </div>
</section>

@endsection