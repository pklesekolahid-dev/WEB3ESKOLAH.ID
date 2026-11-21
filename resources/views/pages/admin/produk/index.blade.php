@extends('layouts.admin')

@section('title', 'Kelola Produk Murid')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Produk Murid</h1>
        <p class="text-sm text-gray-500">Kelola berbagai usaha murid.</p>
    </div>
    <a href="{{ route('admin.produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Produk
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r">
    <p class="text-sm text-green-700 font-bold">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-600 font-bold border-b border-gray-200">
            <tr>
                <th class="px-6 py-4">Foto Produk</th>
                <th class="px-6 py-4">Usaha & Pemilik</th>
                <th class="px-6 py-4">Kategori</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($produks as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                        <img src="{{ asset($item->foto) }}" class="w-full h-full object-cover">
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="font-bold text-gray-900">{{ $item->nama_usaha }}</p>
                    <p class="text-xs text-gray-500 mt-1">Owner: {{ $item->pemilik }}</p>
                    <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +{{ $item->no_wa }}
                    </p>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                        {{ $item->kategori->nama }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($item->status == 'disetujui')
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                        Aktif
                    </span>
                    @elseif($item->status == 'pending')
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200 animate-pulse">
                        Menunggu
                    </span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                        Ditolak
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.produk.edit', $item->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 border border-yellow-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 border border-red-200">
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
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada data Produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $produks->links() }}
</div>

@endsection