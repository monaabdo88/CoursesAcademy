<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;
    public function testUserCreateSeries()
    {
        $this->withExceptionHandling();
        Storage::fake(config('filesystems.default'));

        $this->post('/admin/series', [
            'title' => 'Vuejs for beginners',
            'description' => 'the best vuejs cast ever',
            'image' => UploadedFile::fake()->image('image-series.png')
        ])->assertRedirect()
            ->assertSessionHas('success', 'Series created successfully.');

        Storage::disk(config('filesystems.default'))->assertExists(
            'series/' . str_slug('Vuejs for beginners') . '.png'
        );

        $this->assertDatabaseHas('series', [
            'slug' => str_slug('Vuejs for beginners')
        ]);
    }
}
