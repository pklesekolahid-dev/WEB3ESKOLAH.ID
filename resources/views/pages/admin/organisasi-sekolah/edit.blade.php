@extends('layouts.admin')

@section('title', 'Edit Organisasi Sekolah')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Pejabat</h2>
        <a href="{{ route('admin.organisasi-sekolah.index') }}" class="text-gray-500 hover:text-gray-700">Kembali</a>
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

    <form action="{{ route('admin.organisasi-sekolah.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-6 text-center">
            <div class="relative w-32 h-32 mx-auto mb-3">
                <img id="preview" class="w-full h-full rounded-full object-cover border-4 border-gray-100"
                    src="{{ $item->foto ? asset($item->foto) : 'https://via.placeholder.com/150' }}" alt="Preview">
                <div class="absolute bottom-0 right-0 bg-green-600 p-2 rounded-full text-white cursor-pointer hover:bg-green-700">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <input type="file" name="foto" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
                </div>
            </div>
            <p class="text-xs text-gray-500">Klik ikon kamera untuk ganti foto.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap & Gelar</label>
                <input type="text" name="nama" value="{{ $item->nama }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                <input type="text" name="jabatan" value="{{ $item->jabatan }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIP / NIAP</label>
                <input type="text" name="nip" value="{{ $item->nip }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kelompok Jabatan <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="tipe" required class="block w-full pl-4 pr-10 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white appearance-none text-gray-700">
                        <option value="Staf Inti" {{ $item->tipe == 'Staf Inti' ? 'selected' : ''}}>Staf Inti</option>
                        <option value="Guru/Walikelas" {{ $item->tipe == 'Guru/Walikelas' ? 'selected' : '' }}>Guru/Walikelas</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2 mt-2">
                    <span class="text-xs bg-purple-50 text-purple-600 px-2 py-0.5 rounded border border-purple-100">Staf Inti</span>
                    <span class="text-xs bg-orange-50 text-orange-600 px-2 py-0.5 rounded border border-orange-100">Guru/Walikelas</span>
                </div>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ $item->urutan }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400">
            </div>
        </div>

        <button type="submit" class="mt-6 w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition">
            Update Data
        </button>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection