<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;
    public function testUserCreateSeries()
    {
        $this->withExceptionHandling();
        $this->loginAdmin();
        Storage::fake(config('filesystems.default'));
        $this->post('/admin/series', [
            'title' => 'test new series',
            'description' => 'Test New series Added Web Development Series Web Development Series',
            'image' => UploadedFile::fake()->image('test.png')
        ])->assertRedirect()->assertSessionHas('success','Series Created Successfully');
        Storage::disk(config('filesystems.default'))->assertExists(
            'series/' . str_slug('test new series') . '.png'
        );
        $this->assertDatabaseHas('series', [
            'slug' => str_slug('test new series')
        ]);
    }
    public function testSeriesWithTitle(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $this->post('/admin/series', [
            'description' => 'Test New series Added Web Development Series Web Development Series',
            'image' => UploadedFile::fake()->image('test.png')
        ])->assertSessionHasErrors('title');
    }
    public function testSeriesWithdescription(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $this->post('/admin/series', [
            'title' => 'test new series',
            'image' => UploadedFile::fake()->image('test.png')
        ])->assertSessionHasErrors('description');
    }
    public function testSeriesWithImg(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $this->post('/admin/series', [
            'title' => 'test new series',
            'description' => 'Test New series Added Web Development Series Web Development Series Web Development Series'
        ])->assertSessionHasErrors('image');
    }
    public function testSeriesIsImg(){
        $this->withExceptionHandling();
        $this->loginAdmin();
        $this->post('/admin/series', [
            'title' => 'test new series',
            'description' => 'Test New series Added Web Development Series Web Development Series Web Development Series',
            'image' => 'STRING'
        ])->assertSessionHasErrors('image');
    }
    public function testisAdmin(){
        //user
        $user = factory(User::class)->create();
        $this->ActingAs($user);
        //visit Endpoint
        $this->post('/admin/series')->assertSessionHas('error','You Are Not Admin');

    }
}
