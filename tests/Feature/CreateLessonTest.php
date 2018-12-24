<?php

namespace Tests\Feature;

use App\Series;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLessonTest extends TestCase
{
    use RefreshDatabase;
    public function testUserCreateLesson(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $series = factory(Series::class)->create();
        $lesson = [
            'title' => 'Test Title',
            'video_id' => '22',
            'episode_number'=> '12',
            'description' => 'Test Description',
            'series_id' => $series->id
        ];
        $this->postJson("/admin/{$series->id}/lessons",$lesson)
            ->assertStatus(200)
            ->assertJson($lesson);
        $this->assertDatabaseHas('lessons',[
            'title' => $lesson['title']
        ]);
    }
    public function testTitleLesson(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $series = factory(Series::class)->create();
        $lesson = [
            'video_id' => '22',
            'episode_number'=> '12',
            'description' => 'Test Description',
            'series_id' => $series->id
        ];
        $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('title');

    }
    public function testDescLesson(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $series = factory(Series::class)->create();
        $lesson = [
            'video_id' => '22',
            'episode_number'=> '12',
            'title' => 'Test Title',
            'series_id' => $series->id
        ];
        $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('description');

    }
    public function testEpisodeLesson(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $series = factory(Series::class)->create();
        $lesson = [
            'video_id' => '22',
            'description'=> 'Test Decription',
            'title' => 'Test Title',
            'series_id' => $series->id
        ];
        $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('episode_number');

    }
    public function testVideoLesson(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $series = factory(Series::class)->create();
        $lesson = [
            'episode_number' => '22',
            'description'=> 'Test Decription',
            'title' => 'Test Title',
            'series_id' => $series->id
        ];
        $this->post("/admin/{$series->id}/lessons",$lesson)
            ->assertSessionHasErrors('video_id');

    }
}
