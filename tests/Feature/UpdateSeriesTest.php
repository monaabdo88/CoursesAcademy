<?php

namespace Tests\Feature;

use App\Series;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateSeriesTest extends TestCase
{
    use RefreshDatabase;
    public function testUserUpdateSeries(){
        $this->withExceptionHandling();
        //login as admin
        $this->loginAdmin();
        //put a request to the specified endpoint
        $series = factory(Series::class)->create();
        Storage::fake(config('filesystems.default'));
        $this->put(route('series.update',$series->slug), [
            'title' => 'new series title',
            'description' => 'Test New series update Web Development Series Web Development Series',
            'image' => UploadedFile::fake()->image('image-series.png')
        ])->assertRedirect(route('series.index'))
            ->assertSessionHas('success','Successfully updated series');
        //assert storage image
        Storage::disk(config('filesystems.default'))->assertExists(
            'public/series/' . str_slug('new series title') . '.png'
        );
        //assert that db has a particular
        $this->assertDatabaseHas('series', [
            'slug' => str_slug('new series title'),
            'image_url'=> 'series/' . str_slug('new series title') . '.png'
        ]);
    }
    public function test_unrequired_image_to_update_series()
    {
        $this->withoutExceptionHandling();

        $this->loginAdmin();

        $series = factory(Series::class)->create();

        Storage::fake(config('filesystem.default'));

        $this->put(route('series.update', $series->slug), [
            'title' => 'new series title',
            'description' => 'new series description'
        ])->assertRedirect(route('series.index'))
            ->assertSessionHas('success', 'Successfully updated series');

        Storage::disk(config('filesystem.default'))->assertMissing(
            'series/' . str_slug('new series title') . '.png'
        );

        $this->assertDatabaseHas('series', [
            'slug' => str_slug('new series title'),
            'image_url' => $series->image_url
        ]);

    }
}
