<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navbar;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function index()
    {
        $navbar = Navbar::instance();
        return view('pages.admin.navbar.index', compact('navbar'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'dropdown_label'                    => 'nullable|string|max:100',
            'menu_utama'                        => 'nullable|array',
            'menu_utama.beranda'                => 'nullable|string|max:100',
            'menu_utama.berita'                 => 'nullable|string|max:100',
            'menu_utama.umkm'                   => 'nullable|string|max:100',
            'menu_utama.layanan'                => 'nullable|string|max:100',
            'menu_utama.statistik'              => 'nullable|string|max:100',
            'dropdown_items'                    => 'nullable|array',
            'dropdown_items.informasi_umum'     => 'nullable|string|max:100',
            'dropdown_items.visi_misi'          => 'nullable|string|max:100',
            'dropdown_items.sejarah'            => 'nullable|string|max:100',
            'dropdown_items.struktur_aparat'    => 'nullable|string|max:100',
            'dropdown_items.geografis'          => 'nullable|string|max:100',
        ]);

        Navbar::instance()->update([
            'menu_utama'     => $request->input('menu_utama', []),
            'dropdown_label' => $request->dropdown_label ?? 'Profil Sekolah',
            'dropdown_items' => $request->input('dropdown_items', []),
        ]);

        return redirect()
            ->route('admin.navbar.index')
            ->with('success', 'Data navbar berhasil diperbarui.');
    }
}
