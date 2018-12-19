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
            'title' => 'test new series',
            'description' => 'Test New series Added',
            'image' => UploadedFile::fake()->image('test.png')
        ])->assertRedirect();
        Storage::disk(config('filesystems.default'))->assertExists(
            'series/' . str_slug('test new series') . '.png'
        );
        $this->assertDatabaseHas('series', [
            'slug' => str_slug('test new series')
        ]);
    }
}
