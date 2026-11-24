<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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

        $gambarPath = $this->storeGambar($request->file('gambar'));

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

        $oldGambarPath = null;

        if ($request->hasFile('gambar')) {
            $newGambarPath = $this->storeGambar($request->file('gambar'));
            $oldGambarPath = $berita->gambar;
            $data['gambar'] = $newGambarPath;
        }

        // 3. Eksekusi Update
        $berita->update($data);
        $this->deleteGambar($oldGambarPath);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        $gambarPath = $berita->gambar;
        $berita->delete();
        $this->deleteGambar($gambarPath);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    private function storeGambar(UploadedFile $file): string
    {
        $directory = public_path('berita_folder');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = 'gambar_'.Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'berita_folder/'.$filename;
    }

    private function deleteGambar(?string $path): void
    {
        if (! $path) {
            return;
        }

        $filename = basename(str_replace('\\', '/', $path));
        $absolutePath = public_path('berita_folder/'.$filename);

        if (is_file($absolutePath)) {
            unlink($absolutePath);
        }
    }
}
