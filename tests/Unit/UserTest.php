<?php

namespace Tests\Unit;

use App\Lesson;
use App\Series;
use App\User;
use Illuminate\Support\Collection;
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
            'series_id' => $lesson->series->id
        ]);
        //user complete the lesson
        $user->completeLesson($lesson);
        $user->completeLesson($lesson2);
        $this->assertEquals(
            Redis::smembers("user:{$user->id}:series:{$lesson->series->id}"),
            [$lesson->id,$lesson2->id]
        );
        $this->assertEquals($user->getNumberOfCompletedLessonsForSeries($lesson->series),2);
    }
    public function testGetPercentageCompleteSeries(){
        $this->flushRedis();

        $user = factory(User::class)->create();
        $lesson = factory(Lesson::class)->create();
        $seriesId = $lesson->series->id;
        $lesson2 = factory(Lesson::class)->create(['series_id' => $seriesId]);
        factory(Lesson::class)->create(['series_id' => $seriesId]);
        factory(Lesson::class)->create(['series_id' => $seriesId]);

        $user->completeLesson($lesson);
        $user->completeLesson($lesson2);

        $this->assertEquals(
            $user->percentageCompletedOfSeries($lesson->series), 50
        );
    }
    public function testUserStartSeries(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => $lesson->series->id
        ]);
        $lesson3 = factory(Lesson::class)->create();
        //user complete the lesson
        $user->completeLesson($lesson2);
        $this->assertTrue($user->hasStartedseries($lesson->series));
        $this->assertFalse($user->hasStartedseries($lesson3->series));
    }
    public function testUserCompleteSeries(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => $lesson->series->id
        ]);
        $lesson3 = factory(Lesson::class)->create();
        //user complete the lesson
        $user->completeLesson($lesson);
        $user->completeLesson($lesson2);
        $completedLesson = $user->getCompletedLesson($lesson->series);
        //dd($completedLesson);
        $this->assertInstanceOf(Collection::class,$completedLesson);
        $this->assertInstanceOf(Lesson::class,$completedLesson->random());
        $completedLessonId = $completedLesson->pluck('id')->all();
        $this->assertTrue(in_array($lesson->id,$completedLessonId));
        $this->assertTrue(in_array($lesson2->id,$completedLessonId));
        $this->assertFalse(in_array($lesson3->id,$completedLessonId));
    }
    public function testCheckUserCompleteSeries(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        $user->completeLesson($lesson);
        $this->assertTrue($user->hasCompleteLesson($lesson));
        $this->assertFalse($user->hasCompleteLesson($lesson2));
    }
    public function test_user_has_been_complete_series(){
        $this->flushRedis();
        $user = factory(User::class)->create();
        $lesson1 = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create(['series_id' => $lesson1->series->id]);
        $lesson3 = factory(Lesson::class)->create(['series_id' => $lesson1->series->id]);
        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);
        $completedLessons = $user->getCompletedLesson($lesson1->series);
        $this->assertInstanceOf(Collection::class, $completedLessons);
        $this->assertInstanceOf(Lesson::class, $completedLessons->random());

        $completedLessonsIds = $completedLessons->pluck('id')->all();
        $this->assertTrue(in_array($lesson1->id, $completedLessonsIds));
        $this->assertTrue(in_array($lesson2->id, $completedLessonsIds));
        $this->assertFalse(in_array($lesson3->id, $completedLessonsIds));

    }
    public function test_get_number_of_lessons_completed(){
        $this->flushRedis();
        //user
        $user = factory(User::class)->create();
        //lesson
        $lesson = factory(Lesson::class)->create();
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => 1
        ]);
        $lesson3 = factory(Lesson::class)->create();
        $lesson4 = factory(Lesson::class)->create([
            'series_id' => 2
        ]);
        $lesson5 = factory(Lesson::class)->create();
        $user->completeLesson($lesson);
        $user->completeLesson($lesson3);
        $user->completeLesson($lesson5);
        $this->assertEquals(3,$user->getTotalNumberOfCompletedLessons());
    }
    public function test_can_get_next_lesson_to_be_watched_by_user(){
        $this->flushRedis();

        $user = factory(User::class)->create();
        $lesson1 = factory(Lesson::class)->create([
            'episode_number' => 100
        ]);
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => $lesson1->series->id,
            'episode_number' => 200
        ]);
        $lesson3 = factory(Lesson::class)->create([
            'series_id' => $lesson1->series->id,
            'episode_number' => 300
        ]);
        $lesson4 = factory(Lesson::class)->create([
            'series_id' => $lesson1->series->id,
            'episode_number' => 400
        ]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $this->assertEquals($lesson3->id, $user->getNextLessonToWatch($lesson1->series)->id);

        $user->completeLesson($lesson3);
        $this->assertEquals($lesson4->id, $user->getNextLessonToWatch($lesson1->series)->id);

    }
}
