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

    // CRUD TESTS for Assignments
    public function testGetCreatingAssignment()
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

    // Should fail cause Unauthorized user
    public function testGetEditAssignment()
    {
        $response = $this->getAuthenticatedUser()->get("/assignment/1/edit");
        $response->assertStatus(403);
    }

    // Should suceed cause user has privilleges
    public function testGetEditAssignmentAsUser()
    {
        $response = $this->getAdmin()->get("/assignment/1/edit");
        $response->assertStatus(200);
    }


    // Should fail cause Unauthorized user
    public function testDeleteAssignment()
    {
        $assignment = Assignment::factory()->create();
        $response = $this->getAuthenticatedUser()->delete(route('assignments.destroy', $assignment));
        $response->assertStatus(403);
    }

    // Should suceed cause user has privilleges
    public function testDeleteAssignmentAsAdmin()
    {
        $assignment = Assignment::factory()->create();
        $response = $this->getAdmin()->delete(route('assignments.destroy', $assignment));
        $response->assertStatus(302);
    }


    // TODO Fix this to actually fail
    // Should fail cause user is no authenticated to create Asignments
    public function testCreateAssignment()
    {
        $assignment = Assignment::factory()->create();
        $response = $this->getAuthenticatedUser()->post(route('assignments.store', $assignment));
        $response->assertStatus(302);
    }


    public function testAddingExtraResourceImages()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/assignment/1/add', [
            'file' => $file,
        ]);

        Storage::disk('local')->assertExists($file);
    }

    // Should suceed cause user has privilleges
    public function testCreateAssignmentAsAdmin()
    {
        $assignment = Assignment::factory()->create();
        $response = $this->getAdmin()->post(route('assignments.store', $assignment));
        $response->assertStatus(302);
    }

    // Should fail cause user is not authenticated to update assignments
    public function testUpdateAssignment()
    {
        $assignment = Assignment::factory()->create(["title" => "An updated title"]);
        $response = $this->getAuthenticatedUser()->put(route('assignments.update', $assignment));
        $response->assertStatus(403);
    }

    // Should suceed cause user has privilleges
    public function testUpdateAssignmentAsAdmin()
    {
        $assignment = Assignment::factory()->create(["title" => "An updated title"]);
        $response = $this->getAdmin()->put(route('assignments.update', $assignment));
        $response->assertStatus(302);
        $this->assertDatabaseHas('assignments', ['title' => "An updated title", "id" => $assignment->id]);
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

        Assignment::factory()->create();

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
        $user = User::factory()->hasRoles('admin')->create();

        return $this
            ->actingAs($user)
            ->withSession(['banned' => false]);
    }
}
