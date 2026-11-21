@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Informasi Umum Sekolah</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola identitas, fasilitas, dan kontak resmi Sekolah</p>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-sm">
        <span class="block sm:inline font-medium"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.informasi-umum.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800"><i class="fas fa-map-marked-alt text-green-600 mr-2"></i> 1. Identitas Sekolah</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $informasi->nama_sekolah) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="kode_pos" value="{{ old('kode_pos', $informasi->kode_pos) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan</label>
                            <input type="text" name="kecamatan" value="{{ old('kecamatan', $informasi->kecamatan) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kabupaten</label>
                            <input type="text" name="kabupaten" value="{{ old('kabupaten', $informasi->kabupaten) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Slogan</label>
                        <textarea
                            name="slogan"
                            required
                            rows="3"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">{{ old('slogan', $informasi->slogan) }}</textarea>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Logo</label>
                        @if($informasi->logo)
                        <div class="mb-3">
                            <img src="{{ asset($informasi->logo) }}" alt="Logo" class="h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="w-full border-gray-300 rounded-lg shadow-sm p-2 border bg-gray-50 text-sm">
                        <p class="text-xs text-gray-500 mt-1">*Abaikan jika tidak ingin mengubah logo lama. (Maks. 2MB)</p>
                    </div>
                    <div class="border-t border-gray-100 pt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Identitas Sekolah (Samping Kanan Atas)</label>
                        @if($informasi->foto_identitas)
                        <div class="mb-3">
                            <img src="{{ asset($informasi->foto_identitas) }}" alt="Foto Identitas" class="h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                        @endif
                        <input type="file" name="foto_identitas" accept="image/*" class="w-full border-gray-300 rounded-lg shadow-sm p-2 border bg-gray-50 text-sm">
                        <p class="text-xs text-gray-500 mt-1">*Abaikan jika tidak ingin mengubah foto lama. (Maks. 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800"><i class="fas fa-building text-blue-600 mr-2"></i> 2. Jumlah Fasilitas Sekolah</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                        {{-- Item 1 --}}
                        <div>
                            <input type="text"
                                name="nama_fasilitas_1"
                                value="{{ old('nama_fasilitas_1', $informasi->nama_fasilitas_1 ?? 'Sekolah Dasar') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm p-2.5 border mb-2 font-semibold">

                            <input type="number"
                                name="jumlah_sekolah"
                                value="{{ old('jumlah_sekolah', $informasi->jumlah_sekolah) }}"
                                required min="0"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2.5 border">
                        </div>

                        {{-- Item 2 --}}
                        <div>
                            <input type="text"
                                name="nama_fasilitas_2"
                                value="{{ old('nama_fasilitas_2', $informasi->nama_fasilitas_2 ?? 'Tempat Ibadah') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm p-2.5 border mb-2 font-semibold">

                            <input type="number"
                                name="jumlah_ibadah"
                                value="{{ old('jumlah_ibadah', $informasi->jumlah_ibadah) }}"
                                required min="0"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2.5 border">
                        </div>

                        {{-- Item 3 --}}
                        <div>
                            <input type="text"
                                name="nama_fasilitas_3"
                                value="{{ old('nama_fasilitas_3', $informasi->nama_fasilitas_3 ?? 'Puskesmas / Pustu') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm p-2.5 border mb-2 font-semibold">

                            <input type="number"
                                name="jumlah_puskesmas"
                                value="{{ old('jumlah_puskesmas', $informasi->jumlah_puskesmas) }}"
                                required min="0"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2.5 border">
                        </div>

                        {{-- Item 4 --}}
                        <div>
                            <input type="text"
                                name="nama_fasilitas_4"
                                value="{{ old('nama_fasilitas_4', $informasi->nama_fasilitas_4 ?? 'Balai Warga') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm p-2.5 border mb-2 font-semibold">

                            <input type="number"
                                name="jumlah_balai"
                                value="{{ old('jumlah_balai', $informasi->jumlah_balai) }}"
                                required min="0"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2.5 border">
                        </div>

                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Fasilitas Sekolah (Samping Kanan Bawah)</label>
                        @if($informasi->foto_fasilitas)
                        <div class="mb-3">
                            <img src="{{ asset($informasi->foto_fasilitas) }}" alt="Foto Fasilitas" class="h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                        @endif
                        <input type="file" name="foto_fasilitas" accept="image/*" class="w-full border-gray-300 rounded-lg shadow-sm p-2 border bg-gray-50 text-sm">
                        <p class="text-xs text-gray-500 mt-1">*Abaikan jika tidak ingin mengubah foto lama. (Maks. 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800"><i class="fas fa-phone-alt text-orange-600 mr-2"></i> 3. Kontak Darurat / Bantuan</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp Petugas</label>
                            <input type="text" name="kontak_wa" value="{{ old('kontak_wa', $informasi->kontak_wa) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 p-2.5 border" placeholder="Contoh: 081234567890">
                            <p class="text-[11px] text-gray-500 mt-1">Gunakan angka 0 atau 62 di depan. Otomatis menjadi link chat WA di halaman depan.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Resmi Sekolah</label>
                            <input type="email" name="kontak_email" value="{{ old('kontak_email', $informasi->kontak_email) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 p-2.5 border">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-8 sticky bottom-6 z-50">
            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex justify-end gap-4 items-center">
                <p class="text-sm text-gray-500 italic mr-auto hidden md:block">Pastikan foto dan data sudah benar sebelum menyimpan.</p>
                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold shadow-md flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Semua Perubahan
                </button>
            </div>
        </div>

    </form>

    {{-- ===========================
         SECTION 4: POTENSI & KEUNGGULAN (outside main form, own CRUD)
    =========================== --}}
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-star text-green-500 mr-2"></i> 4. Potensi & Keunggulan Sekolah
            </h2>
            <button type="button" onclick="openModalKeunggulan('create')"
                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-lg shadow flex items-center gap-2 transition">
                <i class="fas fa-plus"></i> Tambah Keunggulan
            </button>
        </div>
        <div class="p-6">

            @if($keunggulans->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-50 border border-green-100 mb-4">
                    <i class="fas fa-star text-3xl text-green-300"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Belum ada data keunggulan.</p>
                <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Keunggulan" untuk menambahkan.</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wide">
                            <th class="px-4 py-3 border-b border-gray-200 rounded-tl-lg w-10">No</th>
                            <th class="px-4 py-3 border-b border-gray-200 w-14">Icon</th>
                            <th class="px-4 py-3 border-b border-gray-200">Judul</th>
                            <th class="px-4 py-3 border-b border-gray-200">Deskripsi</th>
                            <th class="px-4 py-3 border-b border-gray-200 rounded-tr-lg text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($keunggulans as $i => $item)
                        <tr class="hover:bg-green-50/40 transition group">
                            <td class="px-4 py-3.5 text-gray-400 font-medium">{{ $i + 1 }}</td>
                            <td class="px-4 py-3.5">
                                @if($item->icon)
                                <img src="{{ asset($item->icon) }}"
                                    alt="Icon {{ $item->judul }}"
                                    class="w-10 h-10 object-contain rounded-xl border border-gray-200 bg-gray-50 p-1 shadow-sm">
                                @else
                                <div class="w-10 h-10 rounded-xl border border-dashed border-gray-300 flex items-center justify-center text-gray-300 text-xs">
                                    <i class="fas fa-image"></i>
                                </div>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 font-semibold text-gray-800">{{ $item->judul }}</td>
                            <td class="px-4 py-3.5 text-gray-500 max-w-xs">
                                <span class="line-clamp-2 leading-relaxed">{{ $item->deskripsi }}</span>
                            </td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button"
                                        onclick="openModalKeunggulan('edit', {{ $item->id }}, '{{ addslashes($item->judul) }}', {{ json_encode($item->deskripsi) }}, '{{ $item->icon ? asset($item->icon) : '' }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-xs font-semibold transition border border-blue-200">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button"
                                        onclick="confirmDeleteKeunggulan({{ $item->id }}, '{{ addslashes($item->judul) }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs font-semibold transition border border-red-200">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
                <span>Total <strong class="text-gray-600">{{ $keunggulans->count() }}</strong> keunggulan terdaftar</span>
                <span>Urutan ditampilkan berdasarkan waktu dibuat</span>
            </div>
            @endif

        </div>
    </div>
</div>

{{-- ===============================================================
     MODAL: TAMBAH / EDIT KEUNGGULAN
=============================================================== --}}
<div id="modalKeunggulan" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModalKeunggulan()"></div>

    {{-- Modal Box --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 modal-animate">

        {{-- Modal Header --}}
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-2xl flex items-center justify-between">
            <h3 id="modalKeunggulanTitle" class="text-base font-bold text-gray-800">
                <i class="fas fa-star text-green-500 mr-2"></i> Tambah Keunggulan
            </h3>
            <button type="button" onclick="closeModalKeunggulan()"
                class="w-7 h-7 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 space-y-5">

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Judul Keunggulan <span class="text-red-500">*</span>
                </label>
                <input type="text" id="modalJudul"
                    class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition">
            </div>

            {{-- Icon Upload --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Icon / Gambar <span class="text-red-500">*</span>
                </label>

                {{-- Drop Zone --}}
                <div id="iconDropZone"
                    onclick="document.getElementById('modalIconFile').click()"
                    ondragover="handleDragOver(event)"
                    ondragleave="handleDragLeave(event)"
                    ondrop="handleDrop(event)"
                    class="relative flex flex-col items-center justify-center gap-3 border-2 border-dashed border-gray-300 rounded-xl p-5 cursor-pointer bg-gray-50 hover:bg-green-50 hover:border-green-400 transition-all group">

                    {{-- Preview image (hidden by default) --}}
                    <img id="iconImgPreview"
                        src=""
                        alt="Preview"
                        class="hidden w-20 h-20 object-contain rounded-xl border border-gray-200 shadow-sm">

                    {{-- Placeholder --}}
                    <div id="iconPlaceholder" class="flex flex-col items-center gap-2 text-gray-400 group-hover:text-green-500 transition">
                        <div class="w-12 h-12 rounded-full bg-gray-100 group-hover:bg-green-100 flex items-center justify-center transition">
                            <i class="fas fa-cloud-upload-alt text-2xl"></i>
                        </div>
                        <p class="text-sm font-medium">Klik atau drag & drop gambar di sini</p>
                        <p class="text-xs text-gray-400">PNG, JPG, SVG, WEBP — Maks. 1MB</p>
                    </div>

                    {{-- File name badge (hidden by default) --}}
                    <div id="iconFileName" class="hidden items-center gap-2 text-xs text-gray-500 bg-white border border-gray-200 rounded-lg px-3 py-1.5 shadow-sm">
                        <i class="fas fa-file-image text-green-500"></i>
                        <span id="iconFileNameText">-</span>
                        <button type="button" onclick="clearIconUpload(event)"
                            class="ml-1 text-red-400 hover:text-red-600 transition">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>

                    <input type="file" id="modalIconFile" accept="image/*"
                        class="hidden" onchange="handleIconFileChange(event)">
                </div>

                {{-- Current icon display (for edit mode) --}}
                <div id="currentIconWrap" class="hidden mt-3 flex items-center gap-3 bg-blue-50 border border-blue-200 rounded-lg px-4 py-2.5">
                    <img id="currentIconImg" src="" alt="Icon saat ini"
                        class="w-10 h-10 object-contain rounded-lg border border-blue-200 bg-white p-1">
                    <div>
                        <p class="text-xs font-semibold text-blue-700">Icon saat ini</p>
                        <p class="text-xs text-blue-500">Upload baru untuk mengganti, atau biarkan jika tidak ingin mengubah.</p>
                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea id="modalDeskripsi" rows="3"
                    placeholder="Jelaskan keunggulan ini secara singkat dan menarik..."
                    class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition resize-none leading-relaxed"></textarea>
                <p class="text-xs text-gray-400 mt-1" id="charCount">0 karakter</p>
            </div>

        </div>

        {{-- Modal Footer --}}
        <div class="px-6 py-4 border-t border-gray-100 rounded-b-2xl bg-gray-50 flex justify-end gap-3">
            <button type="button" onclick="closeModalKeunggulan()"
                class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-100 rounded-lg transition border border-gray-300">
                <i class="fas fa-times mr-1.5"></i> Batal
            </button>
            <button type="button" id="btnSimpanKeunggulan" onclick="submitKeunggulan()"
                class="px-5 py-2 text-sm font-bold text-white bg-green-500 hover:bg-green-600 active:bg-green-700 rounded-lg shadow transition flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </div>
</div>

{{-- ===============================================================
     MODAL: KONFIRMASI DELETE
=============================================================== --}}
<div id="modalDeleteKeunggulan" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 modal-animate text-center p-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 text-red-500 text-3xl mb-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 7.5h12m-9 0V6a1.5 1.5 0 0 1 1.5-1.5h3A1.5 1.5 0 0 1 15 6v1.5m3 0v12A1.5 1.5 0 0 1 16.5 21h-9A1.5 1.5 0 0 1 6 19.5v-12m3 3v7.5m6-7.5v7.5" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-800 mb-2">Hapus Keunggulan?</h3>
        <p class="text-sm text-gray-500 mb-1">Anda akan menghapus:</p>
        <p id="deleteItemName" class="text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg px-3 py-2 mb-6 italic">"..."</p>
        <p class="text-xs text-red-400 mb-6">Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex gap-3 justify-center">
            <button type="button" onclick="closeDeleteModal()"
                class="px-5 py-2 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition border border-gray-300">
                Batal
            </button>
            <button type="button" id="btnConfirmDelete" onclick="executeDelete()"
                class="px-5 py-2 text-sm font-bold text-white bg-red-500 hover:bg-red-600 rounded-lg shadow transition flex items-center gap-2">
                <i class="fas fa-trash"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

{{-- Hidden forms for delete --}}
<form id="formDeleteKeunggulan" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    // ========== STATE ==========
    let modeKeunggulan = 'create';
    let editIdKeunggulan = null;
    let deleteIdKeunggulan = null;
    let selectedIconFile = null; // holds the File object for upload

    // ========== OPEN MODAL (CREATE / EDIT) ==========
    function openModalKeunggulan(mode, id = null, judul = '', deskripsi = '', iconUrl = '') {
        modeKeunggulan = mode;
        editIdKeunggulan = id;
        selectedIconFile = null;

        const modal = document.getElementById('modalKeunggulan');
        const title = document.getElementById('modalKeunggulanTitle');
        const btn = document.getElementById('btnSimpanKeunggulan');

        // Reset upload zone
        resetIconUploadUI();

        if (mode === 'edit') {
            title.innerHTML = '<i class="fas fa-edit text-blue-500 mr-2"></i> Edit Keunggulan';
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
            document.getElementById('modalJudul').value = judul;
            document.getElementById('modalDeskripsi').value = deskripsi;

            // Show current icon
            if (iconUrl) {
                const wrap = document.getElementById('currentIconWrap');
                const img = document.getElementById('currentIconImg');
                img.src = iconUrl;
                wrap.classList.remove('hidden');
                wrap.classList.add('flex');
            }
            updateCharCount();
        } else {
            title.innerHTML = '<i class="fas fa-star text-green-500 mr-2"></i> Tambah Keunggulan';
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan';
            document.getElementById('modalJudul').value = '';
            document.getElementById('modalDeskripsi').value = '';
            document.getElementById('charCount').textContent = '0 karakter';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => document.getElementById('modalJudul').focus(), 100);
    }

    // ========== CLOSE MODAL ==========
    function closeModalKeunggulan() {
        document.getElementById('modalKeunggulan').classList.add('hidden');
        document.getElementById('modalKeunggulan').classList.remove('flex');
        selectedIconFile = null;
    }

    // ========== ICON UPLOAD HANDLERS ==========
    function handleIconFileChange(event) {
        const file = event.target.files[0];
        if (file) setIconFile(file);
    }

    function handleDragOver(event) {
        event.preventDefault();
        document.getElementById('iconDropZone').classList.add('border-green-400', 'bg-green-50');
    }

    function handleDragLeave(event) {
        document.getElementById('iconDropZone').classList.remove('border-green-400', 'bg-green-50');
    }

    function handleDrop(event) {
        event.preventDefault();
        handleDragLeave(event);
        const file = event.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            setIconFile(file);
            // also assign to the file input so form can pick it up
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('modalIconFile').files = dt.files;
        }
    }

    function setIconFile(file) {
        if (file.size > 1 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 1MB.');
            return;
        }
        selectedIconFile = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            // Show preview image
            const preview = document.getElementById('iconImgPreview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');

            // Hide placeholder
            document.getElementById('iconPlaceholder').classList.add('hidden');

            // Show filename
            const fileNameEl = document.getElementById('iconFileName');
            document.getElementById('iconFileNameText').textContent = file.name;
            fileNameEl.classList.remove('hidden');
            fileNameEl.classList.add('flex');

            // Hide "current icon" since new one selected
            document.getElementById('currentIconWrap').classList.add('hidden');
            document.getElementById('currentIconWrap').classList.remove('flex');
        };
        reader.readAsDataURL(file);
    }

    function clearIconUpload(event) {
        event.stopPropagation();
        selectedIconFile = null;
        document.getElementById('modalIconFile').value = '';
        resetIconUploadUI();
    }

    function resetIconUploadUI() {
        // Hide preview
        const preview = document.getElementById('iconImgPreview');
        preview.src = '';
        preview.classList.add('hidden');

        // Show placeholder
        document.getElementById('iconPlaceholder').classList.remove('hidden');

        // Hide filename
        const fileNameEl = document.getElementById('iconFileName');
        fileNameEl.classList.add('hidden');
        fileNameEl.classList.remove('flex');

        // Hide current icon wrap
        const wrap = document.getElementById('currentIconWrap');
        wrap.classList.add('hidden');
        wrap.classList.remove('flex');

        // Reset drop zone style
        const dz = document.getElementById('iconDropZone');
        dz.classList.remove('border-green-400', 'bg-green-50');
    }

    // ========== CHAR COUNT ==========
    function updateCharCount() {
        const val = document.getElementById('modalDeskripsi').value;
        document.getElementById('charCount').textContent = val.length + ' karakter';
    }
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('modalDeskripsi').addEventListener('input', updateCharCount);
    });

    // ========== SUBMIT (CREATE / EDIT) — uses real multipart form ==========
    function submitKeunggulan() {
        const judul = document.getElementById('modalJudul').value.trim();
        const deskripsi = document.getElementById('modalDeskripsi').value.trim();

        // Validation
        if (!judul) {
            shakeInput('modalJudul');
            return;
        }
        if (!deskripsi) {
            shakeInput('modalDeskripsi');
            return;
        }

        // For create mode, icon is required. For edit, it's optional (keep old).
        if (modeKeunggulan === 'create' && !selectedIconFile) {
            const dz = document.getElementById('iconDropZone');
            dz.classList.add('border-red-400', 'bg-red-50');
            setTimeout(() => dz.classList.remove('border-red-400', 'bg-red-50'), 1500);
            return;
        }

        // Loading state
        const btn = document.getElementById('btnSimpanKeunggulan');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        btn.disabled = true;

        // Build real FormData to support file upload
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);

        if (selectedIconFile) {
            formData.append('icon', selectedIconFile);
        }

        let actionUrl;
        if (modeKeunggulan === 'edit') {
            formData.append('_method', 'PUT');
            actionUrl = `/admin/keunggulan/${editIdKeunggulan}`;
        } else {
            actionUrl = '{{ route("admin.keunggulan.store") }}';
        }

        fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else if (response.ok) {
                    window.location.reload();
                } else {
                    return response.json().then(data => {
                        throw data;
                    });
                }
            })
            .catch(err => {
                btn.innerHTML = '<i class="fas fa-save"></i> Simpan';
                btn.disabled = false;
                const msg = err?.message || 'Terjadi kesalahan. Silakan coba lagi.';
                alert(msg);
            });
    }

    // ========== DELETE ==========
    function confirmDeleteKeunggulan(id, name) {
        deleteIdKeunggulan = id;
        document.getElementById('deleteItemName').textContent = '"' + name + '"';
        const modal = document.getElementById('modalDeleteKeunggulan');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('modalDeleteKeunggulan').classList.add('hidden');
        document.getElementById('modalDeleteKeunggulan').classList.remove('flex');
    }

    function executeDelete() {
        const btn = document.getElementById('btnConfirmDelete');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        btn.disabled = true;

        const form = document.getElementById('formDeleteKeunggulan');
        form.action = `/admin/keunggulan/${deleteIdKeunggulan}`;
        form.submit();
    }

    // ========== HELPER: shake invalid input ==========
    function shakeInput(id) {
        const el = document.getElementById(id);
        el.classList.add('border-red-400', 'ring-2', 'ring-red-100');
        el.style.animation = 'shake 0.4s ease';
        el.focus();
        setTimeout(() => {
            el.style.animation = '';
        }, 500);
    }

    // ========== KEYBOARD: close modal on ESC ==========
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModalKeunggulan();
            closeDeleteModal();
        }
    });
</script>
@endsection