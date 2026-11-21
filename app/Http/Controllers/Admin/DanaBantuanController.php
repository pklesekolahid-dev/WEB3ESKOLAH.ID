<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanaBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DanaBantuanController extends Controller
{
    public function index()
    {
        $danaBantuan = DanaBantuan::latest()->paginate(10);
        return view('pages.admin.dana-bantuan.index', compact('danaBantuan'));
    }

    public function create()
    {
        return view('pages.admin.dana-bantuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:255',
            'url'     => 'required|url',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarPath = 'dana_bantuan_folder/gambar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('dana_bantuan_folder', $gambarPath);
        }

        DanaBantuan::create([
            'judul' => $request->judul,
            'url' => $request->url,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.dana-bantuan.index')->with('success', 'Dana Bantuan baru berhasil ditambahkan!');
    }

    public function edit(DanaBantuan $danaBantuan)
    {
        return view('pages.admin.dana-bantuan.edit', compact('danaBantuan'));
    }

    public function update(Request $request, DanaBantuan $danaBantuan)
    {
        $data = $request->validate([
            'judul'   => 'required|max:255',
            'url'     => 'required|url',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Logika Ganti Gambar
        $danaBantuanPath = $danaBantuan->gambar ?? null;

        if ($request->hasFile('gambar')) {
            if ($danaBantuan && $danaBantuan->gambar) {
                unlink($danaBantuan->gambar);
            }

            $file = $request->file('gambar');
            $danaBantuanPath = 'dana_bantuan_folder/gambar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('dana_bantuan_folder', $danaBantuanPath);

            $data['gambar'] = $danaBantuanPath;
        }

        $danaBantuan->update($data);

        return redirect()->route('admin.dana-bantuan.index')->with('success', 'Dana Bantuan berhasil diperbarui!');
    }

    public function destroy(DanaBantuan $danaBantuan)
    {
        // Hapus file gambar dari penyimpanan
        if ($danaBantuan && $danaBantuan->gambar) {
            unlink($danaBantuan->gambar);
        }

        $danaBantuan->delete();

        return redirect()->route('admin.dana-bantuan.index')->with('success', 'Dana Bantuan berhasil dihapus!');
    }
}
