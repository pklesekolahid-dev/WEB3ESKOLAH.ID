@extends('layouts.main')

@section('title', 'Informasi Umum - Profil Sekolah')

@section('content')
<header class="relative pt-24 pb-32 md:pt-28 md:pb-40 bg-gradient-to-br from-green-600 to-emerald-700 text-white overflow-hidden"
    x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)">

    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0"></div>
    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-10 w-48 h-48 bg-black/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10 text-center -mt-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 transform transition-all duration-700 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Informasi Umum Sekolah
        </h1>
        <p class="text-green-100 text-sm md:text-base font-medium tracking-wide transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <a href="{{ url('/') }}" class="hover:text-white transition underline decoration-transparent hover:decoration-white underline-offset-4">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-white">Profil</span>
            <span class="mx-2">/</span>
            <span class="text-white">Informasi Umum</span>
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-16 bg-white relative z-30" x-data="{ shown1: false }" x-intersect.threshold.10="shown1 = true">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="transform transition-all duration-700" :class="shown1 ? 'opacity-100 translate-x-0' : '-translate-x-12 opacity-0'">
                <div class="mb-6 flex items-center gap-3">
                    <div class="w-1.5 h-8 bg-green-600 rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Identitas Sekolah</h2>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-200 pb-4">
                        <span class="text-gray-500 font-medium">Nama Sekolah</span>
                        <span class="font-bold text-gray-900 text-right">{{ $informasi->nama_sekolah }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-4">
                        <span class="text-gray-500 font-medium">Kecamatan</span>
                        <span class="font-bold text-gray-900 text-right">{{ $informasi->kecamatan }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-4">
                        <span class="text-gray-500 font-medium">Kabupaten</span>
                        <span class="font-bold text-gray-900 text-right">{{ $informasi->kabupaten }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-4">
                        <span class="text-gray-500 font-medium">Kode Pos</span>
                        <span class="font-bold text-gray-900 text-right">{{ $informasi->kode_pos }}</span>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-500 font-medium">Jumlah Murid</span>
                        <span class="font-bold text-green-600 text-right">{{ number_format($statistics['gender_laki']+$statistics['gender_perempuan']) }}</span>
                    </div>
                </div>
            </div>

            <div class="transform transition-all duration-700 delay-200" :class="shown1 ? 'opacity-100 translate-x-0' : 'translate-x-12 opacity-0'">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                    @if($informasi->foto_identitas)
                    <img src="{{ asset($informasi->foto_identitas) }}" alt="Foto Sekolah" class="w-full h-[400px] object-cover transform group-hover:scale-105 transition duration-700">
                    @else
                    <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Ilustrasi Sekolah" class="w-full h-[400px] object-cover transform group-hover:scale-105 transition duration-700">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <span class="bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2 inline-block">Galeri Sekolah</span>
                        <h3 class="text-white font-bold text-xl">{{ $informasi->nama_sekolah }}</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-gray-50" x-data="{ shown2: false }" x-intersect.threshold.10="shown2 = true">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-12 transform transition-all duration-700" :class="shown2 ? 'opacity-100 translate-y-0' : 'translate-y-8 opacity-0'">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 border-b-4 border-green-500 inline-block pb-2">Potensi & Keunggulan</h2>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                Sekolah ini berfokus pada pengembangan akademik, karakter, dan keterampilan siswa melalui lingkungan belajar yang inovatif dan mendukung terciptanya generasi unggul.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($keunggulans as $keunggulan)
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-500 transition-all duration-300 transform" :class="shown2 ? 'opacity-100 translate-y-0' : 'translate-y-12 opacity-0'">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6">
                    <img src="{{ asset($keunggulan->icon) }}"
                        alt="Icon {{ $keunggulan->judul }}">
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $keunggulan->judul }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $keunggulan->deskripsi }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-white" x-data="{ shown3: false }" x-intersect.threshold.10="shown3 = true">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center flex-col-reverse lg:flex-row-reverse">

            <div class="transform transition-all duration-700" :class="shown3 ? 'opacity-100 translate-x-0' : 'translate-x-12 opacity-0'">
                <div class="mb-6 flex items-center gap-3">
                    <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Fasilitas Umum</h2>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 text-center">
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $informasi->jumlah_sekolah }}</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide">{{ informasi_umum('nama_fasilitas_1') }}</div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 text-center">
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $informasi->jumlah_ibadah }}</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide">{{ informasi_umum('nama_fasilitas_2') }}</div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 text-center">
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $informasi->jumlah_puskesmas }}</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide">{{ informasi_umum('nama_fasilitas_3') }}</div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 text-center">
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $informasi->jumlah_balai }}</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide">{{ informasi_umum('nama_fasilitas_4') }}</div>
                    </div>
                </div>
            </div>

            <div class="transform transition-all duration-700 delay-200" :class="shown3 ? 'opacity-100 translate-x-0' : '-translate-x-12 opacity-0'">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                    @if($informasi->foto_fasilitas)
                    <img src="{{ asset($informasi->foto_fasilitas) }}" alt="Foto Fasilitas" class="w-full h-[400px] object-cover transform group-hover:scale-105 transition duration-700">
                    @else
                    <img src="https://images.unsplash.com/photo-1541888037622-4876210f4439?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Ilustrasi Fasilitas" class="w-full h-[400px] object-cover transform group-hover:scale-105 transition duration-700">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-20 bg-[#111827] text-center" x-data="{ shown4: false }" x-intersect.threshold.10="shown4 = true">
    <div class="container mx-auto px-6 max-w-4xl transform transition-all duration-700" :class="shown4 ? 'opacity-100 translate-y-0' : 'translate-y-12 opacity-0'">
        <div class="w-16 h-16 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-headset text-3xl"></i>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Butuh Informasi Lebih Lanjut?</h2>
        <p class="text-gray-400 mb-10 text-lg">Administrasi sekolah kami siap melayani pertanyaan dan kebutuhan Anda pada jam kerja.</p>

        @php
        // Format WA: Hapus spasi/strip, ganti awalan 0/8 jadi 62
        $cleanPhone = preg_replace('/[^0-9]/', '', $informasi->kontak_wa);
        if (str_starts_with($cleanPhone, '0')) {
        $cleanPhone = '62' . substr($cleanPhone, 1);
        } elseif (str_starts_with($cleanPhone, '8')) {
        $cleanPhone = '62' . $cleanPhone;
        }
        $waText = urlencode("Salam Bapak/Ibu, saya ingin bertanya mengenai...");
        @endphp

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ $cleanPhone ? 'https://wa.me/' . $cleanPhone . '?text=' . $waText : '#' }}" target="_blank"
                class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-green-500/30 hover:-translate-y-1">
                <i class="fab fa-whatsapp text-xl"></i> Chat WhatsApp
            </a>
            <a href="mailto:{{ $informasi->kontak_email }}"
                class="flex items-center justify-center gap-3 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <i class="fas fa-envelope text-xl text-gray-400"></i> Kirim Email
            </a>
        </div>
    </div>
</section>
@endsectionx`