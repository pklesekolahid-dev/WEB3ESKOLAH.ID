@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.berita.index') }}" class="text-sm text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Berita
    </a>
    <h1 class="text-2xl font-bold text-gray-900 mt-2">Buat Berita Baru</h1>
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
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition"
                        placeholder="Masukkan judul berita yang menarik...">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Isi Konten</label>
                    <input type="hidden" name="konten" id="konten">
                    <div id="editor" style="height: 300px;" class="bg-gray-50 rounded-xl"></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                        <select name="kategori_berita_id" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none focus:border-emerald-500 transition">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategoriBerita as $data)
                            <option value="{{$data->id}}" {{ old('kategori_berita_id') == $data->id ? 'selected' : '' }}>{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Sampul</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-emerald-400 transition cursor-pointer bg-white"
                            onclick="document.getElementById('gambar').click()">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <span class="relative font-medium text-emerald-600 hover:text-emerald-500">Upload file</span>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                        <input id="gambar" name="gambar" type="file" class="hidden" required onchange="previewImage(this)">

                        <img id="img-preview" class="mt-4 rounded-xl hidden w-full h-40 object-cover border">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-black shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    Terbitkan Berita
                </button>
            </div>
        </div>
    </form>
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Init Quill Editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis isi berita di sini...'
    });

    // Update hidden input saat mengetik
    quill.on('text-change', function() {
        document.getElementById('konten').value = quill.root.innerHTML;
    });

    // Preview Gambar
    function previewImage(input) {
        const preview = document.getElementById('img-preview');
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