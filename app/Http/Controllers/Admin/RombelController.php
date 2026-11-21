<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|max:255',
            'jumlah'  => 'required|max:255',
        ]);

        $data = $request->all();

        Rombel::create($data);

        return redirect()->back()->with('success', 'Rombel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $rombel = Rombel::findOrFail($id);

        $request->validate([
            'nama'    => 'required|max:255',
            'jumlah'  => 'required|max:255',
        ]);

        $data = $request->all();

        $rombel->update($data);

        return redirect()->back()->with('success', 'Rombel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rombel = Rombel::findOrFail($id);
        $rombel->delete();

        return redirect()->back()->with('success', 'Rombel berhasil dihapus!');
    }
}
