@extends('layouts.admin')

@section('title', 'Tambah Organisasi Sekolah')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.organisasi-sekolah.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Tambah Pejabat Baru</h2>
    <p class="text-sm text-gray-500 mb-8">Lengkapi data di bawah ini.</p>

    <form action="{{ route('admin.organisasi-sekolah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col items-center mb-8" x-data="{ photoName: null, photoPreview: null }">
            <div class="relative w-32 h-32 mb-4 group">
                <div class="w-full h-full rounded-full overflow-hidden bg-gray-50 border-2 border-dashed border-gray-300 flex items-center justify-center relative"
                    x-show="!photoPreview">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <img x-show="photoPreview" :src="photoPreview" class="w-full h-full rounded-full object-cover shadow-sm ring-4 ring-white" style="display: none;">

                <input type="file" name="foto" id="foto" class="hidden"
                    x-ref="photo"
                    accept="image/*"
                    x-on:change="
                            const file = $refs.photo.files[0];
                            if (file) {
                                photoName = file.name;
                                const reader = new FileReader();
                                reader.onload = (e) => { photoPreview = e.target.result; };
                                reader.readAsDataURL(file);
                            }
                       ">

                <button type="button" @click="$refs.photo.click()"
                    class="absolute bottom-1 right-1 bg-green-600 text-white p-2.5 rounded-full hover:bg-green-700 transition shadow-lg ring-2 ring-white transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
            <p class="text-xs text-gray-400">Format: JPG/PNG, Max 2MB</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400"
                    placeholder="Contoh: H. Ahmad Subari, S.Sos">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" name="jabatan" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400"
                    placeholder="Ketik jabatan...">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">NIP / NIAP (Opsional)</label>
                <input type="text" name="nip"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white placeholder-gray-400"
                    placeholder="1980xxxx...">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kelompok Jabatan <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="tipe" required class="block w-full pl-4 pr-10 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white appearance-none text-gray-700">
                        <option value="" disabled selected>-- Pilih Kelompok --</option>
                        <option value="Staf Inti">Staf Inti</option>
                        <option value="Guru/Walikelas">Guru/Walikelas</option>
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

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Tampil</label>
                <input type="number" name="urutan" value="99"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition bg-gray-50 focus:bg-white">
                <p class="text-xs text-gray-500 mt-1">Angka lebih kecil (1, 2, 3) akan tampil lebih dulu/kiri.</p>
            </div>

        </div>

        <div class="mt-8 pt-6 border-t border-gray-100">
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3.5 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-600/20 active:scale-[0.98] flex justify-center items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Data
            </button>
        </div>

    </form>
</div>
@endsection