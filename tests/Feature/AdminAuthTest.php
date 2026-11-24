<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect('/panel-login');
    }

    public function test_admin_pages_render_with_an_empty_database(): void
    {
        $user = User::create([
            'name' => 'Local Test Admin',
            'email' => 'local-test-'.Str::uuid().'@example.invalid',
            'password' => Hash::make(Str::random(32)),
        ]);

        $this->actingAs($user);

        foreach ([
            '/admin/banner',
            '/admin/banner/create',
            '/admin/berita',
            '/admin/berita/create',
            '/admin/dana-bantuan',
            '/admin/dana-bantuan/create',
            '/admin/dashboard',
            '/admin/faq',
            '/admin/faq/create',
            '/admin/footer',
            '/admin/galleries',
            '/admin/geografis',
            '/admin/informasi-umum',
            '/admin/kategori-berita',
            '/admin/kategori-berita/create',
            '/admin/kategori-layanan',
            '/admin/kategori-layanan/create',
            '/admin/kategori-produk',
            '/admin/kategori-produk/create',
            '/admin/kepala-sekolah',
            '/admin/layanan',
            '/admin/layanan/create',
            '/admin/navbar',
            '/admin/organisasi-sekolah',
            '/admin/organisasi-sekolah/create',
            '/admin/pengumuman',
            '/admin/pengumuman/create',
            '/admin/produk',
            '/admin/produk/create',
            '/admin/profil-sekolah/kontak',
            '/admin/sejarah',
            '/admin/statistics',
            '/admin/visi-misi',
        ] as $uri) {
            $this->get($uri)->assertOk();
        }
    }

    public function test_admin_can_log_in_open_dashboard_and_log_out(): void
    {
        $password = Str::random(32);
        $user = User::create([
            'name' => 'Local Test Admin',
            'email' => 'local-test-'.Str::uuid().'@example.invalid',
            'password' => Hash::make($password),
        ]);

        $this->post('/panel-login', [
            'email' => $user->email,
            'password' => $password,
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($user);
        $this->get('/admin/dashboard')->assertOk();

        $this->post('/logout')->assertRedirect('/panel-login');
        $this->assertGuest();
    }

    public function test_failed_login_uses_the_same_generic_error_for_unknown_and_known_email(): void
    {
        $user = User::create([
            'name' => 'Local Test Admin',
            'email' => 'local-test-'.Str::uuid().'@example.invalid',
            'password' => Hash::make(Str::random(32)),
        ]);

        foreach (['missing-'.Str::uuid().'@example.invalid', $user->email] as $email) {
            $this->from('/panel-login')
                ->post('/panel-login', [
                    'email' => $email,
                    'password' => Str::random(32),
                ])
                ->assertSessionHasErrors([
                    'email' => 'Email atau kata sandi tidak sesuai.',
                ]);
        }
    }

    public function test_login_route_throttles_after_five_attempts(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '198.51.100.42']);

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->from('/panel-login')
                ->post('/panel-login', [
                    'email' => 'missing@example.invalid',
                    'password' => Str::random(32),
                ])
                ->assertRedirect('/panel-login');
        }

        $this->from('/panel-login')
            ->post('/panel-login', [
                'email' => 'missing@example.invalid',
                'password' => Str::random(32),
            ])
            ->assertTooManyRequests();
    }
}
