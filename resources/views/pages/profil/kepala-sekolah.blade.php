@extends('layouts.main')

@section('title', 'Profil Kepala Sekolah')

@section('content')
<header class="relative pt-24 pb-32 md:pt-28 md:pb-40 bg-gradient-to-br from-green-600 to-emerald-700 text-white overflow-hidden"
    x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)">

    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0"></div>
    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-10 w-48 h-48 bg-black/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10 text-center -mt-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Profil Kepala Sekolah
        </h1>
        <div class="text-green-100 text-sm font-medium flex justify-center items-center gap-2 transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <a href="{{ url('/') }}" class="hover:text-white underline transition">Beranda</a> /
            <span class="text-green-200">Profil Pimpinan</span>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#f9fafb" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">

        @if($kepsek) <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            <div class="relative lg:sticky lg:top-24 mb-8 lg:mb-0 lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-green-50 to-green-100 z-0"></div>

                    <div class="relative z-10 mb-6">
                        <div class="w-48 h-48 mx-auto rounded-full p-1 bg-white shadow-lg">
                            <img src="{{ $kepsek->foto ? asset($kepsek->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($kepsek->nama) . '&background=0D8ABC&color=fff' }}"
                                alt="{{ $kepsek->nama }}"
                                class="w-full h-full object-cover rounded-full border-4 border-green-50">
                        </div>
                    </div>

                    <div class="relative z-10 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $kepsek->nama }}</h2>
                        <p class="text-green-600 font-medium text-sm mt-1">
                            {{ $kepsek->nip ? 'NIP: ' . $kepsek->nip : 'Kepala Desa' }}
                        </p>
                    </div>

                    @if($kepsek->visi_misi)
                    <div class="relative z-10 bg-green-50 rounded-xl p-4 mb-8">
                        <svg class="w-6 h-6 text-green-300 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path>
                        </svg>
                        <p class="text-gray-600 text-sm italic">
                            "{!! nl2br(e($kepsek->visi_misi)) !!}"
                        </p>
                    </div>
                    @endif

                    <div class="relative z-10 flex justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-blue-600 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-green-600 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-3.138-5.437-2.16-11.97 2.368-16.49 4.885-4.887 12.83-4.883 17.72.005 4.904 4.903 4.896 12.858-.006 17.733-4.526 4.522-11.042 5.502-16.48 2.363l-6.175 1.688zm6.54-9.395c-.322-.176-1.905-.938-2.2-.1.045-.297-.145-.595-.152-.693-.06-.113-.238-.176-.497-.176-.257 0-.67.096-1.026.47-.356.375-1.357 1.325-1.357 3.232 0 1.908 1.39 3.75 1.583 4.01.194.26 2.73 4.167 6.612 5.845 2.68 1.16 3.227.93 3.82.87.592-.058 1.905-.778 2.172-1.53.267-.75.267-1.393.187-1.53-.08-.135-.297-.215-.62-.375-.32-.16-1.903-.938-2.198-1.045-.296-.107-.512-.16-.728.16-.216.323-.833 1.045-1.02.126-.188.215-.376.242-.698.08-.322-.16-1.358-.5-2.585-1.594-1.228-1.093-2.057-2.443-2.296-2.854-.237-.41-.026-.632.178-.835.186-.184.413-.48.62-.72.207-.24.276-.41.414-.683.138-.27.07-.51-.035-.72-.104-.21-1.026-2.47-1.405-3.376z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-600 rounded-full"></span>
                        Biodata Diri
                    </h3>
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-3">
                            <span class="text-gray-500 w-40 flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg> Nama Lengkap</span>
                            <span class="font-semibold text-gray-900">{{ $kepsek->nama }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-3">
                            <span class="text-gray-500 w-40 flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg> Tempat, Tgl Lahir</span>
                            <span class="font-semibold text-gray-900">
                                {{ $kepsek->tempat_lahir ?? '-' }}, {{ $kepsek->tanggal_lahir ? $kepsek->tanggal_lahir->format('d F Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-3">
                            <span class="text-gray-500 w-40 flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg> Alamat</span>
                            <span class="font-semibold text-gray-900">{{ $kepsek->alamat ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                @if($kepsek->pendidikan)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-600 rounded-full"></span>
                        Riwayat Pendidikan
                    </h3>
                    <div class="relative border-l-2 border-green-100 ml-3 space-y-8">
                        @foreach(explode("\n", $kepsek->pendidikan) as $edu)
                        @if(trim($edu) != "")
                        <div class="relative pl-8">
                            <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-green-500 border-4 border-white shadow"></div>
                            <h4 class="font-bold text-gray-900 text-lg">{{ trim($edu) }}</h4>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                @if($kepsek->organisasi)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-600 rounded-full"></span>
                        Pengalaman Organisasi & Kerja
                    </h3>
                    <ul class="space-y-4">
                        @foreach(explode("\n", $kepsek->organisasi) as $org)
                        @if(trim($org) != "")
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ trim($org) }}</h4>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>
        @else
        <div class="text-center py-20">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <h3 class="text-xl font-bold text-gray-600">Profil Kepala Desa Belum Diisi</h3>
            <p class="text-gray-500 mt-2">Silakan login ke Admin Panel untuk melengkapi data Profil Kepala Desa.</p>
        </div>
        @endif

    </div>
</section>
@endsection