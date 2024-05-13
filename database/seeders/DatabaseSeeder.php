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

        //create 4 user with different roels
        for ($i = 1; $i <= 4; $i++) {
            User::factory()->create([
                'name' => 'user'.$i,
                'username' => 'username'.$i,
                'email' => 'user'.$i.'@example.com',
                'role' => $i,
                'password' => Hash::make('password'),
            ]);
        }

        //create 5 role(3) user
        User::factory()
            ->count(5)
            ->sequence(fn($sequence) => ['username' => 'userbiasa' . $sequence->index + 1])
            ->state(
                ['role' => 3]
            )
            ->create();
        
        //sponsor
        Sponsor::factory()
            ->count(100)
            ->create();

        //event dan lomba
        // $this->call([
        //     EventSeeder::class,
        // ]);
    }
}
