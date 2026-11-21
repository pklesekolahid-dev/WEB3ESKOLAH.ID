@extends('layouts.admin')

@section('title', 'Tambah Banner')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.banner.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Upload Foto Banner Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
            @csrf

            <div class="mb-6">
                <label for="gambar" class="block text-sm font-bold text-gray-700 mb-2">Pilih Foto <span class="text-red-500">*</span></label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, WEBP. Maksimal ukuran file: 2MB. Disarankan foto landscape (lebar) dengan resolusi tinggi.</p>
                @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-8 flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                       class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                <label for="is_active" class="ml-3 text-sm font-bold text-gray-700">Langsung Tampilkan Banner Ini</label>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.banner.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">Upload Foto</button>
            </div>
        </form>
    </div>
</div>
@endsection