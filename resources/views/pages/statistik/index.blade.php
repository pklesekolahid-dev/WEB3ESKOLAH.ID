@extends('layouts.main')

@section('title', 'Statistik Desa')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<header class="relative pt-24 pb-32 md:pt-28 md:pb-48 bg-gradient-to-br from-green-600 to-emerald-700 text-white overflow-hidden"
    x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)">

    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0"></div>
    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-10 w-48 h-48 bg-black/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 sm:px-6 relative z-10 text-center -mt-4">
        <div class="inline-block mb-3 transform transition-all duration-700 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            <span class="bg-white/20 backdrop-blur-md border border-white/30 text-green-50 text-[10px] font-bold px-3 py-1 rounded-full tracking-wider uppercase shadow-lg">
                ● Data Demografi
            </span>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold mb-3 transform transition-all duration-700 delay-100 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Statistik Sekolah
        </h1>
        <p class="text-green-100 text-sm md:text-base max-w-2xl mx-auto leading-relaxed transform transition-all duration-700 delay-200 ease-out translate-y-10 opacity-0"
            :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
            Informasi data siswa, guru, dan kegiatan sekolah yang disajikan secara transparan, informatif, dan mudah dipahami.
        </p>
    </div>

    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
        <svg class="relative block w-full h-[80px] md:h-[120px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#f9fafb" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,234.7C384,245,480,235,576,213.3C672,192,768,160,864,154.7C960,149,1056,171,1152,186.7C1248,203,1344,213,1392,218.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</header>

<section class="bg-gray-50 relative z-30">
    <div class="container mx-auto px-4 sm:px-6 max-w-7xl">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 -mt-12 lg:-mt-24 pb-12 w-full">

            <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-xl border-b-4 border-green-500 text-center transform hover:-translate-y-1 transition duration-300 min-w-0 flex flex-col items-center justify-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2 sm:mb-3 text-green-600 shrink-0">
                    <i class="{{$kategoriDemografi->icon_1}}"></i>
                </div>
                <div class="text-xl sm:text-3xl font-bold text-gray-900 mb-1" x-data="{ count: 0 }" x-init="let target = {{ $statistics['kategori_demografi_nama_1'] ?? 0 }}; let step = target / 50; if(target > 0) { setInterval(() => { if(count < target) count += Math.ceil(step); else count = target; }, 20); }">
                    <span x-text="count">0</span>
                </div>
                <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider leading-tight">{{$kategoriDemografi->nama_1}}</p>
            </div>

            <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-xl border-b-4 border-blue-500 text-center transform hover:-translate-y-1 transition duration-300 min-w-0 flex flex-col items-center justify-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2 sm:mb-3 text-blue-600 shrink-0">
                    <i class="{{$kategoriDemografi->icon_2}}"></i>
                </div>
                <div class="text-xl sm:text-3xl font-bold text-gray-900 mb-1" x-data="{ count: 0 }" x-init="let target = {{ $statistics['kategori_demografi_nama_2'] ?? 0 }}; let step = target / 50; if(target > 0) { setInterval(() => { if(count < target) count += Math.ceil(step); else count = target; }, 20); }">
                    <span x-text="count">0</span>
                </div>
                <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider leading-tight">{{$kategoriDemografi->nama_2}}</p>
            </div>

            <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-xl border-b-4 border-yellow-500 text-center transform hover:-translate-y-1 transition duration-300 min-w-0 flex flex-col items-center justify-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2 sm:mb-3 text-yellow-600 shrink-0">
                    <i class="{{$kategoriDemografi->icon_3}}"></i>
                </div>
                <div class="text-xl sm:text-3xl font-bold text-gray-900 mb-1" x-data="{ count: 0 }" x-init="let target = {{ $statistics['kategori_demografi_nama_3'] ?? 0 }}; let step = 1; if(target > 0) { setInterval(() => { if(count < target) count += step; else count = target; }, 100); }">
                    <span x-text="count">0</span>
                </div>
                <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider leading-tight">{{$kategoriDemografi->nama_3}}</p>
            </div>

            <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-xl border-b-4 border-purple-500 text-center transform hover:-translate-y-1 transition duration-300 min-w-0 flex flex-col items-center justify-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2 sm:mb-3 text-purple-600 shrink-0">
                    <i class="{{$kategoriDemografi->icon_4}}"></i>
                </div>
                <div class="text-xl sm:text-3xl font-bold text-gray-900 mb-1">{{ $statistics['kategori_demografi_nama_4'] ?? 0 }}</div>
                <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider leading-tight">{{$kategoriDemografi->nama_4}}</p>
            </div>

        </div>
    </div>
