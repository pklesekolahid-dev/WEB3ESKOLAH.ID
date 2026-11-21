@extends('layouts.admin')

@section('title', 'Edit Footer')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Footer</h1>
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

    <form action="{{ route('admin.footer.update') }}" method="POST" x-data="footerForm()">
        @csrf
        @method('PUT')

        {{-- ══ IDENTITAS ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-emerald-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Identitas</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Nama Sekolah / Instansi <span class="text-red-500">*</span></label>
                        <input type="text" name="nama"
                            value="{{ old('nama', $footer->nama ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all @error('nama') border-red-400 bg-red-50 @enderror"
                            placeholder="Sekolah" required>
                        @error('nama')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Teks Copyright</label>
                        <input type="text" name="copyright"
                            value="{{ old('copyright', $footer->copyright ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="© 2026 Sekolah. All rights reserved.">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="2"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all resize-none"
                        placeholder="Website resmi Sekolah. Media komunikasi dan transparansi...">{{ old('deskripsi', $footer->deskripsi ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ══ JAM PELAYANAN ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Jam Pelayanan</h2>
                </div>
                <button type="button" @click="addJam()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Baris
                </button>
            </div>
            <div class="px-6 py-5 space-y-3">

                <template x-for="(item, index) in jamList" :key="index">
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Hari</label>
                                <input type="text"
                                    :name="`jam[${index}][hari]`"
                                    x-model="item.hari"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Senin - Kamis">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Jam</label>
                                <input type="text"
                                    :name="`jam[${index}][waktu]`"
                                    x-model="item.waktu"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="08:00 - 15:00">
                                <p class="text-xs text-gray-400">Isi <code class="bg-gray-100 px-1 rounded">Tutup</code> jika libur</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Tampilan</label>
                                <select :name="`jam[${index}][tipe]`" x-model="item.tipe"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all">
                                    <option value="normal">Normal (putih)</option>
                                    <option value="tutup">Tutup (merah)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Mini preview --}}
                        <div class="shrink-0 hidden md:flex items-center justify-between gap-2 bg-gray-800 rounded-lg px-3 py-2 min-w-[160px]">
                            <span class="text-gray-400 text-xs" x-text="item.hari || 'Hari'"></span>
                            <span class="text-xs font-bold px-2 py-0.5 rounded"
                                :class="item.tipe === 'tutup' ? 'text-red-400 bg-red-400/10 uppercase tracking-wider' : 'text-white'"
                                x-text="item.waktu || '-'"></span>
                        </div>

                        <button type="button" @click="removeJam(index)"
                            x-show="jamList.length > 1"
                            class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50 shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>

                <div class="space-y-1.5 pt-2 border-t border-gray-100">
                    <label class="block text-sm font-semibold text-gray-700">Catatan Tambahan</label>
                    <input type="text" name="jam_catatan"
                        value="{{ old('jam_catatan', $footer->jam_catatan ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                        placeholder="*Pelayanan online via WhatsApp tetap dibuka sesuai ketersediaan admin.">
                    <p class="text-xs text-gray-400">Tampil sebagai teks kecil miring di bawah tabel jam.</p>
                </div>

                @error('jam')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ MENU NAVIGASI ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800">Menu Jelajahi</h2>
                        <p class="text-xs text-gray-400">Label dan URL bisa diedit bebas</p>
                    </div>
                </div>
                <button type="button" @click="addMenu()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Menu
                </button>
            </div>

            <div class="px-6 py-5 space-y-3">
                <template x-for="(item, index) in menuList" :key="index">
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Label</label>
                                <input type="text"
                                    :name="`menu[${index}][label]`"
                                    x-model="item.label"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Contoh: Sejarah Sekolah">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">URL / Path</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                        <template x-if="item.url && (item.url.startsWith('http://') || item.url.startsWith('https://'))">
                                            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                                            </svg>
                                        </template>
                                        <template x-if="!item.url || (!item.url.startsWith('http://') && !item.url.startsWith('https://'))">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m0 0L14.828 14.828m-1-4.656a4 4 0 015.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </template>
                                    </span>
                                    <input type="text"
                                        :name="`menu[${index}][url]`"
                                        x-model="item.url"
                                        class="w-full pl-9 pr-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm font-mono focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="/profil/sejarah atau https://example.com">
                                </div>
                            </div>
                        </div>

                        <button type="button" @click="removeMenu(index)"
                            x-show="menuList.length > 1"
                            class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50 shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>

                @error('menu')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ KONTAK ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-green-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Kontak</h2>
                </div>
                <button type="button" @click="addKontak()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kontak
                </button>
            </div>
            <div class="px-6 py-5 space-y-3">
                <template x-for="(item, index) in kontakList" :key="index">
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Icon <span class="text-gray-400 font-normal">(Font Awesome)</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 w-4 text-center pointer-events-none">
                                        <i :class="item.icon || 'fas fa-circle text-gray-200'" class="text-sm text-green-500"></i>
                                    </span>
                                    <input type="text"
                                        :name="`kontak[${index}][icon]`"
                                        x-model="item.icon"
                                        class="w-full pl-9 pr-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="fas fa-phone">
                                </div>
                            </div>
                            <div class="space-y-1 md:col-span-2">
                                <label class="text-xs font-semibold text-gray-600">Nilai</label>
                                <input type="text"
                                    :name="`kontak[${index}][nilai]`"
                                    x-model="item.nilai"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="+62 812-3456-7890">
                            </div>
                        </div>
                        <button type="button" @click="removeKontak(index)"
                            x-show="kontakList.length > 1"
                            class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50 shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>

                @error('kontak')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ SUBMIT ══ --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.footer.index') }}"
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

@php
$defaultJam = [
['hari' => 'Senin - Kamis', 'waktu' => '08:00 - 15:00', 'tipe' => 'normal'],
['hari' => 'Jumat', 'waktu' => '08:00 - 12:00', 'tipe' => 'normal'],
['hari' => 'Sabtu - Minggu', 'waktu' => 'Tutup', 'tipe' => 'tutup'],
];

$defaultKontak = [
['icon' => 'fas fa-phone', 'nilai' => '+62 812-3456-7890'],
['icon' => 'fas fa-envelope','nilai' => 'admin@sukorejo.id'],
];

$defaultMenu = [
['label' => 'Sejarah Sekolah', 'url' => '/profil/sejarah'],
['label' => 'Visi Misi', 'url' => '/profil/visi-misi'],
['label' => 'Struktur Aparat', 'url' => '/profil/struktur-aparat'],
['label' => 'Peta Geografis', 'url' => '/profil/geografis'],
];

$jamData = old('jam', !empty($footer->jam) ? $footer->jam : $defaultJam);
$kontakData = old('kontak', !empty($footer->kontak) ? $footer->kontak : $defaultKontak);
$menuData = old('menu', !empty($footer->menu) ? $footer->menu : $defaultMenu);
@endphp

<script>
    function footerForm() {
        return {
            jamList: Array.from(@json($jamData) || []),
            kontakList: Array.from(@json($kontakData) || []),
            menuList: Array.from(@json($menuData) || []),

            addJam() {
                this.jamList.push({
                    hari: '',
                    waktu: '',
                    tipe: 'normal'
                });
            },
            removeJam(i) {
                this.jamList.splice(i, 1);
            },

            addKontak() {
                this.kontakList.push({
                    icon: '',
                    nilai: ''
                });
            },
            removeKontak(i) {
                this.kontakList.splice(i, 1);
            },

            addMenu() {
                this.menuList.push({
                    label: '',
                    url: ''
                });
            },
            removeMenu(i) {
                this.menuList.splice(i, 1);
            },
        };
    }
</script>

@endsection