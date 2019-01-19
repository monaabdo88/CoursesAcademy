<?php
namespace App\Entities;
use App\Lesson;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

trait Learning{
    public function completeLesson($lesson){
        //dd("user:{$this->id}:series:{$lesson->series->id}");
        Redis::sadd("user:{$this->id}:series:{$lesson->series->id}",$lesson->id);
    }
    public function getNumberOfCompletedLessonsForSeries($series){
        return count($this->getCompletedLessonsSeries($series));
    }
    public function percentageCompletedOfSeries($series)
    {
        $TotalLessonsInSeries = $series->lessons->count();
        $numberOfCompletedLessons = $this->getNumberOfCompletedLessonsForSeries($series);

        return ($TotalLessonsInSeries / $numberOfCompletedLessons) * 100;
    }

    public function getCompletedLessonsSeries($series){
        return Redis::smembers("user:{$this->id}:series:{$series->id}");
    }
    public function hasStartedseries($series){
        return $this->getNumberOfCompletedLessonsForSeries($series) > 0;
    }
    public function getCompletedLesson($series){
        $completedLesson = $this->getCompletedLessonsSeries($series);
        return collect($completedLesson)->map(function($lessonId){
            return Lesson::find($lessonId);
        });
    }
    public function hasCompleteLesson($lesson)
    {
        return in_array(
            $lesson->id,
            $this->getCompletedLessonsSeries($lesson->series)
        );
    }
}