<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        // Menampilkan data terbaru di atas
        $pengumumans = Pengumuman::latest()->get();
        // Pastikan path view-nya sesuai dengan folder pages Mas Reza
        return view('pages.admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('pages.admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teks' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        Pengumuman::create([
            'teks' => $request->teks,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pages.admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'teks' => 'required|string|max:255',
        ]);

        $pengumuman->update([
            'teks' => $request->teks,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}