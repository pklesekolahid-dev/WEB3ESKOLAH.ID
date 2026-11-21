@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.galleries.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white p-2 rounded-full transition shadow-sm">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Slot Galeri {{ $gallery->position }}</h1>
            <p class="text-gray-500 text-sm mt-1">Perbarui foto dan teks untuk slot ini.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2 text-blue-600 uppercase tracking-wider">Foto Saat Ini</label>
                @if($gallery->image)
                <div class="relative group">
                    <img src="{{ asset($gallery->image) }}" class="w-full h-64 object-cover rounded-lg border-2 border-gray-100 shadow-sm">
                    <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition-all rounded-lg"></div>
                </div>
                @else
                <div class="w-full h-64 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400">
                    <i class="fas fa-image text-4xl mb-2"></i>
                    <p class="font-medium text-sm">Belum ada foto yang diunggah</p>
                </div>
                @endif
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                <div class="relative">
                    <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-1">
                </div>
                <p class="text-[11px] text-gray-500 mt-2 italic leading-relaxed">
                    * Format: JPG, PNG, WEBP. Maks 2MB. Gunakan foto landscape untuk hasil accordion terbaik.
                </p>
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Judul Singkat <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition p-2.5 border">
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mb-8">
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition p-2.5 border">{{ old('description', $gallery->description) }}</textarea>
                <p class="text-[11px] text-gray-400 mt-1 italic font-medium uppercase tracking-tighter">Muncul saat foto dilebarkan</p>
                @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.galleries.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold text-sm">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md shadow-blue-200 transition font-semibold text-sm flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection