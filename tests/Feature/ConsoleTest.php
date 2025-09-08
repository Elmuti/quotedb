<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_quote_command_creates_quote(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
        ]);
        $this->artisan('quote:create', [
            '--author' => 'Console Author',
            '--quote' => 'Console quote content',
        ])->assertExitCode(0);
        $this->assertDatabaseHas('quotes', [
            'author' => 'Console Author',
            'quote' => 'Console quote content',
            'user_id' => $user->id,
        ]);
    }

    public function test_print_random_quote_command_outputs_quote(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@elmu.dev',
            'role' => 'admin',
        ]);
        $quote = Quote::factory()->for($user)->create([
            'quote' => 'Unique random quote',
            'author' => 'Random Author',
        ]);
        $this->artisan('quote:print', [
            '--email' => $user->email,
        ])->expectsOutput($quote->quote)->assertExitCode(0);
    }
}
