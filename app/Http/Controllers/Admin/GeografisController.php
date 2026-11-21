<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Geografis;
use Illuminate\Http\Request;

class GeografisController extends Controller
{
    public function index()
    {
        $geografis = Geografis::instance();

        return view('pages.admin.geografis.index', compact('geografis'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Hero
            'hero_desc'       => 'nullable|string',

            // Peta
            'maps_embed_url'  => 'nullable|string|max:2000',
            'maps_caption'    => 'nullable|string|max:255',
            'letak_desc'      => 'nullable|string',

            // Batas wilayah
            'batas'               => 'nullable|array',
            'batas.*.singkatan'   => 'required|string|max:2',
            'batas.*.arah'        => 'required|string|max:100',
            'batas.*.nama'        => 'required|string|max:255',
            'batas.*.warna'       => 'required|in:blue,yellow,red,green',

            // Topografi
            'topografi_title'         => 'nullable|string|max:255',
            'topografi'               => 'nullable|array',
            'topografi.*.judul'       => 'required|string|max:255',
            'topografi.*.deskripsi'   => 'required|string|max:500',
            'topografi.*.icon_path'   => 'nullable|string',
        ]);

        $geografis = Geografis::instance();

        $geografis->update([
            'hero_tag'        => $request->hero_tag,
            'hero_title'      => $request->hero_title,
            'hero_desc'       => $request->hero_desc,
            'maps_embed_url'  => $request->maps_embed_url,
            'maps_caption'    => $request->maps_caption,
            'letak_desc'      => $request->letak_desc,
            'batas'           => array_values($request->input('batas', [])),
            'topografi_title' => $request->topografi_title,
            'topografi'       => array_values($request->input('topografi', [])),
        ]);

        return redirect()
            ->route('admin.geografis.index')
            ->with('success', 'Data geografis berhasil diperbarui.');
    }
}
