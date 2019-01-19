<?php

namespace Tests\Unit;

use App\Lesson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_get_next_and_prev_from_lessons(){
        $lesson1 = factory(Lesson::class)->create([
            'episode_number' => 300
        ]);
        $lesson2 = factory(Lesson::class)->create([
            'series_id' => $lesson1->series_id,
            'episode_number' => 200
        ]);
        $lesson3 = factory(Lesson::class)->create([
            'series_id' => $lesson1->series_id,
            'episode_number' => 100
        ]);

        $this->assertEquals($lesson2->getNextLesson()->id, $lesson1->id);
        $this->assertEquals($lesson3->getNextLesson()->id, $lesson2->id);
        $this->assertEquals($lesson2->getPreviousLesson()->id, $lesson3->id);
        $this->assertEquals($lesson1->getPreviousLesson()->id, $lesson2->id);
        $this->assertEquals($lesson1->getNextLesson()->id, $lesson1->id);
        $this->assertEquals($lesson3->getPreviousLesson()->id, $lesson3->id);

    }
}
