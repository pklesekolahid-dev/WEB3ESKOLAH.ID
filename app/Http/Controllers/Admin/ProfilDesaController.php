<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function index()
    {
        // Ambil data pertama. Kalau tabel masih kosong, buat object baru sementara
        $profil = ProfilDesa::first() ?? new ProfilDesa();
        return view('pages.admin.profil-desa.index', compact('profil'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'alamat' => 'nullable|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:50',
            'jam_pelayanan' => 'nullable|string',
            'iframe_google_maps' => 'nullable|string',
        ]);

        // Ambil data pertama, atau buat data baru jika belum ada sama sekali
        $profil = ProfilDesa::first() ?? new ProfilDesa();

        // Update hanya kolom yang kita perlukan saat ini
        $profil->alamat = $request->alamat;
        $profil->email = $request->email;
        $profil->telepon = $request->telepon;
        $profil->jam_pelayanan = $request->jam_pelayanan;
        $profil->iframe_google_maps = $request->iframe_google_maps;
        
        $profil->save();

        return redirect()->back()->with('success', 'Informasi Kontak & Alamat berhasil diperbarui!');
    }
}