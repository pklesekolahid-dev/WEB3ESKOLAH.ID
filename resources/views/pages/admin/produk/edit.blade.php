@extends('layouts.admin')

@section('title', 'Edit Data Produk')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Data Produk</h1>
            <p class="text-sm text-gray-500">Perbarui informasi produk murid.</p>
        </div>
        <a href="{{ route('admin.produk.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 border border-red-100">
        <ul class="list-disc list-inside text-sm font-medium">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Informasi Usaha</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Usaha / Produk</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $produk->nama_usaha) }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition"
                            placeholder="Contoh: Keripik Pisang Bu Ani" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                            <select name="kategori_produk_id" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none focus:border-emerald-500 transition">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($kategoriProduk as $data)
                                <option value="{{ $data->id }}"
                                    {{ old('kategori_produk_id', $produk->kategori_produk_id) == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700 tracking-wide">
                                Harga Mulai
                                <span class="ml-1.5 text-xs font-normal text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>

                            <div class="relative group">
                                {{-- Prefix Rp --}}
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-10">
                                    <span class="inline-flex items-center bg-emerald-50 border-r border-emerald-200 text-emerald-700 text-sm font-bold px-3.5 h-full rounded-l-xl">
                                        Rp
                                    </span>
                                </div>

                                {{-- Input --}}
                                <input
                                    type="number"
                                    name="harga_mulai"
                                    value="{{ old('harga_mulai', $produk->harga_mulai) }}"
                                    min="0"
                                    class="w-full pl-[4.5rem] pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                   text-gray-900 placeholder-gray-400 text-sm
                   focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white
                   group-hover:border-gray-300
                   outline-none transition-all duration-200
                   @error('harga_mulai') border-red-400 bg-red-50 focus:ring-red-500/10 focus:border-red-400 @enderror"
                                    placeholder="15.000">
                            </div>

                            {{-- Helper text --}}
                            <p class="flex items-center gap-1 text-xs text-gray-400">
                                <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Kosongkan jika harga belum ditentukan.
                            </p>

                            {{-- Error --}}
                            @error('harga_mulai')
                            <p class="flex items-center gap-1 text-xs text-red-500 font-medium mt-0.5">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0118 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" rows="6"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition"
                            placeholder="Jelaskan keunggulan produk..." required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Status Publikasi</h3>
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Verifikasi</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition">
                            <option value="disetujui" {{ old('status', $produk->status) == 'disetujui' ? 'selected' : '' }}> Disetujui (Tampil)</option>
                            <option value="pending" {{ old('status', $produk->status) == 'pending' ? 'selected' : '' }}> Pending (Sembunyikan)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Ubah ke "Disetujui" agar tampil di halaman depan.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Kontak Pemilik</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', $produk->pemilik) }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition" required>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700 tracking-wide">
                            Nomor WhatsApp
                        </label>

                        <div class="relative group">
                            {{-- Prefix Badge --}}
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-10">
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-lg">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.556 4.112 1.528 5.837L.057 23.535a.5.5 0 00.608.608l5.7-1.471A11.943 11.943 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.952 9.952 0 01-5.07-1.382l-.363-.215-3.762.97.999-3.653-.236-.377A9.953 9.953 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                                    </svg>
                                    +62
                                </span>
                            </div>

                            {{-- Input --}}
                            <input
                                type="tel"
                                name="no_wa"
                                value="{{ old('no_wa', $produk->no_wa) }}"
                                inputmode="numeric"
                                pattern="[0-9]*"
                                class="w-full pl-[5.5rem] pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl
                   text-gray-900 placeholder-gray-400 text-sm
                   focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white
                   group-hover:border-gray-300
                   outline-none transition-all duration-200
                   @error('no_wa') border-red-400 bg-red-50 focus:ring-red-500/10 focus:border-red-400 @enderror"
                                placeholder="8123456789"
                                required>

                            {{-- Valid checkmark (optional, shown when filled) --}}
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 transition-opacity" id="wa-check">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- Helper text --}}
                        <p class="flex items-center gap-1 text-xs text-gray-400">
                            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Masukkan tanpa awalan 0 atau +62. Otomatis diformat ke 628xx.
                        </p>

                        {{-- Error --}}
                        @error('no_wa')
                        <p class="flex items-center gap-1 text-xs text-red-500 font-medium mt-0.5">
                            <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Foto Produk</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Gambar (Opsional)</label>

                        <div class="w-full h-48 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex flex-col items-center justify-center mb-3 overflow-hidden relative group hover:border-green-400 transition">

                            <img id="preview"
                                src="{{ $produk->foto ? asset($produk->foto) : '' }}"
                                class="{{ $produk->foto ? '' : 'hidden' }} w-full h-full object-cover absolute inset-0 z-10">

                            <div id="placeholder" class="{{ $produk->foto ? 'hidden' : '' }} text-center z-0">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-500">Klik untuk ganti foto</p>
                            </div>

                            <input type="file" name="foto" id="foto" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage()">
                        </div>
                        <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto.</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-600/30 flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Update Data produk
                </button>

            </div>
        </div>
    </form>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#foto');
        const imgPreview = document.querySelector('#preview');
        const placeholder = document.querySelector('#placeholder');

        if (image.files && image.files[0]) {
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                imgPreview.classList.remove('hidden'); // Munculkan gambar
                if (placeholder) placeholder.classList.add('hidden'); // Sembunyikan icon
            }
        }
    }
</script>

@endsection