@extends('layouts.admin')

@section('title', 'Edit Navbar')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Navbar</h1>
        <p class="text-sm text-gray-500 mt-1">Perubahan akan langsung tampil di halaman publik.</p>
    </div>

    @if(session('success'))
    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl mb-6">
        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.navbar.update') }}" method="POST" x-data="navbarForm()">
        @csrf
        @method('PUT')

        {{-- ══ MENU UTAMA ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-emerald-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-gray-800">Menu Utama</h2>
                    <p class="text-xs text-gray-400">Label link navigasi utama — URL mengikuti route yang sudah ada</p>
                </div>
            </div>
            <div class="px-6 py-5 space-y-3">

                @php
                $menuUtama = [
                ['key' => 'beranda', 'url' => '/', 'placeholder' => 'Beranda'],
                ['key' => 'berita', 'url' => '/berita', 'placeholder' => 'Berita'],
                ['key' => 'produk', 'url' => '/produk', 'placeholder' => 'Produk'],
                ['key' => 'layanan', 'url' => '/layanan', 'placeholder' => 'Layanan'],
                ['key' => 'statistik', 'url' => '/statistik', 'placeholder' => 'Statistik'],
                ];
                @endphp

                @foreach($menuUtama as $item)
                <div class="flex items-center gap-4 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                    <code class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded shrink-0 hidden md:block w-28 text-center">
                        {{ $item['url'] }}
                    </code>
                    <div class="flex-1 space-y-1">
                        <label class="text-xs font-semibold text-gray-600">Label</label>
                        <input type="text"
                            name="menu_utama[{{ $item['key'] }}]"
                            value="{{ old('menu_utama.' . $item['key'], $navbar->menu_utama[$item['key']] ?? $item['placeholder']) }}"
                            class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                            placeholder="{{ $item['placeholder'] }}">
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- ══ DROPDOWN PROFIL SEKOLAH ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-blue-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-gray-800">Dropdown Profil Sekolah</h2>
                    <p class="text-xs text-gray-400">Label tombol dropdown & item-item di dalamnya</p>
                </div>
            </div>
            <div class="px-6 py-5 space-y-4">

                {{-- Label tombol dropdown --}}
                <div class="space-y-1.5 pb-4 border-b border-gray-100">
                    <label class="block text-sm font-semibold text-gray-700">Label Tombol Dropdown</label>
                    <input type="text" name="dropdown_label"
                        value="{{ old('dropdown_label', $navbar->dropdown_label ?? 'Profil Sekolah') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all @error('dropdown_label') border-red-400 bg-red-50 @enderror"
                        placeholder="Profil Sekolah">
                    @error('dropdown_label')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Item dropdown — fixed, hanya edit label --}}
                @php
                $dropdownItems = [
                ['key' => 'informasi_umum', 'url' => '/profil/informasi-umum', 'placeholder' => 'Informasi Umum'],
                ['key' => 'visi_misi', 'url' => '/profil/visi-misi', 'placeholder' => 'Visi & Misi'],
                ['key' => 'sejarah', 'url' => '/profil/sejarah', 'placeholder' => 'Sejarah Sekolah'],
                ['key' => 'struktur_organisasi_sekolah', 'url' => '/profil/struktur-organisasi-sekolah', 'placeholder' => 'Struktur Organisasi Sekolah'],
                ['key' => 'geografis', 'url' => '/profil/geografis', 'placeholder' => 'Geografis Sekolah'],
                ];
                @endphp

                <div class="space-y-3">
                    @foreach($dropdownItems as $item)
                    <div class="flex items-center gap-4 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                        <div class="w-2 h-2 rounded-full bg-blue-300 shrink-0"></div>
                        <code class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded shrink-0 hidden md:block">
                            {{ $item['url'] }}
                        </code>
                        <div class="flex-1 space-y-1">
                            <label class="text-xs font-semibold text-gray-600">Label</label>
                            <input type="text"
                                name="dropdown_items[{{ $item['key'] }}]"
                                value="{{ old('dropdown_items.' . $item['key'], $navbar->dropdown_items[$item['key']] ?? $item['placeholder']) }}"
                                class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                placeholder="{{ $item['placeholder'] }}">
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- ══ SUBMIT ══ --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.navbar.index') }}"
                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm shadow-emerald-200 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

<script>
    function navbarForm() {
        return {};
    }
</script>

@endsection