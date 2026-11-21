@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.pengumuman.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Teks Pengumuman</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

            <div class="mb-6">
                <label for="teks" class="block text-sm font-bold text-gray-700 mb-2">Isi Pengumuman</label>
                <input type="text" name="teks" id="teks" value="{{ old('teks') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                       placeholder="Contoh: Jadwal Posyandu bulan ini dilaksanakan pada tanggal 15...">
                <p class="text-xs text-gray-500 mt-1">Usahakan kalimatnya padat dan jelas. Maksimal 255 karakter.</p>
                @error('teks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-8 flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                       class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                <label for="is_active" class="ml-3 text-sm font-bold text-gray-700">Tampilkan Pengumuman Ini (Aktif)</label>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.pengumuman.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">Simpan Pengumuman</button>
            </div>
        </form>
    </div>
</div>
@endsection