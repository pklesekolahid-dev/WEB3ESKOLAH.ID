@extends('layouts.admin')

@section('title', 'Edit Visi & Misi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Visi & Misi</h1>
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

    <form action="{{ route('admin.visi-misi.update') }}" method="POST" x-data="visiMisiForm()">
        @csrf
        @method('PUT')

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-gray-100 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Header Halaman</h2>
            </div>
            <div class="px-6 py-5">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Subjudul Header</label>
                    <input type="text" name="header_subtitle"
                        value="{{ old('header_subtitle', $visiMisi->header_subtitle ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all @error('header_subtitle') border-red-400 bg-red-50 @enderror"
                        placeholder="Arah kebijakan dan tujuan pembangunan desa...">
                    @error('header_subtitle')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- VISI --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-emerald-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Visi Sekolah</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">
                        Teks Visi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="visi" rows="3" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all resize-none @error('visi') border-red-400 bg-red-50 @enderror"
                        placeholder="Terwujudnya Desa Digital yang Mandiri...">{{ old('visi', $visiMisi->visi ?? '') }}</textarea>
                    <p class="text-xs text-gray-400">Teks ini tampil sebagai kutipan besar di halaman visi & misi.</p>
                    @error('visi')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi Pendukung</label>
                    <input type="text" name="visi_subtitle"
                        value="{{ old('visi_subtitle', $visiMisi->visi_subtitle ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all @error('visi_subtitle') border-red-400 bg-red-50 @enderror"
                        placeholder="Kami berkomitmen untuk membangun infrastruktur...">
                    @error('visi_subtitle')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- MISI --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Misi Sekolah</h2>
                </div>
                <button type="button" @click="addMisi()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Misi
                </button>
            </div>
            <div class="px-6 py-5 space-y-4">
                <template x-for="(item, index) in misiList" :key="index">
                    <div class="relative bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider"
                                x-text="'Misi #' + (index + 1)"></span>
                            <button type="button" @click="removeMisi(index)"
                                x-show="misiList.length > 1"
                                class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                            {{-- ICON --}}
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">
                                    Icon <span class="text-gray-400 font-normal">(Font Awesome)</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none w-4 text-center">
                                        <template x-if="item.icon && item.icon.startsWith('fas fa-') && item.icon.length > 7">
                                            <i :class="item.icon"></i>
                                        </template>
                                        <template x-if="!(item.icon && item.icon.startsWith('fas fa-') && item.icon.length > 7)">
                                            <i class="fas fa-circle text-gray-200"></i>
                                        </template>
                                    </span>
                                    <input type="text"
                                        :name="`misi[${index}][icon]`"
                                        x-model="item.icon"
                                        class="w-full pl-9 pr-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="fas fa-home">
                                </div>
                                <p class="text-xs text-gray-400">Format lengkap, cth: <code class="bg-gray-100 px-1 rounded">fas fa-home</code></p>
                            </div>

                            {{-- JUDUL --}}
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Judul Misi</label>
                                <input type="text"
                                    :name="`misi[${index}][judul]`"
                                    x-model="item.judul"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Digitalisasi Pemerintahan" required>
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Deskripsi</label>
                                <input type="text"
                                    :name="`misi[${index}][deskripsi]`"
                                    x-model="item.deskripsi"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Deskripsi singkat misi ini..." required>
                            </div>

                            {{-- WARNA --}}
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Warna Aksen</label>
                                <select :name="`misi[${index}][warna]`"
                                    x-model="item.warna"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all">
                                    <option value="green">Hijau</option>
                                    <option value="blue">Biru</option>
                                    <option value="yellow">Kuning</option>
                                    <option value="purple">Ungu</option>
                                    <option value="red">Merah</option>
                                    <option value="orange">Oranye</option>
                                </select>
                            </div>

                            {{-- PREVIEW --}}
                            <div class="md:col-span-2 flex items-center gap-2 mt-1">
                                <span class="text-xs text-gray-400">Preview:</span>
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl border-2 text-white text-sm shadow-sm transition-colors"
                                    :class="{
                                        'bg-green-400 border-green-500': item.warna === 'green',
                                        'bg-blue-400 border-blue-500': item.warna === 'blue',
                                        'bg-yellow-400 border-yellow-500': item.warna === 'yellow',
                                        'bg-purple-400 border-purple-500': item.warna === 'purple',
                                        'bg-red-400 border-red-500': item.warna === 'red',
                                        'bg-orange-400 border-orange-500': item.warna === 'orange',
                                    }">
                                    <template x-if="item.icon && item.icon.startsWith('fas fa-') && item.icon.length > 7">
                                        <i :class="item.icon"></i>
                                    </template>
                                    <template x-if="!(item.icon && item.icon.startsWith('fas fa-') && item.icon.length > 7)">
                                        <i class="fas fa-circle opacity-50"></i>
                                    </template>
                                </span>
                                <div class="flex flex-col">
                                    <span class="text-xs font-semibold text-gray-700" x-text="item.judul || 'Judul Misi'"></span>
                                    <span class="text-xs text-gray-400 capitalize" x-text="item.warna + ' · ' + (item.icon || '-')"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </template>
                @error('misi')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- NILAI --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-8">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Nilai & Motto Sekolah</h2>
                </div>
                <button type="button" @click="addNilai()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Nilai
                </button>
            </div>
            <div class="px-6 py-5 space-y-3">
                <template x-for="(item, index) in nilaiList" :key="index">
                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="bg-yellow-100 text-yellow-700 text-xs font-bold w-7 h-7 rounded-full flex items-center justify-center shrink-0 mt-0.5"
                            x-text="index + 1"></div>
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Nama Nilai</label>
                                <input type="text"
                                    :name="`nilai[${index}][judul]`"
                                    x-model="item.judul"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Integritas" required>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Deskripsi</label>
                                <input type="text"
                                    :name="`nilai[${index}][deskripsi]`"
                                    x-model="item.deskripsi"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Jujur dan bertanggung jawab..." required>
                            </div>
                        </div>
                        <button type="button" @click="removeNilai(index)"
                            x-show="nilaiList.length > 1"
                            class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50 shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>
                @error('nilai')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.visi-misi.index') }}"
                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                Reset
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
$defaultMisi = [
['judul' => 'Digitalisasi Pemerintahan', 'deskripsi' => 'Meningkatkan kualitas pelayanan publik melalui sistem administrasi berbasis digital.', 'warna' => 'green', 'icon' => 'fas fa-laptop-code'],
['judul' => 'Pemberdayaan Ekonomi', 'deskripsi' => 'Mendorong pertumbuhan UMKM dan sektor pertanian melalui akses pasar digital.', 'warna' => 'blue', 'icon' => 'fas fa-store'],
['judul' => 'Sumber Daya Manusia', 'deskripsi' => 'Meningkatkan kualitas pendidikan dan kesehatan masyarakat.', 'warna' => 'yellow', 'icon' => 'fas fa-users'],
['judul' => 'Infrastruktur Merata', 'deskripsi' => 'Membangun dan memelihara infrastruktur secara merata dan berkelanjutan.', 'warna' => 'purple', 'icon' => 'fas fa-road'],
];

$defaultNilai = [
['judul' => 'Integritas', 'deskripsi' => 'Jujur dan bertanggung jawab dalam pelayanan.'],
['judul' => 'Transparan', 'deskripsi' => 'Terbuka dalam pengelolaan anggaran desa.'],
['judul' => 'Inovatif', 'deskripsi' => 'Selalu mencari solusi baru untuk kemajuan.'],
];

$misiData = old('misi', $visiMisi->misi ?? $defaultMisi);
$nilaiData = old('nilai', $visiMisi->nilai ?? $defaultNilai);
@endphp

<script>
    function visiMisiForm() {
        return {
            misiList: @json($misiData),
            nilaiList: @json($nilaiData),

            addMisi() {
                this.misiList.push({
                    judul: '',
                    deskripsi: '',
                    warna: 'green',
                    icon: ''
                });
            },
            removeMisi(index) {
                this.misiList.splice(index, 1);
            },
            addNilai() {
                this.nilaiList.push({
                    judul: '',
                    deskripsi: ''
                });
            },
            removeNilai(index) {
                this.nilaiList.splice(index, 1);
            },
        }
    }
</script>

@endsection