<?php

namespace Tests\Unit;

use App\Series;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesTest extends TestCase
{
    public function testUserCanGetImaePath(){
        $series = factory(Series::class)->create([
            'image_url'     => 'series/test-new-series.png'
        ]);
        $imgPath = $series->image_path;
        $this->assertEquals(asset('storage/series/test-new-series.png'),$imgPath);

    }
}
