<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfirmEmailTest extends TestCase
{
    use RefreshDatabase;
    public function testUserConfirmEmail()
    {
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $this->get("/register/confirm/?token={$user->confirm_token}")->assertRedirect('/')->assertSessionHas('success','Your Email Had Confirmed');
        $this->assertTrue($user->fresh()->isConfirmed());
    }
    public function testRedirectTokenWrong(){
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $this->get("/register/confirm/?token=WRONG_TOKEN")->assertRedirect('/')->assertSessionHas('error','Wrong Token');

    }
}
