<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignmentTest extends TestCase
{

    public function testBasicTest()
    {
        $response = $this->getAuthenticatedUser()->get('/assignment/11');

        $response->assertStatus(200);
    }

    // Tests the API route for deleting image, 
    public function testDeleteImage()
    {
        $user = $this->getAuthenticatedUser();
        $response = $user->getJson("/api/assignment/11/delete/something.jpg");

        $response
            ->assertStatus(200)
            ->assertJson([
                'deleted' => false,
            ]);
    }

    public function testUnauthorizedShowAcess()
    {
        $response = $this->get('/assignment/11');
        $response->assertStatus(302);
    }

    public function testAssignmentShow()
    {
        $response = $this->getAuthenticatedUser()->get('/assignment/11');

        $response->assertStatus(200);
    }





    public function getAuthenticatedUser()
    {
        $user = User::factory()->create();

        return $this
            ->actingAs($user)
            ->withSession(['banned' => false]);
    }
}
