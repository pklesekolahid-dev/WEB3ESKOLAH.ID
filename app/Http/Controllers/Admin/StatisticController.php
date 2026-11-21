<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\KategoriDemografi;
use App\Models\Rombel;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    // Menampilkan halaman form edit semua statistik
    public function index()
    {
        // Kita kelompokkan data berdasarkan kategorinya biar rapi di form
        $statistics = Statistic::all()->groupBy('category');
        $kategoriDemografi = KategoriDemografi::first();
        $beasiswa = Beasiswa::latest()->get();
        $rombel = Rombel::latest()->get();

        return view('pages.admin.statistics.index', compact('statistics', 'kategoriDemografi', 'beasiswa', 'rombel'));
    }

    // Memproses simpan semua data sekaligus
    public function update(Request $request)
    {
        // Ambil semua data inputan kecuali token csrf dan method
        $inputs = $request->except(['_token', '_method']);

        $kategoriDemografi = KategoriDemografi::first();

        $validated = $request->validate([
            'nama_1' => 'required|string|max:255',
            'nama_2' => 'required|string|max:255',
            'nama_3' => 'required|string|max:255',
            'nama_4' => 'required|string|max:255',
            'icon_1' => 'required|string|max:20',
            'icon_2' => 'required|string|max:20',
            'icon_3' => 'required|string|max:20',
            'icon_4' => 'required|string|max:20',
        ]);

        $kategoriDemografi->update($validated);

        // Looping dan update setiap 'key' dengan 'value' yang baru
        foreach ($inputs as $key => $value) {
            Statistic::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('admin.statistics.index')->with('success', 'Semua data statistik berhasil diperbarui!');
    }
}
