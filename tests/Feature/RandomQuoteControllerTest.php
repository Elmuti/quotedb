<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RandomQuoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_random_quote_for_authenticated_user()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'role' => 'admin',
        ]);
        $quotes = Quote::factory()->for($user)->count(3)->create();
        $this->actingAs($user);
        $response = $this->get('/random');
        $response->assertStatus(200);
        // At least one of the quotes should be visible
        $this->assertTrue(
            $quotes->pluck('quote')->contains(function ($quoteText) use ($response) {
                return str_contains($response->getContent(), $quoteText);
            }),
            'Response does not contain any of the user quotes.'
        );
    }
}
