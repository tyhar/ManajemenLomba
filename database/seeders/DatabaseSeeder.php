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
        $data = [
            [
                'name' => 'Universitas Sebelas Maret',
                'link_file' => 'https://uns.ac.id/',
                'logo' => 'sponsors/IomBriJvZH75fEJMTDBR6IQcGCjw9YaVJHrJMZwL.png',
            ],
            [
                'name' => 'D3TI UNS',
                'link_file' => 'https://d3ti.vokasi.uns.ac.id/',
                'logo' => 'sponsors/9EUxLFGXEKmNgxsNHfmXMSwQh4BeJE1FvnYUf7uS.png',
            ],
            [
                'name' => 'Emailkomp',
                'link_file' => 'https://www.instagram.com/emailkompuns/',
                'logo' => 'sponsors/whZfHrFaTEOePjtEief0B6r6EKT7L9cuhlGCGULu.png',
            ],
            [
                'name' => 'SV UNS',
                'link_file' => 'https://vokasi.uns.ac.id/',
                'logo' => 'sponsors/KbrECeGXT1Qvhv634pfOXxHP3ODeQzlT3hE3fNIw.png',
            ],
        ];

        // Loop through the data and create Sponsor records
        foreach ($data as $sponsorData) {
            Sponsor::factory()->create($sponsorData);
        }

        //event dan lomba
        $this->call([
            EventSeeder::class,
        ]);
    }
}
