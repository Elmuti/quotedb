<?php

namespace Database\Factories;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition(): array
    {
        return [
            'quote' => $this->faker->sentence(random_int(3, 10)),
            'author' => $this->faker->name(),
            'user_id' => User::factory(),
            'created_at' => now(),
        ];
    }

    public function server(int $serverId): static
    {
        return $this->state(
            fn (array $attributes): array => [
                'server_id' => $serverId,
            ],
        );
    }
}
