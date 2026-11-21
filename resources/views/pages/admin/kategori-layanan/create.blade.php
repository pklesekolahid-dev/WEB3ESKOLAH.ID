@extends('layouts.admin')

@section('title', 'Tambah Kategori Layanan Sekolah')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.kategori-layanan.index') }}"
        class="text-sm text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Kategori Layanan Sekolah
    </a>

    <h1 class="text-2xl font-bold text-gray-900 mt-2">Tambah Kategori Layanan Sekolah</h1>
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

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <form action="{{ route('admin.kategori-layanan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf

        <div class="space-y-6">

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition"
                    placeholder="Isi dengan nama kategori Layanan Sekolah">
            </div>

            {{-- Button --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-black shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    Simpan Kategori Layanan Sekolah
                </button>
            </div>

        </div>

    </form>
</div>

@endsection