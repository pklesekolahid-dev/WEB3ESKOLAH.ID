<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_without_content_records(): void
    {
        foreach ([
            '/',
            '/panel-login',
            '/berita',
            '/produk',
            '/layanan',
            '/statistik',
            '/profil/kepala-sekolah',
            '/profil/struktur-organisasi-sekolah',
            '/profil/informasi-umum',
            '/profil/visi-misi',
            '/profil/sejarah',
            '/profil/geografis',
        ] as $uri) {
            $this->get($uri)->assertOk();
        }
    }
}
