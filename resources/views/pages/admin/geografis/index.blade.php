@extends('layouts.admin')

@section('title', 'Edit Geografis')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Geografis</h1>
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

    <form action="{{ route('admin.geografis.update') }}" method="POST" x-data="geografisForm()">
        @csrf
        @method('PUT')

        {{-- ══ HERO / BANNER ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-emerald-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Hero / Banner</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi / Subtitle</label>
                    <textarea name="hero_desc" rows="2"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all resize-none"
                        placeholder="Informasi lengkap mengenai letak wilayah, batas administrasi...">{{ old('hero_desc', $geografis->hero_desc ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ══ PETA & LETAK WILAYAH ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-blue-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Peta & Letak Wilayah</h2>
            </div>
            <div class="px-6 py-5 space-y-4">

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Embed URL Google Maps <span class="text-red-500">*</span></label>
                    <input type="text" name="maps_embed_url"
                        x-ref="mapsInput"
                        value="{{ old('maps_embed_url', $geografis->maps_embed_url ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all font-mono @error('maps_embed_url') border-red-400 bg-red-50 @enderror"
                        placeholder="<iframe src='https://www.google.com/maps/embed...">
                    <p class="text-xs text-gray-400">Buka Google Maps → Share → Sematkan Peta → salin Iframe dari atribut <code class="bg-gray-100 px-1 rounded">iframe</code>.</p>
                    @error('maps_embed_url')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Keterangan Peta</label>
                    <input type="text" name="maps_caption"
                        value="{{ old('maps_caption', $geografis->maps_caption ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                        placeholder="*Peta wilayah administrasi via Google Maps">
                </div>

                {{-- Preview peta --}}
                <!-- <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-semibold text-gray-700">Preview Peta</label>
                        <button type="button"
                            @click="mapsPreview = $refs.mapsInput.value"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Refresh Preview
                        </button>
                    </div>
                    <div class="relative rounded-xl overflow-hidden border border-gray-200 bg-gray-100" style="height:280px;">
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 text-gray-400 transition-opacity"
                            :class="mapsPreview ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                            <svg class="w-10 h-10 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            <p class="text-sm">Masukkan URL lalu klik <strong>Refresh Preview</strong></p>
                        </div>
                        <iframe
                            :src="mapsPreview || 'about:blank'"
                            width="100%" height="100%" style="border:0;"
                            allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"
                            :class="mapsPreview ? 'opacity-100' : 'opacity-0'">
                        </iframe>
                    </div>
                </div> -->

                {{-- Deskripsi letak --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi Letak Wilayah</label>
                    <textarea name="letak_desc" rows="2"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all resize-none"
                        placeholder="Terletak di dataran rendah dengan ketinggian rata-rata 25 mdpl...">{{ old('letak_desc', $geografis->letak_desc ?? '') }}</textarea>
                </div>

            </div>
        </div>

        {{-- ══ BATAS WILAYAH ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Batas Wilayah</h2>
                </div>
                <button type="button" @click="addBatas()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Batas
                </button>
            </div>
            <div class="px-6 py-5 space-y-3">
                <template x-for="(item, index) in batasList" :key="index">
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-4">

                        {{-- Indikator warna arah --}}
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shrink-0 border-2"
                            :class="{
                                 'bg-blue-100 text-blue-700 border-blue-300':   item.warna === 'blue',
                                 'bg-yellow-100 text-yellow-700 border-yellow-300': item.warna === 'yellow',
                                 'bg-red-100 text-red-700 border-red-300':     item.warna === 'red',
                                 'bg-green-100 text-green-700 border-green-300': item.warna === 'green',
                                 'bg-gray-100 text-gray-700 border-gray-300':  !['blue','yellow','red','green'].includes(item.warna),
                             }"
                            x-text="item.singkatan || '?'">
                        </div>

                        <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Singkatan</label>
                                <input type="text"
                                    :name="`batas[${index}][singkatan]`"
                                    x-model="item.singkatan"
                                    maxlength="2"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-center font-bold uppercase focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="U">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Arah</label>
                                <input type="text"
                                    :name="`batas[${index}][arah]`"
                                    x-model="item.arah"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Sebelah Utara">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Berbatasan Dengan</label>
                                <input type="text"
                                    :name="`batas[${index}][nama]`"
                                    x-model="item.nama"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Nama desa / jalan / sungai">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Warna Aksen</label>
                                <select :name="`batas[${index}][warna]`" x-model="item.warna"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all">
                                    <option value="blue">Biru (Utara)</option>
                                    <option value="yellow">Kuning (Timur)</option>
                                    <option value="red">Merah (Selatan)</option>
                                    <option value="green">Hijau (Barat)</option>
                                </select>
                            </div>
                        </div>

                        <button type="button" @click="removeBatas(index)"
                            x-show="batasList.length > 1"
                            class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50 shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>

                @error('batas')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ TOPOGRAFI & IKLIM ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-8">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-green-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800">Topografi & Iklim</h2>
                        <p class="text-xs text-gray-400">Kartu-kartu yang tampil di seksi hijau</p>
                    </div>
                </div>
                <button type="button" @click="addTopografi()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kartu
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">

                <div class="space-y-1.5 pb-4 border-b border-gray-100">
                    <label class="block text-sm font-semibold text-gray-700">Judul Seksi</label>
                    <input type="text" name="topografi_title"
                        value="{{ old('topografi_title', $geografis->topografi_title ?? 'Kondisi Topografi & Iklim') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                        placeholder="Kondisi Topografi & Iklim">
                </div>

                <template x-for="(item, index) in topografiList" :key="index">
                    <div class="relative bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider"
                                x-text="'Kartu #' + (index + 1)"></span>
                            <button type="button" @click="removeTopografi(index)"
                                x-show="topografiList.length > 1"
                                class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Judul Kartu <span class="text-red-500">*</span></label>
                                <input type="text"
                                    :name="`topografi[${index}][judul]`"
                                    x-model="item.judul"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Dataran Rendah" required>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600">Deskripsi <span class="text-red-500">*</span></label>
                                <input type="text"
                                    :name="`topografi[${index}][deskripsi]`"
                                    x-model="item.deskripsi"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                    placeholder="Ketinggian tanah rata-rata 25 mdpl..." required>
                            </div>
                            <div class="space-y-1 md:col-span-2">
                                <label class="text-xs font-semibold text-gray-600">
                                    Icon <span class="text-gray-400 font-normal">(Font Awesome)</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 w-4 text-center pointer-events-none">
                                        <i :class="item.icon || 'fas fa-circle text-gray-200'" class="text-sm text-gray-500"></i>
                                    </span>
                                    <input type="text"
                                        :name="`topografi[${index}][icon]`"
                                        x-model="item.icon"
                                        class="w-full pl-9 pr-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="fas fa-mountain">
                                </div>
                            </div>
                        </div>

                        {{-- Mini preview kartu --}}
                        <div class="mt-3 bg-green-600 text-white rounded-xl p-4 flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center shrink-0 text-lg">
                                <i :class="item.icon || 'fas fa-circle opacity-40'"></i>
                            </div>
                            <div>
                                <p class="font-bold text-sm" x-text="item.judul || 'Judul Kartu'"></p>
                                <p class="text-green-100 text-xs" x-text="item.deskripsi || 'Deskripsi kartu...'"></p>
                            </div>
                        </div>
                    </div>
                </template>

                @error('topografi')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ SUBMIT ══ --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.geografis.index') }}"
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
$defaultBatas = [
['singkatan' => 'U', 'arah' => 'Sebelah Utara', 'nama' => 'Desa Sumber Rejeki', 'warna' => 'blue'],
['singkatan' => 'T', 'arah' => 'Sebelah Timur', 'nama' => 'Sungai Bah Bolon', 'warna' => 'yellow'],
['singkatan' => 'S', 'arah' => 'Sebelah Selatan', 'nama' => 'Kecamatan Kota Lama', 'warna' => 'red'],
['singkatan' => 'B', 'arah' => 'Sebelah Barat', 'nama' => 'Perkebunan PTPN IV', 'warna' => 'green'],
];

$defaultTopografi = [
['judul' => 'Dataran Rendah', 'deskripsi' => 'Ketinggian tanah rata-rata 25 meter di atas permukaan laut (mdpl).', 'icon' => 'fas fa-mountain'],
['judul' => 'Curah Hujan', 'deskripsi' => 'Rata-rata 2.000 - 3.000 mm per tahun, sangat cocok untuk pertanian.', 'icon' => 'fas fa-cloud-rain'],
['judul' => 'Suhu Udara', 'deskripsi' => 'Berkisar antara 26°C hingga 32°C dengan kelembaban udara sedang.', 'icon' => 'fas fa-temperature-high'],
];

$batasData = old('batas', $geografis->batas ?? $defaultBatas);
$topografiData = old('topografi', $geografis->topografi ?? $defaultTopografi);
@endphp

<script>
    function geografisForm() {
        return {
            batasList: @json($batasData),
            topografiList: @json($topografiData),

            // ── Batas Wilayah
            addBatas() {
                this.batasList.push({
                    singkatan: '',
                    arah: '',
                    nama: '',
                    warna: 'blue'
                });
            },
            removeBatas(index) {
                this.batasList.splice(index, 1);
            },

            // ── Topografi & Iklim
            addTopografi() {
                this.topografiList.push({
                    judul: '',
                    deskripsi: '',
                    icon: ''
                });
            },
            removeTopografi(index) {
                this.topografiList.splice(index, 1);
            },
        };
    }
</script>

@endsection