<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // test to make sure login returns the right status
        $response->assertStatus(200);
        // test to ensure the return value includes a token
        $response->assertJsonStructure(['token']);

        // test to ensure if password is wrong it throws an invalid login error
    }

    public function test_login_returbs_error_with_invalid_credentials(): void
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'userjhd@gmail.com',
            'password' => 'password',
        ]);

        // test to ensure if password is wrong it throws an invalid login error
        $response->assertStatus(422);
    }
}
