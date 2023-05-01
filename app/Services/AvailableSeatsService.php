<?php
namespace App\Services;

class AvailableSeatsService
{

    public static function get($trip, $from_station, $to_station)
    {
        $viaStations = $trip->stationsBetweenStartAndEnd($from_station, $to_station);

        $sets = $trip->bus->seats()->whereDoesntHave('reservations', function ($q) use ($trip, $viaStations) {
            $q->where('trip_id', $trip->id)
                ->whereIn('from_station_id', $viaStations)
            // ->orwhereIn('to_station_id', $viaStations)
            ;
        })->get();
        return $sets;
    }

    public static function check($trip, $from_station, $to_station, $seat)
    {

        return self::get($trip, $from_station, $to_station)->where('id', $seat)->count() > 0 ? true : false;
    }
}
