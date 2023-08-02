<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditorTourUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_public_user_cannot_update_travel(): void
    {
        $travel = Travel::factory()->create();
        $response = $this->putJson('/api/v1/admin/travels/'.$travel->id);

        $response->assertStatus(401);
    }

    public function test_editor_updates_travel_successfully_with_valid_data(): void
    {
        $travel = Travel::factory()->create();
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'editor')->value('id'));
        $response = $this->actingAs($user)->putJson('/api/v1/admin/travels/'.$travel->id, [
            'name' => 'Travel name updated',
        ]);
        $response->assertStatus(422);

        $response = $this->actingAs($user)->putJson('/api/v1/admin/travels/'.$travel->id, [
            'name' => 'Travel name updated',
            'is_public' => 1,
            'number_of_days' => 7,
            'description' => 'Composer a convenient, automatically generated class loader for this application. We just need to utilize it! Well simply require into the script here so we dont need to manually load our classes.',
        ]);

        $response->assertStatus(201);

        $response = $this->get('/api/v1/travels');
        $response->assertJsonFragment(['name' => 'Travel name updated']);
    }
}
