<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // 1. Tampilkan Daftar Berita
    public function index()
    {
        // Ambil data terbaru, paginasi 10 per halaman
        $berita = Berita::with('kategori')->latest()->paginate(10);
        return view('pages.admin.berita.index', compact('berita'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        $kategoriBerita = KategoriBerita::latest()->get();
        return view('pages.admin.berita.create', compact('kategoriBerita'));
    }

    // 3. Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Upload Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarPath = 'berita_folder/gambar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('berita_folder', $gambarPath);
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul), // Judul: Halo Dunia -> Slug: halo-dunia
            'konten' => $request->konten,
            'kategori_berita_id' => $request->kategori_berita_id,
            'penulis' => auth()->user()->name,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        // 1. Cari data berita berdasarkan ID
        $berita = Berita::findOrFail($id);
        $kategoriBerita = KategoriBerita::latest()->get();

        // 2. Kirim variabel $berita ke view edit
        return view('pages.admin.berita.edit', compact('berita', 'kategoriBerita'));
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Gunakan $request->only atau definisikan array
        $data = [
            'judul' => $request->judul,
            'slug' => \Illuminate\Support\Str::slug($request->judul), // Pakai inline namespace biar anti-error
            'konten' => $request->konten,
            'kategori_berita_id' => $request->kategori_berita_id,
        ];

        // Jika ada upload gambar baru
        $beritaPath = $berita->gambar ?? null;

        if ($request->hasFile('gambar')) {
            if ($berita && $berita->gambar) {
                // Hapus gambar lama
                unlink($berita->gambar);
            }

            $file = $request->file('gambar');
            $beritaPath = 'berita_folder/gambar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('berita_folder', $beritaPath);

            $data['gambar'] = $beritaPath;
        }

        // 3. Eksekusi Update
        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file gambar dari penyimpanan
        if ($berita && $berita->gambar) {
            unlink($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
