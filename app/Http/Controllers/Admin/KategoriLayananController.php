<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;

class KategoriLayananController extends Controller
{
    public function index()
    {
        $kategoriLayanan = KategoriLayanan::latest()->paginate(10);
        return view('pages.admin.kategori-layanan.index', compact('kategoriLayanan'));
    }

    public function create()
    {
        return view('pages.admin.kategori-layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|max:255',
        ]);

        KategoriLayanan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori-layanan.index')->with('success', 'Kategori Layanan baru berhasil ditambahkan!');
    }

    public function edit(KategoriLayanan $kategoriLayanan)
    {
        return view('pages.admin.kategori-layanan.edit', compact('kategoriLayanan'));
    }

    public function update(Request $request, KategoriLayanan $kategoriLayanan)
    {
        $data = $request->validate([
            'nama'   => 'required|max:255',
        ]);

        $kategoriLayanan->update($data);

        return redirect()->route('admin.kategori-layanan.index')->with('success', 'Kategori Layanan berhasil diperbarui!');
    }

    public function destroy(KategoriLayanan $kategoriLayanan)
    {
        $kategoriLayanan->delete();

        return redirect()->route('admin.kategori-layanan.index')->with('success', 'Kategori Layanan berhasil dihapus!');
    }
}
