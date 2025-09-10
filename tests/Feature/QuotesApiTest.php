<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\Server;
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
        ]);
        $server = Server::factory()->create([
            'server_id' => 12345,
            'name' => 'Test Server',
        ]);
        Sanctum::actingAs($user);
        $quotes = Quote::factory()->for($user)->server($server)->count(5)->create();
        $route = route('quotes.search.server', ['serverId' => $server->server_id, 'max_quotes' => 5]);
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

    public function test_get_random_quotes_by_server(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
        ]);
        $server = Server::factory()->create([
            'server_id' => 12345,
            'name' => 'Test Server',
        ]);
        Sanctum::actingAs($user);
        $quotes = Quote::factory()->for($user)->server($server)->count(5)->create();
        $route = route('quotes.random.server', ['serverId' => $server->server_id, 'max_quotes' => 5]);
        $this->get($route)->assertSuccessful()->assertJsonCount(5, 'quotes');
    }

    public function test_add_quote_with_server_id(): void
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
            'server' => [
                'id' => '12345',
                'name' => 'Test Server',
            ],
        ]);
        $response->assertSuccessful()->assertJsonStructure(
            [
                'quote' => ['quote', 'author', 'date', 'server_id'],
            ]);
        $quote = Quote::find($response->json('quote.id'));
        $this->assertNotNull($quote);
        $this->assertEquals(12345, $quote->server->server_id);
        // Check that a server record was created with the correct external server_id
        $this->assertTrue(Server::where('server_id', '12345')->exists());
        $response2 = $this->post(route('quotes.store'), [
            'user_id' => $user->id,
            'quote' => 'this is a 2nd quote',
            'author' => 'test tester 2',
            'date' => Carbon::now()->toDateTimeString(),
            'server' => [
                'id' => '12346',
                'name' => 'Test Server',
            ],
        ]);
        $quote = Quote::find($response2->json('quote.id'));
        $this->assertNotNull($quote);
        $this->assertEquals(12346, $quote->server->server_id);
    }
}
