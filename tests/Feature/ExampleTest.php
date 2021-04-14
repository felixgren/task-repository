<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // Should redirect if not logged in;
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
