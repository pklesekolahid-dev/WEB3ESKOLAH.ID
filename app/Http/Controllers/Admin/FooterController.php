<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::instance();
        return view('pages.admin.footer.index', compact('footer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'copyright'   => 'nullable|string|max:255',

            'jam'          => 'nullable|array',
            'jam.*.hari'   => 'required|string|max:100',
            'jam.*.waktu'  => 'required|string|max:50',
            'jam.*.tipe'   => 'required|in:normal,tutup',
            'jam_catatan'  => 'nullable|string|max:500',

            'menu'          => 'nullable|array',
            'menu.*.label'  => 'required|string|max:100',
            'menu.*.url'    => 'required|string|max:500',

            'kontak'         => 'nullable|array',
            'kontak.*.icon'  => 'nullable|string|max:100',
            'kontak.*.nilai' => 'required|string|max:255',
        ]);

        $menuData = collect($request->input('menu', []))
            ->filter(function ($item) {
                return !empty(trim($item['label'] ?? '')) && !empty(trim($item['url'] ?? ''));
            })
            ->map(function ($item) {
                $url = trim($item['url'] ?? '');

                $isExternal = str_starts_with($url, 'http://') || str_starts_with($url, 'https://');

                if ($isExternal) {
                    $appUrl = rtrim(config('app.url'), '/');
                    if (str_starts_with($url, $appUrl)) {
                        $path = substr($url, strlen($appUrl));
                        $url = url($path);
                    } else {
                        $url = filter_var($url, FILTER_SANITIZE_URL);
                    }
                } else {
                    if (!str_starts_with($url, '/')) {
                        $url = '/' . $url;
                    }
                    $url = url($url);
                }

                return [
                    'label' => strip_tags(trim($item['label'] ?? '')),
                    'url'   => $url,
                ];
            })
            ->values()
            ->toArray();

        Footer::instance()->update([
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'copyright'   => $request->copyright,
            'jam'         => array_values($request->input('jam', [])),
            'jam_catatan' => $request->jam_catatan,
            'menu'        => $menuData,
            'kontak'      => array_values($request->input('kontak', [])),
        ]);

        return redirect()
            ->route('admin.footer.index')
            ->with('success', 'Data footer berhasil diperbarui.');
    }
}
