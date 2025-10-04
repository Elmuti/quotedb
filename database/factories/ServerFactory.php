<?php

namespace Database\Factories;

use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServerFactory extends Factory
{
    protected $model = Server::class;

    public function definition(): array
    {
        return [
            'server_id' => $this->faker->unique()->numberBetween(10000, 99999),
            'name' => $this->faker->company(),
        ];
    }
}
