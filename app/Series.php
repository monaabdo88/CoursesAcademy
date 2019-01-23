<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $guarded = [];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    protected $with = ['lessons'];


    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getImagePathAttribute(){
        return asset('storage/'.$this->image_url);
    }
    public function getOrderedLessons(){
        $orderedLessons = $this->lessons()->orderBy('episode_number', 'asc')->get();
        return collect($orderedLessons);
    }
}
