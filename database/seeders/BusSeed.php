<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Seeder;

class BusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bus = Bus::create(['name' => 'Bus#1']);

        for ($i = 1; $i < 13; $i++) {
            $bus->seats()->create(['number' => $i]);
        }
    }
}
