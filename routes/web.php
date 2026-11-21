<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\InformasiUmumController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\DanaBantuanController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\GeografisController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\KategoriLayananController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\KepalaSekolahController;
use App\Http\Controllers\Admin\KeunggulanController;
use App\Http\Controllers\Admin\NavbarController;
use App\Http\Controllers\Admin\OrganisasiSekolahController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProfilDesaController;
use App\Http\Controllers\Admin\RombelController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Models\Beasiswa;
use App\Models\Berita;
use App\Models\DanaBantuan;
use App\Models\KepalaSekolah;
use App\Models\Gallery;
use App\Models\Geografis;
use App\Models\KategoriBerita;
use App\Models\KategoriDemografi;
use App\Models\KategoriLayanan;
use App\Models\KategoriProduk;
use App\Models\Statistic;
use App\Models\Layanan;
use App\Models\OrganisasiSekolah;
use App\Models\Produk;
use App\Models\Rombel;
use App\Models\Sejarah;
use App\Models\VisiMisi;

/*
|--------------------------------------------------------------------------
| Web Routes - Halaman Publik
|--------------------------------------------------------------------------
*/

// --- HALAMAN UTAMA (BERANDA) ---
Route::get('/', function () {
    $kepsek = KepalaSekolah::first();
    $beritas = Berita::latest()->take(3)->get();
    $produk = Produk::where('status', 'disetujui')->latest()->take(4)->get();
    $galleries = Gallery::orderBy('position', 'asc')->get();
    $faqs = \App\Models\Faq::orderBy('urutan', 'asc')->get();
    $pengumumans = \App\Models\Pengumuman::where('is_active', true)->latest()->get();
    $banners = \App\Models\Banner::where('is_active', true)->latest()->get();
    $profil = \App\Models\ProfilDesa::first();
    $kategoriDemografi = KategoriDemografi::first();
    $statistics = Statistic::pluck('value', 'key');
    $visiMisi = VisiMisi::first();

    return view('welcome', compact(
        'beritas',
        'produk',
        'kepsek',
        'galleries',
        'faqs',
        'pengumumans',
        'banners',
        'profil',
        'kategoriDemografi',
        'statistics',
        'visiMisi'
    ));
});

// --- GROUP PROFIL Sekolah ---
Route::prefix('profil')->group(function () {

    // 1. Profil Kepala Sekolah
    Route::get('/kepala-sekolah', function () {
        $kepsek = KepalaSekolah::first();
        return view('pages.profil.kepala-sekolah', compact('kepsek'));
    });

    // 2. Struktur Organisasi Sekolah
    Route::get('/struktur-organisasi-sekolah', function () {
        $kepsek = KepalaSekolah::first();
        $staf = OrganisasiSekolah::where('tipe', 'Staf Inti')->orderBy('urutan', 'asc')->get();
        $guru = OrganisasiSekolah::where('tipe', 'Guru/Walikelas')->orderBy('urutan', 'asc')->get();
        return view('pages.profil.struktur-organisasi-sekolah', compact('kepsek', 'staf', 'guru'));
    })->name('profil.struktur');

    // Halaman Statis Lainnya
    // Informasi Umum Desa (Dynamic)
    Route::get('/informasi-umum', function () {
        $informasi = \App\Models\InformasiUmum::first();

        // Jaga-jaga jika seeder belum jalan
        if (!$informasi) {
            $informasi = new \App\Models\InformasiUmum([
                'nama_sekolah' => 'Sekolah Dummy',
                'kecamatan' => '-',
                'kabupaten' => '-',
                'kode_pos' => '-',
                'kontak_wa' => '-',
                'kontak_email' => '-',
                'slogan' => '-',
                'nama_fasilitas_1' => '-',
                'nama_fasilitas_2' => '-',
                'nama_fasilitas_3' => '-',
                'nama_fasilitas_4' => '-'
            ]);
        }

        $keunggulans = \App\Models\Keunggulan::latest()->get();

        // Ambil data sinkronisasi dari tabel Statistik
        $statistics = Statistic::where('category', 'gender')->pluck('value', 'key');

        return view('pages.profil.informasi-umum', compact('informasi', 'keunggulans', 'statistics'));
    });
    Route::get('/visi-misi', function () {
        $visiMisi = VisiMisi::latest()->first();
        return view('pages.profil.visi-misi', compact('visiMisi'));
    });
    Route::get('/sejarah', function () {
        $sejarah = Sejarah::latest()->first();
        return view('pages.profil.sejarah', compact('sejarah'));
    });
    Route::get('/geografis', function () {
        $geografis = Geografis::latest()->first();
        return view('pages.profil.geografis', compact('geografis'));
    });
});

