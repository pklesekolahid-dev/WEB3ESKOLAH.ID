<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('pages.admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('pages.admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $bannerPath = 'banner/gambar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('banner', $bannerPath);
        }

        // Proses Upload Foto ke folder storage/app/public/banners
        $data['gambar'] = $bannerPath;
        $data['is_active'] = $request->has('is_active') ? true : false;

        Banner::create($data);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    public function edit(Banner $banner)
    {
        return view('pages.admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except('gambar');

        // Default path lama jika tidak upload baru
        $bannerPath = $banner->gambar ?? null;

        if ($request->hasFile('gambar')) {
            if ($banner && $banner->gambar) {
                // Hapus gambar lama
                unlink($banner->gambar);
            }

            $file = $request->file('gambar');
            $bannerPath = 'banner/gambar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('banner', $bannerPath);

            $data['gambar'] = $bannerPath;
        }

        $data['is_active'] = $request->has('is_active') ? true : false;
        $banner->update($data);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui!');
    }

    public function destroy(Banner $banner)
    {
        // Hapus file fisik fotonya 
        if ($banner && $banner->gambar) {
            unlink($banner->gambar);
        }

        $banner->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus!');
    }
}
