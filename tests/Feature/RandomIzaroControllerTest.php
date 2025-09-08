<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RandomIzaroControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_quote_for_authenticated_user()
    {
        $user = User::factory()->create(['id' => 2]);
        $quote = Quote::factory()->for($user)->create([
            'quote' => 'Izaro test quote',
            'author' => 'Izaro Author',
        ]);
        $this->actingAs($user);
        $response = $this->get('/izaro');
        $response->assertStatus(200);
        $response->assertSee('Izaro test quote');
    }
}