// --- GROUP BERITA ---
Route::get('/berita', function () {
    $beritas = Berita::with('kategori')->latest()->paginate(9);
    $kategoriBerita = KategoriBerita::get();
    return view('pages.berita.index', compact('beritas', 'kategoriBerita'));
});

Route::get('/berita/{slug}', function ($slug) {
    $berita = Berita::where('slug', $slug)->firstOrFail();
    $berita->increment('views');
    return view('pages.berita.show', compact('berita'));
});

// --- GROUP Produk ---
Route::get('/produk', function () {
    $kategoriProduk = KategoriProduk::get();
    $produks = Produk::with('kategori')->where('status', 'disetujui')->latest()->paginate(9);
    return view('pages.produk.index', compact('produks', 'kategoriProduk'));
});

Route::get('/produk/{id}', function ($id) {
    $produk = Produk::findOrFail($id);
    return view('pages.produk.show', compact('produk'));
})->name('produk.show');

// --- GROUP LAYANAN ONLINE (PUBLIC) ---
Route::get('/layanan', function () {
    // Ambil semua data layanan dari database untuk ditampilkan di depan
    $layanans = Layanan::with('kategori')->latest()->get();
    $kategoriLayanan = KategoriLayanan::get();
    return view('pages.layanan.index', compact('layanans', 'kategoriLayanan'));
})->name('layanan.index');

// Route detail menggunakan slug agar URL cantik
Route::get('/layanan/{slug}', function ($slug) {
    $layanan = Layanan::where('slug', $slug)->firstOrFail();
    return view('pages.layanan.show', compact('layanan'));
})->name('layanan.show');

// --- STATISTIK ---
Route::get('/statistik', function () {
    $statistics = Statistic::pluck('value', 'key');
    $danaBantuan = DanaBantuan::latest()->get();
    $kategoriDemografi = KategoriDemografi::first();
    $beasiswa = Beasiswa::get();
    $rombel = Rombel::get();
    return view('pages.statistik.index', compact(
        'statistics',
        'danaBantuan',
        'kategoriDemografi',
        'beasiswa',
        'rombel'
    ));
});

/*
|--------------------------------------------------------------------------
| Auth Routes - Login & Logout
|--------------------------------------------------------------------------
*/

Route::get('/panel-login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/panel-login', [LoginController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    // Dashboard
    // Dashboard
    Route::get('/dashboard', function () {
        // Mengambil jumlah total data untuk kartu di atas
        $totalBerita = \App\Models\Berita::count();
        $totalProduk = \App\Models\Produk::count();
        $totalLayanan = \App\Models\Layanan::count();

        // Mengambil 5 Produk terbaru yang statusnya 'menunggu' untuk ditampilkan di tabel bawah
        $produkMenunggu = \App\Models\Produk::where('status', 'menunggu')->latest()->take(5)->get();

        return view('pages.admin.dashboard.index', compact('totalBerita', 'totalProduk', 'totalLayanan', 'produkMenunggu'));
    })->name('dashboard');

    // Kelola Profil Kepala Sekolah
    Route::get('/kepala-sekolah', [KepalaSekolahController::class, 'index'])->name('kepsek.index');
    Route::put('/kepala-sekolah', [KepalaSekolahController::class, 'update'])->name('kepsek.update');

    //Faq CRUD
    Route::resource('faq', FaqController::class)->names([
        'index' => 'faq.index',
        'create' => 'faq.create',
        'store' => 'faq.store',
        'show' => 'faq.show',
        'edit' => 'faq.edit',
        'update' => 'faq.update',
        'destroy' => 'faq.destroy',
    ]);

    // CRUD Pengumuman
    Route::resource('pengumuman', PengumumanController::class)->names([
        'index' => 'pengumuman.index',
        'create' => 'pengumuman.create',
        'edit' => 'pengumuman.edit',
    ]);

    // Kelola Banner
    Route::resource('banner', BannerController::class)->names([
        'index' => 'banner.index',
        'create' => 'banner.create',
        'edit' => 'banner.edit',
    ]);

    // CRUD Berita
    Route::resource('berita', BeritaController::class);

    // CRUD Produk
    Route::resource('produk', ProdukController::class);

    // CRUD Organisasi Sekolah
    Route::resource('organisasi-sekolah', OrganisasiSekolahController::class);

    // CRUD Dana Bantuan
    Route::resource('dana-bantuan', DanaBantuanController::class);

    // Kelola Galeri Desa
    Route::resource('galleries', GalleryController::class)->only(['index', 'edit', 'update']);

    // Kelola Statistik Desa
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
    Route::put('/statistics', [StatisticController::class, 'update'])->name('statistics.update');

    // Kelola Kategori Beasiswa
    Route::post('/beasiswa', [BeasiswaController::class, 'store'])->name('beasiswa.store');
    Route::put('/beasiswa/{id}', [BeasiswaController::class, 'update'])->name('beasiswa.update');
    Route::delete('/beasiswa/{id}', [BeasiswaController::class, 'destroy'])->name('beasiswa.destroy');

    // Kelola Rombel
    Route::post('/rombel', [RombelController::class, 'store'])->name('rombel.store');
    Route::put('/rombel/{id}', [RombelController::class, 'update'])->name('rombel.update');
    Route::delete('/rombel/{id}', [RombelController::class, 'destroy'])->name('rombel.destroy');

    // CRUD Layanan Online (Posisinya harus di DALAM group admin ini)
    Route::resource('layanan', LayananController::class);

    // Kelola Informasi Umum sekolah
    Route::get('/informasi-umum', [InformasiUmumController::class, 'index'])->name('informasi-umum.index');
    Route::put('/informasi-umum', [InformasiUmumController::class, 'update'])->name('informasi-umum.update');

    // Kelola Keunggulan
    Route::post('/keunggulan', [KeunggulanController::class, 'store'])->name('keunggulan.store');
    Route::put('/keunggulan/{id}', [KeunggulanController::class, 'update'])->name('keunggulan.update');
    Route::delete('/keunggulan/{id}', [KeunggulanController::class, 'destroy'])->name('keunggulan.destroy');

    // Kelola Profil sekolah (Alamat, Kontak, Jam Pelayanan, Google Maps)
    Route::get('/profil-sekolah/kontak', [ProfilDesaController::class, 'index'])->name('profil-sekolah.kontak');
    Route::put('/profil-sekolah/kontak/update', [ProfilDesaController::class, 'update'])->name('profil-sekolah.update');

    // CRUD Kategori Layanan
    Route::resource('kategori-layanan', KategoriLayananController::class);

    // CRUD Kategori Produk
    Route::resource('kategori-produk', KategoriProdukController::class);

    // CRUD Kategori Berita
    Route::resource('kategori-berita', KategoriBeritaController::class)
        ->parameters([
            'kategori-berita' => 'kategori_berita'
        ]);

    // Kelola Visi Misi
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
    Route::put('/visi-misi', [VisiMisiController::class, 'update'])->name('visi-misi.update');

    // Kelola Sejarah
    Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
    Route::put('/sejarah', [SejarahController::class, 'update'])->name('sejarah.update');

    // Kelola Geografis
    Route::get('/geografis', [GeografisController::class, 'index'])->name('geografis.index');
    Route::put('/geografis', [GeografisController::class, 'update'])->name('geografis.update');

    // Kelola Footer
    Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
    Route::put('/footer', [FooterController::class, 'update'])->name('footer.update');

    // Kelola Footer
    Route::get('/navbar', [NavbarController::class, 'index'])->name('navbar.index');
    Route::put('/navbar', [NavbarController::class, 'update'])->name('navbar.update');
});
