<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoriProduk = KategoriProduk::latest()->paginate(10);
        return view('pages.admin.kategori-produk.index', compact('kategoriProduk'));
    }

    public function create()
    {
        return view('pages.admin.kategori-produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|max:255',
        ]);

        KategoriProduk::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori-produk.index')->with('success', 'Kategori Produk baru berhasil ditambahkan!');
    }

    public function edit(KategoriProduk $kategoriProduk)
    {
        return view('pages.admin.kategori-produk.edit', compact('kategoriProduk'));
    }

    public function update(Request $request, KategoriProduk $kategoriProduk)
    {
        $data = $request->validate([
            'nama'   => 'required|max:255',
        ]);

        $kategoriProduk->update($data);

        return redirect()->route('admin.kategori-produk.index')->with('success', 'Kategori Produk berhasil diperbarui!');
    }

    public function destroy(KategoriProduk $kategoriProduk)
    {
        $kategoriProduk->delete();

        return redirect()->route('admin.kategori-produk.index')->with('success', 'Kategori Produk berhasil dihapus!');
    }
}
