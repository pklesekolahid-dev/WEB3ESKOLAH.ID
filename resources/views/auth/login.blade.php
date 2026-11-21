<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Dashboard - Desa Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/' . informasi_umum('logo')) }}">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .anim-entry {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="min-h-screen flex items-stretch overflow-hidden">

        <div class="hidden lg:flex w-[55%] relative bg-gray-900 text-white flex-col justify-between p-12 lg:p-16 overflow-hidden">

            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1599583788938-084930337d45?ixlib=rb-4.0.3"
                    class="w-full h-full object-cover opacity-50 scale-105"
                    alt="Sawah Terasering">
                <div class="absolute inset-0 bg-gradient-to-br from-green-900/90 via-emerald-900/50 to-gray-900/90 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>
            </div>

            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-500 rounded-full mix-blend-overlay filter blur-[150px] opacity-20 animate-pulse"></div>

            <div class="relative z-10 flex items-center gap-3 anim-entry" style="animation-delay: 0.1s;">
                <span class="text-xl font-bold tracking-tight text-white">{{informasi_umum('nama_sekolah')}}</span>
            </div>

            <div class="relative z-10 flex-1 flex items-center justify-center">
                <img src="{{ asset('storage/' . informasi_umum('logo')) }}"
                    alt="Logo Sekolah"
                    class="w-48 h-48 lg:w-64 lg:h-64 rounded-full object-contain">
            </div>

            <div class="relative z-10 anim-entry" style="animation-delay: 0.5s;">
                <h2 class="text-3xl lg:text-4xl font-bold leading-tight mb-3">Pusat Kontrol & <br>Informasi Sekolah.</h2>
                <p class="text-green-100/70 text-base max-w-md">
                    Kelola konten website, data warga sekolah, serta layanan administrasi
                    melalui satu dashboard yang terintegrasi dan aman.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-[45%] bg-white flex flex-col justify-center items-center p-8 relative">

            <div class="absolute top-6 right-6">
                <a href="{{ url('/') }}" class="group flex items-center gap-2 px-4 py-2 rounded-full bg-gray-50 text-gray-500 hover:bg-green-50 hover:text-green-700 transition text-sm font-semibold">
                    <span>Beranda</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="w-full max-w-[380px] anim-entry" style="animation-delay: 0.2s;">

                <div class="mb-10">
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider mb-4 inline-block">Portal Admin</span>
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Selamat Datang</h1>
                    <p class="text-gray-500">Silakan masuk dengan akun staf Anda.</p>
                </div>

                <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                    @csrf

                    @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl mb-6 animate-pulse">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-bold">
                                    Login Gagal!
                                </p>
                                <p class="text-xs text-red-600 mt-1">
                                    {{ $errors->first() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2" for="email">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-600 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required
                                value="{{ old('email') }}"
                                placeholder="Masukkan email Anda"
                                class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-gray-200 border rounded-2xl text-gray-900 text-sm focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition-all outline-none font-medium placeholder-gray-400">
                        </div>
                    </div>

                    <div x-data="{ show: false }">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-bold text-gray-700" for="password">Kata Sandi</label>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-600 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" name="password" id="password" required placeholder="Masukkan kata sandi Anda"
                                class="block w-full pl-12 pr-12 py-4 bg-gray-50 border-gray-200 border rounded-2xl text-gray-900 text-sm focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 transition-all outline-none font-medium placeholder-gray-400">

                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer">
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">Biarkan saya tetap masuk</label>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white font-bold py-4 px-4 rounded-2xl shadow-xl hover:bg-black hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex justify-center items-center gap-2 group">
                        Masuk ke Sistem
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-xs text-gray-400 font-medium">
                        {{ footer('copyright') }}
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>