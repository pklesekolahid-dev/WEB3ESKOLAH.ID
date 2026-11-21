@extends('layouts.admin')

@section('title', 'Pengaturan Kontak & Alamat')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kontak & Alamat Sekolah</h1>
        <p class="text-gray-500 text-sm mt-1">Informasi ini akan ditampilkan di bagian Footer dan halaman Hubungi Kami.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <form action="{{ route('admin.profil-sekolah.update') }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Resmi</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $profil->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        placeholder="Contoh: admin@sekolahsukarejo.id">
                </div>

                <div>
                    <label for="telepon" class="block text-sm font-bold text-gray-700 mb-2">No. Telepon / WhatsApp</label>
                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $profil->telepon) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        placeholder="Contoh: 0812-3456-7890">
                </div>
            </div>

            <div class="mb-6">
                <label for="jam_pelayanan" class="block text-sm font-bold text-gray-700 mb-2">Jam Pelayanan Kantor</label>
                <textarea name="jam_pelayanan" id="jam_pelayanan" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                    placeholder="Senin - Kamis: 08.00 - 15.00&#10;Jumat: 08.00 - 11.00">{{ old('jam_pelayanan', $profil->jam_pelayanan) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Gunakan tombol Enter untuk memisahkan baris hari.</p>
            </div>

            <div class="mb-6">
                <label for="alamat" class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Sekolah</label>
                <textarea name="alamat" id="alamat" rows="2"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                    placeholder="Contoh: Jl. Raya Sukarejo No. 1, Kec. Sukarejo, Kab. Pasuruan, Jawa Timur">{{ old('alamat', $profil->alamat) }}</textarea>
            </div>

            <div class="mb-8">
                <label for="iframe_google_maps" class="block text-sm font-bold text-gray-700 mb-2">Link Embed Google Maps</label>
                <textarea name="iframe_google_maps" id="iframe_google_maps" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 font-mono text-sm"
                    placeholder='<iframe src="https://www.google.com/maps/embed?pb=..."></iframe>'>{{ old('iframe_google_maps', $profil->iframe_google_maps) }}</textarea>
                <p class="text-xs text-gray-500 mt-2">Buka Google Maps > Cari Lokasi > Klik Bagikan > Pilih tab "Sematkan Peta" > Salin HTML dan paste di kotak ini.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-lg shadow-green-600/30">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection