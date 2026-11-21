<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first() ?? new VisiMisi();

        return view('pages.admin.visi-misi.index', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi'                    => 'required|string',
            'visi_subtitle'           => 'nullable|string',
            'misi'                    => 'required|array|min:1',
            'misi.*.judul'            => 'required|string',
            'misi.*.deskripsi'        => 'required|string',
            'misi.*.warna'            => 'required|string',
            'nilai'                   => 'required|array|min:1',
            'nilai.*.judul'           => 'required|string',
            'nilai.*.deskripsi'       => 'required|string',
            'header_subtitle'         => 'nullable|string',
        ]);

        VisiMisi::updateOrCreate(['id' => 1], [
            'visi'           => $request->visi,
            'visi_subtitle'  => $request->visi_subtitle,
            'header_subtitle' => $request->header_subtitle,
            'misi'           => json_encode($request->misi),
            'nilai'          => json_encode($request->nilai),
        ]);

        return back()->with('success', 'Konten Visi & Misi berhasil diperbarui!');
    }
}
