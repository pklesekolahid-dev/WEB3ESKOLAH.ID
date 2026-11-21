@extends('layouts.admin') @section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Galeri Desa</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola 5 slot foto utama untuk ditampilkan di halaman beranda.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Slot</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Preview Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul & Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($galleries as $gallery)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Slot {{ $gallery->position }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($gallery->image)
                        <img src="{{ asset($gallery->image) }}" alt="Preview" class="h-16 w-24 object-cover rounded-md shadow-sm border">
                        @else
                        <div class="h-16 w-24 bg-gray-100 rounded-md border-2 border-dashed border-gray-300 flex items-center justify-center">
                            <span class="text-xs text-gray-400 italic">Kosong</span>
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">{{ $gallery->title }}</div>
                        <div class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $gallery->description ?? 'Tidak ada deskripsi' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md transition text-xs font-semibold">
                            <i class="fas fa-edit"></i> Edit Slot
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection