@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.layanan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-2 rounded-lg transition">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Layanan</h1>
            <p class="text-gray-500 text-sm mt-1">Perbarui informasi layanan sekolah.</p>
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
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 md:p-8 space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori Layanan <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori_layanan_id" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border bg-gray-50">
                            @foreach($kategoriLayanan as $data)
                            <option value="{{ $data->id }}"
                                {{ old('kategori_layanan_id', $layanan->kategori_layanan_id) == $data->id ? 'selected' : '' }}>
                                {{ $data->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Layanan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul"
                            value="{{ old('judul', $layanan->judul) }}"
                            required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi_singkat" rows="2"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">{{ old('deskripsi_singkat', $layanan->deskripsi_singkat) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Persyaratan / Berkas yang Dibutuhkan
                    </label>
                    <textarea name="persyaratan" rows="5"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">{{ old('persyaratan', $layanan->persyaratan) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-gray-100">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Biaya</label>
                        <input type="text" name="biaya"
                            value="{{ old('biaya', $layanan->biaya) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Estimasi Waktu</label>
                        <input type="text" name="durasi"
                            value="{{ old('durasi', $layanan->durasi) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kontak Petugas (WA)</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                +62
                            </span>
                            <input type="text" name="kontak_wa"
                                value="{{ old('kontak_wa', $layanan->kontak_wa) }}"
                                class="w-full border-gray-300 rounded-r-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 p-2.5 border">
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-gray-50 p-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.layanan.index') }}"
                    class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-bold shadow-md flex items-center gap-2">
                    <i class="fas fa-save"></i> Update Layanan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection