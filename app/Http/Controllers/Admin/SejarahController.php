<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::first();

        if (!$sejarah) {
            $sejarah = Sejarah::create([
                'konten' => '-'
            ]);
        }

        return view('pages.admin.sejarah.index', compact('sejarah'));
    }

    public function update(Request $request)
    {
        $sejarah = Sejarah::first();

        $request->validate([
            'hero_desc'      => 'nullable|string',
            'hero_img'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hero_caption'   => 'nullable|string|max:255',
            'asal_tag'       => 'nullable|string|max:100',
            'asal_title'     => 'required|string|max:255',
            'paragraf'       => 'nullable|array',
            'paragraf.*'     => 'nullable|string',
            'timeline_title' => 'nullable|string|max:255',
            'timeline_sub'   => 'nullable|string|max:255',
            'timeline'       => 'nullable|array',
            'timeline.*.tahun'     => 'required|string|max:20',
            'timeline.*.judul'     => 'required|string|max:255',
            'timeline.*.deskripsi' => 'required|string',
            'kepala_title'   => 'nullable|string|max:255',
            'kepala_sub'     => 'nullable|string|max:255',
            'kepala'         => 'nullable|array',
            'kepala.*.nama'    => 'required|string|max:255',
            'kepala.*.periode' => 'required|string|max:100',
            'kepala.*.foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kepala.*.aktif'   => 'nullable',
        ]);

        $sejarah = Sejarah::instance();

        // ── Upload foto hero
        $hero_imgPath = $sejarah->hero_img ?? null;

        if ($request->hasFile('hero_img')) {
            if ($sejarah && $sejarah->hero_img) {
                unlink($sejarah->hero_img);
            }

            $file = $request->file('hero_img');
            $hero_imgPath = 'sejarah_folder/hero_img_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('sejarah_folder', $hero_imgPath);
        }

        // ── Proses data kepala sekolah (upload foto per-item)
        $kepalaData = [];
        $kepalaLama = $sejarah->kepala ?? [];

        foreach ($request->input('kepala', []) as $i => $item) {
          
            $fotoPath = $item['foto_lama'] ?? ($kepalaLama[$i]['foto'] ?? null);

            // User upload foto baru
            if ($request->hasFile("kepala.$i.foto")) {
               if (
                    !empty($fotoPath) &&
                    !str_starts_with($fotoPath, 'http') &&
                    file_exists(public_path($fotoPath))
                ) {
                    unlink($fotoPath);
                }

                $file = $request->file("kepala.$i.foto");
                $fotoPath = 'sejarah_folder/foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('sejarah_folder', $fotoPath);
            }

            $kepalaData[] = [
                'nama'     => $item['nama'],
                'periode'  => $item['periode'],
                'foto'     => $fotoPath,
                'foto_url' => $fotoPath
                    ? (str_starts_with($fotoPath, 'http')
                        ? $fotoPath
                        : asset($fotoPath))
                    : null,
                'aktif'    => isset($item['aktif']) && $item['aktif'] == '1',
            ];
        }

        // Pastikan hanya satu kepala yang aktif
        $aktifCount = collect($kepalaData)->where('aktif', true)->count();
        if ($aktifCount > 1) {
            // Jika lebih dari satu aktif, hanya yang terakhir yang dipertahankan
            $lastAktif = collect($kepalaData)->keys()->filter(fn($k) => $kepalaData[$k]['aktif'])->last();
            foreach ($kepalaData as $k => &$kd) {
                $kd['aktif'] = ($k === $lastAktif);
            }
        }

        $sejarah->update([
            'hero_tag'       => $request->hero_tag,
            'hero_title'     => $request->hero_title,
            'hero_desc'      => $request->hero_desc,
            'hero_img'       => $hero_imgPath,
            'hero_caption'   => $request->hero_caption,
            'asal_tag'       => $request->asal_tag,
            'asal_title'     => $request->asal_title,
            'paragraf'       => array_values(array_filter($request->input('paragraf', []))),
            'timeline_title' => $request->timeline_title,
            'timeline_sub'   => $request->timeline_sub,
            'timeline'       => array_values($request->input('timeline', [])),
            'kepala_title'   => $request->kepala_title,
            'kepala_sub'     => $request->kepala_sub,
            'kepala'         => array_values($kepalaData),
        ]);


        return redirect()->route('admin.sejarah.index')->with('success', 'Data Sejarah berhasil diperbarui!');
    }
}
