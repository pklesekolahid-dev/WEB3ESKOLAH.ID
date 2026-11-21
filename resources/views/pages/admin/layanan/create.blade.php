@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.layanan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-2 rounded-lg transition">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Layanan Baru</h1>
            <p class="text-gray-500 text-sm mt-1">Lengkapi form di bawah ini untuk menambahkan layanan sekolah.</p>
        </div>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
        <ul class="text-sm text-red-600 list-disc ml-4">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.layanan.store') }}" method="POST">
            @csrf

            <div class="p-6 md:p-8 space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Kategori Layanan <span class="text-red-500">*</span></label>
                        <select name="kategori_layanan_id" id="kategori" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border bg-gray-50">
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            @foreach($kategoriLayanan as $data)
                            <option value="{{ $data->id }}" {{ old('kategori') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Layanan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Tuliskan judul layanan..."
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        @error('judul') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="deskripsi_singkat" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="2" required placeholder="Tuliskan penjelasan singkat mengenai layanan ini..."
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">{{ old('deskripsi_singkat') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">*Maksimal 2-3 kalimat. Akan ditampilkan di halaman depan (kartu layanan).</p>
                    @error('deskripsi_singkat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="persyaratan" class="block text-sm font-semibold text-gray-700 mb-2">Persyaratan / Berkas yang Dibutuhkan <span class="text-red-500">*</span></label>
                    <textarea name="persyaratan" id="persyaratan" rows="5" required placeholder="1. Fotokopi KK&#10;2. Pengantar RT/RW&#10;3. Pas Foto 3x4"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border leading-relaxed">{{ old('persyaratan') }}</textarea>
                    <div class="bg-blue-50 text-blue-700 p-3 rounded-lg mt-2 text-xs font-medium flex items-start gap-2 border border-blue-100">
                        <i class="fas fa-info-circle mt-0.5"></i>
                        <p><strong>Tips:</strong> Pisahkan setiap poin persyaratan dengan <strong>Enter (baris baru)</strong>. Sistem otomatis akan merapikannya menjadi daftar berpoin (list) di halaman siswa.</p>
                    </div>
                    @error('persyaratan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-gray-100">
                    <div>
                        <label for="biaya" class="block text-sm font-semibold text-gray-700 mb-2">Biaya Layanan</label>
                        <input type="text" name="biaya" id="biaya" value="{{ old('biaya', 'Gratis') }}" placeholder="Contoh: Gratis / Rp 50.000"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        @error('biaya') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="durasi" class="block text-sm font-semibold text-gray-700 mb-2">Estimasi Waktu</label>
                        <input type="text" name="durasi" id="durasi" value="{{ old('durasi') }}" placeholder="Contoh: 1-3 Hari Kerja"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        @error('durasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="kontak_wa" class="block text-sm font-semibold text-gray-700 mb-2">Kontak Petugas (WA)</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                +62
                            </span>
                            <input type="text" name="kontak_wa" id="kontak_wa" value="{{ old('kontak_wa') }}" placeholder="81234567890"
                                class="w-full border-gray-300 rounded-r-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        </div>
                        <p class="text-[11px] text-gray-500 mt-1">*Awali langsung dengan angka 8.</p>
                        @error('kontak_wa') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="bg-gray-50 p-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.layanan.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold shadow-md flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Layanan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection