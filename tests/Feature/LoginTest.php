<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post('/login', ['email' => 'test@example.com', 'password' => 'password']);
        $response->assertRedirect('/quotes');
    }

    public function test_invalid_login(): void {
        $response = $this->followingRedirects()->post('/login', ['email' => 'test@example.com', 'password' => 'asd']);
        $response->assertStatus(422);
    }
}

