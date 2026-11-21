@extends('layouts.main')

@section('title', $layanan->judul . ' - Layanan Sekolah')

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
            {{ $layanan->judul }}
        </h1>
        <p class="text-green-100 text-sm md:text-base font-medium tracking-wide transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <a href="{{ url('/') }}" class="hover:text-white transition underline decoration-transparent hover:decoration-white underline-offset-4">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('layanan.index') }}" class="hover:text-white transition underline decoration-transparent hover:decoration-white underline-offset-4">Layanan</a>
            <span class="mx-2">/</span>
            <span class="text-white">Detail</span>
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="py-12 pb-24 bg-white relative z-30" x-data="{ shown: false }" x-intersect.threshold.10="shown = true">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 transform transition-all duration-700"
                :class="shown ? 'opacity-100 translate-y-0' : 'translate-y-8 opacity-0'">

                <div class="mb-8 flex items-center gap-3">
                    <div class="w-1.5 h-8 bg-green-600 rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Persyaratan Berkas</h2>
                </div>

                <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                    {{ $layanan->deskripsi_singkat }}
                </p>

                <div class="bg-gray-50/80 rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm">
                    @php
                    // Sihir PHP: Memecah teks per baris (Enter) menjadi array,
                    // dan menghapus baris yang kosong/spasi saja.
                    $syaratList = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $layanan->persyaratan))));
                    @endphp

                    <ul class="space-y-5">
                        @forelse($syaratList as $index => $syarat)
                        <li class="flex items-start gap-4 group">
                            <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center text-green-600 font-bold text-sm shrink-0 border border-green-100 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 mt-0.5">
                                {{ $index + 1 }}
                            </div>
                            <p class="text-gray-700 pt-1 leading-relaxed text-[15px]">{{ $syarat }}</p>
                        </li>
                        @empty
                        <li class="text-gray-500 italic">Belum ada data persyaratan.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-1 transform transition-all duration-700 delay-200"
                :class="shown ? 'opacity-100 translate-x-0' : 'translate-x-8 opacity-0'">

                <div class="bg-[#111827] rounded-[2rem] p-6 md:p-8 text-white shadow-xl shadow-gray-900/10 sticky top-28 border border-gray-800">
                    <h3 class="text-xl font-bold mb-6 border-b border-gray-800 pb-5 flex items-center gap-3">
                        <i class="fas fa-info-circle text-green-400"></i> Informasi
                    </h3>

                    <div class="space-y-6 mb-10">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-medium">Biaya:</span>
                            @if(strtolower($layanan->biaya) == 'gratis' || $layanan->biaya == 'Gratis (Rp 0,-)')
                            <span class="font-bold text-green-400 bg-green-400/10 px-3 py-1 rounded-lg">Gratis (Rp 0,-)</span>
                            @else
                            <span class="font-bold text-white">{{ $layanan->biaya }}</span>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-medium">Durasi:</span>
                            <span class="font-bold text-white">{{ $layanan->durasi ?? '-' }}</span>
                        </div>
                    </div>

                    @php
                    // Rapikan Nomor WA
                    $cleanPhone = preg_replace('/[^0-9]/', '', $layanan->kontak_wa);
                    if (str_starts_with($cleanPhone, '0')) {
                    $cleanPhone = '62' . substr($cleanPhone, 1);
                    } elseif (str_starts_with($cleanPhone, '8')) {
                    $cleanPhone = '62' . $cleanPhone;
                    }

                    // Pesan otomatis
                    $waText = urlencode("Salam bapak/ibu, saya ingin bertanya mengenai persyaratan layanan *" . $layanan->judul . "*.");
                    @endphp

                    <a href="{{ $cleanPhone ? 'https://wa.me/' . $cleanPhone . '?text=' . $waText : '#' }}"
                        target="{{ $cleanPhone ? '_blank' : '_self' }}"
                        class="w-full flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-green-500/40 hover:-translate-y-1">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        Tanya Petugas
                    </a>

                    @if(!$cleanPhone)
                    <p class="text-[10px] text-center text-gray-500 mt-3">*Nomor petugas belum tersedia.</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>
@endsection