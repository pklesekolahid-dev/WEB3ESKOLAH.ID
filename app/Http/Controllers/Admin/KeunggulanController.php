<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:255',
            'deskripsi'  => 'required',
            'icon'       => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $data = $request->all();

        // Upload icon
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $keunggulanPath = 'keunggulan_folder/icon_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('keunggulan_folder', $keunggulanPath);

            $data['icon'] = $keunggulanPath;
        }

        Keunggulan::create($data);

        return redirect()->back()->with('success', 'Potensi & Keunggulan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $keunggulan = Keunggulan::findOrFail($id);

        $request->validate([
            'judul'      => 'required|max:255',
            'deskripsi'  => 'required',
            'icon'       => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $data = $request->all();

        // Logika Ganti Icon
        $keunggulanPath = $keunggulan->icon ?? null;

        if ($request->hasFile('icon')) {
            if ($keunggulan && $keunggulan->icon) {
                unlink($keunggulan->icon);
            }

            $file = $request->file('icon');
            $keunggulanPath = 'keunggulan_folder/icon_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('keunggulan_folder', $keunggulanPath);

            $data['icon'] = $keunggulanPath;
        }

        $keunggulan->update($data);

        return redirect()->back()->with('success', 'Data Potensi & Keunggulan berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);

        // Hapus iconnya dulu dari folder
        if ($keunggulan && $keunggulan->icon) {
            unlink($keunggulan->icon);
        }

        $keunggulan->delete();

        return redirect()->back()->with('success', 'Potensi & Keunggulan berhasil dihapus!');
    }
}
