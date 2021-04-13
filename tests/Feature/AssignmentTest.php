<?php

namespace Tests\Feature;

use App\Models\Assignment;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class AssignmentTest extends TestCase
{
    public function testBasicTest()
    {
        $response = $this->getAuthenticatedUser()->get('/assignment/1');

        $response->assertStatus(200);
    }

    // Register User
    public function testRegisterUser()
    {
        $user = User::factory()->create();
        $user->save();
        $this->assertDatabaseHas('users', ['email' => $user->email, "name" => $user->name]);
    }


    // CRUD TESTS for Assignments
    public function testGetCreatingPost()
    {
        $this->getRouteTest("/assignment/create");
    }

    public function testUnauthorizedShowAcess()
    {
        $response = $this->get('/assignment/1');
        $response->assertStatus(302);
    }

    public function testAssignmentShow()
    {
        $response = $this->getAuthenticatedUser()->get('/assignment/1');
        $response->assertStatus(200);
    }

    public function testGetEditPost()
    {
        $this->getRouteTest("/assignment/1/edit");
    }

    public function testDeletePost()
    {
        $assignment = Assignment::factory()->create();
        $response = $this->getAuthenticatedUser()->delete(route('assignments.destroy', $assignment));
        $response->assertStatus(302);
    }

    public function testGetUser()
    {
        $this->getRouteTest("/users/alegherix");
    }

    public function testGetUserSettings()
    {
        $this->getRouteTest("/settings");
    }

    public function testUploadResource()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/assignment/create', [
            "user_id" => 1,
            "title" => "random",
            "description" => "random",
            "file" => $file,
            "due_date" => "2021-04-19"
        ]);

        Storage::disk('avatars')->assertMissing($file->hashName());
    }

    // Should not be visible for unauthorized users
    public function testGetAdmin()
    {
        // imagecreatetruecolor());
        $response = $this->getAuthenticatedUser()->get('/admin');
        $response->assertStatus(404);
    }

    // Should Only be visible for admins
    public function testGetAdminAsAdmin()
    {
        $response = $this->getAdmin()->get('/admin');
        $response->assertStatus(200);
    }

    // Tests the API route
    public function testDeleteImage()
    {
        $user = $this->getAuthenticatedUser();
        $response = $user->getJson("/api/assignment/1/delete/something.jpg");
        $response
            ->assertStatus(200)
            ->assertJson([
                'deleted' => false,
            ]);
    }

    // UTILS
    public function getRouteTest($path)
    {
        $response = $this->getAuthenticatedUser()->get($path);
        $response->assertStatus(200);
    }


    public function getAuthenticatedUser()
    {
        $user = User::factory()->create();

        return $this
            ->actingAs($user)
            ->withSession(['banned' => false]);
    }

    public function getAdmin()
    {
        // $user = User::find(1);
        // $user = User::factory()->has(Role::factory()->count('admin')->create();
        $user = User::factory()->hasRoles('admin')->create();

        return $this
            ->actingAs($user)
            ->withSession(['banned' => false]);
    }
}
