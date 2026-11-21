<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // 1. Tampilkan Daftar Produk
    public function index()
    {
        // Urutkan: Pending paling atas, baru Disetujui, lalu Ditolak
        $produks = Produk::with('kategori')->orderByRaw("FIELD(status, 'pending', 'disetujui', 'ditolak')")
            ->latest()
            ->paginate(10);

        return view('pages.admin.produk.index', compact('produks'));
    }

    // 2. Halaman Tambah
    public function create()
    {
        $kategoriProduk = KategoriProduk::latest()->get();
        return view('pages.admin.produk.create', compact('kategoriProduk'));
    }

    // 3. Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha'         => 'required|max:255',
            'pemilik'            => 'required',
            'no_wa'              => 'required|numeric',
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
            'foto'               => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
            'deskripsi'          => 'required',
        ]);

        $data = $request->all();

        // Upload Foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoPath = 'produk_folder/foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('produk_folder', $fotoPath);

            $data['foto'] = $fotoPath;
        }

        // Auto Format WA (08 -> 628)
        if (substr($data['no_wa'], 0, 1) == '0') {
            $data['no_wa'] = '62' . substr($data['no_wa'], 1);
        }

        // Default Status jika Admin yang input -> Langsung Disetujui
        $data['status'] = 'disetujui';

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 4. Halaman Edit
    public function edit($id)
    {
        // Menggunakan variabel $produk agar sesuai dengan View edit.blade.php
        $produk = Produk::findOrFail($id);
        $kategoriProduk = KategoriProduk::latest()->get();

        return view('pages.admin.produk.edit', compact('produk', 'kategoriProduk'));
    }

    // 5. Update Data (Perbaikan Utama Disini)
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // VALIDASI ITU WAJIB (Biar upload foto gak mental)
        $request->validate([
            'nama_usaha'         => 'required|max:255',
            'pemilik'            => 'required',
            'no_wa'              => 'required|numeric',
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
            'foto'               => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB & Nullable
            'deskripsi'          => 'required',
            'status'             => 'required' // Admin bisa ubah status
        ]);

        $data = $request->all();

        // Logika Ganti Foto
        $produkPath = $produk->foto ?? null;

        if ($request->hasFile('foto')) {
            if ($produk && $produk->foto) {
                unlink($produk->foto);
            }

            $file = $request->file('foto');
            $produkPath = 'produk_folder/foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('produk_folder', $produkPath);

            $data['foto'] = $produkPath;
        }

        // Format WA Ulang (Jaga-jaga kalau admin edit nomornya jadi 08 lagi)
        if (isset($data['no_wa']) && substr($data['no_wa'], 0, 1) == '0') {
            $data['no_wa'] = '62' . substr($data['no_wa'], 1);
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Data Produk berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus fotonya dulu dari folder
        if ($produk && $produk->foto) {
            unlink($produk->foto);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
