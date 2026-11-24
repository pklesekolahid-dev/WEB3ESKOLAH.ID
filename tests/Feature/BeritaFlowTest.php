<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class BeritaFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_publish_update_and_delete_a_news_article(): void
    {
        $temporaryPublicPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'web3-news-test-'.Str::uuid();
        $originalPublicPath = app()->publicPath();
        File::ensureDirectoryExists($temporaryPublicPath.DIRECTORY_SEPARATOR.'build');
        File::copy(
            $originalPublicPath.DIRECTORY_SEPARATOR.'build'.DIRECTORY_SEPARATOR.'manifest.json',
            $temporaryPublicPath.DIRECTORY_SEPARATOR.'build'.DIRECTORY_SEPARATOR.'manifest.json',
        );
        app()->usePublicPath($temporaryPublicPath);

        try {
            $user = User::create([
                'name' => 'Local Test Admin',
                'email' => 'local-test-'.Str::uuid().'@example.invalid',
                'password' => Hash::make(Str::random(32)),
            ]);
            $this->actingAs($user);

            $this->post('/admin/kategori-berita', ['nama' => 'Kabar Dummy'])
                ->assertRedirect('/admin/kategori-berita');

            $category = KategoriBerita::where('nama', 'Kabar Dummy')->firstOrFail();

            $this->post('/admin/berita', [
                'judul' => 'Berita Dummy Awal',
                'konten' => '<p>Konten berita uji lokal.</p>',
                'kategori_berita_id' => $category->id,
                'gambar' => $this->dummyImage(),
            ])->assertRedirect('/admin/berita');

            $article = Berita::where('slug', 'berita-dummy-awal')->firstOrFail();
            $imagePath = $temporaryPublicPath.DIRECTORY_SEPARATOR.$article->gambar;

            $this->assertFileExists($imagePath);
            $this->get('/berita')
                ->assertOk()
                ->assertSee('Berita Dummy Awal')
                ->assertSee('Kabar Dummy');
            $this->get('/berita/'.$article->slug)
                ->assertOk()
                ->assertSee('Konten berita uji lokal.');
            $this->assertSame(1, $article->fresh()->views);

            $this->get('/admin/berita/'.$article->id.'/edit')->assertOk();
            $this->put('/admin/berita/'.$article->id, [
                'judul' => 'Berita Dummy Diperbarui',
                'konten' => '<p>Konten berita sudah diperbarui.</p>',
                'kategori_berita_id' => $category->id,
                'gambar' => $this->dummyImage(),
            ])->assertRedirect('/admin/berita');

            $article->refresh();
            $updatedImagePath = $temporaryPublicPath.DIRECTORY_SEPARATOR.$article->gambar;
            $this->assertSame('berita-dummy-diperbarui', $article->slug);
            $this->assertFileExists($updatedImagePath);
            $this->assertFileDoesNotExist($imagePath);
            $this->get('/berita/'.$article->slug)
                ->assertOk()
                ->assertSee('Konten berita sudah diperbarui.');

            $this->delete('/admin/berita/'.$article->id)->assertRedirect('/admin/berita');
            $this->assertDatabaseMissing('beritas', ['id' => $article->id]);
            $this->assertFileDoesNotExist($updatedImagePath);

            $this->delete('/admin/kategori-berita/'.$category->id)
                ->assertRedirect('/admin/kategori-berita');
            $this->assertDatabaseMissing('kategori_beritas', ['id' => $category->id]);
        } finally {
            app()->usePublicPath($originalPublicPath);
            File::deleteDirectory($temporaryPublicPath);
        }
    }

    private function dummyImage(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent(
            'berita.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/03sAAAAASUVORK5CYII='),
        );
    }
}
