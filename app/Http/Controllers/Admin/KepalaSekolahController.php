<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use Illuminate\Http\Request;

class KepalaSekolahController extends Controller
{
    public function index()
    {
        // Ambil data pertama (karena cuma ada 1 kepsek aktif)
        $kepsek = KepalaSekolah::first();
        return view('pages.admin.kepala-sekolah.index', compact('kepsek'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Cek data lama atau buat baru
        $kepsek = KepalaSekolah::first();
        if (!$kepsek) {
            $kepsek = new KepalaSekolah();
        }

        // Simpan data text
        $kepsek->nama = $request->nama;
        $kepsek->nip = $request->nip;
        $kepsek->tempat_lahir = $request->tempat_lahir;
        $kepsek->tanggal_lahir = $request->tanggal_lahir;
        $kepsek->alamat = $request->alamat;
        $kepsek->pendidikan = $request->pendidikan;
        $kepsek->organisasi = $request->organisasi;
        $kepsek->visi_misi = $request->visi_misi;

        // Handle Upload Foto
        if ($request->hasFile('foto')) {
            if ($kepsek && $kepsek->foto) {
                unlink($kepsek->foto);
            }

            $file = $request->file('foto');
            $kepsekPath = 'kepsek_folder/foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('kepsek_folder', $kepsekPath);

            $kepsek->foto = $kepsekPath;
        }

        $kepsek->save();

        return redirect()->back()->with('success', 'Profil Kepala Sekolah berhasil diperbarui!');
    }
}
