<?php
namespace App\Entities;
use App\Lesson;
use App\Series;
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
    public function seriesBeingWatchedIds(){
        $keys = Redis::keys("user:{$this->id}:series:*");

        $seriesIds = [];

        foreach ($keys as $key):
            $seriesId = explode(':', $key)[3];
            array_push($seriesIds, $seriesId);
        endforeach;

        return $seriesIds;
    }
    public function seriesBeingWatched(){

             return collect($this->seriesBeingWatchedIds())->map(function ($id){
                return Series::find($id);
            })->filter();
    }
    public function getTotalNumberOfCompletedLessons(){
        $keys = Redis::keys("user:{$this->id}:series:*");
        $results = 0;
        foreach ($keys as $key):
            $results  = $results + count(Redis::smembers($key));
        endforeach;
        return $results;
    }
    public function getNextLessonToWatch($series){
        $lessonIds = $this->getCompletedLessonsSeries($series);
        $lessonId = end($lessonIds);
        return Lesson::find($lessonId)->getNextLesson();
    }
}