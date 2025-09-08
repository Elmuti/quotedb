<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_route_returns_view_for_authenticated_user()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'role' => 'admin',
        ]);
        $this->actingAs($user);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Test User');
    }
}
