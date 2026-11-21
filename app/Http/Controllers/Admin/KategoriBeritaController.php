<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $kategoriBerita = KategoriBerita::latest()->paginate(10);
        return view('pages.admin.kategori-berita.index', compact('kategoriBerita'));
    }

    public function create()
    {
        return view('pages.admin.kategori-berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|max:255',
        ]);

        KategoriBerita::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori-berita.index')->with('success', 'Kategori Produk baru berhasil ditambahkan!');
    }

    public function edit(KategoriBerita $kategoriBerita)
    {
        return view('pages.admin.kategori-berita.edit', compact('kategoriBerita'));
    }

    public function update(Request $request, KategoriBerita $kategoriBerita)
    {
        $data = $request->validate([
            'nama'   => 'required|max:255',
        ]);

        $kategoriBerita->update($data);

        return redirect()->route('admin.kategori-berita.index')->with('success', 'Kategori Produk berhasil diperbarui!');
    }

    public function destroy(KategoriBerita $kategoriBerita)
    {
        $kategoriBerita->delete();

        return redirect()->route('admin.kategori-berita.index')->with('success', 'Kategori Produk berhasil dihapus!');
    }
}
