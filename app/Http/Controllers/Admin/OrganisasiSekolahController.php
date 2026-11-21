<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganisasiSekolah;
use Illuminate\Http\Request;

class OrganisasiSekolahController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan 'urutan' (asc)
        $organisasiSekolah = OrganisasiSekolah::orderBy('urutan', 'asc')->get();
        return view('pages.admin.organisasi-sekolah.index', compact('organisasiSekolah'));
    }

    public function create()
    {
        return view('pages.admin.organisasi-sekolah.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Wajib Ada)
        $request->validate([
            'nama'    => 'required|max:255',
            'jabatan' => 'required|max:255',
            'nip'     => 'nullable|max:50', // Tambahan NIP biar aman
            'foto'    => 'image|max:2048|nullable', // Max 2MB
            'tipe'    => 'required|in:Staf Inti,Guru/Walikelas', // Wajib pilih salah satu
            'urutan'  => 'nullable|integer',
        ]);

        $data = $request->all();

        // 2. Upload Foto Baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoPath = 'organisasi_sekolah_folder/foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('organisasi_sekolah_folder', $fotoPath);

            $data['foto'] = $fotoPath;
        }

        // 3. Set Default Urutan jika kosong
        // Jika admin tidak isi angka, kita set 99 agar tampil di belakang
        if (!$request->filled('urutan')) {
            $data['urutan'] = 99;
        }

        OrganisasiSekolah::create($data);

        return redirect()->route('admin.organisasi-sekolah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = OrganisasiSekolah::findOrFail($id);
        return view('pages.admin.organisasi-sekolah.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $organisasiSekolah = OrganisasiSekolah::findOrFail($id);

        // 4. FIX: Tambahkan Validasi di Update juga!
        // Agar admin tidak bisa simpan data kosong saat edit
        $request->validate([
            'nama'    => 'required|max:255',
            'jabatan' => 'required|max:255',
            'nip'     => 'nullable|max:50',
            'foto'    => 'image|max:2048|nullable',
            'tipe'    => 'required|in:Staf Inti,Guru/Walikelas', // Penting!
            'urutan'  => 'nullable|integer',
        ]);

        $data = $request->all();

        // 5. Cek Foto Baru
        $fotoPath = $organisasiSekolah->foto ?? null;

        if ($request->hasFile('foto')) {
            if ($organisasiSekolah && $organisasiSekolah->foto) {
                unlink($organisasiSekolah->foto);
            }

            $file = $request->file('foto');
            $fotoPath = 'organisasi_sekolah_folder/foto_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('organisasi_sekolah_folder', $fotoPath);

            $data['foto'] = $fotoPath;
        }

        // 6. Handle Urutan saat Edit
        if (!$request->filled('urutan')) {
            $data['urutan'] = 99;
        }

        $organisasiSekolah->update($data);

        return redirect()->route('admin.organisasi-sekolah.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $organisasiSekolah = OrganisasiSekolah::findOrFail($id);

        // Hapus file foto dari penyimpanan
        if ($organisasiSekolah && $organisasiSekolah->foto) {
            unlink($organisasiSekolah->foto);
        }

        $organisasiSekolah->delete();

        return redirect()->route('admin.organisasi-sekolah.index')->with('success', 'Data berhasil dihapus!');
    }
}
