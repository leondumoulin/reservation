<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trip = Trip::create([
            'bus_id' => 1,
        ]);

        $trip->viastations()->create([
            'station_id' => 1,
            'sequence' => 1,
        ]);

        $trip->viastations()->create([
            'station_id' => 2,
            'sequence' => 2,
        ]);
        $trip->viastations()->create([
            'station_id' => 3,
            'sequence' => 3,
        ]);
        $trip->viastations()->create([
            'station_id' => 4,
            'sequence' => 4,
        ]);

        $trip->viastations()->create([
            'station_id' => 5,
            'sequence' => 5,
        ]);

        Reservation::create([
            'user_id' => 1,
            'trep_id' => 1,
            'seat_id' => 1,
            'from_station_id' => 1,
            'to_station_id' => 3,
            'code' => '',
        ]);

    }
}
