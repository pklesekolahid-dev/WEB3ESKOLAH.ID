@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Dashboard Overview</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan aktivitas dan data terkini.</p>
    </div>
    <div class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm font-bold text-gray-600 shadow-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </div>
</div>

<div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-green-700 rounded-2xl p-6 md:p-8 shadow-lg shadow-emerald-900/20 mb-8 flex flex-col md:flex-row items-center justify-between relative overflow-hidden group">
    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition duration-700"></div>
    <div class="absolute right-20 -bottom-10 w-32 h-32 bg-green-400/20 rounded-full blur-xl"></div>

    <div class="relative z-10 w-full">
        <h2 class="text-2xl font-bold text-white mb-2 flex items-center gap-2">
            Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}!
        </h2>
        <p class="text-emerald-100 text-sm max-w-2xl leading-relaxed">
            Ini adalah pusat kendali Website Sekolah. Anda dapat mengelola konten website, menyetujui data Produk murid, dan memantau layanan administrasi dalam satu panel terintegrasi.
        </p>
    </div>

    <div class="hidden md:flex shrink-0 relative z-10 ml-6">
        <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-white border border-white/20 shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="p-3 bg-blue-50 rounded-xl text-blue-600 border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="text-[10px] font-bold uppercase tracking-wider bg-gray-50 hover:bg-blue-50 text-gray-500 hover:text-blue-600 px-3 py-1.5 rounded-lg border border-gray-200 transition">
                Kelola
            </a>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-medium text-gray-500">Total Berita Aktif</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1 tracking-tight">{{ $totalBerita }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 border border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <a href="{{ route('admin.produk.index') }}" class="text-[10px] font-bold uppercase tracking-wider bg-gray-50 hover:bg-emerald-50 text-gray-500 hover:text-emerald-600 px-3 py-1.5 rounded-lg border border-gray-200 transition">
                Kelola
            </a>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-medium text-gray-500">Produk Terdaftar</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1 tracking-tight">{{ $totalProduk }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-orange-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="p-3 bg-orange-50 rounded-xl text-orange-600 border border-orange-100 group-hover:bg-orange-600 group-hover:text-white transition-colors shadow-sm">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-medium text-gray-500">Layanan Tersedia</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1 tracking-tight">{{ $totalLayanan }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-purple-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="p-3 bg-purple-50 rounded-xl text-purple-600 border border-purple-100 group-hover:bg-purple-600 group-hover:text-white transition-colors shadow-sm">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-medium text-gray-500">Pengunjung Web</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1 tracking-tight">1.2K <span class="text-xs font-normal text-green-500">+12%</span></h3>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-1 space-y-4">
        <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Jalan Pintas
        </h3>

        <a href="{{ route('admin.berita.create') }}" class="group bg-white p-4 rounded-xl border border-gray-100 hover:border-emerald-300 transition-all duration-300 flex items-center gap-4 shadow-sm hover:shadow-md">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Tulis Berita Baru</h4>
                <p class="text-xs text-gray-500 mt-0.5">Sebarkan informasi sekolah</p>
            </div>
        </a>

        <a href="{{ route('admin.banner.create') }}" class="group bg-white p-4 rounded-xl border border-gray-100 hover:border-emerald-300 transition-all duration-300 flex items-center gap-4 shadow-sm hover:shadow-md">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Ganti Hero Banner</h4>
                <p class="text-xs text-gray-500 mt-0.5">Ubah foto slider beranda</p>
            </div>
        </a>

        <a href="{{ route('admin.profil-sekolah.kontak') }}" class="group bg-white p-4 rounded-xl border border-gray-100 hover:border-emerald-300 transition-all duration-300 flex items-center gap-4 shadow-sm hover:shadow-md">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Update Kontak</h4>
                <p class="text-xs text-gray-500 mt-0.5">Edit no. WA & Jam Buka</p>
            </div>
        </a>
    </div>

    <div class="lg:col-span-2">
        <h3 class="text-lg font-extrabold text-gray-900 flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Menunggu Verifikasi (Produk)
        </h3>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Nama Usaha</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Pemilik</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Tgl Daftar</th>
                            <th class="px-6 py-4 text-right text-xs font-extrabold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse($produkMenunggu as $produk)
                        <tr class="hover:bg-emerald-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-9 w-9 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm mr-3 shadow-inner">
                                        {{ substr($produk->nama_usaha, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $produk->nama_usaha }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                {{ $produk->nama_pemilik }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $produk->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="inline-flex items-center justify-center text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white px-3 py-1.5 rounded-lg transition font-bold border border-emerald-100 shadow-sm">
                                    Cek Data
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <p class="font-bold text-gray-900 text-lg">Semua Aman!</p>
                                    <p class="text-sm text-gray-500 mt-1">Tidak ada Produk yang menunggu verifikasi saat ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($produkMenunggu->count() > 0)
            <div class="bg-gray-50/80 px-6 py-3 border-t border-gray-100 text-center">
                <a href="{{ route('admin.produk.index') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">
                    Lihat Semua Data Produk &rarr;
                </a>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection