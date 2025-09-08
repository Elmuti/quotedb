<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuotesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_quotes_for_authenticated_user()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'role' => 'admin',
        ]);
        $quotes = Quote::factory()->for($user)->count(3)->create();
        $this->actingAs($user);
        $response = $this->get('/quotes');
        $response->assertStatus(200);
        foreach ($quotes as $quote) {
            $response->assertSee($quote->quote);
        }
    }
}
