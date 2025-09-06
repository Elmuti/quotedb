<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Quote::factory()->count(50)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->superAdmin()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
        ]);

        Quote::factory()->count(10)->for($user)->create();
    }
}
