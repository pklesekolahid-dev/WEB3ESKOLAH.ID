<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::with('kategori')->latest()->get();
        return view('pages.admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        $kategoriLayanan = KategoriLayanan::latest()->get();
        return view('pages.admin.layanan.create', compact('kategoriLayanan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_layanan_id' => 'required|exists:kategori_layanans,id',
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'persyaratan' => 'required|string',
            'biaya' => 'nullable|string|max:255',
            'durasi' => 'nullable|string|max:255',
            'kontak_wa' => 'nullable|string|max:255',
        ]);

        // Beri nilai default jika kosong
        $data['biaya'] = $request->biaya ?? 'Gratis';

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    public function edit(Layanan $layanan)
    {
        $kategoriLayanan = KategoriLayanan::latest()->get();
        return view('pages.admin.layanan.edit', compact('layanan', 'kategoriLayanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $data = $request->validate([
            'kategori_layanan_id' => 'required|exists:kategori_layanans,id',
            'judul' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'persyaratan' => 'required|string',
            'biaya' => 'nullable|string|max:255',
            'durasi' => 'nullable|string|max:255',
            'kontak_wa' => 'nullable|string|max:255',
        ]);

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Data Layanan berhasil diperbarui!');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
