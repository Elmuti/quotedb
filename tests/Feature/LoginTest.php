<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_login(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@elmu.dev',
            'password' => bcrypt('password'),
            // Make sure user has admin permissions if needed
        ]);

        // Use Filament's login page test helper
        $response = $this->get(Filament::getLoginUrl());
        $response->assertSuccessful();

        // Then try the login
        $response = $this->post(Filament::getLoginUrl(), [
            'email' => 'admin@elmu.dev',
            'password' => 'password',
        ]);

        $response->assertRedirect(Filament::getHomeUrl());
    }

// For non-admin authentication
    public function test_example(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertRedirect(route('quotes'));
        $this->assertAuthenticated();
    }

    public function test_invalid_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}

