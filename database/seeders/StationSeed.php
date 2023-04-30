<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Station::create(['name' => 'Cairo']);
        Station::create(['name' => 'Giza']);
        Station::create(['name' => 'AlFayyum']);
        Station::create(['name' => 'AlMinya']);
        Station::create(['name' => 'Asyut']);

    }
}
