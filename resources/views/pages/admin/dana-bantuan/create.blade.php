@extends('layouts.admin')

@section('title', 'Tambah Dana BOS')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.dana-bantuan.index') }}"
        class="text-sm text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Dana BOS
    </a>

    <h1 class="text-2xl font-bold text-gray-900 mt-2">Tambah Dana BOS</h1>
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
    <form action="{{ route('admin.dana-bantuan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf

        <div class="space-y-6">

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul</label>
                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition"
                    placeholder="Contoh: Dana BOS Tahap 1 2026">
            </div>

            {{-- URL --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Link Informasi</label>
                <input
                    type="url"
                    name="url"
                    value="{{ old('url') }}"
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition"
                    placeholder="https://example.com">
            </div>

            {{-- Upload gambar --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Gambar</label>

                <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-6 cursor-pointer hover:border-emerald-500 transition"
                    onclick="document.getElementById('gambar').click()">

                    <div class="text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0l-4 4m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                        <p class="text-sm text-gray-600 mt-2">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-400">PNG / JPEG / JPG / GIF (max 2MB)</p>
                    </div>

                </div>

                <input
                    id="gambar"
                    type="file"
                    name="gambar"
                    class="hidden"
                    accept="image/*"
                    onchange="previewgambar(this)"
                    required>

                <img id="gambar-preview" class="mt-4 h-16 hidden">
            </div>

            {{-- Button --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-black shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    Simpan Dana Bantuan
                </button>
            </div>

        </div>

    </form>
</div>

<script>
    function previewgambar(input) {
        const preview = document.getElementById('gambar-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection