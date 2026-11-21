<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|max:255',
            'icon'    => 'required|max:20',
            'jumlah'  => 'required|max:255',
        ]);

        $data = $request->all();

        Beasiswa::create($data);

        return redirect()->back()->with('success', 'Beasiswa berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        $request->validate([
            'nama'    => 'required|max:255',
            'icon'    => 'required|max:20',
            'jumlah'  => 'required|max:255',
        ]);

        $data = $request->all();

        $beasiswa->update($data);

        return redirect()->back()->with('success', 'Beasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->delete();

        return redirect()->back()->with('success', 'Beasiswa berhasil dihapus!');
    }
}
