<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Sekolah Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset(informasi_umum('logo')) }}">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar untuk Sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #111827;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 10px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        /* Style untuk Menu Aktif */
        .menu-active {
            background: linear-gradient(to right, #059669, #047857);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(6, 78, 59, 0.3);
        }

        .menu-active svg {
            color: white;
        }

        .menu-inactive {
            color: #9ca3af;
        }

        .menu-inactive:hover {
            background-color: #1f2937;
            color: white;
            transform: translateX(4px);
        }

        .menu-inactive:hover svg {
            color: white;
        }

        .input-hint {
            font-size: .7rem;
            font-weight: 500;
            color: var(--slate-400);
            padding-left: .25rem;
            letter-spacing: .01em;
        }

        .icon-preview {
            display: flex;
            align-items: center;
            gap: .625rem;
            margin-bottom: .875rem;
        }

        .icon-preview-box {
            width: 38px;
            height: 38px;
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16a34a;
            font-size: .9rem;
            flex-shrink: 0;
            transition: all 200ms cubic-bezier(.4, 0, .2, 1);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-gray-900 text-white transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-auto flex flex-col shadow-2xl"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <div class="flex items-center justify-center h-20 border-b border-gray-800 bg-gray-900 shadow-sm z-10 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-gradient-to-br to-emerald-700 flex items-center justify-center text-white font-bold shadow-lg shadow-green-500/30">
                        <img src="{{ asset(informasi_umum('logo')) }}" alt="" srcset="">
                    </div>
                    <span class="text-xl font-bold tracking-wide text-white">SEKOLAH <span class="text-green-400">ADMIN</span></span>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2 sidebar-scroll">

                <p class="px-4 pb-2 text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-2">Utama</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="font-medium text-sm">Dashboard Admin</span>
                </a>
                <a href="{{ route('admin.statistics.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.statistics*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 012-2h6M9 19h6m-6 0H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2zM9 10h.01M15 10h.01M21 10h.01M9 16h.01M15 16h.01M21 16h.01" />
                    </svg>
                    <span class="font-medium text-sm">Statistik Sekolah</span>
                </a>

                <p class="px-4 pb-2 pt-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Konten Publik</p>
                <a href="{{ route('admin.banner.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.banner.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium text-sm">Hero Banner</span>
                </a>
                <a href="{{ route('admin.pengumuman.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.pengumuman.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    <span class="font-medium text-sm">Teks Pengumuman</span>
                </a>
                <a href="{{ route('admin.galleries.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.galleries*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium text-sm">Galeri Foto</span>
                </a>

                <p class="px-4 pb-2 pt-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Kategori</p>
                <a href="{{ route('admin.kategori-layanan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.kategori-layanan.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0121 12.75c0 2.485-4.03 4.5-9 4.5s-9-2.015-9-4.5c0-.684.114-1.34.324-1.95L12 14z" />
                    </svg>
                    <span class="font-medium text-sm">Kategori Layanan Sekolah</span>
                </a>
                <a href="{{ route('admin.kategori-produk.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.kategori-produk.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 7h13l-1.5-7M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                    <span class="font-medium text-sm">Kategori Produk</span>
                </a>
                <a href="{{ route('admin.kategori-berita.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.kategori-berita.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 5H5a2 2 0 00-2 2v10a2 2 0 002 2h14V5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h6M7 16h4" />
                    </svg>
                    <span class="font-medium text-sm">Kategori Berita</span>
                </a>

                <p class="px-4 pb-2 pt-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Layanan & Masyarakat</p>
                <a href="{{ route('admin.layanan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.layanan*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium text-sm">Layanan Sekolah</span>
                </a>

                <a href="{{ route('admin.berita.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.berita*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <span class="font-medium text-sm">Berita Sekolah</span>
                </a>

                <a href="{{ route('admin.produk.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.produk*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="font-medium text-sm">Produk Murid</span>
                </a>
                <a href="{{ route('admin.faq.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.faq.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium text-sm">Tanya Jawab (FAQ)</span>
                </a>
                <a href="{{ route('admin.dana-bantuan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dana-bantuan.*') ? 'menu-active' : 'menu-inactive' }}">

                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10v2m0 12v2m9-6a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span class="font-medium text-sm">Dana BOS</span>
                </a>

                <p class="px-4 pb-2 pt-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">Profil Sekolah</p>
                <a href="{{ route('admin.profil-sekolah.kontak') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.profil-sekolah.*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium text-sm">Kontak & Lokasi</span>
                </a>
                <a href="{{ route('admin.informasi-umum.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.informasi-umum*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    <span class="font-medium text-sm">Informasi Umum</span>
                </a>
                <a href="{{ route('admin.kepsek.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.kepsek*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium text-sm">Kepala Sekolah</span>
                </a>
                <a href="{{ route('admin.organisasi-sekolah.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.organisasi-sekolah*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-medium text-sm">Struktur Organisasi Sekolah</span>
                </a>
                <a href="{{ route('admin.visi-misi.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.visi-misi*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 11l6-6m0 0v5m0-5h-5M5 19l6-6" />
                    </svg>
                    <span class="font-medium text-sm">Visi Misi</span>
                </a>
                <a href="{{ route('admin.sejarah.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.sejarah*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v13M12 6c-2-1-4-1-6-1a4 4 0 00-4 4v10a4 4 0 014-4c2 0 4 0 6 1m0-10c2-1 4-1 6-1a4 4 0 014 4v10a4 4 0 00-4-4c-2 0-4 0-6 1" />
                    </svg>
                    <span class="font-medium text-sm">Sejarah</span>
                </a>
                <a href="{{ route('admin.geografis.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.geografis*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5-2V6l5 2m0 12l6-2m-6 2V8m6 10l5 2V6l-5-2m0 12V4" />
                    </svg>
                    <span class="font-medium text-sm">Geografis</span>
                </a>
                <a href="{{ route('admin.navbar.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.navbar*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="font-medium text-sm">Navbar</span>
                </a>
                <a href="{{ route('admin.footer.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.footer*') ? 'menu-active' : 'menu-inactive' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="3" y="4" width="18" height="16" rx="2" stroke-width="2" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 16h18" />
                    </svg>
                    <span class="font-medium text-sm">Footer</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800 bg-gray-900 z-10 shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-sm font-bold text-white bg-red-600/90 rounded-xl hover:bg-red-600 shadow-lg hover:shadow-red-900/30 transition-all duration-200 group">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden bg-gray-50">

            <header class="bg-white border-b border-gray-100 h-20 flex items-center justify-between px-6 lg:px-8 shadow-sm z-20 shrink-0">

                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="hidden lg:flex items-center">
                    <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-lg text-sm font-bold transition border border-emerald-100">
                        Lihat Website Depan
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" target="_blank" class="lg:hidden p-2 bg-emerald-50 text-emerald-700 rounded-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-full inline-block mt-0.5 border border-emerald-100 uppercase tracking-wider">Super Admin</p>
                    </div>
                    <div class="w-11 h-11 bg-gradient-to-br from-emerald-500 to-green-700 rounded-full flex items-center justify-center text-white font-bold border-2 border-white shadow-md ring-1 ring-gray-100 text-lg">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-6 lg:p-8 relative">
                @yield('content')
            </main>

        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm z-40 lg:hidden"></div>

    </div>

</body>

</html>