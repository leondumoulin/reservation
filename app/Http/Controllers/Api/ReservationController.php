<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableSeatsRequest;
use App\Http\Resources\AvailableSeatsResource;
use App\Models\Trip;

class ReservationController extends Controller
{
    public function getAvailableSeats(Trip $trip, AvailableSeatsRequest $request)
    {

        $viaStations = $trip->stationsBetweenStartAndEnd($request->from_station, $request->to_station);

        $sets = $trip->bus->seats()->whereDoesntHave('reservations', function ($q) use ($trip, $viaStations) {
            $q->where('trep_id', $trip->id)
                ->whereIn('from_station_id', $viaStations)
                ->orwhereIn('to_station_id', $viaStations)
            ;
        })->get();

        return AvailableSeatsResource::collection($sets);

    }

}
