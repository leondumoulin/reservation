<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Ahmed Hisham',
            'email' => 'ahmed@fintech.task',
            'password' => bcrypt(123),
        ]);
        $this->call([
            StationSeed::class,
            BusSeed::class,
            TripSeed::class,
        ]);

    }
}
