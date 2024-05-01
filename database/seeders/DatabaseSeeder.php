<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@example.com',
        //     'role' => rand(1, 4),
        //     'password' => Hash::make('password'),
        // ]);

        //create 4 roles user
        for ($i = 1; $i <= 4; $i++) {
            User::factory()->create([
                'name' => 'user'.$i,
                'username' => 'username'.$i,
                'email' => 'user'.$i.'@example.com',
                'role' => $i,
                'password' => Hash::make('password'),
            ]);
        }

        // User::factory()
        //     ->count(4)
        //     ->sequence(fn($sequence) => ['role' => $sequence->index + 1])
        //     ->create();
        
        //sponsor
        Sponsor::factory()
            ->count(10)
            ->create();
    }
}
