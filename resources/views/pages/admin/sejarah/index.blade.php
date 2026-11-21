@extends('layouts.admin')

@section('title', 'Edit Sejarah Sekolah')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Sejarah Sekolah</h1>
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

    <form action="{{ route('admin.sejarah.update') }}" method="POST" enctype="multipart/form-data"
        x-data="sejarahSekolahForm()">
        @csrf
        @method('PUT')

        {{-- ══ HERO / BANNER ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-emerald-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586A2 2 0 0110 11h4a2 2 0 011.414.586L20 16M14 8a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Hero / Banner</h2>
            </div>
            <div class="px-6 py-5 space-y-4">

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi / Subtitle</label>
                    <textarea name="hero_desc" rows="2"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all resize-none @error('hero_desc') border-red-400 bg-red-50 @enderror"
                        placeholder="Menelusuri jejak langkah, asal usul, dan perjalanan panjang berdirinya sekolah...">{{ old('hero_desc', $sejarah->hero_desc ?? '') }}</textarea>
                    @error('hero_desc')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Foto Utama</label>
                        <div x-data="{ preview: '{{ $sejarah->hero_img_url ?? '' }}' }" class="space-y-2">
                            <div x-show="preview" class="relative rounded-xl overflow-hidden border border-gray-200 h-36">
                                <img :src="preview" class="w-full h-full object-cover">
                                <button type="button" @click="preview = ''; $refs.heroImg.value = ''"
                                    class="absolute top-2 right-2 bg-white border border-gray-200 text-gray-500 hover:text-red-500 rounded-lg p-1 shadow-sm transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <input type="file" name="hero_img" accept="image/*" x-ref="heroImg"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-600 hover:file:bg-emerald-100 transition cursor-pointer @error('hero_img') text-red-400 @enderror">
                            <p class="text-xs text-gray-400">JPG, PNG, WebP. Maks 2MB. Biarkan kosong jika tidak ingin mengganti.</p>
                            @error('hero_img')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Keterangan Foto (Caption)</label>
                        <input type="text" name="hero_caption"
                            value="{{ old('hero_caption', $sejarah->hero_caption ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="&quot;Suasana sekolah pada tahun 1985&quot;">
                        <p class="text-xs text-gray-400 mt-1">Tampil sebagai teks kecil di bawah foto.</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- ══ ASAL USUL ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100">
                <div class="bg-amber-50 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h2 class="font-semibold text-gray-800">Latar Belakang & Pendirian</h2>
            </div>
            <div class="px-6 py-5 space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Label Kecil</label>
                        <input type="text" name="asal_tag"
                            value="{{ old('asal_tag', $sejarah->asal_tag ?? 'Sejarah & Pendirian') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="Sejarah &amp; Pendirian">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">
                            Judul Besar <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="asal_title" required
                            value="{{ old('asal_title', $sejarah->asal_title ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all @error('asal_title') border-red-400 bg-red-50 @enderror"
                            placeholder="Bermula dari Semangat Mencerdaskan Bangsa">
                        @error('asal_title')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-semibold text-gray-700">Paragraf Isi</label>
                        <button type="button" @click="addParagraf()"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Paragraf
                        </button>
                    </div>
                    <div class="space-y-3">
                        <template x-for="(p, index) in paragrafList" :key="index">
                            <div class="relative bg-gray-50 border border-gray-200 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider"
                                        x-text="'Paragraf #' + (index + 1)"></span>
                                    <button type="button" @click="removeParagraf(index)"
                                        x-show="paragrafList.length > 1"
                                        class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <textarea
                                    :name="`paragraf[${index}]`"
                                    x-model="paragrafList[index]"
                                    rows="3"
                                    class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all resize-none"
                                    placeholder="Tulis isi paragraf di sini..."></textarea>
                                <p class="text-xs text-gray-400 mt-1.5">HTML diperbolehkan, contoh: <code class="bg-gray-100 px-1 rounded">&lt;strong&gt;teks tebal&lt;/strong&gt;</code></p>
                            </div>
                        </template>
                    </div>
                    @error('paragraf')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ══ TIMELINE ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Jejak Langkah (Timeline)</h2>
                </div>
                <button type="button" @click="addTimeline()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Milestone
                </button>
            </div>
            <div class="px-6 py-5 space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-gray-100">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Judul Seksi</label>
                        <input type="text" name="timeline_title"
                            value="{{ old('timeline_title', $sejarah->timeline_title ?? 'Jejak Langkah Sekolah') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="Jejak Langkah Sekolah">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Subtitle Seksi</label>
                        <input type="text" name="timeline_sub" require
                            value="{{ old('timeline_sub', $sejarah->timeline_sub ?? 'Perjalanan panjang dari masa ke masa.') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="Perjalanan panjang dari masa ke masa.">
                    </div>
                </div>

                <div class="space-y-3">
                    <template x-for="(item, index) in timelineList" :key="index">
                        <div class="relative bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="bg-emerald-600 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center shrink-0"
                                        x-text="index + 1"></div>
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider"
                                        x-text="item.tahun ? item.tahun + ' — ' + (item.judul || 'Milestone') : 'Milestone #' + (index + 1)"></span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" @click="moveTimeline(index, -1)" :disabled="index === 0"
                                        class="text-gray-400 hover:text-gray-600 disabled:opacity-30 disabled:cursor-not-allowed p-1 rounded hover:bg-gray-200 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="moveTimeline(index, 1)" :disabled="index === timelineList.length - 1"
                                        class="text-gray-400 hover:text-gray-600 disabled:opacity-30 disabled:cursor-not-allowed p-1 rounded hover:bg-gray-200 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="removeTimeline(index)"
                                        x-show="timelineList.length > 1"
                                        class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-600">Tahun <span class="text-red-500">*</span></label>
                                    <input type="text"
                                        :name="`timeline[${index}][tahun]`"
                                        x-model="item.tahun"
                                        class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="1975" required>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-semibold text-gray-600">Judul Milestone <span class="text-red-500">*</span></label>
                                    <input type="text"
                                        :name="`timeline[${index}][judul]`"
                                        x-model="item.judul"
                                        class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                        placeholder="Pendirian Sekolah" required>
                                </div>
                                <div class="space-y-1 md:col-span-3">
                                    <label class="text-xs font-semibold text-gray-600">Deskripsi <span class="text-red-500">*</span></label>
                                    <textarea
                                        :name="`timeline[${index}][deskripsi]`"
                                        x-model="item.deskripsi"
                                        rows="2"
                                        class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all resize-none"
                                        placeholder="Deskripsi singkat pencapaian sekolah..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                @error('timeline')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ KEPALA SEKOLAH ══ --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-8">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-50 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="font-semibold text-gray-800">Kepala Sekolah</h2>
                </div>
                <button type="button" @click="addKepala()"
                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 px-3 py-1.5 rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kepala Sekolah
                </button>
            </div>
            <div class="px-6 py-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-5 mb-5 border-b border-gray-100">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Judul Seksi</label>
                        <input type="text" name="kepala_title"
                            value="{{ old('kepala_title', $sejarah->kepala_title ?? 'Pimpinan Sekolah dari Masa ke Masa') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="Pimpinan Sekolah dari Masa ke Masa">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Subtitle Seksi</label>
                        <input type="text" name="kepala_sub"
                            value="{{ old('kepala_sub', $sejarah->kepala_sub ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all"
                            placeholder="Terima kasih atas dedikasi memajukan pendidikan.">
                    </div>
                </div>

                <div class="space-y-3">
                    <template x-for="(item, index) in kepalaList" :key="index">
                        <div class="relative bg-gray-50 border rounded-xl p-4 transition"
                            :class="item.aktif ? 'border-emerald-300 bg-emerald-50/30' : 'border-gray-200'">

                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider"
                                        x-text="'Kepala Sekolah #' + (index + 1)"></span>
                                    <span x-show="item.aktif"
                                        class="inline-flex items-center text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">
                                        ✦ Menjabat
                                    </span>
                                </div>
                                <button type="button" @click="removeKepala(index)"
                                    x-show="kepalaList.length > 1"
                                    class="text-red-400 hover:text-red-600 transition p-1 rounded-lg hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="shrink-0">
                                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 mb-2"
                                        :class="item.aktif ? 'border-emerald-400' : 'border-gray-200'">
                                        <img :src="item.foto_preview
                        || item.foto_url
                        || ('https://ui-avatars.com/api/?name=' + encodeURIComponent(item.nama || 'KS') + '&background=16a34a&color=fff')"
                                            class="w-full h-full object-cover">
                                    </div>

                                    {{-- ✅ Kirim path foto LAMA ke server agar tidak null saat tidak diubah --}}
                                    <input type="hidden"
                                        :name="`kepala[${index}][foto_lama]`"
                                        :value="item.foto">

                                    {{-- Input file baru --}}
                                    <input type="file"
                                        :name="`kepala[${index}][foto]`"
                                        accept="image/*"
                                        class="hidden"
                                        :id="`foto-kepala-${index}`"
                                        @change="item.foto_preview = URL.createObjectURL($event.target.files[0])">

                                    <label :for="`foto-kepala-${index}`"
                                        class="block text-center text-[10px] font-semibold text-emerald-600 cursor-pointer hover:underline mt-1">
                                        Ganti Foto
                                    </label>
                                </div>

                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-xs font-semibold text-gray-600">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text"
                                            :name="`kepala[${index}][nama]`"
                                            x-model="item.nama"
                                            class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                            placeholder="Bpk. Drs. Suharto, M.Pd." required>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-xs font-semibold text-gray-600">Periode Jabatan <span class="text-red-500">*</span></label>
                                        <input type="text"
                                            :name="`kepala[${index}][periode]`"
                                            x-model="item.periode"
                                            class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all"
                                            placeholder="1980 - 1995" required>
                                    </div>
                                    <div class="md:col-span-2 flex items-center gap-2.5 mt-1">
                                        <input type="hidden" :name="`kepala[${index}][aktif]`" value="0">
                                        <input type="checkbox" :id="`aktif-kepala-${index}`"
                                            :name="`kepala[${index}][aktif]`"
                                            value="1"
                                            x-model="item.aktif"
                                            @change="setAktif(index)"
                                            class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                                        <label :for="`aktif-kepala-${index}`"
                                            class="text-sm font-medium text-gray-700 cursor-pointer select-none">
                                            Tandai sebagai Kepala Sekolah yang sedang menjabat
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>
                </div>

                @error('kepala')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ══ SUBMIT ══ --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.sejarah.index') }}"
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
$defaultParagraf = [
'Sekolah ini berdiri atas prakarsa tokoh-tokoh masyarakat yang peduli terhadap pendidikan generasi penerus bangsa. Didirikan pada tahun 1975 oleh <strong>Bapak H. Ahmad Fauzi</strong> bersama para pendiri lainnya, sekolah ini hadir untuk menjawab kebutuhan pendidikan di wilayah ini.',
'Nama sekolah dipilih sebagai simbol semangat dan tekad untuk mencetak generasi yang cerdas, berakhlak mulia, dan berdaya saing tinggi, selaras dengan perkembangan ilmu pengetahuan dan teknologi.',
'Kini, sekolah ini telah berkembang menjadi salah satu institusi pendidikan unggulan yang dikenal luas di kabupaten, dengan berbagai prestasi akademik dan non-akademik yang membanggakan.',
];

$defaultTimeline = [
['tahun' => '1975', 'judul' => 'Pendirian Sekolah', 'deskripsi' => 'Sekolah resmi didirikan dengan 3 kelas dan 90 siswa angkatan pertama, menempati bangunan sederhana di atas lahan hibah warga.'],
['tahun' => '1985', 'judul' => 'Akreditasi Pertama', 'deskripsi' => 'Sekolah mendapatkan akreditasi resmi dari Dinas Pendidikan dan mulai menerima siswa dari luar kecamatan.'],
['tahun' => '2002', 'judul' => 'Pembangunan Gedung Baru', 'deskripsi' => 'Dibangun gedung bertingkat dua beserta laboratorium IPA dan perpustakaan yang representatif.'],
['tahun' => '2024', 'judul' => 'Sekolah Penggerak & Digital', 'deskripsi' => 'Ditetapkan sebagai Sekolah Penggerak oleh Kemendikbud dan meluncurkan platform e-learning mandiri.'],
];

$defaultKepala = [
['nama' => 'Drs. H. Ahmad Fauzi', 'periode' => '1975 - 1990', 'foto_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200', 'aktif' => false],
['nama' => 'Dra. Hj. Sri Rahayu', 'periode' => '1990 - 2005', 'foto_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200', 'aktif' => false],
['nama' => 'Bpk. Eko Prasetyo, M.Pd.','periode' => '2005 - 2020', 'foto_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200', 'aktif' => false],
['nama' => 'Ibu Dr. Sari Dewi, M.Pd.','periode' => '2020 - Sekarang', 'foto_url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200', 'aktif' => true],
];

$paragrafData = old('paragraf', $sejarah->paragraf ?? $defaultParagraf);
$timelineData = old('timeline', $sejarah->timeline ?? $defaultTimeline);
$kepalaData = old('kepala', $sejarah->kepala ?? $defaultKepala);
@endphp

<script>
    function sejarahSekolahForm() {
        return {
            paragrafList: @json($paragrafData),
            timelineList: @json($timelineData),
            kepalaList: @json($kepalaData),

            // ── Paragraf
            addParagraf() {
                this.paragrafList.push('');
            },
            removeParagraf(index) {
                this.paragrafList.splice(index, 1);
            },

            // ── Timeline
            addTimeline() {
                this.timelineList.push({
                    tahun: '',
                    judul: '',
                    deskripsi: ''
                });
            },
            removeTimeline(index) {
                this.timelineList.splice(index, 1);
            },
            moveTimeline(index, direction) {
                const target = index + direction;
                if (target < 0 || target >= this.timelineList.length) return;
                [this.timelineList[index], this.timelineList[target]] = [this.timelineList[target], this.timelineList[index]];
            },

            // ── Kepala Sekolah
            addKepala() {
                this.kepalaList.push({
                    nama: '',
                    periode: '',
                    foto_url: '',
                    aktif: false
                });
            },
            removeKepala(index) {
                this.kepalaList.splice(index, 1);
            },
            setAktif(index) {
                // hanya satu yang bisa aktif sekaligus
                if (this.kepalaList[index].aktif) {
                    this.kepalaList.forEach((k, i) => {
                        if (i !== index) k.aktif = false;
                    });
                }
            },
        }
    }
</script>

@endsection