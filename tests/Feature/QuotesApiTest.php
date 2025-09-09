<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class QuotesApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    #[Test]
    public function test_add_quote(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
        ]);
        Sanctum::actingAs($user);
        $response = $this->post(route('quotes.store'), [
            'user_id' => $user->id,
            'quote' => 'this is a quote',
            'author' => 'test tester',
            'date' => Carbon::now()->toDateTimeString(),
        ]);
        $response->assertSuccessful()->assertJsonStructure(
            [
                'quote' => ['quote', 'author', 'date'],
            ]);
        $this->assertTrue(Quote::whereId($response->json('quote.id'))->exists());
    }

    public function test_get_quotes(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
        ]);
        Sanctum::actingAs($user);
        $quotes = Quote::factory()->for($user)->count(5)->create();
        $route = route('quotes.search.user', ['id' => $user->id, 'max_quotes' => 5]);
        $this->get($route)->assertSuccessful()->assertJsonCount(5, 'quotes');
    }

    public function test_get_quotes_by_server(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
            'server_id' => 12345,
        ]);
        Sanctum::actingAs($user);
        $quotes = Quote::factory()->for($user)->count(5)->create();
        $route = route('quotes.search.server', ['serverId' => $user->server_id, 'max_quotes' => 5]);
        $this->get($route)->assertSuccessful()->assertJsonCount(5, 'quotes');
    }

    public function test_get_random_quotes(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
        ]);
        Sanctum::actingAs($user);
        $quotes = Quote::factory()->for($user)->count(5)->create();
        $route = route('quotes.random.user', ['id' => $user->id, 'max_quotes' => 5]);
        $this->get($route)->assertSuccessful()->assertJsonCount(5, 'quotes');
    }
}
