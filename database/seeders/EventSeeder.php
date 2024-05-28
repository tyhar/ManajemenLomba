<?php

namespace Database\Seeders;

use App\Models\Eventlomba;
use App\Models\Lomba;
use App\Models\Reg_lomba;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Eventlomba::factory()
            ->count(1)
            ->state(
                ['name' => 'OLINAS']
            )
            ->has(
                Lomba::factory()
                    ->count(6)
                    ->state(
                        new Sequence(
                            ['name' => 'UI/UX'],
                            ['name' => 'DESAIN'],
                            ['name' => 'HACKING'],
                            ['name' => 'IOT'],
                            ['name' => 'VIDEOGRAFI'],
                            ['name' => 'APP'],
                        )
                    )
                    // ->has(
                    //     RegLomba::class()
                    //         ->count(5)
                    // )
            )
            ->create();
    }
}
