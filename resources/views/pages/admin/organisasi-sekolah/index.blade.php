@extends('layouts.admin')

@section('title', 'Struktur Organisasi Sekolah')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Struktur Organisasi Sekolah</h2>
    <a href="{{ route('admin.organisasi-sekolah.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Data
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
            <tr>
                <th class="px-6 py-4">Foto</th>
                <th class="px-6 py-4">Nama & NIP</th>
                <th class="px-6 py-4">Jabatan</th>
                <th class="px-6 py-4">Kelompok</th>
                <th class="px-6 py-4 text-center">Urutan</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($organisasiSekolah as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 w-20">
                    @if($item->foto)
                    <img src="{{ asset($item->foto) }}" class="w-12 h-12 rounded-full object-cover border-2 border-green-100 shadow-sm">
                    @else
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold border-2 border-green-50">
                        {{ substr($item->nama, 0, 1) }}
                    </div>
                    @endif
                </td>

                <td class="px-6 py-4">
                    <p class="font-bold text-gray-800">{{ $item->nama }}</p>
                    <p class="text-xs text-gray-500 font-mono mt-0.5">
                        {{ $item->nip ? 'NIP: ' . $item->nip : '-' }}
                    </p>
                </td>

                <td class="px-6 py-4">
                    <span class="font-medium text-gray-700">
                        {{ $item->jabatan }}
                    </span>
                </td>

                <td class="px-6 py-4">
                    @if($item->tipe == 'Staf Inti')
                    <span class="bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full border border-purple-100">
                        Staf Inti
                    </span>
                    @else
                    <span class="bg-orange-50 text-orange-700 text-xs font-bold px-3 py-1 rounded-full border border-orange-100">
                        Guru/Walikelas
                    </span>
                    @endif
                </td>

                <td class="px-6 py-4 text-center">
                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2.5 py-1 rounded border border-gray-200">
                        #{{ $item->urutan }}
                    </span>
                </td>

                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.organisasi-sekolah.edit', $item->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition border border-yellow-100">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.organisasi-sekolah.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition border border-red-100">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-gray-50/50">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p>Belum ada data organisasi sekolah desa.</p>
                        <a href="{{ route('admin.organisasi-sekolah.create') }}" class="text-green-600 font-bold hover:underline mt-2 text-sm">Tambah Data Sekarang</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection