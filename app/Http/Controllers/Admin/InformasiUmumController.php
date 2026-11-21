<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiUmum;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class InformasiUmumController extends Controller
{
    public function index()
    {
        $informasi = InformasiUmum::first();
        $keunggulans = Keunggulan::latest()->get();

        if (!$informasi) {
            $informasi = InformasiUmum::create([
                'nama_sekolah' => 'Sekolah Dummy',
                'kecamatan' => '-',
                'kabupaten' => '-',
                'kode_pos' => '-',
                'kontak_wa' => '-',
                'kontak_email' => '-',
                'slogan' => '-',
                'nama_fasilitas_1' => '-',
                'nama_fasilitas_2' => '-',
                'nama_fasilitas_3' => '-',
                'nama_fasilitas_4' => '-'
            ]);
        }

        return view('pages.admin.informasi-umum.index', compact('informasi', 'keunggulans'));
    }

    public function update(Request $request)
    {
        $informasi = InformasiUmum::first();

        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kode_pos'  => 'required|string|max:10',
            'slogan'    => 'required|string',
            'nama_fasilitas_1' => 'required|string|max:255',
            'nama_fasilitas_2' => 'required|string|max:255',
            'nama_fasilitas_3' => 'required|string|max:255',
            'nama_fasilitas_4' => 'required|string|max:255',
            'jumlah_sekolah' => 'required|integer|min:0',
            'jumlah_ibadah' => 'required|integer|min:0',
            'jumlah_puskesmas' => 'required|integer|min:0',
            'jumlah_balai' => 'required|integer|min:0',
            'kontak_wa' => 'required|string|max:20',
            'kontak_email' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto_identitas' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto_fasilitas' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($informasi->logo) {
                unlink($informasi->logo);
            }

            $file = $request->file('logo');
            $logoPath = 'informasi_umum_folder/logo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('informasi_umum_folder', $logoPath);

            $validated['logo'] = $logoPath;
        }

        if ($request->hasFile('foto_identitas')) {
            if ($informasi->foto_identitas) {
                unlink($informasi->foto_identitas);
            }

            $file = $request->file('foto_identitas');
            $fotoIdentitasPath = 'informasi_umum_folder/foto_identitas_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('informasi_umum_folder', $fotoIdentitasPath);

            $validated['foto_identitas'] = $fotoIdentitasPath;
        }

        if ($request->hasFile('foto_fasilitas')) {
            if ($informasi->foto_fasilitas) {
                unlink($informasi->foto_fasilitas);
            }

            $file = $request->file('foto_fasilitas');
            $fotoFasilitasPath = 'informasi_umum_folder/foto_fasilitas_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('informasi_umum_folder', $fotoFasilitasPath);

            $validated['foto_fasilitas'] = $fotoFasilitasPath;
        }

        $informasi->update($validated);

        return redirect()->route('admin.informasi-umum.index')->with('success', 'Data Informasi Umum berhasil diperbarui!');
    }
}
