<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    use RefreshDatabase;
    public function testUserLoginError()
    {
        $user = factory(User::class)->create();
        $this->postJson('/login',[
            'email' => $user->email,
            'password' => 'wrong password'
        ])->assertStatus(422)->assertJson([
            'message' => 'These Credentails do not match our records'
        ]);
    }
}
