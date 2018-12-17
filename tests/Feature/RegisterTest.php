<?php

namespace Tests\Feature;

use App\Mail\ConfirmYourEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function testUserHasUsername()
    {
        $this->post('/register',[
            'name' => 'monaabdo88',
            'email' => 'monaabdo88@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertRedirect();
        $this->assertDatabaseHas('users',[
            'username' => str_slug('monaabdo88')
        ]);
    }
    public function testUserHasToken(){
        $this->withExceptionHandling();
        Mail::fake();
        $this->post('/register',[
            'name' => 'monaabdo88',
            'email' => 'monaabdo88@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertRedirect();
        $user = User::find(1);
        $this->assertNotNull($user->confirm_token);
        $this->assertFalse($user->isConfirmed());
    }
    public function testEmailSend(){
        $this->withExceptionHandling();
        Mail::fake();
        $this->post('/register',[
            'name' => 'monaabdo88',
            'email' => 'monaabdo88@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->assertRedirect();
        Mail::assertSent(ConfirmYourEmail::class);
    }
}
