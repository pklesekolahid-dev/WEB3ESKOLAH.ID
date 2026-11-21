@extends('layouts.admin')

@section('title', 'Kelola Profil Kepala Sekolah')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Profil Kepala Sekolah</h2>
            <p class="text-sm text-gray-500">Kelola data lengkap Kepala Sekolah yang tampil di website utama.</p>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
    </div>

    <form action="{{ route('admin.kepsek.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <label class="block text-sm font-bold text-gray-700 mb-4">Foto Resmi</label>

                    <div class="relative w-48 h-60 mx-auto mb-4 overflow-hidden rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 group hover:border-green-500 transition-colors">
                        <img id="preview" class="w-full h-full object-cover"
                            src="{{ isset($kepsek) && $kepsek->foto ? asset($kepsek->foto) : 'https://via.placeholder.com/300x400?text=Foto+Kepsek' }}"
                            alt="Foto Kepsek">

                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <span class="text-white text-sm font-bold">Ganti Foto</span>
                            <input type="file" name="foto" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Format: JPG/PNG, Rasio Portrait (3:4)</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-4">
                    <h3 class="font-bold text-gray-800 border-b pb-2">Biodata Singkat</h3>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" value="{{ old('nama', $kepsek->nama ?? '') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition text-sm" placeholder="Nama Lengkap">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">NIP (Opsional)</label>
                        <input type="text" name="nip" value="{{ old('nip', $kepsek->nip ?? '') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition text-sm" placeholder="NIP">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $kepsek->tempat_lahir ?? '') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tgl Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($kepsek->tanggal_lahir ?? null)->format('Y-m-d')) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Rumah</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition text-sm">{{ old('alamat', $kepsek->alamat ?? '') }}</textarea>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        Visi & Misi / Sambutan
                    </h3>
                    <textarea name="visi_misi" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition" placeholder="Tuliskan Visi Misi atau Kata Sambutan Kepala Sekolah di sini...">{{ old('visi_misi', $kepsek->visi_misi ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-2">* Gunakan Enter untuk membuat paragraf baru.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        Riwayat Pendidikan
                    </h3>
                    <textarea name="pendidikan" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition" placeholder="Contoh:
SDN 1 Sukarejo (1990 - 1996)
SMPN 1 Kota (1996 - 1999)
SMAN 1 Kota (1999 - 2002)
S1 Hukum Univ. Sumatera Utara (2002 - 2006)">{{ old('pendidikan', $kepsek->pendidikan ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-2">* Tulis satu riwayat per baris.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Riwayat Organisasi / Pekerjaan
                    </h3>
                    <textarea name="organisasi" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition" placeholder="Contoh:
Ketua Karang Taruna (2010 - 2015)
Sekretaris Sekolah (2015 - 2020)">{{ old('organisasi', $kepsek->organisasi ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-2">* Tulis satu riwayat per baris.</p>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-4 rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-600/30">
                    Simpan Perubahan Profil
                </button>

            </div>
        </div>
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