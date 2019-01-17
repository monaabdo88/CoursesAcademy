<?php

namespace Tests\Unit;

use App\Lesson;
use App\Series;
use Illuminate\Support\Collection;
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
    public function testCanGetOrderedLessonsForSeries(){
        $lesson1 = factory(Lesson::class)->create([
            'episode_number' => 300
        ]);
        $lesson2 = factory(Lesson::class)->create([
            'episode_number' => 200,
            'series_id' => $lesson1->series_id
        ]);
        $lesson3 = factory(Lesson::class)->create([
            'episode_number' => 100,
            'series_id' => $lesson1->series_id
        ]);

        $lessons = $lesson1->series->getOrderedLessons();

        $this->assertInstanceOf(Collection::class, $lessons);
        $this->assertInstanceOf(Lesson::class, $lessons->random());
        $this->assertEquals($lessons->first()->id, $lesson3->id);
        $this->assertEquals($lessons->last()->id, $lesson1->id);


    }
}