</section>

<section class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 max-w-7xl">

        <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 w-full">

            <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition min-w-0 w-full flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-lg sm:text-xl text-gray-900">Data Rombel</h3>
                    <div class="p-2 bg-green-50 rounded-lg shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <div class="relative flex-1 w-full min-h-[250px] sm:min-h-[300px] min-w-0">
                    <div class="relative w-full h-full">
                        <canvas id="rombelChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition min-w-0 w-full flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-lg sm:text-xl text-gray-900">Beasiswa</h3>
                    <div class="p-2 bg-blue-50 rounded-lg shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="relative flex-1 w-full min-h-[250px] sm:min-h-[300px] min-w-0">
                    <div class="relative w-full h-full">
                        <canvas id="beasiswaChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 sm:p-8 rounded-3xl shadow-sm border border-gray-100 lg:col-span-2 hover:shadow-md transition min-w-0 w-full flex flex-col">
                <div class="flex flex-col md:flex-row items-center gap-6 sm:gap-8 w-full h-full">
                    <div class="w-full md:w-1/3">
                        <h3 class="font-bold text-lg sm:text-xl text-gray-900 mb-2">Jenis Kelamin</h3>
                        <p class="text-gray-500 text-sm mb-6">Perbandingan jumlah penduduk Laki-laki dan Perempuan di Desa.</p>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-green-500 shrink-0"></div>
                                    <span class="font-bold text-gray-700">Laki-laki</span>
                                </div>
                                <span class="font-bold text-gray-900 text-lg">{{ number_format($statistics['gender_laki'] ?? 0) }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-yellow-400 shrink-0"></div>
                                    <span class="font-bold text-gray-700">Perempuan</span>
                                </div>
                                <span class="font-bold text-gray-900 text-lg">{{ number_format($statistics['gender_perempuan'] ?? 0) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative w-full md:w-2/3 min-h-[250px] sm:min-h-[300px] min-w-0">
                        <div class="relative w-full h-full">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 sm:py-20 bg-gray-50" x-data="{ shownBantuan: false }" x-intersect.threshold.10="shownBantuan = true">
    <div class="container mx-auto px-4 sm:px-6 max-w-7xl">

        <div class="text-center mb-12 sm:mb-16 transform opacity-0 transition-all duration-700"
            :class="shownBantuan ? 'opacity-100 translate-y-0' : 'translate-y-8'">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 border-b-4 border-green-500 inline-block pb-2">Realisasi Penggunaan Dana BOS</h2>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto text-sm sm:text-base px-2">
                Data Realisasi Pembelanjaan Dana Bantuan Operasional Sekolah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-8 w-full">

            @foreach($danaBantuan as $item)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-green-500 transition-all duration-300 group overflow-hidden flex flex-col">
                {{-- IMAGE FULL --}}
                <div class="w-full h-40 bg-gray-50 flex items-center justify-center p-6">
                    <img src="{{ asset($item->gambar) }}"
                        class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
                </div>

                {{-- CONTENT --}}
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-700 transition">
                        {{ $item->judul }}
                    </h3>
                    <div class="mt-auto pt-6">
                        <a href="{{ $item->url }}"
                            target="_blank"
                            class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-700">
                            Lihat Informasi
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 3h7m0 0v7m0-7L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Chart Rombel
        const ctxRombel = document.getElementById('rombelChart').getContext('2d');
        new Chart(ctxRombel, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($rombel as $item)
                    '{{ addslashes($item->nama) }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Murid',
                    data: [
                       @foreach($rombel as $item)
                        {{ $item->jumlah ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: '#16a34a',
                    borderRadius: 6,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Chart Beasiswa
        const ctxBeasiswa = document.getElementById('beasiswaChart').getContext('2d');
        new Chart(ctxBeasiswa, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($beasiswa as $item)
                    '{{ addslashes($item->nama) }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($beasiswa as $item)
                        {{$item->jumlah ?? 0}},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#16a34a', '#2563eb', '#eab308', '#9333ea', '#9ca3af',
                        '#ef4444', '#f97316', '#06b6d4', '#84cc16', '#ec4899'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });

        // Chart Gender
        const ctxGender = document.getElementById('genderChart').getContext('2d');
        new Chart(ctxGender, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{$statistics['gender_laki'] ?? 0}},
                        {{$statistics['gender_perempuan'] ?? 0}}
                    ],
                    backgroundColor: ['#16a34a', '#fbbf24'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection