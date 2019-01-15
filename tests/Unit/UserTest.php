<?php

namespace Tests\Unit;

use App\Lesson;
use App\Series;
use App\User;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function testUserCompleteLesson(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        //user complete the lesson
        $user->completeLesson($lesson);
        $user->completeLesson($lesson2);
        $this->assertEquals(
            Redis::smembers('user:1:series:1'),
            [1,2]
        );
        $this->assertEquals($user->getNumberOfCompletedLessonsForSeries($lesson->series),2);
    }
    public function testGetPercentageCompleteSeries(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        //user complete the lesson
        $user->completeLesson($lesson);
        $user->completeLesson($lesson2);
        $this->assertEquals(
            $user->percentageCompleteForSeries($lesson->series),
            50
        );
    }
    public function testUserStartSeries(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        $lesson3 = factory(Lesson::class)->create();
        //user complete the lesson
        $user->completeLesson($lesson2);
        $this->assertTrue($user->hasStartedseries($lesson->series));
        $this->assertFalse($user->hasStartedseries($lesson3->series));
    }
}
