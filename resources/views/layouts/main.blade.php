<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profil Sekolah') - Maju Bersama Teknologi</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset(informasi_umum('logo')) }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .reveal-on-scroll {
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 flex flex-col min-h-screen w-full overflow-x-hidden"
    x-data="{ 
          scrolled: false, 
          mobileMenu: false, 
          isDark: {{ isset($navHitam) && $navHitam ? 'true' : 'false' }} 
      }"
    @scroll.window="scrolled = (window.pageYOffset > 20)">



    <nav :class="(scrolled || isDark) ? 'bg-white/90 backdrop-blur-md shadow-md py-3' : 'bg-transparent py-5'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">

            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="w-10 h-10  flex items-center justify-center">
                    <img src="{{ asset(informasi_umum('logo')) }}" alt="Logo Sekolah" class="w-8 h-8 rounded-full">
                </div>
                <div>
                    <h1 :class="(scrolled || isDark) ? 'text-green-800' : 'text-white'" class="font-bold text-xl leading-none transition-colors">{{informasi_umum('nama_sekolah')}}</h1>
                    <p :class="(scrolled || isDark) ? 'text-gray-600' : 'text-gray-200'" class="text-xs transition-colors">{{informasi_umum('kabupaten')}}</p>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" :class="(scrolled || isDark) ? 'text-gray-700 hover:text-green-600' : 'text-white/90 hover:text-white'" class="font-medium text-sm transition">
                    {{ navbar('menu_utama')['beranda'] ?? 'Beranda' }}
                </a>

                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @mouseenter="open = true" @mouseleave="open = false">
                    <button :class="(scrolled || isDark) ? 'text-gray-700 hover:text-green-600' : 'text-white/90 hover:text-white'"
                        class="flex items-center gap-1 font-medium text-sm transition focus:outline-none">
                        {{ navbar('dropdown_label') ?? 'Profil Sekolah' }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-2 z-50">

                        @php
                        $dropdownItems = [
                        ['key' => 'informasi_umum', 'url' => '/profil/informasi-umum', 'default' => 'Informasi Umum'],
                        ['key' => 'visi_misi', 'url' => '/profil/visi-misi', 'default' => 'Visi & Misi'],
                        ['key' => 'sejarah', 'url' => '/profil/sejarah', 'default' => 'Sejarah Sekolah'],
                        ['key' => 'struktur_organisasi_sekolah', 'url' => '/profil/struktur-organisasi-sekolah', 'default' => 'Struktur Organisasi Sekolah'],
                        ['key' => 'geografis', 'url' => '/profil/geografis', 'default' => 'Geografis Sekolah'],
                        ];
                        @endphp

                        @foreach($dropdownItems as $item)
                        <a href="{{ url($item['url']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition">
                            {{ navbar('dropdown_items')[$item['key']] ?? $item['default'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                @php
                $menuUtama = [
                ['key' => 'berita', 'url' => '/berita', 'default' => 'Berita'],
                ['key' => 'produk', 'url' => '/produk', 'default' => 'Produk'],
                ['key' => 'layanan', 'url' => '/layanan', 'default' => 'Layanan'],
                ['key' => 'statistik', 'url' => '/statistik', 'default' => 'Statistik'],
                ];
                @endphp

                @foreach($menuUtama as $item)
                <a href="{{ url($item['url']) }}" :class="(scrolled || isDark) ? 'text-gray-700 hover:text-green-600' : 'text-white/90 hover:text-white'" class="font-medium text-sm transition">
                    {{ navbar('menu_utama')[$item['key']] ?? $item['default'] }}
                </a>
                @endforeach
            </div>

            <div class="hidden md:flex items-center gap-3"></div>

            <div class="md:hidden">
                <button @click="mobileMenu = !mobileMenu" :class="(scrolled || isDark) ? 'text-gray-800' : 'text-white'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="mobileMenu"
            x-transition
            class="md:hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-gray-100 py-4 px-4 sm:px-6 flex flex-col gap-4">

            <a href="{{ url('/') }}" class="text-gray-700 font-medium">Beranda</a>

            <div x-data="{ subOpen: false }">
                <button @click="subOpen = !subOpen" class="flex items-center justify-between w-full text-gray-700 font-medium">
                    Profil Sekolah
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="subOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="subOpen" class="pl-4 mt-2 flex flex-col gap-2 border-l-2 border-green-100">
                    <a href="{{ url('/profil/informasi-umum') }}" class="text-sm text-gray-600">Informasi Umum</a>
                    <a href="{{ url('/profil/visi-misi') }}" class="text-sm text-gray-600">Visi & Misi</a>
                    <a href="{{ url('/profil/sejarah') }}" class="text-sm text-gray-600">Sejarah Sekolah</a>
                    <a href="{{ url('/profil/struktur-organisasi-sekolah') }}" class="text-sm text-gray-600">Struktur Organisasi Sekolah</a>
                    <a href="{{ url('/profil/geografis') }}" class="text-sm text-gray-600">Geografis Sekolah</a>
                </div>
            </div>

            <a href="{{ url('/berita') }}" class="text-gray-700 font-medium">Berita</a>
            <a href="{{ url('/produk') }}" class="text-gray-700 font-medium">Produk</a>
            <a href="{{ url('/layanan') }}" class="text-gray-700 font-medium">Layanan</a>
            <a href="{{ url('/statistik') }}" class="text-gray-700 font-medium">Statistik</a>
        </div>
    </nav>

    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white pt-20 pb-10 w-full overflow-x-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-16">

                <div>
                    <h3 class="font-bold text-lg mb-6 text-white border-b border-gray-700 pb-2">Jam Pelayanan</h3>
                    <ul class="space-y-3">
                        @foreach(footer('jam') as $jam)
                        <li class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">{{ $jam['hari'] }}</span>
                            @if($jam['waktu'] == 'Tutup' || $jam['waktu'] == 'tutup')
                            <span class="text-red-400 font-bold uppercase text-xs tracking-wider px-2 py-1 bg-red-400/10 rounded">{{ $jam['waktu'] }}</span>
                            @else
                            <span class="text-white font-medium">{{ $jam['waktu'] }}</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    <p class="text-[10px] text-gray-500 mt-4 leading-relaxed italic">
                        {{ footer('jam_catatan') }}
                    </p>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">Jelajahi</h3>
                    <ul class="space-y-4 text-gray-400">
                        @foreach(footer('menu') as $menu)
                        <li><a href="{{ $menu['url'] }}" class="hover:text-green-500 transition">
                                {{ $menu['label'] }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">Kontak Sekolah</h3>
                    <ul class="space-y-4 text-gray-400">
                        @foreach(footer('kontak') as $kontak)
                        <li class="flex gap-3">
                            <i class="{{ $kontak['icon'] }} text-green-500"></i>
                            {{ $kontak['nilai'] }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <img src="{{ asset(informasi_umum('logo')) }}" alt="Logo Sekolah" class="w-8 h-8 rounded-full">
                        <span class="font-bold text-xl">{{ footer('nama') }}</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        {{ footer('deskripsi') }}
                    </p>
                </div>

            </div>

            <div class="border-t border-gray-800 pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>{{ footer('copyright') }}</p>
            </div>
        </div>
    </footer>

</body>

</html>