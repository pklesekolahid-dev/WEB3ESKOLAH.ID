<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('position', 'asc')->get();
        return view('pages.admin.galleries.index', compact('galleries'));
    }

    public function edit(Gallery $gallery)
    {
        return view('pages.admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        // Default path lama jika tidak upload baru
        $galleryPath = $gallery->image ?? null;

        if ($request->hasFile('image')) {
            if ($gallery && $gallery->image) {
                // Hapus image lama
                unlink($gallery->image);
            }

            $file = $request->file('image');
            $galleryPath = 'gallery/image_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('gallery', $galleryPath);

            $data['image'] = $galleryPath;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Slot Galeri ke-' . $gallery->position . ' berhasil diperbarui!');
    }
}
