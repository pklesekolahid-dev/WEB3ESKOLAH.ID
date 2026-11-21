@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.faq.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Tanya Jawab (FAQ)</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
        <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="urutan" class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $faq->urutan) }}" 
                       class="w-full sm:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                <p class="text-xs text-gray-500 mt-1">Angka terkecil akan tampil paling atas.</p>
                @error('urutan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="pertanyaan" class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan</label>
                <input type="text" name="pertanyaan" id="pertanyaan" value="{{ old('pertanyaan', $faq->pertanyaan) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                @error('pertanyaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-8">
                <label for="jawaban" class="block text-sm font-bold text-gray-700 mb-2">Jawaban</label>
                <textarea name="jawaban" id="jawaban" rows="5" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('jawaban', $faq->jawaban) }}</textarea>
                @error('jawaban') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.faq.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Update FAQ</button>
            </div>
        </form>
    </div>
</div>
@endsection