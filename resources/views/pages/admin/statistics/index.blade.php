@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Statistik Desa</h1>
        <p class="text-gray-500 text-sm mt-1">Perbarui angka demografi dan data grafik langsung dari halaman ini.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-sm">
        <span class="block sm:inline font-medium"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.statistics.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            @foreach($statistics as $category => $items)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800 uppercase tracking-wider">
                        <i class="fas fa-chart-pie text-green-600 mr-2"></i> Kategori: {{ $category }}
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($items as $i => $item)
                        <div>
                            @if($category == 'demografi')
                            {{-- Input Nama --}}
                            <input type="text"
                                name="nama_{{ $i+1 }}"
                                value="{{ old('nama_'.($i+1), $kategoriDemografi->{'nama_'.($i+1)} ?? '-') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm p-2.5 border mb-2 font-semibold">

                            {{-- Input Icon (String) --}}
                            <input type="text"
                                name="icon_{{ $i+1 }}"
                                value="{{ old('icon_'.($i+1), $kategoriDemografi->{'icon_'.($i+1)} ?? '') }}"
                                placeholder="Contoh: fas fa-home"
                                oninput="previewDemografiIcon(this.value, {{ $i+1 }})"
                                class="w-full border-gray-300 rounded-lg shadow-sm p-2.5 border text-sm font-mono">

                            <a href="https://fontawesome.com/v5/search" target="_blank" rel="noopener noreferrer">
                                <span class="input-hint"><i class="fas fa-info-circle"></i> FontAwesome class</span>
                            </a>

                            <div class="icon-preview">
                                <div class="icon-preview-box" id="prev-icon-{{ $i+1 }}">
                                    <i id="prev-icon-el-{{ $i+1 }}" class="{{ $kategoriDemografi->{'icon_'.($i+1)} ?? 'fas fa-home' }}"></i>
                                </div>
                                <span style="font-size:.75rem;color:var(--slate-400);font-weight:500">Preview icon</span>
                            </div>
                            @else
                            <label for="{{ $item->key }}" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ $item->name }}
                            </label>
                            @endif

                            <input type="number"
                                name="{{ $item->key }}"
                                id="{{ $item->key }}"
                                value="{{ $item->value }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border"
                                placeholder="jumlah"
                                required min="0">
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="mt-8 sticky bottom-6 z-50">
            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex justify-end gap-4 items-center">
                <p class="text-sm text-gray-500 italic mr-auto hidden md:block">Pastikan angka sudah benar sebelum menyimpan.</p>
                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold shadow-md flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Semua Perubahan
                </button>
            </div>
        </div>

    </form>

    <!-- Data Beasiswa -->
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-chart-pie text-green-600 mr-2"></i> KATEGORI: BEASISWA
            </h2>
            <button type="button" onclick="openModalBeasiswa('create')"
                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-lg shadow flex items-center gap-2 transition">
                <i class="fas fa-plus"></i> Tambah Beasiswa
            </button>
        </div>
        <div class="p-6">

            @if($beasiswa->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-50 border border-green-100 mb-4">
                    <i class="fas fa-star text-3xl text-green-300"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Belum ada data beasiswa.</p>
                <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Beasiswa" untuk menambahkan.</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wide">
                            <th class="px-4 py-3 border-b border-gray-200 rounded-tl-lg w-10">No</th>
                            <th class="px-4 py-3 border-b border-gray-200 w-14">Icon</th>
                            <th class="px-4 py-3 border-b border-gray-200">Nama</th>
                            <th class="px-4 py-3 border-b border-gray-200">Jumlah</th>
                            <th class="px-4 py-3 border-b border-gray-200 rounded-tr-lg text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($beasiswa as $i => $item)
                        <tr class="hover:bg-green-50/40 transition group">
                            <td class="px-4 py-3.5 text-gray-400 font-medium">{{ $i + 1 }}</td>
                            <td class="px-4 py-3.5">
                                <i class="{{$item->icon}}"></i>
                            </td>
                            <td class="px-4 py-3.5 font-semibold text-gray-800">{{ $item->nama }}</td>
                            <td class="px-4 py-3.5 text-gray-500 max-w-xs">
                                <span class="line-clamp-2 leading-relaxed">{{ $item->jumlah }}</span>
                            </td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button"
                                        onclick="openModalBeasiswa('edit', {{ $item->id }}, '{{ addslashes($item->nama) }}', '{{ $item->jumlah }}', '{{ $item->icon }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-xs font-semibold transition border border-blue-200">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button"
                                        onclick="confirmDeleteBeasiswa({{ $item->id }}, '{{ addslashes($item->nama) }}')"
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
                <span>Total <strong class="text-gray-600">{{ $beasiswa->count() }}</strong> beasiswa terdaftar</span>
                <span>Urutan ditampilkan berdasarkan waktu dibuat</span>
            </div>
            @endif

        </div>
    </div>

    <div id="modalBeasiswa" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModalBeasiswa()"></div>

        {{-- Modal Box --}}
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 modal-animate">

            {{-- Modal Header --}}
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-2xl flex items-center justify-between">
                <h3 id="modalBeasiswaTitle" class="text-base font-bold text-gray-800">
                    <i class="fas fa-star text-green-500 mr-2"></i> Tambah Beasiswa
                </h3>
                <button type="button" onclick="closeModalBeasiswa()"
                    class="w-7 h-7 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nama Beasiswa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="modalNama"
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Icon <span class="text-red-500">*</span>
                        <span class="text-xs text-gray-400 font-normal ml-1">(contoh: fas fa-star)</span>
                    </label>
                    <div class="flex gap-2 items-center">
                        <input type="text" id="modalIcon" placeholder="fas fa-star"
                            oninput="previewFaIcon(this.value)"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition font-mono">
                        <div id="iconPreviewBox"
                            class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-300 text-xl transition">
                            <i id="iconPreviewEl" class="fas fa-question"></i>
                        </div>
                    </div>
                    <p id="iconError" class="text-xs text-red-400 mt-1 hidden">Icon tidak valid.</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Jumlah <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="modalJumlah"
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition">
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="px-6 py-4 border-t border-gray-100 rounded-b-2xl bg-gray-50 flex justify-end gap-3">
                <button type="button" onclick="closeModalBeasiswa()"
                    class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-100 rounded-lg transition border border-gray-300">
                    <i class="fas fa-times mr-1.5"></i> Batal
                </button>
                <button type="button" id="btnSimpanBeasiswa" onclick="submitBeasiswa()"
                    class="px-5 py-2 text-sm font-bold text-white bg-green-500 hover:bg-green-600 active:bg-green-700 rounded-lg shadow transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>

    <div id="modalDeleteBeasiswa" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
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
            <h3 class="text-lg font-bold text-gray-800 mb-2">Hapus Beasiswa?</h3>
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
    <form id="formDeleteBeasiswa" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Data Rombel -->
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-chart-pie text-green-600 mr-2"></i> KATEGORI: ROMBEL
            </h2>
            <button type="button" onclick="openModalRombel('create')"
                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-lg shadow flex items-center gap-2 transition">
                <i class="fas fa-plus"></i> Tambah Rombel
            </button>
        </div>
        <div class="p-6">

            @if($rombel->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-50 border border-green-100 mb-4">
                    <i class="fas fa-star text-3xl text-green-300"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Belum ada data rombel.</p>
                <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Rombel" untuk menambahkan.</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wide">
                            <th class="px-4 py-3 border-b border-gray-200 rounded-tl-lg w-10">No</th>
                            <th class="px-4 py-3 border-b border-gray-200">Nama Rombel</th>
                            <th class="px-4 py-3 border-b border-gray-200">Jumlah Murid</th>
                            <th class="px-4 py-3 border-b border-gray-200 rounded-tr-lg text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($rombel as $i => $item)
                        <tr class="hover:bg-green-50/40 transition group">
                            <td class="px-4 py-3.5 text-gray-400 font-medium">{{ $i + 1 }}</td>
                            <td class="px-4 py-3.5 font-semibold text-gray-800">{{ $item->nama }}</td>
                            <td class="px-4 py-3.5 text-gray-500 max-w-xs">
                                <span class="line-clamp-2 leading-relaxed">{{ $item->jumlah }}</span>
                            </td>
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button"
                                        onclick="openModalRombel('edit', {{ $item->id }}, '{{ addslashes($item->nama) }}', '{{ $item->jumlah }}', '{{ $item->icon }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-xs font-semibold transition border border-blue-200">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button"
                                        onclick="confirmDeleteRombel({{ $item->id }}, '{{ addslashes($item->nama) }}')"
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
                <span>Total <strong class="text-gray-600">{{ $rombel->count() }}</strong> rombel terdaftar</span>
                <span>Urutan ditampilkan berdasarkan waktu dibuat</span>
            </div>
            @endif

        </div>
    </div>

    <div id="modalRombel" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModalRombel()"></div>

        {{-- Modal Box --}}
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 modal-animate">

            {{-- Modal Header --}}
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-2xl flex items-center justify-between">
                <h3 id="modalRombelTitle" class="text-base font-bold text-gray-800">
                    <i class="fas fa-star text-green-500 mr-2"></i> Tambah Rombel
                </h3>
                <button type="button" onclick="closeModalRombel()"
                    class="w-7 h-7 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nama Rombel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="modalNamaRombel"
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Jumlah Murid <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="modalJumlahRombel"
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-green-400 focus:ring-2 focus:ring-green-100 outline-none transition">
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="px-6 py-4 border-t border-gray-100 rounded-b-2xl bg-gray-50 flex justify-end gap-3">
                <button type="button" onclick="closeModalRombel()"
                    class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-100 rounded-lg transition border border-gray-300">
                    <i class="fas fa-times mr-1.5"></i> Batal
                </button>
                <button type="button" id="btnSimpanRombel" onclick="submitRombel()"
                    class="px-5 py-2 text-sm font-bold text-white bg-green-500 hover:bg-green-600 active:bg-green-700 rounded-lg shadow transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>

    <div id="modalDeleteRombel" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDeleteModalRombel()"></div>
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
            <h3 class="text-lg font-bold text-gray-800 mb-2">Hapus Beasiswa?</h3>
            <p class="text-sm text-gray-500 mb-1">Anda akan menghapus:</p>
            <p id="deleteItemNameRombel" class="text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg px-3 py-2 mb-6 italic">"..."</p>
            <p class="text-xs text-red-400 mb-6">Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3 justify-center">
                <button type="button" onclick="closeDeleteModalRombel()"
                    class="px-5 py-2 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition border border-gray-300">
                    Batal
                </button>
                <button type="button" id="btnConfirmDelete" onclick="executeDeleteRombel()"
                    class="px-5 py-2 text-sm font-bold text-white bg-red-500 hover:bg-red-600 rounded-lg shadow transition flex items-center gap-2">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- Hidden forms for delete --}}
    <form id="formDeleteRombel" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
    function previewDemografiIcon(val, index) {
        const el = document.getElementById('prev-icon-el-' + index);
        const box = document.getElementById('prev-icon-' + index);
        if (!el || !box) return;

        // Reset classes
        el.className = '';
        val.trim().split(/\s+/).forEach(c => {
            if (c) el.classList.add(c);
        });

        if (!val.trim()) {
            el.className = 'fas fa-home';
            box.style.borderColor = '';
            box.style.background = '';
            el.style.color = '';
            return;
        }

        setTimeout(() => {
            const content = window.getComputedStyle(el, '::before').content;
            const valid = content && content !== 'none' && content !== '""' && content !== "''";

            box.style.borderColor = valid ? '#86efac' : '#fca5a5';
            box.style.background = valid ? '#f0fdf4' : '#fef2f2';
            el.style.color = valid ? '#16a34a' : '#ef4444';
        }, 80);
    }

    // ========== BEASISWA STATE ==========
    let modeBeasiswa = 'create';
    let editIdBeasiswa = null;
    let deleteIdBeasiswa = null;

    // ========== OPEN MODAL ==========
    function openModalBeasiswa(mode, id = null, nama = '', jumlah = '', icon = '') {
        modeBeasiswa = mode;
        editIdBeasiswa = id;

        const modal = document.getElementById('modalBeasiswa');
        const title = document.getElementById('modalBeasiswaTitle');
        const btn = document.getElementById('btnSimpanBeasiswa');

        if (mode === 'edit') {
            title.innerHTML = '<i class="fas fa-edit text-blue-500 mr-2"></i> Edit Beasiswa';
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
            document.getElementById('modalNama').value = nama;
            document.getElementById('modalJumlah').value = jumlah;
            document.getElementById('modalIcon').value = icon;
            previewFaIcon(icon);
        } else {
            title.innerHTML = '<i class="fas fa-star text-green-500 mr-2"></i> Tambah Beasiswa';
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan';
            document.getElementById('modalNama').value = '';
            document.getElementById('modalJumlah').value = '';
            document.getElementById('modalIcon').value = '';
            previewFaIcon('');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => document.getElementById('modalNama').focus(), 100);
    }

    // ========== CLOSE MODAL ==========
    function closeModalBeasiswa() {
        const modal = document.getElementById('modalBeasiswa');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ========== LIVE ICON PREVIEW ==========
    function previewFaIcon(val) {
        const box = document.getElementById('iconPreviewBox');
        const el = document.getElementById('iconPreviewEl');
        const err = document.getElementById('iconError');

        // Reset
        el.className = '';
        box.className = 'w-11 h-11 flex-shrink-0 flex items-center justify-center rounded-xl border text-2xl transition';

        if (!val.trim()) {
            el.classList.add('fas', 'fa-question');
            box.classList.add('border-gray-200', 'bg-gray-50', 'text-gray-300');
            err.classList.add('hidden');
            return;
        }

        // Apply classes from string
        val.trim().split(/\s+/).forEach(c => el.classList.add(c));

        // Check after FA renders
        setTimeout(() => {
            const content = window.getComputedStyle(el, '::before').content;
            const valid = content && content !== 'none' && content !== '""' && content !== "''";

            if (valid) {
                box.classList.add('border-green-300', 'bg-green-50');
                el.style.color = '#16a34a';
                err.classList.add('hidden');
            } else {
                box.classList.add('border-red-300', 'bg-red-50');
                el.style.color = '#ef4444';
                err.classList.remove('hidden');
            }
        }, 80);
    }

    // ========== SUBMIT ==========
    function submitBeasiswa() {
        const nama = document.getElementById('modalNama').value.trim();
        const icon = document.getElementById('modalIcon').value.trim();
        const jumlah = document.getElementById('modalJumlah').value.trim();

        if (!nama) {
            shakeInput('modalNama');
            return;
        }
        if (!icon) {
            shakeInput('modalIcon');
            return;
        }
        if (!jumlah) {
            shakeInput('modalJumlah');
            return;
        }

        const btn = document.getElementById('btnSimpanBeasiswa');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('nama', nama);
        formData.append('icon', icon);
        formData.append('jumlah', jumlah);

        let actionUrl;
        if (modeBeasiswa === 'edit') {
            formData.append('_method', 'PUT');
            actionUrl = `/admin/beasiswa/${editIdBeasiswa}`;
        } else {
            actionUrl = '{{ route("admin.beasiswa.store") }}';
        }

        fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.redirected || response.ok) {
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
                alert(err?.message || 'Terjadi kesalahan. Silakan coba lagi.');
            });
    }

    // ========== DELETE ==========
    function confirmDeleteBeasiswa(id, name) {
        deleteIdBeasiswa = id;
        document.getElementById('deleteItemName').textContent = '"' + name + '"';
        const modal = document.getElementById('modalDeleteBeasiswa');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('modalDeleteBeasiswa');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function executeDelete() {
        const btn = document.getElementById('btnConfirmDelete');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        btn.disabled = true;

        const form = document.getElementById('formDeleteBeasiswa');
        form.action = `/admin/beasiswa/${deleteIdBeasiswa}`;
        form.submit();
    }

    // ========== ROMBEL STATE ==========
    let modeRombel = 'create';
    let editIdRombel = null;
    let deleteIdRombel = null;

    // ========== OPEN MODAL ==========
    function openModalRombel(mode, id = null, nama = '', jumlah = '') {
        modeRombel = mode;
        editIdRombel = id;

        const modal = document.getElementById('modalRombel');
        const title = document.getElementById('modalRombelTitle');
        const btn = document.getElementById('btnSimpanRombel');

        if (mode === 'edit') {
            title.innerHTML = '<i class="fas fa-edit text-blue-500 mr-2"></i> Edit Rombel';
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
            document.getElementById('modalNamaRombel').value = nama;
            document.getElementById('modalJumlahRombel').value = jumlah;
        } else {
            title.innerHTML = '<i class="fas fa-star text-green-500 mr-2"></i> Tambah Rombel';
            btn.innerHTML = '<i class="fas fa-save"></i> Simpan';
            document.getElementById('modalNamaRombel').value = '';
            document.getElementById('modalJumlahRombel').value = '';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => document.getElementById('modalNamaRombel').focus(), 100);
    }

    // ========== CLOSE MODAL ==========
    function closeModalRombel() {
        const modal = document.getElementById('modalRombel');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ========== SUBMIT ==========
    function submitRombel() {
        const nama = document.getElementById('modalNamaRombel').value.trim();
        const jumlah = document.getElementById('modalJumlahRombel').value.trim();

        if (!nama) {
            shakeInput('modalNamaRombel');
            return;
        }
        if (!jumlah) {
            shakeInput('modalJumlahRombel');
            return;
        }

        const btn = document.getElementById('btnSimpanRombel');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('nama', nama);
        formData.append('jumlah', jumlah);

        let actionUrl;
        if (modeRombel === 'edit') {
            formData.append('_method', 'PUT');
            actionUrl = `/admin/rombel/${editIdRombel}`;
        } else {
            actionUrl = '{{ route("admin.rombel.store") }}';
        }

        fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.redirected || response.ok) {
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
                alert(err?.message || 'Terjadi kesalahan. Silakan coba lagi.');
            });
    }

    // ========== DELETE ==========
    function confirmDeleteRombel(id, name) {
        deleteIdRombel = id;
        document.getElementById('deleteItemNameRombel').textContent = '"' + name + '"';
        const modal = document.getElementById('modalDeleteRombel');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModalRombel() {
        const modal = document.getElementById('modalDeleteRombel');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function executeDeleteRombel() {
        const btn = document.getElementById('btnConfirmDelete');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        btn.disabled = true;

        const form = document.getElementById('formDeleteRombel');
        form.action = `/admin/rombel/${deleteIdRombel}`;
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
            el.classList.remove('border-red-400', 'ring-2', 'ring-red-100');
        }, 1500);
    }

    // ========== ESC to close ==========
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeModalBeasiswa();
            closeDeleteModalRombel();
        }
    });
</script>
@endsection