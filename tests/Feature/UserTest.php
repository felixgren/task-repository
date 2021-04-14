<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    // Create User
    public function testCreateUser()
    {
        $user = User::factory()->create();
        $user->save();
        $this->assertDatabaseHas('users', ['email' => $user->email, "name" => $user->name]);
    }

    public function testRegisterUser()
    {
        $user = User::factory()->create();
        $response = $this
            ->followingRedirects()
            ->post('/register', [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'password' => $user->password,
                'password_confirmation' => $user->password
            ]);
        $response->assertStatus(200);
    }

    public function testLoginUser()
    {
        $user = User::factory()->create();
        $user->save();

        $response = $this
            ->followingRedirects()
            ->post('signin', [
                'email' => $user->email,
                'password' => $user->password
            ]);

        $response->assertStatus(200);
    }

    public function testSignoutUser()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->withSession(['banned' => false])
            ->post(route('logout', $user));
        $response->assertStatus(302);
    }
}
